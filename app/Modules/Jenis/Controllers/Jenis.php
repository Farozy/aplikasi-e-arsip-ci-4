<?php namespace App\Modules\Jenis\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Jenis\Models\jenisModel;
use App\Modules\Jenis\Models\jenisDataModel;
use Config\Services;

class Jenis extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->jenis = new jenisModel;
		$this->role = new roleModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Jenis Dokumen',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Jenis\Views/view', $data);
	}

	public function listData()
	{
		$request = Services::request();
		$datamodel = new jenisDataModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];

				$btnEdit = "<button class=\"btn btn-warning btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_jenis)\"><i class=\"far fa-edit\"></i></button>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_jenis)\"><i class=\"far fa-trash-alt\"></i></button>";
				$btnActive = "<button class=\"btn btn-success btn-sm rounded-circle\" value=\"$list->id_jenis\" data-toggle=\"tooltip\" onclick=\"active($list->id_jenis)\" title=\"Non-Aktifkan\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-success\"></span></div>";
				$btnNonActive = "<button class=\"btn btn-danger btn-sm rounded-circle\" onclick=\"nonActive($list->id_jenis)\" data-toggle=\"tooltip\" title=\"Aktifkan\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-danger\"></span></div>";

				$row[] = $no;
				$row[] = ucwords($list->nama_jenis);
				$row[] = $list->status_jenis ? $btnActive : $btnNonActive ;
				$row[] = $btnEdit." ".$btnHapus;

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
		if( $this->request->isAjax() ) {

			$data = [
				'title' => 'Tambah Data Jenis',
			];

			$msg = [
				'data' => view('App\Modules\Jenis\Views/add', $data)
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function save()
	{
		if( $this->request->isAjax() ) {

			$input = $this->request->getVar();

			$valid = $this->validate([
				'nama_jenis' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field nama dokumen belum diisi'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'nama_jenis' => strtolower($input['nama_jenis']),
					'status_jenis' => 0,
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => 0
				];

				$this->jenis->insert($data);

				$msg = [
					'data' => view('App\Modules\Jenis\Views/data', ['title' => 'Jenis Dokumen'])
				];

			} else {
				$msg = [
					'error' => [
						'nama_jenis' => $this->validation->getError('nama_jenis'),
					]
				];
			}

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function edit()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');

			$data = [
				'title' => 'Edit Jenis Dokumen',
				'jenis' => $this->jenis->find($id)
			];

			$msg = [
				'data' => view('App\Modules\Jenis\Views/edit', $data)
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function update()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$input = $this->request->getVar();

			$valid = $this->validate([
				'nama_jenis' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field nama dokumen belum diisi'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'nama_jenis' => strtolower($input['nama_jenis']),
					'status_jenis' => $input['status_jenis'],
					'created_date' => $input['created_date'],
					'updated_date' => date('Y-m-d H:i:s')
				];

				$this->jenis->update(['id_jenis' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Jenis\Views/data', ['title' => 'Jenis Dokumen'])
				];

			} else {
				$msg = [
					'error' => [
						'nama_jenis' => $this->validation->getError('nama_jenis'),
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

			$this->jenis->delete($id);

			$msg = [
				'data' => view('App\Modules\Jenis\Views/data', ['title' => 'Jenis Dokumen'])
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
}
