<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingSocial extends Model
{
    protected $table = 'setting_social';  

    protected $fillable = array('setting_id', 'facebook', 'twitter', 'gplus','youtube', 'linkedin', 'smtp_port' );

    public $timestamps = false;
    public function setting()
    {
    	return $this->belongsTo('App\Setting');
    }
}
