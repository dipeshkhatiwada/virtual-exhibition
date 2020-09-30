<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareActivityLike extends Model
{
    protected $table = 'share_activity_like';  

    protected $fillable = array('share_activity_id', 'like_by');

    
    public function ShareActivity()
    {
    	return $this->belongsTo('App\ShareActivity');
    }
   
}
