<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarketerDetail extends Model
{
    protected $table = 'marketer_detail';

    protected $fillable = ['marketer_id', 'visit_place', 'meeting_with', 'discussion_detail', 'next_visit', 'geo_location'];

    public function marketer()
    {
    	return $this->belongsTo('App\Marketer');
    }
}
