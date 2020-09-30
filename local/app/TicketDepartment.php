<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TicketDepartment;

class TicketDepartment extends Model
{
     protected $table = 'ticket_department';  

    protected $fillable = array('title', 'status');
    protected $primaryKey = 'id';

    public function DepartmentUsers()
    {
    	return $this->hasMany('DepartmentUsers');
    }

    public static function getTitle($id='')
    {
    	$title = '';
    	$department = TicketDepartment::where('id', $id)->first();
    	if (isset($department->title)) {
    		$title = $department->title;
    	}
    	return $title;
    }
}
