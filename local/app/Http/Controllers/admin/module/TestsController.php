<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;




class TestsController extends Controller
{
     


    public function index()
    {
       
      
        return view('admin.module.test.newform');

    }

    public function edit($id)
    {
        
       
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
      
       $datas['id'] = $id;
      
        return view('admin.module.test.editform')->with('data', $datas);

    }

     
     
  
   

}
