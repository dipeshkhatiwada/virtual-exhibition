<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RchalangeParticipation extends Model
{
    protected $table = 'rchalange_participation';  

    protected $fillable = array('rchalange_id', 'employees_id', 'questions', 'marks', 'duration', 'answer_date', 'right_answer');
    protected $primaryKey = 'id';
}
