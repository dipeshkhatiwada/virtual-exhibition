<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerRegistration extends Model
{
    protected $table = 'employer_reg';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'employer_id', 'email', 'password', 'phone', 'org_type', 'vtoken',
    ];
}
