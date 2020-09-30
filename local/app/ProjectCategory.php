<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProjectCategory extends Model
{
    protected $table = 'project_category';  

    protected $fillable = array('title', 'seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cur = DB::table('project_category')->where('id', $id)->first();
    	if (isset($cur->title)) {
    		$title = $cur->title;
    	} else{
    		$title = '';
    	}
    	return $title;
    }

    public function Projects()
    {
    	return $this->hasMany('App\Project');
    }

    public static function getUrl($id)
    {
        $cur = DB::table('project_category')->where('id', $id)->first();
        if (isset($cur->seo_url)) {
            $title = $cur->seo_url;
        } else{
            $title = '';
        }
        return $title;
    }
}
