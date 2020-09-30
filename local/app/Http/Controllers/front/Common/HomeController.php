<?php

namespace App\Http\Controllers\front\common;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Imagetool;
use App\Menu;
use App\Layout;
use App\library\Settings;
use Carbon\Carbon;
use App\Setting;
use App\Jobs;

class HomeController extends Controller
{
   public function index(Request $request)
   {
      /* $emids = ['166','7621','7624','7644','7649','7685','7759','7943','7950','8050','8132','8395','8516'];
       \App\Jobs::whereIn('employers_id',$emids)->update(['employers_id' => '8902']);
       \App\Tender::whereIn('employers_id',$emids)->update(['employers_id' => '8902']);
       \App\EmployeeEducation::whereIn('employers_id',$emids)->update(['employers_id' => '8902']);
       \App\EmployeeExperience::whereIn('employers_id',$emids)->update(['employers_id' => '8902']);
       \App\EmployeeTraining::whereIn('employers_id',$emids)->update(['employers_id' => '8902']);
       \App\Employers::whereIn('id',$emids)->delete();
       
       $jobs = Jobs::select('id','deadline')->where('status',1)->where('deadline', '<=', date('Y-m-d'))->get();
       
       foreach($jobs as $job)
       {
          if(date('H') == 17){
           Jobs::where('id',$job->id)->update(['status' => 2]);
          }
       }
       
       $expday = Carbon::now()->subDay(1);
       //dd($expday);
       
       $expreds = \App\EmployeeRegistration::where('created_at', '<', $expday)->get();
       foreach($expreds as $exp)
       {
           \App\EmployeeRegistration::where('id',$exp->id)->delete();
       }
       
      $events = \App\Event::where('to_date', '<',date('Y-m-d'))->get();
       foreach ($events as $key => $event) {
         \App\Event::where('id', $event->id)->update(['status' => 2]);
       }

       $trainings = \App\Training::where('end_date', '<',date('Y-m-d'))->get();
       foreach ($trainings as $key => $training) {
         \App\Training::where('id', $training->id)->update(['status' => 2]);
       }
       
       */
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

    
}
