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
use App\TrainingApply;


class TrainingController extends Controller
{
     

public function index($id,$setting)
    {
      $today = date('Y-m-d');
       /* $datas['category'] = [];
       
       $categories = TrainingCategory::inRandomOrder()->limit(15)->get();
       
       foreach ($categories as $category) {
        $count = Training::where('training_category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/trainings/category/'.$category->seo_url),
           ];
       } */
       
       $trainings = Training::where('status', 1)->where('end_date', '>=', $today)->inRandomOrder()->skip(0)->take($setting->limit)->get();
       $datas['trainings'] = [];
       foreach ($trainings as $key => $training) {
           if (is_file(DIR_IMAGE.$training->image)) {
             $image = $training->image;
           } else{
            $image = 'no-image.png';
           }
          $datas['trainings'][] = [
              'id'              => $training->id,
              'title'           => $training->title,
              'title_dis'       => Settings::getLimitedWords($training->title,0,10),
              'description'     => Settings::getLimitedWords($training->description,0,20),
              'image'           => asset(Imagetool::mycrop($image,300,150)),
              'category'        => TrainingCategory::getTitle($training->training_category_id),
              'href'            => url('/trainings/'.$training->seo_url),
              'category_href'  => url('/trainings/category/'.TrainingCategory::getUrl($training->training_category_id)),
             
          ];
       }
      $datas['title'] = $setting->title;
      $datas['description'] = $setting->description;

      $logo = Settings::getImages()->training;
      $datas['logo'] = Imagetool::mycrop('no-image.png',60,32);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo,120,64);
      } 



     
        return view('front.module.training')->with('datas', $datas);
     
      
       

    }
    
     
     
  
   

}
