<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSkills extends Model
{
    protected $table = 'employees_skills';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'title', 'endorsed'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
