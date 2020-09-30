<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareUrl extends Model
{
    protected $table = 'share_url';  

    protected $fillable = array('title', 'description', 'image', 'video', 'url');

    public static function getPublically($value='')
    {
    	$data = '';
    	if ($value == 1) {
    		$data = 'Public';
    	}elseif ($value == 2) {
    		$data = 'Circle Only';
    	}elseif ($value == 3) {
    		$data = 'Private';
    	}
    	return $data;
    }
}
