<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TenderApply extends Model
{
    protected $table = 'tender_apply';  

    protected $fillable = array('tender_id', 'employers_id','apply_date');
   
    public function tender()
    {
    	return $this->belongsTo('\App\Tender');
    }
   
    public function employers()
    {
    	return $this->belongsTo('\App\Employers');
    }

    public static function countApplicant($id='')
    {
        return DB::table('tender_apply')->where('tender_id', $id)->count();
    }
}
