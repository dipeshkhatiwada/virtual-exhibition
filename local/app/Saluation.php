<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Saluation extends Model
{
    protected $table = 'saluation'; 

    protected $fillable = array('name');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$salutation = DB::table('saluation')->where('id', $id)->first();
    	if (isset($salutation->name)) {
    		$title = $salutation->name;
    	} else{
    		$title = '';
    	}
    	return $title;
    }
}
