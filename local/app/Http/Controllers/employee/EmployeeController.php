<?php
namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QrCode;
use Validator;
use App\OrganizationType;
use App\Faculty;
use App\JobCategory;
use App\JobLevel;
use App\JobLocation;
use App\EducationLevel;
use App\Employees;
use App\EmployeeAddress;
use App\EmployeeCategory;
use App\EmployeeOrganization;
use App\EmployeeLocation;
use App\EmployeeCoverletter;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeLanguage;
use App\EmployeeReference;
use App\EmployeeSetting;
use App\EmployeeTraining;
use App\EmployeeFiles;
use App\Apply;
use App\Saluation;
use App\Imagetool;
use App\Jobs;
use App\Invoice;
use PDF;
use Image;
use File;
use Carbon\Carbon;
use App\library\Settings;
use App\ReferenceComment;
use App\EmployeeSkills;

use Mail;

use App\EmployeeRating;
use App\library\myFunctions;
use App\Employers;
use App\JobApply;
use App\JobForm;
use App\FormData;
use App\Project;
use App\ProjectApply;
use App\ProjectMilestones;
use App\Training;
use App\Event;
use App\TrainingApply;
use App\EventApply;
use App\TestAnswer;
use App\TestExam;
use App\EmployerRating;
use App\EmployerRatingQuestions;
use App\JobWithdraw;
use App\JobEducation;

use App\ShareUrl;
use App\ShareActivity;
use App\ShareActivityImage;
use App\ShareActivityImageTemp;

use App\ShareActivityComment;
use App\ShareActivityLike;
use App\ShareActivityImageComment;
use App\ShareActivityImageCommentLike;
use App\ShareActivityImageLike;
use App\ShareActivityCommentLike;
use Pusher\Pusher;

class EmployeeController extends Controller
{


    public function __construct()
    {
        $this->middleware('employee');
    }
    public function dashboard(Request $request)
    {

      $employee_url = auth()->guard('employee')->user()->id;
      $data['logo'] = Settings::getImages()->logo;

        $data['loged_in'] = false;
        if ($employee_url == auth()->guard('employee')->user()->id) {
            $data['loged_in'] = True;
        }
        $user = Employees::where('id', $employee_url)->first();
         $data['user'] = $user;
         if (!$user) {
             \Session::flash('alert-danger', 'data not found');
             return redirect()->back();
         }
         $setting = $user->EmployeeSetting;

         if ($data['loged_in']) {
            if ($user->middlename != '') {
                $data['name'] = $user->firstname.' '.$user->middlename.' '.$user->lastname;
            }
            else{
                $data['name'] = $user->firstname.' '.$user->lastname;
            }
         } else{
            $setid[] = '0';
            $checkcircle = \App\UserCircle::checkFriend($user->id);
            if($checkcircle > 0)
            {
                $setid[] = '3';
            }
            if (\App\UserCircle::checkAlumni($user->id)) {
                $setid[] = '2';
            }
            if (in_array($sett->name_privacy, $setid)) {
                if ($user->middlename != '') {
                    $data['name'] = $user->firstname.' '.$user->middlename.' '.$user->lastname;
                }
                else{
                    $data['name'] = $user->firstname.' '.$user->lastname;
                }
            }else{
                $data['name'] = $user->firstname;
            }
         }
        $image='no-image.png';
        if (is_file(DIR_IMAGE.$user->image)) {
            $image = $user->image;
        }
        $data['image'] = Imagetool::mycrop($image, 200, 200);
        $data['pheading'] = $user->professional_heading;
        $data['total_following'] = \App\EmployerFollow::select('id','employers_id')->where('employees_id',$user->id)->get();
        $data['total_circle'] = \App\UserCircle::where('user_id',$user->id)->where('status', 1)->count();
        $data['college_friends'] = [];
       $college_id = [];
       $colleges = EmployeeEducation::where('employee_education.employees_id', $user->id)
                 ->leftJoin('employee_setting', 'employee_education.employees_id', '=', 'employee_setting.employees_id')
                 ->where('employee_setting.find_you', 1)
                 ->groupBy('employee_education.employers_id')->get();
       foreach ($colleges as $key => $college) {
            $college_id[] = $college->employers_id;
            $tcf = EmployeeEducation::where('employee_education.employers_id', $college->employers_id)
             ->leftJoin('employee_setting', 'employee_education.employees_id', '=', 'employee_setting.employees_id')
                 ->where('employee_setting.find_you', 1)
            ->where('employee_education.employees_id', '!=', $user->id)->groupBy('employee_education.employees_id')->get();

            if (count($tcf) > 0) {
               $ebatch = EmployeeEducation::where('employee_education.employers_id', $college->employers_id)
                ->leftJoin('employee_setting', 'employee_education.employees_id', '=', 'employee_setting.employees_id')
                ->where('employee_setting.find_you', 1)
                ->where('employee_education.employees_id', '!=', $user->id)
                ->where('employee_education.year',$college->year)
                ->groupBy('employee_education.employees_id')->count();
             $data['college_friends'][] =[
                    'college_id' => $college->employers_id,
                    'type' => 'education',
                    'company_name' => Employers::getName($college->employers_id),
                    'company_logo' => Employers::getPhoto($college->employers_id),
                    'total_friends' => count($tcf),
                    'batch_friend' => $ebatch,
                    'batch' => $college->year,

                   ];
               }

       }

       $trainings = EmployeeTraining::where('employee_training.employees_id', $user->id)
                  ->leftJoin('employee_setting', 'employee_training.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->groupBy('employee_training.employers_id')->get();
       foreach ($trainings as $key => $training) {
           $college_id[] = $training->employers_id;
           $ttf = EmployeeTraining::where('employee_training.employers_id', $training->employers_id)
                  ->leftJoin('employee_setting', 'employee_training.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->where('employee_training.employees_id', '!=', $user->id)->groupBy('employee_training.employees_id')->get();
           if (count($ttf) > 0) {
            $batchfriend = EmployeeTraining::where('employee_training.employers_id', $training->employers_id)
                  ->leftJoin('employee_setting', 'employee_training.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->where('employee_training.employees_id', '!=', $user->id)
                  ->where('employee_training.year',$training->year)
                  ->groupBy('employee_training.employees_id')->count();

            $data['college_friends'][] =[
                    'college_id' => $training->employers_id,
                    'type' => 'training',
                    'company_name' => Employers::getName($training->employers_id),
                    'company_logo' => Employers::getPhoto($training->employers_id),
                    'total_friends' => count($ttf),
                    'batch_friend' => $batchfriend,
                    'batch' => $training->year,

                   ];
               }
       }


       $fedu = EmployeeEducation::whereIn('employee_education.employers_id', $college_id)->where('employee_education.employees_id', '!=', $user->id)
              ->leftJoin('employee_setting', 'employee_education.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->groupBy('employee_education.employees_id')->get();
       $ftr = EmployeeTraining::whereIn('employee_training.employers_id', $college_id)->where('employee_training.employees_id', '!=', $user->id)
              ->leftJoin('employee_setting', 'employee_training.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->groupBy('employee_training.employees_id')->get();
       $total_edu = count($fedu);
       $total_ftr = count($ftr);
       $data['total_college_friends'] = $total_edu + $total_ftr;



        $data['work_company'] = [];
       $work_id = [];
       $compys = EmployeeExperience::where('employees_id', $user->id)

                  ->groupBy('employers_id')->get();
       foreach ($compys as $key => $comp) {
            $work_id[] = $comp->employers_id;
            $wtf = EmployeeExperience::where('employee_experience.employers_id', $comp->employers_id)
                  ->leftJoin('employee_setting', 'employee_experience.employees_id', '=', 'employee_setting.employees_id')
                  ->where('employee_setting.find_you', 1)
                  ->where('employee_experience.employees_id', '!=', $user->id)
                  ->groupBy('employee_experience.employees_id')->get();
            if (count($wtf) > 0) {
             $exbatch = EmployeeExperience::where('employee_experience.employers_id', $comp->employers_id)
                        ->leftJoin('employee_setting', 'employee_experience.employees_id', '=', 'employee_setting.employees_id')
                        ->where('employee_setting.find_you', 1)
                        ->where('employee_experience.employees_id', '!=', $user->id)
                        ->where('employee_experience.from', '>=',$comp->from)
                        ->where('employee_experience.from', '<=',$comp->to)
                        ->groupBy('employee_experience.employees_id')->count();
            $data['work_company'][] =[
                    'company_id' => $comp->employers_id,
                    'type' => 'experience',
                    'company_name' => Employers::getName($comp->employers_id),
                    'company_logo' => Employers::getPhoto($comp->employers_id),
                    'total_friends' => count($wtf),
                    'batch_friend' => $exbatch,
                    'batch' => $comp->from.'||'.$comp->to,


                   ];
           }
       }



       $total_workfriend = EmployeeExperience::whereIn('employee_experience.employers_id', $work_id)
                            ->leftJoin('employee_setting', 'employee_experience.employees_id', '=', 'employee_setting.employees_id')
                            ->where('employee_setting.find_you', 1)
                           ->where('employee_experience.employees_id', '!=', $user->id)
                           ->groupBy('employee_experience.employees_id')->get();
       $data['total_work_friend'] = count($total_workfriend);

       $totalactivities = ShareActivity::where('share_type', 1)->orderBy('id','desc')->count();

       $activities = ShareActivity::where('share_type', 1)->orderBy('id','desc')->skip(0)->take(10)->get();
       $data['lodemore'] = '2';
       if ($totalactivities > count($activities)) {
         $data['lodemore'] = '1';
       }
       $datas = [];
       foreach ($activities as $key => $activity) {
          $shares = ShareActivity::where('parent_id',$activity->id)->get();
          $totalshare = '0';
          if ($shares) {
            $totalshare = count($shares);
          }
          $likes = ShareActivityLike::where('share_activity_id', $activity->id)->pluck('like_by')->toArray();

          $comments = [];
          if (count($activity->Comments) > 0) {
            foreach ($activity->Comments as $key => $comment) {
              $commentlikes = ShareActivityCommentLike::where('share_activity_comment_id', $comment->id)->pluck('like_by')->toArray();

              $comments[] = [
                'id' => $comment->id,
                'comment_text' => $comment->comment,
                'comment_by' => $comment->comment_by,
                'image' => Employees::getPhoto($comment->comment_by),
                'name' => Employees::getName($comment->comment_by),
                'date_time' => $comment->created_at->diffForHumans(),
                'likes' => $commentlikes,
                'comments' => ShareActivityComment::where('parent_id', $comment->id)->get()
              ];
            }
          }

         $datas[] = [
          'name'      => Employees::getName($activity->share_by),
          'image'     => Employees::getPhoto($activity->share_by),
          'id'        => $activity->id,
          'date_time' =>  $activity->created_at->diffForHumans(),
          'public'    => ShareUrl::getPublically($activity->share_type),
          'title'     => $activity->title,
          'share_url' => $activity->share_url,
          'images'    => $activity->Images,
          'share_by'  => $activity->share_by,
          'url_data'  => ShareUrl::where('id', $activity->share_url)->first(),
          'likes'     => $likes,
          'comments'  => $comments,
          'shares'    => $shares,
          'total_share' => $totalshare
          ];
       }

       $data['activities'] = view('employee.activity', compact('datas'));

       $latestedu = EmployeeEducation::where('employees_id',$user->id)->orderBy('year','desc')->first();
       $data['education'] = '';
       if (isset($latestedu->id)) {
        $lavel = EducationLevel::getTitle($latestedu->level_id);
         $data['education'] = $lavel.' from '.$latestedu->institution;
       }
       $data['address'] = '';
       if ($user->EmployeeAddress) {
         $data['address'] = $user->EmployeeAddress->permanent_district.', '.$user->EmployeeAddress->permanent;
       }


       $app = $user->Apply->pluck('jobs_id')->toArray();

       $experience = $user->EmployeeExperience;
        $yr = 0;
         if (count($experience) > 0) {
            $dif = 0;
             foreach ($experience as $exper) {
                $from = explode('-', $exper->from);
                $to = explode('-', $exper->to);
                 $dt1 = Carbon::createFromDate($from[0], $from[1], $from[2]);
                 $dt2 = Carbon::createFromDate($to[0], $to[1], $to[2]);

                 $dif += $dt1->diffInDays($dt2);


             }
             $yr = $dif / 365;

         }


       $recomended_jobs = Jobs::whereNotIn('id', $app)->where('min_experience', '<=', $yr)->where('status', 1)->where('deadline', '>=', date('Y-m-d'))->orderBy('job_type','asc')->get();
         $data['recomended_jobs'] = [];
         foreach ($recomended_jobs as $key => $rjob) {

            $job_educaitons = JobEducation::where('jobs_id',$rjob->id)->orderBy('education_level_id','desc')->get();
             if (count($job_educaitons) > 0) {
               foreach ($job_educaitons as $key => $je) {
                 $emp_education = EmployeeEducation::where('employees_id', $user->id)->where('level_id',$je->education_level_id);
                 if ($je->faculty_id > 0) {
                   $emp_education->where('faculty_id',$je->faculty_id);
                 }
                $ee = $emp_education->first();
                 if (isset($ee->id)) {
                  $pass = 1;
                  if ($je->percent > 0) {
                    $pass = 0;

                       if ($ee->marksystem == 2) {
                         if ($je->cgps <= $ee->percentage) {
                           $pass = 1;
                         }
                       }elseif ($ee->marksystem == 3) {
                          if ($je->others <= $ee->percentage) {
                             $pass = 1;
                           }
                       }else{
                        if ($je->percent <= $ee->percentage) {
                             $pass = 1;
                           }
                       }
                       if ($pass == 1) {
                         $data['recomended_jobs'][] = [
                          'employers_id' => $rjob->employers_id,
                          'seo_url' => $rjob->seo_url,
                            'title' => $rjob->title,
                            'availability' => $rjob->job_availability,
                            'position' => $rjob->position,
                            'vacancy_code' => $rjob->vacancy_code,
                            'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                            'deadline' => $rjob->deadline
                          ];
                       }
                  } else{
                    $data['recomended_jobs'][] = [
                      'employers_id' => $rjob->employers_id,
                      'seo_url' => $rjob->seo_url,
                      'title' => $rjob->title,
                      'availability' => $rjob->job_availability,
                      'position' => $rjob->position,
                      'vacancy_code' => $rjob->vacancy_code,
                      'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                      'deadline' => $rjob->deadline
                    ];
                  }

                 }
               }
             } else{
              $data['recomended_jobs'][] = [
                'employers_id' => $rjob->employers_id,
                'seo_url' => $rjob->seo_url,
                'title' => $rjob->title,
                'availability' => $rjob->job_availability,
                'position' => $rjob->position,
                'vacancy_code' => $rjob->vacancy_code,
                'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                'deadline' => $rjob->deadline
              ];
             }
           if (count($data['recomended_jobs']) == 2) {
               break;
             }
         }


         $applies = ProjectApply::where('employees_id', $user->id)->get();
           $apply = [];
           foreach ($applies as $key => $pa) {
               $apply[] = $pa->project_id;
           }
         $data['recomended_project'] = [];
        //dd($user->Skills);
       foreach ($user->Skills as $key => $skills) {
           $prj = Project::whereNotIn('id', $apply)->where('skills', 'LIKE', '%'.$skills->title.'%')->where('status', 1)->inRandomOrder()->first();

           if (isset($prj->id)) {
            $apply[] = $prj->id;
               $data['recomended_project'][] = [

                'title' => Settings::getLimitedWords($prj->title,0,10),
                'href' => url('/projects/'.$prj->seo_url),
                'publish_by' => Employers::getName($prj->employers_id),
                'skills' => $prj->skills,
                'description' => Settings::getLimitedWords($prj->description,0,10),
                'publish_date' => $prj->publish_date
               ];
           }

           if (count($data['recomended_project']) == 2) {
               break;
             }
       }

       $data['jobs_applied'] = JobApply::where('employees_id', $user->id)->orderBy('id', 'desc')->limit(2)->get();

       $data['project_applied'] = ProjectApply::where('employees_id', $user->id)->orderBy('id', 'desc')->limit(2)->get();


       $data['total_job_apply'] = JobApply::where('employees_id', $user->id)->count();
        $data['total_project_apply'] = ProjectApply::where('employees_id', $user->id)->count();
        $data['total_talent_test'] = TestAnswer::where('employes_id', $user->id)->count();
        $data['total_finger_test'] = \App\EmployeeFingertest::where('employees_id', $user->id)->count();
        $data['total_training_apply'] = TrainingApply::where('employees_id', $user->id)->count();
        $data['total_event_apply'] = EventApply::where('employees_id', $user->id)->count();

        $data['friend_request'] = [];
        $friend_request = \App\UserCircle::where('user_id',$user->id)->where('status', 0)->get();
        foreach ($friend_request as $key => $freq) {

          $data['friend_request'][] = [
            'id' => $freq->staff_id,
            'name' => Employees::getName($freq->staff_id),
            'image' => Employees::getPhoto($freq->staff_id)
          ];
        }


      $visitors = '';
      $pvs = \App\ProfileVisitor::where('employees_id', $user->id)->orderBy('id','desc')->limit(10)->get();
      if(count($pvs)){
        $visitors = '<div class="topthree">';
        foreach ($pvs as $key => $pv) {
          if ($pv->employees) {
            $employees = Employees::select('id')->whereIn('id',json_decode($pv->employees))->get();
            foreach ($employees as $key => $empl) {
              if ($empl->id == $user->id) {
                $simage = asset(Employees::getPhoto($empl->id));
                $sname = Employees::getName($empl->id);
              }else{
                $sett = EmployeeSetting::select('visit_privacy','name_privacy')->where('employees_id',$empl->id)->first();
                $setid[] = '0';
                $checkcircle = \App\UserCircle::checkFriend($empl->id);
                if($checkcircle > 0)
                  {
                    $setid[] = '3';
                  }
                  if (\App\UserCircle::checkAlumni($empl->id)) {
                    $setid[] = '2';
                  }

                  if (in_array($sett->visit_privacy, $setid)) {
                    $simage = asset(Employees::getPhoto($empl->id));
                    if (in_array($sett->name_privacy, $setid)) {
                      $sname = Employees::getName($empl->id);
                    }else{
                      $sname = Employees::getFirstName($empl->id);
                    }
                  }else{
                    $simage = asset('images/noimg.gif');
                    $sname = 'Someone from RollingNexus';
                  }
              }

              $visitors .= '<div class="employee"><span class="emp_image"><img src="'.$simage.'"></span><span class="emp_name">'.$sname.'<div class="emp_score">'.$pv->created_at.'</div></span></div>';
            }
          }
          if ($pv->employer) {
            $employers = Employers::select('id','name')->whereIn('id',json_decode($pv->employer))->get();
            foreach ($employers as $key => $emplr) {
              $visitors .= '<div class="employee"><span class="emp_image"><img src="'.\App\Employers::getPhoto($emplr->id).'"></span><span class="emp_name">'.$emplr->name.'<div class="emp_score">'.$pv->created_at.'</div></span></div>';
            }
          }
        }
      $visitors .= '</div>';
    }

  $data['visitors'] = $visitors;


  $data['skills'] = EmployeeSkills::where('employees_id',$user->id)->get();
             $skillendorse = 0;
             foreach ($data['skills'] as $key => $skillend) {
              $endo = json_decode($skillend->endorsed);
              if (is_array($endo)) {
                 $skillendorse += count($endo);
              }

             }
             $data['total_skill_endorse'] = $skillendorse;
             $data['chalanges'] = \App\Rchalange::checkParticipation();

            $data['points'] = \App\EmployeeActivity::getPoints(auth()->guard('employee')->user()->id);
             $data['ranks'] = \App\EmployeeActivity::getRank('All',auth()->guard('employee')->user()->id);

              $topthree = '';

              if(count($data['ranks']['topthree'])){
                $topthree = '<div class="topthree">';

                  $employees = Employees::select('id','points')
                            ->whereIn('id',$data['ranks']['topthree'])
                            ->orderBy('points','desc')
                            ->get();
                  foreach ($employees as $key => $empl) {
                    if ($empl->id == auth()->guard('employee')->user()->id) {
                      $simage = asset(Employees::getPhoto($empl->id));
                      $sname = Employees::getName($empl->id);
                    }else{
                      $sett = EmployeeSetting::select('score_privacy','name_privacy')->where('employees_id',$empl->id)->first();
                      $setid[] = '0';
                      $checkcircle = \App\UserCircle::checkFriend($empl->id);
                      if($checkcircle > 0)
                      {
                        $setid[] = '3';
                      }
                      if (\App\UserCircle::checkAlumni($empl->id)) {
                        $setid[] = '2';
                      }

                      if (in_array($sett->score_privacy, $setid)) {
                        $simage = asset(Employees::getPhoto($empl->id));
                        if (in_array($sett->name_privacy, $setid)) {
                          $sname = Employees::getName($empl->id);
                        }else{
                          $sname = Employees::getFirstName($empl->id);
                        }

                      }else{
                        $simage = asset('images/noimg.gif');
                        $sname = 'Someone from RollingNexus';
                      }

                    }

                    $topthree .= '<div class="employee"><span class="emp_image"><img src="'.$simage.'"></span><span class="emp_name">'.$sname.'<div class="emp_score">'.$empl->points.'</div></span></div>';
                  }

                $topthree .= '</div>';
              }

              $data['topthree'] = $topthree;
        return view('employee.dashboard', compact('data'));
    }

    public function profile($user_id='', Request $request)
    {
        $data['logo'] = Settings::getImages()->logo;

        $employee = Employees::where('id', $user_id)->first();


         if (!$employee) {
             \Session::flash('alert-danger', 'data not found');
             return redirect()->back();
         }

          $data['user'] = $employee;

          $data['loged_in'] = false;
        if ($user_id == auth()->guard('employee')->user()->id) {
            $data['loged_in'] = True;
        }



          $pr = 0;
          if($employee->firstname != '')
          {
            $pr += 1;
          }
           if($employee->gender != '')
          {
            $pr += 1;
          }
           if($employee->dob != '')
          {
            $pr += 1;
          }
           if($employee->marital_status != '')
          {
            $pr += 1;
          }
           if($employee->nationality != '')
          {
            $pr += 1;
          }
           if($employee->image != '')
          {
            $pr += 1;
          }
           if($employee->resume != '')
          {
            $pr += 1;
          }
          if($employee->coverletter != '')
          {
            $pr += 1;
          }
          if($employee->present_salary > 0)
          {
            $pr += 1;
          }
          if($employee->expected_salary > 0)
          {
            $pr += 1;
          }
          if($employee->professional_heading != '')
          {
            $pr += 1;
          }
          if($employee->description != '')
          {
            $pr += 1;
          }

          $address = $employee->EmployeeAddress;

          if($address->permanent_district != '')
          {
            $pr += 1;
          }
          if($address->mobile != '')
          {
            $pr += 1;
          }
          if($address->temporary_district != '')
          {
            $pr += 1;
          }

          if(count($employee->Skills) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeCategory) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeEducation) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeExperience) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeFingertest) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeLanguage) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeLocation) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeOrganization) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeReference) > 0)
          {
            $pr += 1;
          }
          if(count($employee->EmployeeTraining) > 0)
          {
            $pr += 1;
          }



         $percent = ($pr / 25) * 100;
         $data['profile_complete'] = number_format($percent);

         $setting = $employee->EmployeeSetting;

         if ($data['loged_in']) {
            if ($employee->middlename != '') {
                $data['name'] = $employee->firstname.' '.$employee->middlename.' '.$employee->lastname;
            }
            else{
                $data['name'] = $employee->firstname.' '.$employee->lastname;
            }
         } else{
            $setid[] = '0';
            $checkcircle = \App\UserCircle::checkFriend($employee->id);
            if($checkcircle > 0)
            {
                $setid[] = '3';
            }
            if (\App\UserCircle::checkAlumni($employee->id)) {
                $setid[] = '2';
            }
            if (in_array($setting->name_privacy, $setid)) {
                if ($employee->middlename != '') {
                    $data['name'] = $employee->firstname.' '.$employee->middlename.' '.$employee->lastname;
                }
                else{
                    $data['name'] = $employee->firstname.' '.$employee->lastname;
                }
            }else{
                $data['name'] = $employee->firstname;
            }
         }
        $image='no-image.png';
        if (is_file(DIR_IMAGE.$employee->image)) {
            $image = $employee->image;
        }
        $data['image'] = Imagetool::mycrop($image, 200, 200);
        $data['pheading'] = $employee->professional_heading;
        $data['total_circle'] = \App\UserCircle::where('user_id',$employee->id)->where('status', 1)->count();



        $app = $employee->Apply->pluck('jobs_id')->toArray();

       $experience = $employee->EmployeeExperience;
        $yr = 0;
         if (count($experience) > 0) {
            $dif = 0;
             foreach ($experience as $exper) {
                $from = explode('-', $exper->from);
                $to = explode('-', $exper->to);
                 $dt1 = Carbon::createFromDate($from[0], $from[1], $from[2]);
                 $dt2 = Carbon::createFromDate($to[0], $to[1], $to[2]);

                 $dif += $dt1->diffInDays($dt2);


             }
             $yr = $dif / 365;

         }


       $recomended_jobs = Jobs::whereNotIn('id', $app)->where('min_experience', '<=', $yr)->where('status', 1)->where('deadline', '>=', date('Y-m-d'))->orderBy('job_type','asc')->get();
         $data['recomended_jobs'] = [];
         foreach ($recomended_jobs as $key => $rjob) {

            $job_educaitons = JobEducation::where('jobs_id',$rjob->id)->orderBy('education_level_id','desc')->get();
             if (count($job_educaitons) > 0) {
               foreach ($job_educaitons as $key => $je) {
                 $emp_education = EmployeeEducation::where('employees_id', $employee->id)->where('level_id',$je->education_level_id);
                 if ($je->faculty_id > 0) {
                   $emp_education->where('faculty_id',$je->faculty_id);
                 }
                $ee = $emp_education->first();
                 if (isset($ee->id)) {
                  $pass = 1;
                  if ($je->percent > 0) {
                    $pass = 0;

                       if ($ee->marksystem == 2) {
                         if ($je->cgps <= $ee->percentage) {
                           $pass = 1;
                         }
                       }elseif ($ee->marksystem == 3) {
                          if ($je->others <= $ee->percentage) {
                             $pass = 1;
                           }
                       }else{
                        if ($je->percent <= $ee->percentage) {
                             $pass = 1;
                           }
                       }
                       if ($pass == 1) {
                         $data['recomended_jobs'][] = [
                          'employers_id' => $rjob->employers_id,
                          'seo_url' => $rjob->seo_url,
                            'title' => $rjob->title,
                            'availability' => $rjob->job_availability,
                            'position' => $rjob->position,
                            'vacancy_code' => $rjob->vacancy_code,
                            'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                            'deadline' => $rjob->deadline
                          ];
                       }
                  } else{
                    $data['recomended_jobs'][] = [
                      'employers_id' => $rjob->employers_id,
                      'seo_url' => $rjob->seo_url,
                      'title' => $rjob->title,
                      'availability' => $rjob->job_availability,
                      'position' => $rjob->position,
                      'vacancy_code' => $rjob->vacancy_code,
                      'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                      'deadline' => $rjob->deadline
                    ];
                  }

                 }
               }
             } else{
              $data['recomended_jobs'][] = [
                'employers_id' => $rjob->employers_id,
                'seo_url' => $rjob->seo_url,
                'title' => $rjob->title,
                'availability' => $rjob->job_availability,
                'position' => $rjob->position,
                'vacancy_code' => $rjob->vacancy_code,
                'salary' => \App\Currency::getSymbol($rjob->salary_unit).' '.$rjob->minimum_salary,
                'deadline' => $rjob->deadline
              ];
             }
           if (count($data['recomended_jobs']) == 2) {
               break;
             }
         }


         $applies = ProjectApply::where('employees_id', $employee->id)->get();
           $apply = [];
           foreach ($applies as $key => $pa) {
               $apply[] = $pa->project_id;
           }
         $data['recomended_project'] = [];
        //dd($employee->Skills);
       foreach ($employee->Skills as $key => $skills) {
           $prj = Project::whereNotIn('id', $apply)->where('skills', 'LIKE', '%'.$skills->title.'%')->where('status', 1)->inRandomOrder()->first();

           if (isset($prj->id)) {
            $apply[] = $prj->id;
               $data['recomended_project'][] = [

                'title' => Settings::getLimitedWords($prj->title,0,10),
                'href' => url('/projects/'.$prj->seo_url),
                'publish_by' => Employers::getName($prj->employers_id),
                'skills' => $prj->skills,
                'description' => Settings::getLimitedWords($prj->description,0,10),
                'publish_date' => $prj->publish_date
               ];
           }

           if (count($data['recomended_project']) == 2) {
               break;
             }
       }

       $data['jobs_applied'] = JobApply::where('employees_id', $employee->id)->orderBy('id', 'desc')->limit(2)->get();

       $data['project_applied'] = ProjectApply::where('employees_id', $employee->id)->orderBy('id', 'desc')->limit(2)->get();

        $data['employee_address'] = $employee->EmployeeAddress;

         $data['employee_setting'] = $employee->EmployeeSetting;


       $data['status'][] = ['value' => 3, 'title' => 'Pending'];
       $data['status'][] = ['value' => 1, 'title' => 'Active'];
       $data['status'][] = ['value' => 2, 'title' => 'Disabled'];

       $data['marital_status'][] = ['value' => 'Single'];
        $data['marital_status'][] = ['value' => 'Married'];
        $data['marital_status'][] = ['value' => 'Divorced'];

        $data['genders'][] = ['value' => 'Male'];
        $data['genders'][] = ['value' => 'Female'];
        $data['genders'][] = ['value' => 'Others'];

        $data['vehicles'][] = ['value' => 'Two Wheeler'];
        $data['vehicles'][] = ['value' => 'Four Wheeler'];
        $data['vehicles'][] = ['value' => 'Both'];
       $data['nationality'][] = ['value'=>'afghan'];
  $data['nationality'][] = ['value'=>'albanian'];
  $data['nationality'][] = ['value'=>'algerian'];
  $data['nationality'][] = ['value'=>'american'];
  $data['nationality'][] = ['value'=>'andorran'];
  $data['nationality'][] = ['value'=>'angolan'];
  $data['nationality'][] = ['value'=>'antiguans'];
  $data['nationality'][] = ['value'=>'argentinean'];
  $data['nationality'][] = ['value'=>'armenian'];
  $data['nationality'][] = ['value'=>'australian'];
  $data['nationality'][] = ['value'=>'austrian'];
  $data['nationality'][] = ['value'=>'azerbaijani'];
  $data['nationality'][] = ['value'=>'bahamian'];
  $data['nationality'][] = ['value'=>'bahraini'];
  $data['nationality'][] = ['value'=>'bangladeshi'];
  $data['nationality'][] = ['value'=>'barbadian'];
  $data['nationality'][] = ['value'=>'barbudans'];
  $data['nationality'][] = ['value'=>'batswana'];
  $data['nationality'][] = ['value'=>'belarusian'];
  $data['nationality'][] = ['value'=>'belgian'];
  $data['nationality'][] = ['value'=>'belizean'];
  $data['nationality'][] = ['value'=>'beninese'];
  $data['nationality'][] = ['value'=>'bhutanese'];
  $data['nationality'][] = ['value'=>'bolivian'];
  $data['nationality'][] = ['value'=>'bosnian'];
  $data['nationality'][] = ['value'=>'brazilian'];
  $data['nationality'][] = ['value'=>'british'];
  $data['nationality'][] = ['value'=>'bruneian'];
  $data['nationality'][] = ['value'=>'bulgarian'];
  $data['nationality'][] = ['value'=>'burkinabe'];
  $data['nationality'][] = ['value'=>'burmese'];
  $data['nationality'][] = ['value'=>'burundian'];
  $data['nationality'][] = ['value'=>'cambodian'];
  $data['nationality'][] = ['value'=>'cameroonian'];
  $data['nationality'][] = ['value'=>'canadian'];
  $data['nationality'][] = ['value'=>'cape verdean'];
  $data['nationality'][] = ['value'=>'central african'];
  $data['nationality'][] = ['value'=>'chadian'];
  $data['nationality'][] = ['value'=>'chilean'];
  $data['nationality'][] = ['value'=>'chinese'];
  $data['nationality'][] = ['value'=>'colombian'];
  $data['nationality'][] = ['value'=>'comoran'];
  $data['nationality'][] = ['value'=>'congolese'];
  $data['nationality'][] = ['value'=>'costa rican'];
  $data['nationality'][] = ['value'=>'croatian'];
  $data['nationality'][] = ['value'=>'cuban'];
  $data['nationality'][] = ['value'=>'cypriot'];
  $data['nationality'][] = ['value'=>'czech'];
  $data['nationality'][] = ['value'=>'danish'];
  $data['nationality'][] = ['value'=>'djibouti'];
  $data['nationality'][] = ['value'=>'dominican'];
  $data['nationality'][] = ['value'=>'dutch'];
  $data['nationality'][] = ['value'=>'east timorese'];
  $data['nationality'][] = ['value'=>'ecuadorean'];
  $data['nationality'][] = ['value'=>'egyptian'];
  $data['nationality'][] = ['value'=>'emirian'];
  $data['nationality'][] = ['value'=>'equatorial guinean'];
  $data['nationality'][] = ['value'=>'eritrean'];
  $data['nationality'][] = ['value'=>'estonian'];
  $data['nationality'][] = ['value'=>'ethiopian'];
  $data['nationality'][] = ['value'=>'fijian'];
  $data['nationality'][] = ['value'=>'filipino'];
  $data['nationality'][] = ['value'=>'finnish'];
  $data['nationality'][] = ['value'=>'french'];
  $data['nationality'][] = ['value'=>'gabonese'];
  $data['nationality'][] = ['value'=>'gambian'];
  $data['nationality'][] = ['value'=>'georgian'];
  $data['nationality'][] = ['value'=>'german'];
  $data['nationality'][] = ['value'=>'ghanaian'];
  $data['nationality'][] = ['value'=>'greek'];
  $data['nationality'][] = ['value'=>'grenadian'];
  $data['nationality'][] = ['value'=>'guatemalan'];
  $data['nationality'][] = ['value'=>'guinea-bissauan'];
  $data['nationality'][] = ['value'=>'guinean'];
  $data['nationality'][] = ['value'=>'guyanese'];
  $data['nationality'][] = ['value'=>'haitian'];
  $data['nationality'][] = ['value'=>'herzegovinian'];
  $data['nationality'][] = ['value'=>'honduran'];
  $data['nationality'][] = ['value'=>'hungarian'];
  $data['nationality'][] = ['value'=>'icelander'];
  $data['nationality'][] = ['value'=>'indian'];
  $data['nationality'][] = ['value'=>'indonesian'];
  $data['nationality'][] = ['value'=>'iranian'];
  $data['nationality'][] = ['value'=>'iraqi'];
  $data['nationality'][] = ['value'=>'irish'];
  $data['nationality'][] = ['value'=>'israeli'];
  $data['nationality'][] = ['value'=>'italian'];
  $data['nationality'][] = ['value'=>'ivorian'];
  $data['nationality'][] = ['value'=>'jamaican'];
  $data['nationality'][] = ['value'=>'japanese'];
  $data['nationality'][] = ['value'=>'jordanian'];
  $data['nationality'][] = ['value'=>'kazakhstani'];
  $data['nationality'][] = ['value'=>'kenyan'];
  $data['nationality'][] = ['value'=>'kittian and nevisian'];
  $data['nationality'][] = ['value'=>'kuwaiti'];
  $data['nationality'][] = ['value'=>'kyrgyz'];
  $data['nationality'][] = ['value'=>'laotian'];
  $data['nationality'][] = ['value'=>'latvian'];
  $data['nationality'][] = ['value'=>'lebanese'];
  $data['nationality'][] = ['value'=>'liberian'];
  $data['nationality'][] = ['value'=>'libyan'];
  $data['nationality'][] = ['value'=>'liechtensteiner'];
  $data['nationality'][] = ['value'=>'lithuanian'];
  $data['nationality'][] = ['value'=>'luxembourger'];
  $data['nationality'][] = ['value'=>'macedonian'];
  $data['nationality'][] = ['value'=>'malagasy'];
  $data['nationality'][] = ['value'=>'malawian'];
  $data['nationality'][] = ['value'=>'malaysian'];
  $data['nationality'][] = ['value'=>'maldivan'];
  $data['nationality'][] = ['value'=>'malian'];
  $data['nationality'][] = ['value'=>'maltese'];
  $data['nationality'][] = ['value'=>'marshallese'];
  $data['nationality'][] = ['value'=>'mauritanian'];
  $data['nationality'][] = ['value'=>'mauritian'];
  $data['nationality'][] = ['value'=>'mexican'];
  $data['nationality'][] = ['value'=>'micronesian'];
  $data['nationality'][] = ['value'=>'moldovan'];
  $data['nationality'][] = ['value'=>'monacan'];
  $data['nationality'][] = ['value'=>'mongolian'];
  $data['nationality'][] = ['value'=>'moroccan'];
  $data['nationality'][] = ['value'=>'mosotho'];
  $data['nationality'][] = ['value'=>'motswana'];
  $data['nationality'][] = ['value'=>'mozambican'];
  $data['nationality'][] = ['value'=>'namibian'];
  $data['nationality'][] = ['value'=>'nauruan'];

  $data['nationality'][] = ['value'=>'new zealander'];
  $data['nationality'][] = ['value'=>'nepalese'];
  $data['nationality'][] = ['value'=>'ni-vanuatu'];
  $data['nationality'][] = ['value'=>'nicaraguan'];
  $data['nationality'][] = ['value'=>'nigerien'];
  $data['nationality'][] = ['value'=>'north korean'];
  $data['nationality'][] = ['value'=>'northern irish'];
  $data['nationality'][] = ['value'=>'norwegian'];
  $data['nationality'][] = ['value'=>'omani'];
  $data['nationality'][] = ['value'=>'pakistani'];
  $data['nationality'][] = ['value'=>'palauan'];
  $data['nationality'][] = ['value'=>'panamanian'];
  $data['nationality'][] = ['value'=>'papua new guinean'];
  $data['nationality'][] = ['value'=>'paraguayan'];
  $data['nationality'][] = ['value'=>'peruvian'];
  $data['nationality'][] = ['value'=>'polish'];
  $data['nationality'][] = ['value'=>'portuguese'];
  $data['nationality'][] = ['value'=>'qatari'];
  $data['nationality'][] = ['value'=>'romanian'];
  $data['nationality'][] = ['value'=>'russian'];
  $data['nationality'][] = ['value'=>'rwandan'];
  $data['nationality'][] = ['value'=>'saint lucian'];
  $data['nationality'][] = ['value'=>'salvadoran'];
  $data['nationality'][] = ['value'=>'samoan'];
  $data['nationality'][] = ['value'=>'san marinese'];
  $data['nationality'][] = ['value'=>'sao tomean'];
  $data['nationality'][] = ['value'=>'saudi'];
  $data['nationality'][] = ['value'=>'scottish'];
  $data['nationality'][] = ['value'=>'senegalese'];
  $data['nationality'][] = ['value'=>'serbian'];
  $data['nationality'][] = ['value'=>'seychellois'];
  $data['nationality'][] = ['value'=>'sierra leonean'];
  $data['nationality'][] = ['value'=>'singaporean'];
  $data['nationality'][] = ['value'=>'slovakian'];
  $data['nationality'][] = ['value'=>'slovenian'];
  $data['nationality'][] = ['value'=>'solomon islander'];
  $data['nationality'][] = ['value'=>'somali'];
  $data['nationality'][] = ['value'=>'south african'];
  $data['nationality'][] = ['value'=>'south korean'];
  $data['nationality'][] = ['value'=>'spanish'];
  $data['nationality'][] = ['value'=>'sri lankan'];
  $data['nationality'][] = ['value'=>'sudanese'];
  $data['nationality'][] = ['value'=>'surinamer'];
  $data['nationality'][] = ['value'=>'swazi'];
  $data['nationality'][] = ['value'=>'swedish'];
  $data['nationality'][] = ['value'=>'swiss'];
  $data['nationality'][] = ['value'=>'syrian'];
  $data['nationality'][] = ['value'=>'taiwanese'];
  $data['nationality'][] = ['value'=>'tajik'];
  $data['nationality'][] = ['value'=>'tanzanian'];
  $data['nationality'][] = ['value'=>'thai'];
  $data['nationality'][] = ['value'=>'togolese'];
  $data['nationality'][] = ['value'=>'tongan'];
  $data['nationality'][] = ['value'=>'trinidadian or tobagonian'];
  $data['nationality'][] = ['value'=>'tunisian'];
  $data['nationality'][] = ['value'=>'turkish'];
  $data['nationality'][] = ['value'=>'tuvaluan'];
  $data['nationality'][] = ['value'=>'ugandan'];
  $data['nationality'][] = ['value'=>'ukrainian'];
  $data['nationality'][] = ['value'=>'uruguayan'];
  $data['nationality'][] = ['value'=>'uzbekistani'];
  $data['nationality'][] = ['value'=>'venezuelan'];
  $data['nationality'][] = ['value'=>'vietnamese'];
  $data['nationality'][] = ['value'=>'welsh'];
  $data['nationality'][] = ['value'=>'yemenite'];
  $data['nationality'][] = ['value'=>'zambian'];
  $data['nationality'][] = ['value'=>'zimbabwean'];


  $data['district'][] =['value'=>'Achham'];
