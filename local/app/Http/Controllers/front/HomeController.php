<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Menu;
use App\Layout;
use App\library\Settings;
use Carbon\Carbon;
use App\ShareUrl;

class HomeController extends Controller
{
   public function index($data = array(), Request $request)
   {
       
       $layouts= Layout::where('layout_route', 'Home')->first();
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
    
    $settings = Settings::getSettings();
        $images = Settings::getImages();
        $config = array(
              'app.meta_title' => $settings->meta_title,
              'app.meta_keyword' => $settings->meta_keyword,
              'app.meta_description' => $settings->meta_description,
              'app.meta_image' => asset('/image/'.$images->logo),
              'app.meta_url' => url('/'),
              'app.meta_type' => 'homepage',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->logo)) {
     
      $logo = 'image/'.$image->logo;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    

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
    
    return view('front.common.home')->with('datas', $datas);

    }
    
    public function FetchUrl(Request $request)
  {
      ini_set("allow_url_fopen", 1);
    if (!isset($request->url)) {
      $data['error'] = 'URL is required';
      return json_encode($data);
    }

    $data['web_title'] = '';
    $data['web_description'] = '';
    $data['web_image'] = '';
    $data['web_video'] = '';
    $data['web_id'] = '';

    $shareurl = ShareUrl::where('url',$request->url)->first();
    if (isset($shareurl->id)) {
        $data['web_title'] = $shareurl->title;
        $data['web_description'] = $shareurl->description;
        $data['web_image'] = $shareurl->image;
        $data['web_video'] = $shareurl->video;
        $data['web_id'] = $shareurl->id;
        $data['web_url'] = $shareurl->url;
    }else{
      $data['web_url'] = $request->url;
      $content = file_get_contents($request->url);

    $doc = new \DOMDocument();

    // squelch HTML5 errors
    @$doc->loadHTML($content);

    $meta = $doc->getElementsByTagName('meta');
    foreach ($meta as $element) {
        $tag = [];
        

        foreach ($element->attributes as $node) {
            
            $tag[$node->name] = $node->value;
        }
        $tags []= $tag;
    }

    $mtitle = ['title','og:title', 'twitter:title'];
        $mdescription = ['description','og:description', 'twitter:description'];
        $mimage = ['image','og:image', 'twitter:image'];
        $mvideo = ['video','og:video','og:video:url', 'twitter:video'];

    foreach ($tags as $key => $value) {
      
      if (isset($value['property'])) {
        if (in_array($value['property'], $mtitle)) {
          $data['web_title'] = $value['content'];
        }
        if (in_array($value['property'], $mdescription)) {
          $data['web_description'] = Settings::getLimitedWords($value['content'],0,50);
        }
        if (in_array($value['property'], $mimage)) {
          $data['web_image'] = $value['content'];
        }
        if (in_array($value['property'], $mvideo)) {
          $data['web_video'] = $value['content'];

        }
      }
    }

    }

           

    return json_encode($data);



  }
}