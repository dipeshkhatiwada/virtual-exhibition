<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployerUsers extends Authenticatable
{
    protected $table = 'employer_user';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'employers_id', 'designation', 'image', 'user_type', 'remember_token', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employerPaymentMethods()
    {
    	return $this->hasMany('App\PivotEmployerPaymentMethod', 'employers_id', 'employers_id');
    }
}
