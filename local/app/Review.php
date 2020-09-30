<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'review';  
    protected $guarded = [];
    
    public function employee()
    {
    	return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function employer()
    {
    	return $this->belongsTo('App\EmployerUser', 'employers_id');
    }
}
