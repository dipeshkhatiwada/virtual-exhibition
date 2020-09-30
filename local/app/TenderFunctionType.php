<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TenderPrice;
use App\TenderOffer;
use App\TenderFunctionType;

class TenderFunctionType extends Model
{
    protected $table = 'tender_function_type';  

    protected $fillable = array('title','amount','features','type', 'discount');
    protected $primaryKey = 'id';

   

    public function TenderPrice()
    
    {
        return $this->hasMany('App\TenderPrice');
    }

    public function Offers()
    {
        return $this->hasMany('App\TenderOffer');
    }

    public static function CurrentOffers($id)
    {
        $data = ['title' => '', 'discount_percent' => '0.00'];
        $offer = TenderOffer::where('tender_function_type_id',$id)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->first();
        if (isset($offer->id)) {
            $data = ['title' => $offer->title, 'discount_percent' => $offer->discount_percent];
        }
        return $data;
    }

    public static function getTitle($id)
    {
        $member = TenderFunctionType::where('id', $id)->first();
        if (isset($member->title)) {
            # code...
            $title = $member->title;
        }else {
            $title = '';
        }

        return $title;
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
        $price = TenderPrice::where('tender_function_type_id', $id)->orderBy('no_of_post','asc')->first();

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
        $price = TenderPrice::where('tender_function_type_id', $id)->orderBy('no_of_post','asc')->first();
        if (isset($price->no_of_post)) {
            $data = $price->no_of_post;
        }
        return $data;
    }
}
