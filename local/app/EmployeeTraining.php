<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeTraining extends Model
{
    protected $table = 'employee_training';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'title', 'details', 'institution', 'duration', 'year', 'jobs_id', 'sn', 'employers_id', 'document'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
