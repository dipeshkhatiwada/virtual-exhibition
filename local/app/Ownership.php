<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Ownership extends Model
{
    protected $table = 'ownership';  

    protected $fillable = array('name');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$ownership = DB::table('ownership')->where('id', $id)->first();
    	if (isset($ownership->name)) {
    		$title = $ownership->name;
    		# code...
    	} else{
    		$title = '';
    	}
    	return $title;
    }
}
