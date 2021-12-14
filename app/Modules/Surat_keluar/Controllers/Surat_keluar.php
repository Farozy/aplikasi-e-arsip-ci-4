<?php namespace App\Modules\Surat_keluar\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Surat_keluar\Models\suratkeluarModel;
use App\Modules\Surat_keluar\Models\suratkeluarDataModel;
use App\Modules\Jenis\Models\jenisModel;
use App\Modules\Unit_kerja\Models\unitKerjaModel;
use Config\Services;

class Surat_keluar extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->keluar = new suratkeluarModel;
		$this->jenis = new jenisModel;
		$this->role = new roleModel;
		$this->unit = new unitKerjaModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Surat keluar',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Surat_keluar\Views/view', $data);
	}

	public function listData()
	{
		$request = Services::request();
		$datamodel = new suratkeluarDataModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];

				$btnDetail = "<a href=\"surat_keluar/detail/$list->id_surat_keluar\" class=\"btn btn-info rounded-circle\" data-toggle=\"tooltip\" title=\"Detail Data\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"fas fa-eye\"></i></a>";
				$btnEdit = "<a href=\"surat_keluar/edit/$list->id_surat_keluar\" class=\"btn btn-warning rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_surat_keluar)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5; color: white;\"><i class=\"far fa-edit\"></i></a>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_surat_keluar)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"far fa-trash-alt\"></i></button>";

				$row[] = $no;
				$row[] = $list->updated_date == false ? date("d-m-Y", strtotime($list->tanggal)) . ' / ' .  date('H:i:s', strtotime($list->created_date)) : date("d-m-Y", strtotime($list->tanggal)) . ' / ' . date('H:i:s', strtotime($list->updated_date));
				$row[] = "<a href=\"surat_keluar/detail/$list->id_surat_keluar\" data-toggle=\"tooltip\" title=\"Detail Data\" id=\"detail\">$list->no_surat</a>";
				$row[] = ucfirst($list->sifat_surat);
				$row[] = ucwords($list->nama_unit_kerja);
				$row[] = ucwords($list->tertuju);
				$row[] = $list->disposisi == false ? "<button class=\"btn btn-secondary btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Disposisikan\" onclick=\"disposisi_keluar($list->id_surat_keluar)\" style=\" padding: .30rem .30rem; font-size: .725rem; line-height: .5;\"><i class=\"fas fa-location-arrow\"></i></button> Menunggu Disposisi" : "<button class=\"btn btn-success btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Disposisi\" style=\" padding: .30rem .30rem; font-size: .725rem; line-height: .5;\"><i class=\"far fa-check-circle\"></i></button> " . ucwords($list->nama_unit_kerja);
				$row[] = $btnDetail . " " . $btnEdit." ".$btnHapus;

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

	public function detail($id)
	{	
		$data = [
			'title' => 'Detail Surat keluar',
			'keluar' => $this->keluar->find($id),
			'unit' => $this->unit->findAll()
		];

		return view('App\Modules\Surat_keluar\Views/detail', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Surat keluar',
			'role' => $this->role->findAll(),
			'unit' => $this->unit->findAll(),
			'validation' => $this->validation
		];

		return view('App\Modules\Surat_keluar\Views/add', $data);
	}

	public function save()
	{
		if( $this->request->isAjax() ) {

			$input = $this->request->getVar();
			$errors = $this->validation->run($input, 'surat_keluar');

			if( $errors ) {

				$data = [
					'file' => '',
					'tanggal' => date('Y-m-d', strtotime($input['tanggal'])),
					'no_surat' => $input['no_surat'],
					'sifat_surat' => strtolower($input['sifat_surat']),
					'pengirim' => strtolower($input['pengirim']),
					'perihal' => strtolower($input['perihal']),
					'tertuju' => strtolower($input['tertuju']),
					'alamat' => strtolower($input['alamat']),
					'isi_surat' => strtolower($input['isi_surat']),
					'disposisi' => 0,
					'tanggal_disposisi' => 0,
					'ket_disposisi' => 0,
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => 0
				];

				$this->keluar->insert($data);

				$msg = [
					'data' => view('App\Modules\Surat_keluar\Views/data', ['title' => 'Surat keluar'])
				];
			} else {
				$msg = [
					'errors' => [
						'no_surat' => $this->validation->getError('no_surat'),
						'tanggal' => $this->validation->getError('tanggal'),
						'sifat_surat' => $this->validation->getError('sifat_surat'),
						'pengirim' => $this->validation->getError('pengirim'),
						'perihal' => $this->validation->getError('perihal'),
						'tertuju' => $this->validation->getError('tertuju'),
						'alamat' => $this->validation->getError('alamat'),
						'isi_surat' => $this->validation->getError('isi_surat'),
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
			'title' => 'Surat keluar',
			'keluar' => $this->keluar->find($id),
			'validation' => $this->validation
		];

		return view("App\Modules\Surat_keluar\Views/edit", $data);
	}

	public function update()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$disposisi = $this->request->getVar('disposisi');
			$tanggal_disposisi = $this->request->getVar('tanggal_disposisi');
			$ket_disposisi = $this->request->getVar('ket_disposisi');
			$created_date = $this->request->getVar('created_date');
			$input = $this->request->getVar();

			$valid = $this->validation->run($input, 'surat_keluar');

			if( $valid ) {

				$data = [
					'file' => '',
					'tanggal' => date('Y-m-d', strtotime($input['tanggal'])),
					'no_surat' => $input['no_surat'],
					'sifat_surat' => strtolower($input['sifat_surat']),
					'pengirim' => strtolower($input['pengirim']),
					'perihal' => strtolower($input['perihal']),
					'tertuju' => strtolower($input['tertuju']),
					'alamat' => strtolower($input['alamat']),
					'isi_surat' => strtolower($input['isi_surat']),
					'disposisi' => $disposisi,
					'tanggal_disposisi' => $tanggal_disposisi,
					'ket_disposisi' => $ket_disposisi,
					'created_date' => $created_date,
					'updated_date' => date('Y-m-d H:i:s')
				];

				$this->keluar->update(['id_surat_keluar' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Surat_keluar\Views/data', ['title' => 'Surat keluar'])
				];

			} else {
				$msg = [
					'errors' => [
						'no_surat' => $this->validation->getError('no_surat'),
						'tanggal' => $this->validation->getError('tanggal'),
						'sifat_surat' => $this->validation->getError('sifat_surat'),
						'pengirim' => $this->validation->getError('pengirim'),
						'perihal' => $this->validation->getError('perihal'),
						'tertuju' => $this->validation->getError('tertuju'),
						'alamat' => $this->validation->getError('alamat'),
						'isi_surat' => $this->validation->getError('isi_surat'),
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

			$this->keluar->delete($id);

			$msg = [
				'data' => view('App\Modules\surat_keluar\Views/data', ['title' => 'Surat Keluar'])
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function upload_save()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$file = $this->request->getFile('file');
			$fileLama = $this->request->getVar('fileLama');

			$valid = $this->validate([
				'file' => [
					'rules' => 'uploaded[file]|max_size[file,2024]|ext_in[file,pdf]',
					'errors' => [
						'uploaded' => 'Tidak ada file yang dipilih',
						'max_size' => 'Ukuran file terlalu besar',
						'ext_in' => 'File yang diupload bukan pdf'
					]
				]
			]);


			if( $valid ) {

				if( $fileLama == null ) {
					$new = $file->getRandomName();
					$file->move('public/uploads/surat_keluar/', $new);
					$dok = $new;
				} else {
					unlink('public/uploads/surat_keluar/' . $fileLama);
					$new = $file->getRandomName();
					$file->move('public/uploads/surat_keluar/', $new);
					$dok = $new;
				}

				$this->keluar->update(['id_dokumen' => $id], ['file' => $dok]);

				$msg = [
					'data' => view('App\Modules\Dokumen\Views/data', ['title' => 'Dokumen'])
				];
			} else {
				$msg = [
					'errors' => [
						'file' => $this->validation->getError('file')
					]
				];
			}

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function disposisi()
	{
		if( $this->request->isAjax() ) {
		
			$id = $this->request->getVar('id');

			$data = [
				'title' => 'Disposisi Awal Surat Keluar',
				'keluar' => $this->keluar->find($id),
			];

			$msg = [
				'data' => view('App\Modules\Surat_keluar\Views/disposisi', $data)
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function simpan_disposisi()
	{
		if( $this->request->isAjax() ) {
		
			$id = $this->request->getVar('id');
			$input = $this->request->getVar();

			$valid = $this->validate([
				'disposisi' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field disposisi belum diisi'
					]
				],
				'tanggal_disposisi' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field tanggal disposisi belum diisi'
					]
				],
				'ket_disposisi' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field keterangan disposisi belum diisi'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'disposisi' => strtolower($input['disposisi']),
					'tanggal_disposisi' => date('Y-m-d', strtotime($input['tanggal_disposisi'])),
					'ket_disposisi' => strtolower($input['ket_disposisi'])
				];

				$this->keluar->update(['id_surat_keluar' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Surat_keluar\Views/data', ['title' => 'Surat Keluar'])
				];

			} else {
				$msg = [
					'error' => [
						'disposisi' => $this->validation->getError('disposisi'),
						'tanggal_disposisi' => $this->validation->getError('tanggal_disposisi'),
						'ket_disposisi' => $this->validation->getError('ket_disposisi')
					]
				];
			}

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}
}
