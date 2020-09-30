<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\RecruitmentProcess;
use App\JobRequirements;

class Jobs extends Model
{
    protected $table = 'jobs';  

    protected $fillable = array('title', 'employers_id', 'category_id', 'org_type_id', 'job_type', 'page', 'job_level', 'job_availability', 'deadline', 'job_location', 'min_experience', 'education_level', 'faculty', 'position', 'vacancy_code', 'external_link', 'gender', 'salary_unit', 'negotiable', 'minimum_salary', 'min_age', 'emax_age','fmax_age','vacancy_source', 'status', 'seo_url', 'setting', 'apply_type', 'emails', 'formfields', 'education_levels', 'emanual', 'process_status', 'publish_date', 'assignment_handeler', 'job_file', 'advertise_link', 'image', 'line_manager');

    public function Employers()
    {
    	return $this->hasMany('App\Employers');
    }
     public function JobsLocation()
    {
    	return $this->hasMany('App\JobsLocation');
    }
     public function JobProcess()
    {
        return $this->hasMany('App\JobProcess');
    }
     public function JobApply()
    {
        return $this->hasMany('App\JobApply');
    }
     public function JobView()
    {
        return $this->hasMany('App\JobView');
    }
    public function JobsRequirements()
    {
        return $this->hasOne('App\JobRequirements');
    }
    public function JobLocation()
    {
        return $this->belongsTo('App\JobLocation');
    }
    public function JobForm()
    {
        return $this->hasMany('App\JobForm');
    }

    public function SavedJob()
    {
        return $this->hasMany('App\SavedJob');
    }

     public function Cart()
    {
        return $this->hasMany('App\Cart');
    }

    public function WrittenExam()
    {
        return $this->hasMany('App\WrittenExam');
    }
    public function GroupDiscussion()
    {
        return $this->hasMany('App\GroupDiscussion');
    }
    public function FinalInterview()
    {
        return $this->hasMany('App\FinalInterview');
    }
    public function SelectedCandidates()
    {
        return $this->hasMany('App\SelectedCandidates');
    }
    public function ExamSyllabus()
    {
        return $this->hasMany('App\ExamSyllabus');
    }
    
    public function JobEducations()
    {
        return $this->hasMany('App\JobEducation');
    }
    
    public function JobExperiences()
    {
        return $this->hasMany('App\JobExperience');
    }


    

    

    public static function getTitle($id)
    {
        $job = DB::table('jobs')->select('title')->where('id', $id)->first();
        if (isset($job->title)) {
            $title = $job->title;
        } else {
            $title = '';
        }
        return $title;
    }

     public static function getCode($id)
    {
        $job = DB::table('jobs')->select('vacancy_code')->where('id', $id)->first();
        if (isset($job->vacancy_code)) {
            $vacancy_code = $job->vacancy_code;
        } else {
            $vacancy_code = '';
        }
        return $vacancy_code;
    }

    public static function getOrgName($id='')
    {
         $job = DB::table('jobs')->select('employers_id')->where('id', $id)->first();
        if (isset($job->employers_id)) {
            $title = \App\Employers::getName($job->employers_id);
        } else {
            $title = '';
        }
        return $title;
    }

    public static function countApplication($id)
    {
        $application =  DB::table('job_apply')->where('jobs_id', $id)->pluck('employees_id')->toArray();
        $apps = array_unique($application);
        return count($apps);
        
    }

    public static function countView($id)
    {
        return  DB::table('job_view')->where('jobs_id', $id)->count();
        
    }

    public static function getProcessTitle($id='')
    {
        $job = DB::table('jobs')->select('process_status')->where('id',$id)->first();
        $return = '';
        if (isset($job->process_status)) {
            $return = RecruitmentProcess::getTitle($job->process_status);
        }
        return $return;
    }

    public static function getProcessDetail($id='')
    {
        $job = JobRequirements::select('detail')->where('jobs_id',$id)->first();
        $return = '';
        if (isset($job->detail)) {
            $return = $job->detail;
        }
        return $return;
    }

}
