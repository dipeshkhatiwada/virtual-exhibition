<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\library\Settings;
use GMaps;


class GooglemapController extends Controller
{
  
   public function index(Request $request)
   {

    $config = array(
              'app.meta_title' => 'Google Map',
              'app.meta_keyword' => 'Google Map',
              'app.meta_description' => 'Google Map',
              'app.meta_image' => '',
              'app.meta_url' => url('/googlemap'),
              'app.meta_type' => 'Google Map',
              
                );
            config($config);
           
            $settings = Settings::getSettings();
            $config['center'] = $settings->latitude.','.$settings->longitude;
                 
            $config['zoom'] = 'auto';
            $config['map_height'] = '500px';
            $config['trafficOverlay'] = TRUE;
            $config['panoramio'] = TRUE;
            $config['panoramioTag'] = 'sunset';
            GMaps::initialize($config);

            $marker = array();
            $marker['position'] = $settings->latitude.','.$settings->longitude;
            $marker['infowindow_content'] = $settings->name;
            $marker['animation'] = 'DROP';
            GMaps::add_marker($marker);

            $marker = array();
            $marker['position'] = '27.687915, 85.339072';
            $marker['infowindow_content'] = 'Trolly Bus Park';
            $marker['icon'] = '//chart.googleapis.com/chart?chst=d_map_spin&chld=.99|0|C6E7DE|11|_|PD';
            GMaps::add_marker($marker);
            $data = GMaps::create_map();

           

            $controller =  view('front.googlemap')->with('data', $data);

            $layout_id = 0;
      $datas = array(
      'header' => \App\Http\Controllers\front\Common\HeaderController::index(),
      'footer' => \App\Http\Controllers\front\Common\FooterController::index(),
      'main' => $controller,
      'left' => \App\Http\Controllers\front\Common\LeftController::index($layout_id),
      'right' => \App\Http\Controllers\front\Common\RightController::index($layout_id),
      'top' => \App\Http\Controllers\front\Common\TopController::index($layout_id),
      'bottom' => \App\Http\Controllers\front\Common\BottomController::index($layout_id),
      'topfull' => \App\Http\Controllers\front\Common\FullwidthController::index($layout_id),
      'bottomfull' => \App\Http\Controllers\front\Common\BottomFullController::index($layout_id),
      
      
      
      );
    

    return view('front.common.home')->with('datas', $datas);


   }


    
}
