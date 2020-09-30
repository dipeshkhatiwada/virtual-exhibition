<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Menu;
use App\Layout;


class MenuController extends Controller
{
   public function index($href, Request $request)
   {
      $menu = Menu::where('se_url', $href)->where('status', 1)->first();
     
      if (isset($menu->id)) {
        # code...
      
      $layout = Layout::where('layout_id', $menu->layout_id)->first();

          $datas = array('menu_id' => $menu->id, 'layout_id' => $menu->layout_id, );

          $cont = '\App\Http\Controllers\front\\'.ucfirst($layout->layout_route).'Controller';
          $module = new $cont();
          $controller = $module->index($datas, $request);
      } else {
        $controller = \App\Http\Controllers\front\ErrorController::index();
      }

      return $controller;

    }

    
}
