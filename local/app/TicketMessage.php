<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    protected $table = 'ticket_message';  

    protected $fillable = array('employer_ticket_id', 'message', 'reply_by', 'type','attachments','rating','reply_type');
    protected $primaryKey = 'id';

    public function EmployerTicket()
    {
    	return $this->belongsTo('App\EmployerTicket');
    }
    public function MessageFiles()
    {
    	return $this->hasMany('App\TicketMessageFile');
    }
}


