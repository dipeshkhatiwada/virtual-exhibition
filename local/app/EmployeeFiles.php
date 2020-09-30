<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeFiles extends Model
{
   protected $table = 'employee_files';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'title', 'file_location'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
    
}
