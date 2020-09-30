<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;

use App\Employers;
use App\library\Settings;
use App\Setting;
use App\OrganizationType;
use App\EventInvoiceStatus;
use App\Comment;
use Carbon\Carbon;

use Image;
use File;
use Mail;
use App\library\myFunctions;

use App\Layout;
use GMaps;
use App\EmployerFollow;
use App\Event;
use App\EventPhoto;
use App\EventSponsor;
use App\EventCategory;

use App\Imagetool;
use App\EmployerAddress;
use App\Enroll;
use App\Category;


class EventsController extends Controller
{

  public function index(Request $request)
  {
        $date = Carbon::now()->toDateString();
        $layouts= Layout::where('layout_route', 'Events')->first();
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
              'app.meta_title' => 'Rolling Event',
              'app.meta_keyword' => 'Rolling Event, Rolling Plans, Event in nepal, nepalese event market, vacancy, online event, work in nepal, employment in nepal, career nepal, employment nepal, nepal event market, nepali event market, event sites in nepal, event nepal, nepal event, nepalEventite, nepal event site, nepaliEventite, nepali event site, vacancy in nepal, vacancies in nepal, career in nepal,  naukari, jagir, jaagir, naukri, nokari, nepal and Event, Event and nepal, nepal online Event, Event nepal, nepal Event, nepali Event, event in nepal, nepali event, event opportunity in nepal, find a event in nepal, find Event in nepal, it Event nepal, Eventnepal, nepalEvent, rojgaar nepal, ramro kaam nepal, ramro jagir, ramro jaagir, ramro event, high paying event, Event for students, student event',
              'app.meta_description' => 'Rolling Nexus Event - An online event search engine for the event seekers in Nepal. The common search engine for event seekers, recruiters and employers.',
              'app.meta_image' => asset('/image/'.$images->event),
              'app.meta_url' => url('/events'),
              'app.meta_type' => 'Event',

                );
            config($config);

    $setting = Setting::orderBy('id', 'desc')->first();
      $image = $setting->SettingImage;


    if (is_file(DIR_IMAGE . $image->event)) {

      $logo = 'image/'.$image->event;
    } else {
      $logo = '';
    }
    $datas['logo'] = $logo;

    $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;