$data['district'][] =['value'=>'Arghakhanchi'];
$data['district'][] =['value'=>'Baglung'];
$data['district'][] =['value'=>'Baitadi'];
$data['district'][] =['value'=>'Bajhang'];
$data['district'][] =['value'=>'Bajura'];
$data['district'][] =['value'=>'Banke'];
$data['district'][] =['value'=>'Bardiya'];
$data['district'][] =['value'=>'Bara'];
$data['district'][] =['value'=>'Bhaktapur'];
$data['district'][] =['value'=>'Bhojpur'];
$data['district'][] =['value'=>'Chitwan'];
$data['district'][] =['value'=>'Dhankuta'];
$data['district'][] =['value'=>'Dhanusa'];
$data['district'][] =['value'=>'Dolakha'];
$data['district'][] =['value'=>'Dhading'];
$data['district'][] =['value'=>'Dang'];
$data['district'][] =['value'=>'Dolpa'];
$data['district'][] =['value'=>'Dailekh'];
$data['district'][] =['value'=>'Doti'];
$data['district'][] =['value'=>'Dadeldhura'];
$data['district'][] =['value'=>'Darchula'];
$data['district'][] =['value'=>'Gorkha'];
$data['district'][] =['value'=>'Gulmi'];
$data['district'][] =['value'=>'Humla'];
$data['district'][] =['value'=>'Ilam'];
$data['district'][] =['value'=>'Jajarkot'];
$data['district'][] =['value'=>'Jhapa'];
$data['district'][] =['value'=>'Jumla'];
$data['district'][] =['value'=>'Khotang'];
$data['district'][] =['value'=>'Kathmandu'];
$data['district'][] =['value'=>'Kavrepalanchok'];
$data['district'][] =['value'=>'Kaski'];
$data['district'][] =['value'=>'Kapilvastu'];
$data['district'][] =['value'=>'Kalikot'];
$data['district'][] =['value'=>'Kailali'];
$data['district'][] =['value'=>'Kanchanpur'];
$data['district'][] =['value'=>'Lalitpur'];
$data['district'][] =['value'=>'Lamjung'];
$data['district'][] =['value'=>'Manang'];
$data['district'][] =['value'=>'Morang'];
$data['district'][] =['value'=>'Mahottari'];
$data['district'][] =['value'=>'Makwanpur'];
$data['district'][] =['value'=>'Myagdi'];
$data['district'][] =['value'=>'Mustang'];
$data['district'][] =['value'=>'Mugu'];
$data['district'][] =['value'=>'Nuwakot'];
$data['district'][] =['value'=>'Nawalparasi'];
$data['district'][] =['value'=>'Okhaldhunga'];
$data['district'][] =['value'=>'Panchthar'];
$data['district'][] =['value'=>'Parsa'];
$data['district'][] =['value'=>'Palpa'];
$data['district'][] =['value'=>'Parbat'];
$data['district'][] =['value'=>'Pyuthan'];
$data['district'][] =['value'=>'Ramechhap'];
$data['district'][] =['value'=>'Rautahat'];
$data['district'][] =['value'=>'Rasuwa'];
$data['district'][] =['value'=>'Rupandehi'];
$data['district'][] =['value'=>'Rolpa'];
$data['district'][] =['value'=>'Rukum'];
$data['district'][] =['value'=>'Sunsari'];
$data['district'][] =['value'=>'Sankhuwasabha'];
$data['district'][] =['value'=>'Saptari'];
$data['district'][] =['value'=>'Siraha'];
$data['district'][] =['value'=>'Solukhumbu'];
$data['district'][] =['value'=>'Sarlahi'];
$data['district'][] =['value'=>'Sindhuli'];
$data['district'][] =['value'=>'Sindhupalchowk'];
$data['district'][] =['value'=>'Syangja'];
$data['district'][] =['value'=>'Salyan'];
$data['district'][] =['value'=>'Surkhet'];
$data['district'][] =['value'=>'Tanahun'];
$data['district'][] =['value'=>'Taplejung'];
$data['district'][] =['value'=>'Terhathum'];
$data['district'][] =['value'=>'Udayapur'];
$data['district'][] =['value'=>'Other Country'];


        $data['yes_no'][] = ['value' => 0, 'title' => 'No'];
        $data['yes_no'][] = ['value' => 1, 'title' => 'Yes'];
        $data['employee_skills'] = '';
       foreach ($employee->Skills as $key => $skills) {
           $data['employee_skills'] .= $skills->title.',';
       }


       $data['salutation'] = Saluation::orderBy('name', 'asc')->get();
 $data['education'] = $employee->EmployeeEducation;
         $data['educationlevel'] = EducationLevel::orderBy('name', 'asc')->get();
            $data['faculties'] = Faculty::orderBy('name', 'asc')->get();
        $data['marksystem'][] = ['value' => 1, 'title' => 'Percentage'];
        $data['marksystem'][] = ['value' => 2, 'title' => 'CGPA out of 4'];
        $data['marksystem'][] = ['value' => 3, 'title' => 'CGPA out of 10'];


        $data['training'] = $employee->EmployeeTraining;
        $data['experience'] = $employee->EmployeeExperience;

        $data['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();


        $data['employment_type'][] = ['value' => 'Part Time'];
        $data['employment_type'][] = ['value' => 'Full Time'];

        $data['job_level'][] = ['value' => 'Entry Level'];
        $data['job_level'][] = ['value' => 'Junior Level'];
        $data['job_level'][] = ['value' => 'Mid Level'];
        $data['job_level'][] = ['value' => 'Senior Level'];

        $data['working_status'][] = ['value' => 2, 'title' => 'Not Working'];
        $data['working_status'][] = ['value' => 1, 'title' => 'Currently Working'];
$data['language'] = $employee->EmployeeLanguage;


        $data['easy'][] = ['value' => 'Easily'];
        $data['easy'][] = ['value' => 'Not Easily'];

        $data['fluent'][] = ['value' => 'Fluently'];
        $data['fluent'][] = ['value' => 'Not Fluently'];
$data['reference'] = $employee->EmployeeReference;


        $data['employee_category'] = array();
         $data['employee_location'] = array();
         $data['employee_org'] = array();

         $emcategory = $employee->EmployeeCategory;


            foreach ($emcategory as $ec) {
             $data['employee_category'][] = $ec->job_category_id;
         }



             foreach ($employee->EmployeeLocation as $el) {
                 $data['employee_location'][] = $el->job_location_id;
             }


           foreach ($employee->EmployeeOrganization as $eo) {
             $data['employee_org'][] = $eo->org_type_id;
         }





         $data['jobcategory'] = JobCategory::orderBy('name', 'asc')->get();
       $data['joblocation'] = JobLocation::orderBy('name', 'asc')->get();
       $data['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();
$data['whocan'][] = ['value' => '0', 'title' => 'Anyone'];
        $data['whocan'][] = ['value' => 1, 'title' => 'Only you'];
        $data['whocan'][] = ['value' => 2, 'title' => 'Your alumni & colleagues'];
        $data['whocan'][] = ['value' => 3, 'title' => 'Your circle'];

        $data['socials'] = [];

        if ($data['employee_setting']->socials) {
          $data['socials'] = json_decode($data['employee_setting']->socials);
        }


      return view('employee.viewprofile', compact('data'));
    }

    public function changePassword(Request $request)
    {
        $user = auth()->guard('employee')->user();
        return view('employee.changepassword')->with('user', $user);
    }

    public function updatelogin(Request $request)
    {
        $json = [];
        $this->validate($request, [
                'id' => 'required|integer',

                'password' => 'confirmed|min:6',
            ]);
        Employees::where('id', $request->id)->update(['password' => bcrypt($request->password)]);
        return response()->json($json);
    }
    public function editProfile(Request $request)
    {
         $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();

        $datas = array();
         $datas['employee'] = $employee;


         $datas['employee_address'] = $employee->EmployeeAddress;

         $datas['employee_setting'] = $employee->EmployeeSetting;


       $datas['status'][] = ['value' => 3, 'title' => 'Pending'];
       $datas['status'][] = ['value' => 1, 'title' => 'Active'];
       $datas['status'][] = ['value' => 2, 'title' => 'Disabled'];

       $datas['marital_status'][] = ['value' => 'Single'];
        $datas['marital_status'][] = ['value' => 'Married'];
        $datas['marital_status'][] = ['value' => 'Divorced'];

        $datas['genders'][] = ['value' => 'Male'];
        $datas['genders'][] = ['value' => 'Female'];
        $datas['genders'][] = ['value' => 'Others'];

        $datas['vehicles'][] = ['value' => 'Two Wheeler'];
        $datas['vehicles'][] = ['value' => 'Four Wheeler'];
        $datas['vehicles'][] = ['value' => 'Both'];



    $datas['nationality'][] = ['value'=>'afghan'];
  $datas['nationality'][] = ['value'=>'albanian'];
  $datas['nationality'][] = ['value'=>'algerian'];
  $datas['nationality'][] = ['value'=>'american'];
  $datas['nationality'][] = ['value'=>'andorran'];
  $datas['nationality'][] = ['value'=>'angolan'];
  $datas['nationality'][] = ['value'=>'antiguans'];
  $datas['nationality'][] = ['value'=>'argentinean'];
  $datas['nationality'][] = ['value'=>'armenian'];
  $datas['nationality'][] = ['value'=>'australian'];
  $datas['nationality'][] = ['value'=>'austrian'];
  $datas['nationality'][] = ['value'=>'azerbaijani'];
  $datas['nationality'][] = ['value'=>'bahamian'];
  $datas['nationality'][] = ['value'=>'bahraini'];
  $datas['nationality'][] = ['value'=>'bangladeshi'];
  $datas['nationality'][] = ['value'=>'barbadian'];
  $datas['nationality'][] = ['value'=>'barbudans'];
  $datas['nationality'][] = ['value'=>'batswana'];
  $datas['nationality'][] = ['value'=>'belarusian'];
  $datas['nationality'][] = ['value'=>'belgian'];
  $datas['nationality'][] = ['value'=>'belizean'];
  $datas['nationality'][] = ['value'=>'beninese'];
  $datas['nationality'][] = ['value'=>'bhutanese'];
  $datas['nationality'][] = ['value'=>'bolivian'];
  $datas['nationality'][] = ['value'=>'bosnian'];
  $datas['nationality'][] = ['value'=>'brazilian'];
  $datas['nationality'][] = ['value'=>'british'];
  $datas['nationality'][] = ['value'=>'bruneian'];
  $datas['nationality'][] = ['value'=>'bulgarian'];
  $datas['nationality'][] = ['value'=>'burkinabe'];
  $datas['nationality'][] = ['value'=>'burmese'];
  $datas['nationality'][] = ['value'=>'burundian'];
  $datas['nationality'][] = ['value'=>'cambodian'];
  $datas['nationality'][] = ['value'=>'cameroonian'];
  $datas['nationality'][] = ['value'=>'canadian'];
  $datas['nationality'][] = ['value'=>'cape verdean'];
  $datas['nationality'][] = ['value'=>'central african'];
  $datas['nationality'][] = ['value'=>'chadian'];
  $datas['nationality'][] = ['value'=>'chilean'];
  $datas['nationality'][] = ['value'=>'chinese'];
  $datas['nationality'][] = ['value'=>'colombian'];
  $datas['nationality'][] = ['value'=>'comoran'];
  $datas['nationality'][] = ['value'=>'congolese'];
  $datas['nationality'][] = ['value'=>'costa rican'];
  $datas['nationality'][] = ['value'=>'croatian'];
  $datas['nationality'][] = ['value'=>'cuban'];
  $datas['nationality'][] = ['value'=>'cypriot'];
  $datas['nationality'][] = ['value'=>'czech'];
  $datas['nationality'][] = ['value'=>'danish'];
  $datas['nationality'][] = ['value'=>'djibouti'];
  $datas['nationality'][] = ['value'=>'dominican'];
  $datas['nationality'][] = ['value'=>'dutch'];
  $datas['nationality'][] = ['value'=>'east timorese'];
  $datas['nationality'][] = ['value'=>'ecuadorean'];
  $datas['nationality'][] = ['value'=>'egyptian'];
  $datas['nationality'][] = ['value'=>'emirian'];
  $datas['nationality'][] = ['value'=>'equatorial guinean'];
  $datas['nationality'][] = ['value'=>'eritrean'];
  $datas['nationality'][] = ['value'=>'estonian'];
  $datas['nationality'][] = ['value'=>'ethiopian'];
  $datas['nationality'][] = ['value'=>'fijian'];
  $datas['nationality'][] = ['value'=>'filipino'];
  $datas['nationality'][] = ['value'=>'finnish'];
  $datas['nationality'][] = ['value'=>'french'];
  $datas['nationality'][] = ['value'=>'gabonese'];
  $datas['nationality'][] = ['value'=>'gambian'];
  $datas['nationality'][] = ['value'=>'georgian'];
  $datas['nationality'][] = ['value'=>'german'];
  $datas['nationality'][] = ['value'=>'ghanaian'];
  $datas['nationality'][] = ['value'=>'greek'];
  $datas['nationality'][] = ['value'=>'grenadian'];
  $datas['nationality'][] = ['value'=>'guatemalan'];
  $datas['nationality'][] = ['value'=>'guinea-bissauan'];
  $datas['nationality'][] = ['value'=>'guinean'];
  $datas['nationality'][] = ['value'=>'guyanese'];
  $datas['nationality'][] = ['value'=>'haitian'];
  $datas['nationality'][] = ['value'=>'herzegovinian'];
  $datas['nationality'][] = ['value'=>'honduran'];
  $datas['nationality'][] = ['value'=>'hungarian'];
  $datas['nationality'][] = ['value'=>'icelander'];
  $datas['nationality'][] = ['value'=>'indian'];
  $datas['nationality'][] = ['value'=>'indonesian'];
  $datas['nationality'][] = ['value'=>'iranian'];
  $datas['nationality'][] = ['value'=>'iraqi'];
  $datas['nationality'][] = ['value'=>'irish'];
  $datas['nationality'][] = ['value'=>'israeli'];
  $datas['nationality'][] = ['value'=>'italian'];
  $datas['nationality'][] = ['value'=>'ivorian'];
  $datas['nationality'][] = ['value'=>'jamaican'];
  $datas['nationality'][] = ['value'=>'japanese'];
  $datas['nationality'][] = ['value'=>'jordanian'];
  $datas['nationality'][] = ['value'=>'kazakhstani'];
  $datas['nationality'][] = ['value'=>'kenyan'];
  $datas['nationality'][] = ['value'=>'kittian and nevisian'];
  $datas['nationality'][] = ['value'=>'kuwaiti'];
  $datas['nationality'][] = ['value'=>'kyrgyz'];
  $datas['nationality'][] = ['value'=>'laotian'];
  $datas['nationality'][] = ['value'=>'latvian'];
  $datas['nationality'][] = ['value'=>'lebanese'];
  $datas['nationality'][] = ['value'=>'liberian'];
  $datas['nationality'][] = ['value'=>'libyan'];
  $datas['nationality'][] = ['value'=>'liechtensteiner'];
  $datas['nationality'][] = ['value'=>'lithuanian'];
  $datas['nationality'][] = ['value'=>'luxembourger'];
  $datas['nationality'][] = ['value'=>'macedonian'];
  $datas['nationality'][] = ['value'=>'malagasy'];
  $datas['nationality'][] = ['value'=>'malawian'];
  $datas['nationality'][] = ['value'=>'malaysian'];
  $datas['nationality'][] = ['value'=>'maldivan'];
  $datas['nationality'][] = ['value'=>'malian'];
  $datas['nationality'][] = ['value'=>'maltese'];
  $datas['nationality'][] = ['value'=>'marshallese'];
  $datas['nationality'][] = ['value'=>'mauritanian'];
  $datas['nationality'][] = ['value'=>'mauritian'];
  $datas['nationality'][] = ['value'=>'mexican'];
  $datas['nationality'][] = ['value'=>'micronesian'];
  $datas['nationality'][] = ['value'=>'moldovan'];
  $datas['nationality'][] = ['value'=>'monacan'];
  $datas['nationality'][] = ['value'=>'mongolian'];
  $datas['nationality'][] = ['value'=>'moroccan'];
  $datas['nationality'][] = ['value'=>'mosotho'];
  $datas['nationality'][] = ['value'=>'motswana'];
  $datas['nationality'][] = ['value'=>'mozambican'];
  $datas['nationality'][] = ['value'=>'namibian'];
  $datas['nationality'][] = ['value'=>'nauruan'];

  $datas['nationality'][] = ['value'=>'new zealander'];
  $datas['nationality'][] = ['value'=>'nepalese'];
  $datas['nationality'][] = ['value'=>'ni-vanuatu'];
  $datas['nationality'][] = ['value'=>'nicaraguan'];
  $datas['nationality'][] = ['value'=>'nigerien'];
  $datas['nationality'][] = ['value'=>'north korean'];
  $datas['nationality'][] = ['value'=>'northern irish'];
  $datas['nationality'][] = ['value'=>'norwegian'];
  $datas['nationality'][] = ['value'=>'omani'];
  $datas['nationality'][] = ['value'=>'pakistani'];
  $datas['nationality'][] = ['value'=>'palauan'];
  $datas['nationality'][] = ['value'=>'panamanian'];
  $datas['nationality'][] = ['value'=>'papua new guinean'];
  $datas['nationality'][] = ['value'=>'paraguayan'];
  $datas['nationality'][] = ['value'=>'peruvian'];
  $datas['nationality'][] = ['value'=>'polish'];
  $datas['nationality'][] = ['value'=>'portuguese'];
  $datas['nationality'][] = ['value'=>'qatari'];
  $datas['nationality'][] = ['value'=>'romanian'];
  $datas['nationality'][] = ['value'=>'russian'];
  $datas['nationality'][] = ['value'=>'rwandan'];
  $datas['nationality'][] = ['value'=>'saint lucian'];
  $datas['nationality'][] = ['value'=>'salvadoran'];
  $datas['nationality'][] = ['value'=>'samoan'];
  $datas['nationality'][] = ['value'=>'san marinese'];
  $datas['nationality'][] = ['value'=>'sao tomean'];
  $datas['nationality'][] = ['value'=>'saudi'];
  $datas['nationality'][] = ['value'=>'scottish'];
  $datas['nationality'][] = ['value'=>'senegalese'];
  $datas['nationality'][] = ['value'=>'serbian'];
  $datas['nationality'][] = ['value'=>'seychellois'];
  $datas['nationality'][] = ['value'=>'sierra leonean'];
  $datas['nationality'][] = ['value'=>'singaporean'];
  $datas['nationality'][] = ['value'=>'slovakian'];
  $datas['nationality'][] = ['value'=>'slovenian'];
  $datas['nationality'][] = ['value'=>'solomon islander'];
  $datas['nationality'][] = ['value'=>'somali'];
  $datas['nationality'][] = ['value'=>'south african'];
  $datas['nationality'][] = ['value'=>'south korean'];
  $datas['nationality'][] = ['value'=>'spanish'];
  $datas['nationality'][] = ['value'=>'sri lankan'];
  $datas['nationality'][] = ['value'=>'sudanese'];
  $datas['nationality'][] = ['value'=>'surinamer'];
  $datas['nationality'][] = ['value'=>'swazi'];
  $datas['nationality'][] = ['value'=>'swedish'];
  $datas['nationality'][] = ['value'=>'swiss'];
  $datas['nationality'][] = ['value'=>'syrian'];
  $datas['nationality'][] = ['value'=>'taiwanese'];
  $datas['nationality'][] = ['value'=>'tajik'];
  $datas['nationality'][] = ['value'=>'tanzanian'];
  $datas['nationality'][] = ['value'=>'thai'];
  $datas['nationality'][] = ['value'=>'togolese'];
  $datas['nationality'][] = ['value'=>'tongan'];
  $datas['nationality'][] = ['value'=>'trinidadian or tobagonian'];
  $datas['nationality'][] = ['value'=>'tunisian'];
  $datas['nationality'][] = ['value'=>'turkish'];
  $datas['nationality'][] = ['value'=>'tuvaluan'];
  $datas['nationality'][] = ['value'=>'ugandan'];
  $datas['nationality'][] = ['value'=>'ukrainian'];
  $datas['nationality'][] = ['value'=>'uruguayan'];
  $datas['nationality'][] = ['value'=>'uzbekistani'];
  $datas['nationality'][] = ['value'=>'venezuelan'];
  $datas['nationality'][] = ['value'=>'vietnamese'];
  $datas['nationality'][] = ['value'=>'welsh'];
  $datas['nationality'][] = ['value'=>'yemenite'];
  $datas['nationality'][] = ['value'=>'zambian'];
  $datas['nationality'][] = ['value'=>'zimbabwean'];


  $datas['district'][] =['value'=>'Achham'];
$datas['district'][] =['value'=>'Arghakhanchi'];
$datas['district'][] =['value'=>'Baglung'];
$datas['district'][] =['value'=>'Baitadi'];
$datas['district'][] =['value'=>'Bajhang'];
$datas['district'][] =['value'=>'Bajura'];
$datas['district'][] =['value'=>'Banke'];
$datas['district'][] =['value'=>'Bardiya'];
$datas['district'][] =['value'=>'Bara'];
$datas['district'][] =['value'=>'Bhaktapur'];
$datas['district'][] =['value'=>'Bhojpur'];
$datas['district'][] =['value'=>'Chitwan'];
$datas['district'][] =['value'=>'Dhankuta'];
$datas['district'][] =['value'=>'Dhanusa'];
$datas['district'][] =['value'=>'Dolakha'];
$datas['district'][] =['value'=>'Dhading'];
$datas['district'][] =['value'=>'Dang'];
$datas['district'][] =['value'=>'Dolpa'];
$datas['district'][] =['value'=>'Dailekh'];
$datas['district'][] =['value'=>'Doti'];
$datas['district'][] =['value'=>'Dadeldhura'];
$datas['district'][] =['value'=>'Darchula'];
$datas['district'][] =['value'=>'Gorkha'];
$datas['district'][] =['value'=>'Gulmi'];
$datas['district'][] =['value'=>'Humla'];
$datas['district'][] =['value'=>'Ilam'];
$datas['district'][] =['value'=>'Jajarkot'];
$datas['district'][] =['value'=>'Jhapa'];
$datas['district'][] =['value'=>'Jumla'];
$datas['district'][] =['value'=>'Khotang'];
$datas['district'][] =['value'=>'Kathmandu'];
$datas['district'][] =['value'=>'Kavrepalanchok'];
$datas['district'][] =['value'=>'Kaski'];
$datas['district'][] =['value'=>'Kapilvastu'];
$datas['district'][] =['value'=>'Kalikot'];
$datas['district'][] =['value'=>'Kailali'];
$datas['district'][] =['value'=>'Kanchanpur'];
$datas['district'][] =['value'=>'Lalitpur'];
$datas['district'][] =['value'=>'Lamjung'];
$datas['district'][] =['value'=>'Manang'];
$datas['district'][] =['value'=>'Morang'];
$datas['district'][] =['value'=>'Mahottari'];
$datas['district'][] =['value'=>'Makwanpur'];
$datas['district'][] =['value'=>'Myagdi'];
$datas['district'][] =['value'=>'Mustang'];
$datas['district'][] =['value'=>'Mugu'];
$datas['district'][] =['value'=>'Nuwakot'];
$datas['district'][] =['value'=>'Nawalparasi'];
$datas['district'][] =['value'=>'Okhaldhunga'];
$datas['district'][] =['value'=>'Panchthar'];
$datas['district'][] =['value'=>'Parsa'];
$datas['district'][] =['value'=>'Palpa'];
$datas['district'][] =['value'=>'Parbat'];
$datas['district'][] =['value'=>'Pyuthan'];
$datas['district'][] =['value'=>'Ramechhap'];
$datas['district'][] =['value'=>'Rautahat'];
$datas['district'][] =['value'=>'Rasuwa'];
$datas['district'][] =['value'=>'Rupandehi'];
$datas['district'][] =['value'=>'Rolpa'];
$datas['district'][] =['value'=>'Rukum'];
$datas['district'][] =['value'=>'Sunsari'];
$datas['district'][] =['value'=>'Sankhuwasabha'];
$datas['district'][] =['value'=>'Saptari'];
$datas['district'][] =['value'=>'Siraha'];
$datas['district'][] =['value'=>'Solukhumbu'];
$datas['district'][] =['value'=>'Sarlahi'];
$datas['district'][] =['value'=>'Sindhuli'];
$datas['district'][] =['value'=>'Sindhupalchowk'];
$datas['district'][] =['value'=>'Syangja'];
$datas['district'][] =['value'=>'Salyan'];
$datas['district'][] =['value'=>'Surkhet'];
$datas['district'][] =['value'=>'Tanahun'];
$datas['district'][] =['value'=>'Taplejung'];
$datas['district'][] =['value'=>'Terhathum'];
$datas['district'][] =['value'=>'Udayapur'];
$datas['district'][] =['value'=>'Other Country'];


        $datas['yes_no'][] = ['value' => 0, 'title' => 'No'];
        $datas['yes_no'][] = ['value' => 1, 'title' => 'Yes'];
        $datas['skills'] = '';
       foreach ($employee->Skills as $key => $skills) {
           $datas['skills'] .= $skills->title.',';
       }


       $datas['salutation'] = Saluation::orderBy('name', 'asc')->get();
       $tab = 'info-tab';
       if (session()->has('tab')) {
         $tab = session()->get('tab');
       }
       $datas['tab'] = $tab;

    //educations tab


       $datas['education'] = $employee->EmployeeEducation;
         $datas['educationlevel'] = EducationLevel::orderBy('name', 'asc')->get();
            $datas['faculties'] = Faculty::orderBy('name', 'asc')->get();
        $datas['marksystem'][] = ['value' => 1, 'title' => 'Percentage'];
        $datas['marksystem'][] = ['value' => 2, 'title' => 'CGPA out of 4'];
        $datas['marksystem'][] = ['value' => 3, 'title' => 'CGPA out of 10'];


        $datas['training'] = $employee->EmployeeTraining;
        $datas['experience'] = $employee->EmployeeExperience;

        $datas['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();


        $datas['employment_type'][] = ['value' => 'Part Time'];
        $datas['employment_type'][] = ['value' => 'Full Time'];

        $datas['job_level'][] = ['value' => 'Entry Level'];
        $datas['job_level'][] = ['value' => 'Junior Level'];
        $datas['job_level'][] = ['value' => 'Mid Level'];
        $datas['job_level'][] = ['value' => 'Senior Level'];

        $datas['working_status'][] = ['value' => 2, 'title' => 'Not Working'];
        $datas['working_status'][] = ['value' => 1, 'title' => 'Currently Working'];
        $total_experience = 0;
        foreach ($datas['experience'] as $key => $exp) {
          if (!empty($exp->from) && !empty($exp->to)) {
            $diff = Carbon::parse($exp->from)->diffInDays(Carbon::parse($exp->to));
            $years = $diff / 360;
            $total_experience += number_format((float)$years, 2, '.', '');



          }
        }

        $datas['language'] = $employee->EmployeeLanguage;


        $datas['easy'][] = ['value' => 'Easily'];
        $datas['easy'][] = ['value' => 'Not Easily'];

        $datas['fluent'][] = ['value' => 'Fluently'];
        $datas['fluent'][] = ['value' => 'Not Fluently'];

        EmployeeSetting::where('employees_id',$employee->id)->update(['total_experience' => $total_experience]);


        $datas['reference'] = $employee->EmployeeReference;


        $datas['employee_category'] = array();
         $datas['employee_location'] = array();
         $datas['employee_org'] = array();

         $emcategory = $employee->EmployeeCategory;


            foreach ($emcategory as $ec) {
             $datas['employee_category'][] = $ec->job_category_id;
         }



             foreach ($employee->EmployeeLocation as $el) {
                 $datas['employee_location'][] = $el->job_location_id;
             }


           foreach ($employee->EmployeeOrganization as $eo) {
             $datas['employee_org'][] = $eo->org_type_id;
         }



         $datas['jobcategory'] = JobCategory::orderBy('name', 'asc')->get();
       $datas['joblocation'] = JobLocation::orderBy('name', 'asc')->get();
       $datas['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();



       $documents = $employee->EmployeeFiles;

        $datas['files'] = [];
        if (isset($employee->resume) && !empty($employee->resume)) {
            $ext = strtolower(substr(strrchr($employee->resume, '.'), 1));
            if ($ext == 'pdf') {
               $rthumb = Imagetool::resize('pdf_icon.png', 100, 100);
            } else {
                $rthumb = Imagetool::resize('ms-word.png', 100, 100);
            }
            $rname = str_split(basename($employee->resume), 14);

            $datas['files'][] = array(
                        'id' => 0,
                        'thumb' => $rthumb,
                        'title' => 'Resume',
                        'f_name' => implode(' ', $rname),
                        'type' => 'Resume',
                        'url' => asset('image/'.$employee->resume),
                    );
        }


        foreach ($documents as $key => $ef) {
             $allowed = array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png',

                );

             $docallowed = ['doc','docx'];
                if (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $allowed)) {
                    $thumb = Imagetool::resize($ef->file_location, 100, 100);
                }elseif (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $docallowed)) {
                    $thumb = Imagetool::resize('ms-word.png', 100, 100);
                } else {
                    $thumb = Imagetool::resize('pdf_icon.png', 100, 100);
                }
                $name = str_split(basename($ef->file_location), 14);

                    $datas['files'][] = array(
                        'id' => $ef->id,
                        'thumb' => $thumb,
                        'title' => $ef->title,
                        'f_name' => implode(' ', $name),
                        'type' => 'document',
                        'url' => asset('image/'.$ef->file_location),
                    );


        }

         $datas['whocan'][] = ['value' => '0', 'title' => 'Anyone'];
        $datas['whocan'][] = ['value' => 1, 'title' => 'Only you'];
        $datas['whocan'][] = ['value' => 2, 'title' => 'Your alumni & colleagues'];
        $datas['whocan'][] = ['value' => 3, 'title' => 'Your circle'];

        $datas['socials'] = [];

        if ($datas['employee_setting']->socials) {
          $datas['socials'] = json_decode($datas['employee_setting']->socials);
        }

               //dd($datas);
        return view('employee.editprofile')->with('datas', $datas);
    }

    public function updateProfile(Request $request)
    {
       // dd($request->all());

        $this->validate($request, [

                    'firstname' => 'required|min:3',
                    'lastname' => 'required|min:3',
                    'gender' => 'required',
                    'marital_status' => 'required',
                    'permanent_address' => 'required',
                    'mobile' => 'required',
                    'date_of_birth' => 'required',
                    'nationality' => 'required',
                    'id' => 'required|integer'
            ]);

        $employee_data = array(
                'saluation' => $request->salutation,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'dob' => $request->date_of_birth,
                'marital_status' => $request->marital_status,
                'nationality' => $request->nationality,
                'present_salary' => $request->present_salary,
                'expected_salary' => $request->expected_salary,
                'professional_heading' => $request->professional_heading,
                'description' => nl2br($request->description),

                    );

                $employee=Employees::where('id', $request->id)->update($employee_data);
                if($employee)
                {

                    $address = array(
                        'permanent_district' => $request->permanent_district,
                        'permanent' => $request->permanent_address,
                        'temporary_district' => $request->temporary_district,
                        'temporary' => $request->temporary_address,
                        'home_phone' => $request->home_phone,
                        'mobile' => $request->mobile,
                        'fax' => $request->fax,
                        'website' => $request->website );

                     $address1 = array(
                        'employees_id' => $request->id,
                        'permanent_district' => $request->permanent_district,
                        'permanent' => $request->permanent_address,
                        'temporary_district' => $request->temporary_district,
                        'temporary' => $request->temporary_address,
                        'home_phone' => $request->home_phone,
                        'mobile' => $request->mobile,
                        'fax' => $request->fax,
                        'website' => $request->website );
                    $add = EmployeeAddress::where('employees_id', $request->id)->first();
                    if (isset($add->id)) {
                        EmployeeAddress::where('employees_id', $request->id)->update($address);
                    } else{
                        EmployeeAddress::create($address1);
                    }
                     $diff = Carbon::parse($request->date_of_birth)->diffInDays(Carbon::now());
                        $years = $diff / 365;
                        $years = number_format((float)$years, 2, '.', '');

                    $setting = array(

                        'age' => $years );
                    EmployeeSetting::where('employees_id', $request->id)->update($setting);
                    $empskills = EmployeeSkills::where('employees_id', $request->id)->get();
                    $arrayskill = [];
                    foreach ($empskills as $key => $eskil) {
                        $arrayskill[] = $eskil->title;
                    }
                    if (!empty($request->skills)) {
                        $skills = explode(',', $request->skills);
                        $diffs = array_diff($arrayskill, $skills);

                        foreach ($diffs as $key => $diff) {
                            EmployeeSkills::where('employees_id', $request->id)->where('title', $diff)->delete();
                        }
                        if (count($skills) > 0) {
                            foreach ($skills as $key => $skill) {
                                if (!in_array($skill, $arrayskill)) {
                                    EmployeeSkills::create(['employees_id' => $request->id, 'title' => $skill]);
                                }
                            }
                        }
                    }

                    if (Session()->has('job_apply')) {
                      return redirect('/employee/jobapply/'.Session()->get('job_url'));
                    }
                     session(['tab' => $request->tab]);
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    } else {
        \Session::flash('alert-danger','Something went wrong while updating profile, please contact webmaster.');
                    return redirect()->back()->withInput();
    }
}


