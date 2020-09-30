<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    protected $table = 'news_feed';  
    protected $fillable = array('employee_id', 'description', 'image');
    protected $primaryKey = 'id';

    public function employee()
    {
        return $this->belongsTo('\App\Employee');
    }
    
}