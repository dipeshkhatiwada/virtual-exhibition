<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeReference extends Model
{
    protected $table = 'employee_reference';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'name', 'designation', 'address', 'office_phone', 'mobile', 'email', 'company', 'jobs_id', 'sn'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
    
     public function Comments()
    {
        return $this->hasOne('App\ReferenceComment');
    }
}
