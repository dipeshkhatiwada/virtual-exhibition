<?php

namespace App\Http\Controllers\employee;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Rchalange;
use App\RchalangeQuestion;
use App\RchalangeParticipation;
use Carbon\Carbon;
use App\TestCategory;
use Validator;

class ParticipationController extends Controller
{
    public function __construct()
    {
        $this->middleware('employee');
    }
    public function index(Request $request)
    {
       

       
       $datas = RchalangeParticipation::where('employees_id', auth()->guard('employee')->user()->id)->groupBy('rchalange_id')->orderBy('marks', 'desc')->paginate(50);
               

        
        return view('employee.rchalange.participation', compact('datas'));
    }

    public function getChalange(Request $request)
    {
        return $this->getQuestion();
    }
    public function Participation($seo_url,Request $request)
    {
         Session()->forget('test');
            Session()->forget('test_id');
            Session()->forget('number_of_question');
            Session()->forget('questions');
            Session()->forget('question_ids');
            Session()->forget('question_count');
            Session()->forget('marks');
            Session()->forget('question_level');
            Session()->forget('previous_status');
            Session()->forget('recent_id');
            Session()->forget('duration');
            Session()->forget('right_answer');
        
       $exam = Rchalange::where('seo_url', $seo_url)->where('status', 1)->where('publish_date', '<=', date('Y-m-d'))->first();
      
       if(!$exam)
       {
        \Session::flash('alert-danger', 'Chalange Not Found');
        return redirect()->back();
       }

       if (Session()->has('test')) {
           $ques = $this->getQuestion();
       } else{
        Session(['test' => date('Ymdhis'), 'test_id' => $exam->id, 'number_of_question' => $exam->number_of_question, 'questions' => [], 'question_ids' => '0', 'question_count' => '0', 'marks' => '0', 'duration' => '0', 'right_answer' => '0']);
            $ques = $this->getQuestion();
       }
       $datas['title'] = $exam->title;
       $datas['answers'] = '';
       $questions = explode('|||||', $ques);
       $datas['question'] = $ques;
       if (isset($questions[0])) {
           $datas['question'] = $questions[0];
       }
       if (isset($questions[1])) {
           $datas['answers'] = $questions[1];
       }
       //dd($datas);
      
        return view('employee.rchalange.test', compact('datas'));
    }
    private function getQuestion()
   {

    

      $question_level = '0';
      $previous_status = 'Right';
     if (Session()->has('question_level')) {
       $question_level = Session()->get('question_level');
     }
     if (Session()->has('previous_status')) {
       $previous_status = Session()->get('previous_status');
     }

     $ids = explode(',', Session()->get('question_ids'));
     $question_id = [];
     foreach ($ids as $key => $qid) {
       $question_id[] = $qid;
     }

     $question = RchalangeQuestion::where('rchalange_id', Session()->get('test_id'))->whereNotIn('id', $ids)->inRandomOrder()->first();
     
     
     

     $answers = '';
     
     if(isset($question->id)){
      
     $question_count = Session()->get('question_count') + 1;
     Session(['question_count' => $question_count]);
     $datas['question'] = $question;
     $datas['answer'] = json_decode($question->answer);

     foreach ($datas['answer'] as $key => $value) {
      $selected = 'selected="selected"';
      if($value->correct == 1)
      {
        $selected = '';
      }
       $answers .= '<option '.$selected.' value="'.addslashes(htmlspecialchars($value->title)).'">'.addslashes(htmlspecialchars($value->title)).'</option>';
      }

      $answers .= '<option value="1none">None of the answers above provided by creator is correct</option>';
     
    
     $datas['number_of_question'] = Session()->get('number_of_question');
     $datas['question_count'] = $question_count;
     
     

      $datas['comments'] = [];
      $comments = \App\RchalangeComment::where('question_id', $question->id)->get();

      foreach ($comments as $key => $comment) {
        $name = '';
        $image = 'no-image.png';
        $comentor = \App\Employee::select('firstname','middlename','lastname','image')->where('id', $comment->employees_id)->first();
        if (isset($comentor->firstname)) {
          $name = $comentor->name.' '.$comentor->middlename.' '.$comentor->lastname;
        }
        if (isset($comentor->image)) {
          if (is_file(DIR_IMAGE.$comentor->image)) {
            $image = $comentor->image;
          }
        }
        $image = \App\Imagetool::mycrop($image,200,200);
        $datas['comments'][] = [
          'name' => $name,
          'image' => asset($image),
          'comment' => $comment->comment,
          'right_wrong' => $comment->right_wrong,
          'right_answer' => $comment->right_answer,
        ];
      }
    } else{
      return '|||||Question Not Found';
    }

    

    $ques = view('employee.rchalange.test-question')->with('datas', $datas);
     return $ques.'|||||'.$answers;
   } 


