<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityImageTemp extends Model
{
    protected $table = 'share_activity_image_temp';  

    protected $fillable = array('session_id', 'image', 'title');

    
}
