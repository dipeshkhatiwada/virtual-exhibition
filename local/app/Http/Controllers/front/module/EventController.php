<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Event;
use App\Employers;
use App\EventCategory;
use Carbon\Carbon;
use App\EventApply;


class EventController extends Controller
{
     

public function index($id,$setting)
    {
      $today = date('Y-m-d');
       /* $datas['category'] = [];
       
       $categories = EventCategory::inRandomOrder()->limit(15)->get();
       
       foreach ($categories as $category) {
        $count = Event::where('event_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/events/category/'.$category->seo_url),
           ];
       } */
       
       $events = Event::where('status', 1)->where('event_date', '>=', $today)->inRandomOrder()->skip(0)->take($setting->limit)->get();
       $datas['events'] = [];
       foreach ($events as $key => $event) {
           if (is_file(DIR_IMAGE.$event->image)) {
             $image = $event->image;
           } else{
            $image = 'no-image.png';
           }
          $datas['events'][] = [
              'id'              => $event->id,
              'title'           => $event->title,
              'title_dis'       => Settings::getLimitedWords($event->title,0,10),
              'image'           => asset(Imagetool::mycrop($image,300,200)),
              'category'        => EventCategory::getTitle($event->event_category_id),
              'href'            => url('/events/'.$event->seo_url),
              'category_href'  => url('/events/category/'.EventCategory::getUrl($event->event_category_id)),
             
          ];
       }
      $datas['title'] = $setting->title;
      $datas['description'] = $setting->description;

      $logo = Settings::getImages()->event;
      $datas['logo'] = Imagetool::mycrop('no-image.png',60,32);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo,120,64);
      } 

      //dd($datas);
     
     
        return view('front.module.event')->with('datas', $datas);
     
      
       

    }
    
     
     
  
   

}
