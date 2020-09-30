<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollReservation extends Model
{
    protected $table = 'enroll_reservations';
    protected $fillable = ['category_id', 'employer_id', 'company_name', 'seo_url', 'company_website', 'intro_video', 'fair_detail', 'description'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function boothreserves()
    {
        return $this->hasMany('App\BoothReserve', 'reservation_id', 'id');
    }

    // public function zoomAssistants()
    // {
    //     return $this->hasMany('App\BoothAssistantZoom', 'reservation_id');
    // }

    public function photos()
    {
        return $this->hasMany('App\EnrollPhoto', 'reservation_id');
    }
    public function banners()
    {
        return $this->hasMany('App\EnrollBanner', 'reservation_id');
    }

    public function videos()
    {
        return $this->hasMany('App\EnrollVideo', 'reservation_id');
    }

    public function cart()
    {
        return $this->hasMany('App\IndividualEnrollCart', 'reservation_id', 'id');
    }

    public function viewers()
    {
        return $this->hasMany('App\EnrollViewer', 'reservation_id', 'id');
    }



}