public function updateSetting(Request $request)
    {

      $this->validate($request, [
        'id' => 'required|integer',
        'social.*.title' => 'required',
        'social.*.url'  => 'required'
      ]);


      $social = NULL;
      if (isset($request->social)) {
        $social = json_encode($request->social);
      }


      $setting = array(
                        'travel' => $request->travel,
                        'license' => $request->license,
                        'licenseof' => $request->license_of,
                        'relocation' => $request->relocation,
                        'have_vehical' => $request->have_vehicle,
                        'vehical' => $request->vehicle,
                        'searchable' => $request->searchable,
                        'confidention' => $request->confidential,
                        'alertable' => $request->job_alert,

                        'find_you'  => $request->find_you,
                        'circle_request'  => $request->circle_request,
                        'email_privacy'   => $request->email_privacy,
                        'phone_privacy'   => $request->phone_privacy,
                        'circle_privacy'  => $request->circle_privacy,
                        'name_privacy'    => $request->name_privacy,
                        'score_privacy'   => $request->score_privacy,
                        'socials'         => $social,
                        'visit_privacy'   => $request->visit_privacy
                         );
                    EmployeeSetting::where('employees_id', $request->id)->update($setting);
            if (Session()->has('job_apply')) {
                      return redirect('/employee/jobapply/'.Session()->get('job_url'));
                    }
                    session(['tab' => $request->tab]);

                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function educations(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $datas['education'] = $employee->EmployeeEducation;
         $datas['educationlevel'] = EducationLevel::orderBy('name', 'asc')->get();
            $datas['faculties'] = Faculty::orderBy('name', 'asc')->get();
        $datas['marksystem'][] = ['value' => 1, 'title' => 'Percentage'];
        $datas['marksystem'][] = ['value' => 2, 'title' => 'CGPA out of 4'];
        $datas['marksystem'][] = ['value' => 3, 'title' => 'CGPA out of 10'];
            return view('employee.educations')->with('datas', $datas);

    }


    public function getfaculty(Request $request)
    {
        if (isset($request->id)) {
            $datas = Faculty::where('level_id', $request->id)->orderBy('name', 'asc')->get();

            return view('admin.faculty.faculties')->with('datas', $datas);
        }
    }

    public function deleteEducation(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
            $education = EmployeeEducation::where('id', $request->id)->first();
        if (isset($education->document)) {
          if (is_file(DIR_IMAGE.$education->document)) {
            File::delete(DIR_IMAGE.$education->document);
          }
        }
        EmployeeEducation::where('id', $request->id)->delete();
        return 'Success';
    }

    public function updateEducation(Request $request)
    {
        dd($request->all());

        if (isset($request->educations)) {
            $this->validate($request, [

                    'id' => 'required|integer',
                    'educations.*.country' => 'required|min:3',
                    'educations.*.level_id' => 'required|integer',
                    'educations.*.specialization' => 'required|min:3',
                    'educations.*.institution' => 'required|min:3',
                    'educations.*.board' => 'required|min:2',
                    'educations.*.marksystem' => 'required',
                    'educations.*.percent' => 'required|numeric',
                    'educations.*.year' => 'required|min:4|max:4',
            ]);
            $i = EmployeeEducation::where('employees_id', auth()->guard('employee')->user()->id)->count();
                        foreach ($request->educations as $key => $education) {
                            if ($education['institution_id'] > 0) {
                                $institution_id = $education['institution_id'];
                            } else{

                                $employers = \App\Employers::select('id')->where('name', $education['institution'])->first();
                                if (isset($employers->id)) {
                                    $institution_id = $employers->id;
                                }else{
                                    $datas = [
                                    'name' => $education['institution'],
                                    'seo_url' => str_replace(" ","-",$education['institution']),
                                    'member_type' => 4,
                                    'status' => 1
                                ];
                                $employer = \App\Employer::create($datas);
                                if($employer){
                                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                                     $institution_id = $employer->id;
                                 } else{
                                    $institution_id = $education['institution_id'];
                                 }
                                }

                            }

                                $edu = [
                                'employees_id' => $request->id,
                                'country' => $education['country'],
                                'level_id' => $education['level_id'],
                                'faculty_id' => $education['faculty'],
                                'specialization' => $education['specialization'],
                                'institution' => $education['institution'],
                                'board' => $education['board'],
                                'marksystem' => $education['marksystem'],
                                'percentage' => $education['percent'],
                                'year' => $education['year'],
                                'sn' => $i++,
                                'employers_id' => $institution_id
                            ];
                            EmployeeEducation::create($edu);

                        }
                    }

            if (Session()->has('job_apply')) {
              return redirect('/employee/jobapply/'.Session()->get('job_url'));
            }
         \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function training(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $datas['training'] = $employee->EmployeeTraining;

            return view('employee.trainings')->with('datas', $datas);

    }

     public function deleteTraining(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
         $training = EmployeeTraining::where('id', $request->id)->first();
        if (isset($training->document)) {
          if (is_file(DIR_IMAGE.$training->document)) {
            File::delete(DIR_IMAGE.$training->document);
          }
        }
        EmployeeTraining::where('id', $request->id)->delete();
        return 'Success';
    }

    public function updateTraining(Request $request)
    {
        //dd($request->all());


        if (isset($request->training)) {
             $this->validate($request, [

                    'id' => 'required|integer',
                    'training.*.title' => 'required|min:3',
                    'training.*.details' => 'required|min:3',
                    'training.*.institution' => 'required|min:3',
                    'training.*.duration' => 'required',
                    'training.*.year' => 'required|min:4|max:4',
            ]);
             $i = EmployeeTraining::where('employees_id', auth()->guard('employee')->user()->id)->count();
                        foreach ($request->training as $key => $training) {


                              if ($training['institution_id'] > 0) {
                                $institution_id = $training['institution_id'];
                            } else{

                                $employers = \App\Employers::select('id')->where('name', $training['institution'])->first();
                                if (isset($employers->id)) {
                                    $institution_id = $employers->id;
                                }else{
                                    $datas = [
                                    'name' => $training['institution'],
                                    'seo_url' => str_replace(" ","-",$training['institution']),
                                    'member_type' => 4,
                                    'status' => 1
                                ];
                                $employer = \App\Employer::create($datas);
                                if($employer){
                                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                                     $institution_id = $employer->id;
                                 } else{
                                    $institution_id = $training['institution_id'];
                                 }
                                }

                            }

                                $tra = [
                                'employees_id' => $request->id,
                                'title' => $training['title'],
                                'details' => $training['details'],
                                'institution' => $training['institution'],
                                'duration' => $training['duration'],
                                'year' => $training['year'],
                                'sn' => $i++,
                                'employers_id' => $institution_id
                            ];
                            EmployeeTraining::create($tra);

                        }
                    }
        if (Session()->has('job_apply')) {
              return redirect('/employee/jobapply/'.Session()->get('job_url'));
            }
         \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function experience(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $datas['experience'] = $employee->EmployeeExperience;

        $datas['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();


        $datas['employment_type'][] = ['value' => 'Part Time'];
        $datas['employment_type'][] = ['value' => 'Full Time'];

        $datas['job_level'][] = ['value' => 'Entry Level'];
        $datas['job_level'][] = ['value' => 'Junior Level'];
        $datas['job_level'][] = ['value' => 'Mid Level'];
        $datas['job_level'][] = ['value' => 'Senior Level'];

        $datas['working_status'][] = ['value' => 2, 'title' => 'Not Working'];
        $datas['working_status'][] = ['value' => 1, 'title' => 'Currently Working'];
        $total_experience = 0;
        foreach ($datas['experience'] as $key => $exp) {
          if (!empty($exp->from) && !empty($exp->to)) {
            $diff = Carbon::parse($exp->from)->diffInDays(Carbon::parse($exp->to));
            $years = $diff / 360;
            $total_experience += number_format((float)$years, 2, '.', '');



          }
        }

        EmployeeSetting::where('employees_id',$employee->id)->update(['total_experience' => $total_experience]);

            return view('employee.experience')->with('datas', $datas);

    }

     public function deleteExprience(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
         $experience = EmployeeExperience::where('id', $request->id)->first();
        if (isset($experience->document)) {
          if (is_file(DIR_IMAGE.$experience->document)) {
            File::delete(DIR_IMAGE.$experience->document);
          }
        }
        EmployeeExperience::where('id', $request->id)->delete();
        return 'Success';
    }

    public function updateExprience(Request $request)
    {
        //dd($request->all());


        if (isset($request->experience)) {
             $this->validate($request, [

                    'id' => 'required|integer',
                    'experience.*.organization' => 'required|min:3',
                    'experience.*.typeofemployment' => 'required|min:3',
                    'experience.*.org_type_id' => 'required',
                    'experience.*.designation' => 'required|min:2',
                    'experience.*.level' => 'required|min:2',
                    'experience.*.from' => 'required|date_format:"Y-m-d"',
                    'experience.*.to' => 'required|date_format:"Y-m-d"',
                    'experience.*.currently_working' => 'required',
                    'experience.*.country' => 'required|min:2',
            ]);
             $i = EmployeeExperience::where('employees_id', auth()->guard('employee')->user()->id)->count();
                         foreach ($request->experience as $key => $experience) {

                             if ($experience['institution_id'] > 0) {
                                $institution_id = $experience['institution_id'];
                            } else{

                                $employers = \App\Employers::select('id')->where('name', $experience['organization'])->first();
                                if (isset($employers->id)) {
                                    $institution_id = $employers->id;
                                }else{
                                    $datas = [
                                    'name' => $experience['organization'],
                                    'seo_url' => str_replace(" ","-",$experience['organization']),
                                    'org_type' => $experience['org_type_id'],
                                    'member_type' => 4,
                                    'status' => 1
                                ];
                                $employer = \App\Employer::create($datas);
                                if($employer){
                                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                                     $institution_id = $employer->id;
                                 } else{
                                    $institution_id = $experience['institution_id'];
                                 }
                                }

                            }

                                $edu = [
                                'employees_id' => $request->id,
                                'sn' => $i++,
                                'organization' => $experience['organization'],
                                'typeofemployment' => $experience['typeofemployment'],
                                'org_type_id' => $experience['org_type_id'],
                                'designation' => $experience['designation'],
                                'level' => $experience['level'],
                                'from' => $experience['from'],
                                'to' => $experience['to'],
                                'currently_working' => $experience['currently_working'],
                                'country' => $experience['country'],
                                'experience' => nl2br($experience['detail']),
                                'employers_id' => $institution_id
                            ];
                            EmployeeExperience::create($edu);

                        }
                    }

                    if (Session()->has('job_apply')) {
                      return redirect('/employee/jobapply/'.Session()->get('job_url'));
                    }
         \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function language(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $datas['language'] = $employee->EmployeeLanguage;

         $datas['yes_no'][] = ['value' => 0, 'title' => 'No'];
        $datas['yes_no'][] = ['value' => 1, 'title' => 'Yes'];

        $datas['easy'][] = ['value' => 'Easily'];
        $datas['easy'][] = ['value' => 'Not Easily'];

        $datas['fluent'][] = ['value' => 'Fluently'];
        $datas['fluent'][] = ['value' => 'Not Fluently'];

            return view('employee.language')->with('datas', $datas);

    }

     public function deleteLanguage(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
        EmployeeLanguage::where('id', $request->id)->delete();
        return 'Success';
    }

    public function updateLanguage(Request $request)
    {


        $this->validate($request, [

                    'id' => 'required|integer',
                    'language.*.language' => 'required|min:3',

            ]);
        if (isset($request->language)) {
            $i = EmployeeLanguage::where('employees_id', auth()->guard('employee')->user()->id)->count();
                        foreach ($request->language as $key => $language) {

                                $lan = [
                                'employees_id' => $request->id,
                                'language' => $language['language'],
                                'understand' => $language['understand'],
                                'speak' => $language['speak'],
                                'reading' => $language['read'],
                                'writing' => $language['write'],
                                'mother_t' => $language['mother_t'],
                                'sn' => $i++,
                            ];
                            EmployeeLanguage::create($lan);

                        }
                    }
        if (Session()->has('job_apply')) {
              return redirect('/employee/jobapply/'.Session()->get('job_url'));
            }
         \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function reference(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $datas['reference'] = $employee->EmployeeReference;



        return view('employee.reference')->with('datas', $datas);

    }

     public function deleteReference(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
        EmployeeReference::where('id', $request->id)->delete();
        return 'Success';
    }

    public function updateReference(Request $request)
    {


        $this->validate($request, [

                    'id' => 'required|integer',
                    'reference.*.name' => 'required|min:3',
                    'reference.*.designation' => 'required|min:2',
                    'reference.*.address' => 'required|min:3',
                    'reference.*.mobile' => 'required|min:3',
                    'reference.*.company' => 'required|min:3',

            ]);
        if (isset($request->reference)) {
            $sn = EmployeeReference::where('employees_id', auth()->guard('employee')->user()->id)->count();
                        foreach ($request->reference as $key => $reference) {

                                $ref = [
                                    'employees_id' => $request->id,
                                    'sn' => $sn++,
                                    'name' => $reference['name'],
                                    'designation' => $reference['designation'],
                                    'address' => $reference['address'],
                                    'office_phone' => $reference['office_phone'],
                                    'mobile' => $reference['mobile'],
                                    'email' => $reference['ref_email'],
                                    'company' => $reference['company']
                                ];

                                $ref = EmployeeReference::create($ref);
                                $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
                                $datas = [
                                    'from_name' => Settings::getSettings()->name,
                                    'from_email' => Settings::getSettings()->email,
                                    'to_name' => $reference['name'],
                                    'to_email' => $reference['ref_email'],
                                    'subject' => 'Reference Conformation Email',
                                    'employee_name' => Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname),
                                    'designation' => $reference['designation'],
                                    'company' => $reference['company'],
                                    'name' => $reference['name'],
                                    'employee_email' => $employee->email,
                                ];
                                $this->sendReference($datas);
                                $today = Carbon::now()->todatestring();
                                EmployeeReference::where('id', $ref->id)->update(['send_date' => $today]);

                        }
                    }
        if (Session()->has('job_apply')) {
              return redirect('/employee/jobapply/'.Session()->get('job_url'));
            }
         \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public static function sendReference($datas)
    {
         set_time_limit(600);
         myFunctions::setEmail();
        Mail::send('employee.referencemail', ['datas' => $datas], function($mail) use ($datas){
                  $mail->to($datas['to_email'],$datas['to_name'])->from($datas['from_email'],$datas['from_name'])->subject($datas['subject']);
                        });
        return 'success';
    }

    public function uploadImage(Request $request)
    {
        $json = [];
        $directory = DIR_IMAGE . 'catalog/employees/'.auth()->guard('employee')->user()->id;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        if ($request->hasFile('file')) {
         $this->validate($request,
                        [
                    'file'=>'mimes:jpeg,jpg,png,gif|required|max:10000',

                        ]);

        $user_profile = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        if (isset($user_profile->image)) {

            if (is_file(DIR_IMAGE.$user_profile->image)) {
                    File::delete(DIR_IMAGE.$user_profile->image);


                }
        }
        $file = $request->File('file');
        $str = preg_replace('/\s+/', '', $file->getClientOriginalName());
            $path = $directory.'/' . $str;

            Image::make($file->getRealPath())->save($path);
            Employees::where('id',auth()->guard('employee')->user()->id)->update(['image' => 'catalog/employees/'.auth()->guard('employee')->user()->id.'/'.$str]);
        $json['image'] = asset('image/catalog/employees/'.auth()->guard('employee')->user()->id.'/'.$str);
          } else{
            $json['error'] = 'Error: File not found';
          }

          return response()->json($json);
    }

    public function coverletter(Request $request)
    {
         $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $cover = EmployeeCoverletter::where('employees_id', $employee->id)->first();
        if (isset($cover->title)) {
            $title = $cover->title;
        } else{
            $title = '';
        } if (isset($cover->detail)) {
            $details = $cover->detail;
        }else{
            $details = '';
        }
        $datas['title'] = $title;
        $datas['details'] = $details;


            return view('employee.coverletter')->with('datas', $datas);
    }

    public function updateCoverletter(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer',
                    'title' => 'required|min:3',
                    'details' => 'required|min:3',


            ]);
        $datas = [
            'employees_id' => $request->id,
            'title' => $request->title,
            'detail' => $request->details
        ];
        EmployeeCoverletter::where('employees_id', $request->id)->delete();
        EmployeeCoverletter::create($datas);
        \Session::flash('alert-success','Record have been updated Successfully');
        return redirect()->back();

    }

    public function location(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;

        $datas['employee_category'] = array();
         $datas['employee_location'] = array();
         $datas['employee_org'] = array();

         $emcategory = $employee->EmployeeCategory;


            foreach ($emcategory as $ec) {
             $datas['employee_category'][] = $ec->job_category_id;
         }



             foreach ($employee->EmployeeLocation as $el) {
                 $datas['employee_location'][] = $el->job_location_id;
             }


           foreach ($employee->EmployeeOrganization as $eo) {
             $datas['employee_org'][] = $eo->org_type_id;
         }



         $datas['jobcategory'] = JobCategory::orderBy('name', 'asc')->get();
       $datas['joblocation'] = JobLocation::orderBy('name', 'asc')->get();
       $datas['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();


       return view('employee.locations')->with('datas', $datas);
    }

    public function updateLocation(Request $request)
    {
         $json['data'] = '';


                    if (isset($request->job_location)) {

                      EmployeeLocation::where('employees_id', $request->id)->delete();
                        foreach ($request->job_location as $jlocation) {
                            $jl = [
                                'employees_id' => $request->id,
                                'job_location_id' => $jlocation
                            ];
                            EmployeeLocation::create($jl);
                            $json['data'] .= '<div><span class="squrebullet"></span><span>'.JobLocation::getName($jlocation).'</span></div>';
                        }
                    }

                    if (isset($request->job_category)) {
                      EmployeeCategory::where('employees_id', $request->id)->delete();
                        foreach ($request->job_category as $job_category) {
                            EmployeeCategory::create(['employees_id' => $request->id, 'job_category_id' => $job_category]);
                            $json['data'] .= '<div><span class="squrebullet"></span><span>'.JobCategory::getTitle($job_category).'</span></div>';
                        }
                    }
                    if (isset($request->organization_type)) {
                      EmployeeOrganization::where('employees_id', $request->id)->delete();
                        foreach ($request->organization_type as $ogtype) {
                            EmployeeOrganization::create(['employees_id' => $request->id, 'org_type_id' => $ogtype]);
                            $json['data'] .= '<div><span class="squrebullet"></span><span>'.OrganizationType::getOrgTypeTitle($ogtype).'</span></div>';
                        }
                    }

             return response()->json($json);
    }


    public function EmployeeDocuments(Request $request)
    {


        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();

        $datas = array();
        $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['employee'] = $employee;
        $documents = $employee->EmployeeFiles;

        $datas['files'] = [];
        if (isset($employee->resume) && !empty($employee->resume)) {
            $ext = strtolower(substr(strrchr($employee->resume, '.'), 1));
            if ($ext == 'pdf') {
               $rthumb = Imagetool::resize('pdf_icon.png', 100, 100);
            } else {
                $rthumb = Imagetool::resize('ms-word.png', 100, 100);
            }
            $rname = str_split(basename($employee->resume), 14);

            $datas['files'][] = array(
                        'id' => 0,
                        'thumb' => $rthumb,
                        'title' => 'Resume',
                        'f_name' => implode(' ', $rname),
                        'type' => 'Resume',
                        'url' => asset('image/'.$employee->resume),
                    );
        }


        foreach ($documents as $key => $ef) {
             $allowed = array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png',

                );

             $docallowed = ['doc','docx'];
                if (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $allowed)) {
                    $thumb = Imagetool::resize($ef->file_location, 100, 100);
                }elseif (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $docallowed)) {
                    $thumb = Imagetool::resize('ms-word.png', 100, 100);
                } else {
                    $thumb = Imagetool::resize('pdf_icon.png', 100, 100);
                }
                $name = str_split(basename($ef->file_location), 14);

                    $datas['files'][] = array(
                        'id' => $ef->id,
                        'thumb' => $thumb,
                        'title' => $ef->title,
                        'f_name' => implode(' ', $name),
                        'type' => 'document',
                        'url' => asset('image/'.$ef->file_location),
                    );


        }





            return view('employee.files')->with('datas', $datas);

    }

     public function deleteFiles(Request $request)
    {
        $this->validate($request, [

                    'id' => 'required|integer'
            ]);
        $file = EmployeeFiles::where('id', $request->id)->first();
        if(isset($file->file_location)){
        if (is_file(DIR_IMAGE.$file->file_location)) {
                    File::delete(DIR_IMAGE.$file->file_location);

                }
        }
        EmployeeFiles::where('id', $request->id)->delete();
        return 'Success';
    }

     public function deleteResume(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();

        if (is_file(DIR_IMAGE.$employee->resume)) {
                    File::delete(DIR_IMAGE.$employee->resume);


                }
        Employees::where('id', auth()->guard('employee')->user()->id)->update(['resume' => '']);
        return 'Success';
    }

    public function uploadResume(Request $request)
    {

        $directory = DIR_IMAGE . 'catalog/employees/'.auth()->guard('employee')->user()->id;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        if ($request->hasFile('resume')) {
         $v= Validator::make($request->all(), [

                    'resume'=>'required|mimes:docx,doc,pdf|max:10000',

                        ]);
                 if($v->fails())
                    {
                        \Session::flash('alert-danger','Your file type did not match or your file size is too big.');
                    return redirect()->back();
                    }

        $file = $request->File('resume');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);

            Employees::where('id',auth()->guard('employee')->user()->id)->update(['resume' => 'catalog/employees/'.auth()->guard('employee')->user()->id.'/'.$str]);

                }
        session(['tab' => 'document-tab']);
        \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
    }

    public function uploadFiles(Request $request)
    {

        session(['tab' => 'document-tab']);
        $directory = DIR_IMAGE . 'catalog/employees/'.auth()->guard('employee')->user()->id;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        if ($request->hasFile('documents')) {
         $v= Validator::make($request->all(),
                        [
                    'documents*'=>'mimes:jpeg,jpg,png,gif,pdf,doc,docx|required|max:10000',

                        ]);
                 if($v->fails())
                    {
                        \Session::flash('alert-danger','Your file type did not match or your file size is too big.');
                    return redirect()->back();
                    }

        $file = $request->File('documents');
            $ids = [];
         foreach ($request->File('documents') as $file) {
            $str = auth()->guard('employee')->user()->firstname.'-'.\Str::random(10).'.'.$file->getClientOriginalExtension();

                 $file->move($directory, $str);


            $e_files = EmployeeFiles::create(['employees_id' => auth()->guard('employee')->user()->id, 'file_location' =>  'catalog/employees/'.auth()->guard('employee')->user()->id.'/'.$str]);
            $ids[] = $e_files->id;
            }

            if (count($ids) > 0) {
                $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
                $datas = array();
                $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
                $datas['employee'] = $employee;

                $datas['files'] = [];
                foreach ($ids as $id) {
                    $ef = EmployeeFiles::where('id', $id)->first();

                    $allowed = array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png',

                );
                $word = ['doc','docx'];
                if (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $allowed)) {
                    $thumb = Imagetool::resize($ef->file_location, 100, 100);
                }elseif (in_array(strtolower(substr(strrchr($ef->file_location, '.'), 1)), $word)) {
                  $thumb = Imagetool::resize('ms-word.png', 100, 100);
                } else {
                    $thumb = Imagetool::resize('pdf_icon.png', 100, 100);
                }
                $name = str_split(basename($ef->file_location), 14);

                    $datas['files'][] = array(
                        'id' => $ef->id,
                        'thumb' => $thumb,
                        'title' => $ef->title,
                        'f_name' => implode(' ', $name),
                    );
                }
                return view('employee.upfiles')->with('datas', $datas);
            } else {
                \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect()->back();
            }


                }
                else {
                     \Session::flash('alert-danger','File did not found.');
                    return redirect()->back();
                }
    }

    public function updateTitle(Request $request)
    {
        foreach ($request->documents as $key => $document) {

            $datas = [
                'title' => $document["title"],
            ];
            EmployeeFiles::where('id', $key)->update($datas);
        }
        \Session::flash('alert-success','Successfully updated datas');
                    return redirect('employee/documents');
    }

    public function applied(Request $request)
    {
         $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
                $datas = array();
                $datas['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
        $datas['apply'] = JobApply::where('employees_id', auth()->guard('employee')->user()->id)->paginate(50);
        return view('employee.applies')->with('datas', $datas);
    }

    public function RecomendedProject(Request $request)
    {
        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
         $data['name'] = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
         $applies = ProjectApply::where('employees_id', $employee->id)->get();
           $apply = [];
           foreach ($applies as $key => $pa) {
               $apply[] = $pa->project_id;
           }
         $data['projects'] = [];
        //dd($employee->Skills);
       foreach ($employee->Skills as $key => $skills) {
           $prj = Project::whereNotIn('id', $apply)->where('skills', 'LIKE', '%'.$skills->title.'%')->where('status', 1)->inRandomOrder()->first();

           if (isset($prj->id)) {
            $apply[] = $prj->id;
               $data['projects'][] = [

                'title' => Settings::getLimitedWords($prj->title,0,10),
                'href' => url('/projects/'.$prj->seo_url),
                'publish_by' => Employers::getName($prj->employers_id),
                'skills' => $prj->skills,
                'description' => Settings::getLimitedWords($prj->description,0,10),
                'publish_date' => $prj->publish_date
               ];
           }
       }
       //dd($data);
       return view('employee.rec_project')->with('data', $data);


    }

    public function RecomendedJob(Request $request)
    {
         $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
         $name = Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname);
         $educations = $employee->EmployeeEducation;
         $experience = $employee->EmployeeExperience;
         $category = $employee->EmployeeCategory;
         $location = $employee->EmployeeLocation;
         $organization = $employee->EmployeeOrganization;
         $applies = $employee->Apply;

         $level = [];
         $faculty = [];
         $exp = [];
         $cat = [];
         $loc = [];
         $org = [];
         $app = [];
         if (count($educations) > 0) {
             foreach ($educations as $education) {
                 $level[] = $education->level_id;
                 $faculty[] = $education->faculty;
             }
         }
         $yr = 0;
         if (count($experience) > 0) {
            $dif = 0;
             foreach ($experience as $exper) {
                $from = explode('-', $exper->from);
                $to = explode('-', $exper->to);
                 $dt1 = Carbon::createFromDate($from[0], $from[1], $from[2]);
                 $dt2 = Carbon::createFromDate($to[0], $to[1], $to[2]);

                 $dif += $dt1->diffInDays($dt2);


             }
             $yr = $dif / 365;

         }
         if (count($category) > 0) {
             foreach ($category as $cate) {
                 $cat[] = $cate->job_category_id;
             }
         }
         if (count($location) > 0) {
             foreach ($location as $loca) {
                 $loc[] = $loca->job_location_id;
             }
         }

         if (count($organization) > 0) {
             foreach ($organization as $orge) {
                 $org[] = $orge->org_type_id;
             }
         }
         if (count($applies) > 0) {
             foreach ($applies as $apply) {
                 $app[] = $apply->jobs_id;
             }
         }
         if ($employee->dob != '') {
              $dob = explode('-', $employee->dob);
         $dt = Carbon::createFromDate($dob[0],$dob[1],$dob[2]);
         $now  = Carbon::now();
         $day = $dt->diffInDays($now);
         $year = $day / 365;
         } else {
            $year = 0;
         }
         $today = Carbon::now()->todatestring();



         $jobs = Jobs::whereIn('category_id', $cat)->whereIn('org_type_id', $org)->whereNotIn('id', $app)->where('min_experience', '<=', $yr)->whereIn('education_level', $level)->where('gender', 'Any')->where('status', 1)->where('deadline', '>=', $today)->paginate(50);

        return view('employee.rec_jobs')->with('jobs', $jobs)->with('name', $name);
    }


     public function followEmployer(Request $request)
    {
        if (isset($request->id)) {
           $emp = \App\Employers::where('id', $request->id)->first();
           if (isset($emp->id)) {
            if (isset($request->type)) {
              \App\EmployerFollow::where('employers_id', $request->id)->where('employees_id',auth()->guard('employee')->user()->id)->delete();
            } else{
              \App\EmployerFollow::create(['employers_id' => $request->id, 'employees_id' => auth()->guard('employee')->user()->id]);
            }

           }
        }
        return 'success';
    }


    public function fingerTest(Request $request)
    {
        $eng_high_score = \App\EmployeeFingertest::where('employees_id',auth()->guard('employee')->user()->id)->where('language', 'English')->orderBy('wpm', 'desc')->first();
        $nep_high_score = \App\EmployeeFingertest::where('employees_id',auth()->guard('employee')->user()->id)->where('language', 'Nepali')->orderBy('wpm', 'desc')->first();
        $datas= [];
        $datas['eng_attempt'] = \App\EmployeeFingertest::where('employees_id',auth()->guard('employee')->user()->id)->where('language', 'English')->count();
        $datas['nep_attempt'] = \App\EmployeeFingertest::where('employees_id',auth()->guard('employee')->user()->id)->where('language', 'Nepali')->count();
        if (isset($eng_high_score->wpm)) {
            $eng_wpm = $eng_high_score->wpm;
        } else{
            $eng_wpm = 0;
        }


        if (isset($nep_high_score->wpm)) {
            $nep_wpm = $nep_high_score->wpm;
        } else{
            $nep_wpm = 0;
        }
        $datas['eng_score'] = $eng_wpm;
        $datas['nep_score'] = $nep_wpm;
        $datas['eng_rank'] = 0;
        $datas['nep_rank'] = 0;
        $eng_top = \App\EmployeeFingertest::where('language', 'English')->orderBy('wpm', 'desc')->first();
        $nep_top = \App\EmployeeFingertest::where('language', 'Nepali')->orderBy('wpm', 'desc')->first();


        if (isset($eng_top->wpm)) {
            $eng_top_wpm = $eng_top->wpm;
            $eng_topper_id = $eng_top->employees_id;
        } else{
            $eng_top_wpm = 0;
            $eng_topper_id = 0;
        }

        if (isset($nep_top->wpm)) {
            $nep_top_wpm = $nep_top->wpm;
            $nep_topper_id = $nep_top->employees_id;
        } else{
            $nep_top_wpm = 0;
            $nep_topper_id = 0;
        }


        $datas['eng_top_score'] = $eng_top_wpm;
        $datas['nep_top_score'] = $nep_top_wpm;
        $datas['eng_topper_attempt'] = \App\EmployeeFingertest::where('employees_id', $eng_topper_id)->where('language', 'English')->count();
        $datas['nep_topper_attempt'] = \App\EmployeeFingertest::where('employees_id', $nep_topper_id)->where('language', 'Nepali')->count();
        $total_eng_test = \App\EmployeeFingertest::where('language', 'English')->groupBy('employees_id')->get();
        $datas['total_eng_test'] = count($total_eng_test);
        $total_np_test = \App\EmployeeFingertest::where('language', 'Nepali')->groupBy('employees_id')->get();
        $datas['total_np_test'] = count($total_np_test);
        $datas['total_employee'] = Employees::count();

        $eng_ranks = \App\EmployeeFingertest::where('language', 'English')->orderBy('wpm', 'desc')->get();
        $nep_ranks = \App\EmployeeFingertest::where('language', 'Nepali')->orderBy('wpm', 'desc')->get();



        foreach ($eng_ranks as $key => $eng_rank) {
            if ($eng_rank->employees_id == auth()->guard('employee')->user()->id) {
                $datas['eng_rank'] = $key + 1;
                break;
            }
        }

        foreach ($nep_ranks as $key => $nep_rank) {
            if ($nep_rank->employees_id == auth()->guard('employee')->user()->id) {
                $datas['nep_rank'] = $key + 1;
                break;
            }
        }




        if ($datas['total_eng_test'] > 0) {
          $enpe = ($datas['eng_rank'] / $datas['total_eng_test']) * 100;

            $datas['eng_rank_percent'] = 100 - $enpe;
        } else{
            $datas['eng_rank_percent'] = 0;
        }

        if ($datas['eng_topper_attempt'] > 0) {
            $datas['eng_attempt_percent'] = ($datas['eng_attempt'] / $datas['eng_topper_attempt']) * 100;
        } else{
            $datas['eng_attempt_percent'] = 0;
        }

        if ($datas['eng_top_score'] > 0) {
            $datas['eng_score_percent'] = ($datas['eng_score'] / $datas['eng_top_score']) * 100;
        } else{
            $datas['eng_score_percent'] = 0;
        }



        if ($datas['total_np_test'] > 0) {
            $npee = ($datas['nep_rank'] / $datas['total_np_test']) * 100;
            $datas['nep_rank_percent'] = 100 - $npee;
        } else{
            $datas['nep_rank_percent'] = 0;
        }

        if ($datas['nep_topper_attempt'] > 0) {
            $datas['nep_attempt_percent'] = ($datas['nep_attempt'] / $datas['nep_topper_attempt']) * 100;
        } else{
            $datas['nep_attempt_percent'] = 0;
        }

        if ($datas['nep_top_score'] > 0) {
            $datas['nep_score_percent'] = ($datas['nep_score'] / $datas['nep_top_score']) * 100;
        } else{
            $datas['nep_score_percent'] = 0;
        }
        if (session()->has('current_datas')) {
            $datas['current_score'] = session()->get('current_datas');
        }



        if (session()->has('type_language')) {
            $ses = session()->get('type_language');

            if ($ses == 'Nepali') {
                 return view('employee.finger_test_nepali')->with('datas', $datas);
            } else{
                 return view('employee.finger_test')->with('datas', $datas);
            }
            # code...
        } else{
            session(['type_language' => 'English']);
             return view('employee.finger_test')->with('datas', $datas);
        }



    }

    public function fingerTestSave(Request $request)
    {

        $datas = [
            'employees_id' => auth()->guard('employee')->user()->id,
            'language' => session()->get('type_language'),
            'correct' => $request->correct,
            'incorrect' => $request->incorrect,
            'keystrokes' => $request->keystrokes,
            'accuracy' => $request->accuracy,
            'wpm' => $request->wpm,

        ];

        \App\EmployeeFingertest::create($datas);

        session(['current_datas' => $datas]);

        return 'success';
    }

    public function changeLanguage(Request $request)
    {
        if (isset($request->language)) {
            session(['type_language' => $request->language]);
        }
        return 'success';
    }

    public function talentTest(Request $request)
    {
       $datas['category'] = \App\TestCategory::orderBy('title', 'asc')->get();

       $datas['test'] = [];

       $exams = TestExam::orderBy('title','asc')->get();

       foreach($exams as $exam)
       {
           $image = Imagetool::mycrop('no-image.png',280,200);
            if (is_file(DIR_IMAGE.$exam->image)) {
                      $image = Imagetool::mycrop($exam->image,280,200);
                    }

           $higest = TestAnswer::select('marks')->where('test_id',$exam->id)->orderBy('marks','desc')->first();
           $fastest = TestAnswer::select('duration')->where('test_id',$exam->id)->orderBy('duration','asc')->first();
           $total = TestAnswer::where('test_id',$exam->id)->count();

           $highest_mark = '';
           $fast = '';

            $your_high = TestAnswer::where('test_id',$exam->id)->where('employes_id', auth()->guard('employee')->user()->id)->orderBy('marks','desc')->first();

           $yhighest = '';

           if(isset($your_high->marks))
           {
               $yhighest = $your_high->marks;
           }

           if(isset($higest->marks))
           {
               $highest_mark = $higest->marks;
           }
           if(isset($fastest->duration))
           {
               $fast = $fastest->duration;
           }

           $total_test = TestAnswer::where('test_id',$exam->id)->groupBy('test_id')->count();
           $alltests = TestAnswer::select('employes_id')->where('test_id',$exam->id)->orderBy('marks', 'desc')->get();
            $rank = '';
            foreach ($alltests as $key => $alltest) {
                if ($alltest->employes_id == auth()->guard('employee')->user()->id) {
                   $rank = $key +1;
                   break;
                }
            }


            $datas['test'][] = [
                'title' => $exam->title,
                'image' => $image,
                'href' => url('/skill-test/'.$exam->seo_url),
                'total_your_test' => $total,
                'your_higest' => $highest_mark,
                'your_fastest' => $fast,
                'your_rank' => $rank,
                'total_test' => $total_test,
                'your_highest' => $yhighest,
            ];

       }

       $datas['category_id'] = '';

       return view('employee.test_exam.int_test')->with('datas', $datas);
    }

    public function talentCategory($seo,Request $request)
    {
       $datas['category'] = \App\TestCategory::orderBy('title', 'asc')->get();
       $category = \App\TestCategory::where('seo_url', $seo)->first();
       if (isset($category->id)) {
           $category_id = $category->id;
       }else{
        $category_id = 0;
       }
        $datas['test'] = [];
       $questions = \App\TestExam::where('category_id', $category_id)->orderBy('title', 'asc')->get();
       foreach($questions as $question)
       {
            $image = Imagetool::mycrop('no-image.png',280,200);
            if (is_file(DIR_IMAGE.$question->image)) {
                      $image = Imagetool::mycrop($question->image,280,200);
                    }
            $ans = TestAnswer::where('test_id',$question->id);
           $higest = $ans->orderBy('marks','desc')->first();
           $fastest = $ans->orderBy('duration','desc')->first();
           $total = $ans->count();
           $your_high = TestAnswer::where('test_id',$question->id)->where('employes_id', auth()->guard('employee')->user()->id)->orderBy('marks','desc')->first();
           $marks = '';
           $duration = '';
           $yhighest = '';
           if(isset($higest->marks))
           {
               $marks = $higest->marks;
           }
           if(isset($higest->duration))
           {
               $duration = $higest->duration;
           }
           if(isset($your_high->marks))
           {
               $yhighest = $your_high->marks;
           }

            $alltests = TestAnswer::select('employes_id')->where('test_id',$question->id)->orderBy('marks', 'desc')->get();
            $rank = '';
            foreach ($alltests as $key => $alltest) {
                if ($alltest->employes_id == auth()->guard('employee')->user()->id) {
                   $rank = $key +1;
                   break;
                }
            }

            $total_test = TestAnswer::where('test_id',$question->id)->groupBy('test_id')->count();
           $datas['test'][] = [
                'title' => $question->title,
                'image' => $image,
                'href' => url('/skill-test/'.$question->seo_url),
                'total_your_test' => $total,
                'your_higest' => $marks,
                'your_fastest' => $duration,
                'your_rank' => $rank,
                'total_test' => $total_test,
                'your_highest' => $yhighest,
            ];
       }

       $datas['category_id'] = $category_id;

       return view('employee.test_exam.int_test')->with('datas', $datas);
    }

    public function talentExam($url,Request $request)
    {
        $exam = \App\TestExam::where('seo_url', $url)->first();
        if (isset($exam->id)) {
           $exam_id = $exam->id;
        }else{
            $exam_id = 0;
        }
        if (isset($exam->title)) {
            $title = $exam->title;
        } else{
            $title = '';
        }
        $data['count'] = \App\TestQuestion::where('test_id', $exam_id)->count();
        $data['title'] = $title;
        session(['session_id' => date('Ymdhis')]);
       session(['answer' => []]);
       session(['questions' => []]);
       session(['exam_id' => $exam_id]);
       return view('employee.test_exam.exam')->with('data', $data);
    }

    public function getQuestion()
    {
        $exam_id = session()->get('exam_id');

        $question = \App\TestQuestion::where('test_id', $exam_id)->whereNotIn('id', session()->get('questions'))->inRandomOrder()->first();
        if(isset($question->id)){
        $datas['comments'] = \App\QuestionComment::where('question_id', $question->id)->get();
        } else{
            $datas['comments'] = [];
        }
        $datas['question'] = $question;
        return view('employee.test_exam.question')->with('datas', $datas);

    }


    public function jobApply($seourl='')
    {
         Session(['job_apply' => date('ymdhis'), 'job_url' => $seourl]);

        $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $applies = $employee->Apply;
        if (count($applies) > 0) {
                     foreach ($applies as $apply) {
                         $app[] = $apply->jobs_id;
                     }
                 }


        $job = Jobs::where('seo_url', $seourl)->where('status',1)->where('deadline', '>=', date('Y-m-d'))->first();
        if (!isset($job->id)) {
            \Session::flash('alert-danger', 'Sorry We did not find the job which you request');
            return redirect()->back();
        }

        $applycheck = JobApply::where('jobs_id', $job->id)->where('employees_id', $employee->id)->count();
        if ($applycheck > 0) {
            \Session::flash('alert-danger', 'You have already applied for this job');
            return redirect()->back();
        }

        if ($job->min_age > 0 || $job->fmax_age > 0 || $job->emax_age > 0)
        {
            if ($employee->dob == '') {
                \Session::flash('alert-danger', 'You must fill your date of birth');
                $error['date_of_birth'] = 'You must fill your date of birth';
                return redirect('/employee/editprofile')->withError($error);
            }
            $dt = Carbon::parse($employee->dob);
             $now  = Carbon::parse($job->deadline);
             $day = $dt->diffInDays($now);
             $year = $day / 365;
             if ($job->min_age != '') {
              if ($job->min_age > $year) {
                $error['date_of_birth'] = 'Your age is not as per our job requirement';
              }
            }
            if ($job->fmax_age != '') {
              if(count($employee->EmployeeExperience) < 1){
                if ($job->fmax_age < $year) {
                  $error['date_of_birth'] = 'Your age is not as per our job requirement';
                }
              }

            }

            if ($job->emax_age != '') {

                if ($job->emax_age < $year) {
                  $error['date_of_birth'] = 'Your age is not as per our job requirement';

              }

            }

            if (isset($error)) {
                \Session::flash('alert-danger', 'Your age is not as per our job requirement');

                return redirect()->back();
            }

        }



        $yr = 0;



                 if (count($employee->EmployeeExperience) > 0) {
                    $dif = 0;
                     foreach ($employee->EmployeeExperience as $key => $exper) {

                         if($exper->from != '' && $exper->to != ''){

                         $dt1 = Carbon::parse($exper->from);
                         $dt2 = Carbon::parse($exper->to);

                         $dif += $dt1->diffInDays($dt2);
                         }

                     }
                     $yr = $dif / 365;




                 }

       if ($job->min_experience > $yr) {
                       \Session::flash('alert-danger', 'Your experience did not match the minimum experience requirement for this job');

                        return redirect('/employee/experience');
                     }




        $jobedu = \App\JobEducation::where('jobs_id', $job->id)->get();
      if (count($jobedu) > 0) {
        if (count($employee->EmployeeEducation) > 0) {
            $jli = [];
            $jfi = [];
            foreach($jobedu as $je)
            {

                $empedu = EmployeeEducation::where('employees_id', $employee->id)->where('level_id', $je->education_level_id);
                if($je->faculty_id > 0){

                    $empedu->where('faculty_id',$je->faculty_id);
                }
                $edu = $empedu->first();


                if(isset($edu->id))
                {
                    if($je->percent > 0 || $je->cgps > 0 || $je->others > 0)
                    {
                        if($edu->marksystem == 1)
                        {
                            if($je->percent > $edu->percentage)
                            {
                                \Session::flash('alert-danger', 'Your Education percentage are not as per our job requirement');

                                return redirect('/employee/educations');
                            }
                        }
                        if($edu->marksystem == 2)
                        {
                            if($je->cgpa > $edu->percentage)
                            {
                                \Session::flash('alert-danger', 'Your Education percentage are not as per our job requirement');

                                return redirect('/employee/educations');
                            }
                        }
                        if($edu->marksystem == 3)
                        {
                            if($je->others > $edu->percentage)
                            {
                                \Session::flash('alert-danger', 'Your Education percentage are not as per our job requirement');

                                return redirect('/employee/educations');
                            }
                        }
                    }

                }

                if($je->experience > 0){

                    if($je->experience > $yr){
                        \Session::flash('alert-danger', 'Your experience did not match the minimum experience requirement for this job');

                        return redirect('/employee/experience');
                    }
                }
             break;
            }

            foreach($jobedu as $je)
            {
                $jli[] = $je->education_level_id;

                if($je->faculty_id > 0){
                    $jfi[] = $je->faculty_id;

                }
            }

            $empedus = EmployeeEducation::select('id')->where('employees_id', $employee->id)->whereIn('level_id', $jli);
                if(count($jfi) > 0){

                    $empedus->whereIn('faculty_id',$jfi);
                }
                $edus = $empedus->get();

                if(count($edus) < 1){
                    \Session::flash('alert-danger', 'Your Education qualification are not as per our job requirement');

                        return redirect('/employee/educations');
                }

        } else {
          \Session::flash('alert-danger', 'Your Education qualification are not as per our job requirement');

          return redirect('/employee/educations');
        }


      }




        if (count($job->JobForm) > 0) {
            $datas['jobs_form'] = [];
            $jobforms = JobForm::where('jobs_id',$job->id)->where('parent_id',0)->get();


            foreach ($jobforms as $tabs) {

               $datas['jobs_form'][] = array(
                'id' => $tabs->id,
                'level' => $tabs->f_lable,
                'rq' => $tabs->requ,
                'type' => $tabs->f_type,
                'form' => \App\JobForm::createForm($tabs->id,$tabs->f_lable,$tabs->f_type,$tabs->list_menu,$tabs->requ,$tabs->marks,$tabs->extra,$tabs->extra_type,$tabs->fe_lable),
                );


            }

            $datas['job'] = $job;

            return view('employee.job_apply')->with('datas', $datas);
        } else{
          Session()->forget('job_apply');
            Session()->forget('job_url');
            JobApply::create(['jobs_id' => $job->id, 'employees_id' => $employee->id, 'apply_date' => date('Y-m-d')]);
            $mydata = array(
                    'name' => $employee->firstname.' '.$employee->middlename.' '.$employee->lastname,
                    'email' => $employee->email,
                    'subject' => 'Thank you for applying for the job position '.$job->title,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,
                    'store_logo'  => Settings::getJobLogo(),
                    'job_title' => $job->title,
                    'vacancy_code' => $job->vacancy_code,
                    'employer_logo' => Employers::getPhoto($job->employers_id),
                    'employer_name' => Employers::getName($job->employers_id),
                    'other_jobs' => Jobs::where('id', '!=', $job->id)->where('employers_id',$job->employers_id)->where('status',1)->where('trash', 0)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'))->get()
                    );
            set_time_limit(600);
             myFunctions::setEmail();
            Mail::send('mail.applyemail', ['datas' => $mydata], function($mail) use ($mydata){
                      $mail->to($mydata['email'],$mydata['name'])->from($mydata['store_email'],$mydata['store_name'])->subject($mydata['subject']);

                    });
            \Session::flash('alert-success', 'You have successfully applied for the position of '.$job->title);
            return redirect('/employee/applied');
        }


    }


    public function getExtraForm(Request $request){
        $forms = \App\JobForm::where('parent_id', $request->id)->get();

        foreach ($forms as $f) {
        $intypes= array("text","date","email","url","number","tel");
      $rtypes= array("checkbox","radio");
      if($f->requ == 1){
        $rq= 'required="required"' ;
        $class = 'required';
      } else {
        $rq='';
        $class = '';
      }
      if (in_array($f->f_type, $intypes)) {

          $form='<div class="form-group"><input type="hidden" name="my_datas['.$f->id.'][requ]" value="'.$f->requ.'"><label style="text-align:left;" class="col-md-12 control-label '.$class.'">'.$f->f_lable.'</label><input type="hidden" name="my_datas['.$f->id.'][optitle]" value="'.$f->f_lable.'" class="form-control"><input type="'.$f->f_type.'" class="form-control" name="my_datas['.$f->id.'][fdata]"  '.$rq.' /> <input type="hidden" name="my_datas['.$f->id.'][marks]" value="'.$f->marks.'"></div>';
        return $form;
        }
      elseif(in_array($f->f_type, $rtypes)) {
        $lm=explode(',',$f->list_menu);
        foreach($lm as $l){
          $form='<div class="form-group"><input type="hidden" name="my_datas['.$f->id.'][requ]" value="'.$f->requ.'"><input type="'.$f->f_type.'" class="form-control" name="my_datas['.$f->id.'][fdata]" id="'.$l.'" value="'.$f->f_lable.'" /><input type="hidden" name="my_datas['.$f->id.'][marks]" value="'.$f->marks.'">&nbsp &nbsp $nbsp'.$f->f_lable.'</div>';
        return $form;
        }
        }
      elseif($f->f_type =='textarea'){
        $form='<div class="form-group"><input type="hidden" name="my_datas['.$f->id.'][requ]" value="'.$f->requ.'"><label style="text-align:left;" class="col-md-12 control-label '.$class.'">'.$f->f_lable.'</label><input type="hidden" name="my_datas['.$f->id.'][optitle]" value="'.$f->f_lable.'" class="form-control"><textarea  '.$rq.' class="form-control" name="my_datas['.$f->id.'][fdata]"></textarea> <input type="hidden" name="my_datas['.$f->id.'][marks]" value="'.$f->marks.'"></div>';
        return $form;
        }
      elseif($f->f_type =='file'){
        $form='<div class="form-group"><label style="text-align:left;" class="col-md-12 control-label '.$class.'">'.$f->f_lable.'</label><input type="hidden" name="extrafile['.$f->id.'][requ]" value="'.$f->requ.'"><input type="'.$f->f_type.'" class="form-control" name="extrafile['.$f->id.'][marks]"  '.$rq.' /><input type="hidden" name="extrafile['.$f->id.'][marks]" value="'.$f->marks.'"></div>';
        return $form;
        }
      elseif($f->f_type =='select'){
        $form = '<div class="form-group"><input type="hidden" name="my_datas['.$f->id.'][requ]" value="'.$f->requ.'"><label style="text-align:left;" class="col-md-12 control-label '.$class.'">'.$f->f_lable.'</label><input type="hidden" name="my_datas['.$f->id.'][optitle]" value="'.$f->f_lable.'" class="form-control"><select id="hidden_'.$f->id.'" name="my_datas['.$f->id.'][marks]" style="display:none;">';
        $m=explode(',',$f->marks);
        foreach($m as $key => $l){
          $form .='<option id="'.$key.'" value="'.$l.'">'.$l.'</option>';
        }
        $form .='</select><select opvl="'.$f->id.'" name="my_datas['.$f->id.'][fdata]"  '.$rq.' class="form-control  select"><option value="">Select Option </option>';
        $lm=explode(',',$f->list_menu);

        foreach($lm as $k => $ml){
          $m=explode(',',$f->marks);
        foreach($m as $key => $l){

          if($k == $key){
          $form .='<option id="'.$l.'" value="'.$ml.'">'.$ml.'</option>';
             }
             }


        }
        $form .='</select>';
        $form .= '<input type="hidden" id="extra_'.$f->id.'" value="'.$f->extra.'"></div>';
        $form .='<div id="aextra_'.$f->id.'"></div>';
        return $form;
        }
      else {
        return '';
       }




  }

}

    public function saveApply(Request $request)
    {
        $rules['job_id'] = 'required|integer';
      if (isset($request->my_datas)) {
          foreach ($request->my_datas as $key => $mydata) {
              if ($mydata['requ'] == 1) {
                  $rules['my_datas.'.$key.'.fdata'] = 'required';
              }
          }
      }

      if (isset($request->extrafile)) {
          foreach ($request->extrafile as $f => $file) {
              if ($file['requ'] == 1) {
                  $rules['extrafile.'.$f.'.file'] = 'required|mimes:pdf,doc,docx,jpeg,jpg|max:10000';
              } else{
                $rules['extrafile.'.$f.'.file'] = 'mimes:pdf,doc,docx,jpeg,jpg|max:10000';
              }
          }
      }

      $this->validate($request, $rules);

        $job = Jobs::where('id', $request->job_id)->where('status',1)->where('deadline', '>=', date('Y-m-d'))->first();


      if (isset($request->my_datas)) {
        $i = 0;
          foreach ($request->my_datas as $key => $mdata) {
              $formdata = [
                'jobs_id' => $request->job_id,
                'employees_id' => auth()->guard('employee')->user()->id,
                'job_form_id'    => $key,

                'f_description'   => $mdata['fdata'],
                'type'          => 2,
                'marks'         => $mdata['marks'],
                'sn'            => $i++
              ];
              FormData::create($formdata);
          }
      }

      if (isset($request->extrafile)) {
        $j = 0;
          foreach ($request->extrafile as $key => $extrafile) {
            $directory = DIR_IMAGE . 'employer/job/formfile/'.$job->id;
            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
              }

                if (isset($request->File('extrafile')[$key]['file'])) {
                    //dd($value);
                    $file = $request->File('extrafile')[$key]['file'];
                      $fileext = $file->getClientOriginalExtension();

                    //dd($fileext);

                     $filename = 'employer/job/formfile/'.$job->id.'/'.str_replace(' ', '-', $extrafile['optitle']).'-'.auth()->guard('employee')->user()->firstname.'-'.auth()->guard('employee')->user()->middlename.'-'.auth()->guard('employee')->user()->lastname.'-'.\Str::random(10).'.'.$fileext;




                    $file->move($directory, $filename);

                      $formfile = [
                       'jobs_id' => $request->job_id,
                        'employees_id' => auth()->guard('employee')->user()->id,
                        'job_form_id'    => $key,
                        'f_description'   => $filename,
                        'type'          => 1,
                        'marks'         => $extrafile['marks'],
                        'sn'            => $j++
                      ];
                      FormData::create($formfile);



                }



          }
      }

      $jobapply = [
        'jobs_id' => $request->job_id,
        'employees_id' => auth()->guard('employee')->user()->id,
        'apply_date' => date('Y-m-d')
      ];
      JobApply::create($jobapply);
      $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
      $mydata = array(
                    'name' => $employee->firstname.' '.$employee->middlename.' '.$employee->lastname,
                    'email' => $employee->email,
                    'subject' => 'Thank you for applying the job position of '.$job->title,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,
                    'store_logo'  => Settings::getJobLogo(),
                    'job_title' => $job->title,
                    'vacancy_code' => $job->vacancy_code,
                    'employer_logo' => Employers::getPhoto($job->employers_id),
                    'employer_name' => Employers::getName($job->employers_id),
                    'other_jobs' => Jobs::where('id', '!=', $job->id)->where('employers_id',$job->employers_id)->where('status',1)->where('trash', 0)->where('publish_date', '<=', date('Y-m-d'))->where('deadline', '>=', date('Y-m-d'))->get()
                    );
            set_time_limit(600);
             myFunctions::setEmail();
            Mail::send('mail.applyemail', ['datas' => $mydata], function($mail) use ($mydata){
                      $mail->to($mydata['email'],$mydata['name'])->from($mydata['store_email'],$mydata['store_name'])->subject($mydata['subject']);

                    });

      \Session::flash('alert-success', 'You have successfully applied for the job position of '.$request->title.'.');
            return redirect('/employee/applied');



    }

     public function ProjectApply($project='')
     {
       $project = Project::where('seo_url', $project)->first();
       if (!isset($project->id)) {
         \Session::flash('alert-danger', 'Sorry We cound not found the project you selected');
         return redirect()->back();
       }

       $checkapply = ProjectApply::where('project_id', $project->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
       if ($checkapply > 0) {
         \Session::flash('alert-danger', 'Sorry you have already applied for this project');
         return redirect()->back();
       }

       $diff = Carbon::parse($project->deadline)->diff(Carbon::now())->format('%D:%H:%I');
       $diffs = explode(':', $diff);
       if ($diffs[0] != 0) {
           $difference = $diffs[0].' Days '.$diffs[1].' Hours left';
       } elseif ($diffs[1] != 0) {
           $difference = $diffs[1].' Hours '.$diffs[2].' Minutes left';
       }elseif ($diffs[2] != 0) {
           $difference = $diffs[2].' Minutes left';
       } else {
            $difference = '';
       }




       return view('employee.project_apply')->with('data', $project)->with('diff', $difference);
     }

     public function projectSaveApply(Request $request)
     {
         $this->validate($request, [
            'project_id' => 'required|integer',
            'title' => 'required',
            'amount' => 'required',
            'min_budget' => 'required',
            'milestone_amount' => 'required',
            'description' => 'required|min:25',
            'duration' => 'required',
            'milestone.*.title' => 'required',
            'milestone.*.price' => 'required'
         ]);

         if ($request->amount < $request->min_budget) {
             $error['bid_amount'] = 'Bid Amount can not be less than minimum budget.';
         }

         if ($request->amount != $request->milestone_amount) {
             $error['milestone_amount'] = 'Milestone amount must be equal to bid amount.';
         }

         if (isset($error)) {
             return redirect()->withInput()->withError($error);
         }

         $datas = [
            'project_id' => $request->project_id,
            'employees_id' => auth()->guard('employee')->user()->id,
            'duration' => $request->duration,
            'amount' => $request->amount,
            'description' => $request->description
         ];

         $apply = ProjectApply::create($datas);
         if (isset($apply->id)) {
             foreach ($request->milestone as $key => $value) {
                 $m = [
                    'project_apply_id' => $apply->id,
                    'description' => $value['title'],
                    'amount' => $value['price']
                 ];
                 ProjectMilestones::create($m);
             }
             \Session::flash('alert-success', 'You have successfully bid for '.$request->title);
             return redirect('/employee/project_applied');
         }else{
            \Session::flash('alert-danger', 'Something Went Wrong while adding data.');
            return redirect()->back();
         }


     }

     public function ProjectApplied(Request $request)
     {

        $datas['apply'] = ProjectApply::where('employees_id', auth()->guard('employee')->user()->id)->orderBy('id', 'desc')->paginate(50);
        return view('employee.project_applies')->with('datas', $datas);
     }


     public function TrainingApply($training='')
     {
         $training = Training::where('status', 1)->where('end_date', '>=', date('Y-m-d'))->where('seo_url', $training)->first();
         if (!isset($training->id)) {
             \Session::flash('alert-danger', 'Participation application receiving date has been crossed');
            return redirect()->back();
         }
         $checkapply = TrainingApply::where('training_id', $training->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
         if ($checkapply > 0) {
             \Session::flash('alert-danger', 'You have already send the participation request for '.$training->title);
             return redirect()->back();
         }
         TrainingApply::create(['training_id' => $training->id, 'employees_id' => auth()->guard('employee')->user()->id, 'apply_date' => date('Y-m-d')]);
          \Session::flash('alert-success', 'Thank yo for participating for '.$training->title);
             return redirect('/employee/training_applied');
     }

      public function TrainingApplied(Request $request)
     {

        $datas['apply'] = TrainingApply::where('employees_id', auth()->guard('employee')->user()->id)->orderBy('id', 'desc')->paginate(50);
        return view('employee.training_apply')->with('datas', $datas);
     }

     public function DeleteTrainingApply($id='')
     {
         $apply = TrainingApply::where('id', $id)->where('employees_id', auth()->guard('employee')->user()->id)->first();
         if ($apply) {
             $apply->delete();
             \Session::flash('alert-success', 'You successfuly reject to participate on '.$apply->title);
            return redirect()->back();
         } else{
            \Session::flash('alert-danger', 'Sorry we did not find the data you request');
            return redirect()->back();
         }
     }

     public function EventApply($event='')
     {
         $event = Event::where('status', 1)->where('event_date', '>=', date('Y-m-d'))->where('seo_url', $event)->first();
         if (!isset($event->id)) {
             \Session::flash('alert-danger', 'Participation application receiving date has been crossed');
             return redirect()->back();
         }
         $checkapply = EventApply::where('event_id', $event->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
         if ($checkapply > 0) {
             \Session::flash('alert-danger', 'You have already send the participation request for '.$event->title);
             return redirect()->back();
         }
         EventApply::create(['event_id' => $event->id, 'employees_id' => auth()->guard('employee')->user()->id, 'apply_date' => date('Y-m-d')]);
          \Session::flash('alert-success', 'Thank yoy for participating on '.$event->title);
             return redirect('/employee/event_applied');
     }

      public function EventApplied(Request $request)
     {

        $datas['apply'] = EventApply::where('employees_id', auth()->guard('employee')->user()->id)->orderBy('id', 'desc')->paginate(50);
        return view('employee.event_applies')->with('datas', $datas);
     }

     public function DeleteEventApply($id='')
     {
         $apply = EventApply::where('id', $id)->where('employees_id', auth()->guard('employee')->user()->id)->first();
         if ($apply) {
             $apply->delete();
             \Session::flash('alert-success', 'You successfuly reject to participate on '.$apply->title);
            return redirect()->back();
         } else{
            \Session::flash('alert-danger', 'Sorry we did not find the data you request');
            return redirect()->back();
         }
     }

     public function EmpRating(Request $request)
     {
         $this->validate($request, [
            'employer' => 'required|integer',
            'rating.*.rate' => 'required'
         ]);

         foreach ($request->rating as $key => $value) {
             EmployerRating::create([
                'employers_id' => $request->employer,
                'employes_id' => auth()->guard('employee')->user()->id,
                'question_id' => $key,
                'rating' => $value['rate'],
             ]);
         }

         \Session::flash('alert-success','Data updated Successfully');
         return redirect()->back();
     }

     public function Classmates(Request $request)
     {
        $institute_id = 0;
        if (isset($request->institute_id)) {
            $institute_id = $request->institute_id;
        }
        $datas['classmates'] = [];
         $cfriend = EmployeeEducation::where('employers_id', $institute_id)->where('employees_id', '!=', auth()->guard('employee')->user()->id);
         if (isset($request->batch)) {
             $cfriend->where('year',$request->batch);
         }
         $cfriends = $cfriend->groupBy('employees_id')->get();
         $tfriend = EmployeeTraining::where('employers_id', $institute_id)->where('employees_id', '!=', auth()->guard('employee')->user()->id);
         if (isset($request->batch)) {
             $tfriend->where('year',$request->batch);
         }
         $tfriends = $tfriend->groupBy('employees_id')->get();

         foreach ($cfriends as $key => $cf) {
          $setting = EmployeeSetting::where('employees_id',$cf->employees_id)->first();
          if($setting->find_you == 1)
          {
            $sts = ['0','2'];
            $phone = '';
            $email = '';
            if (in_array($setting->phone_privacy, $sts)) {
              $phone = EmployeeAddress::getPhone($cf->employees_id);
              # code...
            }
            if (in_array($setting->email_privacy, $sts)) {
              $email = Employees::getEmail($cf->employees_id);
              # code...
            }

            $datas['classmates'][] = [
                'id' => $cf->employees_id,
                'name' => Employees::getName($cf->employees_id),
                'address' => EmployeeAddress::getPermanenet($cf->employees_id),
                'phone' => $phone,
                'email' => $email,
                'image' => Employees::getPhoto($cf->employees_id),
                'circle_request' => $setting->circle_request
             ];
          }

         }


         foreach ($tfriends as $key => $tf) {
          $settings = EmployeeSetting::where('employees_id',$tf->employees_id)->first();
          if($settings->find_you == 1)
          {
            $sts = ['0','2'];
            $phone = '';
            $email = '';
            if (in_array($settings->phone_privacy, $sts)) {
              $phone = EmployeeAddress::getPhone($tf->employees_id);
              # code...
            }
            if (in_array($settings->email_privacy, $sts)) {
               $email = Employees::getEmail($tf->employees_id);
              # code...
            }
             $datas['classmates'][] = [
                'id' => $tf->employees_id,
                'name' => Employees::getName($tf->employees_id),
                'address' => EmployeeAddress::getPermanenet($tf->employees_id),
                'phone' => $phone,
                'email' => $email,
                'image' => Employees::getPhoto($tf->employees_id),
                'circle_request' => $settings->circle_request
             ];
           }
         }
         $datas['employers_name'] = Employers::getName($institute_id);
         //dd($datas);
         return view('employee.classmates')->with('datas',$datas);
     }

     public function Collegious(Request $request)
     {
        $company_id = 0;
        if (isset($request->company_id)) {
            $company_id = $request->company_id;
        }
        $datas['classmates'] = [];
         $cfriend = EmployeeExperience::where('employers_id', $company_id)->where('employees_id', '!=', auth()->guard('employee')->user()->id);
         if (isset($request->batch)) {

                $baches = explode('||', $request->batch);
             $cfriend->whereBetween('from', [$baches[0],$baches[1]]);
         }
         $cfriends = $cfriend->groupBy('employees_id')->get();


         foreach ($cfriends as $key => $cf) {
          $setting = EmployeeSetting::where('employees_id',$cf->employees_id)->first();
          if($setting->find_you == 1)
          {
            $sts = ['0','2'];
            $phone = '';
            $email = '';
            if (in_array($setting->phone_privacy, $sts)) {
              $phone = EmployeeAddress::getPhone($cf->employees_id);
              # code...
            }
            if (in_array($setting->email_privacy, $sts)) {
              $email = Employees::getEmail($cf->employees_id);
              # code...
            }
             $datas['classmates'][] = [
                'id' => $cf->employees_id,
                'name' => Employees::getName($cf->employees_id),
                'address' => EmployeeAddress::getPermanenet($cf->employees_id),
                'phone' => $phone,
                'email' => $email,
                'image' => Employees::getPhoto($cf->employees_id),
                'circle_request' => $setting->circle_request
             ];
           }
         }


         $datas['employers_name'] = Employers::getName($company_id);
         //dd($datas);
         return view('employee.classmates')->with('datas',$datas);
     }


     public function SmartCv(Request $request)
     {
        $user = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas['name'] = Employees::getName($user->id);
        $datas['address'] = $user->EmployeeAddress;
        $datas['user'] = $user;

        $datas['experience'] = [];
        $experiences = $user->EmployeeExperience;


        $datas['education'] = $user->EmployeeEducation;

        $datas['training'] = $user->EmployeeTraining;

        $datas['finger_test'] = [
            'english' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'English')->orderBy('wpm','desc')->first(),
            'nepali' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'Nepali')->orderBy('wpm','desc')->first(),
        ];

        $dob = Carbon::parse($user->dob);

        $days = $dob->diffInDays(Carbon::now());

        $years = floor($days / 365);

        $datas['spelizaton'][] = $user->marital_status;
        $datas['spelizaton'][] = 'NRS. '.$user->present_salary;
        $datas['spelizaton'][] = $years.' Years';

        if (count($datas['education']) > 0) {
            foreach ($datas['education'] as $key => $edu) {
                if (!in_array($edu->specialization, $datas['spelizaton'])) {

                $datas['spelizaton'][] = $edu->specialization;
            }
            }
        }



        $datas['skills'] = EmployeeSkills::where('employees_id', $user->id)->get();

        $datas['language'] = $user->EmployeeLanguage;

        $locations = $user->EmployeeLocation;

        $datas['location'] = '';
        $total_location = count($locations);
        foreach ($locations as $key => $location) {
            if ($total_location - 1 == $key) {
                $datas['location'] .= JobLocation::getName($location->job_location_id);
            } else{
                $datas['location'] .= JobLocation::getName($location->job_location_id).', ';
            }

        }

        $categories = $user->EmployeeCategory;

        $datas['category'] = '';
        $total_category = count($categories);
        foreach ($categories as $key => $category) {

            if ($total_category - 1 == $key) {
                $datas['category'] .= JobCategory::getTitle($category->job_category_id);
            } else{
                $datas['category'] .= JobCategory::getTitle($category->job_category_id).', ';
            }

        }

        $organizations = $user->EmployeeOrganization;

        $datas['organization'] = '';
        $total_organization = count($organizations);
        foreach ($organizations as $key => $organization) {

            if ($total_organization - 1 == $key) {
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id);
            } else{
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id).', ';
            }

        }

        foreach ($experiences as $key => $experience) {

            $from = Carbon::parse($experience->from);
            $diff = $from->diffInDays(Carbon::parse($experience->to));
            $duration = floor($diff / 365);
            $datas['experience'][] = [
                'designation' => $experience->designation,
                'company' => $experience->organization,
                'duration' => $duration,
                'from_to' => $experience->from.' - '.$experience->to,
                'detail' => $experience->experience,
                'type' => $experience->currently_working,
            ];

             if (!in_array($experience->designation, $datas['spelizaton'])) {
                    $datas['spelizaton'][] = $experience->designation;
                }
        }

        $test_results = \App\TestAnswer::select('test_id','marks')->where('employes_id', $user->id)->orderBy('marks', 'desc')->groupBy('test_id')->get();
        $datas['test_results'] = [];
        foreach ($test_results as $key => $test_result) {
            $datas['test_results'][] = [
                'title' => TestExam::getTitle($test_result->test_id),
                'marks' => $test_result->marks
            ];
        }

        //dd($datas);

         return view('employee.cv.smart-cv')->with('datas', $datas);
     }

     public function ChronologicalCv(Request $request)
     {
        $user = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas['name'] = Employees::getName($user->id);
        $datas['address'] = $user->EmployeeAddress;
        $datas['user'] = $user;

        $datas['experience'] = [];
        $experiences = $user->EmployeeExperience;


        $datas['education'] = $user->EmployeeEducation;

        $datas['training'] = $user->EmployeeTraining;

        $datas['finger_test'] = [
            'english' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'English')->orderBy('wpm','desc')->first(),
            'nepali' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'Nepali')->orderBy('wpm','desc')->first(),
        ];

        $dob = Carbon::parse($user->dob);

        $days = $dob->diffInDays(Carbon::now());

        $years = floor($days / 365);

        $datas['spelizaton'][] = $user->marital_status;
        $datas['spelizaton'][] = 'NRS. '.$user->present_salary;
        $datas['spelizaton'][] = $years.' Years';

        if (count($datas['education']) > 0) {
            foreach ($datas['education'] as $key => $edu) {
                if (!in_array($edu->specialization, $datas['spelizaton'])) {

                $datas['spelizaton'][] = $edu->specialization;
            }
            }
        }



        $datas['skills'] = EmployeeSkills::where('employees_id', $user->id)->get();

        $datas['language'] = $user->EmployeeLanguage;

        $locations = $user->EmployeeLocation;

        $datas['location'] = '';
        $total_location = count($locations);
        foreach ($locations as $key => $location) {
            if ($total_location - 1 == $key) {
                $datas['location'] .= JobLocation::getName($location->job_location_id);
            } else{
                $datas['location'] .= JobLocation::getName($location->job_location_id).', ';
            }

        }

        $categories = $user->EmployeeCategory;

        $datas['category'] = '';
        $total_category = count($categories);
        foreach ($categories as $key => $category) {

            if ($total_category - 1 == $key) {
                $datas['category'] .= JobCategory::getTitle($category->job_category_id);
            } else{
                $datas['category'] .= JobCategory::getTitle($category->job_category_id).', ';
            }

        }

        $organizations = $user->EmployeeOrganization;

        $datas['organization'] = '';
        $total_organization = count($organizations);
        foreach ($organizations as $key => $organization) {

            if ($total_organization - 1 == $key) {
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id);
            } else{
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id).', ';
            }

        }

        foreach ($experiences as $key => $experience) {

            $from = Carbon::parse($experience->from);
            $diff = $from->diffInDays(Carbon::parse($experience->to));
            $duration = floor($diff / 365);
            $datas['experience'][] = [
                'designation' => $experience->designation,
                'company' => $experience->organization,
                'duration' => $duration,
                'from_to' => $experience->from.' - '.$experience->to,
                'detail' => $experience->experience,
                'type' => $experience->currently_working,
            ];

             if (!in_array($experience->designation, $datas['spelizaton'])) {
                    $datas['spelizaton'][] = $experience->designation;
                }
        }

        $test_results = \App\TestAnswer::select('test_id','marks')->where('employes_id', $user->id)->orderBy('marks', 'desc')->groupBy('test_id')->get();
        $datas['test_results'] = [];
        foreach ($test_results as $key => $test_result) {
            $datas['test_results'][] = [
                'title' => TestExam::getTitle($test_result->test_id),
                'marks' => $test_result->marks
            ];
        }

        //dd($datas);

         return view('employee.cv.smart-cv')->with('datas', $datas);
     }

     public function FunctionalCv(Request $request)
     {
        $user = Employees::where('id', auth()->guard('employee')->user()->id)->first();
        $datas['name'] = Employees::getName($user->id);
        $datas['address'] = $user->EmployeeAddress;
        $datas['user'] = $user;

        $datas['experience'] = [];
        $experiences = $user->EmployeeExperience;
        $profession = EmployeeExperience::select('designation')->where('employees_id',$user->id)->orderBy('id','desc')->first();
        $datas['profession'] = '';
        if (isset($profession->designation)) {
            $datas['profession'] = $profession->designation;
        }

        $datas['education'] = $user->EmployeeEducation;

        $datas['training'] = $user->EmployeeTraining;

        $datas['finger_test'] = [
            'english' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'English')->orderBy('wpm','desc')->first(),
            'nepali' => \App\EmployeeFingertest::where('employees_id',$user->id)->where('language', 'Nepali')->orderBy('wpm','desc')->first(),
        ];

        $dob = Carbon::parse($user->dob);

        $days = $dob->diffInDays(Carbon::now());

        $years = floor($days / 365);

        $datas['spelizaton'][] = $user->marital_status;
        $datas['spelizaton'][] = 'NRS. '.$user->present_salary;
        $datas['spelizaton'][] = $years.' Years';

        if (count($datas['education']) > 0) {
            foreach ($datas['education'] as $key => $edu) {
                if (!in_array($edu->specialization, $datas['spelizaton'])) {

                $datas['spelizaton'][] = $edu->specialization;
            }
            }
        }



        $datas['skills'] = EmployeeSkills::where('employees_id', $user->id)->get();

        $datas['language'] = $user->EmployeeLanguage;

        $locations = $user->EmployeeLocation;

        $datas['location'] = '';
        $total_location = count($locations);
        foreach ($locations as $key => $location) {
            if ($total_location - 1 == $key) {
                $datas['location'] .= JobLocation::getName($location->job_location_id);
            } else{
                $datas['location'] .= JobLocation::getName($location->job_location_id).', ';
            }

        }

        $categories = $user->EmployeeCategory;

        $datas['category'] = '';
        $total_category = count($categories);
        foreach ($categories as $key => $category) {

            if ($total_category - 1 == $key) {
                $datas['category'] .= JobCategory::getTitle($category->job_category_id);
            } else{
                $datas['category'] .= JobCategory::getTitle($category->job_category_id).', ';
            }

        }

        $organizations = $user->EmployeeOrganization;

        $datas['organization'] = '';
        $total_organization = count($organizations);
        foreach ($organizations as $key => $organization) {

            if ($total_organization - 1 == $key) {
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id);
            } else{
                $datas['organization'] .= OrganizationType::getOrgTypeTitle($organization->org_type_id).', ';
            }

        }

        foreach ($experiences as $key => $experience) {

            $from = Carbon::parse($experience->from);
            $diff = $from->diffInDays(Carbon::parse($experience->to));
            $duration = floor($diff / 365);
            $datas['experience'][] = [
                'designation' => $experience->designation,
                'company' => $experience->organization,
                'duration' => $duration,
                'from' => $experience->from,
                'to' => $experience->to,
                'detail' => $experience->experience,
                'type' => $experience->currently_working,
            ];

             if (!in_array($experience->designation, $datas['spelizaton'])) {
                    $datas['spelizaton'][] = $experience->designation;
                }
        }

        $test_results = \App\TestAnswer::select('test_id','marks')->where('employes_id', $user->id)->orderBy('marks', 'desc')->groupBy('test_id')->get();
        $datas['test_results'] = [];
        foreach ($test_results as $key => $test_result) {
            $datas['test_results'][] = [
                'title' => TestExam::getTitle($test_result->test_id),
                'marks' => $test_result->marks
            ];
        }

        $datas['reference'] = $user->EmployeeReference;

        //dd($datas);

         return view('employee.cv.functional-cv')->with('datas', $datas);
     }

      public function AddCircle(Request $request)
     {
       if (!isset($request->user_id)) {
         return 'Error: Friend is Required';
       }
       $check = \App\UserCircle::checkCircle(auth()->guard('employee')->user()->id,$request->user_id);
       if ($check > 0) {
         return 'Error: You already sent Friend is Required';
       }
       \App\UserCircle::create(['staff_id' => auth()->guard('employee')->user()->id, 'user_id' => $request->user_id, 'status' => 0]);
       return 'Success';
     }


     public function AcceptRequest(Request $request)
     {
       if (!isset($request->user_id)) {
         return 'Error: Friend is Required';
       }
       $check = \App\UserCircle::where('staff_id',$request->user_id)->where('user_id',auth()->guard('employee')->user()->id)->where('status', 0)->first();
       if (!isset($check->id)) {
         return 'Error: Sorry we did not find the request';
       }
       if($request->type == 'Accept')
       {
        \App\UserCircle::where('id',$check->id)->update(['status' => 1]);
        \App\UserCircle::create(['staff_id' => auth()->guard('employee')->user()->id, 'user_id' => $request->user_id, 'status' => 1]);
       } else{
        \App\UserCircle::where('id',$check->id)->update(['status' => 2]);
       }

       return 'Success';
     }

     public function SkillEndorse(Request $request)
     {
       if (!isset($request->skill_id)) {
         return 'Error: Skill is Required';
       }
       if (\App\UserCircle::checkEndorse($request->skill_id) == 0) {
         return 'Error: You already endorsed the skill';
       }

       $skill = \App\EmployeeSkills::where('id',$request->skill_id)->first();
       if (!isset($skill->id)) {
         return 'Error: Skill not found';
       }
       if ($skill->employees_id == auth()->guard('employee')->user()->id) {
         return 'Error: You can not endorse your skill yourself';
       }
       $staff_id[] = auth()->guard('employee')->user()->id;
       $endorseds = json_decode($skill->endorsed);
       if(is_array($endorseds))
       {
        foreach ($endorseds as $key => $value) {
          $staff_id[] = $value;
        }
       }
       \App\EmployeeSkills::where('id',$request->skill_id)->update(['endorsed' => json_encode($staff_id)]);

       $check = \App\EmployeeActivity::where('employees_id',auth()->guard('employee')->user()->id)->first();
                  if (isset($check->id)) {
                      $skill_endorse = 1;
                      if($check->skill_endorse > 0)
                      {
                          $skill_endorse = $check->skill_endorse + 1;
                      }
                      \App\EmployeeActivity::where('id',$check->id)->update(['skill_endorse' => $skill_endorse]);
                  }else{
                      \App\EmployeeActivity::create(['employees_id' => auth()->guard('employee')->user()->id, 'skill_endorse' => 1]);
                  }
       return 'Success';
     }

