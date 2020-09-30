<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
	protected $table = 'ticket_status';  

   
    protected $primaryKey = 'id';
    protected $fillable = ['status_date', 'open_ticket','replied','reopened','closed', 'department_id'];
}

 
