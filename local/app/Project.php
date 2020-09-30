<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model
{
    protected $table = 'project';  

    protected $fillable = array('title','employers_id','project_category_id','skills','description','status','publish_date','project_code', 'seo_url','posted_by', 'min_budget', 'max_budget', 'deadline');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cur = DB::table('project')->where('id', $id)->first();
    	if (isset($cur->title)) {
    		$title = $cur->title;
    	} else{
    		$title = '';
    	}
    	return $title;
    }

    public function ProjectCategories()
    {
    	return $this->belongsTo('App\ProjectCategory');
    }

    public function Apply()
    {
        return $this->hasMany('App\ProjectApply');
    }
}
