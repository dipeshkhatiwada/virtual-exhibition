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



class EventCategoryController extends Controller
{
     

public function index($id,$setting)
    {

      $datas['title'] = $setting->title;
        $datas['category'] = [];
       
       $categories = EventCategory::inRandomOrder()->limit($setting->limit)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Event::where('event_category_id', $category->id)->where('status', 1)->where('event_date', '<=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/events/category/'.$category->seo_url),
           ];
       }
       



    
        return view('front.module.event_category')->with('datas', $datas);
      
      
       

    }
    
     
     
  
   

}
