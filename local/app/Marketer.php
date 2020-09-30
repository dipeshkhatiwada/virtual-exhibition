<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketer extends Model
{
    protected $table = 'marketer';

    protected $fillable = ['name', 'email', 'password', 'phone', 'address'];

    public function marketerDetail()
    {
    	return $this->hasMany('App\MarketerDetail');
    }
}
