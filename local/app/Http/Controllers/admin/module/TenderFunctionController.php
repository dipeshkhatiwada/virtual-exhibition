<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;
use App\TenderFunctionType;



class TenderFunctionController extends Controller
{
     


    public function index()
    {
       $datas['tenderfunction'] = TenderFunctionType::orderBy('amount','asc')->get();
       
       $datas['design'][] = ['value' => 1, 'title' => 'Grid'];
       $datas['design'][] = ['value' => 2, 'title' => 'List'];
        return view('admin.module.tenderfunction.newform')->with('datas',$datas);

    }

    public function edit($id)
    {
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
       $datas['tenderfunction'] = TenderFunctionType::orderBy('amount','asc')->get();
       $datas['design'][] = ['value' => 1, 'title' => 'Grid'];
       $datas['design'][] = ['value' => 2, 'title' => 'List']; 
       $datas['id'] = $id;
        return view('admin.module.tenderfunction.editform')->with('data', $datas);

    }

     
     
  
   

}
