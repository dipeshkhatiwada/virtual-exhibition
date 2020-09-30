<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Project;
use App\Employers;
use App\ProjectCategory;
use Carbon\Carbon;
use App\ProjectApply;


class ProjectCategoryController extends Controller
{
     

public function index($id,$setting)
    {

      $datas['title'] = $setting->title;
        $datas['category'] = [];
       
       $categories = ProjectCategory::inRandomOrder()->limit($setting->limit)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Project::where('project_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/projects/category/'.$category->seo_url),
           ];
       }
       



    
        return view('front.module.project_category')->with('datas', $datas);
      
      
       

    }
    
     
     
  
   

}
