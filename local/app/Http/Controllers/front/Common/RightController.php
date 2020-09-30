<?php

namespace App\Http\Controllers\front\common;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;

class RightController extends Controller
{
  public static function index($layout_id)
    {
        $datas = \App\Module::getModules($layout_id, 'content_right');
        $modules = array();
        foreach ($datas as $value) {
        	$cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
       		$module = new $cont();
       			$modules[] = array(
       			'module' => $module->index($value->module_id,json_decode($value->setting)),
              ); 
        		}   
        return view('front.common.contentRight')->with('datas', $modules);
    }
}
