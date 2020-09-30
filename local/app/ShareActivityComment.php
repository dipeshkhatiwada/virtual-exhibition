<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityComment extends Model
{
    protected $table = 'share_activity_comment';  

    protected $fillable = array('share_activity_id', 'parent_id', 'comment_by', 'comment');

    
    public function ShareActivity()
    {
    	return $this->belongsTo('App\ShareActivity');
    }
    public function Likes()
    {
    	return $this->hasMany('App\ShareActivityCommentLike')->pluck('like_by')->toArray();
    }
}
