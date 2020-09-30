<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployerFollow extends Model
{
     protected $table = 'employer_follow';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'employees_id'
    ];
   
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public function Employee()
    {
    	return $this->belongsTo('App\Employee');
    }

    public static function countFollower()
    {
    	$follower = DB::table('employer_follow')->where('employers_id', auth()->guard('employer')->user()->id)->count();
    	if ($follower > 0) {
    		return '('.$follower.')';
    	} else{
    		return '(0)';
    	}
    }

    public static function countFollows()
    {
    	$follower = DB::table('employer_follow')->where('employees_id', auth()->guard('employer')->user()->id)->count();
    	if ($follower > 0) {
    		return '('.$follower.')';
    	} else{
    		return '(0)';
    	}
    }
}
