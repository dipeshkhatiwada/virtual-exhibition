<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedNotification extends Model
{
    protected $table = 'news_feed_notification';  
    protected $fillable = array('newsfeed_id', 'employee_id', 'type', 'message');
    protected $primaryKey = 'id';

    public function employee()
    {
        return $this->belongsTo('\App\Employee');
    }
}
