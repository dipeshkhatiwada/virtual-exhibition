<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenderPrice extends Model
{
    protected $table = 'tender_price';  

    protected $fillable = array('tender_function_type_id', 'no_of_post', 'seven_days', 'fifteen_days', 'thirty_days');
    protected $primaryKey = 'id';

    public function TenderFunctionType()
    
    {
    	return $this->belongsTo('App\TenderPrice');
    }
}
