<?php namespace App\Modules\Surat_keluar\Models;

class suratkeluarModel extends \App\Models\BaseModel
{
	protected $table = 'surat_keluar';
	protected $primaryKey = 'id_surat_keluar';
	protected $allowedFields = [
		'file', 'no_surat', 'tanggal', 'sifat_surat', 'pengirim', 'perihal', 'tertuju', 'alamat', 'isi_surat', 'disposisi', 'tanggal_disposisi', 'ket_disposisi', 'created_date', 'updated_date'
	];

	function laporan_keluar($dari_tanggal, $sampai_tanggal, $unit = null)
	{
		if( empty($unit) ) {
			return $this->db->table('surat_keluar')
				->select('*')
				->where("tanggal >=", $dari_tanggal)
				->where("tanggal <=", $sampai_tanggal)
				->get()->getResultArray();
		} else {
			return $this->db->table('surat_keluar')
				->select('*')
				->where("tanggal >=", $dari_tanggal)
				->where("tanggal <=", $sampai_tanggal)
				->where('pengirim', $unit)
				->get()->getResultArray();
		}
	}
}
