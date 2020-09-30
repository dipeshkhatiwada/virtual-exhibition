<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    protected $table ='layout';

    protected $fillable = ['layout_title', 'layout_route'];

     public $timestamps = false;
}
