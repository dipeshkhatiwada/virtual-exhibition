<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\JobCategory;
use App\Employers;


class EmployerTypeController extends Controller
{
     

public function index($id,$setting)
    {

 $today = date('Y-m-d');
       $datas['title'] = $setting->title;
      $employers = Employers::select('logo','name','seo_url','id')->where('member_type',$setting->member_type)->limit($setting->per_page)->get();
      $datas['employer'] = [];
      $datas['module_id'] = $id;
    foreach ($employers as $employer) {
      $image = 'no-image.png';
       if (is_file(DIR_IMAGE.$employer->logo)) {
         $image = $employer->logo;
       }
      $datas['employer'][] = [
        'title' => $employer->name,
        'url' => url('/business/'.$employer->seo_url),
        'image' => Imagetool::mycrop($image,200,200)
        
      ];
    }
       
      // dd($datas);
      
       return view('front.module.employer_type')->with('datas', $datas);

    }
    
     
     
  
   

}
