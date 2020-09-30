<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerNotice extends Model
{
    protected $table = 'employer_notice';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'title', 'seo_url', 'description', 'date' 
    ];
    
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }
}
