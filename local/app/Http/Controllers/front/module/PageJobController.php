<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\Employers;
use App\JobType;




class PageJobController extends Controller
{
     

public function index($id,$setting)
    {
       
      $today = date('Y-m-d');
        // $jobs = Jobs::where('job_type', $setting->job_type)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->limit($setting->per_page)->get();

           
       $jobs=Jobs::select('employers_id')->where('page', $setting->category)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->get();
        
      
         
        if(count($jobs) > 0){
           
            $datas = [];
            $datas['title'] = $setting->title;
            $datas['id'] = $id;
            foreach ($jobs as $job) {
              $employers = Employers::select('id','name','seo_url','logo')->where('id', $job->employers_id)->first();
              $emjob = Jobs::select('title','seo_url')->where('page', $setting->category)->where('employers_id', $employers->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->get();
              $logo = Imagetool::mycrop('image/noimg.jpg',200,200);
              if (is_file(DIR_IMAGE.$employers->logo)) {
                  $logo = Imagetool::mycrop($employers->logo,200,200);
              }
              
               $empnm = '';
                    if(isset($employers->name))
                    {
                        $en = explode(' ',$employers->name);
                        
                        foreach($en as $key => $ens)
                        {
                            if($key < 2){
                            $empnm .= strtoupper(substr($ens,0,1));
                            }
                        }
                        
                    }
               $datas['employers'][] = [
                'employer_name' => $employers->name,
                'url' => url('/business/'.$employers->seo_url),
                'logo' => $logo,
                'seo_url' => $employers->seo_url,
                'jobs' => $emjob,
                'fn' => $empnm,
                'fletter' => strtolower($employers->name[0]),
               ];
               
            }
             
        return view('front.module.jobpage')->with('datas', $datas);
        }
        else{
            return '';
        } 

    }
  

}
