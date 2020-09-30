<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    protected $table = 'question_comment';  

    protected $fillable = array('employes_id', 'question_id', 'comment','right_wrong','right_answer');
    protected $primaryKey = 'id';
}
