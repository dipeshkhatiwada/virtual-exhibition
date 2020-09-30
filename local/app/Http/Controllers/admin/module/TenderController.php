<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;




class TenderController extends Controller
{
     


    public function index()
    {
       
       $datas['design'][] = ['value' => 1, 'title' => 'Grid'];
       $datas['design'][] = ['value' => 2, 'title' => 'List'];
        return view('admin.module.tender.newform')->with('datas', $datas);

    }

    public function edit($id)
    {
        
       
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
       $datas['design'][] = ['value' => 1, 'title' => 'Grid'];
       $datas['design'][] = ['value' => 2, 'title' => 'List'];
       $datas['id'] = $id;
      
        return view('admin.module.tender.editform')->with('data', $datas);

    }

     
     
  
   

}
