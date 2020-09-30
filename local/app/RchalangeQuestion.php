<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RchalangeQuestion extends Model
{
    protected $table = 'rchalange_question';  

    protected $fillable = array('rchalange_id', 'question', 'answer', 'time_second');
    protected $primaryKey = 'id';

    public function Rchalange()
    {
    	return $this->belongsTo('App\Rchalange');
    }
}

