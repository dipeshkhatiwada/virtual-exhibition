<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoothTicketType extends Model
{
    protected $table = 'enroll_booth_prices';
    protected $fillable = ['booth_id', 'ticket_name', 'price' ];
    public function booth()
    {
        return $this->belongsTo("App\Booth", 'booth_id');
    }

}
