<?php
/**
	Website: Jagowebdev.com
*/

namespace App\Models;

class BaseModel extends \CodeIgniter\Model 
{
	public function __construct() {
		parent::__construct();
	}
	
	public function getAppLayoutSetting() {
		// Mendapatkan layout aplikasi
	}
}