    $datas['events'] = Event::where('status', 1)->paginate(50);

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
    // $enroll_type = Enroll::get();
    return view('front.event.index', compact('datas'));
  }



  public function employer($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'EventsEmployers')->first();
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
      $event_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $event_image->event)) {

        $event_logo = 'image/'.$event_image->event;
      } else {
        $event_logo = '';
      }
      $datas['event_logo'] = $event_logo;



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

      $event_detail = [];
      $events = Event::where('employers_id', $employer->id)->where('status', 1)->where('event_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($events) > 0) {
        foreach ($events as $event) {

          if (is_file(DIR_IMAGE.$event->image)) {
          $thumb = Imagetool::mycrop($event->image,400,400);
          $image = asset('/image/'.$event->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($event->event_date)->diff(Carbon::now())->format('%D:%H:%I');
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

            $submission = Carbon::parse($event->event_date);
          $event_detail[] = [
              'id'              => $event->id,
              'title'           => $event->title,
              'employer'        => Employers::getName($event->employers_id),
              'employer_url'    => url('/events/business/'.Employers::getUrl($event->employers_id)),

              'event_date' => $event->event_date,
              'category'        => EventCategory::getTitle($event->event_category_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/events/'.$event->seo_url),

              'difference'      => $difference,


              'venue' => $event->venue,
          ];
        }
      }


      $datas['employer'] = $employer;
      $datas['address'] = EmployerAddress::where('employers_id', $employer->id)->first();
      $datas['events'] = $event_detail;
      $datas['event_render'] = $events;
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
              'app.meta_url' => url('/events/business/'.$url),
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
    return view('front.event.employer_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Business Account Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Business Account Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'.$url),
              'app.meta_type' => 'Event',

                );
            config($config);
        return  view('front.event.employer_not_found');
      }



  }




   public function detail($seo_url,Request $request)
   {

    $layouts= Layout::where('layout_route', 'EventsDetail')->first();
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
      $event_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $event_image->event)) {

        $event_logo = 'image/'.$event_image->event;
      } else {
        $event_logo = '';
      }
      $datas['event_logo'] = $event_logo;
      $datas['address'] = $setting->address;
    $datas['phone'] = $setting->telephone;

    $now = Carbon::now()->toDateString();
      //$events = events::where('seo_url', $event)->where('status', 1)->where('process_status', 1)->where('deadline', '>=', $now)->where('publish_date', '<=', $now)->first();

    $event = Event::where('seo_url', $seo_url)->with('eventMeeting', 'eventReservation', 'eventTicketType', 'reviews.employee', 'reviews.employer')->where('status', 1)->first();
      if (isset($event->id)) {
        $employers = Employers::where('id', $event->employers_id)->first();
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

        if (is_file(DIR_IMAGE.$event->image)) {
          $meta_image = '/image'.$event->image;
          $datas['image'] = 'image/'.$event->image;
        }else{
          $meta_image = '';
          $datas['image'] = '';
        }

        $config = array(
              'app.meta_title' => $event->title,
              'app.meta_keyword' => $event->title,
              'app.meta_description' => Settings::getLimitedWords($event->description,0,25),
              'app.meta_image' => $meta_image,
              'app.meta_url' => url('events/'.$event->seo_url),
              'app.meta_type' => 'Event',
              'app.id' => $employer_id,

                );
            config($config);







            $datas['event'] = $event;

            // if (!empty($event->latitute) && !empty($event->longitute)) {
            //     $config['center'] = $event->latitute.','.$event->longitute;
            //     $config['zoom'] = '16';
            //     $config['map_height'] = '300px';
            //     $config['trafficOverlay'] = TRUE;
            //     $config['panoramio'] = TRUE;
            //     $config['panoramioTag'] = 'sunset';
            //     GMaps::initialize($config);
            //         $marker = array();
            //         $marker['position'] = $event->latitute.','.$event->longitute;
            //         $marker['infowindow_content'] = $event->venue;

            //         $marker['animation'] = 'DROP';
            //         GMaps::add_marker($marker);
            //      $datas['map'] = GMaps::create_map();
            //  }


            $datas['related'] = Event::where('event_category_id', $event->event_category_id)->where('id', '!=', $event->id)->orderBy('id','desc')->limit(6)->get();


            $datas['employer_name'] = $employer_name;
            $datas['employer_href'] = $employer_href;
            $datas['employer_email'] = $employer_email;
            $datas['url'] = url('/events/'.$event->seo_url);

            $datas['employer_banner'] = $banner;
            $datas['employer_url'] = $employer_seo_url;

            $datas['employer_id'] = $employer_id;

            $datas['event_category'] = EventCategory::getTitle($event->event_category_id);

            $datas['employer_description'] = $employer_description;




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

            $event_reserved = null;
            $employee_event_invoice_status = null;
            if(isset(Auth::guard('employee')->user()->firstname))
            {
              $event_reserved = Auth::guard('employee')->user()->load('eventReservation')
              ->eventReservation->filter(function($reservation) use ($datas) {
                return $reservation->event_id == $datas['event']->id;
              })->first();

              $eventInvoiceStatus = $employee_event_invoice_status = Auth::guard('employee')->user()
                ->load(['eventInvoiceStatus' => function ($query) use ($datas) {
                    $query->where('event_id', $datas['event']->id)
                    ->where('employee_id',Auth::guard('employee')->user()->id);
                  }
                ])
                ->eventInvoiceStatus;
              if( $eventInvoiceStatus != null){
                $employee_event_invoice_status = $eventInvoiceStatus->invoice_status;
              }
              // dd($employee_event_invoice_status);
            }
            $comments = Comment::where('event_id', $event->id)->with('employer', 'employee', 'replies.employee', 'replies.employer')->get();
            // dd($comments);
            $datas['event']['event_reserved'] = $event_reserved != null ?  1:0;
            $datas['event']['invoice_status'] = $employee_event_invoice_status;
            $datas['event']['current_dt'] = Carbon::now();
            $datas['event']['comment'] = $comments;
            $datas['event']['avgRatings'] = $event->ratings()->avg('rating');
            return view('front.event.eventdetails')->with('datas', $datas);

      } else {
        $config = array(
              'app.meta_title' => 'Event Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Event Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/events'),
              'app.meta_type' => 'Event',

                );
            config($config);
        return  view('front.event.event_not_found');
      }




   }


   public function categoryEvent($url, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'CategoryEvents')->first();
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
      $event_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $event_image->event)) {

        $event_logo = 'image/'.$event_image->event;
      } else {
        $event_logo = '';
      }
      $datas['event_logo'] = $event_logo;



       $category = EventCategory::where('seo_url', $url)->first();
    if (isset($category->id)) {
      $date = Carbon::now()->toDateString();

      $event_detail = [];
      $events = Event::where('event_category_id', $category->id)->where('status', 1)->where('event_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($events) > 0) {
        foreach ($events as $event) {

          if (is_file(DIR_IMAGE.$event->image)) {
          $thumb = Imagetool::mycrop($event->image,400,400);
          $image = asset('/image/'.$event->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($event->event_date)->diff(Carbon::now())->format('%D:%H:%I');
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

            $submission = Carbon::parse($event->event_date);
          $event_detail[] = [
              'id'              => $event->id,
              'title'           => $event->title,
              'employer'        => Employers::getName($event->employers_id),
              'employer_url'    => url('/events/business/'.Employers::getUrl($event->employers_id)),

              'event_date' => $event->event_date,
              'category'        => EventCategory::getTitle($event->event_category_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/events/'.$event->seo_url),

              'difference'      => $difference,


              'venue' => $event->venue,
          ];
        }
      }


      $datas['category'] = $category;

      $datas['events'] = $event_detail;
      $datas['event_render'] = $events;






      $config = array(
              'app.meta_title' => $category->name,
              'app.meta_keyword' => $category->name,
              'app.meta_description' => Settings::getLimitedWords($category->description,0,25),
              'app.meta_image' => $event_logo,
              'app.meta_url' => url('/events/category/'.$url),
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
    return view('front.event.category_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Event Category Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Event Category Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/events/category'),
              'app.meta_type' => 'Event',

                );
            config($config);
        return  view('front.event.event_category_not_found');
      }



  }


  public function searchEvent($search, Request $request)
  {
     $date = Carbon::now()->toDateString();
      $layouts= Layout::where('layout_route', 'SearchEvents')->first();
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
      $event_image = $setting->SettingImage;


      if (is_file(DIR_IMAGE . $event_image->event)) {

        $event_logo = 'image/'.$event_image->event;
      } else {
        $event_logo = '';
      }
      $datas['event_logo'] = $event_logo;




    if ($search != '') {
      $date = Carbon::now()->toDateString();

      $event_detail = [];
      $events = Event::where('title', 'LIKE',  '%'.$search.'%')->where('status', 1)->where('event_date', '>=', $date)->orderBy('id', 'desc')->paginate(20);
      if (count($events) > 0) {
        foreach ($events as $event) {

          if (is_file(DIR_IMAGE.$event->image)) {
          $thumb = Imagetool::mycrop($event->image,400,400);
          $image = asset('/image/'.$event->image);
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          $image = asset('/image/no-image.png');
        }


        $diff = Carbon::parse($event->event_date)->diff(Carbon::now())->format('%D:%H:%I');
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

            $submission = Carbon::parse($event->event_date);
          $event_detail[] = [
              'id'              => $event->id,
              'title'           => $event->title,
              'employer'        => Employers::getName($event->employers_id),
              'employer_url'    => url('/events/business/'.Employers::getUrl($event->employers_id)),

              'event_date' => $event->event_date,
              'category'        => EventCategory::getTitle($event->event_category_id),
              'thumb'           => $thumb,
              'image'           => $image,
              'href'            => url('/events/'.$event->seo_url),

              'difference'      => $difference,


              'venue' => $event->venue,
          ];
        }
      }


      $datas['search'] = $search;

      $datas['events'] = $event_detail;
      $datas['event_render'] = $events;






      $config = array(
              'app.meta_title' => $search,
              'app.meta_keyword' => $search,
              'app.meta_description' => $search,
              'app.meta_image' => $event_logo,
              'app.meta_url' => url('/events/search/'.$search),
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
    return view('front.event.search_detail')->with('datas', $datas);


    } else {
       $config = array(
              'app.meta_title' => 'Event Not Found',
              'app.meta_keyword' => '',
              'app.meta_description' => 'Event Not Found',
              'app.meta_image' => '',
              'app.meta_url' => url('/'),
              'app.meta_type' => 'Event',

                );
            config($config);
        return  view('front.event.event_not_found');
      }



  }




}
