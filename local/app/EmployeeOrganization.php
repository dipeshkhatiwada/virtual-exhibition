<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeOrganization extends Model
{
    protected $table = 'employee_organization';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'org_type_id'
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
