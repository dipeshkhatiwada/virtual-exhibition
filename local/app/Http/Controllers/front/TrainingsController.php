<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

use App\Employers;
use App\library\Settings;
use App\Setting;
use App\OrganizationType;

use Carbon\Carbon;

use Image;
use File;
use Mail;
use App\library\myFunctions;

use App\Layout;
use GMaps;
use App\EmployerFollow;
use App\Training;
use App\TrainingCategory;
use App\Imagetool;
use App\EmployerAddress;



class TrainingsController extends Controller
{

  public function index(Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Trainings')->first();
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
              'app.meta_title' => 'Rolling Training',
              'app.meta_keyword' => 'Rolling Training, Rolling Plans, Training in nepal, nepalese training market, vacancy, online training, work in nepal, employment in nepal, career nepal, employment nepal, nepal training market, nepali training market, training sites in nepal, training nepal, nepal training, nepalTrainingite, nepal training site, nepaliTrainingite, nepali training site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and Training, Training and nepal, nepal online Training, Training nepal, nepal Training, nepali Training, training in nepal, nepali training, training opportunity in nepal, find a training in nepal, find Training in nepal, it Training nepal, Trainingnepal, nepalTraining, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro training, high paying training, Training for students, student training',
              'app.meta_description' => 'Rolling Nexus Training - An online training search engine for the training seekers in Nepal. The common search engine for training seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->training),
              'app.meta_url' => url('/trainings'),
              'app.meta_type' => 'Training',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->training)) {
     
      $logo = 'image/'.$image->training;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
    $datas['trainings'] = Training::where('status', 1)->where('end_date', '>=', date('Y-m-d'))->paginate(50);
   
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
    
    return view('front.training.index')->with('datas', $datas);
  }



  public function employer($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'TrainingEmployers')->first();
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
      $training_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $training_image->training)) {
       
        $training_logo = 'image/'.$training_image->training;
      } else {
        $training_logo = '';
      }
      $datas['training_logo'] = $training_logo;
      
      $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
       $employer = Employers::where('seo_url', $url)->where('status', 1)->where('trash', 0)->first();
    if (isset($employer->id)) {
      $date = Carbon::now()->toDateString(); 
      if (is_file(DIR_IMAGE.$employer->logo)) {
          $meta_image = asset('/image/'.$employer->logo);
          $logo = Imagetool::mycrop($employer->logo,150,150);
        }else{
          $meta_image = '';
          $logo = '';
        }

         if (isset($employer->banner)) {
          if (is_file(DIR_IMAGE.$employer->banner)) {
            $banner = asset('/image/'.$employer->banner);
          } else{
            $banner = '';
          }
          
        }else{
          $banner = '';
        }

      $training_detail = [];
      $datas['trainings'] = Training::where('employers_id', $employer->id)->where('status', 1)->where('end_date', '>=', $date)->orderBy('id', 'desc')->paginate(50);
      

      
      $datas['employer'] = $employer;
      $datas['employer_address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      
      $datas['businesslogo'] = asset($logo);
      $datas['banner'] = $banner;     
     
      
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
              'app.meta_url' => url('/trainings/business/'.$url),
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
    return view('front.training.employer_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Business Account Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Business Account Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/trainings'),
              'app.meta_type' => 'Training',
              
                );
            config($config);
        return  view('front.training.employer_not_found');
      }
      


  }




   public function detail($training,Request $request)    
   {

    $layouts= Layout::where('layout_route', 'TrainingDetail')->first();
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
      $training_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $training_image->training)) {
       
        $training_logo = 'image/'.$training_image->training;
      } else {
        $training_logo = '';
      }
      $datas['training_logo'] = $training_logo;
      
       $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    $now = Carbon::now()->toDateString(); 
     
    $training = Training::where('seo_url', $training)->where('status', 1)->first();
    
      
      if (isset($training->id)) {
        if (is_file(DIR_IMAGE.$training->image)) {
      $meta_image = '/image'.$training->image;
      $datas['image'] = 'image/'.$training->image;
    }else{
      $meta_image = $training_logo;
      $datas['image'] = '';
    }
       
        $config = array(
              'app.meta_title' => $training->title,
              'app.meta_keyword' => $training->title,
              'app.meta_description' => Settings::getLimitedWords($training->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('trainings/'.$training->seo_url),
              'app.meta_type' => 'Training',
              'app.id' => '',
              
                );
            config($config);
           
              
                   
            
           

          
            $datas['training'] = $training;
            if (!empty($training->latitude) && !empty($training->longitude)) {
                $config['center'] = $training->latitude.','.$training->longitude;
                $config['zoom'] = '16';
                $config['map_height'] = '300px';
                $config['trafficOverlay'] = TRUE;
                $config['panoramio'] = TRUE;
                $config['panoramioTag'] = 'sunset';
                GMaps::initialize($config);
                    $marker = array();
                    $marker['position'] = $training->latitude.','.$training->longitude;
                    $marker['infowindow_content'] = $training->venue;
                    
                    $marker['animation'] = 'DROP';
                    GMaps::add_marker($marker);
                 $datas['map'] = GMaps::create_map();
             } 
         
          
             $datas['related'] = Training::where('training_category_id', $training->training_category_id)->where('id', '!=', $training->id)->where('status', 1)->orderBy('id','desc')->limit(6)->get();
            


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



            return view('front.training.detail')->with('datas', $datas);

      } else {
        $config = array(
              'app.meta_title' => 'Training Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Training Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/trainings'),
              'app.meta_type' => 'Training',
              
                );
            config($config);
        return  view('front.training.training_not_found');
      }

     

   
   }


   public function categoryTraining($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryTrainings')->first();
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
      $training_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $training_image->training)) {
       
        $training_logo = 'image/'.$training_image->training;
      } else {
        $training_logo = '';
      }
      $datas['training_logo'] = $training_logo;
      
      
    
       $category = TrainingCategory::where('seo_url', $url)->first();
    if (isset($category->id)) {
      $date = Carbon::now()->toDateString(); 
      
     
      $trainings = Training::where('training_category_id', $category->id)->where('status', 1)->where('start_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      
      
      $datas['category'] = $category;
      
      $datas['trainings'] = $trainings;
     

      $config = array(
              'app.meta_title' => $category->name,
              'app.meta_keyword' => $category->name,
              'app.meta_description' => Settings::getLimitedWords($category->description,0,25),
              'app.meta_image' => $training_logo,
              'app.meta_url' => url('/trainings/category/'.$url),
              'app.meta_type' => 'category',
              'app.id' => $category->id,
              
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
    return view('front.training.category_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Training Category Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Training Category Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/trainings/category'),
              'app.meta_type' => 'Training',
              
                );
            config($config);
        return  view('front.training.training_category_not_found');
      }
      


  }


  public function searchTraining($search, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'SearchTrainings')->first();
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
      $training_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $training_image->training)) {
       
        $training_logo = 'image/'.$training_image->training;
      } else {
        $training_logo = '';
      }
      $datas['training_logo'] = $training_logo;
      
      
    
       
    if ($search != '') {
      $date = Carbon::now()->toDateString(); 
      
     
      $trainings = Training::where('title', 'LIKE',  '%'.$search.'%')->where('status', 1)->where('start_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
    

      
      $datas['search'] = $search;
      
      $datas['trainings'] = $trainings;
      

      $config = array(
              'app.meta_title' => $search,
              'app.meta_keyword' => $search,
              'app.meta_description' => $search,
              'app.meta_image' => $training_logo,
              'app.meta_url' => url('/trainings/search/'.$search),
              'app.meta_type' => 'search',
              'app.id' => '',
              
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
    return view('front.training.search_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Training Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Training Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'),
              'app.meta_type' => 'Training',
              
                );
            config($config);
        return  view('front.training.training_not_found');
      }
      


  }

   

    
}
