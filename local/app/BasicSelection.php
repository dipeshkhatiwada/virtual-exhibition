<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicSelection extends Model
{
    protected $table = 'basic_salaction';  

    protected $fillable = array('jobs_id', 'employees_id');

    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
