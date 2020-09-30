<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobProcess;

class JobProcess extends Model
{
    protected $table = 'job_process';  

    protected $fillable = array('title', 'jobs_id','sort_order','email_txt','candidates');
    protected $primaryKey = 'id';

    public function Jobs()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public static function getTitle($id='')
    {
    	$title = '';
    	$process = JobProcess::where('id', $id)->first();
    	if (isset($process->title)) {
    		$title = $process->title;
    	}
    	return $title;
    }
    
}
