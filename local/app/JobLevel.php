<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobLevel extends Model
{
     protected $table = 'job_level';  

    protected $fillable = array('name');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$level = DB::table('job_level')->where('id', $id)->first();
    	if (isset($level->name)) {
    		$title = $level->name;
    	} else {
    		$title = '';
    	}
    	return $title;
    }
}
