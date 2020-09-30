<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;
use App\MemberType;



class EmployerTypeController extends Controller
{
     


    public function index()
    {
       
       $datas['member_type'] = MemberType::select('id','name')->orderBy('id','asc')->get();
        return view('admin.module.employer_type.newform')->with('datas',$datas);

    }

    public function edit($id)
    {
        
       
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);

       $datas['id'] = $id;
       $datas['member_type'] = MemberType::select('id','name')->orderBy('id','asc')->get();
      
        return view('admin.module.employer_type.editform')->with('data', $datas);

    }

     
     
  
   

}
