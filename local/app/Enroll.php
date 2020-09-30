<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    protected $fillable = ['title'];
    protected $table ='enrolls';

    public function categories()
    {
        return $this->hasMany('App\Category', 'enroll_id');
    }

}
