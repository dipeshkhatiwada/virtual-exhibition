<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingEmail extends Model
{
    protected $table = 'setting_email';  

    protected $fillable = array('setting_id', 'protocal', 'pramater', 'host_name','username', 'password', 'smtp_port', 'encription' );

    public $timestamps = false;
    public function setting()
    {
    	return $this->belongsTo('App\Setting');
    }

    
}
