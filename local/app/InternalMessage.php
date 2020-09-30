<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class InternalMessage extends Model
{
    protected $table = 'internal_message';  

    
    protected $primaryKey = 'id';
    protected $fillable = [
        'employers_id', 'employees_id', 'subject', 'description',  'employer_status', 'employees_status', 'from'
    ];
   
    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public function Employee()
    {
    	return $this->belongsTo('App\Employee');
    }

    public static function countEmployerUnreadMessage()
    {
    	$count =  DB::table('internal_message')->where('employers_id', auth()->guard('employer')->user()->id)->where('employer_status', 1)->where('from', 'employee')->count();
    	if ($count > 0) {
    		return '('.$count.')';
    	} else{
    		return '(0)';
    	}
    }

    public static function countEmployeeUnreadMessage()
    {
    	$count =  DB::table('internal_message')->where('employees_id', auth()->guard('employee')->user()->id)->where('employees_status', 1)->where('from', 'employer')->count();
    	if ($count > 0) {
    		return '('.$count.')';
    	} else{
    		return '(0)';
    	}
    }
}
