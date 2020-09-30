<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollVideo extends Model
{
    protected $table ='enroll_videos';
    protected $fillable = ['reservation_id', 'title', 'link'];
}
