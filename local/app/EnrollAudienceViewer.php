<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollAudienceViewer extends Model
{
    protected $table = 'enroll_audience_viewer';
    protected $fillable = ['channel_name', 'viewers'];
}
