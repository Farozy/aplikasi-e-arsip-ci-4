<?php namespace App\Modules\Dokumen\Models;

class dokumenModel extends \App\Models\BaseModel
{
	protected $table = 'dokumen';
	protected $primaryKey = 'id_dokumen';
	protected $allowedFields = [
		'jenis_id', 'nama_dokumen', 'dokumen', 'no_dokumen', 'tahun', 'deskripsi', 'ukuran', 'tanggal_upload', 'download', 'created_date', 'updated_date'
	];

	function sum_download()
	{
		$table = $this->db->table('dokumen')
				->selectSum('download', 'total_download')
				->get()->getRow()->total_download;
		return $table;
	}
}
