<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Training;
use App\Employers;
use App\TrainingCategory;
use Carbon\Carbon;



class TrainingCategoryController extends Controller
{
     

public function index($id,$setting)
    {

      $datas['title'] = $setting->title;
        $datas['category'] = [];
       
       $categories = TrainingCategory::inRandomOrder()->limit($setting->limit)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Training::where('training_category_id', $category->id)->where('status', 1)->where('end_date', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/trainings/category/'.$category->seo_url),
           ];
       }
       



    
        return view('front.module.training_category')->with('datas', $datas);
      
      
       

    }
    
     
     
  
   

}
