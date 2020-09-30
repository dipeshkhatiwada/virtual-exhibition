<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employees;
use App\EmployeeAddress;
use App\EmployeeCategory;
use App\EmployeeOrganization;
use App\EmployeeLocation;
use App\EmployeeEducation;
use App\EmployeeExperience;
use App\EmployeeSetting;
use App\Apply;
use App\Imagetool;
use App\Employers;
use App\JobAlert;
use App\JobApply;
use App\library\myFunctions;
use App\library\Settings;
use App\Jobs;
use Mail;
use App\Mail\AlertMail;
use App\Project;
use App\Event;


class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailsend:sendemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Send';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         //$iis = ['132','5496'];
        $alertables = \App\EmployeeSetting::where('alertable',1)->get();

        foreach ($alertables as $key => $alertable) {
            $employee = Employees::where('id',$alertable->employees_id)->first();
            $datas['recomended_jobs'] = [];
            $datas['recomended_project'] = [];
            $datas['recomended_event'] = [];
            $datas['recomended_training'] = [];
            $new_job_ids = [];
            $new_project_ids = [];
            $new_event_ids = [];
            $new_training_ids = [];
            $apply_id = [];
            $applies = $employee->Apply;
            foreach ($applies as $key => $apply) {
                $apply_id[] = $apply->jobs_id;
            }
            $alerts = JobAlert::where('employees_id',$employee->id)->first();
            $alt = [];
            if (isset($alerts->job_ids)) {
                $alt = json_decode($alerts->job_ids);
            }
            

            $job_ids = array_merge($apply_id,$alt);

            $recomended_jobs = Jobs::whereNotIn('id', $job_ids)->where('min_experience', '<=', $alertable->total_experience)->where('min_age', '<=', $alertable->age)->where('status', 1)->where('deadline', '>=', date('Y-m-d'))->where('job_type', '!=', 5)->orderBy('job_type','asc')->get();
            foreach ($recomended_jobs as $key => $rjob) {
                $job_educaitons = \App\JobEducation::where('jobs_id',$rjob->id)->orderBy('education_level_id','desc')->get();
                if (count($job_educaitons) > 0) {
                    foreach ($job_educaitons as $key => $je) {
                        $emp_education = \App\EmployeeEducation::where('employees_id', $employee->id)->where('level_id',$je->education_level_id);
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
                                    $new_job_ids[] = $rjob->id;
                                    $datas['recomended_jobs'][] = [
                                        'employer_logo' => \App\Employers::getEmpLogo($rjob->employers_id),
                                        'employer_name' => \App\Employers::getName($rjob->employers_id),
                                        'employers_id' => $rjob->employers_id,
                                        'job_url' => url('jobs/'.\App\Employers::getUrl($rjob->employers_id).'/'.$rjob->seo_url),
                                        'job_title' => $rjob->title,
                                        
                                        'publish_date' => $rjob->publish_date,
                                        'deadline' => $rjob->deadline
                                      ];
                                }
                            } else{
                                $new_job_ids[] = $rjob->id;
                                $datas['recomended_jobs'][] = [
                                    'employer_logo' => \App\Employers::getEmpLogo($rjob->employers_id),
                                    'employer_name' => \App\Employers::getName($rjob->employers_id),
                                    'employers_id' => $rjob->employers_id,
                                    'job_url' => url('jobs/'.\App\Employers::getUrl($rjob->employers_id).'/'.$rjob->seo_url),
                                    'job_title' => $rjob->title,
                                  
                                    'publish_date' => $rjob->publish_date,
                                    'deadline' => $rjob->deadline
                                ];
                            }

                        }
                    }
                } else{
                    $new_job_ids[] = $rjob->id;
                      $datas['recomended_jobs'][] = [
                        'employer_logo' => \App\Employers::getEmpLogo($rjob->employers_id),
                        'employer_name' => \App\Employers::getName($rjob->employers_id),
                        'employers_id' => $rjob->employers_id,
                        'job_url' => url('jobs/'.\App\Employers::getUrl($rjob->employers_id).'/'.$rjob->seo_url),
                        'job_title' => $rjob->title,
                        
                        'publish_date' => $rjob->publish_date,
                        'deadline' => $rjob->deadline
                      ];
                }
                if (count($datas['recomended_jobs']) == 10) {
                    break;
                }
            }

            $applies = \App\ProjectApply::where('employees_id', $employee->id)->get();
           $apply = [];
           foreach ($applies as $key => $pa) {
               $apply[] = $pa->project_id;
           }

           
            $palert = [];
            if (isset($alerts->project_ids)) {
                $palert = json_decode($alerts->project_ids);
            }
            $project_ids = array_merge($apply,$palert);

            foreach ($employee->Skills as $key => $skills) {
            $prj = Project::whereNotIn('id', $project_ids)->where('skills', 'LIKE', '%'.$skills->title.'%')->where('status', 1)->inRandomOrder()->first();

           if (isset($prj->id)) {
                $new_project_ids[] = $prj->id;
                $datas['recomended_project'][] = [
                
                    'title' => Settings::getLimitedWords($prj->title,0,10),
                    'href' => url('/projects/'.$prj->seo_url),
                    'publish_by' => Employers::getName($prj->employers_id),
                    'skills' => $prj->skills,
                    'publish_date' => $prj->publish_date
                ];
            }
           
            if (count($datas['recomended_project']) == 10) {
               break;
             }
         }

             $event_applied = \App\EventApply::where('employees_id', $employee->id)->orderBy('id', 'desc')->get();

             $event_app = [];
               foreach ($event_applied as $key => $ea) {
                   $event_app[] = $ea->event_id;
               }
             $ealert = [];
            if (isset($alerts->event_ids)) {
                $ealert = json_decode($alerts->event_ids);
            }
            $event_ids = array_merge($event_app,$ealert);
            $events = \App\Event::whereNotIn('id',$event_ids)->where('status',1)->orderBy('id','desc')->skip(0)->take(5)->get();
            foreach ($events as $key => $event) {
                $new_event_ids[] = $event->id;
                if (empty($event->image)) {
                    $image = 'images/no-image.png';
                } else{
                    $image = 'image/'.$event->image;
                }
                $datas['recomended_event'][] = [
                    'title' => $event->title,
                    'href' => url('/events/'.$event->seo_url),
                    'publish_by' => Employers::getName($event->employers_id),
                    'image' => asset($image),
                    'publish_date' => $event->event_date,
                    'deadline'  => $event->to_date
                ];

                if (count($datas['recomended_event']) == 5) {
               break;
             }
            }
            
            $training_applied = \App\TrainingApply::where('employees_id', $employee->id)->orderBy('id', 'desc')->get();
            $training_app = [];
               foreach ($training_applied as $key => $ta) {
                   $training_app[] = $ta->event_id;
               }
            $talert = [];
            if (isset($alerts->training_ids)) {
                $talert = json_decode($alerts->training_ids);
            }
            $training_ids = array_merge($training_app,$talert);
            $trainings = \App\Training::whereNotIn('id',$training_ids)->where('status',1)->orderBy('id','desc')->skip(0)->take(5)->get();
            foreach ($trainings as $key => $training) {
                $new_training_ids[] = $training->id;
                if (empty($training->image)) {
                    $image = 'images/no-image.png';
                } else{
                    $image = 'image/'.$training->image;
                }
                $datas['recomended_training'][] = [
                    'title' => $training->title,
                    'href' => url('/trainings/'.$training->seo_url),
                    'publish_by' => Employers::getName($training->employers_id),
                    'image' => asset($image),
                    'publish_date' => $training->start_date,
                    'deadline'  => $training->end_date
                ];
                if (count($datas['recomended_training']) == 5) {
               break;
             }
            }
        


            if (count($datas['recomended_jobs']) > 0) {

                $job_ids = array_merge($new_job_ids,$alt);
                
                $newdata = JobAlert::firstOrNew(array('employees_id' => $alertable->employees_id));
                $newdata->employees_id = $alertable->employees_id;
                $newdata->job_ids = json_encode($job_ids);
                $newdata->save();

                if (count($datas['recomended_project']) > 0) {
                    $pro_ids = array_merge($new_project_ids,$palert);
                    $newdata = JobAlert::firstOrNew(array('employees_id' => $alertable->employees_id));
                    $newdata->employees_id = $alertable->employees_id;
                    $newdata->project_ids = json_encode($pro_ids);
                    $newdata->save();
                }

                if (count($datas['recomended_training']) > 0) {
                    $t_ids = array_merge($new_training_ids,$talert);
                    $newdata = JobAlert::firstOrNew(array('employees_id' => $alertable->employees_id));
                    $newdata->employees_id = $alertable->employees_id;
                    $newdata->event_ids = json_encode($t_ids);
                    $newdata->save();
                }
                if (count($datas['recomended_event']) > 0) {
                    $e_ids = array_merge($new_event_ids,$ealert);
                    $newdata = JobAlert::firstOrNew(array('employees_id' => $alertable->employees_id));
                    $newdata->employees_id = $alertable->employees_id;
                    $newdata->event_ids = json_encode($e_ids);
                    $newdata->save();
                }

              

                myFunctions::setEmail();             
           
                    
    
              
               if(trim($employee->email) != ''){
                $mydata = array(
                    
                    'to_email' => trim($employee->email),
                    'to_name' => $employee->firstname.' '.$employee->middlename.' '.$employee->lastname,
                    'from_name' => Settings::getSettings()->name,
                    'logo' => Settings::getImages()->logo,
                    'from_email' => Settings::getSettings()->email,
                    'jobs' => $datas['recomended_jobs'],
                    'projects' => $datas['recomended_project'],
                    'events' => $datas['recomended_event'],
                    'trainings' => $datas['recomended_training']
                   
                                      
                    );
              
                
              
                    Mail::to($mydata['to_email'],$mydata['to_name'])
                     ->later(2, new AlertMail($mydata));
               }
              

                
            }
        }
    }
}
