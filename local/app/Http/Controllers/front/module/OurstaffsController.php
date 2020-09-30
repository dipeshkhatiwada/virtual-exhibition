<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Staff;




class OurstaffsController extends Controller
{
     

public function index($id,$setting)
    {
       
        $datas = [];
        $datas['title'] = $setting->title;
       $datas['id'] = $id;
        
       $staffs = Staff::orderBy('id', 'asc')->skip(0)->take($setting->per_page)->get();
       if(count($staffs) > 0) {
        $mydata = [];
        foreach ($staffs as $value) {
           if (isset($value->image)) {
               $image = Imagetool::mycrop($value->image,$setting->image_width,$setting->image_height);
           } else {
            $logo = Settings::getImages()->logo;
            $image = Imagetool::mycrop($logo,$setting->image_width,$setting->image_height);
           }
           $mydata[] = [
            'name' => $value->name,
            'designation' => $value->designation,
            'photo' => $image,
           ];
        }
       $datas['staffs'] = $mydata;
        
        return view('front.module.ourstaffs')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
