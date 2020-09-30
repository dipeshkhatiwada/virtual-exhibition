<?php

namespace App\Http\Controllers\front;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{

     


    public static function index() {
      $meta_title='404 Page not found';
        $meta_description='';
        $meta_keyword='';

        
        
    $datas = array(
      'header' => \App\Http\Controllers\front\Common\HeaderController::index($meta_title,$meta_keyword,$meta_description),
      'footer' => \App\Http\Controllers\front\Common\FooterController::index(),
      
      );

       return view('errors.404')->with('datas', $datas);

		
	}
   
  
   

}
