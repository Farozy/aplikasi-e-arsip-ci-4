<?php namespace App\Modules\Dashboard\Models;

class fullCalendarModel extends \App\Models\BaseModel
{
	protected $table = 'tbl_events';
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'title', 'start', 'end'
	];
}
