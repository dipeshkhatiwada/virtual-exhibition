<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $table = 'test_question';  

    protected $fillable = array('test_exam_id', 'question', 'answer', 'image', 'hard_level', 'correct_answer', 'time_second');
    protected $primaryKey = 'id';

    public function TestExam()
    {
    	return $this->belongsTo('App\TestExam');
    }
}
