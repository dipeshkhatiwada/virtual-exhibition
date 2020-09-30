<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Testimonial;
use App\library\myFunctions;
use App\library\Settings;

use App\library\document;




class TestimonialDisplayController extends Controller
{

     


    public function index($data = array()) {
      $layouts= DB::table('layout')->where('layout_route', 'TestimonialDisplay')->first();
      if(isset($data['layout_id']))
      {
        $layout_id = $data['layout_id'];
      }
      elseif(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }
  
      if (isset($data['id'])) {
        $article= Testimonial::where('id',$data['id'])->first();

        $meta_title=$article->name;
      $meta_description= Settings::getLimitedWords($article->description,0,20);
      $meta_keyword=$article->name;

      $image_height = Settings::getImages()->image_height;
        $image_width = Settings::getImages()->image_width;
        if(isset($article->image) && $article->image != ''){
                $thumbs = Imagetool::mycrop($article->image,$image_width,$image_height);
                $image = asset($thumbs);
              } 
              else{
                $image = '';
              }
              $datas = array(
                
                'title' => $article->name,
                'description' => $article->description,
                'image' => $image,
                'published' => $article->created_at,
                'address' =>$article->address,
                'href' => $article->se_url,
                );
          $hrf = myFunctions::curPageURL();

              $module = \App\Module::getModules($layout_id, 'content_right');
              
                $modules = array();
                foreach ($module as $value) {
                  $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
                  $module = new $cont();
                    $modules[] = array(
                    'module' => $module->index($value->module_id,$value->module_title,$value->module_text,$value->c_a_ids,$value->per_page), ); 
                    }

              $controller = view('front.testimonialDisplay')->with('datas', $datas)->with('hrf', $hrf)->with('modules', $modules);
       
        
      }
      else{
        $controller = \App\Http\Controllers\front\ErrorController::index();

       return $controller;
       exit();
      }
    
		$datas = array(
      'header' => \App\Http\Controllers\front\Common\HeaderController::index($meta_title,$meta_keyword,$meta_description),
      'footer' => \App\Http\Controllers\front\Common\FooterController::index(),
      'left' => \App\Http\Controllers\front\Common\LeftController::index($layout_id),
      'right' => $controller,
      'top' => \App\Http\Controllers\front\Common\TopController::index($layout_id),
      'bottom' => \App\Http\Controllers\front\Common\BottomController::index($layout_id),
      'full' => \App\Http\Controllers\front\Common\FullwidthController::index($layout_id),
      );
    

    return view('front.common.home')->with('datas', $datas);

		
		
    

		
	}
   
  
   

}
