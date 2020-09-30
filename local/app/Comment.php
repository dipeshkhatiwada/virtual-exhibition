<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';  
    protected $guarded = [];
    
    public function employee()
    {
    	return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function employer()
    {
    	return $this->belongsTo('App\EmployerUser', 'employers_id');
    }

    public function replies()
    {
    	return $this->hasMany('App\Comment', 'parent_id');
    }
}
