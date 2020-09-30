<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoothReserve extends Model
{
    protected $table = 'enroll_booth_reservation';

    public function reservations()
    {
        return $this->belongsTo('App\EnrollReservation', 'reservation_id');
    }

    public function boothcart()
    {
        return $this->hasOne('App\IndividualEnrollCart');
    }
}
