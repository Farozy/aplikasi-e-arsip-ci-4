<?php namespace App\Modules\Role\Models;

class roleModel extends \App\Models\BaseModel
{
	protected $table = 'role';
	protected $primaryKey = 'id_role';
	protected $allowedFields = ['nama_role'];
}
