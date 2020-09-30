<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Size extends Model
{
    protected $table = 'organization_size';  

    protected $fillable = array('name');
    protected $primaryKey = 'id';


    public static function getTitle($id)
    {
    	$size = DB::table('organization_size')->where('id', $id)->first();
    	if (isset($size->name)) {
    		# code...
    		$title = $size->name;
    	}else {
    		$title = '';
    	}

    	return $title;
    }
}
