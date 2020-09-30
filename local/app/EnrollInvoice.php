<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollInvoice extends Model
{
    protected $table = 'enroll_invoice';
    protected $fillable = ['invoice_by', 'invoice_no', 'company_name','email', 'amount', 'invoice_status','payment_type'];

    public function enrollinvoiceItem()
    {
    	return $this->hasMany('App\EnrollInvoiceItem', 'invoice_id', 'id');
    }

    public function enrollinvoiceHistory()
    {
    	return $this->hasMany('App\EnrollInvoiceHistory', 'invoice_id');
    }


}
