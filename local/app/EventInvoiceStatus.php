<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventInvoiceStatus extends Model
{
    protected $table = 'event_invoice_status';
    protected $guarded = [];

    public function events()
    {
    	return $this->belongsTo('\App\Event');
    }

    public function employee()
    {
    	return $this->belongsToMany('\App\Employee');
    }
}
