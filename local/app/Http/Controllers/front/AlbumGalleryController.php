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

use App\library\document;
use App\Layout;



class AlbumGalleryController extends Controller
{

     


    public function index($data = array(), Request $request) {
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
      $menu_title = '';
      if(isset($data['menu_id']))
      {
        $menu=\App\Menu::where('id', $data['menu_id'])->first();
        $menu_title = $menu->title;
        $bcum = $menu->title;
        if($menu->parent_id != 0)
        {
          $parent = \App\Menu::where('id', $menu->parent_id)->where('status', 1)->first();
          if (isset($parent->title)) {
            $bcum = $parent->title.'  »  '.$menu->title;
          }
        }
        if (isset($menu->id)) {
              if (isset($menu->image)) {
                $meta_image = asset('/image/'.$menu->image);
              }else{
                $meta_image = '';
              }
          $config = array(
              'app.meta_title' => $menu->meta_title,
              'app.meta_keyword' => $menu->meta_keyword,
              'app.meta_description' => $menu->meta_description,
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('web/'.$menu->se_url),
              'app.meta_type' => 'Albums',
              
                );
            config($config);
        } else {
          $config = array(
              'app.meta_title' => 'not found',
              'app.meta_keyword' => 'not found',
              'app.meta_description' => 'not found',
              'app.meta_image' => '',
              'app.meta_url' => '',
              'app.meta_type' => 'not found',
              
                );
            config($config);
        }
        $controller = array();
       
        $albums= Album::where('status', 1)->paginate(Settings::getSettings()->item_perpage);
        $total = Album::where('status', 1)->count();
        if($total >0 )
        {
          $thumb_height = Settings::getImages()->thumb_height;
        $thumb_width = Settings::getImages()->thumb_width;
        
          

          $module = \App\Module::getModules($layout_id, 'content_main');
      
        $modules = array();
        foreach ($module as $value) {
          $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
          $module = new $cont();
            $modules[] = array(
            'module' => $module->index($value->module_id,json_decode($value->setting)), ); 
            }
          

          $controller = view('front.Album')->with('albums', $albums)->with('modules', $modules)->with('title', $menu_title);
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
      'right' => \App\Http\Controllers\front\Common\RightController::index($layout_id),
      'left' => \App\Http\Controllers\front\Common\LeftController::index($layout_id),
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