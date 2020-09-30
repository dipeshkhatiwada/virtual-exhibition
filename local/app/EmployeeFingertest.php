<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeFingertest extends Model
{
    protected $table = 'employee_finger_score';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'language', 'correct', 'incorrect', 'keystrokes', 'wpm', 'accuracy'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
