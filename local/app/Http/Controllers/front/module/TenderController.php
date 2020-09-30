<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Tender;
use App\Employers;
use App\TenderType;
use Carbon\Carbon;


class TenderController extends Controller
{
     

public function index($id,$setting)
    {
        $datas['category'] = [];
       
       $categories = TenderType::inRandomOrder()->limit(15)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Tender::where('tender_type_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->where('submission_end_date', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->title,
            'total' => $count,
            'url' => url('/tenders/category/'.$category->seo_url),
           ];
       }
       
       $tenders = Tender::where('status', 1)->where('publish_date', '<=', $today)->where('submission_end_date', '>=', $today)->inRandomOrder()->skip(0)->take($setting->limit)->get();
       //dd($tenders);
       $datas['tenders'] = [];
       foreach ($tenders as $key => $tender) {
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
          $datas['tenders'][] = [
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
      $datas['title'] = $setting->title;
      $datas['description'] = $setting->description;

      $logo = Settings::getImages()->tender;
      $datas['logo'] = Imagetool::mycrop('no-image.png',120,64);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo,120,64);
      } 

       if ($setting->design == 1) {
        return view('front.module.tender')->with('datas', $datas);
      } else{
        return view('front.module.tender_list')->with('datas', $datas);
      }
      
       

    }
    
     
     
  
   

}
