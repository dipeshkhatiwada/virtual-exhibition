<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class EventPhoto extends Model
{
    protected $table = 'event_photo';  
    protected $fillable = [
        'event_id', 'title', 'image'
    ];

    public function Events()
    {
    	return $this->belongsTo('\App\Event');
    }
}
