<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Video;
use App\library\myFunctions;
use App\library\Settings;

use App\library\document;
use App\Layout;



class VideoDisplayController extends Controller
{

     


    public function index($data) {
      $layouts= Layout::where('layout_route', 'AlbumGallery')->first();
      
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
      $video = Video::where('se_url', $data)->first();
      if (isset($video->id)) {
        $bcum = 'Video  »  '.$video->title;
        Video::where('id', $video->id)->update(['visited' => $video->visited + 1]);

          $config = array(
              'app.meta_title' => $video->meta_title,
              'app.meta_keyword' => $video->meta_keyword,
              'app.meta_description' => $video->meta_description,
              'app.meta_image' => $video->image,
              'app.meta_url' => url('video/'.$video->se_url),
              'app.meta_type' => 'Video',
              
                );
            config($config);
       
              $module = \App\Module::getModules($layout_id, 'content_main');
              
                $modules = array();
                foreach ($module as $value) {
                  $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
                  $module = new $cont();
                    $modules[] = array(
                    'module' => $module->index($value->module_id,json_decode($value->setting)), ); 
                    }

              $controller = view('front.Video')->with('video', $video)->with('modules', $modules);
       // $controller = \App\Http\Controllers\front\ArticleController::index($data['id'], $layout_id);
        
      }
      else{
        $controller = \App\Http\Controllers\front\ErrorController::index();

       return $controller;
       exit();
      }
    
		
        $banner = '/image/inner-banner.jpg';
      
      
     $datas = array(
      'header' => \App\Http\Controllers\front\Common\HeaderController::index(),
      'footer' => \App\Http\Controllers\front\Common\FooterController::index(),
      'main' => $controller,
      'left' => \App\Http\Controllers\front\Common\RightController::index($layout_id),
      'right' => \App\Http\Controllers\front\Common\RightController::index($layout_id),
      'top' => \App\Http\Controllers\front\Common\TopController::index($layout_id),
      'bottom' => \App\Http\Controllers\front\Common\BottomController::index($layout_id),
      'topfull' => \App\Http\Controllers\front\Common\FullwidthController::index($layout_id),
      'bottomfull' => \App\Http\Controllers\front\Common\BottomFullController::index($layout_id),
      'bcum' => $bcum,
      'banner' => $banner,
      
      );
    

    return view('front.common.home')->with('datas', $datas);
		
    

		
	}
   
  
   

}