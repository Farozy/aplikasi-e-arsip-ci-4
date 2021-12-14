<?php namespace App\Modules\User\Models;

class userModel extends \App\Models\BaseModel
{
	protected $table = 'user';
	protected $primaryKey = 'id_user';
	protected $allowedFields = [
		'nama_lengkap', 'email', 'username', 'password', 'foto', 'role_id', 'is_active', 'created_date', 'updated_date'
	];
}
