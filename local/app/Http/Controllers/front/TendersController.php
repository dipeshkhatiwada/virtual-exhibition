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
use App\Tender;
use App\TenderDocument;
use App\TenderItem;
use App\TenderType;
use App\TenderForm;
use App\Imagetool;
use App\EmployerAddress;


class TendersController extends Controller
{

  public function index(Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'Tenders')->first();
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
              'app.meta_title' => 'Rolling Tender',
              'app.meta_keyword' => 'Rolling Tender, Rolling Plans, Tender in nepal, nepalese tender market, vacancy, online tender, work in nepal, employment in nepal, career nepal, employment nepal, nepal tender market, nepali tender market, tender sites in nepal, tender nepal, nepal tender, nepalTenderite, nepal tender site, nepaliTenderite, nepali tender site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and Tender, Tender and nepal, nepal online Tender, Tender nepal, nepal Tender, nepali Tender, tender in nepal, nepali tender, tender opportunity in nepal, find a tender in nepal, find Tender in nepal, it Tender nepal, Tendernepal, nepalTender, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro tender, high paying tender, Tender for students, student tender',
              'app.meta_description' => 'Rolling Nexus Tender - An online tender search engine for the tender seekers in Nepal. The common search engine for tender seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->tender),
              'app.meta_url' => url('/Tender'),
              'app.meta_type' => 'Tender',
              
                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;
     

    if (is_file(DIR_IMAGE . $image->tender)) {
     
      $logo = 'image/'.$image->tender;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;
    
    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;
    
    
    $datas['categories'] = [];
    
   

    $categories = TenderType::inRandomOrder()->limit(9)->get();
    foreach ($categories as $category) {
      $totaltender = Tender::where('tender_type_id', $category->id)->where('status', 1)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->count();
      $datas['categories'][] = [
        'name' => $category->title,
        'href' => url('/tenders/category/'.$category->seo_url),
        'total' => $totaltender
      ];
    }

    $employers = Employers::where('trash',0)->where('status', 1)->inRandomOrder()->skip(0)->take(9)->get();
    $datas['employers'] = [];
    foreach ($employers as $key => $emp) {
      $count = Tender::where('employers_id', $emp->id)->where('status', 1)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->count();
      if($count > 0){
      $datas['employers'][] = [
        'name' => $emp->name,
        'href' => url('/tenders/business/'.$emp->seo_url),
        'total' => $count
      ];
    }
    }
    $today = date('Y-m-d');
    
    $datas['tenders'] = Tender::where('status', 1)->where('publish_date', '<=', $today)->where('submission_end_date', '>=', $today)->orderBy('id','desc')->paginate(20);

   
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
    
    return view('front.tender.index')->with('datas', $datas);
  }



