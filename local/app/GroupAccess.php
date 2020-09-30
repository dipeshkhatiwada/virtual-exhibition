<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupAccess extends Model
{
	protected $table = 'group_access';  

    

    protected $fillable = [
        'user_group_id', 'access_page', 'edit_page'
    ];
    public $timestamps = false;
    public function UserGroup()
    {
    	return $this->belongsTo('App\UserGroup');
    }
}
