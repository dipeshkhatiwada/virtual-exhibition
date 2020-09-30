<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobEducation extends Model
{
    protected $table = 'job_education';  

    protected $fillable = array('jobs_id', 'education_level_id', 'faculty_id', 'experience', 'exp_format', 'percent', 'cgpa', 'others');
    protected $primaryKey = 'id';


    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public function EducationLevel()
    {
    	return $this->belongsTo('App\EducationLevel');
    }
    
}
