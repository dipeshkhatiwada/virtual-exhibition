<?php

namespace App\Http\Controllers\front\common;
use DB;
use App\Http\Controllers\Controller;
use App\Setting;
use App\SettingImage;
use App\Imagetool;
use App\library\Settings;
use App\Menu;



class HeaderController extends Controller
{
     


    public static function index()
    {
      $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
      if (is_file(DIR_IMAGE . $image->icon)) {
      $icon = Imagetool::mycrop($image->icon, 16,16);
    } else {
      $icon = '';
    }

    if (is_file(DIR_IMAGE . $image->logo)) {
     
      $logo = 'image/'.$image->logo;
    } else {
      $logo = '';
    }
    
    $menus = [];

        $menu = Menu::where('parent_id', 0)->where('status', 1)->orderBy('sort_order', 'asc')->get();
        foreach ($menu as $flevel) {
            $slevel = [];
            $smenu = Menu::where('parent_id', $flevel->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();
            foreach ($smenu as $sl) {
                $tlevel = [];
                $tmenu = Menu::where('parent_id', $sl->id)->where('status', 1)->orderBy('sort_order', 'asc')->get();
                foreach ($tmenu as $tl) {
                    $tlevel[]= [
                        'id' => $tl->id,
                        'title' => $tl->title,
                        'se_url'  => $tl->se_url,
                        'layout_id' => $tl->layout_id,
                        
                    ];
                }
                $slevel[] = [
                        'id' => $sl->id,
                        'title' => $sl->title,
                        'se_url'  => $sl->se_url,
                        'layout_id' => $sl->layout_id,
                        'children' => $tlevel,
                        
                ];
            }
            $menus[] = [
                        'id' => $flevel->id,
                        'title' => $flevel->title,
                        'se_url'  => $flevel->se_url,
                        'layout_id' => $flevel->layout_id,
                        'children' => $slevel,
                       
                ];

        }
    

      
      $datas = array(
        'icon' => $icon,
          'logo' => $logo,
          'name' => $setting->name,
          'ukas' => 'image/ukas.png',
          'iso' => 'image/ISO_logo.png',
          'ukas_logo' => 'image/URS.png',
          'address' => $setting->address,
          'phone' => $setting->telephone,
          'email' => $setting->email,
          'social' => Settings::getSocials(),
          'menus' => $menus,
          
         
        );
       
      $module = \App\Module::getHeaderModules();
      
        $datas['modules'] = array();
        foreach ($module as $value) {
          $cont= '\App\Http\Controllers\front\module\\'.$value->module_page.'Controller';
          $module = new $cont();
            $datas['modules'][] = array(
            'module' => $module->index($value->module_id,json_decode($value->setting)), ); 
            }
              
        

        return view('front.common.header')->with('datas', $datas);
    

    }

   
  
   

}