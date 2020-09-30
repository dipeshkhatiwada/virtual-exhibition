<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLanguage extends Model
{
    protected $table = 'employee_language';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'language', 'understand', 'speak', 'reading', 'writing', 'mother_t', 'jobs_id', 'sn'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
