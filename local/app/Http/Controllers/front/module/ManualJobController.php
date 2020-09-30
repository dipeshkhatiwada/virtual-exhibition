<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Employers;
use App\Jobs;
use Carbon\Carbon;



class ManualJobController extends Controller
{
     

public function index($id,$setting)
    {
       
       if(count($setting->employer_id) > 0){
        $datas = [];
    $datas['title'] = $setting->title;
    $mydata = [];
    
    
        foreach ($setting->employer_id as $id) {

          $employer = Employers::where('id', $id)->first();
            
            $job = Jobs::where('employers_id', $id)->where('status', 1)->where('process_status', 1)->where('trash', 0)->skip(0)->take($setting->per_page)->get();
                $jobs = [];
                foreach ($job as $jb) {
                    $deadl = explode('-', $jb->deadline);

                    $diff = Carbon::create($deadl[0],$deadl[1],$deadl[2])->diffInDays(Carbon::now());
                    $emp = Employers::select('seo_url')->where('id', $jb->employers_id)->first();
                    $jobs[] = [
                        'title' => $jb->title,
                        'href' => url($emp->seo_url.'/'.$jb->seo_url),
                        'diff' => $diff.' days remaining'
                    ];
                }
              
               $mydata[] = array(
                'title' => $employer->name,
                'jobs' => $jobs,
                'thumb' => Imagetool::mycrop($employer->logo,85,85),
                'href' => $employer->seo_url,


                );
        }
        $datas['mydata'] = $mydata;

       
        
        return view('front.module.manualJob')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
