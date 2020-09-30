<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedLike extends Model
{
    protected $table = 'news_feed_like';  
    protected $fillable = array('employee_id', 'newsfeed_id', 'type');
    protected $primaryKey = 'id';

    public function employee()
    {
        return $this->belongsTo('\App\Employee');
    }
    public static function checkPostLikeOrNot($newsfeedId)
    {
        return NewsFeedLike::where('newsfeed_id', $newsfeedId)->where('employee_id', auth()->guard('employee')->user()->id)->first();
    }
}
