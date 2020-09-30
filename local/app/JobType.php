<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\JobType;
use App\JobPrice;
use App\JobTypeOffer;

class JobType extends Model
{
     protected $table = 'job_type';  

    protected $fillable = array('title', 'seo_url', 'icon', 'display_type', 'display', 'priority', 'placement',  'communication', 'job_alert', 'listing_recomended', 'listing_search', 'sms_alert','process_tab');
    protected $primaryKey = 'id';

     public function JobPrice()
    
    {
    	return $this->hasMany('App\JobPrice');
    }

    public function Offers()
    {
        return $this->hasMany('App\JobTypeOffer');
    }

    public static function CurrentOffers($id)
    {
        $data = ['title' => '', 'discount_percent' => '0.00'];
        $offer = JobTypeOffer::where('job_type_id',$id)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->first();
        if (isset($offer->id)) {
            $data = ['title' => $offer->title, 'discount_percent' => $offer->discount_percent];
        }
        return $data;
    }

    public static function getTitle($id)
    {
    	$member = DB::table('job_type')->where('id', $id)->first();
    	if (isset($member->title)) {
    		# code...
    		$title = $member->title;
    	}else {
    		$title = '';
    	}

    	return $title;
    }


    public static function getTypes()
    {
        $jtid = ['1','2','3'];

        $jobtype = DB::table('job_type')->whereIn('id', $jtid)->orderBy('id', 'asc')->get();
        
        return $jobtype;
    }

    public static function getIcon($id='')
    {
       $member = DB::table('job_type')->where('id', $id)->first();
        if (isset($member->icon)) {
            if (is_file(DIR_IMAGE.$member->icon)) {
                 $image = asset('/image/'.$member->icon);
                $icon = '<img src="'.$image.'">';
            }else{
                $icon = $member->title;
            }
           
        }else {
            $icon = $member->title;
        }

        return $icon;
    }

    public static function getBackground($value='')
    {
        if ($value == 1) {
            $class = 'goldbg';
        }elseif ($value == 2) {
            $class = 'silverbg';
        }elseif ($value == 3) {
            $class = 'brozebg';
        }else{
            $class = '';
        }
        return $class;
    }

    public static function getStartingPrice($id='',$offer='0.00')
    {
        $data = ['current_price' => '0.00', 'after_discount' => '0.00'];
        $price = JobPrice::where('job_type_id', $id)->orderBy('no_of_post','asc')->first();

        if (isset($price->seven_days)) {
            $offer_price = '0.00';
            if ($offer > 0) {
                $offer_price = $price->seven_days - (($price->seven_days * $offer) / 100);
            }
            $data = ['current_price' => $price->seven_days, 'after_discount' => $offer_price];
            
        }
        
        return $data;
    }

    public static function getStartingPost($id='')
    {
        $data = 0;
        $price = JobPrice::where('job_type_id', $id)->orderBy('no_of_post','asc')->first();
        if (isset($price->no_of_post)) {
            $data = $price->no_of_post;
        }
        return $data;
    }
}
