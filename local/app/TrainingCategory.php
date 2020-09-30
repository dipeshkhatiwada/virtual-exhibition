<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TrainingCategory extends Model
{
     protected $table = 'training_category';  

    protected $fillable = array('title', 'seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cur = DB::table('training_category')->where('id', $id)->first();
    	if (isset($cur->title)) {
    		$title = $cur->title;
    	} else{
    		$title = '';
    	}
    	return $title;
    }

    public function Trainings()
    {
    	return $this->hasMany('App\Training');
    }

    public static function getUrl($id)
    {
        $cur = DB::table('training_category')->where('id', $id)->first();
        if (isset($cur->seo_url)) {
            $title = $cur->seo_url;
        } else{
            $title = '';
        }
        return $title;
    }
}
