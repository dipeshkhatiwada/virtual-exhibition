<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;




class HtmltextController extends Controller
{
     

public function index($id,$setting)
    {
       
        
       
        $datas = array('title' => $setting->title, 'text' => $setting->description );
       
        if(!empty($setting->description)){
               
        return view('front.module.Htmltext')->with('data', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
