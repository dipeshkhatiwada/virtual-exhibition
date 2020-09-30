<?php

namespace App\Http\Controllers\front\common;

use App\Http\Controllers\Controller;
use App\library\settings;
use App\Setting;
use App\Imagetool;



class FooterController extends Controller
{
     


    public static function index()
    {

    	$setting = Setting::orderBy('id', 'desc')->first();
    	$image = $setting->SettingImage;
      if (is_file(DIR_IMAGE . $image->icon)) {
      $icon = Imagetool::mycrop($image->icon, 200,200);
    } else {
      $icon = '';
    }
          
          $name=Settings::getSettings()->name;
          $analytic = Settings::getSettings()->google_analytics;
       
         $socials =Settings::getSocials();
               
        return view('front.common.footer')->with('settings', $setting)->with('analytic', $analytic)->with('socials', $socials)->with('icon', $icon)->with('name', $name);
    }
   

    

   
  
   

}
