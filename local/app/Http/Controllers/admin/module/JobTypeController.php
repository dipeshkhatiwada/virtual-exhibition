<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;
use App\JobType;



class JobTypeController extends Controller
{
     


    public function index()
    {
       
       $jobtype = JobType::get();
        return view('admin.module.JobType.newform')->with('jobtype',$jobtype);

    }

    public function edit($id)
    {
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
       $datas['jobtype'] = JobType::get();
       $datas['id'] = $id;
        return view('admin.module.JobType.editform')->with('data', $datas);

    }

     
     
  
   

}
