<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReferenceComment extends Model
{
	protected $table = 'reference_comment';  

    protected $fillable = array('name', 'company', 'phone', 'email', 'employee_reference_id', 'relationship', 'capacity', 'duties', 'leaving_reason', 'strengths', 'overall_work', 'weakness', 'reliability', 'punctuality', 'attendance', 'professionalism', 're_employe', 'comment');
    protected $primaryKey = 'id';


    public static function checkComment($id)
    {
    	$check = DB::table('reference_comment')->where('employee_reference_id', $id)->count();
    	if ($check > 0) {
    		return 'Commented';
    	} else{
    		return '';
    	}
    }

}
