<?php

namespace App\Http\Controllers\admin\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Module;




class PopularBlogController extends Controller
{
     


    public function index()
    {
        $datas['category'][] = ['value' => '1', 'title' => 'All'];
        $datas['category'][] = ['value' => '2', 'title' => 'Women'];
        $datas['category'][] = ['value' => '3', 'title' => 'Able'];
        $datas['category'][] = ['value' => '4', 'title' => 'Retaired'];
       
        return view('admin.module.popular_blog.newform')->with('datas',$datas);

    }

    public function edit($id)
    {
        
       
       $module = Module::where('id', $id)->first();
       $datas['module_title'] = $module->title;
       $datas['module_page'] = $module->module_page;
       $datas['setting'] = json_decode($module->setting);
      
       $datas['id'] = $id;
       $datas['category'][] = ['value' => '1', 'title' => 'All'];
        $datas['category'][] = ['value' => '2', 'title' => 'Women'];
        $datas['category'][] = ['value' => '3', 'title' => 'Able'];
        $datas['category'][] = ['value' => '4', 'title' => 'Retaired'];
        return view('admin.module.popular_blog.editform')->with('data', $datas);

    }

     
     
  
   

}
