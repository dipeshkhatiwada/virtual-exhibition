<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityImageComment extends Model
{
    protected $table = 'share_activity_image_comment';  

    protected $fillable = array('share_activity_image_id', 'parent_id', 'comment_by', 'comment');

    
    public function ShareActivityImage()
    {
    	return $this->belongsTo('App\ShareActivityImage');
    }
    public function Likes()
    {
    	return $this->hasMany('App\ShareActivityImageCommentLike');
    }
}
