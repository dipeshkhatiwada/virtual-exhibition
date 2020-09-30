<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollEmployerStream extends Model
{
    protected $table = 'enroll_employer_stream';
    protected $fillable = ['employer_id', 'reservation_id', 'employee_id', 'channel', 'total_count', 'active_user', 'type', 'counter', 'camera_profile', 'start_time', 'end_time'];
}
