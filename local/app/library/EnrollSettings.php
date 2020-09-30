<?php namespace App\library;
use Illuminate\Http\Request;

class EnrollSettings{
     //Agora
    public static function livestream($slug = null)
     {

         $data['enroll'] = \App\EnrollReservation::where('seo_url', $slug)->first();
         $data['channel'] = $slug;
         return $data;
     }

     public static function videoCall($channel=null)
     {

         $datas['enroll'] = \App\EnrollReservation::where('seo_url', $channel)->first();
         $datas['set_channel'] = $channel;
         return $datas;
     }

}


?>
