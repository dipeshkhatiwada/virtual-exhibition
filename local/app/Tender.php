<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\TenderApply;

class Tender extends Model
{
    protected $table = 'tender';  

    protected $fillable = array('employers_id', 'tender_type_id', 'title', 'tender_code', 'description', 'pree_bid_meeting', 'meeting_mode', 'meeting_location', 'document_download', 'estimate_cost', 'completion_period','event_for','biding_access','bid_withdrawal','document_fee','emd','participation_fee','project_location','contract_type','submission_mode','auction_mode','tender_function','bdding_type','bid_evaluation','download_start_date','download_end_date','submission_start_date','submission_end_date','posted_by','technical_officer','procruitment_officer','status','publish_date','image','seo_url');

    public function employees()
    {
    	return $this->belongsTo('\App\Employees');
    }

    public function tenderType()
    {
    	return $this->belongsTo('\App\TenderType');
    }

    public function tenderDocuments()
    {
    	return $this->hasMany('\App\TenderDocument');
    }
    public function tenderItems()
    {
    	return $this->hasMany('\App\TenderItem');
    }
    public function tenderForms()
    {
    	return $this->hasMany('\App\TenderForm');
    }

    public function tenderApply()
    {
        return $this->hasMany('\App\TenderApply');
    }
    
    public static function tenderApplyIds($id)
    {
        return TenderApply::where('tender_id',$id)->pluck('employers_id')->toArray();
    }

    public static function getTitle($id='')
    {
        $title = '';
        $tender = DB::table('tender')->select('title')->where('id',$id)->first();
        if (isset($tender->title)) {
            $title = $tender->title;
        }
        return $title;
    }
}
