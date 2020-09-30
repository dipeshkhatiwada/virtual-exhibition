<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobExperience extends Model
{
    protected $table = 'job_experience';  

    protected $fillable = array('jobs_id', 'experience_id', 'experience', 'exp_format');
    protected $primaryKey = 'id';


    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public function Experience()
    {
    	return $this->belongsTo('App\Experience');
    }
}
