<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;



class AdvertiseController extends Controller
{
     


    public function index()
    {
       $image='catalog/back.png';
        $image_file=Imagetool::mycrop($image, 50, 50);    
      
        return view('admin.module.advertise.newform')->with('image', $image_file);

    }

    public function edit($id)
    {
         $module = Module::where('id', $id)->first();

         $image='catalog/back.png';
        $datas['placeholder'] =Imagetool::mycrop($image, 50, 50); 
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $setting = json_decode($module->setting);
       $datas['setting'] = $setting;
       $datas['advertises'] = [];
       foreach ($setting->advertise as $value) {
         if ($value->image != '') {
           $datas['advertises'][] = [
            'title' => $value->title,
            'url_link' => $value->url_link,
            'image' => Imagetool::mycrop($value->image,100,100),
            'image_value' => $value->image,
           ];
         }
       }

       $datas['id'] = $id;

      
        return view('admin.module.advertise.editform')->with('data', $datas);

    }

     
     
  
   

}
