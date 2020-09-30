<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalInterview extends Model
{
     protected $table = 'final_interview';  

    protected $fillable = array('jobs_id', 'employees_id');
    protected $primaryKey = 'id';

    public function Jobs()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }
}
