<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';  

    protected $fillable = array('meta_keyword', 'meta_description', 'email', 'item_perpage', 'description_limit', 'latitude', 'longitude', 'google_analytics', 'meta_title', 'name', 'telephone', 'fax', 'address' );
    protected $primaryKey = 'id';
    
    
   
    public function settingEmail()
    {
    	return $this->hasOne('App\SettingEmail');
    }
    public function settingImage()
    {
    	return $this->hasOne('App\SettingImage');
    }
    public function settingSocial()
    {
    	return $this->hasOne('App\SettingSocial');
    }
}
