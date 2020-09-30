<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employers extends Authenticatable
{
	protected $table = 'employers';


    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email','color','layout', 'password', 'org_size', 'description', 'org_type', 'ownership', 'logo', 'banner', 'profile', 'member_type', 'hide_name', 'hide_logo', 'hide_address', 'approval', 'status', 'remember_token', 'seo_url', 'sort_order', 'href'
    ];

     public function EmployerHead()
    {
    	return $this->hasOne('App\EmployerHead');
    }

     public function EmployerContactPerson()
    {
    	return $this->hasOne('App\EmployerContactPerson');
    }

     public function EmployerAddress()
    {
    	return $this->hasOne('App\EmployerAddress');
    }

     public function Jobs()
    {
        return $this->hasMany('App\Jobs');
    }
    public function EmployerFollow()

    {
        return $this->hasMany('App\EmployerFollow');
    }


    public function Cart()
    {
        return $this->hasMany('App\Cart');
    }

    public function Trainings()
    {
        return $this->hasMany('App\Training');
    }

    public function Events()
    {
        return $this->hasMany('App\Event');
    }

    public function InternalMessages()
    {
        return $this->hasMany('App\InternalMessage');
    }

    public function Blogs()
    {
        return $this->hasMany('App\EmployerBlog');
    }

     public function EmployerQuestionAnswer()
    {
        return $this->hasMany('App\EmployerQuestionAnswer');
    }
    public function paymentmethods()
    {
        return $this->hasMany('App\PivotEmployerPaymentMethod',"employer_id");
    }

    public static function getStatus($id)
    {
        if ($id == 3) {
            $title = 'Pendig';
        }elseif ($id == 1) {
            $title = 'Active';
        }else {
            $title = 'Disabled';
        }
        return $title;
    }
    public static function getName($id)
    {
        $emp = DB::table('employers')->select('name')->where('id', $id)->first();
        if (isset($emp->name)) {
            $name = $emp->name;
        } else {
            $name = '';
        }
        return $name;
    }

    public static function getEmpLogo($id)
    {
        $image='no-image.png';

        $user = DB::table('employers')->select('logo')->where('id', $id)->first();
        if (isset($user->logo)) {
           $image = $user->logo;

        }


        return asset('/image/'.$image);
    }

    public static function getPhoto($id)
    {
        $image='no-image.png';

        $user = DB::table('employers')->select('logo')->where('id', $id)->first();
        if (isset($user->logo)) {

        if (is_file(DIR_IMAGE.$user->logo)) {
           $image_file= Imagetool::mycrop($user->logo, 200, 200);
        } else {
            $image_file=Imagetool::mycrop($image, 200, 200);
        }
    } else{
         $image_file=Imagetool::mycrop($image, 200, 200);
    }

        return asset($image_file);
    }

    public static function getAddress($id){
        $address = DB::table('employer_address')->where('employers_id', $id)->first();
        if (isset($address->address)) {
            return $address->address;
        }else{
            return '';
        }
    }

    public static function getType($id)
    {
        $user = DB::table('employers')->select('member_type')->where('id', $id)->first();
        if (isset($user->member_type)) {
           return $user->member_type;
        }
        else{
            return 0;
        }
    }

    public static function getLastlogin($id)
    {
        $user = DB::table('employers')->select('last_login')->where('id', $id)->first();
        if (isset($user->last_login)) {
           return $user->last_login;
        }
        else{
            return 0;
        }
    }

    public static function getUrl($id='')
    {
        $user = DB::table('employers')->select('seo_url')->where('id', $id)->first();
        if (isset($user->seo_url)) {
           return $user->seo_url;
        }
        else{
            return '';
        }
    }

    public static function getOrganizationType($id='')
    {
        $user = DB::table('employers')->select('org_type')->where('id', $id)->first();
        if (isset($user->org_type)) {
           return $user->org_type;
        }
        else{
            return '';
        }
    }


}
