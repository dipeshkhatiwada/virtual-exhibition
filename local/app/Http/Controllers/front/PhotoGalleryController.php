<?php

namespace App\Http\Controllers\front;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Album;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\library\myFunctions;
use App\library\Settings;
use App\Photo;
use App\library\document;
use App\Layout;



class PhotoGalleryController extends Controller
{

     


    public function index($data, Request $request) {
      $layouts= Layout::where('layout_route', 'PhotoGallery')->first();
      
      if(isset($layouts->layout_id))
      {
        $layout_id = $layouts->layout_id;
      }
      else
      {
        $layout_id = '';
      }
      $menu_title = '';
      $album = Album::where('se_url', $data)->first();
      if(isset($album->id))
      {
        $bcum = $album->title;
        
          $config = array(
              'app.meta_title' => $album->meta_title,
              'app.meta_keyword' => $album->meta_keyword,
              'app.meta_description' => $album->meta_description,
              'app.meta_image' => '',
              'app.meta_url' => url('web/'.$data),
              'app.meta_type' => 'Photo Gallery',
              
                );
            config($config);
        
        $controller = array();
       
        $photos= Photo::where('album_id', $album->id)->paginate(Settings::getSettings()->item_perpage);
        $total = Photo::where('album_id', $album->id)->count();
        if($total >0 )
        {
          $mdatas['height'] = Settings::getImages()->thumb_height;
        $mdatas['width'] = Settings::getImages()->thumb_width;
        
          

          $module = \App\Module::getModules($layout_id, 'content_right');
      
        $modules = array();
        foreach ($module as $value) {
          $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
          $module = new $cont();
            $modules[] = array(
            'module' => $module->index($value->module_id,json_decode($value->setting)), ); 
            }
          

          $controller = view('front.Photo')->with('photos', $photos)->with('modules', $modules)->with('datas', $mdatas);
        }
        else {
          $controller = view('errors.notFound');
        }
        
        

      }
      
      else{
        $controller = \App\Http\Controllers\front\ErrorController::index();

       return $controller;
       exit();
      }
    
    if ($menu_title == 'Services') {
        $banner = '/image/inner-banner_services.jpg';
      } else {
        $banner = '/image/inner-banner.jpg';
      }
      
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