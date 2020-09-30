<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollInvoiceHistory extends Model
{
    protected $table = 'enroll_invoice_history';
    protected $fillable = ['invoice_id', 'invoice_status', 'notify', 'comment'];

    public function enrollinvoice()
    {
    	return $this->belongsTo('App\EnrollInvoice', 'invoice_id', 'id');
    }
}
