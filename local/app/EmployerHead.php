<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerHead extends Model
{
    //
    protected $table = 'employer_head';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'saluation', 'name', 'designation' 
    ];
    public $timestamps = false;
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
}
