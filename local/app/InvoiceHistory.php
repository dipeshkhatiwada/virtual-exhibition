<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceHistory extends Model
{
    protected $table = 'invoice_history';  
    protected $guarded = [];
     
    public function invoice()
    {
    	return $this->belongsTo('App\Invoice');
    }
}
