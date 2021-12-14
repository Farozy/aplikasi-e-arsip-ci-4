<?php namespace App\Modules\Surat_masuk\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Surat_masuk\Models\suratMasukModel;
use App\Modules\Surat_masuk\Models\suratMasukDataModel;
use App\Modules\Jenis\Models\jenisModel;
use App\Modules\Unit_kerja\Models\unitKerjaModel;
use Config\Services;

class Surat_masuk extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->masuk = new suratMasukModel;
		$this->jenis = new jenisModel;
		$this->role = new roleModel;
		$this->unit = new unitKerjaModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Surat Masuk',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Surat_masuk\Views/view', $data);
	}

	public function listData()
	{
		$request = Services::request();
		$datamodel = new suratMasukDataModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];

				$btnDetail = "<a href=\"surat_masuk/detail/$list->id_surat_masuk\" class=\"btn btn-info rounded-circle\" data-toggle=\"tooltip\" title=\"Detail Data\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"fas fa-eye\"></i></a>";
				$btnEdit = "<a href=\"surat_masuk/edit/$list->id_surat_masuk\" class=\"btn btn-warning rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_surat_masuk)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5; color: white;\"><i class=\"far fa-edit\"></i></a>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_surat_masuk)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"far fa-trash-alt\"></i></button>";

				$row[] = $no;
				$row[] = $list->updated_date == false ? date("d-m-Y", strtotime($list->tanggal)) . ' / ' .  date('H:i:s', strtotime($list->created_date)) : date("d-m-Y", strtotime($list->tanggal)) . ' / ' . date('H:i:s', strtotime($list->updated_date));
				$row[] = "<a href=\"surat_masuk/detail/$list->id_surat_masuk\" data-toggle=\"tooltip\" title=\"Detail Data\" id=\"detail\">$list->no_surat</a>";
				$row[] = ucfirst($list->sifat_surat);
				$row[] = ucwords($list->pengirim);
				foreach( $this->unit->findAll() as $un ) {
					if( $un['id_unit_kerja'] == $list->unit_kerja_id ) {
						$nama_unit = $un['nama_unit_kerja'];
					}
				}
				$row[] = $list->unit_kerja_id == false ? "<button class=\"btn btn-secondary btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Disposisikan\" onclick=\"disposisi_masuk($list->id_surat_masuk)\" style=\" padding: .30rem .30rem; font-size: .725rem; line-height: .5;\"><i class=\"fas fa-location-arrow\"></i></button> Menunggu Disposisi" : "<button class=\"btn btn-success btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Disposisi\" style=\" padding: .30rem .30rem; font-size: .725rem; line-height: .5;\"><i class=\"far fa-check-circle\"></i></button> " . ucwords($nama_unit);
				$row[] = $btnDetail . " " . $btnEdit." ".$btnHapus;

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
			'title' => 'Detail Surat Masuk',
			'masuk' => $this->masuk->find($id),
			'unit' => $this->unit->findAll()
		];

		return view('App\Modules\Surat_masuk\Views/detail', $data);
	}

	public function create()
	{
		$data = [
			'title' => 'Surat Masuk',
			'role' => $this->role->findAll(),
			'validation' => $this->validation
		];

		return view('App\Modules\Surat_masuk\Views/add', $data);
	}

	public function save()
	{
		if( $this->request->isAjax() ) {

			$input = $this->request->getVar();
			$errors = $this->validation->run($input, 'surat_masuk');

			if( $errors ) {

				$data = [
					'file' => '',
					'tanggal' => date('Y-m-d', strtotime($input['tanggal'])),
					'no_surat' => $input['no_surat'],
					'sifat_surat' => strtolower($input['sifat_surat']),
					'pengirim' => strtolower($input['pengirim']),
					'perihal' => strtolower($input['perihal']),
					'isi_surat' => strtolower($input['isi_surat']),
					'unit_kerja_id' => 0,
					'isi_disposisi' => 0,
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => 0
				];

				$this->masuk->insert($data);

				$msg = [
					'data' => view('App\Modules\Surat_masuk\Views/data', ['title' => 'Surat Masuk'])
				];
			} else {
				$msg = [
					'errors' => [
						'no_surat' => $this->validation->getError('no_surat'),
						'tanggal' => $this->validation->getError('tanggal'),
						'sifat_surat' => $this->validation->getError('sifat_surat'),
						'pengirim' => $this->validation->getError('pengirim'),
						'perihal' => $this->validation->getError('perihal'),
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
			'title' => 'Surat Masuk',
			'masuk' => $this->masuk->find($id),
			'validation' => $this->validation
		];

		return view("App\Modules\Surat_masuk\Views/edit", $data);
	}

	public function update()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$unit_kerja_id = $this->request->getVar('unit_kerja_id');
			$isi_disposisi = $this->request->getVar('isi_disposisi');
			$created_date = $this->request->getVar('created_date');
			$input = $this->request->getVar();

			$valid = $this->validation->run($input, 'surat_masuk');

			if( $valid ) {

				$data = [
					'file' => '',
					'tanggal' => date('Y-m-d', strtotime($input['tanggal'])),
					'no_surat' => $input['no_surat'],
					'sifat_surat' => strtolower($input['sifat_surat']),
					'pengirim' => strtolower($input['pengirim']),
					'perihal' => strtolower($input['perihal']),
					'isi_surat' => strtolower($input['isi_surat']),
					'unit_kerja_id' => $unit_kerja_id,
					'isi_disposisi' => $isi_disposisi,
					'created_date' => $created_date,
					'updated_date' => date('Y-m-d H:i:s')
				];

				$this->masuk->update(['id_surat_masuk' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Surat_masuk\Views/data', ['title' => 'Surat Masuk'])
				];

			} else {
				$msg = [
					'errors' => [
						'no_surat' => $this->validation->getError('no_surat'),
						'tanggal' => $this->validation->getError('tanggal'),
						'sifat_surat' => $this->validation->getError('sifat_surat'),
						'pengirim' => $this->validation->getError('pengirim'),
						'perihal' => $this->validation->getError('perihal'),
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

			$this->masuk->delete($id);

			$msg = [
				'data' => view('App\Modules\surat_masuk\Views/data', ['title' => 'Surat Masuk'])
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
					$file->move('public/uploads/surat_masuk/', $new);
					$dok = $new;
				} else {
					unlink('public/uploads/surat_masuk/' . $fileLama);
					$new = $file->getRandomName();
					$file->move('public/uploads/surat_masuk/', $new);
					$dok = $new;
				}

				$this->masuk->update(['id_dokumen' => $id], ['file' => $dok]);

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
				'title' => 'Disposisi Awal Surat Masuk',
				'masuk' => $this->masuk->find($id),
				'unit' => $this->unit->findAll()
			];

			$msg = [
				'data' => view('App\Modules\Surat_masuk\Views/disposisi', $data)
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
				'unit_kerja_id' => [
					'rules' => 'required',
					'errors' => [
						'required' => 'Field disposisi belum dipilih'
					]
				],
				'isi_disposisi' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field isi disposisi belum disii'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'unit_kerja_id' => $input['unit_kerja_id'],
					'isi_disposisi' => strtolower($input['isi_disposisi'])
				];

				$this->masuk->update(['id_surat_masuk' => $id], $data);

				$msg = [
					'data' => view('App\Modules\surat_masuk\Views/data', ['title' => 'Surat Masuk'])
				];

			} else {
				$msg = [
					'error' => [
						'unit_kerja_id' => $this->validation->getError('unit_kerja_id'),
						'isi_disposisi' => $this->validation->getError('isi_disposisi')
					]
				];
			}

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}
}
