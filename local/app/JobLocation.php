<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class JobLocation extends Model
{
     protected $table = 'job_location';  

    protected $fillable = array('name', 'seo_url');
    protected $primaryKey = 'id';
        public function EmployeeLocation()
    {
    	return $this->hasMany('App\EmployeeLocation');
    }

     public function JobsLocation()
    {
    	return $this->hasMany('App\JobsLocation');
    }

    public static function getName($id='')
    {
        $name = '';
        $location = DB::table('job_location')->where('id',$id)->first();
        if (isset($location->name)) {
            $name = $location->name;
        }
        return $name;
    }

}
