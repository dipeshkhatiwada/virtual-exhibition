<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\library\Settings;
use App\Employers;
use App\Jobs;
use Carbon\Carbon;
use App\JobCategory;
use App\JobLocation;
use App\OrganizationType;
use App\JobsLocation;



class TabController extends Controller
{
     

public function index($id,$setting)
    {
       
       if(count($setting->tabs) > 0){
        $datas = [];
    $datas['title'] = $setting->title;
    $datas['tabs'] = [];
    
    $date = Carbon::now()->toDateString();
        foreach ($setting->tabs as $tab) {
            if ($tab == 1) {
                $category = JobCategory::orderBy('name', 'asc')->get();
                $jc = [];
                foreach ($category as $cat) {
                    $jobs = Jobs::where('category_id', $cat->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->count();
                    $jc[] = [ 'title' => $cat->name. '('.$jobs.')', 'url' => url('/category/'.$cat->id)];
                }
                $datas['tabs'][] = [
                    'id' => 1,
                    'title' => 'Jobs by Function',
                    'mydata' => $jc,
                ];
            }
            if ($tab == 2) {
                $org_type = OrganizationType::orderBy('name', 'asc')->get();
                $jo = [];
                foreach ($org_type as $org) {
                    $jobs = Jobs::where('org_type_id', $org->id)->where('status', 1)->where('trash', 0)->where('publish_date', '<=', $date)->count();
                    $jo[] = [ 'title' => $org->name. '('.$jobs.')', 'url' => url('/org_type/'.$org->id)];
                }
                $datas['tabs'][] = [
                    'id' => 2,
                    'title' => 'Jobs by Industry',
                    'mydata' => $jo,
                ];
            }
            if ($tab == 3) {
                $location = JobLocation::orderBy('name', 'asc')->get();
                $jl = [];
                foreach ($location as $loc) {
                    $job = DB::table('jobs_location as jsl');
                    $job->leftJoin('jobs as j', 'jsl.jobs_id', '=', 'j.id');
                    $job->where('j.trash', 0)->where('j.publish_date', '<=', $date);
                    
                    $job->where('jsl.location_id', $loc->id);
                    $jobs = $job->count();
                   
                    $jl[] = [ 'title' => $loc->name. '('.$jobs.')', 'url' => url('/location/'.$loc->id)];
                }
                $datas['tabs'][] = [
                    'id' => 3,
                    'title' => 'Jobs by Location',
                    'mydata' => $jl,
                ];
            }
         
        }
        

      
        
        return view('front.module.tabs')->with('datas', $datas);
        }
        else{
            return '';
        }

    }
    
     
     
  
   

}
