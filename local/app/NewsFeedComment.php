<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeedComment extends Model
{
    protected $table = 'news_feed_comment';  
    protected $fillable = array('employee_id', 'newsfeed_id', 'description');
    protected $primaryKey = 'id';

    public function employee()
    {
        return $this->belongsTo('\App\Employee');
    }
}
