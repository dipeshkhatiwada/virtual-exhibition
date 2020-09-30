<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Booth extends Model
{
    protected $fillable = ['title'];
    protected $table = 'enroll_booths';

    public function ticketTypes()
    {
        return $this->hasMany("App\BoothTicketType", 'booth_id', 'id');
    }

}
