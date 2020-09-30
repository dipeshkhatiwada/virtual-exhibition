<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;



class TestsController extends Controller
{
     

public function index($id,$setting)
    {
        $datas['category'] = [];
      

      $datas['title'] = $setting->title;
      $datas['description'] = $setting->description;

      $logo = Settings::getImages()->test;
      $datas['logo'] = Imagetool::mycrop('no-image.png',60,32);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo, 120,64);
      } 

     return view('front.module.tests')->with('datas', $datas);
   
   }
}
