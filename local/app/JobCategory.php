<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobCategory extends Model
{
    protected $table = 'job_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'seo_url'
    ];
    public $timestamps = false;
    
    public static function getTitle($id)
    {
    	$category = DB::table('job_category')->where('id', $id)->first();
    	if (isset($category->name)) {
    		$title = $category->name;
    	}else {
    		$title = '';
    	}
    	return $title;
    }
}
