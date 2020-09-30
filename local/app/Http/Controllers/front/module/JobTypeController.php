<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\Employers;
use App\JobType;




class JobTypeController extends Controller
{
     

public function index($id,$setting)
    {
       
      $today = date('Y-m-d');
        // $jobs = Jobs::where('job_type', $setting->job_type)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->limit($setting->per_page)->get();

           
       $jobs=Jobs::where('job_type', $setting->job_type)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->limit($setting->per_page)->get();
        
      $jobtype = JobType::where('id', $setting->job_type)->first();
      if (isset($jobtype->id)) {
         
        if(count($jobs) > 0){
           
            $datas = [];
            $datas['title'] = $setting->title;
            $datas['image'] = '';
            if (!empty($jobtype->icon)) {
            $datas['image'] = asset('/image/'.$jobtype->icon);
            }
            $datas['href'] = url('/jobs/types/'.$jobtype->seo_url);
            $datas['id'] = $id;
            $datas['employers'] = [];
            foreach ($jobs as $job) {
              $employers = Employers::select('id','name','seo_url','logo')->where('id', $job->employers_id)->first();
              // $emjob = Jobs::select('title','seo_url')->where('job_type', $jobtype->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->get();

                $emjob = Jobs::select('title','seo_url')->where('job_type', $jobtype->id)->where('employers_id', $employers->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->get();

                if ($employers->logo == '') {
                        $logo = '';
                    }else{
                        $logo = $employers->logo;
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
                'logo' => Imagetool::mycrop($logo,200,200),
                'seo_url' => $employers->seo_url,
                'jobs' => $emjob,
                'fn' => $empnm,
                'fletter' => strtolower($employers->name[0]),
               ];
               
            }
             
        return view('front.module.JobType')->with('datas', $datas);
        }
        else{
            return '';
        } }else{
            return '';
        }

    }
  

}
