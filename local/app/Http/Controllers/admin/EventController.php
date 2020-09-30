<?php

namespace App\Http\Controllers\admin;
use DB;
use File;
use App\UserGroup;
use App\Http\Controllers\Controller;
use App\Event;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use App\EventSponsor;
use App\EventPhoto;
use App\EventCategory;

class EventController extends Controller
{

/**
* Create a new controller instance.
*
* @return void
*/

/**
* Show the application dashboard.
*
* @return \Illuminate\Http\Response
*/
public function __construct()
{
$this->middleware('auth');
}

public function index(Request $request)
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
       $datas['filter_employer'] = '';
        $datas['filter_title'] = '';
        $datas['filter_category'] = '';
        $datas['filter_status'] = '';
        $url = '';
      $event = Event::where('id', '!=', '');
      if (isset($request->filter_employer)) {
            $datas['filter_employer'] = $request->filter_employer;
            $url .= '&filter_employer='.$request->filter_employer;
            $event->where('employers_id',$request->filter_employer);

        }
        if (isset($request->filter_title)) {
            $datas['filter_title'] = $request->filter_title;
            $url .= '&filter_title='.$request->filter_title;
            $event->where('title', 'LIKE', $request->filter_title.'%');

        }
        if (isset($request->filter_category)) {
            $datas['filter_category'] = $request->filter_category;
            $url .= '&filter_category='.$request->filter_category;
            $event->where('event_category_id',$request->filter_category);

        }
        if (isset($request->filter_status)) {
            $datas['filter_status'] = $request->filter_status;
            $url .= '&filter_status='.$request->filter_status;
            $event->where('status',$request->filter_status);

        }
        
        $datas['event'] = $event->orderBy('id', 'desc')->paginate(50)->setPath('admin/event?'.$url);


        $datas['categories'] = EventCategory::orderBy('title','asc')->get();
        $datas['status'][] = ['value' => '0', 'title' => 'Enabled'];
        $datas['status'][] = ['value' => '1', 'title' => 'Disabled'];
        //dd($datas);
return view('admin.event.index')->with('datas', $datas);
}

public function addnew()
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
  $data['vcode'] = rand(1, 9999);
  $data['placeholder'] = Imagetool::mycrop('no-image.png', 60,60); 
  $data['category'] = EventCategory::orderBy('title', 'asc')->get();
  $data['status'][] = ['value' => 1, 'title' => 'Enable'];
  $data['status'][] = ['value' => 2, 'title' => 'Disable'];
  return  view('admin.event.newform')->with('datas', $data);
}


public function save(Request $request)
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
//dd($request->all());
$this->validate($request, [
  'employer' => 'required|integer',
  'title' => 'required|min:3',
  'event_category' => 'required|integer',
  'meta_title' => 'required|min:3',
  'description' => 'required|min:20',
  'seo_url' => 'required|min:3|unique:event',
  'event_image' => 'required',
  'event_date' => 'required|date',
  'to_date' => 'required|date',
  'start_time' => 'required',
  'end_time' => 'required',
]);


$f = array(
    'employers_id' => $request->employer,
    'event_category_id' => $request->event_category,
    'title' => $request->title,
    'meta_title' => $request->meta_title,
    'meta_keyword' => $request->meta_keyword,
    'meta_description' => $request->meta_description,
    'seo_url' => $request->seo_url,
    'image' => $request->event_image,
    'venue' => $request->venue,
    'longitute' => $request->longitute,
    'latitute' => $request->latitute,
    'address' => $request->address,
    'video' => $request->video,
    'description' => $request->description,
    'event_date' => $request->event_date,
    'to_date' => $request->to_date,
    'start_time' => $request->start_time,
    'end_time' => $request->end_time,
    'status' => $request->status
    );
$article= Event::create($f);
if($article)
{
  if (isset($request->photo)) {
     foreach($request->photo as $key => $photo) {
        if (trim($photo['title']) != '') {
         $data = [
          'event_id' => $article->id,
          'title' => $photo['title'],
          'image' => $photo['image'],
         ];
         EventPhoto::create($data);
       }
     }
   }

  if (isset($request->sponsor)) {
     foreach ($request->sponsor as $key => $sponsor) {
       if (trim($sponsor['name']) != '') {
        /*create photo upload code*/
        $data = [
          'event_id' => $article->id,
          'name' => $sponsor['name'],
          'logo' => $sponsor['logo'],
          'url' => $sponsor['url']
        ];
        EventSponsor::create($data);
       }
     }
    }
   
    \Session::flash('alert-success','Record have been saved Successfully');
    return redirect('admin/event');

} else {

    \Session::flash('alert-danger','Something Went Wrong on Deleting usergroup');
    return redirect('admin/event'); 
}
}

public function delete($id)
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
$event = Event::find($id);
if($event){
$article = Event::where('id', $id)->first();
//foreach ($article->Sponsors/*function from module*/ as $key => $sponsor/*variable*/ {
 // if (is_file(DIR_IMAGE.$sponsor->logo)) {
   // File::delete(DIR_IMAGE.$sponsor->logo);
   // EventSponsor::where('id', $sponsor->id)->delete();
  //}
//}
//foreach ($article->Photos/*function from module*/ as $key => $photo/*variable*/ {
  //if (is_file(DIR_IMAGE.$photo->image)) {
   // File::delete(DIR_IMAGE.$photo->image);
    //EventPhoto::where('id', $photo->id)->delete();
 // }
//}
//if (is_file(DIR_IMAGE.$event->image)) {
    //File::delete(DIR_IMAGE.$event->image);
  //}
$i=$event->delete();
if($i)
{

\Session::flash('alert-success','Record deleted Successfully');
  return redirect('admin/event');
}
else 
{
\Session::flash('alert-danger','Something Went Wrong on Deleting Data');
    return redirect('admin/event'); 
}
} else {
\Session::flash('alert-danger','Did not find the choosen Data');
    return redirect('admin/event'); 
}
}

