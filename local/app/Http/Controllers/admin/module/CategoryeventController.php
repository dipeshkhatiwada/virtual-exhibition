<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;
use App\EventCategory;



class CategoryeventController extends Controller
{
     


    public function index()
    {
       $categories = EventCategory::orderBy('title', 'asc')->get();
       
        return view('admin.module.event.event_category_new')->with('categories', $categories);

    }

    public function edit($id)
    {
        
       
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
       $datas['categories'] = EventCategory::orderBy('title', 'asc')->get();
       $datas['id'] = $id;
      
        return view('admin.module.event.event_category_edit')->with('data', $datas);

    }

     
     
  
   

}
