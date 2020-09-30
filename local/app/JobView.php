<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobView extends Model
{
    protected $table = 'job_view';  

    protected $fillable = array('jobs_id', 'ipaddress');
    


    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

  
}