public function getEditEducation(Request $request)
     {
      $json = [];
       $id = 0;
       if (isset($request->education_id)) {
         $id = $request->education_id;
       }

       $education = EmployeeEducation::where('id',$id)->first();
       if (!isset($education->id)) {
         $json['error'] = 'Error: education not found';
       }
       if (!$json) {

        $datas['educationlevel'] = EducationLevel::orderBy('name', 'asc')->get();
        $datas['faculties'] = Faculty::orderBy('name', 'asc')->get();
        $datas['education'] = $education;
        $datas['marksystem'][] = ['value' => 1, 'title' => 'Percentage'];
        $datas['marksystem'][] = ['value' => 2, 'title' => 'CGPA out of 4'];
        $datas['marksystem'][] = ['value' => 3, 'title' => 'CGPA out of 10'];
            $json['datas'] = view('employee.edit_education')->with('datas', $datas)->render();
          }
        return response()->json($json);

     }


     public function updateIndividualEducation(Request $request)
     {
         $json = [];

      $lids = ['6','7'];
         if(in_array($request->level_id,$lids))
         {
              $this->validate($request,[
                    'id' => 'required|integer',
                    'country' => 'required|min:3',
                    'level_id' => 'required|integer',
                    'specialization' => 'required|min:3',
                    'institution' => 'required|min:3',
                    'board' => 'required|min:2',
                    'percent' => 'required|numeric',
                    'marksystem' => 'required',
                    'year' => 'required|min:4|max:4',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);

         }else{
              $this->validate($request,[
                    'id' => 'required|integer',
                    'country' => 'required|min:3',
                    'level_id' => 'required|integer',
                    'faculty_id' => 'required|integer',
                    'specialization' => 'required|min:3',
                    'institution' => 'required|min:3',
                    'board' => 'required|min:2',
                    'percent' => 'required|numeric',
                    'marksystem' => 'required',
                    'year' => 'required|min:4|max:4',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);
         }





           if ($request->institution_id > 0) {
                $institution_id = $request->institution_id;
            } else{

                $employers = \App\Employers::select('id')->where('name', $request->institution)->first();
                if (isset($employers->id)) {
                    $institution_id = $employers->id;
                }else{
                    $datas = [
                    'name' => $request->institution,
                    'seo_url' => str_replace(' ', '-', $request->institution),
                    'member_type' => 4,
                    'status' => 1
                ];
                $employer = \App\Employer::create($datas);
                if($employer){
                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                     $institution_id = $employer->id;
                 } else{
                    $institution_id = $request->institution_id;
                 }
                }
            }

            $education_document = $request->old_document;
        if ($request->hasFile('education_document')) {
            $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }




        $file = $request->File('education_document');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);
            if (is_file(DIR_IMAGE.$request->old_document)) {
              File::delete(DIR_IMAGE.$request->old_document);
            }
            $education_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
          }
                 $edu = [

                                'country' => $request->country,
                                'level_id' => $request->level_id,
                                'faculty_id' => $request->faculty_id,
                                'specialization' => $request->specialization,
                                'institution' => $request->institution,
                                'board' => $request->board,
                                'percentage' => $request->percent,
                                'marksystem' => $request->marksystem,
                                'year' => $request->year,
                                'employers_id' => $institution_id,
                                'document' => $education_document
                            ];
                            EmployeeEducation::where('id',$request->id)->update($edu);

                $education = EmployeeEducation::where('id',$request->id)->first();
                $msys = $education->marksystem == 1 ? '%' : 'CGPA';
                $json['data'] = [
                  'id' => $education->id,
                  'institution' => $education->institution,
                  'faculty' => Faculty::getLevelTitle($education->level_id).' in '.Faculty::getTitle($education->faculty_id),
                  'board' => $education->board,
                  'year'  => $education->year,
                  'specialization' => $education->specialization,
                  'percentage'  => $education->percentage.' '.$msys

                ];
                $json['educations'] = $education;



      return response()->json($json);
     }


      public function getEditTraining(Request $request)
     {

      $json = [];





       $id = 0;
       if (isset($request->training_id)) {
         $id = $request->training_id;
       }

       $training = EmployeeTraining::where('id',$id)->first();
       if (!isset($training->id)) {
          $json['error'] = 'Error: training not found';
       }
       if (!$json) {


        $datas['training'] = $training;


            $json['datas'] = view('employee.edit_training')->with('datas', $datas)->render();
          }
           return response()->json($json);

     }

     public function getEditReference(Request $request)
     {

      $json = [];





       $id = 0;
       if (isset($request->reference_id)) {
         $id = $request->reference_id;
       }

       $reference = EmployeeReference::where('id',$id)->first();
       if (!isset($reference->id)) {
          $json['error'] = 'Error: reference not found';
       }
       if (!$json) {


        $datas['reference'] = $reference;


            $json['datas'] = view('employee.edit_reference')->with('datas', $datas)->render();
          }
           return response()->json($json);

     }


     public function updateIndividualTraining(Request $request)
     {
       $json = [];


              $this->validate($request, [
                    'id' => 'required|integer',
                   'title' => 'required|min:3',
                    'details' => 'required|min:3',
                    'institution' => 'required|min:3',
                    'duration' => 'required',
                    'year' => 'required|min:4|max:4',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);





           if ($request->employer_id > 0) {
                $institution_id = $request->employer_id;
            } else{

                $employers = \App\Employers::select('id')->where('name', $request->institution)->first();
                if (isset($employers->id)) {
                    $institution_id = $employers->id;
                }else{
                    $datas = [
                    'name' => $request->institution,
                    'seo_url' => str_replace(' ', '-', $request->institution),
                    'member_type' => 4,
                    'status' => 1
                ];
                $employer = \App\Employer::create($datas);
                if($employer){
                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                     $institution_id = $employer->id;
                 } else{
                    $institution_id = $request->employer_id;
                 }
                }
            }

            $training_document = $request->old_document;
        if ($request->hasFile('training_document')) {
            $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }




        $file = $request->File('training_document');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);
            if (is_file(DIR_IMAGE.$request->old_document)) {
              File::delete(DIR_IMAGE.$request->old_document);
            }
            $training_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
          }




                          $tra = [

                                'title' => $request->title,
                                'details' => $request->details,
                                'institution' => $request->institution,
                                'duration' => $request->duration,
                                'year' => $request->year,
                                'employers_id' => $institution_id,
                                'document'  => $training_document
                            ];
                            EmployeeTraining::where('id',$request->id)->update($tra);
                  $training = EmployeeTraining::where('id',$request->id)->first();
              $json['data'] = [
                  'id' => $training->id,
                  'institute' => $training->institution,

                  'title' => $training->title,
                  'duration'  => $training->duration.' - '.$training->year,
                  'detail' => $training->details,


                ];

               return response()->json($json);
     }


      public function getEditExperience(Request $request)
     {


      $json = [];





       $id = 0;
       if (isset($request->experience_id)) {
         $id = $request->experience_id;
       }

       $experience = EmployeeExperience::where('id',$id)->first();
       if (!isset($experience->id)) {
         $json['error'] = 'Error: education not found';
       }
       if (!$json) {


       $datas['organization_type'] = OrganizationType::orderBy('name', 'asc')->get();


        $datas['employment_type'][] = ['value' => 'Part Time'];
        $datas['employment_type'][] = ['value' => 'Full Time'];

        $datas['job_level'][] = ['value' => 'Entry Level'];
        $datas['job_level'][] = ['value' => 'Junior Level'];
        $datas['job_level'][] = ['value' => 'Mid Level'];
        $datas['job_level'][] = ['value' => 'Senior Level'];

        $datas['working_status'][] = ['value' => 2, 'title' => 'Not Working'];
        $datas['working_status'][] = ['value' => 1, 'title' => 'Currently Working'];


        $datas['experience'] = $experience;

            $json['datas'] = view('employee.edit_experience')->with('datas', $datas)->render();
          }
        return response()->json($json);

     }


     public function updateIndividualExperience(Request $request)
     {



      $json = [];


               $this->validate($request,[
                    'id' => 'required|integer',
                    'organization' => 'required|min:3',
                    'typeofemployment' => 'required|min:3',
                    'org_type_id' => 'required',
                    'designation' => 'required|min:2',
                    'level' => 'required|min:2',
                    'from' => 'required|date_format:"Y-m-d"',
                    'to' => 'required|date_format:"Y-m-d"',
                    'currently_working' => 'required',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000',
                    'country' => 'required'
       ]);

        if ($request->employers_id > 0) {
                                $institution_id = $request->employers_id;
                            } else{

                                $employers = \App\Employers::select('id')->where('name', $request->institution)->first();
                                if (isset($employers->id)) {
                                    $institution_id = $employers->id;
                                }else{
                                    $datas = [
                                    'name' => $request->institution,
                                    'member_type' => 4,
                                    'status' => 1
                                ];
                                $employer = \App\Employer::create($datas);
                                if($employer){
                                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                                     $institution_id = $employer->id;
                                 } else{
                                    $institution_id = $request->employers_id;
                                 }
                                }

                            }
                   $experience_document = $request->old_document;
                  if ($request->hasFile('experience_document')) {
                      $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

                      if (!is_dir($directory)) {
                          mkdir($directory, 0777, true);
                      }




                  $file = $request->File('experience_document');
                  $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

                      $file->move($directory, $str);
                      if (is_file(DIR_IMAGE.$request->old_document)) {
                        File::delete(DIR_IMAGE.$request->old_document);
                      }
                      $experience_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
                    }

                          $tra = [

                                'organization' => $request->organization,
                                'typeofemployment' => $request->typeofemployment,
                                'org_type_id' => $request->org_type_id,
                                'designation' => $request->designation,
                                'level' => $request->level,
                                'from' => $request->from,
                                'to' => $request->to,
                                'currently_working' => $request->currently_working,
                                'country' => $request->country,
                                'experience' => nl2br($request->detail),
                                'employers_id' => $institution_id,
                                'document'  => $experience_document
                            ];
                     // dd($tra);
                            EmployeeExperience::where('id',$request->id)->update($tra);
                            $experience = EmployeeExperience::where('id',$request->id)->first();

                $to = $experience->currently_working == '1' ? 'Present' : $experience->to;
              $json['datas'] = [
                            'id' => $experience->id,
                            'organization' => $experience->organization,
                            'designation' => $experience->designation,
                            'from_to' => $experience->from.' - '.$to,
                            'country'  => $experience->country,


                ];



      return response()->json($json);
     }


      public function getEditLanguage(Request $request)
     {
      $json = [];
       $id = 0;
       if (isset($request->language_id)) {
         $id = $request->language_id;
       }

       $language = EmployeeLanguage::where('id',$id)->first();
       if (isset($language->id)) {


        $datas['yes_no'][] = ['value' => 0, 'title' => 'No'];
        $datas['yes_no'][] = ['value' => 1, 'title' => 'Yes'];

        $datas['easy'][] = ['value' => 'Easily'];
        $datas['easy'][] = ['value' => 'Not Easily'];

        $datas['fluent'][] = ['value' => 'Fluently'];
        $datas['fluent'][] = ['value' => 'Not Fluently'];


        $datas['language'] = $language;
            $json['datas'] = view('employee.edit_language')->with('datas', $datas)->render();
          } else{
            $json['error'] = 'Error: Language not found';
          }
          return response()->json($json);

     }


     public function updateIndividualLanguage(Request $request)
     {


      $json = [];
       $this->validate($request,[
                    'id' => 'required|integer',
                    'language' => 'required',
       ]);
       $language = EmployeeLanguage::where('id', $request->id)->first();
       if (isset($language->id)) {

        $tra = [

                                'language' => $request->language,
                                'understand' => $request->understand,
                                'speak' => $request->speak,
                                'reading' => $request->read,
                                'writing' => $request->write,
                                'mother_t' => $request->mother_t,
                            ];
        EmployeeLanguage::where('id',$request->id)->update($tra);
        $mt = $request->mother_t == 1 ? 'Yes' : 'No';
        $json['data'] = [
          'id' => $request->id,
          'language' => $request->language,
          'understand' => $request->understand,
          'speak' => $request->speak,
          'read' => $request->read,
          'writing' => $request->write,
          'mother_tongue' => $mt,

        ];
      } else{
        $json['error'] = 'Error: Data not found';
      }

        return response()->json($json);

     }

     public function WithdrawApplication(Request $request)
     {
         $this->validate($request,[
                    'job_id' => 'required|integer',
                    'apply_id' => 'required',
                    'reason' => 'required',
       ]);
        $tra = ['jobs_id' => $request->job_id, 'employees_id' => auth()->guard('employee')->user()->id, 'reason' => $request->reason];
        JobWithdraw::create($tra);
        JobApply::where('id', $request->apply_id)->delete();
         $formdata = FormData::where('employees_id',auth()->guard('employee')->user()->id)->where('jobs_id',$request->job_id)->get();
        foreach ($formdata as $key => $value) {
          if ($value->type == 1) {
            if (is_file(DIR_IMAGE.$value->f_description)) {
              \File::delete(DIR_IMAGE.$value->f_description);
            }
          }
        }
        FormData::where('employees_id',auth()->guard('employee')->user()->id)->where('jobs_id',$request->job_id)->delete();
        \Session::flash('alert-success','You have successfully withdrawn from the application');
            return redirect()->back();

     }



     public function approveParticipation(Request $request)
     {
       if (!isset($request->process_id)) {
         \Session::flash('alert-danger', 'Process is required');
         return redirect()->back();
       }


       $jobprocess = \App\JobProcess::where('id',$request->process_id)->first();

       if (isset($jobprocess->id)) {
         $part[] = auth()->guard('employee')->user()->id;
         $participated = json_decode($jobprocess->participated);
         if (is_array($participated)) {
           if (!in_array(auth()->guard('employee')->user()->id, $participated)) {
             foreach ($participated as $key => $value) {
               $part[] = $value;
             }


           }
         }
         \App\JobProcess::where('id',$request->process_id)->update(['participated' => json_encode($part)]);
         \Session::flash('alert-success', 'Thank you for participating on '.$jobprocess->title);
         return redirect()->back();
       }else{
        \Session::flash('alert-danger', 'Process Not Found');
         return redirect()->back();
       }


     }

      public function saveEducation(Request $request){
      $json = [];

      $lids = ['6','7'];
         if(in_array($request->level_id,$lids))
         {
             $this->validate($request,[

                    'country' => 'required|min:3',
                    'level_id' => 'required|integer',
                    'specialization' => 'required|min:3',
                    'institution' => 'required|min:3',
                    'board' => 'required|min:2',
                    'percent' => 'required|numeric',
                    'marksystem' => 'required',
                    'year' => 'required|min:4|max:4',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);

         }else{
              $this->validate($request,[

                    'country' => 'required|min:3',
                    'level_id' => 'required|integer',
                    'faculty_id' => 'required|integer',
                    'specialization' => 'required|min:3',
                    'institution' => 'required|min:3',
                    'board' => 'required|min:2',
                    'percent' => 'required|numeric',
                    'marksystem' => 'required',
                    'year' => 'required|min:4|max:4',
                    'education_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);
         }





           if ($request->institution_id > 0) {
                $institution_id = $request->institution_id;
            } else{

                $employers = \App\Employers::select('id')->where('name', $request->institution)->first();
                if (isset($employers->id)) {
                    $institution_id = $employers->id;
                }else{
                    $datas = [
                    'name' => $request->institution,
                    'seo_url' => str_replace(' ', '-', $request->institution),
                    'member_type' => 4,
                    'status' => 1
                ];
                $employer = \App\Employer::create($datas);
                if($employer){
                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                     $institution_id = $employer->id;
                 } else{
                    $institution_id = $request->institution_id;
                 }
                }
            }

            $education_document = '';
        if ($request->hasFile('education_document')) {
            $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }


        $file = $request->File('education_document');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);
            $education_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
          }
          $total_education = EmployeeEducation::where('employees_id', auth()->guard('employee')->user()->id)->count();
                $edu = [
                    'employees_id' => auth()->guard('employee')->user()->id,
                    'country' => $request->country,
                    'level_id' => $request->level_id,
                    'faculty_id' => $request->faculty_id,
                    'specialization' => $request->specialization,
                    'institution' => $request->institution,
                    'board' => $request->board,
                    'marksystem' => $request->marksystem,
                    'percentage' => $request->percent,
                    'year' => $request->year,
                    'document'  => $education_document,
                    'sn'  => $total_education,
                    'employers_id' => $institution_id,

                ];

                $education = EmployeeEducation::create($edu);
                $msys = $education->marksystem == 1 ? '%' : 'CGPA';
                $json['data'] = [
                  'id' => $education->id,
                  'institution' => $education->institution,
                  'faculty' => Faculty::getLevelTitle($education->level_id).' in '.Faculty::getTitle($education->faculty_id),
                  'board' => $education->board,
                  'year'  => $education->year,
                  'specialization' => $education->specialization,
                  'percentage'  => $education->percentage.' '.$msys

                ];
                $json['educations'] = $education;
                  if (Session()->has('job_apply')) {
                return redirect('/employee/jobapply/'.Session()->get('job_url'));
              }


      return response()->json($json);
}

public function saveTraining(Request $request){

    $json = [];
    $this->validate($request, [

        'title' => 'required|min:3',
        'details' => 'required|min:3',
        'institution' => 'required|min:3',
        'duration' => 'required',
        'year' => 'required|min:4|max:4',
        'training_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
       ]);

          if ($request->institution_id > 0) {
                $institution_id = $request->institution_id;
            } else{

                $employers = \App\Employers::select('id')->where('name', $request->institution)->first();
                if (isset($employers->id)) {
                    $institution_id = $employers->id;
                }else{
                    $datas = [
                    'name' => $request->institution,
                    'seo_url' => str_replace(' ', '-', $request->institution),
                    'member_type' => 4,
                    'status' => 1
                ];
                $employer = \App\Employer::create($datas);
                if($employer){
                     \App\EmployerAddress::create(['employers_id' => $employer->id]);
                    \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                    \App\EmployerHead::create(['employers_id' => $employer->id]);
                     $institution_id = $employer->id;
                 } else{
                    $institution_id = $request->institution_id;
                 }
                }
            }

            $training_document = '';
        if ($request->hasFile('training_document')) {
            $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }


        $file = $request->File('training_document');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);
            $training_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
          }
          $total_training = EmployeeTraining::where('employees_id', auth()->guard('employee')->user()->id)->count();

        $tra = [
            'employees_id' => auth()->guard('employee')->user()->id,
            'title' => $request->title,
            'details' => $request->details,
            'institution' => $request->institution,
            'duration' => $request->duration,
            'year' => $request->year,
            'sn'  => $total_training,
            'employers_id' => $institution_id,
            'document'  => $training_document
        ];
        $training = EmployeeTraining::create($tra);


                $json['data'] = [
                  'id' => $training->id,
                  'institute' => $training->institution,

                  'title' => $training->title,
                  'duration'  => $training->duration.' - '.$training->year,
                  'detail' => $training->details,


                ];


        if (Session()->has('job_apply')) {
            return redirect('/employee/jobapply/'.Session()->get('job_url'));
          }


      return response()->json($json);

    }


    public function saveExperience(Request $request){
       $json = [];

      $this->validate($request, [
                    'organization' => 'required|min:3',
                    'typeofemployment' => 'required|min:3',
                    'org_type_id' => 'required',
                    'designation' => 'required|min:2',
                    'level' => 'required|min:2',
                    'from' => 'required|date_format:"Y-m-d"',
                    'to' => 'required|date_format:"Y-m-d"',
                    'currently_working' => 'required',
                    'country' => 'required|min:2',
                    'experience_document' => 'mimes:jpeg,jpg,png,gif,doc,docx,pdf|max:10000'
      ]);


        if ($request->institution_id > 0) {
            $institution_id = $request->institution_id;
        } else{

            $employers = \App\Employers::select('id')->where('name', $request->organization)->first();
            if (isset($employers->id)) {
                $institution_id = $employers->id;
            }else{
                $datas = [
                'name' => $request->organization,
                'org_type' => $request->org_type_id,
                'seo_url' => str_replace(' ', '-', $request->organization),
                'member_type' => 4,
                'status' => 1
            ];
            $employer = \App\Employer::create($datas);
            if($employer){
                \App\EmployerAddress::create(['employers_id' => $employer->id]);
                \App\EmployerContactPerson::create(['employers_id' => $employer->id]);
                \App\EmployerHead::create(['employers_id' => $employer->id]);
                $institution_id = $employer->id;
             }else{
                $institution_id = $experience['institution_id'];
             }
            }
        }

        $experience_document = '';
        if ($request->hasFile('experience_document')) {
            $directory = DIR_IMAGE . 'employees/'.auth()->guard('employee')->user()->id;

            if (!is_dir($directory)) {
                mkdir($directory, 0777, true);
            }


        $file = $request->File('experience_document');
        $str = \Str::random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $str);
            $experience_document = 'employees/'.auth()->guard('employee')->user()->id.'/'.$str;
          }
        $total_experience = EmployeeExperience::where('employees_id', auth()->guard('employee')->user()->id)->count();
        $sn = $total_experience + 1;
      $exp = [
          'employees_id' => auth()->guard('employee')->user()->id,
          'sn'    => $sn,
          'organization' => $request->organization,
          'typeofemployment' => $request->typeofemployment,
          'org_type_id' => $request->org_type_id,
          'designation' => $request->designation,
          'level' => $request->level,
          'from' => $request->from,
          'to' => $request->to,
          'currently_working' => $request->currently_working,
          'country' => $request->country,
          'experience' => $request->detail,
          'employers_id' => $institution_id,
          'document'  => $experience_document
      ];



      $experience = EmployeeExperience::create($exp);

    if (Session()->has('job_apply')) {
        return redirect('/employee/jobapply/'.Session()->get('job_url'));
      }
      $to = $experience->currently_working == '1' ? 'Present' : $experience->to;
    $json['datas'] = [
                  'id' => $experience->id,
                  'organization' => $experience->organization,
                  'designation' => $experience->designation,
                  'from_to' => $experience->from.' - '.$to,
                  'country'  => $experience->country,


                ];

  return response()->json($json);
}


