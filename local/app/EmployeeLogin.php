<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLogin extends Model
{
    protected $table = 'employee_login';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employees_id', 'login_ip'
    ];
    
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
