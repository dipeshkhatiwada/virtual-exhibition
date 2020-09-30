<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
     protected $table = 'employee_category';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'job_category_id'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }

    public function JobCategory()
    {
    	return $this->belongsTo('App\JobCategory');
    }
}
