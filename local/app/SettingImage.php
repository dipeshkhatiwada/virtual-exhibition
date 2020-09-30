<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingImage extends Model
{
    protected $table = 'setting_image';  

    protected $fillable = array('setting_id', 'logo', 'icon', 'thumb_height','thumb_width', 'image_height', 'image_width', 'job', 'tender', 'training', 'test', 'project', 'event','women','able','retaired' );

    public $timestamps = false;
    public function setting()
    {
    	return $this->belongsTo('App\Setting');
    }
}