public function saveLanguage(Request $request){
  $json = [];
    $this->validate($request, [
        'language' => 'required|min:3',
    ]);

    $lan = [
        'employees_id' => auth()->guard('employee')->user()->id,
        'language' => $request->language,
        'understand' => $request->understand,
        'speak' => $request->speak,
        'reading' => $request->read,
        'writing' => $request->write,
        'mother_t' => $request->mother_t,

    ];
    $language = EmployeeLanguage::create($lan);
    if ($language) {
      $mt = $language->mother_t == 1 ? 'Yes' : 'No';
      $json['data'] = [
        'id' => $language->id,
        'language' => $language->language,
        'understand' => $language->understand,
        'speak' => $language->speak,
        'reading' => $language->reading,
        'writing' => $language->writing,
        'mother_tongue' => $mt,

      ];
      if (Session()->has('job_apply')) {
        return redirect('/employee/jobapply/'.Session()->get('job_url'));
      }
    } else{
      $json['error'] = 'Error: Something went wrong while adding language';
    }


      return response()->json($json);
    }

public function saveReference(Request $request){
  $json = [];

    $this->validate($request, [
    'name' => 'required|min:3',
    'designation' => 'required|min:2',
    'address' => 'required|min:3',
    'mobile' => 'required|min:3',
    'company' => 'required|min:3',
]);

    $ref = [
      'employees_id' => auth()->guard('employee')->user()->id,
      'name' => $request->name,
      'designation' => $request->designation,
      'address' => $request->address,
      'office_phone' => $request->office_phone,
      'mobile' => $request->mobile,
      'email' => $request->email,
      'company' => $request->company
    ];

    $ref = EmployeeReference::create($ref);
    if ($ref) {
      $employee = Employees::where('id', auth()->guard('employee')->user()->id)->first();
    $datas = [
    'from_name' => Settings::getSettings()->name,
    'from_email' => Settings::getSettings()->email,
    'to_name' => $request->name,
    'to_email' => $request->email,
    'subject' => 'Reference Conformation Email',
    'employee_name' => Employees::getFullname($employee->firstname,$employee->middlename,$employee->lastname),
    'designation' => $request->designation,
    'company' => $request->company,
    'name' => $request->name,
    'employee_email' => $employee->email,
    ];
    $this->sendReference($datas);
    $today = Carbon::now()->todatestring();
    EmployeeReference::where('id', $ref->id)->update(['send_date' => $today]);

if (Session()->has('job_apply')) {
    return redirect('/employee/jobapply/'.Session()->get('job_url'));
  }

    $json['data'] = [
                  'id' => $ref->id,
                  'name' => $ref->name,
                  'designation' => $ref->designation,
                  'company' => $ref->company,
                  'email'  => $ref->email.', '.$ref->mobile.', '.$ref->office_phone.', '.$ref->address,


                ];
    }

return response()->json($json);
}

