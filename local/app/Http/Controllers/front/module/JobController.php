<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Jobs;
use App\Employers;
use App\JobType;
use App\JobCategory;
use App\JobLocation;

class JobController extends Controller
{
     

public function index($id,$setting)
    {
       
       $categories = JobCategory::inRandomOrder()->limit(7)->get();
       $today = date('Y-m-d');
       foreach ($categories as $category) {
        $count = Jobs::where('category_id', $category->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();
           $datas['category'][] = [
            'title' => $category->name,
            'total' => $count,
            'url' => url('/jobs/category/'.$category->seo_url),
           ];
       }
        $datas['locations'] = JobLocation::orderBy('name','asc')->get();
        $datas['categories'] = JobCategory::orderBy('name', 'asc')->get();
       $datas['job_type'] = [];
       $types=JobType::orderBy('id','asc')->get();
        foreach ($types as $type) {
           // $jobcount = Jobs::where('job_type', $type->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();

            $jobcount = Jobs::where('job_type', $type->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->count();
            if ($jobcount > 0) {
                //$employers = Jobs::select('employers_id')->where('job_type', $type->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->inRandomOrder()->limit(2)->get();

                 $employers = Jobs::select('employers_id')->where('job_type', $type->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->groupBy('employers_id')->inRandomOrder()->skip(0)->take(2)->get();
                 //dd($employers);
                 $jobs = [];
                foreach ($employers as $employer) {
                    $emp = Employers::select('id','name','seo_url','logo')->where('id', $employer->employers_id)->first();
                   // $emjob = Jobs::select('title','seo_url')->where('job_type', $type->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->get();

                    $emjob = Jobs::select('title','seo_url')->where('job_type', $type->id)->where('employers_id', $emp->id)->where('status', 1)->where('publish_date', '<=', $today)->where('deadline', '>=', $today)->get();
                    if (empty($emp->logo)) {
                        $logo = '';
                    }else{
                        $logo = $emp->logo;
                    }
                     $empnm = '';
                    if(isset($emp->name))
                    {
                        $en = explode(' ',$emp->name);
                        
                        foreach($en as $key => $ens)
                        {
                            if($key < 2){
                            $empnm .= strtoupper(substr($ens,0,1));
                            }
                        }
                        
                    }
                    $jobs[] = [
                        'employer_name' => $emp->name,
                        'url' => url('/business/'.$emp->seo_url),
                        'logo' => Imagetool::mycrop($logo,50,50),
                        'seo_url' => $emp->seo_url,
                        'jobs' => $emjob,
                        'fn' => $empnm,
                        'fletter' => strtolower($emp->name[0]),
                    ];
                }
                if (empty($type->icon)) {
                    $type_icon = '';
                } else{
                    $type_icon = asset('/image/'.$type->icon);
                }
                $datas['job_type'][] = [
                    'title' => $type->title,
                    'image' => $type_icon,
                    'url' => url('/jobs/types/'.$type->seo_url),
                    'employer' => $jobs
                ];
            }
        }
        

        $logo = Settings::getImages()->job;
      $datas['logo'] = Imagetool::mycrop('no-image.png',60,32);
      if (is_file(DIR_IMAGE.$logo)) {
          $datas['logo'] = Imagetool::mycrop($logo,120,64);
      } 
      
       return view('front.module.jobs')->with('datas', $datas);

    }
    
     
     
  
   

}
