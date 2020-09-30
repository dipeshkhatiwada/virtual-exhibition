<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollInvoiceItem extends Model
{
    protected $table = 'enroll_invoice_item';
    protected $fillable = ['invoice_id', 'category', 'booth_name', 'booth_type', 'type', 'amount'];

    public function enrollinvoice()
    {
    	return $this->belongsTo('App\EnrollInvoice', 'invoice_id');
    }
}
