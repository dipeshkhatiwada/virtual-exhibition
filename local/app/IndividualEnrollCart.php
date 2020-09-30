<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndividualEnrollCart extends Model
{
    protected $table = 'enroll_individual_cart';
    protected $fillable = ['employer_id', 'reservation_id', 'booth_id', 'booth_name', 'booth_type', 'price'];

    public function reservations()
    {
        return $this->belongsTo('App\EnrollReservation', 'reservation_id');
    }

    public function boothreserve()
    {
        return $this->belongsTo('App\BoothReserve', 'booth_id');
    }
  
}
