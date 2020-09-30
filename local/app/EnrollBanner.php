<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnrollBanner extends Model
{
    protected $table = 'enroll_banners';
    protected $fillable = ['reservation_id', 'title', 'image'];
}
