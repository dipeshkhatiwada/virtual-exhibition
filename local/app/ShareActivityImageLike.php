<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityImageLike extends Model
{
    protected $table = 'share_activity_image_like';  

    protected $fillable = array('share_activity_image_id', 'like_by');

    
    public function ShareActivityImage()
    {
    	return $this->belongsTo('App\ShareActivityImage');
    }
}
