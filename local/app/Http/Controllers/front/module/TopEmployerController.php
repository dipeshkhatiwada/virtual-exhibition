<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Employers;
use App\Jobs;
use Carbon\Carbon;



class TopEmployerController extends Controller
{
     

public function index($id,$setting)
    {
       
       if(count($setting->employer_id) > 0){
        $datas = [];
        $datas['title'] = $setting->title;
        $mydata = [];
    
    
        foreach ($setting->employer_id as $id) {

          $employer = Employers::where('id', $id)->first();
            if(isset($employer->name)){
            
              
               $mydata[] = array(
                'name' => $employer->name,
                'logo' => Imagetool::mycrop($employer->logo,150,150),
                'href' => $employer->seo_url,


                );
            }
        }
        $datas['employers'] = $mydata;

       
        
        return view('front.module.topemployer')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
