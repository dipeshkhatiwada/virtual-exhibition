<?php

namespace App\Http\Controllers\front\module;
use DB;
use App\Http\Controllers\Controller;
use App\library\settings;
use App\JobLocation;
use GMaps;
use Carbon\Carbon;
use App\Employers;
use App\Tender;
use App\Training;
use App\Event;
use App\Project;


class LocationMapController extends Controller
{
     


    public function index($id,$setting)
    {
        
       $datas = [];
       $datas['title'] = $setting->title;

       $date = Carbon::now()->toDateString();
     $datas['locations'] = [];
    $location = JobLocation::orderBy('name', 'asc')->get();
    
    if (count($location) > 0) {
       
          foreach ($location as $loc) {
                    $job = DB::table('jobs_location as jsl');
                    $job->leftJoin('jobs as j', 'jsl.jobs_id', '=', 'j.id');
                    $job->where('j.trash', 0)->where('j.publish_date', '<=', $date)->where('j.deadline', '>=', $date)->where('j.status', 1);
                    
                    $job->where('jsl.location_id', $loc->id);
                    $jobss = $job->orderBy('title', 'asc')->get();
                    $jobs = $job->count();
                    
                    $infowindow = '<a href="'.url('jobs/location/'.$loc->seo_url).'" target="_blank"><strong>'.$loc->name.'</strong></a><br>';
                   if($jobs > 0){
                    foreach ($jobss as $value) {
                        $employer = Employers::select('seo_url')->where('id', $value->employers_id)->first();
                        $infowindow .= '<a href="'.url('/jobs/'.$employer->seo_url.'/'.$value->seo_url).'" target="_blank">'.$value->title.'</a><br>';


                    }
                   

                     $response = \GoogleMaps::load('geocoding')
                            ->setParam (['address' => $loc->name])
                            ->get();
                            $response = json_decode($response);
                            $result = $response->results;
                            
                            foreach ($result as $key => $value) {
                               $location = $value->geometry->location;
                               $datas['locations'][] = [
                                'lat' => $location->lat,
                                'lng' => $location->lng,
                                'infowindow_content' => addslashes($infowindow),
                                'marker' => asset('images/map-merker/job.png'),
                                'title' => 'Job'
                                ];
                                break;
                            }
                    
                }


                   
                }
        //dd($datas);
               
        
    } 
    
    $tenders = Tender::select('employers_id')->where('status', 1)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->groupBy('employers_id')->get();

    foreach($tenders as $tender)
    {
        $address = \App\EmployerAddress::select('address')->where('employers_id',$tender->employers_id)->first();

        if(isset($address->address))
        {
            if($address->address != '')
            {
                
                $tend = Tender::select('seo_url','title')->where('status', 1)->where('employers_id', $tender->employers_id)->where('publish_date', '<=', $date)->where('submission_end_date', '>=', $date)->get();
                
                $employer = Employers::select('seo_url','name')->where('id', $tender->employers_id)->first();
                $infowindowt = '<a href="'.url('/tenders/business/'.$employer->seo_url).'" target="_blank"><strong>'.$employer->name.'</strong></a><br>';
                foreach($tend as $ten)
                {
                    $infowindowt .= '<a href="'.url('/tenders/'.$ten->seo_url).'" target="_blank">'.$ten->title.'</a><br>';
                }
                
                 $response = \GoogleMaps::load('geocoding')
                            ->setParam (['address' => $address->address.' '.$employer->name])
                            ->get();
                            
                            $response = json_decode($response);
                            $result = $response->results;
                           
                            foreach ($result as $key => $value) {
                               $location = $value->geometry->location;
                               $datas['locations'][] = [
                                'lat' => $location->lat,
                                'lng' => $location->lng,
                                'infowindow_content' => addslashes($infowindowt),
                                'marker' => asset('images/map-merker/trender.png'),
                                'title' => 'Tender'
                                ];
                                break;
                            }
            }
        }
    }
    
     $projects = Project::select('employers_id')->where('status', 1)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->groupBy('employers_id')->get();

    foreach($projects as $tender)
    {
        $address = \App\EmployerAddress::select('address')->where('employers_id',$tender->employers_id)->first();

        if(isset($address->address))
        {
            if($address->address != '')
            {
                
                $tend = Project::select('seo_url','title')->where('status', 1)->where('employers_id', $tender->employers_id)->where('publish_date', '<=', $date)->where('deadline', '>=', $date)->get();
                
                $employer = Employers::select('seo_url','name')->where('id', $tender->employers_id)->first();
                $infowindowt = '';
                foreach($tend as $ten)
                {
                    $infowindowt .= '<a href="'.url('/projects/'.$ten->seo_url).'" target="_blank">'.$ten->title.'</a><br>';
                }
                
                 $response = \GoogleMaps::load('geocoding')
                            ->setParam (['address' => $address->address.' '.$employer->name])
                            ->get();
                            
                            $response = json_decode($response);
                            $result = $response->results;
                           
                            foreach ($result as $key => $value) {
                               $location = $value->geometry->location;
                               $datas['locations'][] = [
                                'lat' => $location->lat,
                                'lng' => $location->lng,
                                'infowindow_content' => addslashes($infowindowt),
                                'marker' => asset('images/map-merker/project.png'),
                                'title' => 'Project'
                                ];
                                break;
                            }
            }
        }
    }
    
     $trainings = Training::where('status', 1)->get();
   
    foreach($trainings as $training)
    {
        

       
            if($training->address != '')
            {
                
               
                    $infowindowt = '<a href="'.url('/trainings/'.$training->seo_url).'" target="_blank">'.$training->title.'</a><br>';
               
                
                 $response = \GoogleMaps::load('geocoding')
                            ->setParam (['address' => $training->venue.' '.$training->address])
                            ->get();
                            
                            $response = json_decode($response);
                            $result = $response->results;
                            
                            foreach ($result as $key => $value) {
                               $location = $value->geometry->location;
                               $datas['locations'][] = [
                                'lat' => $location->lat,
                                'lng' => $location->lng,
                                'infowindow_content' => addslashes($infowindowt),
                                'marker' => asset('images/map-merker/training.png'),
                                'title' => 'Training'
                                ];
                                break;
                            }
            }
       
    }
    
    $events = Event::where('status', 1)->get();
   
    foreach($events as $event)
    {
        
            if($event->latitute != '' && $vent->longitute != '')
            {
                $infowindowt = '<a href="'.url('/events/'.$event->seo_url).'" target="_blank">'.$event->title.'</a><br>';
                $datas['locations'][] = [
                                'lat' => $event->latitute,
                                'lng' => $event->longitute,
                                'infowindow_content' => addslashes($infowindowt),
                                'marker' => asset('images/map-merker/events.png'),
                                'title' => 'Event'
                                ];
            }
       
            elseif($event->address != '')
            {
                
               
                    $infowindowt = '<a href="'.url('/events/'.$event->seo_url).'" target="_blank">'.$event->title.'</a><br>';
               
                
                 $response = \GoogleMaps::load('geocoding')
                            ->setParam (['address' => $event->address])
                            ->get();
                            
                            $response = json_decode($response);
                            $result = $response->results;
                            
                            foreach ($result as $key => $value) {
                               $location = $value->geometry->location;
                               $datas['locations'][] = [
                                'lat' => $location->lat,
                                'lng' => $location->lng,
                                'infowindow_content' => addslashes($infowindowt),
                                'marker' => asset('images/map-merker/events.png'),
                                'title' => 'Event'
                                ];
                                break;
                            }
            }
       
    }
    
    return view('front.module.gmap')->with('datas', $datas);
               
        

    }

   
  
   

}
