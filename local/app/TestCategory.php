<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TestCategory extends Model
{
    protected $table = 'test_category';  

    protected $fillable = array('title', 'description', 'seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cat = DB::table('test_category')->where('id', $id)->first();
    	if (isset($cat->title)) {
    		return $cat->title;
    	}else{
    		return '';
    	}
    }
}
