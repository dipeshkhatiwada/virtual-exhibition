<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityImage extends Model
{
    protected $table = 'share_activity_image';  

    protected $fillable = array('share_activity_id', 'image', 'title');

    public $timestamps = false;
    public function ShareActivity()
    {
    	return $this->belongsTo('App\ShareActivity');
    }
    public function Comments()
    {
    	return $this->hasMany('App\ShareActivityImageComment')->where('parent_id',0);
    }
    public function Likes()
    {
    	return $this->hasMany('App\ShareActivityLike');
    }
}


