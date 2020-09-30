<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photo';  

    protected $fillable = array('album_id', 'image', 'description' );

    
    public function album()
    {
    	return $this->belongsTo('App\Album');
    }
}
