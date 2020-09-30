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

use App\EmployerFollow;
use App\Project;

use App\Imagetool;
use App\ProjectCategory;
use App\Employees;
use App\ProjectApply;
use App\EmployerQuestionAnswer;


class ProjectsController extends Controller
{

  public function index(Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Projects')->first();
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
              'app.meta_title' => 'Rolling Project',
              'app.meta_keyword' => 'Rolling Project, Freelancing, Freelancer in Nepal, Rolling Plans, Project in nepal, nepalese project market, vacancy, online project, work in nepal, employment in nepal, career nepal, employment nepal, nepal project market, nepali project market, project sites in nepal, project nepal, nepal project, nepalProjectite, nepal project site, nepaliProjectite, nepali project site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and Project, Project and nepal, nepal online Project, Project nepal, nepal Project, nepali Project, project in nepal, nepali project, project opportunity in nepal, find a project in nepal, find Project in nepal, it Project nepal, Projectnepal, nepalProject, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro project, high paying project, Project for students, student project',
              'app.meta_description' => 'Rolling Nexus Project - An online project search engine for the project seekers in Nepal. The common search engine for project seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->project),
              'app.meta_url' => url('/Project'),
              'app.meta_type' => 'Project',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->project)) {
     
      $logo = 'image/'.$image->project;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
    
    $datas['categories'] = [];
    
   

   $categories = ProjectCategory::inRandomOrder()->limit(15)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Project::where('project_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/projects/category/'.$category->seo_url),
           ];
       }
       
       $datas['projects'] = Project::where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->orderBy('id','desc')->paginate(50);
      
   
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
    
    return view('front.project.index')->with('datas', $datas);
  }



  public function employer($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'ProjectsEmployers')->first();
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

      $project_detail = [];
      $projects = Project::where('employers_id', $employer->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('deadline', '>=', $today)->orderBy('id', 'desc')->get();
      if (count($projects) > 0) {
        foreach ($projects as $project) {
         
           $rem_days = Carbon::parse(Carbon::now())->diffInDays($project->submission_end_date);

          $project_detail[] = [
            'id' => $project->id,
            'title' => $project->title,
            'code' => $project->project_code,
            'employer'        => Employers::getName($project->employers_id),
            'employer_url'    => url('/projects/business/'.Employers::getUrl($project->employers_id)),
            'logo'            => Employers::getPhoto($project->employers_id),
            'publish_date'    => $project->publish_date,
            'submission_date' => $project->submission_end_date,
            'category'        => ProjectType::getTitle($project->project_type_id),
            'href'            => url('/projects/'.$project->seo_url),
            'description'     => Settings::getLimitedWords($project->description,0,20),
            'cost'            => $project->estimate_cost,
            'project_location' => $project->project_location,
            'rem_days'        => $rem_days,
          ];
        }
      }

      $datas = [];
      $datas['employer'] = $employer;
      $datas['address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      $datas['projects'] = $project_detail;
      $datas['businesslogo'] = asset($logo);
      $datas['banner'] = $employer->banner;     
      
      
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
              'app.meta_url' => url('/projects/business/'.$url),
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
    return view('front.project.employer_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Business Account Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Business Account Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'),
              'app.meta_type' => 'Project',
              
                );
            config($config);
        return  view('front.project.project_employer_not_found');
      }
      


  }




   public function detail($project,Request $request)    
   {

    $layouts= Layout::where('layout_route', 'ProjectDetail')->first();
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
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->project)) {
     
      $logo = 'image/'.$image->project;
    } else {
      $logo = '';
    }
    $datas['logo'] = asset($logo);
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;

    $now = Carbon::now()->toDateString(); 
      //$projects = projects::where('seo_url', $project)->where('status', 1)->where('process_status', 1)->where('deadline', '>=', $now)->where('publish_date', '<=', $now)->first();

    $project = Project::where('seo_url', $project)->where('status', 1)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->first();
      
      if (isset($project->id)) {
        $employers = Employers::where('id', $project->employers_id)->first();
        if (isset($employers->id)) {
          $employer_id = $employers->id;
        } else {
          $employer_id = 0;
        }
        if (isset($employers->name)) {
          $employer_name = $employers->name;
        } else {
          $employer_name = '';
        }
         if (isset($employers->href)) {
          $employer_href = $employers->href;
        } else {
          $employer_href = '';
        }

         if (isset($employers->seo_url)) {
          $employer_seo_url = $employers->seo_url;
        } else {
          $employer_seo_url = '';
        }
        if (isset($employers->email)) {
          $employer_email = $employers->email;
        } else {
          $employer_email = '';
        }
        if (isset($employers->description)) {
          $employer_description = $employers->description;
        } else {
          $employer_description = '';
        }
        if (isset($employers->logo)) {
          if(is_file(DIR_IMAGE.$employers->logo)){
          $meta_image = asset('/image/'.$employers->logo);
        } else{
          $meta_image = '';
        }
        }else{
          $meta_image = '';
        }

        $datas['followed'] = 0;

      $total_followers = EmployerFollow::where('employers_id', $employer_id)->count();
      if ($total_followers > 0) {
        $datas['total_follower'] = $total_followers;
      }else{
        $datas['total_follower'] = 0;
      }

      if (isset(auth()->guard('employee')->user()->id)) {
         $chk = EmployerFollow::where('employers_id', $employer_id)->where('employees_id', auth()->guard('employee')->user()->id)->count();
        if ($chk > 0) {
          $datas['followed'] = 1;
        }
       

        
      }

        if (isset($employers->banner)) {
          if (is_file(DIR_IMAGE.$employers->banner)) {
            $banner = asset('/image/'.$employers->banner);
          } else{
            $banner = '';
          }
          
        }else{
          $banner = '';
        }
       
        $config = array(
              'app.meta_title' => $project->title,
              'app.meta_keyword' => strtolower($project->title),
              'app.meta_description' => Settings::getLimitedWords($project->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('projects/'.$project->seo_url),
              'app.meta_type' => 'Project',
              'app.id' => $employer_id,
              
                );
            config($config);
           
              
                   
            
           

          
            $datas['project'] = $project;
           
            $today = date('Y-m-d');
            $datas['employer_name'] = $employer_name;
            $datas['employer_href'] = $employer_href;
            $datas['employer_email'] = $employer_email;
            $datas['url'] = url('/projects/'.$project->seo_url);
            $datas['employer_logo'] = $meta_image;
            $datas['employer_banner'] = $banner;
            $datas['employer_url'] = $employer_seo_url;
           
            $datas['employer_id'] = $employer_id;
            $datas['percentage'] = EmployerQuestionAnswer::getEmployerPercent($employer_id);
            $datas['question_group'] = EmployerQuestionAnswer::getEmployerQustionGroup($employer_id);
            $datas['total_projects'] = Project::where('employers_id', $employer_id)->count();
            $datas['open_projects'] = Project::where('employers_id', $employer_id)->where('status', 1)->where('publish_date', '<=', $today)->count();
            $datas['closed_projects'] = Project::where('employers_id', $employer_id)->where('status', 2)->where('publish_date', '<=', $today)->count();
           
            $datas['project_category'] = ProjectCategory::getTitle($project->project_category_id);
            $datas['project_url'] = url('/projects/category/'.ProjectCategory::getUrl($project->project_category_id));
          
            $datas['employer_description'] = $employer_description;
            $datas['project_documents'] = $project->projectDocuments;
            $datas['project_items'] = $project->projectItems;
            $datas['bids'] = ProjectApply::where('project_id', $project->id)->paginate(10);
             
            

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



            return view('front.project.projectdetails')->with('datas', $datas);

      } else {
        $config = array(
              'app.meta_title' => 'Project Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Project Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/projects'),
              'app.meta_type' => 'Project',
              
                );
            config($config);
        return  view('front.project.project_not_found');
      }

     

   
   }

   public function categoryProject($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryProjects')->first();
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
      $image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $image->project)) {
       
        $logo = 'image/'.$image->project;
      } else {
        $logo = '';
      }
      $datas['logo'] = asset($logo);
      
      $datas['address'] = $setting->address;
      $datas['phone'] = $setting->telephone;
    
       $category = ProjectCategory::where('seo_url', $url)->first();
    if (isset($category->id)) {
      $date = Carbon::now()->toDateString(); 
      

     
      $projects = Project::where('project_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      
      
      $datas['category'] = $category;
      
      $datas['projects'] = $projects;
      
      
   


      $config = array(
              'app.meta_title' => $category->title,
              'app.meta_keyword' => $category->title,
              'app.meta_description' => $category->title,
              'app.meta_image' => asset($logo),
              'app.meta_url' => url('/projects/category/'.$url),
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
    return view('front.project.category_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Category Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Category Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/projects/category'),
              'app.meta_type' => 'Project',
              
                );
            config($config);
        return  view('front.project.project_category_not_found');
      }
      


  }