   public function submitAnswer(Request $request)
   {
    $mark = '0';
      $total_duration = 30;
     
      $total_question = 100;
      $question_data = [];
      $exam_id = '0';
      $answers = [];
      $question_title = '';
    
     $question = RchalangeQuestion::where('id', $request->question_id)->first();
     if (isset($question->id)) {
       $total_duration = $question->time_second;
      
       $question_exam = Rchalange::where('id', $question->rchalange_id)->first();
       if (isset($question_exam->id)) {
         $total_question = $question_exam->number_of_question;
       }
       $exam_id = $question->rchalange_id;
       $answers = json_decode($question->answer);
       $question_title = $question->question;
    
     }

     $new_duration = $total_duration;
     

     if ($total_question > 0) {
       $q_value = 100/$total_question;
     } else{
      $q_value = 1;
     }

     


     $answervalue = $q_value;
     $answer_status = 'Wrong';
     $r_answer = Session()->get('right_answer');

     if($request->wright != ''){

     if ($request->wright == 2) {
        $r_answer = $r_answer + 1;
       $mark = $answervalue;
       $answer_status = 'Right';
       

     }
    } else{
      if ($total_duration <= 50 ) {
        $new_duration = $total_duration + 1;
      }
    }

     
    $aduration = $total_duration - $request->duration;
    

     $question_data = [
        'title' => $question_title,
        'answers' => $answers,
        'answer_title' => $request->title,
        'marks' => $mark,
        'duration' => $total_duration - $request->duration,
        
        'wright' => $request->wright
       ];

      $sqdata = Session()->get('questions');
       if (count($sqdata) == 0) {
        $questions_datas[] = $question_data;
       }
       else{
        $questions_datas = $sqdata;
        $questions_datas[] = $question_data;
       }
       
      
     $question_ids = Session()->get('question_ids').','.$request->question_id;
     $marks = Session()->get('marks') + $mark;

     if (Session()->has('question_level')) {
       $question_level = Session()->get('question_level');
     }
     if (Session()->has('previous_status')) {
       $previous_status = Session()->get('previous_status');
     }

     $nduration = Session()->get('duration') + $aduration;

     Session(['question_ids' => $question_ids, 'questions' => $questions_datas, 'marks' => $marks, 'question_level' => '', 'duration' => $nduration, 'previous_status' => $answer_status, 'right_answer' => $r_answer]);


   
    
     if (Session()->get('question_count') == Session()->get('number_of_question')) {
     
      $qqq = json_encode(Session()->get('questions'));
       $data = [
        'rchalange_id' => $exam_id,
        'employees_id' => auth()->guard('employee')->user()->id,
        'questions' => $qqq,
        
        'marks' => Session()->get('marks'),
        'duration' => Session()->get('duration'),
        'right_answer' => Session()->get('right_answer'),
        'answer_date' => date('Y-m-d')
       ];
       
       //dd($data);
       $tans = RchalangeParticipation::create($data);
       Session(['recent_id' => $tans->id]);
       
     }
     
     
     return 'Success';

     
   }

    public function finishTest(Request $request)
    {
        if (Session()->has('recent_id')) {
          $id = Session()->get('recent_id');
        } else{
          \Session::flash('alert-danger', 'Session if Expired');
          return redirect('/employee');
        }

        $datas['question_answer'] = RchalangeParticipation::where('id', $id)->first();

        Session()->forget('test');
            Session()->forget('test_id');
            Session()->forget('number_of_question');
            Session()->forget('questions');
            Session()->forget('question_ids');
            Session()->forget('question_count');
            Session()->forget('marks');
            Session()->forget('question_level');
            Session()->forget('previous_status');
            Session()->forget('recent_id');
            Session()->forget('duration');
            Session()->forget('right_answer');
        //dd($datas);
        return view('employee.rchalange.test-complete')->with('datas', $datas);
       
    }

     public function postComment(Request $request)
   {
     if (!isset($request->coment) && !isset($request->question_id) ) {
       return 'Error||Comment is required';
     }
     if ($request->coment == '') {
       return 'Error||Comment is required';
     }
      $check = Rchalange::checkVeriable($request->coment);
        if($check > 0)
        {
            return 'Error||Sorry you used some wrong words.';
        }
    $check = Rchalange::checkVeriable($request->correct_answer);
        if($check > 0)
        {
            return 'Error||Sorry you used some wrong words.';
        }
     \App\RchalangeComment::create([
      'employees_id' => auth()->guard('employee')->user()->id, 
      'question_id' => $request->question_id, 
      'comment' => $request->coment,
      'right_wrong' => $request->right_wrong,
      'right_answer' => $request->right_answer,
      'correct_answer' => $request->correct_answer
     ]);

     return 'Success||Comment added successfully';
   }
}
