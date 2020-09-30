<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityCommentLike extends Model
{
    protected $table = 'share_activity_comment_like';  

    protected $fillable = array('share_activity_comment_id', 'like_by');

    
    public function ShareActivityComment()
    {
    	return $this->belongsTo('App\ShareActivityComment');
    }
}
