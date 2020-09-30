<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventSponsor extends Model
{
    protected $table = 'event_sponsor';  
    protected $fillable = [
        'event_id', 'name', 'logo', 'url'
    ];

     public function Events()
    {
    	return $this->belongsTo('\App\Event');
    }
}
