<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentUser extends Model
{
    protected $table = 'department_user';  

    protected $fillable = array('department_id', 'name', 'email', 'password', 'remember_token', 'status');
    protected $primaryKey = 'id';
}
