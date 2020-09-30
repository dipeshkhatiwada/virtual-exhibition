<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class DepartmentUsers extends Authenticatable
{
   
    
   protected $table = 'department_user';  

    protected $fillable = array('department_id', 'name', 'email', 'password', 'remember_token', 'status');
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}