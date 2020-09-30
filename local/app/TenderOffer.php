<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderOffer extends Model
{
    protected $table = 'tender_offer';  

    protected $fillable = array('tender_function_type_id', 'title', 'discount_percent','start_date','end_date');
    

    public function TenderFunctionType()
    
    {
    	return $this->belongsTo('App\TenderPrice');
    }
}
