<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class BlogCategory extends Model
{
    protected $table = 'blog_category';  

    protected $fillable = array('title','seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id='')
    {
    	$title = '';
    	$category = DB::table('blog_category')->where('id',$id)->first();
    	if (isset($category->title)) {
    		$title = $category->title;
    	}
    	return $title;
    }

    public static function getSeourl($id='')
    {
    	$seo_url = '';
    	$category = DB::table('blog_category')->where('id',$id)->first();
    	if (isset($category->seo_url)) {
    		$seo_url = $category->seo_url;
    	}
    	return $seo_url;
    }
}
