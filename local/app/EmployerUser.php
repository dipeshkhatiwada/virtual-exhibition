<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class EmployerUser extends Authenticatable
{
     protected $table = 'employer_user';


    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'password', 'employers_id', 'designation', 'image', 'user_type', 'remember_token', 'status'
    ];

    public static function getName($value='')
    {
    	$name = '';
    	$user = DB::table('employer_user')->select('name')->where('id',$value)->first();
    	if (isset($user->name)) {
    		$name = $user->name;
    	}
    	return $name;
    }

    public static function getPhoto($id)
    {
        $image='no-image.png';

        $user = DB::table('employer_user')->where('id', $id)->first();
        if (isset($user->image)) {
            if (!empty($user->image)) {
                $image_file= Imagetool::mycrop($user->image, 200, 200);
            } else {
                $image_file=Imagetool::mycrop($image, 200, 200);
            }
        } else {
            $image_file=Imagetool::mycrop($image, 200, 200);
        }


        return $image_file;
    }
}