public function updateIndividualReference(Request $request){
    $json = [];
    $this->validate($request, [
        'id'  => 'required|integer',
        'name' => 'required|min:3',
        'designation' => 'required|min:2',
        'address' => 'required|min:3',
        'mobile' => 'required|min:3',
        'company' => 'required|min:3',
    ]);
    $refe = EmployeeReference::where('id',$request->id)->first();
    if (isset($refe->id)) {


    $ref = [
      'employees_id' => auth()->guard('employee')->user()->id,
      'name' => $request->name,
      'designation' => $request->designation,
      'address' => $request->address,
      'office_phone' => $request->office_phone,
      'mobile' => $request->mobile,
      'email' => $request->email,
      'company' => $request->company
    ];

    EmployeeReference::where('id',$request->id)->update($ref);
   $reference = EmployeeReference::where('id',$request->id)->first();

    $json['data'] = [
                  'id' => $reference->id,
                  'name' => $reference->name,
                  'designation' => $reference->designation,
                  'company' => $reference->company,
                  'email'  => $reference->email.', '.$reference->mobile.', '.$reference->office_phone.', '.$reference->address,


                ];
    } else{
      $json['error'] = 'Error: Reference data not found';
    }

return response()->json($json);
}


public function getScore(Request $request)
{
  $type = 'All';

  if (isset($request->type)) {
    $type = $request->type;
  }

  $datas = \App\EmployeeActivity::getRank($type,auth()->guard('employee')->user()->id,$request->employers);
  $others = '';
  if (count($datas['employers']) > 0) {
    $others = '<label>Filter by :</label><select id="filter_by_institute"><option value="">Select Option</option>';
    foreach ($datas['employers'] as $key => $value) {
      $others .= '<option value="'.$value.'">'.Employers::getName($value).'</option>';
    }
    $others .= '</select>';
  }

  if ($type == 'Functional') {

    $skills = EmployeeSkills::where('employees_id', auth()->guard('employee')->user()->id)->get();
    $others = '<label>Filter by :</label><select id="filter_by_institute"><option value="">Select Option</option>';
    foreach ($skills as $key => $value) {
      $others .= '<option value="'.$value->title.'">'.$value->title.'</option>';
    }
    $others .= '</select>';

  }
  $topthree = '';
  if(count($datas['topthree'])){
    $topthree = '<div class="topthree">';

      $employees = Employees::select('id','points')->whereIn('id',$datas['topthree'])->orderBy('points','desc')->get();
      foreach ($employees as $key => $empl) {
        if ($empl->id == auth()->guard('employee')->user()->id) {
                      $simage = asset(Employees::getPhoto($empl->id));
                      $sname = Employees::getName($empl->id);
                    }else{
                      $sett = EmployeeSetting::select('score_privacy','name_privacy')->where('employees_id',$empl->id)->first();
                      $setid[] = '0';
                      $checkcircle = \App\UserCircle::checkFriend($empl->id);
                      if($checkcircle > 0)
                      {
                        $setid[] = '3';
                      }
                      if (\App\UserCircle::checkAlumni($empl->id)) {
                        $setid[] = '2';
                      }

                      if (in_array($sett->score_privacy, $setid)) {
                        $simage = asset(Employees::getPhoto($empl->id));
                         if (in_array($sett->name_privacy, $setid)) {
                          $sname = Employees::getName($empl->id);
                        }else{
                          $sname = Employees::getFirstName($empl->id);
                        }
                      }else{
                        $simage = asset('images/noimg.gif');
                        $sname = 'Someone from RollingNexus';
                      }

                    }

                    $topthree .= '<div class="employee"><span class="emp_image"><img src="'.$simage.'"></span><span class="emp_name">'.$sname.'<div class="emp_score">'.$empl->points.'</div></span></div>';
       // $topthree .= '<div class="employee"><span class="emp_image"><img src="'.asset(Employees::getPhoto($empl->id)).'"></span><span class="emp_name">'.Employees::getName($empl->id).'<div class="emp_score">'.$empl->points.'</div></span></div>';
      }

    $topthree .= '</div>';
  }


  return $datas['score'].'/'.$datas['highscore'].'||'.$datas['rank'].'/'.$datas['total'].'||'.$others.'||'.$topthree;
}


