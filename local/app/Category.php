<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];
    protected $table = 'enroll_categories';

    public function enroll()
    {
        return $this->belongsTo('App\Enroll');
    }

    public function boothreservation()
    {
        return $this->hasMany('App\EnrollReservation');
    }

}
