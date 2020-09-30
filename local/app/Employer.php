<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Employer extends Authenticatable
{
   

    protected $table = 'employers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'org_size', 'description', 'org_type', 'ownership', 'logo', 'banner', 'profile', 'member_type', 'setting', 'approval', 'status', 'seo_url', 'remember_token', 'sort_order'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}