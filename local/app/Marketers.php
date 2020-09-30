<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Marketers extends Authenticatable
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
protected $table = 'marketer';
   protected $fillable = ['name', 'email', 'password', 'phone', 'address'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}