<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLocation extends Model
{
    protected $table = 'employee_location';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'job_location_id'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
    public function JobLocation()
    {
    	return $this->belongsTo('App\JobLocation');
    }
}
