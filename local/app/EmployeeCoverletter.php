<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeCoverletter extends Model
{
     protected $table = 'employee_coverletter';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'title', 'detail'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
