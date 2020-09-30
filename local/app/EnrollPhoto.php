<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollPhoto extends Model
{
    protected $table = 'enroll_photos';

    protected $fillable = ['reservation_id','title', 'image', 'description'];
}
