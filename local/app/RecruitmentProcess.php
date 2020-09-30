<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class RecruitmentProcess extends Model
{
     protected $table = 'recruitment_process';  

    protected $fillable = array('title', 'description');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$process = DB::table('recruitment_process')->where('id',$id)->first();
    	if (isset($process->title)) {
    		$title = $process->title;
    	}else{
    		$title = '';
    	}
    	return $title;
    }
}
