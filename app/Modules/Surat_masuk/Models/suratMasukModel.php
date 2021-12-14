<?php namespace App\Modules\Surat_masuk\Models;

class suratMasukModel extends \App\Models\BaseModel
{
	protected $table = 'surat_masuk';
	protected $primaryKey = 'id_surat_masuk';
	protected $allowedFields = [
		'file', 'no_surat', 'tanggal', 'sifat_surat', 'pengirim', 'perihal', 'isi_surat', 'unit_kerja_id', 'isi_disposisi', 'created_date', 'updated_date'
	];

	function laporan_masuk($dari_tanggal, $sampai_tanggal, $unit = null)
	{
		if( empty($unit) ) {
			return $this->db->table('surat_masuk')
				->select('*')
				->where("tanggal >=", $dari_tanggal)
				->where("tanggal <=", $sampai_tanggal)
				->get()->getResultArray();
		} else {
			return $this->db->table('surat_masuk')
				->select('*')
				->where("tanggal >=", $dari_tanggal)
				->where("tanggal <=", $sampai_tanggal)
				->where('unit_kerja_id', $unit)
				->get()->getResultArray();
		}
	}
}
