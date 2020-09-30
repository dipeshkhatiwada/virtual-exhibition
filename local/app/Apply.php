<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Apply extends Model
{
    protected $table = 'apply';  

    protected $fillable = array('jobs_id', 'employees_id','apply_status');

    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public static function getStatus($status = NULL)
    {
        if ($status == 0) {
            $stat = 'Under Approval';
        } elseif ($status == 1) {
            $stat = 'Approved';
        } elseif ($status == 2) {
            $stat = 'Selected for Interview';
        } else {
            $stat = '';
        }
        return $stat;
    }
    
}
