<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerUserPasswordReset extends Model
{
     protected $table = 'employer_user_password_resets';  

    
   
    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    public $timestamps = false;
}
