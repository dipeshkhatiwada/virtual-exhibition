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

class CategoryeventController extends Controller
{
     
public function index($id,$setting)
    {

      $datas['title'] = $setting->title;
        $datas['events'] = [];
        $today = date('Y-m-d');
       $events = Event::where('event_category_id', $setting->category)->where('status', 1)->where('event_date', '>=', $today)->limit($setting->limit)->get();
      
       foreach ($events as $event) {
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
        if (is_file(DIR_IMAGE.$event->image)) {
          $thumb = Imagetool::mycrop($event->image,400,280);
        
        } else{
          $thumb = Imagetool::mycrop('no-image.png', 300,300);
          
        }
        
           $datas['events'][] = [
              'title'           => $event->title,
              'employer'        => Employers::getName($event->employers_id),
              'employer_url'    => url('/events/business/'.Employers::getUrl($event->employers_id)),
              
              'event_date' => $event->event_date,
              'category'        => EventCategory::getTitle($event->event_category_id),
              'thumb'           => $thumb,
              
              'href'            => url('/events/'.$event->seo_url),
              
              'difference'      => $difference,
              
              'address'     => $event->address,
              'venue' => $event->venue,
              'category_href'  => url('/events/category/'.EventCategory::getUrl($event->event_category_id)),
           ];
       }
    
        return view('front.module.category_event')->with('datas', $datas);
    }
}
