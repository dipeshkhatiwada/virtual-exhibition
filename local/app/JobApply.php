<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Jobs;
use App\JpbApply;
use App\JobProcess;

class JobApply extends Model
{
    protected $table = 'job_apply';  

    protected $fillable = array('jobs_id', 'employees_id', 'apply_date','status','document_verification','written_exam','group_discussion','final_interview','final_selection');
    


    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

   public function Employees()
    {
    	return $this->belongsTo('App\Employees');
    }

    public static function getApplyJobs($employeeid)
    {
        $apply = DB::table('job_apply')->where('employees_id', $employeeid)->get();
        if (count($apply) > 0) {
            $jobid = [];
            foreach ($apply as $value) {
                $jobid[] = $value->jobs_id;
            }
            $jobs = DB::table('jobs')->select('title')->where('employers_id',auth()->guard('employer')->user()->id)->get();
            if (count($jobs) > 0) {
                foreach ($jobs as $job) {
                    $jobtitle[] = $job->title;
                }
            } else{
                $jobtitle = [];
            }
        } else{
            $jobtitle = [];
        }
        return $jobtitle;
    }

    public static function getStatus($apply_id='')
    {
        $selected = '0';
        $process_id = '0';
        $part = '0';
        $apply = DB::table('job_apply')->where('id', $apply_id)->first();
        if (isset($apply->id)) {
            $jobstatus = JobProcess::where('jobs_id',$apply->jobs_id)->orderBy('sort_order','asc')->get();
            if (count($jobstatus) > 0) {
                foreach ($jobstatus as $key => $value) {
                    $candidates = json_decode($value->candidates);
                    if (is_array($candidates)) {
                        if (in_array($apply->employees_id, $candidates)) {
                             $status = '<span class="label label-success">Selected for '.$value->title.'</span>';
                             $selected = 1;
                             $process_id = $value->id;
                             $participated = json_decode($value->participated);
                             if (is_array($participated)) {
                                 if (in_array($apply->employees_id, $participated)) {
                                     $part = '1';
                                 }
                             }
                        }else{
                            $status = '<span class="label label-danger">Not Selected </span>';
                        }
                    }else{
                        $job = Jobs::select('deadline')->where('id',$apply->jobs_id)->first();
                        if (isset($job->deadline)) {
                            if ($job->deadline > date('Y-m-d')) {
                                $status = '<span class="label label-info">On Process</span>';
                            }else{
                                $status = '<span class="label label-primary">Shortlisting Process On Going</span>';
                            }
                        }else{
                            $status = '<span class="label label-info">On Process</span>';
                        }
                    }
                }
            } else{
                $job = Jobs::select('deadline')->where('id',$apply->jobs_id)->first();
                if (isset($job->deadline)) {
                    if ($job->deadline > date('Y-m-d')) {
                        $status = '<span class="label label-info">On Process</span>';
                    }else{
                        $status = '<span class="label label-primary">Shortlisting Process On Going</span>';
                    }
                }else{
                    $status = '<span class="label label-info">On Process</span>';
                }
            }
            $datas = ['status' => $status, 'selected' => $selected, 'process_id' => $process_id,'participated' => $part];
           
        } else{

            
        $datas = ['status' => '', 'selected' => '0', 'process_id' => $process_id,'participated' => $part];
        }

       
         return $datas;


    }
    
     public static function getApplyStatus($apply_id='')
    {
        $selected = '0';
        $process_id = '0';
        $part = '0';
        $apply = DB::table('job_apply')->where('id', $apply_id)->first();
        if (isset($apply->id)) {
            $jobstatus = JobProcess::where('jobs_id',$apply->jobs_id)->orderBy('sort_order','asc')->get();
            if (count($jobstatus) > 0) {
                foreach ($jobstatus as $key => $value) {
                    $candidates = json_decode($value->candidates);
                    if (is_array($candidates)) {
                        if (in_array($apply->employees_id, $candidates)) {
                             $status = $value->title;
                             $selected = 1;
                             $process_id = $value->id;
                             $participated = json_decode($value->participated);
                             if (is_array($participated)) {
                                 if (in_array($apply->employees_id, $participated)) {
                                     $part = '1';
                                 }
                             }
                        }else{
                            $status = 'Not Selected';
                        }
                    }else{
                        $job = Jobs::select('deadline')->where('id',$apply->jobs_id)->first();
                        if (isset($job->deadline)) {
                            if ($job->deadline > date('Y-m-d')) {
                                $status = 'On Process';
                            }else{
                                $status = 'Shortlisting Process On Going';
                            }
                        }else{
                            $status = 'On Process';
                        }
                    }
                }
            } else{
                $job = Jobs::select('deadline')->where('id',$apply->jobs_id)->first();
                if (isset($job->deadline)) {
                    if ($job->deadline > date('Y-m-d')) {
                        $status = 'On Process';
                    }else{
                        $status = 'Shortlisting Process On Going';
                    }
                }else{
                    $status = 'On Process';
                }
            }
            $datas = ['status' => $status, 'selected' => $selected, 'process_id' => $process_id,'participated' => $part];
           
        } else{

            
        $datas = ['status' => '', 'selected' => '0', 'process_id' => $process_id,'participated' => $part];
        }

       
         return $datas;


    }


    public static function getDeadline($job_id='')
    {
         $job = Jobs::select('deadline')->where('id',$job_id)->first();
         $return_data = 0;
         if (isset($job->deadline)) {
             $return_data = $job->deadline;
         }
         return $return_data;
    }

    public static function getDate($user_id,$job_id)
    {
        $date = '';
        $apply = DB::table('job_apply')->where('jobs_id',$job_id)->where('employees_id',$user_id)->first();
        if (isset($apply->apply_date)) {
            $date = $apply->apply_date;
        }
        return $date;
    }

    public static function countDocumentVerification($job_id='')
    {
        return DB::table('job_apply')->where('jobs_id',$job_id)->where('document_verification',1)->count();
    }
     public static function countWrittenExam($job_id='')
    {
        return DB::table('job_apply')->where('jobs_id',$job_id)->where('written_exam',1)->count();
    }

    public static function countGroup($job_id='')
    {
        return DB::table('job_apply')->where('jobs_id',$job_id)->where('group_discussion',1)->count();
    }

    public static function countInterview($job_id='')
    {
        return DB::table('job_apply')->where('jobs_id',$job_id)->where('final_interview',1)->count();
    }

    public static function countSelected($job_id='')
    {
        return DB::table('job_apply')->where('jobs_id',$job_id)->where('final_selection',1)->count();
    }
}
