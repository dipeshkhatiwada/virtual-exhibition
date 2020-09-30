<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerAddress extends Model
{
    protected $table = 'employer_address';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'phone', 'secondary_email', 'fax', 'pobox', 'website', 'address'
    ];
    public $timestamps = false;
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
}
