<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table = 'invoice_item';  
    protected $guarded = [];
     
    public function invoice()
    {
    	return $this->belongsTo('App\Invoice');
    }
}
