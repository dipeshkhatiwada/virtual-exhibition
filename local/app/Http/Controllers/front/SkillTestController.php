<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\library\Settings;
use App\Setting;
use Carbon\Carbon;
use App\library\myFunctions;
use App\Layout;
use App\Imagetool;
use App\TestCategory;
use App\TestExam;
use App\TestAnswer;
use App\TestQuestion;
use App\QuestionComment;
use App\Employee;


class SkillTestController extends Controller
{

  public function index(Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'SkillTest')->first();
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }
    
        $settings = Settings::getSettings();
        $images = Settings::getImages();
        $config = array(
              'app.meta_title' => 'Rolling Skill Test',
              'app.meta_keyword' => 'Rolling Skill Test, Freelancing, Freelancer in Nepal, Rolling Plans, Skill Test in nepal, nepalese Skill Test market, vacancy, online Skill Test, work in nepal, employment in nepal, career nepal, employment nepal, nepal Skill Test market, nepali Skill Test market, Skill Test sites in nepal, Skill Test nepal, nepal Skill Test, nepalSkill Testite, nepal Skill Test site, nepaliSkill Testite, nepali Skill Test site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and Skill Test, Skill Test and nepal, nepal online Skill Test, Skill Test nepal, nepal Skill Test, nepali Skill Test, Skill Test in nepal, nepali Skill Test, Skill Test opportunity in nepal, find a Skill Test in nepal, find Skill Test in nepal, it Skill Test nepal, Skill Testnepal, nepalSkill Test, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro Skill Test, high paying Skill Test, Skill Test for students, student Skill Test',
              'app.meta_description' => 'Rolling Nexus Skill Test - An online Skill Test search engine for the Skill Test seekers in Nepal. The common search engine for Skill Test seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->test),
              'app.meta_url' => url('/skill-test'),
              'app.meta_type' => 'Skill Test',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->test)) {
     
      $logo = 'image/'.$image->test;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
    
    $datas['categories'] = [];
    
   

   $categories = TestCategory::orderBy('title', 'asc')->get();
       
       foreach ($categories as $category) {
        
           $datas['category'][] = [
            'title' => $category->title,
            'id' => $category->id,
            'url' => url('/skill-test/?subject='.$category->seo_url),
           ];
       }
       $subject_id = 0;
       $url = '?subject=0';
       

       if (isset($request->subject)) {
        $categ = TestCategory::where('seo_url', $request->subject)->first();
        if (isset($categ->id)) {
          $subject_id = $categ->id;
         $url = '?subject='.$request->subject;
        }
         
       }
       if($subject_id > 0){
       $exams = TestExam::where('category_id', $subject_id)->orderBy('title','desc')->paginate(50)->setPath('/skill-test'.$url);
       } else{
           $exams = TestExam::orderBy('title','desc')->paginate(50)->setPath('/skill-test'.$url);
       }
       
       $datas['exams'] = [];
       $image = Imagetool::mycrop('no-image.png',280,200);
       foreach ($exams as $key => $exam) {
        if (is_file(DIR_IMAGE.$exam->image)) {
          $image = Imagetool::mycrop($exam->image,280,200);
        }
         $datas['exams'][] = [
          'id' => $exam->id,
          'title' => $exam->title,
          'image' => asset($image),
          'href' => url('/skill-test/'.$exam->seo_url),
         ];
       }
      $datas['category_id'] = $subject_id;
      $datas['pagination'] = $exams;
   
    $main_content = \App\Module::getModules($layout_id, 'content_main');
      
        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
          $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
          $content_main = new $cont();
             $datas['main_modules'][] = array(
            'module' => $content_main->index($main->module_id,json_decode($main->setting)), ); 
            }


    $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
          $left_module = new $lcontent();
            $datas['left_content'][] = array(
            'module' => $left_module->index($left->module_id,json_decode($left->setting)),
              );  
            }
    $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
          $right_module = new $lcontent();
            $datas['right_content'][] = array(
            'module' => $right_module->index($right->module_id,json_decode($right->setting)),
              );  
            }
     $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
          $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
              );  
            }
       $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
          $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
            'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
              );  
            }
    
    return view('front.skill-test.index')->with('datas', $datas);
  }


  public function getTest($seo_url,Request $request)    
   {

   
    $layouts= Layout::where('layout_route', 'Test')->first();
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }

      $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->test)) {
     
      $logo = 'image/'.$image->test;
    } else {
      $logo = '';
    }
    $datas['logo'] = asset($logo);
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;

    
    $exam = TestExam::where('seo_url', $seo_url)->first();
   //dd($exam->TestQuestions);
      
      if (isset($exam->id)) {
       
       
       
        $config = array(
              'app.meta_title' => $exam->title,
              'app.meta_keyword' => strtolower($exam->title),
              'app.meta_description' => Settings::getLimitedWords($exam->description,0,25),
              'app.meta_image' => $logo,
              'app.meta_url' => url('skill-test/'.$exam->seo_url),
              'app.meta_type' => 'Project',
              'app.id' => '0',
              
                );
            config($config);
           
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

             Session(['test' => date('Ymdhis'), 'test_id' => $exam->id, 'number_of_question' => $exam->number_of_question, 'questions' => [], 'question_ids' => '0', 'question_count' => '0', 'marks' => '0', 'duration' => '0', 'right_answer' => '0']);
                   
           $categories = TestCategory::orderBy('title', 'asc')->get();
       
       foreach ($categories as $category) {
        
           $datas['category'][] = [
            'title' => $category->title,
            
            'url' => url('/skill-test/?subject='.$category->seo_url),
           ];
       }
       $datas['test_title'] = strtoupper($exam->title);
       $datas['test_image'] = '';
        if (is_file(DIR_IMAGE.$exam->image)) {
          $datas['test_image'] = Imagetool::mycrop($exam->image,180,100);
        }
            $main_content = \App\Module::getModules($layout_id, 'content_main');
      
        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
          $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
          $content_main = new $cont();
             $datas['main_modules'][] = array(
            'module' => $content_main->index($main->module_id,json_decode($main->setting)), ); 
            }


    $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
          $left_module = new $lcontent();
            $datas['left_content'][] = array(
            'module' => $left_module->index($left->module_id,json_decode($left->setting)),
              );  
            }
    $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
          $right_module = new $lcontent();
            $datas['right_content'][] = array(
            'module' => $right_module->index($right->module_id,json_decode($right->setting)),
              );  
            }
     $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
          $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
              );  
            }
       $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
          $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
            'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
              );  
            }

           //dd($datas);
            if (count($exam->TestQuestions) > 0) {
             return view('front.skill-test.test')->with('datas', $datas);
            } else{
              return view('front.skill-test.no_question')->with('datas', $datas);
            }
            

      } else {
        $config = array(
              'app.meta_title' => 'Subject Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Subject Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/skill-test'.$seo_url),
              'app.meta_type' => 'Subject',
              
                );
            config($config);
        return  view('front.skill-test.test-not-found');
      }

     

   
   }

   public function getQuestion()
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

     $quest = TestQuestion::where('test_exam_id', Session()->get('test_id'))->whereNotIn('id', $ids);
     if ($previous_status == 'Right') {
       $quest->where('hard_level', '>', $question_level);
       $question = $quest->inRandomOrder()->first();
     }else{
      $quest->where('hard_level', '<=', $question_level);
      $question = $quest->inRandomOrder()->first();
     }
     
     if (!isset($question->id)) {
       $question = TestQuestion::where('test_exam_id', Session()->get('test_id'))->whereNotIn('id', $ids)->inRandomOrder()->first();
     }

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
     
     if (is_file(DIR_IMAGE.$question->image)) {
       $datas['question_image'] = asset('image/'.$question->image);
     }

     if ($question->hard_level <= 33) {
       $datas['question_status'] = 'EASY';
     } elseif ($question->hard_level > 33 & $question->hard_level <= 66) {
       $datas['question_status'] = 'MEDIUM';
     } else{
      $datas['question_status'] = 'HARD';
     }

      $datas['comments'] = [];
      $comments = QuestionComment::where('question_id', $question->id)->get();

      foreach ($comments as $key => $comment) {
        $name = '';
        $image = 'no-image.png';
        $comentor = Employee::select('firstname','middlename','lastname','image')->where('id', $comment->employes_id)->first();
        if (isset($comentor->firstname)) {
          $name = $comentor->name.' '.$comentor->middlename.' '.$comentor->lastname;
        }
        if (isset($comentor->image)) {
          if (is_file(DIR_IMAGE.$comentor->image)) {
            $image = $comentor->image;
          }
        }
        $image = Imagetool::mycrop($image,200,200);
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

    

    $ques = view('front.skill-test.question')->with('datas', $datas);
     return $ques.'|||||'.$answers;
   } 

   public function submitAnswer(Request $request)
   {
    $mark = '0';
      $total_duration = 30;
      $hard_level = 33;
      $total_question = 100;
      $question_data = [];
      $exam_id = '0';
      $answers = [];
      $question_title = '';
      $image = '';
     $question = TestQuestion::where('id', $request->question_id)->first();
     if (isset($question->id)) {
       $total_duration = $question->time_second;
       $hard_level = $question->hard_level;
       $question_exam = TestExam::where('id', $question->test_exam_id)->first();
       if (isset($question_exam->id)) {
         $total_question = $question_exam->number_of_question;
       }
       $exam_id = $question->test_exam_id;
       $answers = json_decode($question->answer);
       $question_title = $question->question;
       $image = $question->image;
     }

     $new_duration = $total_duration;
     $new_h_level = $hard_level;

     if ($total_question > 0) {
       $q_value = 100/$total_question;
     } else{
      $q_value = 1;
     }

     if ($hard_level <= 20) {
       $q_level = '0.20';
     }elseif ($hard_level > 20 && $hard_level <= 40) {
       $q_level = '0.40';
     }elseif ($hard_level > 40 && $hard_level <= 60) {
       $q_level = '0.60';
     }
     elseif ($hard_level > 60 && $hard_level <= 80) {
       $q_level = '0.80';
     }else{
      $q_level = '1.00';
     }

     $aduration = $total_duration - $request->duration;

     $ans_percent = ($aduration * 100) / $total_duration;

     if ($ans_percent > 80) {
       $a_level = '0.40';

     }elseif ($ans_percent > 60 && $ans_percent <= 80) {
       $a_level = '0.60';
     }elseif ($ans_percent > 40 && $ans_percent <= 60) {
       $a_level = '0.80';
     } else{
      $a_level = '1.00';
     }

     $answervalue = $q_value * $q_level * $a_level;
     $answer_status = 'Wrong';
     $r_answer = Session()->get('right_answer');

     if($request->wright != ''){

     if ($request->wright == 2) {
        $r_answer = $r_answer + 1;
       $mark = $answervalue;
       $answer_status = 'Right';
       if ($hard_level == 80) {
         $new_h_level = 80;
       } elseif ($hard_level >= 70 && $hard_level < 80 ) {
         $new_h_level = 80;
       } else{
        $new_h_level = $hard_level + 5;
       }

       if ($ans_percent < 30) {
         if ($total_duration > 30) {
           $new_duration = $total_duration - 1;
         }
       } elseif ($ans_percent > 80) {
        
           $new_duration = $total_duration + 1;
         
       }
     }
    } else{
      if ($total_duration <= 50 ) {
        $new_duration = $total_duration + 1;
      }
    }

     

    

     $question_data = [
        'title' => $question_title,
        'answers' => $answers,
        'answer_title' => $request->title,
        'marks' => $mark,
        'duration' => $total_duration - $request->duration,
        'image' => $image,
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

     Session(['question_ids' => $question_ids, 'questions' => $questions_datas, 'marks' => $marks, 'question_level' => $hard_level, 'duration' => $nduration, 'previous_status' => $answer_status, 'right_answer' => $r_answer]);


   
      $qdata = [
      'hard_level' => $new_h_level,
      'time_second' => $new_duration
     ];
     TestQuestion::where('id', $request->question_id)->update($qdata);
     if (Session()->get('question_count') == Session()->get('number_of_question')) {
     
      $qqq = json_encode(Session()->get('questions'));
       $data = [
        'test_id' => $exam_id,
        'employes_id' => auth()->guard('employee')->user()->id,
        'questions' => $qqq,
        
        'marks' => Session()->get('marks'),
        'duration' => Session()->get('duration'),
        'right_answer' => Session()->get('right_answer'),
        'answer_date' => date('Y-m-d')
       ];
       
       //dd($data);
       $tans = TestAnswer::create($data);
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
      return redirect('/skill-test');
    }
   

     $layouts= Layout::where('layout_route', 'SkillTest')->first();
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }
    
        $settings = Settings::getSettings();
        $images = Settings::getImages();
        $config = array(
              'app.meta_title' => 'Rolling Skill Test',
              'app.meta_keyword' => 'Rolling Test',
              'app.meta_image' => asset('/image/'.$images->test),
              'app.meta_url' => url('/skill-test'),
              'app.meta_type' => 'Website',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->test)) {
     
      $logo = 'image/'.$image->test;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
      $categories = TestCategory::orderBy('title', 'asc')->get();
       
       foreach ($categories as $category) {
        
           $datas['category'][] = [
            'title' => $category->title,
            
            'url' => url('/skill-test/?subject='.$category->seo_url),
           ];
       }
      
    $qans = TestAnswer::where('id', $id)->first();
    //dd(json_decode($qans->questions));
     $datas['question_answer'] = $qans;
    
           /* Session()->forget('test');
            Session()->forget('test_id');
            Session()->forget('number_of_question');
            Session()->forget('questions');
            Session()->forget('question_ids');
            Session()->forget('question_count');
            Session()->forget('marks');
            Session()->forget('question_level');
            Session()->forget('previous_status');
            Session()->forget('duration');
            Session()->forget('recent_id'); */
    $main_content = \App\Module::getModules($layout_id, 'content_main');
      
        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
          $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
          $content_main = new $cont();
             $datas['main_modules'][] = array(
            'module' => $content_main->index($main->module_id,json_decode($main->setting)), ); 
            }


    $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
          $left_module = new $lcontent();
            $datas['left_content'][] = array(
            'module' => $left_module->index($left->module_id,json_decode($left->setting)),
              );  
            }
    $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
          $right_module = new $lcontent();
            $datas['right_content'][] = array(
            'module' => $right_module->index($right->module_id,json_decode($right->setting)),
              );  
            }
     $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
          $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
              );  
            }
       $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
          $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
            'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
              );  
            }
     return view('front.skill-test.test-finish')->with('datas',$datas);
   }

   public function postComment(Request $request)
   {
     if (!isset($request->coment) && !isset($request->question_id) ) {
       return 'Error||Comment is required';
     }
     if ($request->coment == '') {
       return 'Error||Comment is required';
     }
     
      $check = \App\Rchalange::checkVeriable($request->coment);
        if($check > 0)
        {
            return 'Error||Sorry you used some wrong words.';
        }
    $check = \App\Rchalange::checkVeriable($request->correct_answer);
        if($check > 0)
        {
            return 'Error||Sorry you used some wrong words.';
        }
     QuestionComment::create([
      'employes_id' => auth()->guard('employee')->user()->id, 
      'question_id' => $request->question_id, 
      'comment' => $request->coment,
      'right_wrong' => $request->right_wrong,
      'right_answer' => $request->right_answer,
      'correct_answer' => $request->correct_answer
     ]);

     return 'Success||Comment added successfully';
   }
}

