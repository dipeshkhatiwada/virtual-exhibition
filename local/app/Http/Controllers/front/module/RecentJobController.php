<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\Employers;




class RecentJobController extends Controller
{
     

public function index($id,$setting)
    {
       
      

       $jobs=Jobs::where('status', 1)->orderBy('publish_date', 'asc')->groupBy('employers_id')->get();
        
      
        if(count($jobs) > 0){
           
            $datas = [];
            $datas['title'] = $setting->title;
            $datas['id'] = $id;
            $i = 1;
            foreach ($jobs as $job) {
              $employers = Employers::where('id', $job->employers_id)->first();
               $datas['employers'][] = [
                'employer_name' => $employers->name,
                'employer_url' => $employers->seo_url,
                'logo' => Imagetool::mycrop($employers->logo,60,60),
                'jobs' => $employers->Jobs,
               ];
               if ($setting->per_page == $i) {
                   break;
               }
               $i++;
               
            }
             
        return view('front.module.recentjob')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
