<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;
use App\Imagetool;





class AdvertiseController extends Controller
{
     


    public function index($id,$setting)
    {
        
       if(count($setting->advertise) > 0 ){
        $datas['advertise'] = [];
        foreach ($setting->advertise as $value) {
         if ($value->image != '') {
           $datas['advertise'][] = [
            'title' => $value->title,
            'url_link' => $value->url_link,
            'image' => 'image/'.$value->image,
            
           ];
         }
       }
       if ($setting->column_no == 1) {
          $datas['class'] = 'col-lg-12 col-md-12 col-sm-12 col-sx-12';
       } else{
            $datas['class'] = 'col-lg-6 col-md-6 col-sm-6 col-sx-12';
       }
       if (count($datas['advertise']) > 0) {
           return view('front.module.advertise')->with('data', $datas);
       } else{
        return '';
       }
               
        
    	}
    	else{
    		return '';
    	}

    }

   
  
   

}
