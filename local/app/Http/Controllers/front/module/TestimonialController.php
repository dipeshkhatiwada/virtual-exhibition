<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Testimonial;




class TestimonialController extends Controller
{
     

public function index($id,$setting)
    {
       
      

       $articles=Testimonial::where('status', 1)->orderBy('id', 'DESC')->skip(0)->take($setting->per_page)->get();
        
      
        if(count($articles) > 0){
            $mydata = array();
            $datas = [];
            $datas['title'] = $setting->title;
            $datas['id'] = $id;
            foreach ($articles as $value) {
              
               
               $mydata[] = array(
                'title' => $value->name,
                'description' => $value->description,
                'address' => $value->address,
                            
                );
            }
               $datas['mydata'] = $mydata;
        return view('front.module.testimonial')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
