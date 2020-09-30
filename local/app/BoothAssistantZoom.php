<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoothAssistantZoom extends Model
{
    protected $table = 'enroll_companies_zoom';
    protected $fillable = ['reservation_id', 'url', 'meeting_id', 'password'];


}
