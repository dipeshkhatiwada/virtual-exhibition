<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;

class UserGroup extends Model
{
    protected $table = 'usergroup';  

    protected $fillable = array('group_title');
    protected $primaryKey = 'id';

    public function GroupAccess()
    {
    	return $this->hasMany('App\GroupAccess');
    }

    public static function getTitle($id)
    {
      $group = DB::table('usergroup')->where('id', $id)->first();
      if (isset($group->group_title)) {
        $title = $group->group_title;
      } else {
        $title = '';
      }
      return $title;
    }

     public static function checkPermission($page)
      {
        $group_id = Auth::user()->group_id;
        $permission = DB::table('group_access')->where('user_group_id', $group_id)->where('access_page', $page)->count();
        if($permission > 0){
          $data = 0;
        } else {
          $data = 1;
        }
        return $data;
      }
}
