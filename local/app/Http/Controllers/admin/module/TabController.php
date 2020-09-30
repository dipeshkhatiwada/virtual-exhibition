<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;



class TabController extends Controller
{
     


    public function index()
    {
       
      $datas['tab'][] = ['value' => 1, 'title' => 'Jobs by Function'];
      $datas['tab'][] = ['value' => 2, 'title' => 'Jobs by Industry'];
      $datas['tab'][] = ['value' => 3, 'title' => 'Jobs by Location'];
        return view('admin.module.Tab.newform')->with('datas', $datas);

    }

    public function edit($id)
    {
         $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
      $datas['tab'][] = ['value' => 1, 'title' => 'Jobs by Function'];
      $datas['tab'][] = ['value' => 2, 'title' => 'Jobs by Industry'];
      $datas['tab'][] = ['value' => 3, 'title' => 'Jobs by Location'];
       $datas['id'] = $id;
        return view('admin.module.Tab.editform')->with('data', $datas);

    }

     
     
  
   

}
