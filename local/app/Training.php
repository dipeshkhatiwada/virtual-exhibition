<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Training extends Model
{
  

    protected $table = 'training';  
    protected $fillable = [
        'employers_id', 'title', 'meta_title', 'meta_keyword', 'meta_description', 'seo_url', 'description', 'image', 'venue', 'address', 'start_time', 'end_time', 'latitude', 'longitude', 'start_date', 'end_date', 'price', 'status', 'training_category_id'
    ];



    public function Apply()
    {
        return $this->hasMany('App\TrainingApply');
    }

    public function TrainingCategory()
    {
    	return $this->belongsTo('App\TrainingCategory');
    }

    public function Employers()
    {
    	return $this->belongsTo('App\Employers');
    }

    public static function getTitle($id='')
    {
        $training = DB::table('training')->select('title')->where('id', $id)->first();
        if (isset($training->title)) {
            $title = $training->title;
        }else{
            $title = '';
        }
        return $title;
    } 

    public static function getDate($id='')
    {
        $training = DB::table('training')->select('start_date', 'end_date')->where('id', $id)->first();
        if (isset($training->start_date)) {
            $start_date = $training->start_date.' to '.$training->end_date;
        }else{
            $start_date = '';
        }
        return $start_date;
    } 

    public static function getTime($id='')
    {
        $training = DB::table('training')->select('start_time', 'end_time')->where('id', $id)->first();
        if (isset($training->start_time)) {
            $start_time  =  date("g:iA", strtotime($training->start_time));
            $end_time  =  date("g:iA", strtotime($training->end_time));
            $title = $start_time.' to '.$end_time;
        }else{
            $title = '';
        }
        return $title;
    } 

   

    public static function getOrgName($id='')
    {
        $training = DB::table('training')->select('employers_id')->where('id', $id)->first();
        if (isset($training->employers_id)) {
            $title = \App\Employers::getName($training->employers_id);
        }else{
            $title = '';
        }
        return $title;
    } 


}