  public function employer($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'TendersEmployers')->first();
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
      $tender_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $tender_image->tender)) {
       
        $tender_logo = 'image/'.$tender_image->tender;
      } else {
        $tender_logo = '';
      }
      $datas['tender_logo'] = $tender_logo;
      
      
    
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

      $tender_detail = [];
      $tenders = Tender::where('employers_id', $employer->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($tenders) > 0) {
        foreach ($tenders as $tender) {
         
          if (is_file(DIR_IMAGE.$tender->image)) {
          $thumb = Imagetool::mycrop($tender->image,400,400);
          $image = asset('/image/'.$tender->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($tender->submission_end_date)->diff(Carbon::now())->format('%D:%H:%I');
       $diffs = explode(':', $diff);
       if ($diffs[0] != 0) {
           $difference = $diffs[0].' Days left';
       } elseif ($diffs[1] != 0) {
           $difference = $diffs[1].' Hours left';
       }elseif ($diffs[2] != 0) {
           $difference = $diffs[2].' Minutes left';
       } else {
            $difference = '';
       }

            $submission = Carbon::parse($tender->submission_end_date);
          $tender_detail[] = [
              'id'              => $tender->id,
              'title'           => $tender->title,
              'employer'        => Employers::getName($tender->employers_id),
              'employer_url'    => url('/tenders/business/'.Employers::getUrl($tender->employers_id)),
              'logo'            => Employers::getPhoto($tender->employers_id),
              'publish_date'    => $tender->publish_date,
              'submission_date' => $tender->submission_end_date,
              'category'        => TenderType::getTitle($tender->tender_type_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/tenders/'.$tender->seo_url),
              'tender_code'     => $tender->tender_code,
              'difference'      => $difference,
              'description'     => Settings::getLimitedWords($tender->description,0,20),
              'estimate_cost'   => $tender->estimate_cost,
              'tender_location' => $tender->project_location,
          ];
        }
      }

      $datas['tender_paginate'] = $tenders;
      $datas['employer'] = $employer;
      $datas['address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      $datas['tenders'] = $tender_detail;
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
              'app.meta_url' => url('/tenders/business/'.$url),
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
    return view('front.tender.employer_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Business Account Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Business Account Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'.$url),
              'app.meta_type' => 'Tender',
              
                );
            config($config);
        return  view('front.tender.tender_employer_not_found');
      }
      


  }




   public function detail($tender,Request $request)    
   {

    $layouts= Layout::where('layout_route', 'TendersDetail')->first();
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
      $tender_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $tender_image->tender)) {
       
        $tender_logo = 'image/'.$tender_image->tender;
      } else {
        $tender_logo = '';
      }
      $datas['tender_logo'] = $tender_logo;
      

    $now = Carbon::now()->toDateString(); 
      //$tenders = tenders::where('seo_url', $tender)->where('status', 1)->where('process_status', 1)->where('deadline', '>=', $now)->where('publish_date', '<=', $now)->first();

    $tender = Tender::where('seo_url', $tender)->where('status', 1)->first();
      
      if (isset($tender->id)) {
        $employers = Employers::where('id', $tender->employers_id)->first();
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
              'app.meta_title' => $tender->title,
              'app.meta_keyword' => $tender->title,
              'app.meta_description' => Settings::getLimitedWords($tender->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('tenders/'.$tender->seo_url),
              'app.meta_type' => 'Tender',
              'app.id' => $employer_id,
              
                );
            config($config);
           
              
                   
            
           

          
            $datas['tender'] = $tender;
           
         
            $datas['employer_name'] = $employer_name;
            $datas['employer_href'] = $employer_href;
            $datas['employer_email'] = $employer_email;
            $datas['url'] = url('/tenders/'.$tender->seo_url);
            $datas['employer_logo'] = $meta_image;
            $datas['employer_banner'] = $banner;
            $datas['employer_url'] = $employer_seo_url;
           
            $datas['employer_id'] = $employer_id;
           
            $datas['tender_type'] = TenderType::getTitle($tender->tender_type_id);
          
            $datas['employer_description'] = $employer_description;
            $datas['tender_documents'] = $tender->tenderDocuments;
            $datas['tender_items'] = $tender->tenderItems;
            $datas['related_tender'] = [];
            $related_tenders = Tender::where('employers_id', $employer_id)->where('id', '!=', $tender->id)->where('status', 1)->where('publish_date', '<=', $now)->where('submission_end_date', '>=', $now)->get();
            foreach ($related_tenders as $key => $related) {
               $datas['related_tender'][] = [
                'id' => $related->id,
                'title' => $related->title,
                'employer'        => Employers::getName($related->employers_id),
                'employer_url'    => url('/tenders/business/'.Employers::getUrl($related->employers_id)),
                'logo'            => Employers::getPhoto($related->employers_id),
                'publish_date'    => $related->publish_date,
                'submission_date' => $related->submission_end_date,
                'category'        => TenderType::getTitle($related->tender_type_id),
                'href'            => url('/tenders/'.$related->seo_url),

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
            

         $datas['apply_enable'] = false;
            if (in_array(auth()->guard('employer')->user()->employers_id, \App\Tender::tenderApplyIds($tender->id))) {
              $datas['apply_enable'] = false;
            } else{
              $datas['apply_enable'] = true;
            }

            return view('front.tender.tenderdetails')->with('datas', $datas);

      } else {
        $config = array(
              'app.meta_title' => 'Tender Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Tender Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/Tenders'),
              'app.meta_type' => 'Tender',
              
                );
            config($config);
        return  view('front.tender.tender_not_found');
      }

     

   
   }

   public function categoryTender($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryTender')->first();
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
      $tender_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $tender_image->tender)) {
       
        $tender_logo = 'image/'.$tender_image->tender;
      } else {
        $tender_logo = '';
      }
      $datas['logo'] = asset($tender_logo);
      
      
    
       $category = TenderType::where('seo_url', $url)->first();
    if (isset($category->id)) {
      $date = Carbon::now()->toDateString(); 
      

      $tender_detail = [];
      $tenders = Tender::where('tender_type_id', $category->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($tenders) > 0) {
        foreach ($tenders as $tender) {
         
          if (is_file(DIR_IMAGE.$tender->image)) {
          $thumb = Imagetool::mycrop($tender->image,400,400);
          $image = asset('/image/'.$tender->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($tender->submission_end_date)->diff(Carbon::now())->format('%D:%H:%I');
       $diffs = explode(':', $diff);
       if ($diffs[0] != 0) {
           $difference = $diffs[0].' Days left';
       } elseif ($diffs[1] != 0) {
           $difference = $diffs[1].' Hours left';
       }elseif ($diffs[2] != 0) {
           $difference = $diffs[2].' Minutes left';
       } else {
            $difference = '';
       }

            $submission = Carbon::parse($tender->submission_end_date);
          $tender_detail[] = [
              'id'              => $tender->id,
              'title'           => $tender->title,
              'employer'        => Employers::getName($tender->employers_id),
              'employer_url'    => url('/tenders/business/'.Employers::getUrl($tender->employers_id)),
              'logo'            => Employers::getPhoto($tender->employers_id),
              'publish_date'    => $tender->publish_date,
              'submission_date' => $tender->submission_end_date,
              'category'        => TenderType::getTitle($tender->tender_type_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/tenders/'.$tender->seo_url),
              'tender_code'     => $tender->tender_code,
              'difference'      => $difference,
              'description'     => Settings::getLimitedWords($tender->description,0,20),
              'estimate_cost'   => $tender->estimate_cost,
              'tender_location' => $tender->project_location,
          ];
        }
      }

      
      $datas['category'] = $category;
      
      $datas['tenders'] = $tender_detail;
      $datas['tender_paginate'] = $tenders;
     


      $config = array(
              'app.meta_title' => $category->title,
              'app.meta_keyword' => $category->title,
              'app.meta_description' => $category->title,
              'app.meta_image' => asset($tender_logo),
              'app.meta_url' => url('/tenders/category/'.$url),
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
    return view('front.tender.category_tender')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Tender Category Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Tender Category Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/tenders/category'),
              'app.meta_type' => 'Tender',
              
                );
            config($config);
        return  view('front.tender.tender_category_not_found');
      }
      


  }


   

public function searchTender($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'SearchTender')->first();
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
      $tender_image = $setting->SettingImage;
     

      if (is_file(DIR_IMAGE . $tender_image->tender)) {
       
        $tender_logo = 'image/'.$tender_image->tender;
      } else {
        $tender_logo = '';
      }
      $datas['logo'] = asset($tender_logo);
      
      
    
       
    if (!empty($url)) {
      $date = Carbon::now()->toDateString(); 
      

      $tender_detail = [];
      $tenders = Tender::where('title', 'LIKE', '%'.$url.'%')->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($tenders) > 0) {
        foreach ($tenders as $tender) {
         
          if (is_file(DIR_IMAGE.$tender->image)) {
          $thumb = Imagetool::mycrop($tender->image,400,400);
          $image = asset('/image/'.$tender->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($tender->submission_end_date)->diff(Carbon::now())->format('%D:%H:%I');
       $diffs = explode(':', $diff);
       if ($diffs[0] != 0) {
           $difference = $diffs[0].' Days left';
       } elseif ($diffs[1] != 0) {
           $difference = $diffs[1].' Hours left';
       }elseif ($diffs[2] != 0) {
           $difference = $diffs[2].' Minutes left';
       } else {
            $difference = '';
       }

            $submission = Carbon::parse($tender->submission_end_date);
          $tender_detail[] = [
              'id'              => $tender->id,
              'title'           => $tender->title,
              'employer'        => Employers::getName($tender->employers_id),
              'employer_url'    => url('/tenders/business/'.Employers::getUrl($tender->employers_id)),
              'logo'            => Employers::getPhoto($tender->employers_id),
              'publish_date'    => $tender->publish_date,
              'submission_date' => $tender->submission_end_date,
              'category'        => TenderType::getTitle($tender->tender_type_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/tenders/'.$tender->seo_url),
              'tender_code'     => $tender->tender_code,
              'difference'      => $difference,
              'description'     => Settings::getLimitedWords($tender->description,0,20),
              'estimate_cost'   => $tender->estimate_cost,
              'tender_location' => $tender->project_location,
          ];
        }
      }

      
      $datas['search'] = $url;
      
      $datas['tenders'] = $tender_detail;
      $datas['tender_paginate'] = $tenders;
      
     


      $config = array(
              'app.meta_title' => $url,
              'app.meta_keyword' => $url,
              'app.meta_description' => $url,
              'app.meta_image' => asset($tender_logo),
              'app.meta_url' => url('/tenders/category/'.$url),
              'app.meta_type' => 'category',
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
    return view('front.tender.search_tender')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Tender Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Tender Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/tenders/search'),
              'app.meta_type' => 'Tender',
              
                );
            config($config);
        return  view('front.tender.tender_not_found');
      }
      


  }


   
    
}