public function edit($id)
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }

$event=  Event::where('id', $id)->first();
if($event) {

$mydatas = array();

$placeholder = Imagetool::mycrop('no-image.png',100,100);

  if(is_file(DIR_IMAGE.$event->image)){
  $image = Imagetool::mycrop($event->image, 100, 100);;
  } 
    else {
    $image = $placeholder;
    }

    /*for event photo tab*/
  $mydatas['photos'] = [];
  foreach ($event->photos as $key => $photo) {
    if (is_file(DIR_IMAGE. $photo->image)) {
     $event_image = Imagetool::mycrop($photo->image,100,100);
    }else{
      $event_image = $placeholder;
    }

    $mydatas['photos'][] = [
      'title' => $photo->title,
      'thumb' => $event_image,
      'image' => $photo->image,
    ];


  }
/*for sponsor tab*/
$mydatas['sponsors'] = [];
foreach ($event->sponsors as $key => $sponsor) {
  if (is_file(DIR_IMAGE. $sponsor->logo)) {
    $sponsor_logo = Imagetool::mycrop($sponsor->logo,100,100);
  }
  else{
    $sponsor_logo = $placeholder;
  }

  $mydatas['sponsors'][] = [
    'name' => $sponsor->name,
    'logo_thumb' => $sponsor_logo,
    'logo' => $sponsor->logo,
    'url' => $sponsor->url,
  ];
}

  $mydatas['mainevent'] = $event;
  $mydatas['image'] = $image;
  $mydatas['placeholder'] = $placeholder;
  $mydatas['category'] = EventCategory::orderBy('title', 'asc')->get();
  $mydatas['status'][] = ['value' => 1, 'title' => 'Enable'];
  $mydatas['status'][] = ['value' => 2, 'title' => 'Disable'];

//dd($mydatas);
  
return view('admin.event.editform')->with('datas', $mydatas);
} else {

\Session::flash('alert-danger','You choosed wrong data');
    return redirect('admin/event'); 
}
}

public function update(Request $request)
{
  $permission = UserGroup::checkPermission('EventController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
  //dd($request->all());
  $this->validate($request, [
  'id' => 'required|integer',
  'employer' => 'required|integer',
  'event_category' => 'required|integer',
  'title' => 'required|min:3',
  'meta_title' => 'required|min:3',
  'description' => 'required|min:20',
  'seo_url' => 'required|min:3|unique:event,seo_url,'.$request->id.',id',
  'event_date' => 'required|date',
  'to_date' => 'required|date',
  'start_time' => 'required',
  'end_time' => 'required',
  ]);
  

$f = array(
  'employers_id' => $request->employer,
  'event_category_id' => $request->event_category,
  'title' => $request->title,
  'meta_title' => $request->meta_title,
  'meta_keyword' => $request->meta_keyword,
  'meta_description' => $request->meta_description,
  'seo_url' => $request->seo_url,
  'image' => $request->event_image,
  'venue' => $request->venue,
  'longitute' => $request->longitute,
  'latitute' => $request->latitute,
  'address' => $request->address,
  'video' => $request->video,
  'description' => $request->description,
  'event_date' => $request->event_date,
  'to_date' => $request->to_date,
    'start_time' => $request->start_time,
    'end_time' => $request->end_time,
  'status' => $request->status
);

Event::where('id', $request->id)->update($f);
EventPhoto::where('event_id', $request->id)->delete();
EventSponsor::where('event_id', $request->id)->delete();
/*update code for event photo and Event sponsor*/
if (isset($request->photo)) {
  foreach ($request->photo as $key => $photo) {
    if (trim($photo['title']) != '') {
    $data = [
    'event_id' => $request->id,
    'title' => $photo['title'],
    'image' => $photo['image'],
    ];
    EventPhoto::create($data);
    }
  }
}
if (isset($request->sponsor)) {
  foreach ($request->sponsor as $key => $sponsor) {
    if (trim($sponsor['name']) != '') {
    $data = [
    'event_id' => $request->id,
    'name' => $sponsor['name'],
    'logo' => $sponsor['logo'],
    'url' => $sponsor['url'],
    ];
    EventSponsor::create($data);
    }
  }
}

\Session::flash('alert-success','Record have been updated Successfully');
return redirect('admin/event');
}


/*function to delete event photo image*/
public function deletephoto(Request $request)
{
  if(isset($request->id)){
      EventPhoto::where('id', $request->id)->delete();
      return 'Success|Data deleted Successfully';
  }
  else{
  return 'Error|Data not found';
  }
}


/*function to delete event sponsor logo*/
public function deleteSponsor(Request $request)
  {
    if(isset($request->id)){

    EventSponsor::where('id', $request->id)->delete();
    return 'Success|Data Deleted Successfully';
    }
    else{
    return 'Error|Data Not Found';
    }
  }
}