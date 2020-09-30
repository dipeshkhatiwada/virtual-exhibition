<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';  
    protected $guarded = [];

    public function invoiceItem()
    {
    	return $this->hasMany('App\InvoiceItem');
    }

    public function invoiceHistory()
    {
    	return $this->hasMany('App\InvoiceHistory');
    }

    public function employee()
    {
    	return $this->hasOne('App\Employee','id' ,'invoice_by');
    }
}
