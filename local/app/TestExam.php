<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\TestAnswer;

class TestExam extends Model
{
    protected $table = 'test_exam';  

    protected $fillable = array('title', 'category_id', 'description', 'number_of_question', 'image', 'seo_url');
    protected $primaryKey = 'id';

    public static function getTitle($id)
    {
    	$cat = DB::table('test_exam')->where('id', $id)->first();
    	if (isset($cat->title)) {
    		return $cat->title;
    	}else{
    		return '';
    	}
    }

    public function TestQuestions()
    {
        return $this->hasMany('App\TestQuestion');
    }

    public static function countTests($id='')
    {
        return TestAnswer::where('test_id', $id)->count();
    }
}
