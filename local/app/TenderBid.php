<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderBid extends Model
{
	
    protected $table = 'tender_bid';  

    protected $fillable = array('tender_id', 'tender_item_id', 'employers_id','amount');
   
    public function tender()
    {
    	return $this->belongsTo('\App\Tender');
    }
    public function tenderItems()
    {
    	return $this->belongsTo('\App\TenderItem');
    }
    public function employers()
    {
    	return $this->belongsTo('\App\Employers');
    }
}
