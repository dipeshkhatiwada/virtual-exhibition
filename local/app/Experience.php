<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';  

    protected $fillable = array('name');
    protected $primaryKey = 'id';

   
    public function JobExperience()
    {
    	return $this->hasMany('App\JobExperience');
    }
    public static function getTitle($id)
    {
        $level  = DB::table('experience')->where('id', $id)->first();
        if (isset($level->name)) {
            $title = $level->name;
        } else {
            $title = '';
        }
        return $title;
    }
}
