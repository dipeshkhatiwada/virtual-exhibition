<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Jobs;
use App\Saluation;
use App\Employees;
use App\Employers;
use App\library\Settings;
use App\JobCategory;
use App\OrganizationType;
use App\JobLevel;
use App\JobLocation;
use App\JobForm;
use App\JobRequirements;
use App\FormData;
use App\Currency;
use App\EducationLevel;
use App\Faculty;
use App\JobsLocation;
use Carbon\Carbon;
use App\EmployeeEducation;
use App\EmployeeTraining;
use App\EmployeeLanguage;
use App\EmployeeExperience;
use App\EmployeeReference;
use Image;
use File;
use Mail;
use App\library\myFunctions;
use App\TempFile;
use App\JobEducation;
use App\JobExperience;
use App\Layout;

use App\EmployerFollow;
use App\Setting;
use App\Imagetool;
use App\JobType;
use App\Counter;

class JobController extends Controller
{
   public function detail($employer,$job,Request $request)
   {

    $datas['menu_url'] = url('/jobs');
    $datas['menu_logo'] = \App\library\Settings::getJobLogo();
    $datas['tab'] = 'job';

    $layouts= Layout::where('layout_route', 'Jobs_detail')->first();
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
      $views = 0;

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['job_logo'] = $job_logo;

    $now = Carbon::now()->toDateString();
      //$jobs = Jobs::where('seo_url', $job)->where('status', 1)->where('status', 1)->where('deadline', '>=', $now)->where('publish_date', '<=', $now)->first();

    $jobs = Jobs::where('seo_url', $job)->where('status', 1)->first();
      $empnm = '';
      if (isset($jobs->id)) {
           $counter = Counter::where('visit_date', date('Y-m-d'))->where('job_id',$jobs->id)->first();

        if (isset($counter->id)) {
          Counter::where('id',$counter->id)->update(['visits' => $counter->visits + 1]);
        }else{
          Counter::create(['job_id' =>$jobs->id, 'visits' => 1, 'visit_date' => date('Y-m-d')]);
        }


          $views = $jobs->views + 1;
          Jobs::where('id',$jobs->id)->update(['views' => $views]);
        $employers = Employers::where('seo_url', $employer)->first();
        if (isset($employers->id)) {
          $employer_id = $employers->id;
        } else {
          $employer_id = 0;
        }
        if (isset($employers->name)) {
          $employer_name = $employers->name;



            $en = explode(' ',$employers->name);
            if(is_array($en)){
            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }
          }


        } else {
          $employer_name = '';
        }
         if (isset($employers->href)) {
          $employer_href = $employers->href;
        } else {
          $employer_href = '';
        }

        if (isset($employers->seo_url)) {
          $employer_url = $employers->seo_url;
        } else {
          $employer_url = '';
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
        $employer_logo = '';
        if (isset($employers->logo)) {
          if(is_file(DIR_IMAGE.$employers->logo)){
          $meta_image = asset('/image/'.$employers->logo);
          $employer_logo = asset(Imagetool::mycrop($employers->logo, 400,400));
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
        $job_description = JobRequirements::where('jobs_id', $jobs->id)->first();
        $deadl = explode('-', $jobs->deadline);
        $create_date = explode('-', $jobs->created_at);
        //$create = Carbon::create($cre[0],$cre[1],$cre[2])->toFormattedDateString();
        $human = Carbon::create($deadl[0],$deadl[1],$deadl[2])->diffInDays(Carbon::now());

        $dead = Carbon::create($deadl[0],$deadl[1],$deadl[2])->toFormattedDateString();

       $symbol = Currency::getSymbol($jobs->salary_unit);
        $config = array(
              'app.meta_title' => $jobs->title,
              'app.meta_keyword' => $jobs->title,
              'app.meta_description' => Settings::getLimitedWords($job_description->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('jobs/'.$employer.'/'.$job),
              'app.meta_type' => 'Job',
              'app.id' => $employer_id,

                );
            config($config);






            $datas['jobs_location'] = [];
             foreach ($jobs->JobsLocation as $jl) {
                 $datas['jobs_location'][] = JobLocation::where('id', $jl->location_id)->first();
             }
             $fletter = '';
             if($employer_name != '')
             {
                 $fletter = strtolower($employer_name[0]);
             }
            $datas['faculty']  = Faculty::getTitle($jobs->faculty);
            $datas['employer'] = $employers;
            $datas['human'] = $human;
            $datas['job'] = $jobs;
            $datas['job_description'] = $job_description;
           $datas['created'] = $jobs->publish_date;
            $datas['deadline'] = $dead;
            $datas['employer_name'] = $employer_name;
            $datas['employer_href'] = $employer_href;
             $datas['employer_url'] = $employer_url;
            $datas['employer_email'] = $employer_email;
            $datas['url'] = url('jobs/'.$employer.'/'.$job);
            $datas['employer_logo'] = $employer_logo;
            $datas['employer_banner'] = $banner;
            $datas['employer_url'] = $employer;
            $datas['salary'] = $symbol.$jobs->minimum_salary;
            $datas['employer_id'] = $employer_id;
            $datas['job_level'] = JobLevel::getTitle($jobs->job_level);
            $datas['org_type'] = OrganizationType::getOrgTypeTitle($jobs->org_type_id);
            $datas['job_category'] = JobCategory::getTitle($jobs->category_id);
            $datas['education'] = EducationLevel::getTitle($jobs->education_level);
            $datas['employer_description'] = $employer_description;
            $datas['related_jos'] = Jobs::where('employers_id', $employer_id)->where('id', '!=', $jobs->id)->where('status', 1)->where('deadline', '>=', $now)->get();
            $datas['fn'] = $empnm;
                $datas['fletter'] = $fletter;
                $datas['views'] = $views;

            $datas['advertise_left'] = \App\EmployerAdvertise::where('employers_id',$employer_id)->where('place',1)->get();

            $datas['job_education'] = JobEducation::where('jobs_id',$jobs->id)->get();
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

            $datas['notice'] = \App\EmployerNotice::where('employers_id',$employers->id)->where('date', '<=', date('Y-m-d'))->get();
             if ($employers->layout != '') {
              return view('front.jobs.'.$employers->layout)->with('datas', $datas);
            } else{
              return view('front.jobs.default')->with('datas', $datas);
            }


      } else {
        $config = array(
              'app.meta_title' => 'Job Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Job Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url($employer.'/'.$job),
              'app.meta_type' => 'job',

                );
            config($config);
        return  view('front.jobs.job_not_found');
      }




   }


   public function categoryJobs($category,Request $request)
   {

    $layouts= Layout::where('layout_route', 'Jobs_category')->first();
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

      $job_category = JobCategory::where('seo_url',$category)->first();
      $job_category_id = 0;
      if (!isset($job_category->id)) {
        $config = array(
                'app.meta_title' => 'Job Not Found',
                'app.meta_keyword' => '',
                'app.meta_description' => 'Job Not Found',
                'app.meta_image' => '',
                'app.meta_url' => url('/jobs/category/'.$category),
              'app.meta_type' => 'Website',

                  );
              config($config);
          return  view('front.jobs.job_not_found');
      }

    $now = Carbon::now()->toDateString();

    $job_category_id = $job_category->id;

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['logo'] = $job_logo;
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
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)

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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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



      //$jobs = Jobs::where('seo_url', $job)->where('status', 1)->where('process_status', 1)->where('deadline', '>=', $now)->where('publish_date', '<=', $now)->first();
    $datas['jobs'] = [];

    $employers = Jobs::where('category_id', $job_category_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type', 'asc')->groupBy('employers_id')->get();
    foreach ($employers as $key => $employer) {
      $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
                if (!is_file(DIR_IMAGE.$emp->logo)) {
                        $emplogo = 'no-image.png';
                    }else{
                        $emplogo = $emp->logo;
                    }

      //$jobs = Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('status', 1)->where('trash', 0)->where('process_status', 1)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type','asc')->get();
       $empnm = '';
        if(isset($emp->name))
        {
            $en = explode(' ',$emp->name);

            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }

        }


      $datas['jobs'][] = [
                'employer_name' => $emp->name,
                'url' => url('/business/'.$emp->seo_url),
                'logo' => Imagetool::mycrop($emplogo,200,200),
                'seo_url' => $emp->seo_url,
                'fn' => $empnm,
                'fletter' => strtolower($emp->name[0]),
                'jobs' => Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('category_id', $job_category_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type','asc')->get()

      ];


    }


        $config = array(
              'app.meta_title' => $job_category->name,
              'app.meta_keyword' => $job_category->name,
              'app.meta_description' => $job_category->name,
              'app.meta_image' => asset('/image/'.$job_logo),
              'app.meta_url' => url('/jobs/category/'.$job_category->seo_url),
              'app.meta_type' => 'Website',

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

            return view('front.jobs.category_jobs')->with('datas', $datas);





   }

   public function functionJobs($function,Request $request)
   {

    $layouts= Layout::where('layout_route', 'Jobs_function')->first();
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

      $job_function = OrganizationType::where('seo_url',$function)->first();

      $job_function_id = 0;
    if (!isset($job_function->id)) {
      $config = array(
              'app.meta_title' => 'Job Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Job Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/jobs/function/'.$function),
              'app.meta_type' => 'Website',

                );
            config($config);
        return  view('front.jobs.job_not_found');
    }

    $now = Carbon::now()->toDateString();

    $job_function_id = $job_function->id;

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['logo'] = $job_logo;
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
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)

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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

    $datas['jobs'] = [];

    $employers = Jobs::where('org_type_id', $job_function_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type', 'asc')->groupBy('employers_id')->get();
    foreach ($employers as $key => $employer) {
      $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
                if (!is_file(DIR_IMAGE.$emp->logo)) {
                        $emplogo = 'no-image.png';
                    }else{
                        $emplogo = $emp->logo;
                    }

      //$jobs = Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('status', 1)->where('trash', 0)->where('process_status', 1)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type','asc')->get();
       $empnm = '';
        if(isset($emp->name))
        {
            $en = explode(' ',$emp->name);

            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }

        }


      $datas['jobs'][] = [
                'employer_name' => $emp->name,
                'url' => url('/business/'.$emp->seo_url),
                'logo' => Imagetool::mycrop($emplogo,200,200),
                'seo_url' => $emp->seo_url,
                'fn' => $empnm,
                'fletter' => strtolower($emp->name[0]),
                'jobs' => Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('org_type_id', $job_function_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type','asc')->get()

      ];


    }


        $config = array(
              'app.meta_title' => $job_function->name,
              'app.meta_keyword' => $job_function->name,
              'app.meta_description' => $job_function->name,
              'app.meta_image' => $job_logo,
              'app.meta_url' => url('jobs/function/'.$job_function->seo_url),
              'app.meta_type' => 'Website',
              'app.id' => $job_function->id,

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

            return view('front.jobs.category_jobs')->with('datas', $datas);





   }

   public function locationJobs($location,Request $request)
   {

    $layouts= Layout::where('layout_route', 'Jobs_location')->first();
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

      $job_location = JobLocation::where('seo_url',$location)->first();

      $job_location_id = 0;
    if (!isset($job_location->id)) {
      $config = array(
              'app.meta_title' => 'Job Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Job Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/jobs/location/'.$location),
              'app.meta_type' => 'Website',

                );
            config($config);
        return  view('front.jobs.job_not_found');
    }

    $now = Carbon::now()->toDateString();

    $job_location_id = $job_location->id;

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['logo'] = $job_logo;
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
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)

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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

    $datas['jobs'] = [];

    $location_job = \DB::table('jobs_location as jsl');
                    $location_job->leftJoin('jobs as j', 'jsl.jobs_id', '=', 'j.id');
                    $location_job->where('j.trash', 0)->where('j.status', 1)->where('j.publish_date', '<=', $now)->where('j.deadline', '>=', $now);

                    $location_job->where('jsl.location_id', $job_location_id);



    $employers = $location_job->orderBy('j.job_type', 'asc')->groupBy('j.employers_id')->get();
    foreach ($employers as $key => $employer) {
      $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
      $emplogo = '';
                if (is_file(DIR_IMAGE.$emp->logo)) {
                        $emplogo = Imagetool::mycrop($emp->logo,200,200);
                    }

      $ljobs = \DB::table('jobs_location as jsl')->select('j.title','j.seo_url');
                    $ljobs->leftJoin('jobs as j', 'jsl.jobs_id', '=', 'j.id');
                    $ljobs->where('j.employers_id', $emp->id)->where('j.trash', 0)->where('j.status', 1)->where('j.publish_date', '<=', $now)->where('j.deadline', '>=', $now);

                    $ljobs->where('jsl.location_id', $job_location_id);



    $jobsl = $ljobs->orderBy('j.job_type', 'asc')->get();

     $empnm = '';
        if(isset($emp->name))
        {
            $en = explode(' ',$emp->name);

            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }

        }

      $datas['jobs'][] = [
                'employer_name' => $emp->name,
                'url' => url('/business/'.$emp->seo_url),
                'logo' => $emplogo,
                'seo_url' => $emp->seo_url,
                'jobs' => $jobsl,
                'fn' => $empnm,
                'fletter' => strtolower($emp->name[0]),

      ];


    }


        $config = array(
              'app.meta_title' => $job_location->name,
              'app.meta_keyword' => $job_location->name,
              'app.meta_description' => $job_location->name,
              'app.meta_image' => $job_logo,
              'app.meta_url' => url('jobs/location/'.$location),
              'app.meta_type' => 'Website',
              'app.id' => $job_location->id,

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

            return view('front.jobs.category_jobs')->with('datas', $datas);





   }


    public function typesJobs($type,Request $request)
   {

    $layouts= Layout::where('layout_route', 'Jobs_type')->first();
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

      $job_type = JobType::where('seo_url',$type)->first();

      $job_type_id = 0;
      if (!isset($job_type->id)) {
        $config = array(
                'app.meta_title' => 'Job Not Found',
                'app.meta_keyword' => '',
                'app.meta_description' => 'Job Not Found',
                'app.meta_image' => '',
                'app.meta_url' => url('/jobs/types/'.$type),
              'app.meta_type' => 'Website',

                  );
              config($config);
          return  view('front.jobs.job_not_found');
      }

    $now = Carbon::now()->toDateString();

    $job_type_id = $job_type->id;

       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['logo'] = $job_logo;
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
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)

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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

    $datas['jobs'] = [];

    $employers = Jobs::where('job_type', $job_type_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type', 'asc')->groupBy('employers_id')->get();
    foreach ($employers as $key => $employer) {
      $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
                if (!is_file(DIR_IMAGE.$emp->logo)) {
                        $emplogo = '';
                    }else{
                        $emplogo = $emp->logo;
                    }
        $empnm = '';
        if(isset($emp->name))
        {
            $en = explode(' ',$emp->name);

            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }

        }
      //$jobs = Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('status', 1)->where('trash', 0)->where('process_status', 1)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->orderBy('job_type','asc')->get();

      $datas['jobs'][] = [
                'employer_name' => $emp->name,
                'url' => url('/business/'.$emp->seo_url),
                'logo' => Imagetool::mycrop($emplogo,200,200),
                'seo_url' => $emp->seo_url,
                'fn' => $empnm,
                'fletter' => strtolower($emp->name[0]),
                'jobs' => Jobs::select('title','seo_url')->where('employers_id', $emp->id)->where('job_type', $job_type_id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $now)->where('deadline', '>=', $now)->get()

      ];


    }


        $config = array(
              'app.meta_title' => $job_type->title,
              'app.meta_keyword' => $job_type->title,
              'app.meta_description' => $job_type->title,
              'app.meta_image' => asset('/image/'.$job_logo),
              'app.meta_url' => url('/jobs/category/'.$job_type->seo_url),
              'app.meta_type' => 'Website',

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

            return view('front.jobs.category_jobs')->with('datas', $datas);





   }


   public function searchJob(Request $request)
   {

        $layouts= Layout::where('layout_route', 'Jobs_search')->first();
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



    $now = Carbon::now()->toDateString();



       $setting = Setting::orderBy('id', 'desc')->first();
      $job_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $job_image->job)) {

        $job_logo = 'image/'.$job_image->job;
      } else {
        $job_logo = '';
      }
      $datas['logo'] = $job_logo;
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
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)

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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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

           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $now)->where('jobs.deadline', '>=', $now)
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




    $meta_title = '';
        $datas['jobs'] = [];
        $url = '?';

    $search = \DB::table('jobs as j');
    if (isset($request->location)) {
      $search->leftJoin('jobs_location as jsl', 'jsl.jobs_id', '=', 'j.id');
    }
    $search->select('j.*');
    if (isset($request->location)) {
      $search->where('jsl.location_id', $request->location);
      $meta_title = JobLocation::getName($request->location);
      $url .= '&location='.$request->location;
    }
    if (isset($request->category)) {
      $search->where('j.category_id', $request->category);
      $meta_title = JobCategory::getTitle($request->category);
      $url .= '&category='.$request->category;
    }

    if (isset($request->keyword)) {
      $search->where('j.title', 'LIKE', '%'.$request->keyword.'%');
      $meta_title = $request->keyword;
      $url .= '&keyword='.$request->keyword;
    }



    $employers = $search->where('j.status', 1)->where('j.trash', 0)->where('j.publish_date', '<=', $now)->where('j.deadline', '>=', $now)->orderBy('j.job_type', 'asc')->groupBy('j.employers_id')->get();
    foreach ($employers as $key => $employer) {
      $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
                if (!is_file(DIR_IMAGE.$emp->logo)) {
                        $emplogo = '';
                    }else{
                        $emplogo = $emp->logo;
                    }
      $job = \DB::table('jobs as j');
        if (isset($request->location)) {
          $job->leftJoin('jobs_location as jsl', 'jsl.jobs_id', '=', 'j.id');
        }
        $job->select('j.title','j.seo_url');
        if (isset($request->location)) {
          $job->where('jsl.location_id', $request->location);
        }
        if (isset($request->category)) {
          $job->where('j.category_id', $request->category);
        }

        if (isset($request->keyword)) {
          $job->where('j.title', 'LIKE', '%'.$request->keyword.'%');
        }



        $jobs = $job->where('j.employers_id', $emp->id)->where('j.status', 1)->where('j.trash', 0)->where('j.publish_date', '<=', $now)->where('j.deadline', '>=', $now)->orderBy('j.job_type', 'asc')->get();

         $empnm = '';
        if(isset($emp->name))
        {
            $en = explode(' ',$emp->name);

            foreach($en as $key => $ens)
            {
                if($key < 2){
                $empnm .= strtoupper(substr($ens,0,1));
                }
            }

        }

      $datas['jobs'][] = [
                'employer_name' => $emp->name,
                'url' => url('/business/'.$emp->seo_url),
                'logo' => Imagetool::mycrop($emplogo,200,200),
                'seo_url' => $emp->seo_url,
                'jobs' => $jobs,
                'fn' => $empnm,
                'fletter' => strtolower($emp->name[0]),

      ];


    }


        $config = array(
              'app.meta_title' => $meta_title,
              'app.meta_keyword' => $meta_title,
              'app.meta_description' => $meta_title,
              'app.meta_image' => asset('/image/'.$job_logo),
              'app.meta_url' => url('/jobs/search/'.$url),
              'app.meta_type' => 'Website',

                );
            config($config);
    //dd($datas);

    if (count($datas['jobs']) == 0) {
    return  view('front.jobs.job_not_found');
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

            return view('front.jobs.search_jobs')->with('datas', $datas);





   }


   public function JobCategories(Request $request)
   {

      $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'JobCategory')->first();
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
              'app.meta_title' => 'Rolling Jobs Category',
              'app.meta_keyword' => 'Rolling Jobs Category',
              'app.meta_description' => 'Rolling Nexus Jobs - An online job search engine for the job seekers in Nepal. The common search engine for job seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->job),
              'app.meta_url' => url('/jobs/categories'),
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

        $datas['categories'] = [];


        $categories = JobCategory::orderBy('name','asc')->get();
        foreach ($categories as $category) {
        $totaljob = Jobs::where('category_id', $category->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->count();
        $datas['categories'][] = [
            'name' => $category->name,
            'href' => url('/jobs/category/'.$category->seo_url),
            'total' => $totaljob
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

        return view('front.jobs.jobs_category')->with('datas', $datas);

    }



    public function getfaculty(Request $request)
    {
        if (isset($request->id)) {
            $datas = \App\Faculty::where('level_id', $request->id)->orderBy('name', 'asc')->get();

            return view('admin.faculty.faculties')->with('datas', $datas);
        }
    }



}
