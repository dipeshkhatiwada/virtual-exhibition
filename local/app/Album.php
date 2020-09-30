<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Imagetool;
use App\library\Settings;

class Album extends Model
{
    protected $table = 'album';  

    protected $fillable = array('status', 'sort_order', 'se_url', 'title', 'description', 'meta_title', 'meta_keyword', 'meta_description' );

    protected $primaryKey = 'id';

    
    public function photos()
    {
    	return $this->hasMany('App\Photo');
    }
    

   public static function getTitle($id)
       {
            $album = DB::table('album')->where('id', $id)->first();
            if (isset($album->title)) {
                return $album->title;
            } else{
                return '';
            }

        
        
       }
    public static function getImage($id)
    {
        $thumb_height = Settings::getImages()->thumb_height;
        $thumb_width = Settings::getImages()->thumb_width;
        $photo = DB::table('photo')->where('album_id', $id)->orderBy('photo_id', 'desc')->first();
        if (isset($photo->image)) {
           if ($photo->image != '') {
               $image = Imagetool::mycrop($photo->image,$thumb_width,$thumb_height);
           } else{
            $image = '';
           }
        }else {
            $image = '';
        }

        return $image;
    }

}
