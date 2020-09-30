<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Jobs;

use App\Employers;
use App\EmployerAddress;
use App\library\settings;
use App\JobsLocation;
use App\JobLocation;
use App\JobCategory;
use App\library\myFunctions;
use App\RecruitmentProcess;
use App\Employees;
use App\ExamSyllabus;
use Carbon\Carbon;


class StatusController extends Controller
{
   public function index($data = array(), Request $request)
   {

    $now = Carbon::now()->toDateString();
    $date = Carbon::now(); 
    if ($date->hour <= '17') {
      $jobs = Jobs::where('deadline', '<=', $now)->get();
      if (count($jobs) > 0) {
        foreach ($jobs as $job) {
          Jobs::where('id', $job->id)->update(['process_status', 3]);
        }
      }
      
    }

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
              'app.meta_type' => 'Single Article',
              
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
      
         $employers = Employers::where('status', 1)->where('trash', 0)->get();

        $controller =  view('front.employer.employers')->with('datas', $employers);
        
        

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
      'left' => $controller,
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
