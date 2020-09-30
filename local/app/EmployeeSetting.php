<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeSetting extends Model
{
     protected $table = 'employee_setting';  

    
    protected $primaryKey = 'id';
     protected $fillable = [
        'employees_id', 'travel', 'license', 'licenseof', 'relocation', 'have_vehical', 'vehical', 'searchable', 'confidention', 'alertable','age', 'total_experience', 'find_you', 'circle_request', 'email_privacy', 'phone_privacy', 'circle_privacy', 'name_privacy', 'score_privacy', 'visit_privacy','socials'
    ];
    public $timestamps = false;
    public function Employee()
    {
    	return $this->belongsTo('App\Employees');
    }
}
