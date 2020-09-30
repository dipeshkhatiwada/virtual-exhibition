<?php

namespace App\Http\Controllers\employer;
use DB;
use File;
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
use App\EventMeeting;
use App\TicketType;
use Carbon\Carbon;

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
$this->middleware('employer');
}

public function index(Request $request)
{
  $event = Event::where('employers_id', auth()->guard('employer')->user()->employers_id)->with('eventMeeting')->orderBy('id', 'desc')->paginate(50);
  return view('employer.event.index')->with('datas', $event)->with('dt', Carbon::now());
}

public function addnew()
{
  $data['vcode'] = rand(1, 9999);
  $data['placeholder'] = Imagetool::mycrop('no-image.png', 60,60);
  $data['category'] = EventCategory::orderBy('title', 'asc')->get();
  $data['status'][] = ['value' => 1, 'title' => 'Enable'];
  $data['status'][] = ['value' => 2, 'title' => 'Disable'];
  return  view('employer.event.newevent')->with('datas', $data);
}


public function save(Request $request)
{
  if($request->ticket_type == 2) {
    $this->validate($request, [
      'price' => 'required|numeric|min:0|not_in:0',
      ]);
  } else if($request->ticket_type == 3) {
      $this->validate($request, ['special_ticket.*.name' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.description' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.price' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.capacity' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
    }
    // dd($request->all());

  $this->validate($request, [
    'title' => 'required|min:3',
    'event_category' => 'required|integer',
    'event_type' => 'required',
    'ticket_type' => 'required',
    'meta_title' => 'required|min:3',
    'description' => 'required|min:20',
    'seo_url' => 'required|min:3|unique:event',
    'event_image' => 'required',
    'event_date' => 'required|date',
    'to_date' => 'required|date',
    'start_time' => 'required',
    'end_time' => 'required',
    ]);

  if ($request->event_type == 2) {
    $this->validate($request, [
      'longitute' => 'required',
      'latitute' => 'required',
    ]);
  }



  // dd($request->all());
  DB::beginTransaction();

  try {
    $f = array(
        'employers_id' => auth()->guard('employer')->user()->employers_id,
        'event_category_id' => $request->event_category,
        'event_type' => $request->event_type,
        'ticket_type' => $request->ticket_type,
        'price' => $request->price,
        'participants_limit' => $request->participants_limit != null?$request->participants_limit:'',
        'participants_max_limit' => $request->participants_max_limit != null ? $request->participants_max_limit: '',
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


    if ($request->event_type == 2)
    {
      $f['external_url'] = $request->external_url;
    }

    if($request->ticket_type == 2) {
      $f['price'] = $request->price;
    }

    if($request->ticket_type == 1) {
      $f['price'] = 0;
    }

    $total = 0;
    if($request->ticket_type == 3) {
      foreach ($request->special_ticket as $key => $ticket) {
          $total+=$ticket['capacity'];
      }
      $f['participants_max_limit'] = $total;
    }

    $article= Event::create($f);

    if($request->ticket_type == 3) {
      foreach ($request->special_ticket as $key => $ticket) {
        TicketType::create([
          'event_id' => $article->id,
          'name' => $ticket['name'],
          'description' => $ticket['description'],
          'price' => $ticket['price'],
          'capacity' => $ticket['capacity'],
        ]);
      }
    }

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

    $start_time=$request->event_date.'T'.$request->start_time.':00Z';
    $token=$this->getZoomToken();

    $curl = curl_init();
    $body = json_encode(
      array(
        'topic'=> $request->title,
        'type'=> '2',
        'start_time'=> $start_time,
        'duration'=> '40',
        'timezone'=> 'Asia/Kathmandu',
        'password'=> $request->password,
        'agenda'=> $request->description,
        'settings' =>
          array(
            'host_video'=> 'true',
            'participant_video'=> 'true',
            'cn_meeting'=> 'false',
            'in_meeting'=> 'true',
            'join_before_host'=> 'true',
            'mute_upon_entry'=> 'true',
            'watermark'=> 'false',
            'use_pmi'=> 'false',
            'approval_type'=> '0',
            'registration_type'=> '1',
            'audio'=> 'both',
            'auto_recording'=> 'none',
            'enforce_login'=> 'false',
            'registrants_email_notification'=> 'true'
          )
      ), true
    );
    curl_setopt_array($curl, array(
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer $token",
            "content-type: application/json"
        ),
        CURLOPT_URL => "https://api.zoom.us/v2/users/susan@rollingplans.com.np/meetings",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $body,

    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
      $resp = json_decode($response);
      EventMeeting::create([
        "start_url" => $resp->start_url,
        "join_url" => $resp->join_url,
        "meeting_id" => $resp->id,
        "meeting_password" => $resp->password,
        "created_by" => auth()->guard('employer')->user()->id,
        "event_id" => $article->id
      ]);
    }

    DB::commit();
    \Session::flash('alert-success','Record have been saved Successfully');
    return redirect('employer/event');
  } catch (\Exception $e) {
    DB::rollback();
    \Session::flash('alert-danger', $e->getMessage());
    return redirect('employer/event');
  }
}

public function delete($id)
{
$event = Event::find($id);
if($event){
$article = Event::where('employers_id', auth()->guard('employer')->user()->employers_id)->where('id', $id)->first();
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
  return redirect('employer/event');
}
else
{
\Session::flash('alert-danger','Something Went Wrong on Deleting Data');
    return redirect('employer/event');
}
} else {
\Session::flash('alert-danger','Did not find the choosen Data');
    return redirect('employer/event');
}
}

public function edit($id)
{

$event=  Event::where('id', $id)->with('eventTicketType')->where('employers_id', auth()->guard('employer')->user()->employers_id)->first();
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

return view('employer.event.editevent')->with('datas', $mydatas);
} else {

\Session::flash('alert-danger','You choosed wrong data');
    return redirect('employer/event');
}
}

public function update(Request $request)
{
  //dd($request->all());
  if($request->ticket_type == 2) {
    $this->validate($request, [
      'price' => 'required|numeric|min:0|not_in:0',
      ]);
  } else if($request->ticket_type == 3) {
      $this->validate($request, ['special_ticket.*.name' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.description' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.price' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
      $this->validate($request, ['special_ticket.*.capacity' => 'required'],
        ['special_ticket.*.*.required' => 'Please recheck at ticket type input fields.']
      );
    }
  $this->validate($request, [
  'id' => 'required|integer',
  'event_type' => 'required',
  'ticket_type' => 'required',
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

  if ($request->event_type == 2) {
    $this->validate($request, [
      'external_url' => 'required',
      'longitute' => 'required',
      'latitute' => 'required',
    ]);
  }

if($request->ticket_type == 3) {
  TicketType::where('event_id', $request->id)->delete();
  foreach ($request->special_ticket as $key => $ticket) {
    TicketType::create([
      'event_id' => $request->id,
      'name' => $ticket['name'],
      'description' => $ticket['description'],
      'price' => $ticket['price'],
      'capacity' => $ticket['capacity'],
      ]);
    }
  }else{
    TicketType::where('event_id', $request->id)->delete();
}

$f = array(
  'event_category_id' => $request->event_category,
  'title' => $request->title,
  'event_type' => $request->event_type,
  'ticket_type' => $request->ticket_type,
  'participants_limit' => $request->participants_limit != null?$request->participants_limit:'',
  'participants_max_limit' => $request->participants_max_limit != null ? $request->participants_max_limit: '',
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

if($request->ticket_type == 2) {
  $f['price'] = $request->price;
}

if($request->ticket_type == 1) {
  $f['price'] = 0;
}


$total = 0;
if($request->ticket_type == 3) {
  foreach ($request->special_ticket as $key => $ticket) {
      $total+=$ticket['capacity'];
  }
  $f['participants_max_limit'] = $total;
}

if ($request->event_type == 2)
{
  $f['external_url'] = $request->external_url;
}

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
return redirect('employer/event');
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

  protected function getZoomToken()
  {
      $refresh_token=DB::table('zoom_api')->where('id', '=', 1)->first()->refresh_token;
      $token_url="https://zoom.us/oauth/token?grant_type=refresh_token&refresh_token=".$refresh_token;
      $curl = curl_init();
      curl_setopt_array($curl, array(
          CURLOPT_HTTPHEADER => array(
              "authorization: Basic S1RJWndkdmRUWmlTOXMzWHdMdTRpZzpZSmJwdlliMVJRdXFzeDAzcXBDZnFSbzRyTXdTYVBnMQ==",
          ),
          CURLOPT_URL => $token_url,
          CURLOPT_SSL_VERIFYPEER => true,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_CUSTOMREQUEST => "POST",
      ));

      $data = curl_exec($curl);
      curl_close($curl);
      $result = json_decode($data);
      DB::table('zoom_api')->where('id', '=', 1)->update([
          'refresh_token' => $result->refresh_token,
      ]);
      return $result->access_token;
  }
}
