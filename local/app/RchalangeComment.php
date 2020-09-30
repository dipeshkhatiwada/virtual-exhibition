<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RchalangeComment extends Model
{
    protected $table = 'rchalange_comment';  

    protected $fillable = array('employees_id', 'question_id', 'comment','right_wrong','right_answer','correct_answer');
    protected $primaryKey = 'id';
}