public function changeSession(Request $request)
{
  $this->validate($request, ['id' => 'required']);
  session(['tab' => $request->id]);
}

public function UpdateSkills(Request $request)
{
  $json = [];
  $this->validate($request, [
    'id'  => 'required|integer',
    'skills' => 'required'
  ]);
  $skill_data = '<div id="skl">';
  $skill_detail = '<div id="skill_detail" class="hidden">';
  $empskills = EmployeeSkills::where('employees_id', $request->id)->get();

                   $akill = [];
                   foreach ($empskills as $key => $emskil) {
                     $akill[] = $emskil->title;

                   }
                    if (!empty($request->skills)) {
                        $skills = explode(',', $request->skills);
                        $diffs = array_diff($akill, $skills);

                        foreach ($diffs as $key => $diff) {
                            EmployeeSkills::where('employees_id', $request->id)->where('title', $diff)->delete();
                        }
                         $emskills = EmployeeSkills::where('employees_id', $request->id)->get();
                         foreach ($emskills as $key => $value) {
                           $endorse = json_decode($value->endorsed);
                            $total_endorse = 0;
                            if(is_array($endorse)){
                              $total_endorse = count($endorse);
                            }


                           $skill_data  .= '<div id="skill_'.$value->id.'"><span class="squrebullet"></span><span>'.$value->title.'</span></div>';
                           $skill_detail .= ' <div class="education tb10p border_bottom" id="skill_row_'.$value->id.'"><div class="row cm10-row"><div class="col-lg-12 col-md-12 col-12"><h3 class="job_post btm5p bold">'.$value->title.'</h3>';
                                if($total_endorse > 0){
                                $skill_detail .= '<span><b>Understand: </b></span>';
                                foreach($endorse as $nd){
                                $skill_detail .= '<span class="lft30m">'.\App\Employees::getName($nd).'</span>';
                                }
                                }
                              $skill_detail .= '</div></div></div>';
                         }

                        if (count($skills) > 0) {
                            foreach ($skills as $key => $skill) {
                                if (!in_array($skill, $akill)) {
                                    $skl = EmployeeSkills::create(['employees_id' => $request->id, 'title' => $skill]);
                                    if ($skl) {
                                      $skill_data  .= '<div id="skill_'.$skl->id.'"><span class="squrebullet"></span><span>'.$skl->title.'</span></div>';
                                       $skill_detail .= ' <div class="education tb10p border_bottom" id="skill_row_'.$skl->id.'"><div class="row cm10-row"><div class="col-lg-12 col-md-12 col-12"><h3 class="job_post btm5p bold">'.$skl->title.'</h3></div></div></div>';
                                    }

                                }

                            }
                        }
                    }
        $skill_data .= '</div>';
      $skill_detail .= '</div>';
      $json['datas'] = $skill_data.$skill_detail;
      return response()->json($json);
}


