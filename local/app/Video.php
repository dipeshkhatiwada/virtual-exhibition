<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';  

    protected $fillable = array('utube_url', 'status', 'sort_order', 'se_url', 'visited', 'image', 'title', 'description', 'meta_title', 'meta_description', 'meta_keyword' );
    protected $primaryKey = 'id';

   
    public static function getVideoImage($url)
    {
       
       $image_url = parse_url($url);
    
            $array = explode("&", $image_url['query']);
            $image= "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";

            if(!empty($image))
            {
                return $image;
            }
            else
            {
                return '';
            }
    }

    

}
