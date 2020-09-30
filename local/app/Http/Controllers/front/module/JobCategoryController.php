<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\JobCategory;


class JobCategoryController extends Controller
{
     

public function index($id,$setting)
    {

 $today = date('Y-m-d');
       $datas['title'] = $setting->title;
      $categories = JobCategory::leftJoin('jobs','job_category.id','=','jobs.category_id')
           ->selectRaw('job_category.*, count(jobs.id) AS `count`')
           
           ->where('jobs.status', 1)->where('jobs.trash', 0)->where('jobs.publish_date', '<=', $today)->where('jobs.deadline', '>=', $today)
          ->groupBy('job_category.id')
           ->orderBy('count','DESC')
           ->skip(0)->take(7)->get();

    foreach ($categories as $category) {
       
      $datas['category'][] = [
        'title' => $category->name,
        'url' => url('/jobs/category/'.$category->seo_url),
        'total' => $category->count,
        
      ];
    }
       
       
      
       return view('front.module.jobcategory')->with('datas', $datas);

    }
    
     
     
  
   

}
