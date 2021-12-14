<?php namespace App\Modules\Dokumen\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Dokumen\Models\dokumenModel;
use App\Modules\Dokumen\Models\dokumenDataModel;
use App\Modules\Jenis\Models\jenisModel;
use Config\Services;

class Dokumen extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->dokumen = new dokumenModel;
		$this->jenis = new jenisModel;
		$this->role = new roleModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Dokumen',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Dokumen\Views/view', $data);
	}

	public function listData()
	{
		$request = Services::request();
		$datamodel = new dokumenDataModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];

				$btnUpload = "<button class=\"btn btn-info rounded-circle\" data-toggle=\"tooltip\" title=\"Upload Data\" onclick=\"upload($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"fas fa-upload\"></i></button>";
				$btnDownload = "<button class=\"btn btn-success rounded-circle\" data-toggle=\"tooltip\" title=\"Download Data\" onclick=\"download($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"fas fa-download\"></i></button>";
				$btnEdit = "<a href=\"dokumen/edit/$list->id_dokumen\" class=\"btn btn-warning rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5; color: white;\"><i class=\"far fa-edit\"></i></a>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"far fa-trash-alt\"></i></button>";

				$row[] = $no;
				$row[] = ucwords($list->nama_jenis);
				$row[] = "<a data-toggle=\"tooltip\" title=\"Detail Data\" id=\"detail\" onclick=\"detail($list->id_dokumen)\">$list->no_dokumen</a>";
				$row[] = $list->tahun;
				$row[] = 'Arsip ' . ucwords($list->no_dokumen);
				$row[] = $list->ukuran;
				$row[] = date('d-m-Y', strtotime($list->tanggal_upload));
				$row[] = $btnUpload . ' ' . $btnDownload . ' ' . $btnEdit." ".$btnHapus;

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

	public function detail()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
		
			$data = [
				'title' => 'Detail Dokumen',
				'jenis' => $this->jenis->findAll(),
				'dok' => $this->dokumen->find($id)
			];

			$msg = [
				'data' => view("App\Modules\Dokumen\Views/detail", $data)
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function create()
	{
		$data = [
			'title' => 'Tambah Data Dokumen',
			'role' => $this->role->findAll(),
			'jenis' => $this->jenis->findAll(),
			'validation' => $this->validation
		];

		return view('App\Modules\Dokumen\Views/add', $data);
	}

	public function save()
	{
		if( $this->request->isAjax() ) {

			$input = $this->request->getVar();
			$file = $this->request->getFile('dokumen');
			$ukuran = $file->getSize('kb');

			$errors = $this->validation->run($input, 'dokumen');

			if( $errors ) {

				$dok = $file->getRandomName();
				$file->move('public/uploads/dokumen/', $dok);

				$data = [
					'jenis_id' => $input['jenis_id'],
					'nama_dokumen' => strtolower($input['nama_dokumen']),
					'dokumen' => $dok,
					'no_dokumen' => strtolower($input['nama_dokumen']) . '-' . $input['tahun'] . '-' . random_string('numeric', 3),
					'tahun' => $input['tahun'],
					'deskripsi' => strtolower($input['deskripsi']),
					'ukuran' => round($ukuran / 1024),
					'tanggal_upload' => date('Y-m-d', strtotime($input['tanggal_upload'])),
					'download' => 0,
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => 0
				];

				$this->dokumen->insert($data);

				$msg = [
					'data' => view('App\Modules\Dokumen\Views/data', ['title' => 'Dokumen'])
				];
			} else {
				$msg = [
					'errors' => [
						'jenis_id' => $this->validation->getError('jenis_id'),
						'nama_dokumen' => $this->validation->getError('nama_dokumen'),
						'dokumen' => $this->validation->getError('dokumen'),
						'tahun' => $this->validation->getError('tahun'),
						'deskripsi' => $this->validation->getError('deskripsi'),
						'tanggal_upload' => $this->validation->getError('tanggal_upload'),
					]
				];
			}

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function edit($id)
	{
		$data = [
			'title' => 'Edit Data Dokumen',
			'dok' => $this->dokumen->find($id),
			'role' => $this->role->findAll(),
			'jenis' => $this->jenis->findAll(),
			'validation' => $this->validation
		];

		return view("App\Modules\Dokumen\Views/edit", $data);
	}

	public function update()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$file = $this->request->getFile('dokumen');
			$ukuran = $file->getSize('kb');
			$ukuranLama = $this->request->getVar('ukuran');
			$dokumenLama = $this->request->getVar('dokumenLama');
			$download = $this->request->getVar('download');
			$created_date = $this->request->getVar('created_date');
			$input = $this->request->getVar();

			$valid = $this->validate([
				'jenis_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Field jenis dokumen belum dipilih',
					]
				],
				'nama_dokumen' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field nama dokumen belum diisi',
					]
				],
				'dokumen' => [
					'rules' => 'max_size[dokumen,2024]|ext_in[dokumen,pdf]',
					'errors' => [
						'max_size' => 'Ukuran file terlalu besar',
						'ext_in' => 'File yang diupload bukan pdf'
					]
				],
				'tahun' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Field tahun belum diisi',
					]
				],
				'deskripsi' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field deskirpsi belum diisi',
					]
				],
				'tanggal_upload' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Field tanggal upload belum diisi',
					]
				]
			]);

			if( $valid ) {

				if( $file->getError() == 4 ) {
					$dok = $dokumenLama;
				} else {
					unlink('public/uploads/dokumen/' . $dokumenLama);
					$new = $file->getRandomName();
					$file->move('public/uploads/dokumen/', $new);
					$dok = $new;
				}

				$data = [
					'jenis_id' => $input['jenis_id'],
					'nama_dokumen' => strtolower($input['nama_dokumen']),
					'dokumen' => $dok,
					'no_dokumen' => strtolower($input['nama_dokumen']) . '-' . $input['tahun'] . '-' . random_string('numeric', 3),
					'tahun' => $input['tahun'],
					'deskripsi' => strtolower($input['deskripsi']),
					'ukuran' => $ukuran != null ? round($ukuran / 1024) : $ukuranLama,
					'tanggal_upload' => date('Y-m-d', strtotime($input['tanggal_upload'])),
					'download' => $download,
					'created_date' => $created_date,
					'updated_date' => date('Y-m-d H:i:s')
				];

				$this->dokumen->update(['id_dokumen' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Dokumen\Views/data', ['title' => 'Dokumen'])
				];

			} else {
				$msg = [
					'errors' => [
						'jenis_id' => $this->validation->getError('jenis_id'),
						'nama_dokumen' => $this->validation->getError('nama_dokumen'),
						'dokumen' => $this->validation->getError('dokumen'),
						'tahun' => $this->validation->getError('tahun'),
						'deskripsi' => $this->validation->getError('deskripsi'),
						'tanggal_upload' => $this->validation->getError('tanggal_upload'),
					]
				];
			}

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function hapus()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');

			$dok = $this->dokumen->find($id);			

			unlink('public/uploads/dokumen/' . $dok['dokumen']);
			$this->dokumen->delete($id);

			$msg = [
				'data' => view('App\Modules\Dokumen\Views/data', ['title' => 'Dokumen'])
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function upload()
	{
		if( $this->request->isAjax() ) {
		
			$id = $this->request->getVar('id');

			$data = [
				'title' => 'Upload Dokumen',
				'dok' => $this->dokumen->find($id)
			];

			$msg = [
				'data' => view('App\Modules\Dokumen\Views/upload', $data)
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function upload_save()
	{
		if( $this->request->isAjax() ) {
		
			$file = $this->request->getFile('dokumen');
			$ukuran = $file->getSize('kb');
			$dokumenLama = $this->request->getVar('dokumenLama');
			$ukuranLama = $this->request->getVar('ukuranLama');
			$id = $this->request->getVar('id');

			$valid = $this->validate([
				'dokumen' => [
					'rules' => 'uploaded[dokumen]|max_size[dokumen,2024]|ext_in[dokumen,pdf]',
					'errors' => [
						'uploaded' => 'Tidak ada dokumen yang dipilih',
						'max_size' => 'Ukuran file terlalu besar',
						'ext_in' => 'File yang diupload bukan pdf'
					]
				]
			]);

			if( $valid ) {

				unlink('public/uploads/dokumen/' . $dokumenLama);
				$new = $file->getRandomName();
				$file->move('public/uploads/dokumen/', $new);
				$dok = $new;

				$data = [
					'dokumen' => $dok,
					'ukuran' => $ukuran != null ? round($ukuran / 1024) : $ukuranLama,
				];

				$this->dokumen->update(['id_dokumen' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Dokumen\Views/data', ['title' => 'Dokumen'])
				];

			} else {
				$msg = [
					'errors' => [
						'dokumen' => $this->validation->getError('dokumen'),
					]
				];
			}

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function toggle()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$status = $this->jenis->find($id)['status_jenis'];
			$toggle = $status ? 0 : 1;

			$this->jenis->update(['id_jenis' => $id],['status_jenis' => $toggle]);

			$msg = [
				'data' => view('App\Modules\Jenis\Views/data', ['title' => 'Jenis Dokumen'])
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	function download() {
		$id = $this->request->getVar('id');

		$dok = $this->dokumen->find($id);

		$this->dokumen->update(['id_dokumen' => $id], ['download' => $dok['download'] + 1]);

		$msg = [
			'data' => 'public/uploads/dokumen/' . $dok['dokumen']
		];

		return $this->response->setJSON($msg);
	}
}
