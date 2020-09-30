<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShareActivity;
use App\ShareActivityImage;

class ShareActivity extends Model
{
    protected $table = 'share_activity';  

    protected $fillable = array('share_by', 'share_url', 'title','parent_id','share_type');

    
    public function Images()
    {
    	return $this->hasMany('App\ShareActivityImage');
    }
    public function Comments()
    {
    	return $this->hasMany('App\ShareActivityComment')->where('parent_id',0);
    }
    public function Likes()
    {
    	return $this->hasMany('App\ShareActivityLike');
    }
}


