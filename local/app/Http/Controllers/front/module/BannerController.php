<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;
use App\JobCategory;
use App\JobLocation;





class BannerController extends Controller
{
     


    public function index($id,$setting)
    {
        $category = JobCategory::orderBy('name', 'asc')->get();
        $location = JobLocation::orderBy('name', 'asc')->get();
       
        $datas = array('title' => $setting->title, 'category' => $category, 'location' => $location );
       
               
        return view('front.module.banner')->with('data', $datas);
    	

    }

   
  
   

}
