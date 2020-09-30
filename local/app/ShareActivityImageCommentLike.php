<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityImageCommentLike extends Model
{
    protected $table = 'share_activity_image_comment_like';  

    protected $fillable = array('activity_image_comment_id', 'like_by');

    
    public function ShareActivityImageComment()
    {
    	return $this->belongsTo('App\ShareActivityImageComment');
    }
}
