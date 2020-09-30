<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TenderItem extends Model
{
    protected $table = 'tender_item';  

    protected $fillable = array('tender_id', 'title', 'quantity','perunit','amount');

    public function tender()
    {
    	return $this->belongsTo('\App\Tender');
    }

    public static function getName($id='')
    {
    	$item = DB::table('tender_item')->where('id', $id)->first();
    	if (isset($item->title)) {
    		return $item->title;
    	}else{
    		return '';
    	}
    }

    public static function getQuantity($id='')
    {
    	$item = DB::table('tender_item')->where('id', $id)->first();
    	if (isset($item->quantity)) {
    		return $item->quantity;
    	}else{
    		return '';
    	}
    }

    public static function getPrice($id='')
    {
    	$item = DB::table('tender_item')->where('id', $id)->first();
    	if (isset($item->perunit)) {
    		return $item->perunit;
    	}else{
    		return '';
    	}
    }
}
