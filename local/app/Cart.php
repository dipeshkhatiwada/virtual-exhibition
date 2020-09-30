<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cart extends Model
{
    protected $table = 'cart';  

    protected $fillable = array('jobs_id', 'employers_id','job_type', 'job_type_id', 'amount', 'duration', 'type', 'number_of','remaining');

    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }

    public static function countItems()
    {
        return DB::table('cart')->where('employers_id', auth()->guard('employer')->user()->employers_id)->count();
    }

}
