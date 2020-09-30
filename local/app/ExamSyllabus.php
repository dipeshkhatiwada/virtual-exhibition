<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamSyllabus extends Model
{
     protected $table = 'exam_syllabus';  

    protected $fillable = array('jobs_id', 'syllabus');
    protected $primaryKey = 'id';

    public function Jobs()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
