<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollGroupVideoChannel extends Model
{
    protected $table = 'enroll_group_video_channel';
    protected $fillable = ['reservation_id', 'available_channel', 'start_time', 'end_time'];
}
