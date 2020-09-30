<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobPrice extends Model
{
    protected $table = 'job_pricing';  

    protected $fillable = array('job_type_id', 'no_of_post', 'seven_days', 'fourteen_days', 'twentyone_days', 'thirty_days');
    protected $primaryKey = 'id';

     public function JobType()
    
    {
    	return $this->belongsTo('App\JobType');
    }
}
