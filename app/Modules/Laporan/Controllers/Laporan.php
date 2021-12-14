<?php namespace App\Modules\Laporan\Controllers;

use App\Modules\Role\Models\roleModel;
use App\Modules\Dokumen\Models\dokumenModel;
use App\Modules\Dokumen\Models\dokumenDataModel;
use App\Modules\Jenis\Models\jenisModel;
use App\Modules\Unit_kerja\Models\unitKerjaModel;
use App\Modules\Surat_masuk\Models\suratMasukModel;
use App\Modules\Surat_keluar\Models\suratkeluarModel;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use TCPDF;

class Laporan extends \App\Controllers\BaseController
{
	public function __construct()
	{
		$this->dokumen = new dokumenModel;
		$this->jenis = new jenisModel;
		$this->role = new roleModel;
		$this->unit = new unitKerjaModel;
		$this->masuk = new suratMasukModel;
		$this->keluar = new suratkeluarModel;
		$this->validation = Services::validation();
	}

	public function index()
	{
		$data = [
			'title' => 'Laporan',
			'role' => $this->role->findAll()
		];

		return view('App\Modules\Laporan\Views/view', $data);
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
				$btnDownload = "<a href=\"public/uploads/dokumen/$list->dokumen\" class=\"btn btn-success rounded-circle\" data-toggle=\"tooltip\" title=\"Download Data\" onclick=\"download($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"fas fa-download\"></i></a>";
				$btnEdit = "<a href=\"dokumen/edit/$list->id_dokumen\" class=\"btn btn-warning rounded-circle\" data-toggle=\"tooltip\" title=\"Edit Data\" onclick=\"edit($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5; color: white;\"><i class=\"far fa-edit\"></i></a>";
				$btnHapus = "<button class=\"btn btn-danger btn-sm rounded-circle\" data-toggle=\"tooltip\" title=\"Hapus Data\" onclick=\"hapus($list->id_dokumen)\" style=\" padding: .40rem .40rem; font-size: .875rem; line-height: .5;\"><i class=\"far fa-trash-alt\"></i></button>";

				$row[] = $no;
				$row[] = ucwords($list->nama_jenis);
				$row[] = strtoupper($list->no_dokumen);
				$row[] = date('Y', strtotime($list->tanggal_upload));
				$row[] = 'Arsip ' . ucwords($list->no_dokumen);
				$row[] = $list->ukuran;
				$row[] = date('d-m-Y', strtotime($list->tanggal_upload));
				$row[] = $list->download;

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

	public function laporan_masuk()
	{
		$data = [
			'title' => 'Surat Masuk',
			'unit' => $this->unit->findAll()
		];

		return view('App\Modules\Laporan\Views/data_masuk', $data);
	}

	public function get_masuk()
	{
		if( $this->request->isAjax() ) {
		
			$dari_tanggal = $this->request->getVar('dari_tanggal');
			$sampai_tanggal = $this->request->getVar('sampai_tanggal');
			$unit = $this->request->getVar('pengirim');

			$data = [
				'title' => 'Laporan Surat Masuk',
				'masuk' => $this->masuk->laporan_masuk(date('Y-m-d', strtotime($dari_tanggal)), date('Y-m-d', strtotime($sampai_tanggal)), $unit),
				'data_masuk' => $this->masuk->laporan_masuk(date('Y-m-d', strtotime($dari_tanggal)), date('Y-m-d', strtotime($sampai_tanggal))),
				'unit' => $this->unit->find($unit),
				'unit_kerja' => $this->unit->findAll()
			];

			$msg = [
				// 'data' => $data
				'data' => view('App\Modules\Laporan\Views/get_masuk', $data)
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function export_masuk()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'File');
		$sheet->setCellValue('C1', 'No. Surat');
		$sheet->setCellValue('D1', 'Tanggal');
		$sheet->setCellValue('E1', 'Sifat Surat');
		$sheet->setCellValue('F1', 'Pengirim');
		$sheet->setCellValue('G1', 'Perihal');
		$sheet->setCellValue('H1', 'Isi Surat');
		$sheet->setCellValue('I1', 'Unit Kerja Id');
		$sheet->setCellValue('J1', 'isi_disposisi');
		$sheet->setCellValue('K1', 'created_date');
		$sheet->setCellValue('L1', 'updated_date');

		$masuk = $this->masuk->findAll();
		$no = 1;
		$x = 2;
		foreach($masuk as $row)
		{
			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $row['file']);
			$sheet->setCellValue('C'.$x, ucwords($row['no_surat']));
			$sheet->setCellValue('D'.$x, date('d-m-Y', strtotime($row['tanggal'])));
			$sheet->setCellValue('E'.$x, ucwords($row['sifat_surat']));
			$sheet->setCellValue('F'.$x, ucwords($row['pengirim']));
			$sheet->setCellValue('G'.$x, ucfirst($row['perihal']));
			$sheet->setCellValue('H'.$x, ucfirst($row['isi_surat']));
			$sheet->setCellValue('I'.$x, $row['unit_kerja_id']);
			$sheet->setCellValue('J'.$x, ucfirst($row['isi_disposisi']));
			$sheet->setCellValue('K'.$x, date('d-m-Y H:i:s', strtotime($row['created_date'])));
			$sheet->setCellValue('L'.$x, $row['updated_date'] == false ? 0 : date('d-m-Y H:i:s', strtotime($row['updated_date'])));
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Surat Masuk';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function laporan_keluar()
	{
		$data = [
			'title' => 'Surat Keluar',
			'unit' => $this->unit->findAll()
		];

		return view('App\Modules\Laporan\Views/data_keluar', $data);
	}

	public function get_keluar()
	{
		if( $this->request->isAjax() ) {
		
			$dari_tanggal = $this->request->getVar('dari_tanggal');
			$sampai_tanggal = $this->request->getVar('sampai_tanggal');
			$unit = $this->request->getVar('pengirim');

			$data = [
				'title' => 'Laporan Surat Keluar',
				'keluar' => $this->keluar->laporan_keluar(date('Y-m-d', strtotime($dari_tanggal)), date('Y-m-d', strtotime($sampai_tanggal)), $unit),
				'data_keluar' => $this->keluar->laporan_keluar(date('Y-m-d', strtotime($dari_tanggal)), date('Y-m-d', strtotime($sampai_tanggal))),
				'unit' => $this->unit->find($unit),
				'unit_kerja' => $this->unit->findAll()
			];

			$msg = [
				// 'data' => $data
				'data' => view('App\Modules\Laporan\Views/get_keluar', $data)
			];

			return $this->response->setJSON($msg);
		
		} else {
			return redirect()->back();
		}
	}

	public function export_keluar()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'File');
		$sheet->setCellValue('C1', 'No. Surat');
		$sheet->setCellValue('D1', 'Tanggal');
		$sheet->setCellValue('E1', 'Sifat Surat');
		$sheet->setCellValue('F1', 'Pengirim');
		$sheet->setCellValue('G1', 'Perihal');
		$sheet->setCellValue('H1', 'Tertuju');
		$sheet->setCellValue('I1', 'Alamat');
		$sheet->setCellValue('J1', 'Isi Surat');
		$sheet->setCellValue('K1', 'Disposisi');
		$sheet->setCellValue('L1', 'Tanggal Disposisi');
		$sheet->setCellValue('M1', 'Keterangan Disposisi');
		$sheet->setCellValue('N1', 'created_date');
		$sheet->setCellValue('O1', 'updated_date');

		$keluar = $this->keluar->findAll();
		$no = 1;
		$x = 2;
		foreach($keluar as $row)
		{
			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $row['file']);
			$sheet->setCellValue('C'.$x, ucwords($row['no_surat']));
			$sheet->setCellValue('D'.$x, date('d-m-Y', strtotime($row['tanggal'])));
			$sheet->setCellValue('E'.$x, ucwords($row['sifat_surat']));
			$sheet->setCellValue('F'.$x, $row['pengirim']);
			$sheet->setCellValue('G'.$x, ucfirst($row['perihal']));
			$sheet->setCellValue('H'.$x, ucfirst($row['tertuju']));
			$sheet->setCellValue('I'.$x, ucfirst($row['alamat']));
			$sheet->setCellValue('J'.$x, ucfirst($row['isi_surat']));
			$sheet->setCellValue('K'.$x, ucwords($row['disposisi']));
			$sheet->setCellValue('L'.$x, date('d-m-Y', strtotime($row['tanggal_disposisi'])));
			$sheet->setCellValue('M'.$x, ucfirst($row['ket_disposisi']));
			$sheet->setCellValue('N'.$x, date('d-m-Y H:i:s', strtotime($row['created_date'])));
			$sheet->setCellValue('O'.$x, $row['updated_date'] == false ? 0 : date('d-m-Y H:i:s', strtotime($row['updated_date'])));
			$x++;
		}
		$writer = new Xlsx($spreadsheet);
		$filename = 'Laporan Surat Keluar';
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
