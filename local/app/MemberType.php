<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\MemberType;
use App\Employers;
use App\MemberTypeOffer;

class MemberType extends Model
{
     protected $table = 'member_type';  

    protected $fillable = array('name', 'icon','rank', 'display_type', 'position', 'priority', 'placement', 'control_panel', 'rating_feature', 'images', 'communication', 'privacy_setting', 'draft_save', 'background', 'customized_page', 'job_alert', 'listing_recomended', 'listing_search', 'sms_alert', 'auto_responder', 'app_collecting', 'app_screening', 'app_shorting', 'data_access', 'web_template', 'expert_consultation', 'no_of_employee', 'no_of_job', 'contact_period', 'service_charge', 'remarks', 'user_no', 'advertise_no', 'advertise_place','pretest', 'tender_no','cv_no','event_no','project_no','process_no','job_type', 'quarter_price', 'half_price');

    
    protected $primaryKey = 'id';

    public function Offers()
    {
        return $this->hasMany('App\MemberTypeOffer');
    }

    public static function CurrentOffers($id = '',$current_price = '0.00')
    {
        $data = ['title' => '', 'discount_percent' => '0.00', 'discount_price'];
        $offer = MemberTypeOffer::where('member_type_id',$id)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->first();
        if (isset($offer->id)) {
            $offer_price = $current_price - (($current_price * $offer->discount_percent) / 100);
            $data = ['title' => $offer->title, 'discount_percent' => $offer->discount_percent, 'discount_price' => $offer_price];
        }
        return $data;
    }

    public static function getTitle($id)
    {
        $employer = DB::table('employers')->select('member_type')->where('id', $id)->first();
      

    	$member = DB::table('member_type')->where('id', $employer->member_type)->first();
    	if (isset($member->name)) {
    		# code...
    		$title = $member->name;
    	}else {
    		$title = '';
    	}

    	return $title;
    }

    public static function getTypeTitle($id)
    {
      

        $member = DB::table('member_type')->where('id', $id)->first();
        if (isset($member->name)) {
            # code...
            $title = $member->name;
        }else {
            $title = '';
        }

        return $title;
    }
     public static function getDetail($id='')
    {
        $employer = DB::table('employers')->select('member_type')->where('id', $id)->first();
      

        return DB::table('member_type')->where('id', $employer->member_type)->first();
    }

    public static function getProcessNo()
    {
        $employer = Employers::select('member_type')->where('id', auth()->guard('employer')->user()->employers_id)->first();
       
        
        $return = 0;
        if (isset($employer->member_type)) {
            $mt = MemberType::select('process_no')->where('id',$employer->member_type)->first();
            if (isset($mt->process_no)) {
                $return = $mt->process_no;
            }
        }
        return $return;
    }
    public static function getUserNo()
    {
        $employer = Employers::select('member_type')->where('id', auth()->guard('employer')->user()->employers_id)->first();
        $member_type = 0;
        $return = 0;
        if (isset($employer->member_type)) {
            $mt = MemberType::select('user_no')->where('id',$employer->member_type)->first();
            if (isset($mt->user_no)) {
                $return = $mt->user_no;
            }
        }
        return $return;
    }

     public static function getCustomizePage()
    {
        $employer = Employers::select('member_type')->where('id', auth()->guard('employer')->user()->employers_id)->first();
        $member_type = 0;
        $return = 0;
        if (isset($employer->member_type)) {
            $mt = MemberType::select('customized_page')->where('id',$employer->member_type)->first();
            if (isset($mt->customized_page)) {
                $return = $mt->customized_page;
            }
        }
        return $return;
    }

    
}
