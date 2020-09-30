<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Event extends Model
{
    protected $table = 'event';  
    protected $fillable = [
        'employers_id',
        'title',
        'seo_url',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'description',
        'image',
        'venue',
        'latitute',
        'longitute',
        'address',
        'video',
        'event_date',
        'status',
        'event_category_id','to_date','start_time','to_time',
        'participants_limit',
        'participants_max_limit',
        'price',
        'external_url',
        'event_type',
        'end_time',
        'ticket_type',
        'ticket_type_id'
    ];

     public function Photos()
    {
    	return $this->hasMany('\App\EventPhoto');
    }

    public function Apply()
    {
        return $this->hasMany('App\EventApply');
    }

    public function Employers()
    {
        return $this->belongsTo('App\Employers');
    }

     public function Sponsors()
    {
    	return $this->hasMany('\App\EventSponsor');
    }

    public function eventTicketType()
    {
    	return $this->hasMany('\App\TicketType');
    }

    public function EventCategory()
    {
        return $this->belongsTo('\App\EventCategory');
    }

    public function eventMeeting()
    {
        return $this->hasOne('App\EventMeeting');
    }

    public static function getTitle($id='')
    {
        $event = DB::table('event')->select('title')->where('id', $id)->first();
        if (isset($event->title)) {
            $title = $event->title;
        }else{
            $title = '';
        }
        return $title;
    } 
    public static function getOrgName($id='')
    {
        $event = DB::table('event')->select('employers_id')->where('id', $id)->first();
        if (isset($event->employers_id)) {
            $title = \App\Employers::getName($event->employers_id);
        }else{
            $title = '';
        }
        return $title;
    } 

    public static function getDate($id='')
    {
        $event = DB::table('event')->select('event_date')->where('id', $id)->first();
        if (isset($event->event_date)) {
            $event_date = $event->event_date;
        }else{
            $event_date = '';
        }
        return $event_date;
    } 

    public static function getVenue($id='')
    {
        $event = DB::table('event')->select('venue')->where('id', $id)->first();
        if (isset($event->venue)) {
            $venue = $event->venue;
        }else{
            $venue = '';
        }
        return $venue;
    }

    public function eventReservation()
    {
        return $this->hasMany('\App\EventReservation');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review', 'event_id');
    }

    public function ratings()
    {
        return $this->hasMany('App\Review', 'event_id');
    }
}
