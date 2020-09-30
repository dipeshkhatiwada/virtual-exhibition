<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Jobs;

use App\Employers;
use App\EmployerAddress;
use App\library\Settings;
use App\JobsLocation;
use App\JobLocation;
use App\JobCategory;
use App\library\myFunctions;
use App\RecruitmentProcess;
use App\Employees;
use App\ExamSyllabus;
use Carbon\Carbon;
use App\Layout;
use App\Imagetool;
use App\EmployerFollow;
use App\Apply;
use App\Setting;
class EmployerController extends Controller
{
   public function detail($url, Request $request)
   {

    $datas['menu_url'] = url('/jobs');
    $datas['menu_logo'] = \App\library\Settings::getJobLogo();
    $datas['tab'] = 'job';
    if(isset($request->tab))
    {
      if ($request->tab == 'tender') {
        $datas['menu_url'] = url('/tenders');
        $datas['menu_logo'] = \App\library\Settings::getTenderLogo();
        $datas['tab'] = 'tender';
      }
      elseif ($request->tab == 'event') {
        $datas['menu_url'] = url('/events');
        $datas['menu_logo'] = \App\library\Settings::getEventLogo();
        $datas['tab'] = 'event';
      }
      elseif ($request->tab == 'training') {
        $datas['menu_url'] = url('/trainings');
        $datas['menu_logo'] = \App\library\Settings::getTrainingLogo();
        $datas['tab'] = 'training';
      }
      elseif ($request->tab == 'blog') {
        $datas['menu_url'] = url('/jobs');
        $datas['menu_logo'] = \App\library\Settings::getJobLogo();
        $datas['tab'] = 'blog';
      }
      elseif ($request->tab == 'about') {
        $datas['menu_url'] = url('/jobs');
        $datas['menu_logo'] = \App\library\Settings::getJobLogo();
        $datas['tab'] = 'about';
      } else{
        $datas['menu_url'] = url('/jobs');
        $datas['menu_logo'] = \App\library\Settings::getJobLogo();
        $datas['tab'] = 'job';
      }
    }

    

   $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Employer')->first();
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

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $job_image->job)) {
       
        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['job_logo'] = $job_logo;


    $employer = Employers::where('seo_url', $url)->where('status', 1)->where('trash', 0)->first();
    if (isset($employer->id)) {
$date = Carbon::now()->toDateString(); 
      if (isset($employer->logo)) {
          $meta_image = asset('/image/'.$employer->logo);
          $logo = Imagetool::mycrop($employer->logo,150,150);
        }else{
          $meta_image = '';
          $logo = '';
        }
      $datas['content'] = '';
      $job_detail = [];
      if ($datas['tab'] == 'job') {
        
      $jobs = Jobs::where('employers_id', $employer->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->orderBy('id', 'asc')->get();
      if (count($jobs) > 0) {
        
        foreach ($jobs as $job) {
          $jdescription = \App\JobRequirements::where('jobs_id', $job->id)->first();
          $jobs_location = [];
          $jls = JobsLocation::where('jobs_id', $job->id)->get();
            if(count($jls) > 0){
             foreach ($jls as $jl) {
                 $jobs_location[] = JobLocation::where('id', $jl->location_id)->first();
             }
           }

          

          $job_detail[] = [
            'id' => $job->id,
            'title' => $job->title,
            'location' => $jobs_location,
            'category' => JobCategory::getTitle($job->category_id),
            'job_availability' => $job->job_availability,
            'vacancy_code' => $job->vacancy_code,
            
          
            'process_id' => $job->process_status,
            'seo_url' => $job->seo_url,
            'p_status' => $jdescription->specific_requirement,
            'published_date' => $job->publish_date,
            'deadline' => $job->deadline,
            'job_type' => \App\JobType::getTitle($job->job_type),
            'vacancy_source' => $job->vacancy_source,
            'views' => $job->views,
            'job_url' => url('jobs/'.$employer->seo_url.'/'.$job->seo_url)
          ];
        }
        $datas['content'] = view('front.employer.joblist')->with('datas', $job_detail);
      }
      }

      if ($datas['tab'] == 'tender') {
        
      $tenders = \App\Tender::where('employers_id', $employer->id)->where('status', 1)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->orderBy('id','desc')->paginate(20)->setPath('/business/'.$employer->seo_url.'?tab=tender');
      $datas['content'] = view('front.employer.tenderlist')->with('datas', $tenders);
      }
      if ($datas['tab'] == 'training') {
        
      $training = \App\Training::where('employers_id', $employer->id)->where('status', 1)->where('end_date', '>=', $date)->orderBy('id', 'desc')->paginate(20)->setPath('/business/'.$employer->seo_url.'?tab=training');
      $datas['content'] = view('front.employer.traininglist')->with('datas', $training);
      }
      if ($datas['tab'] == 'event') {
        
      $events = \App\Event::where('employers_id', $employer->id)->where('status', 1)->where('event_date', '>=', $date)->orderBy('id', 'desc')->paginate(20)->setPath('/business/'.$employer->seo_url.'?tab=event');
      $datas['content'] = view('front.employer.eventlist')->with('datas', $events);
      }
      if ($datas['tab'] == 'blog') {
        
      $blogs = \App\EmployerBlog::where('employers_id',$employer->id)->where('status', 1)->orderBy('id', 'desc')->paginate(20)->setPath('/business/'.$employer->seo_url.'?tab=blog');
      $datas['content'] = view('front.employer.bloglist')->with('datas', $blogs);
      }
      if ($datas['tab'] == 'about') {
        
     
      $datas['content'] = view('front.employer.about')->with('datas', $employer->description);
      }

      $datas['jobs'] = $job_detail;

      $datas['notice'] = \App\EmployerNotice::where('employers_id',$employer->id)->where('date', '<=', $date)->get();
      

     
      $datas['employer'] = $employer;
      $datas['address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      
      $datas['businesslogo'] = asset($logo);
      if (is_file(DIR_IMAGE.$employer->banner)) {
        $datas['banner'] = asset('/image/'.$employer->banner); 
      } else{
        $datas['banner'] = '';
      }
          
      
      
    $datas['followed'] = 0;
      $total_followers = EmployerFollow::where('employers_id', $employer->id)->count();
      if ($total_followers > 0) {
        $datas['total_follower'] = $total_followers;
      }else{
        $datas['total_follower'] = 0;
      }

      if (isset(auth()->guard('employee')->user()->id)) {
         $chk = EmployerFollow::where('employers_id', $employer->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
        if ($chk > 0) {
          $datas['followed'] = 1;
        }
       

        
      }




      $config = array(
              'app.meta_title' => $employer->name,
              'app.meta_keyword' => $employer->name,
              'app.meta_description' => Settings::getLimitedWords($employer->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('/business/'.$url),
              'app.meta_type' => 'Employer',
              'app.id' => $employer->id,
              
                );
            config($config);

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

      $datas['advertise_left'] = \App\EmployerAdvertise::where('employers_id',$employer->id)->where('place',1)->get();

    if ($employer->layout != '') {
      return view('front.employer.'.$employer->layout)->with('datas', $datas);
    } else{
      return view('front.employer.default')->with('datas', $datas);
    }
    


    } else {
       $config = array(
              'app.meta_title' => 'Job Providor Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Job Providor Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'.$url),
              'app.meta_type' => 'job',
              
                );
            config($config);
        return  view('front.employer.employer_not_found');
      }
      


      
    

    

   }



   public function blogDetail($url,$blog, Request $request)
   {

    $datas['menu_url'] = url('/jobs');
    $datas['menu_logo'] = \App\library\Settings::getJobLogo();
    $datas['tab'] = 'blog';
    

    

   $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Employer')->first();
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

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $job_image->job)) {
       
        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['job_logo'] = $job_logo;


    $employer = Employers::where('seo_url', $url)->where('status', 1)->where('trash', 0)->first();
    if (isset($employer->id)) {
$date = Carbon::now()->toDateString(); 
      if (isset($employer->logo)) {
          $meta_image = asset('/image/'.$employer->logo);
          $logo = Imagetool::mycrop($employer->logo,150,150);
        }else{
          $meta_image = '';
          $logo = '';
        }
      $datas['content'] = '';
      
      $blogdetail = \App\EmployerBlog::where('seo_url',$blog)->first();
      if (isset($blogdetail->id)){
        $datas['content'] = view('front.employer.blogdetail')->with('data', $blogdetail);
      }

      

      

      $datas['notice'] = \App\EmployerNotice::where('employers_id',$employer->id)->where('date', '<=', $date)->get();
      

     
      $datas['employer'] = $employer;
      $datas['address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      
      $datas['businesslogo'] = asset($logo);
      if (is_file(DIR_IMAGE.$employer->banner)) {
        $datas['banner'] = asset('/image/'.$employer->banner); 
      } else{
        $datas['banner'] = '';
      }
          
      
      
    $datas['followed'] = 0;
      $total_followers = EmployerFollow::where('employers_id', $employer->id)->count();
      if ($total_followers > 0) {
        $datas['total_follower'] = $total_followers;
      }else{
        $datas['total_follower'] = 0;
      }

      if (isset(auth()->guard('employee')->user()->id)) {
         $chk = EmployerFollow::where('employers_id', $employer->id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
        if ($chk > 0) {
          $datas['followed'] = 1;
        }
       

        
      }




      $config = array(
              'app.meta_title' => $employer->name,
              'app.meta_keyword' => $employer->name,
              'app.meta_description' => Settings::getLimitedWords($employer->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('/business/'.$url),
              'app.meta_type' => 'Employer',
              'app.id' => $employer->id,
              
                );
            config($config);

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

      $datas['advertise_left'] = \App\EmployerAdvertise::where('employers_id',$employer->id)->where('place',1)->get();

    if ($employer->layout != '') {
      return view('front.employer.'.$employer->layout)->with('datas', $datas);
    } else{
      return view('front.employer.default')->with('datas', $datas);
    }
    


    } else {
       $config = array(
              'app.meta_title' => 'Job Providor Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Job Providor Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'.$url),
              'app.meta_type' => 'job',
              
                );
            config($config);
        return  view('front.employer.employer_not_found');
      }
      


      
    

    

   }

   


    
}
