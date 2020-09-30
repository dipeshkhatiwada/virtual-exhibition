<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerPasswordReset extends Model
{
    protected $table = 'employer_password_resets';  

    
   
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    public $timestamps = false;
    
}
