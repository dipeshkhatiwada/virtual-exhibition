<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestAnswer extends Model
{
    protected $table = 'test_answer';  

    protected $fillable = array('test_id', 'employes_id', 'questions', 'marks', 'title', 'duration', 'answer_date', 'right_answer');
    protected $primaryKey = 'id';
}
