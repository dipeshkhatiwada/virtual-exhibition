<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequirements extends Model
{
    protected $table = 'job_requirements';  

    protected $fillable = array('jobs_id', 'description', 'specification', 'education_description', 'specific_requirement', 'specific_instruction','detail');

    public $timestamps = false;

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
