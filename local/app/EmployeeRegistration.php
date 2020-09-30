<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeRegistration extends Model
{
    protected $table = 'employee_registration';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name', 'email', 'password', 'middle_name', 'last_name', 'mobile', 'validation_token'
    ];
}
