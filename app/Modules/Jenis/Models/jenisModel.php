<?php namespace App\Modules\Jenis\Models;

class jenisModel extends \App\Models\BaseModel
{
	protected $table = 'jenis';
	protected $primaryKey = 'id_jenis';
	protected $allowedFields = [
		'nama_jenis', 'status_jenis'
	];
}
