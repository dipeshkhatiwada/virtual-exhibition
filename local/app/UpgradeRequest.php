<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UpgradeRequest extends Model
{
    protected $table = 'upgrade_request';  

    protected $fillable = array('employers_id', 'member_type_id','status','start_date','end_date');
    protected $primaryKey = 'id';

    public static function countRequest()
    {
    	return DB::table('upgrade_request')->where('status',0)->count();
    }
    
    public static function userDetail($id='')
    {
    	$return_data = [
    		'created_at' => '',
    		'upgrade_start' => '',
    		'upgrade_end' => '',
    	];
    	$user = DB::table('employers')->select('created_at','member_type')->where('id',$id)->first();
    	if (isset($user->created_at)) {
    	    $start_date = '';
    	    $end_date = '';
    		$upgrade = DB::table('upgrade_request')->where('employers_id',$id)->where('member_type_id',$user->member_type)->where('status',1)->first();
    		if (isset($upgrade->start_date)) {
    			if ($upgrade->end_date > date('Y-m-d')) {
    				$start_date = $upgrade->start_date;
    				$end_date = $upgrade->end_date;
    			}
    		}
    		$return_data = [
	    		'created_at' => $user->created_at,
	    		'upgrade_start' => $start_date,
	    		'upgrade_end' => $end_date,
	    	];
    	}

    	return $return_data;
    }
}
