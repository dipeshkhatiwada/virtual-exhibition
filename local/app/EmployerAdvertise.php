<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerAdvertise extends Model
{
    protected $table = 'employer_advertise';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'title', 'href', 'image', 'place'
    ];
    
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
}
