<?php namespace App\Modules\Dashboard\Controllers;

// use App\Modules\Dashboard\Models\fullCalendarModel;
use App\Modules\Role\Models\roleModel;
use App\Modules\User\Models\userModel;
use App\Modules\Dokumen\Models\dokumenModel;
use App\Modules\Jenis\Models\jenisModel;
use App\Modules\Surat_masuk\Models\suratMasukModel;
use App\Modules\Surat_keluar\Models\suratkeluarModel;
use App\Modules\Unit_kerja\Models\unitKerjaModel;
use Config\Services;

class Dashboard extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->role = new roleModel;
		// $this->calendar = new fullCalendarModel;
		$this->user = new userModel;
		$this->dokumen = new dokumenModel;
		$this->jenis = new jenisModel;
		$this->masuk = new suratMasukModel;
		$this->keluar = new suratkeluarModel;
		$this->unit = new unitKerjaModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data_masuk = $this->masuk->where('tanggal', date('Y-m-d'))->get()->getResultArray();
		$data = [
			'title' => 'dashboard',
			'role' => $this->role->findAll(),
			'user' => $this->user->findAll(),
			'dok' => $this->dokumen->findAll(),
			'jenis' => $this->jenis->findAll(),
			'masuk' => $this->masuk->findAll(),
			'keluar' => $this->keluar->findAll(),
			'download' => $this->dokumen->sum_download(),
			'unit' => $this->unit->findAll(),
			'data_masuk' => $data_masuk
		];

		return view('App\Modules\Dashboard/Views/view', $data);
	}

	public function fetch_event()
	{
		$json = array();
		$sqlQuery = $this->calendar->findAll();

		$eventArray = array();
		foreach ( $sqlQuery as $row ) {
			array_push($eventArray, $row);
		}

		echo json_encode($eventArray);
	}

	public function add_event()
	{
		if( $this->request->isAjax() ) {

			$title = $this->request->getVar('title');
			$start = $this->request->getVar('start');
			$end = $this->request->getVar('end');

			$input = [
				'title' => $title,
				'start' => $start,
				'end' => $end
			];

			$this->calendar->insert($input);

			$data = [
				'title' => 'dashboard',
				'role' => $this->role->findAll(),
				'guru' => $this->guru->findAll(),
				'kelas' => $this->kelas->findAll(),
				'siswa' => $this->siswa->findAll(),
				'user' => $this->user->findAll(),
				'info' => $this->info->findAll(),
				'debit' => $this->debit->findAll(),
				'kredit' => $this->kredit->findAll()
			];

			$msg = [
				'data' => view('App\Modules\Dashboard/Views/admin', $data)
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function edit_event()
	{
		if( $this->request->isAjax() ) {

			$id = $this->request->getVar('id');
			$title = $this->request->getVar('title');
			$start = $this->request->getVar('start');
			$end = $this->request->getVar('end');

			$input = [
				'title' => $title,
				'start' => $start,
				'end' => $end
			];

			$this->calendar->update(['id' => $id],$input);

			$data = [
				'title' => 'dashboard',
				'role' => $this->role->findAll(),
				'guru' => $this->guru->findAll(),
				'kelas' => $this->kelas->findAll(),
				'siswa' => $this->siswa->findAll(),
				'user' => $this->user->findAll(),
				'info' => $this->info->findAll(),
				'debit' => $this->debit->findAll(),
				'kredit' => $this->kredit->findAll()
			];

			$msg = [
				'data' => view('App\Modules\Dashboard/Views/admin', $data)
			];

			return $this->response->setJSON($msg);

		} else {
			return redirect()->back();
		}
	}

	public function delete_event()
	{		
		if( $this->request->isAjax() ) {
		
			$id = $this->request->getVar('id');
			
			$this->calendar->delete($id);

			$data = [
				'title' => 'dashboard',
				'role' => $this->role->findAll(),
				'guru' => $this->guru->findAll(),
				'kelas' => $this->kelas->findAll(),
				'siswa' => $this->siswa->findAll(),
				'user' => $this->user->findAll(),
				'info' => $this->info->findAll(),
				'debit' => $this->debit->findAll(),
				'kredit' => $this->kredit->findAll()
			];

			$msg = [
				'data' => view('App\Modules\Dashboard/Views/admin', $data)
			];

			return $this->response->setJSON($msg); 
		
		} else {
			return redirect()->back();
		}
	}
}