public function searchProject($search, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryProjects')->first();
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
      $image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $image->project)) {
       
        $logo = 'image/'.$image->project;
      } else {
        $logo = '';
      }
      $datas['logo'] = asset($logo);
      
      $datas['address'] = $setting->address;
      $datas['phone'] = $setting->telephone;
    
       
    if (!empty($search)) {
      $date = Carbon::now()->toDateString(); 
      

      
      $projects = Project::where('title', 'LIKE', '%'.$search.'%')->where('status', 1)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->orderBy('id', 'desc')->paginate(20);
     

     
      $datas['search'] = $search;
      
      $datas['projects'] = $projects;
      
      
   


      $config = array(
              'app.meta_title' => $search,
              'app.meta_keyword' => $search,
              'app.meta_description' => $search,
              'app.meta_image' => asset($logo),
              'app.meta_url' => url('/projects/category/'),
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
    return view('front.project.search_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Project Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Project Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/projects/search'),
              'app.meta_type' => 'Project',
              
                );
            config($config);
        return  view('front.project.project_not_found');
      }
      


  }

public function tagsProject($search, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryProjects')->first();
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
      $image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $image->project)) {
       
        $logo = 'image/'.$image->project;
      } else {
        $logo = '';
      }
      $datas['logo'] = asset($logo);
      
      $datas['address'] = $setting->address;
      $datas['phone'] = $setting->telephone;
    
       
    if (!empty($search)) {
      $date = Carbon::now()->toDateString(); 
      

      
      $projects = Project::where('skills', 'LIKE', '%'.$search.'%')->where('status', 1)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->orderBy('id', 'desc')->paginate(20);
     

     
      $datas['search'] = $search;
      
      $datas['projects'] = $projects;
      
      
   


      $config = array(
              'app.meta_title' => $search,
              'app.meta_keyword' => $search,
              'app.meta_description' => $search,
              'app.meta_image' => asset($logo),
              'app.meta_url' => url('/projects/category/'),
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
    return view('front.project.search_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Project Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Project Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/projects/search'),
              'app.meta_type' => 'Project',
              
                );
            config($config);
        return  view('front.project.project_not_found');
      }
      


  }
  
  
  public function BidderDetail($id='')
  {
    $bidder = Employees::where('id',$id)->first();
    if (!isset($bidder->id)) {
      \Session::alert('alert-danger','Bidder Not Found');
      return redirect()->back();
    }
     $visits = $bidder->visits + 1;
    Employees::where('id',$id)->update(['visits' => $visits]);

     $layouts= Layout::where('layout_route', 'CategoryProjects')->first();
     $visitor = \App\ProfileVisitor::where('employees_id', $id)->whereDate('created_at', date('Y-m-d'))->first();
    if (isset(auth()->guard('employee')->user()->id)) {
      $vis = [auth()->guard('employee')->user()->id];
      if (isset($visitor->id)) {
        if ($visitor->employees) {
          $visit = array_unique(array_merge($vis,json_decode($visitor->employees)), SORT_REGULAR);
          \App\ProfileVisitor::where('id',$visitor->id)->update(['employees' => json_encode($visit)]);
        }else{
            \App\ProfileVisitor::where('id',$visitor->id)->update(['employees' => json_encode($vis)]);
        }
      }else{
        \App\ProfileVisitor::create(['employees_id' => $id, 'employees' => json_encode($vis)]);
      }
    }
    if (isset(auth()->guard('employer')->user()->employers_id)) {
      $vis = [auth()->guard('employer')->user()->employers_id];
     
      if (isset($visitor->id)) {
        if ($visitor->employer) {
          $visit = array_unique(array_merge($vis,json_decode($visitor->employer)), SORT_REGULAR);
          \App\ProfileVisitor::where('id',$visitor->id)->update(['employer' => json_encode($visit)]);
        }else{
            \App\ProfileVisitor::where('id',$visitor->id)->update(['employer' => json_encode($vis)]);
        }
      }else{
        \App\ProfileVisitor::create(['employees_id' => $id, 'employer' => json_encode($vis)]);
      }
    }
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
      $image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $image->project)) {
       
        $logo = 'image/'.$image->project;
      } else {
        $logo = '';
      }
      
      $datas['endorse'] = NULL;

      if(isset(auth()->guard('employee')->user()->id))
      {
        $check = \App\UserCircle::checkFriend($id);
        if($check > 0)
        {
          $datas['endorse'] = TRUE;
        }
      }
      $datas['logo'] = asset($logo);
      
      $datas['address'] = $setting->address;
      $datas['phone'] = $setting->telephone;
      $datas['bidder'] = $bidder;
      $datas['bidder_comment'] = \App\EmployeeRating::where('employees_id',$bidder->id)->paginate(10);

       $config = array(
              'app.meta_title' => $bidder->firstname,
              'app.meta_keyword' => $bidder->firstname,
              'app.meta_description' => $bidder->professional_heading,
              'app.meta_image' => asset($logo),
              'app.meta_url' => url('/projects/bidder-detail/'.$bidder->id),
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
    return view('front.project.bidder_detail')->with('datas', $datas);


  }


  public function BidderComment(Request $request)
  {

    $this->validate($request, [
      'bidder_id' => 'required|integer',
      'comment' => 'required',
      'rating' => 'required',

    ]);

    if (isset(auth()->guard('employer')->user()->employers_id)) {
      $comment_by = auth()->guard('employer')->user()->employers_id;
      $type = 1;
    } elseif (isset(auth()->guard('employee')->user()->id)) {
       $comment_by = auth()->guard('employee')->user()->id;
      $type = 2;
      if (auth()->guard('employee')->user()->id == $request->bidder_id) {
      \Session::flash('alert-danger','You can not rate yourself');
      return redirect()->back();
    }
    } else{
      \Session::flash('alert-danger','You most login to rate User');
      return redirect()->back();
    }

    

    \App\EmployeeRating::create([
      'employees_id' => $request->bidder_id, 
      'rating' => $request->rating, 
      'comment_by' => $comment_by, 
      'description' => $request->comment,
      'types' => $type
    ]);

      \Session::flash('alert-success','Comment Successfully');
      return redirect()->back();

  }




   

    
}

