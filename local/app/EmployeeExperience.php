<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model
{
    protected $table = 'employee_experience';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'organization', 'typeofemployment', 'org_type_id', 'designation', 'level', 'from', 'to', 'currently_working', 'country', 'jobs_id', 'sn', 'experience', 'employers_id','status', 'document'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
    public function OrganizationType()
    {
    	return $this->belongsTo('App\OrganizationType');
    }
}
