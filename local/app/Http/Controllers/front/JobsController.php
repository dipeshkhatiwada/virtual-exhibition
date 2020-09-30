<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Imagetool;
use App\Menu;
use App\Layout;
use App\library\Settings;
use Carbon\Carbon;
use App\Setting;
use DB;
use App\JobLocation;
use App\JobCategory;
use App\Jobs;
use App\OrganizationType;

class JobsController extends Controller
{
   public function index(Request $request)
   {
       
      $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Jobs')->first();
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
              'app.meta_title' => 'Rolling Jobs',
              'app.meta_keyword' => 'Rolling Jobs, Rolling Plans, jobs in nepal, nepalese job market, vacancy, online job, work in nepal, employment in nepal, career nepal, employment nepal, nepal job market, nepali job market, job sites in nepal, job nepal, nepal job, nepaljobsite, nepal job site, nepalijobsite, nepali job site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and jobs, jobs and nepal, nepal online jobs, jobs nepal, nepal jobs, nepali jobs, job in nepal, nepali job, job opportunity in nepal, find a job in nepal, find jobs in nepal, it jobs nepal, jobsnepal, nepaljobs, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro job, high paying job, jobs for students, student job',
              'app.meta_description' => 'Rolling Nexus Jobs - An online job search engine for the job seekers in Nepal. The common search engine for job seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->job),
              'app.meta_url' => url('/jobs'),
              'app.meta_type' => 'jobs',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->job)) {
     
      $logo = 'image/'.$image->job;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    $datas['search_locations'] = JobLocation::orderBy('name','asc')->get();
    $datas['search_categories'] = JobCategory::orderBy('name', 'asc')->get();
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    $datas['locations'] = [];
    $datas['functions'] = [];
    $datas['categories'] = [];


    $locations = \App\JobsLocation::leftJoin('jobs','jobs_location.jobs_id','=','jobs.id')
           ->selectRaw('jobs_location.location_id, count(jobs.id) AS `count`')
           ->groupBy('jobs_location.location_id')
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $date)->where('jobs.deadline', '>=', $date)
           
           ->orderBy('count','DESC')
           ->skip(0)->take(9)->get();

   
    foreach ($locations as $location) {
     
      $jl = JobLocation::where('id',$location->location_id)->first();

       
      $datas['locations'][] = [
        'name' => $jl->name,
        'href' => url('/jobs/location/'.$jl->seo_url),
        'total' => $location->count
      ];
    }


    $categories = JobCategory::leftJoin('jobs','job_category.id','=','jobs.category_id')
           ->selectRaw('job_category.*, count(jobs.id) AS `count`')
           
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $date)->where('jobs.deadline', '>=', $date)
          ->groupBy('job_category.id')
           ->orderBy('count','DESC')
           ->skip(0)->take(9)->get();

    foreach ($categories as $category) {
       
      $datas['categories'][] = [
        'name' => $category->name,
        'href' => url('/jobs/category/'.$category->seo_url),
        'total' => $category->count,
        
      ];
    }

    $functions = OrganizationType::leftJoin('jobs','organization_type.id','=','jobs.org_type_id')
           ->selectRaw('organization_type.*, count(jobs.id) AS `count`')
           
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $date)->where('jobs.deadline', '>=', $date)
          ->groupBy('organization_type.id')
           ->orderBy('count','DESC')
           ->skip(0)->take(9)->get();

   
    foreach ($functions as $function) {

       
      $datas['functions'][] = [
        'name' => $function->name,
        'href' => url('/jobs/function/'.$function->seo_url),
        'total' => $function->count,
        
      ];
    }
    

    

    
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
    
    return view('front.common.jobs')->with('datas', $datas);

    }

    
}
