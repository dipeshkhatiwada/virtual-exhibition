<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class Counter extends Model
{
    protected $table = 'counter';

     protected $fillable = ['job_id', 'ipaddress','visits','visit_date'];

    public static function getCount($id)
    {

    	$a = Counter::where('job_id',$id)->get();
    	$count = count($a);
    	if($count == 0){
    		$count = 0;
    	}
    	else{
    		$count = $count;
    	}
    	return $count;
    }

        public static function getTodayscount($id)
    {

        $date = Carbon::now()->toDateString(); // Create date however you want
        $abc = Counter::where('job_id',$id)->whereDate('created_at', '>=', $date)->count();
        return $abc;
    }
}
