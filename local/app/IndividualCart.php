<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndividualCart extends Model
{
    protected $table = 'individual_cart';
    protected $guarded = [];

    public function Employer()
    {
    	return $this->belongsTo('App\Employers');
    }

    public function Job()
    {
    	return $this->belongsTo('App\Jobs');
    }
}
