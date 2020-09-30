<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $table = 'form_data';  

    protected $fillable = array('jobs_id', 'employees_id', 'job_form_id', 'f_description', 'type', 'marks', 'sn');
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
