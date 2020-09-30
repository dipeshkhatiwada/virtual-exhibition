<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TenderType extends Model
{
    protected $table = 'tender_type';  

    protected $fillable = array('title','seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cur = DB::table('tender_type')->where('id', $id)->first();
    	if (isset($cur->title)) {
    		$title = $cur->title;
    	} else{
    		$title = '';
    	}
    	return $title;
    }
}
