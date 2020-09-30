<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventReservation extends Model
{
    protected $table = 'event_reservation';  
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
