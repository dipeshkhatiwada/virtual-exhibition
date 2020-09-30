<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobTypeOffer extends Model
{
    protected $table = 'job_type_offer';  

    protected $fillable = array('job_type_id', 'title', 'discount_percent','start_date','end_date');
    

    public function JobType()
    {
    	return $this->belongsTo('App\JobType');
    }
}
