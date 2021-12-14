<?php namespace App\Modules\User\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\User\Models\userModel;
use App\Modules\User\Models\userDataModel;
use Config\Services;

class User extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->user = new userModel;
		$this->role = new roleModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Pengguna',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\User\Views/view', $data);
	}

	public function listData()
    {
        $request = Services::request();
        $datamodel = new userDataModel($request);
        if ($request->getMethod(true) == 'POST') {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];

                $btnDetail = "<button class=\"btn btn-info btn-sm btn-icon rounded-circle\" data-toggle=\"tooltip\"  title=\"Detail Data\" onclick=\"detail($list->id_user)\"><i class=\"fa fa-eye\"></i></button>";
				$btnEdit = "<a href=\"user/edit/$list->id_user\" class=\"btn btn-icon btn-warning btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\"><i class=\"fa fa-edit\"></i></a>";
				$btnHapus = "<button class=\"btn btn-icon btn-danger btn-sm rounded-circle active\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_user)\"><i class=\"fa fa-trash\"></i></button>";
				$btnActive = "<button class=\"btn btn-icon btn-sm rounded-circle btn-success ml-1\" value=\"$list->id_user\" data-toggle=\"tooltip\" title=\"Non-Aktifkan\" onclick=\"active($list->id_user)\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-success\"></span></div>";
				$btnNonActive = "<button class=\"btn btn-icon btn-sm rounded-circle btn-danger ml-1\" data-toggle=\"tooltip\" title=\"Aktifkan\" onclick=\"nonActive($list->id_user)\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-danger\"></span></div>";

				$row[] = $no;
				$row[] = ucwords($list->username);
				$row[] = ucfirst($list->email);
				$row[] = ucfirst($list->nama_role);
				$row[] = $list->is_active ? $btnActive : $btnNonActive;
				$row[] = $btnDetail." ".$btnEdit." ".$btnHapus;

                $row[] = '';
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }

    public function create()
    {
    	$data = [
    		'title' => 'Tambah Data Pengguna',
    		'role' => $this->role->findAll(),
    		'validation' => $this->validation,
    		'user' => $this->user->findAll()
    	];

    	return view('App\Modules\User\Views/add', $data);
    }

    public function save()
    {
    	$input = $this->request->getVar();
		$file = $this->request->getFile('foto');

		$this->validation->run($input, 'user2');
		$errors = $this->validation->getErrors();

    	if( ! $errors ) {

			if( $file->getError() == 4 ) {
				$foto = 'default.png';
			} else {
				$new = $file->getRandomName();
				$file->move('uploads/foto', $new);
				$foto = $new;
			}

			$data = [
				'nama_lengkap' => strtolower($input['nama_lengkap']),
				'email' => strtolower($input['email']),
				'username' => strtolower($input['username']),
				'password' => $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT),
				'foto' => $foto,
				'role_id' => $input['role_id'],
				'is_active' => $input['is_active'],
				'created_date' => date('Y/m/d'),
				'updated_date' => 0
			];

			unset($input['password2']);
    		

			$this->user->insert($data);
			session()->setFlashdata('success', 'Data berhasil disimpan');
			return redirect()->to('user');

    	} else {
    		return redirect()->back()->withInput();
    	}
    }

    public function edit($id)
    {
    	$data = [
    		'title' => 'Edit Data Pengguna',
    		'user' => $this->user->find($id),
    		'role' => $this->role->findAll(),
    		'jmlUser' => count($this->user->findAll()),
    		'validation' => $this->validation
    	];

    	return view('App\Modules\User\Views/edit', $data);
    }

    public function update()
    {
    	$id = $this->request->getVar('id');
    	$input = $this->request->getVar();
    	$fotoLama = $this->request->getVar('fotoLama');
    	$createdDate = $this->request->getVar('created_date');
		$file = $this->request->getFile('foto');

		$this->validation->run($input, 'user2');
		$errors = $this->validation->getErrors();

    	if( ! $errors ) {

    		$data = $this->user->where('id_user', $id)->first();

			if( $file->getError() == 4 ) {
				$foto = $fotoLama;
			} else {
				$new = $file->getRandomName();
				$file->move('public/uploads/foto', $new);
				$foto = $new;
			}

			if(password_verify($input['password'], $data['password']) ) {

				$input['password'] =$data['password'];
				unset($input['password2']);
				$input['foto'] = $foto;
				$input['created_date'] = $createdDate;
				$input['updated_date'] = date('Y/m/d');

				$this->user->update(['id_user' => $id], $input);
				session()->setFlashdata('success', 'Data berhasil diupdate');
				return redirect()->to('user');

			} else {
				session()->setFlashdata('error', 'Password salah');
				return redirect()->back();
			}

    	} else {
    		return redirect()->back()->withInput();
    	}
    }

    public function hapus()
    {
    	if( $this->request->isAjax() ) {
    	
    		$id = $this->request->getVar('id');

    		$this->user->delete($id);

    		$msg = [
    			'data' => view('App\Modules\User\Views/data', ['title' => 'Pengguna'])
    		];

    		return $this->response->setJSON($msg);
    	
    	} else {
    		return redirect()->back();
    	}
    }

    public function detail()
    {
    	if( $this->request->isAjax() ) {
    	
    		$id = $this->request->getVar('id');

			$data = [
				'title' => 'Detail Data Pengguna',
				'user' => $this->user->find($id),
				'role' => $this->role->findAll()
			];

			$msg = [
				'data' => view('App\Modules\User\Views/detail', $data)
			];

			return $this->response->setJSON($msg);
    	
    	} else {
    		return redirect()->back();
    	}
    }

    public function toggle()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$status = $this->user->find($id)['is_active'];
			$toggle = $status ? 0 : 1;

			$this->user->update(['id_user' => $id],['is_active' => $toggle]);

			$msg = [
				'data' => view('App\Modules\User\Views/data', ['title' => 'Pengguna'])
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function UbahPassword()
	{
		if( $this->request->isAjax() ) {
    	
    		$id = $this->request->getVar('id');

			$data = [
				'title' => 'Ubah Password',
				'user' => $this->user->find($id),
			];

			$msg = [
				'data' => view('App\Modules\User\Views/ubah_pass', $data)
			];

			return $this->response->setJSON($msg);
    	
    	} else {
    		return redirect()->back();
    	}
	}

	public function simpanUbahPassword()
	{
		if( $this->request->isAjax() ) {
		
			$id = $this->request->getVar('id');
			$passwordLama = $this->request->getVar('passwordLama');
			$passwordBaru = $this->request->getVar('passwordBaru');
			$passwordUlang = $this->request->getVar('passwordUlang');

			$data = $this->user->where('id_user', $id)->first();

			$valid = $this->validate([
				'passwordLama' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field password lama harus diisi'
					]
				],
				'passwordBaru' => [
					'rules' => 'trim|required|min_length[3]|matches[passwordUlang]',
					'errors' => [
						'required' => 'Field password Baru harus diisi',
						'min_length' => 'Min. 3 karakter untuk password',
						'matches' => 'Password yang dimasukkan tidak cocok'
					]
				],
				'passwordUlang' => [
					'rules' => 'trim|required|matches[passwordBaru]',
					'errors' => [
						'required' => 'Field repeat password harus diisi',
						'matches' => 'Password yang dimasukkan tidak cocok'
					]
				],
			]);

			if( $valid ) {

				if( password_verify( $passwordLama, $data['password']) ) {

					$passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
					unset($passwordUlang);

					$this->user->update(['id_user' => $id],['password' => $passwordBaru]);

					$msg = [
						'data' => [
							'icon' => 'success',
							'text' => 'Password berhasil diubah',
							'view' => view('App\Modules\User\Views/data', ['title' => 'Pengguna'])
						]
					];

				} else {
					$msg = [
						'data' => [
							'icon' => 'error',
							'text' => 'Password Lama Salah'
						]
					];
				}

			} else {
				$msg = [
					'errors' => [
						'passwordLama' => $this->validation->getError('passwordLama'),
						'passwordBaru' => $this->validation->getError('passwordBaru'),
						'passwordUlang' => $this->validation->getError('passwordUlang')
					]
				];
			}

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}
}
