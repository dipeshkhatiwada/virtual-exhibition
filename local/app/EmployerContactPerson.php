<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerContactPerson extends Model
{
    protected $table = 'employer_contact_person';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'saluation', 'name', 'designation', 'phone', 'email'
    ];
    public $timestamps = false;
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
}
