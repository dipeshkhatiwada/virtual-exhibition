<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EducationLevel extends Model
{
     protected $table = 'education_level';  

    protected $fillable = array('name');
    protected $primaryKey = 'id';

    public function Faculties()
    {
    	return $this->hasMany('App\Faculty');
    }
    public function EmployeeEducation()
    {
    	return $this->hasMany('App\EmployeeEducation');
    }

    public static function getTitle($id)
    {
        $level  = DB::table('education_level')->where('id', $id)->first();
        if (isset($level->name)) {
            $title = $level->name;
        } else {
            $title = '';
        }
        return $title;
    }
}
