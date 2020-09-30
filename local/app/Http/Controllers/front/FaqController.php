<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Menu;
use App\Layout;
use App\library\Settings;
use Carbon\Carbon;
use App\FaqCategory;
use App\Faq;

class FaqController extends Controller
{
   public function index($url, Request $request)
   {
       
       $layouts= Layout::where('layout_route', 'Faq')->first();
      if(isset($data->layout_id))
      {
        $layout_id = $data->layout_id;
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }
    
    
        $images = Settings::getImages();
        $config = array(
              'app.meta_title' => 'Faq',
              'app.meta_keyword' => 'Rolling Nexus Faq',
              'app.meta_description' => 'Rolling Nexus Faq, where you can read how to use rolling nexus',
              'app.meta_image' => asset('/image/'.$images->logo),
              'app.meta_url' => url('/faq/'.$url),
              'app.meta_type' => 'faq',
              
                );
            config($config);

        if ($url == 'individual') {
          $type = 2;
        }elseif ($url = 'business') {
          $type = 1;
        }else{
          $type = 0;
        }
        

        $datas['faqs'] = [];
        $categories = FaqCategory::orderBy('sort_order','asc')->get();
        foreach ($categories as $key => $category) {
          $questions = Faq::where('faq_category_id',$category->id)->where('type',$type)->get();
          if (count($questions) > 0) {
            $datas['faqs'][] = [
              'title' => $category->title,
              'questions' => $questions
            ];
          }
        }
      

    $main_content = \App\Module::getModules($layout_id, 'content_main');
      
        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
          $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
          $content_main = new $cont();
             $datas['main_modules'][] = array(
            'module' => $content_main->index($main->module_id,json_decode($main->setting)), ); 
            }


    $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
          $left_module = new $lcontent();
            $datas['left_content'][] = array(
            'module' => $left_module->index($left->module_id,json_decode($left->setting)),
              );  
            }
    $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
          $right_module = new $lcontent();
            $datas['right_content'][] = array(
            'module' => $right_module->index($right->module_id,json_decode($right->setting)),
              );  
            }
     $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
          $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
              );  
            }
       $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
          $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
          $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
            'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
              );  
            }
    
    return view('front.common.faq')->with('datas', $datas);

    }
}