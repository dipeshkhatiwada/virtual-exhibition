<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Imagetool;

class EmployerQuestionAnswer extends Model
{
    protected $table = 'employer_answer';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'employer_question_id', 'employer_answers', 'ob_mark', 'image'
    ];


    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public function EmployerQuestion()
    {
    	return $this->belongsTo('App\EmployerQuestion');
    }

    public static function getAnswer($id)
    {
        $answer = DB::table('employer_answer')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $id)->first();
        if (isset($answer->employer_answers)) {
            return $answer->employer_answers;
        } else{
            return '';
        }
    }


    public static function getImage($id)
    {
        $answer = DB::table('employer_answer')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $id)->first();
        if (isset($answer->image)) {
            if (is_file(DIR_IMAGE.$answer->image)) {
                return Imagetool::mycrop($answer->image, 40, 40); 
            } else{
                return '';
            }
        } else{
            return '';
        }
    }

    public static function getImageValue($id)
    {
        $answer = DB::table('employer_answer')->where('employers_id', auth()->guard('employer')->user()->employers_id)->where('employer_question_id', $id)->first();
        if (isset($answer->image)) {
            return $answer->image; 
           
        } else{
            return '';
        }
    }

    public static function getPercent()
    {
        $total_mark = DB::table('employer_question')->sum('marks');

        $employer_marks = DB::table('employer_answer')->where('employers_id', auth()->guard('employer')->user()->employers_id)->sum('ob_mark');

        return number_format((($employer_marks / $total_mark) * 100), 2, '.', '');

    }

    public static function getQustionGroup()
    {
        $groups = DB::table('employer_question')->groupBy('group_title')->get();
        $question_group = [];
        $total_mark = DB::table('employer_question')->sum('marks');
        foreach ($groups as $group) {
            $qu = DB::table('employer_question')->where('group_title', $group->group_title);
            $questions = $qu->get();
            $total = $qu->sum('marks');
            $qid = [];
            foreach ($questions as $quest) {
                $qid[] = $quest->id;
            }

            $employer_marks = DB::table('employer_answer')->where('employers_id', auth()->guard('employer')->user()->employers_id)->whereIn('employer_question_id', $qid)->sum('ob_mark');
            $percent = number_format((($employer_marks / $total_mark) * 100), 0, '.', '');
            $question_group[] = ['title' => $group->group_title, 'percent' => $percent];

        }

        return $question_group;
    }


    public static function getEmployerPercent($id = '')
    {
        $total_mark = DB::table('employer_question')->sum('marks');

        $employer_marks = DB::table('employer_answer')->where('employers_id', $id)->sum('ob_mark');

        return number_format((($employer_marks / $total_mark) * 100), 2, '.', '');

    }

    public static function getEmployerQustionGroup($id = '')
    {
        $groups = DB::table('employer_question')->groupBy('group_title')->get();
        $question_group = [];
        $total_mark = DB::table('employer_question')->sum('marks');
        foreach ($groups as $group) {
            $qu = DB::table('employer_question')->where('group_title', $group->group_title);
            $questions = $qu->get();
            $total = $qu->sum('marks');
            $qid = [];
            foreach ($questions as $quest) {
                $qid[] = $quest->id;
            }

            $employer_marks = DB::table('employer_answer')->where('employers_id', $id)->whereIn('employer_question_id', $qid)->sum('ob_mark');
            $percent = number_format((($employer_marks / $total_mark) * 100), 0, '.', '');
            $question_group[] = ['title' => $group->group_title, 'percent' => $percent];

        }

        return $question_group;
    }
}
