<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployerQuestion extends Model
{
    protected $table = 'employer_question';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_title', 'question', 'answer_list', 'answer', 'marks', 'image'
    ];


    public function EmployerQuestionAnswer()
    {
        return $this->hasMany('App\EmployerQuestionAnswer');
    }
   
}
