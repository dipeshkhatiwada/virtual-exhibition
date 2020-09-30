<?php

namespace App\Http\Controllers\front\common;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;





class FullwidthController extends Controller
{
     


    public static function index($layout_id)
    {
        $datas = \App\Module::getModules($layout_id, 'full_width');
        $modules = array();
        foreach ($datas as $value) {
        	$cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
       		$module = new $cont();
       			$modules[] = array(
       			'module' => $module->index($value->module_id,json_decode($value->setting)),
              );  
        		}
               
        return view('front.common.contentFullwidth')->with('datas', $modules);
      

    }

   
  
   

}
