<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;





class FacebookController extends Controller
{
     


    public function index($id,$setting)
    {
        
        $facebook = Settings::getSocials()->facebook;
        $datas = array('title' => $setting->title, 'href' => $facebook );
        if(!empty($facebook)){
               
        return view('front.module.facebook')->with('data', $datas);
    	}
    	else{
    		return '';
    	}

    }

   
  
   

}
