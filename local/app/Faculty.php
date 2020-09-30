<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = 'faculty';  

    protected $fillable = array('level_id', 'name');
    protected $primaryKey = 'id';

    public function EducationLevel()
    {
    	return $this->belongsTo('App\EducationLevel');
    }
    public function EmployeeEducation()
    {
        return $this->hasMany('App\EmployeeEducation');
    }

    public static function getLevelTitle($id)
    {
    	$level = DB::table('education_level')->where('id', $id)->first();
    	if (isset($level->name)) {
    		$name = $level->name;
    	}else{
    		$name = '';
    	}
    	return $name;

    }

    public static function getTitle($id)
    {
        $level = DB::table('faculty')->where('id', $id)->first();
        if (isset($level->name)) {
            $name = $level->name;
        }else{
            $name = '';
        }
        return $name;

    }

    public static function getFaculties($level_id,$faculty_id)
    {
        $faculties = DB::table('faculty')->where('level_id', $level_id)->orderBy('name', 'asc')->get();
        $data = '<option value="">Select Faculty</option>';
        foreach ($faculties as $faculty) {
            if ($faculty->id == $faculty_id) {
                $data .= '<option selected="selected" value="'.$faculty->id.'">'.$faculty->name.'</option>';
            } else {
                $data .= '<option value="'.$faculty->id.'">'.$faculty->name.'</option>';
            }
            
        }
        return $data;
    }
}
