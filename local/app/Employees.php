<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Imagetool;
use DB;
use App\Employees;

class Employees extends Model
{
    protected $table = 'employees';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'saluation', 'email', 'jobs_id', 'firstname', 'middlename', 'lastname', 'gender', 'points', 'dob', 'marital_status', 'nationality', 'image', 'resume', 'coverletter', 'status', 'remember_token', 'permanent_address', 'temporary_address', 'home_phone', 'mobile', 'fax', 'website', 'vehicle', 'license_of', 'validation_token','written_exam', 'group_discussion', 'final_interview', 'final_selection','age', 'total_experience', 'present_salary', 'expected_salary'
    ];
    
    public function isOnline()
        {
            return \Cache::has('user-is-online-' . $this->id);
        }
    public static function CheckOnline($id)
        {
            return \Cache::has('user-is-online-' . $id);
        }

     
    public function Jobs()
    {
        return $this->belongsTo('App\Jobs');
    }

    public function InternalMessages()
    {
        return $this->hasMany('App\InternalMessage');
    }

     public function EmployeeEducation()
    
    {
    	return $this->hasMany('App\EmployeeEducation');
    }

     public function JobApply()
    
    {
        return $this->hasMany('App\JobApply');
    }

    public function EmployeeFingertest()
    
    {
        return $this->hasMany('App\EmployeeFingertest');
    }

     public function SavedJob()
    
    {
        return $this->hasMany('App\SavedJob');
    }
    public function EmployerFollow()
    
    {
        return $this->hasMany('App\EmployerFollow');
    }

     public function EmployeeExperience()
    {
    	return $this->hasMany('App\EmployeeExperience');
    }


     public function EmployeeLanguage()
    {
    	return $this->hasMany('App\EmployeeLanguage');
    }

     
     public function EmployeeTraining()
    {
        return $this->hasMany('App\EmployeeTraining');
    }

     public function EmployeeReference()
    {
    	return $this->hasMany('App\EmployeeReference');
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
    public function EmployeeSetting()
    {
        return $this->hasOne('App\EmployeeSetting');
    }

    public function EmployeeAddress()
    {
        return $this->hasOne('App\EmployeeAddress');
    }

    public function EmployeeCategory()
    {
        return $this->hasMany('App\EmployeeCategory');
    }

     public function EmployeeLocation()
    {
        return $this->hasMany('App\EmployeeLocation');
    }

    public function EmployeeOrganization()
    {
        return $this->hasMany('App\EmployeeOrganization');
    }

     public function EmployeeFiles()
    {
        return $this->hasMany('App\EmployeeFiles');
    }

    public function Apply()
    {
        return $this->hasMany('App\Apply');
    }

    public function ProjectApply()
    {
        return $this->hasMany('App\ProjectApply');
    }

    public function rating()
    {
        return $this->hasMany('App\EmployeeRating');
    }

     public function Skills()
    {
        return $this->hasMany('App\EmployeeSkills');
    }
    
    public static function getEmail($value='')
    {
        $email = '';
        $emp = Employees::select('email')->where('id', $value)->first();
        if (isset($emp->email)) {
           $email = $emp->email;
        }
        return $email;
    }


    public static function getStatus($id)
    {
        if ($id == 3) {
            $title = 'Pendig';
        }elseif ($id == 1) {
            $title = 'Active';
        }else {
            $title = 'Disabled';
        }
        return $title;
    }
    public static function getFirstName($id='')
    {
        $name = '';
        $emp = $user = DB::table('employees')->select('firstname')->where('id', $id)->first();
        if (isset($emp->firstname)) {
            $name = $emp->firstname;
        }
        return $name;

    }


    public static function getFullname($firstname, $middlename, $lastname)
    {
        if ($middlename == '') {
            $fullname = ucfirst($firstname).' '.ucfirst($lastname);
        }else{
            $fullname = ucfirst($firstname).' '.ucfirst($middlename).' '.$lastname;
        }
        return $fullname;
    }
    public static function getFullnames($sa,$firstname, $middlename, $lastname)
    {   
        if ($middlename == '') {
            $fullname = $sa.' '.ucfirst($firstname).' '.ucfirst($lastname);
        }else{
            $fullname =  $sa.' '.ucfirst($firstname).' '.ucfirst($middlename).' '.$lastname;
        }
        return $fullname;
    }

    public static function getPhoto($id)
    {
        $image='no-image.png';
        
        $user = DB::table('employees')->where('id', $id)->first();
        if (isset($user->image)) {
            if (!empty($user->image)) {
                $image_file= Imagetool::mycrop($user->image, 200, 200); 
            } else {
                $image_file=Imagetool::mycrop($image, 200, 200); 
            }
        } else {
            $image_file=Imagetool::mycrop($image, 200, 200); 
        }


        return $image_file;
    }

    public static function getName($id)
    {
       
        
        $user = DB::table('employees')->where('id', $id)->first();
        if (isset($user->id)) {

             if ($user->middlename == '') {
                    $fullname = ucfirst($user->firstname).' '.ucfirst($user->lastname);
                }else{
                    $fullname = ucfirst($user->firstname).' '.ucfirst($user->middlename).' '.$user->lastname;
                }
           
        } else {
            $fullname = '';
        }
        return $fullname;
    }

     public static function countApplication($id)
    {
        return  DB::table('job_apply')->where('jobs_id', $id)->count();
        
    }
}
