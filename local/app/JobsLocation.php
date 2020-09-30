<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsLocation extends Model
{
     protected $table = 'jobs_location';  

    protected $fillable = array('jobs_id', 'location_id');
    public $timestamps = false;

    public function Locations()
    {
    	return $this->belongsTo('App\JobLocation');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
