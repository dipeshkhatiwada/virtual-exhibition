<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $table = 'employee_education';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'country', 'level_id', 'faculty_id', 'specialization', 'institution', 'board', 'percentage', 'pg', 'marksystem', 'year', 'jobs_id', 'employers_id','sn', 'document'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
    public function Faculty()
    {
    	return $this->belongsTo('App\Faculty');
    }
    public function EducationLevel()
    {
    	return $this->belongsTo('App\EducationLevel');
    }
}
