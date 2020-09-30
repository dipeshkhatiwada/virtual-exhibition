<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeePasswordReset extends Model
{
    protected $table = 'employee_password_resets';  

    
   
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    public $timestamps = false;
    
}
