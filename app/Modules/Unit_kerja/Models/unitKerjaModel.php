<?php namespace App\Modules\Unit_kerja\Models;

class unitKerjaModel extends \App\Models\BaseModel
{
	protected $table = 'unit_kerja';
	protected $primaryKey = 'id_unit_kerja';
	protected $allowedFields = [
		'nama_unit_kerja', 'created_date', 'updated_date'
	];
}
