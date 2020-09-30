<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Employee extends Authenticatable
{
   
    
    protected $fillable = [
        'saluation', 'email', 'password', 'firstname', 'middlename', 'lastname', 'gender', 'dob', 'marital_status', 'nationality', 'image', 'resume', 'coverletter', 'status', 'remember_token', 'present_salary', 'expected_salary'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function employeeAddress()
    {
    	return $this->hasOne('App\EmployeeAddress', 'employees_id');
    }

    public function eventReservation()
    {
        return $this->hasMany('App\EventReservation', 'employee_id');
    }

    public function eventInvoiceStatus()
    {
        return $this->hasOne('App\EventInvoiceStatus', 'employee_id');
    }
}