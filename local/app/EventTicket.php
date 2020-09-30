<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table = 'event_ticket';  
    protected $guarded = [];

    public function event()
    {
    	return $this->belongsTo('\App\Event');
    }

    public function ticketType()
    {
    	return $this->belongsTo('\App\TicketType');
    }

    public function employee()
    {
    	return $this->belongsTo('\App\Employee', 'employee_id');
    }
}
