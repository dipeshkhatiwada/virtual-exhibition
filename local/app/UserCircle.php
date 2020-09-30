<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmployeeSkills;

use App\EmployeeExperience;
use App\EmployeeEducation;
use App\EmployeeTraining;

class UserCircle extends Model
{
    protected $table = 'user_circle';  

    protected $fillable = array('staff_id', 'user_id', 'status');
    protected $primaryKey = 'id';

    public static function checkCircle($staff_id='',$user_id='')
    {
    	
    	return UserCircle::where('staff_id',$staff_id)->where('user_id',$user_id)->count();
    	
    }

    public static function checkFriend($user_id='')
    {
    	return UserCircle::where('staff_id',auth()->guard('employee')->user()->id)->where('user_id',$user_id)->where('status',1)->count();
    }
    
     public static function checkAlumni($id='')
    {
        $experience = EmployeeExperience::where('employees_id', auth()->guard('employee')->user()->id)
                   
                  ->groupBy('employers_id')->pluck('employers_id')->toArray();
        $check = EmployeeExperience::where('employees_id',$id)->whereIn('employers_id',$experience)->count();
        if ($check > 0) {
            return TRUE;
            exit();
        }
        $education = EmployeeEducation::where('employees_id', auth()->guard('employee')->user()->id)
                   
                  ->groupBy('employers_id')->pluck('employers_id')->toArray();
        $check = EmployeeEducation::where('employees_id',$id)->whereIn('employers_id',$education)->count();
        if ($check > 0) {
            return TRUE;
            exit();
        }
        $training = EmployeeTraining::where('employees_id', auth()->guard('employee')->user()->id)
                   
                  ->groupBy('employers_id')->pluck('employers_id')->toArray();
        $check = EmployeeTraining::where('employees_id',$id)->whereIn('employers_id',$training)->count();
        if ($check > 0) {
            return TRUE;
            exit();
        }
        return FALSE;
    }

    public static function checkEndorse($skill_id='')
    {
    	$return_data = 1;
    	$skill = EmployeeSkills::where('id',$skill_id)->first();
    	if (isset($skill->id)) {
    		$endorsed = json_decode($skill->endorsed);
    		if (is_array($endorsed)) {
    			if (in_array(auth()->guard('employee')->user()->id, $endorsed)) {
    				$return_data = 0;
    			}
    		}
    	}
    	return $return_data;
	}
	public function user_circle()
	{
		return $this->belongsTo('\App\Employee','user_id');
	}
	public function staff_circle()
	{
		return $this->belongsTo('\App\Employee','staff_id');
	}
	public function user_address()
	{
		return $this->belongsTo('\App\EmployeeAddress','user_id');
	}


}
