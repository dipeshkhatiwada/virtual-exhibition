<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaveJob extends Model
{
     protected $table = 'save_jobs';  

    protected $fillable = array('jobs_id', 'employees_id');
    


    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

   public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }
}
