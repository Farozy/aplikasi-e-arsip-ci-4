<?php namespace App\Modules\Unit_kerja\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Unit_kerja\Models\unitKerjaModel;
use App\Modules\Unit_kerja\Models\unitKerjaDataModel;
use Config\Services;

class Unit_kerja extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->unit = new unitKerjaModel;
		$this->role = new roleModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Unit Kerja',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Unit_kerja\Views/view', $data);
	}

	public function listData()
	{
		$request = Services::request();
		$datamodel = new unitKerjaDataModel($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];

				$btnEdit = "<button class=\"btn btn-warning btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_unit_kerja)\"><i class=\"far fa-edit\"></i></button>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_unit_kerja)\"><i class=\"far fa-trash-alt\"></i></button>";
				$btnActive = "<button class=\"btn btn-success btn-sm rounded-circle\" value=\"$list->id_unit_kerja\" data-toggle=\"tooltip\" onclick=\"active($list->id_unit_kerja)\" title=\"Non-Aktifkan\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-success\"></span></div>";
				$btnNonActive = "<button class=\"btn btn-danger btn-sm rounded-circle\" onclick=\"nonActive($list->id_unit_kerja)\" data-toggle=\"tooltip\" title=\"Aktifkan\"><i class=\"fa fa-fw fa-power-off\"></i></button><div><span class=\"badge badge-danger\"></span></div>";

				$row[] = $no;
				$row[] = ucwords($list->nama_unit_kerja);
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
				'title' => 'Tambah Unit Kerja / Bagian',
			];

			$msg = [
				'data' => view('App\Modules\Unit_kerja\Views/add', $data)
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
				'nama_unit_kerja' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field nama unit kerja belum diisi'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'nama_unit_kerja' => strtolower($input['nama_unit_kerja']),
					'created_date' => date('Y-m-d H:i:s'),
					'updated_date' => 0
				];

				$this->unit->insert($data);

				$msg = [
					'data' => view('App\Modules\Unit_kerja\Views/data', ['title' => 'Unit Kerja'])
				];

			} else {
				$msg = [
					'error' => [
						'nama_unit_kerja' => $this->validation->getError('nama_unit_kerja'),
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
				'title' => 'Edit Unit Kerja',
				'unit' => $this->unit->find($id)
			];

			$msg = [
				'data' => view('App\Modules\Unit_kerja\Views/edit', $data)
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
				'nama_unit_kerja' => [
					'rules' => 'trim|required',
					'errors' => [
						'required' => 'Field nama unit kerja belum diisi'
					]
				]
			]);

			if( $valid ) {

				$data = [
					'nama_unit_kerja' => strtolower($input['nama_unit_kerja']),
					'created_date' => $input['created_date'],
					'updated_date' => date('Y-m-d H:i:s')
				];

				$this->unit->update(['id_unit_kerja' => $id], $data);

				$msg = [
					'data' => view('App\Modules\Unit_kerja\Views/data', ['title' => 'Unit Kerja'])
				];

			} else {
				$msg = [
					'error' => [
						'nama_unit_kerja' => $this->validation->getError('nama_unit_kerja'),
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

			$this->unit->delete($id);

			$msg = [
				'data' => view('App\Modules\Unit_kerja\Views/data', ['title' => 'Unit Kerja'])
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}
}
