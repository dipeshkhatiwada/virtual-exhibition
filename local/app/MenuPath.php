<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPath extends Model
{
    protected $table = 'menu_path';  

    protected $fillable = array('menu_id', 'path_id', 'level');

    public $timestamps = false;
    public function menu()
    {
    	return $this->belongsTo('App\Menu');
    }

     
}