public function GetContactUsers(Request $request)
{
  $data['contacts'] = [];

      $contacts = \App\UserCircle::where('user_id',auth()->guard('employee')->user()->id)->where('status', 1)->get();
      foreach ($contacts as $key => $contact) {
        $number_of = false;
        $chk_msg = \App\ChatMessage::where('message_from', $contact->staff_id)->where('message_to', auth()->guard('employee')->user()->id)->where('view_status','!=', '1')->count();
        if ($chk_msg > 0) {
          $number_of = $chk_msg;
        }

        $data['contacts'][] = [
          'id'    => $contact->staff_id,
          'name'  => Employees::getName($contact->staff_id),
          'image'  => Employees::getPhoto($contact->staff_id),
          'status'  => Employees::CheckOnline($contact->staff_id),
          'number_of' => $number_of,

        ];
      }

    $return_data = view('employee.message_users')->with('data',$data)->render();
    return response()->json($return_data);
}


public function GetChatBox($user_id='',Request $request)
{
    $page = 0;
    if ($request->page) {
        $page= $request->page;
    }
    $limit = 20;
    $start = $page * $limit;
    $data = [];
    $my_id = auth()->guard('employee')->user()->id;

        // Make read all unread message
        \App\ChatMessage::where(['message_from' => $user_id, 'message_to' => $my_id])->update(['view_status' => 1]);

        // Get all message message_from selected user
        $messages = \App\ChatMessage::where(function ($query) use ($user_id, $my_id) {
            $query->where('message_from', $user_id)->where('message_to', $my_id)->where('to_delete', '!=', '1');
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('message_from', $my_id)->where('message_to', $user_id)->where('from_delete', '!=', '1');
        })->orderBy('id','desc');


        $data['message'] = $messages->skip($start)->take($limit)->get()->reverse();
        $totmsg = $messages->count();
        $fetmsg = ($page + 1) * $limit;
        $data['ldmr'] = 1;
        if ($totmsg > $fetmsg) {
          $data['ldmr'] = 2;
        }
        $data['user_id'] = $user_id;
        $data['name'] = Employees::getName($user_id);
        $data['image'] = Employees::getPhoto($user_id);
        $data['page'] = $page + 1;
        if ($page > 0) {
          $return_data['data'] = view('employee.chats')->with('data',$data)->render();
          $return_data['ldmr'] = $data['ldmr'];
        } else{
          $return_data = view('employee.chat_box')->with('data',$data)->render();
        }

    return response()->json($return_data);
}

    public function sendMessage(Request $request)
        {
        $json = [];

        $this->validate($request,[
            'receiver_id' => 'required|integer',
            'message'   => 'required'
        ]);
            $from = auth()->guard('employee')->user()->id;
            $to = $request->receiver_id;
            $message = $request->message;

            $data = new \App\ChatMessage();
            $data->message_from = $from;
            $data->message_to = $to;
            $data->message = $message;
            $data->view_status = 0; // message will be unread when sending message
            $data->from_delete = 0;
            $data->to_delete = 0;
            $data->save();

            // pusher
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true
            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $html = '<li id="chat_'.$data->id.'" class="p-1 rounded mb-1">
                                    <div class="receive-msg">
                                        <div class="receive-msg-img">
                                            <img src="'.asset(\App\Employees::getPhoto($data->message_from)).'">
                                        </div>
                                        <div class="receive-msg-desc rounded text-center mt-1 ml-1 pl-2 pr-2">
                                            <p class="mb-0 mt-1 pl-2 pr-2 rounded">'.$data->message.'</p>

                                        </div>
                                    </div>
                                    <i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i>
                                </li>';

            $pda = ['from' => $from, 'to' => $to, 'html' => $html, 'sender_name' => Employees::getName($data->message_from)]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $pda);

            $json['data'] = '<li id="chat_'.$data->id.'" class="pl-2 pr-2 rounded text-white text-center send-msg mb-1 unread_message">'.$data->message.'<i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i></li>';
            return response()->json($json);

        }

    public function DeleteChatMessage(Request $request)
    {
      $json = [];
      $this->validate($request, [
        'id'  => 'required|integer'
      ]);
      $message = \App\ChatMessage::where('id', $request->id)->first();

      if ($message) {
        $myid = auth()->guard('employee')->user()->id;

        if ($message->message_from == $myid) {
          if ($message->to_delete == 1) {
            \App\ChatMessage::DeleteDocuments($message->documents);
            \App\ChatMessage::where('id', $message->id)->delete();
          }else{
            \App\ChatMessage::where('id', $message->id)->update(['from_delete' => '1']);
          }
          $json['success'] = 'Message deleted successfully';
        }elseif ($message->message_to == $myid) {

          if ($message->from_delete == 1) {
            \App\ChatMessage::DeleteDocuments($message->documents);
            \App\ChatMessage::where('id', $message->id)->delete();
          }else{
            \App\ChatMessage::where('id', $message->id)->update(['to_delete' => '1']);
          }
          $json['success'] = 'Message deleted successfully';
        }else{
          $json['error'] = 'You can not delete this message';
        }
      } else{
        $json['error'] = 'Message Not found';
      }
      return response()->json($json);
    }

    public function UpdateReadStatus(Request $request)
    {
      if (isset($request->id)) {
        $myid = auth()->guard('employee')->user()->id;
        \App\ChatMessage::where(['message_from' => $request->id, 'message_to' => $myid])->update(['view_status' => '1']);
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $text = '<span style="--i:1">W</span><span style="--i:2">r</span><span style="--i:3">i</span><span style="--i:4">t</span><span style="--i:5">i</span><span style="--i:6">n</span><span style="--i:7">g</span><span style="--i:8"> </span><span style="--i:9">.</span><span style="--i:10">.</span><span style="--i:11">.</span>';
        $html = '<li id="chat_writing" class="p-1 rounded mb-1">
                                <div class="receive-msg">
                                    <div class="receive-msg-img">
                                        <img src="'.asset(\App\Employees::getPhoto($myid)).'">
                                    </div>
                                    <div class="receive-msg-desc rounded text-center mt-1 ml-1 pl-2 pr-2">
                                        <p class="mb-0 mt-1 pl-2 pr-2 rounded wavy">'.$text.'</p>

                                    </div>
                                </div>

                            </li>';

        $pda = ['from' => $myid, 'to' => $request->id, 'html' => $html, 'sender_name' => Employees::getName($myid),'data_type' => 'writing']; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $pda);
      }


    }

    public function UploadChatPhoto(Request $request)
    {
      $json = array();

      $this->validate($request, [
        'id'  => 'required|integer',
        'file.*'=>'mimes:jpeg,jpg,png,gif,doc,docx,xls,xlsx,pdf,zip|required|max:10000',
        'type'  => 'required'
      ]);


      $json['datas'] = '';
      $dvim = '';


        $filelocation = [];

        $directory = DIR_IMAGE . 'employee/chat/'.auth()->guard('employee')->user()->id;

        // Check its a directory
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);

        }


            // Sanitize the folder name

            if ($request->hasFile('file')) {

            // Validate the filename length


            foreach ($request->File('file') as $file) {
            $str = preg_replace('/\s+/', '', $file->getClientOriginalName());

            $str = \Str::random(10).'-'.$str;
            //$path = $directory.'/' . $file->getClientOriginalName();
            $filelocation[] = 'employee/chat/'.auth()->guard('employee')->user()->id.'/'.$str;

            $file->move($directory, $str);


            }
             # code...
            }


        $from = auth()->guard('employee')->user()->id;
        $to = $request->id;
        $message = '';

        $data = new \App\ChatMessage();
        $data->message_from = $from;
        $data->message_to = $to;
        $data->message = $message;
        $data->view_status = 0; // message will be unread when sending message
        $data->from_delete = 0;
        $data->to_delete = 0;
        $data->type = $request->type;
        $data->documents = json_encode($filelocation);
        $data->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
        $mm = \App\ChatMessage::getDocuments($data->documents,$data->type,$data->id);
        $html = '<li id="chat_'.$data->id.'" class="p-1 rounded mb-1">
                                <div class="receive-msg">
                                    <div class="receive-msg-img">
                                        <img src="'.asset(\App\Employees::getPhoto($data->message_from)).'">
                                    </div>
                                    <div class="receive-msg-desc rounded text-center mt-1 ml-1 pl-1 pr-1">
                                        <p class="mb-0 mt-1 pl-1 pr-1 rounded">'.$mm.'</p>

                                    </div>
                                </div>
                                <i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i>
                            </li>';

        $pda = ['from' => $from, 'to' => $to, 'html' => $html, 'sender_name' => Employees::getName($data->message_from)]; // sending from and to user id when pressed enter
        $pusher->trigger('my-channel', 'my-event', $pda);

        $json['datas'] = '<li id="chat_'.$data->id.'" class="pl-1 pr-1 rounded text-white text-center send-msg mb-1 unread_message">'.$mm.'<i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i></li>';



        return response()->json($json);
        //$this->response->setOutput(json_encode($json));


    }

    public function checkout()
    {
      if(session()->has('cart_id'))
      {
        $payment_options = \App\Payments::where('status', 1)->get();
        // $employer_id = auth()->guard('employer')->user()->employers_id;
        // $employer=\App\Employers::where('id',$employer_id)->with('paymentmethods')->first();
        return view('employee.checkout')->with('payments',$payment_options);
      } else{
            return redirect('employee/cart');
      }
    }

    public function payment(Request $request)
     {
       $opt = \App\Payments::where('id', $request->id)->first();
       if(isset($opt->payment_page))
       {

        $cont= '\App\Http\Controllers\employee\payments\\'.$opt->payment_page.'Controller';
        $module = new $cont();
        return $module->index();
       } else{
        return '';
       }
     }

     public function invoice()
     {
        $invoice = Invoice::where('invoice_by', auth()->guard('employee')->user()->id)
        ->with('invoiceHistory')
        ->orderBy('created_at', 'desc')
        ->paginate(50);
        $datas = $invoice;
        $user = Employees::where('id', auth()->guard('employer')->user()->id)->first();
        $data['user'] = $user;
        $data['invoice'] = $invoice;
        return view('employer.invoice',compact('data'));
     }
}

