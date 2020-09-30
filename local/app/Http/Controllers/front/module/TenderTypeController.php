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


class TenderTypeController extends Controller
{
     

public function index($id,$setting)
    {
       
      
        // $tenders = Tender::where('tender_type', $setting->tender_type)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->limit($setting->per_page)->get();
        $today = date('Y-m-d');
           
       $tenders=Tender::where('tender_type_id', $setting->tender_type)->where('status', 1)->where('publish_date', '<=', $today)->where('submission_end_date', '>=', $today)->orderBy('id','desc')->limit($setting->per_page)->get();
        
      $tendertype = TenderType::where('id', $setting->tender_type)->first();
      if (isset($tendertype->id)) {
         
        if(count($tenders) > 0){
           
            $datas = [];
            $datas['title'] = $setting->title;
            
            $datas['href'] = url('/tenders/category/'.$tendertype->seo_url);
            $datas['id'] = $id;
            $datas['tenders'] = [];
            foreach ($tenders as $tender) {
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
             
        if ($setting->design == 1) {
                return view('front.module.tenderfunction')->with('datas', $datas);
              } else{
                return view('front.module.tenderfunction_list')->with('datas', $datas);
              }
        }
        else{
            return '';
        } }else{
            return '';
        }

    }
  

}
