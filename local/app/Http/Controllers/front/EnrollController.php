<?php

namespace App\Http\Controllers\front;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enroll;
use App\EnrollReservation;
use App\User;
use App\ChatMessage;
use App\EmployerUser;
use App\EnrollAudienceViewer;
use App\EnrollEmployerStream;
use App\EnrollGroupVideoChannel;
use Pusher\Pusher;
use App\EnrollViewer;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;
use PDF;
use Carbon\Carbon;
use App\library\Settings;
use App\Employees;
use App\EnrollBanner;

class EnrollController extends Controller
{

    public function index(Request $request)
    {
            $date = Carbon::now()->toDateString();
            $layouts= \App\Layout::where('layout_route', 'enroll')->first();
            if(isset($data->layout_id))
            {
                $layout_id = $data->layout_id;
            }
            elseif(isset($layouts->layout_id))
            {
                $layout_id = $layouts->layout_id;
            }
            else
            {
                $layout_id = '';
            }

            $settings = Settings::getSettings();
            $images = Settings::getImages();

            $setting = \App\Setting::orderBy('id', 'desc')->first();
            $image = $setting->SettingImage;


            if (is_file(DIR_IMAGE . $image->enroll)) {
                $logo = 'image/'.$image->enroll;
            } else {
                $logo = '';
            }

            $datas['logo'] = $logo;

            $datas['address'] = $setting->address;
            $datas['phone'] = $setting->telephone;

            $datas['enroll'] = EnrollReservation::where('publish_status', '1')->paginate(50);

            $main_content = \App\Module::getModules($layout_id, 'content_main');

            $datas['main_modules'] = array();
            foreach ($main_content as $main) {
                $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
                $content_main = new $cont();
                $datas['main_modules'][] = array(
                    'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
            }

            $left_content = \App\Module::getModules($layout_id, 'content_left');
            $datas['left_content'] = array();
            foreach ($left_content as $left) {
                $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
                $left_module = new $lcontent();
                $datas['left_content'][] = array(
                    'module' => $left_module->index($left->module_id,json_decode($left->setting)),
                  );
            }

            $right_content = \App\Module::getModules($layout_id, 'content_right');
            $datas['right_content'] = array();
            foreach ($right_content as $right) {
                $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
                $right_module = new $lcontent();
                $datas['right_content'][] = array(
                    'module' => $right_module->index($right->module_id,json_decode($right->setting)),
                    );
            }

            $top_content = \App\Module::getModules($layout_id, 'content_top');
            $datas['top_content'] = array();
            foreach ($top_content as $top) {
              $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
              $top_module = new $lcontent();
                $datas['top_content'][] = array(
                'module' => $top_module->index($top->module_id,json_decode($top->setting)),
                  );
            }

            $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
            $datas['bottom_content'] = array();
            foreach ($bottom_content as $bottom) {
              $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
              $bottom_module = new $lcontent();
                $datas['bottom_content'][] = array(
                    'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
                );
            }



            $enroll_type = Enroll::get();

            return view('front.enroll.index', compact('datas', 'enroll_type'));
    }

    public function show($slug=null)
    {
            $date = Carbon::now()->toDateString();
            $layouts= \App\Layout::where('layout_route', 'enroll')->first();
            if(isset($data->layout_id))
            {
                $layout_id = $data->layout_id;
            }
            elseif(isset($layouts->layout_id))
            {
                $layout_id = $layouts->layout_id;
            }
            else
            {
                $layout_id = '';
            }

            $settings = Settings::getSettings();
            $images = Settings::getImages();

            $setting = \App\Setting::orderBy('id', 'desc')->first();
            $image = $setting->SettingImage;


            if (is_file(DIR_IMAGE . $image->enroll)) {
                $logo = 'image/'.$image->enroll;
            } else {
                $logo = '';
            }

            $datas['logo'] = $logo;

            $datas['address'] = $setting->address;
            $datas['phone'] = $setting->telephone;
            $main_content = \App\Module::getModules($layout_id, 'content_main');

            $datas['main_modules'] = array();
            foreach ($main_content as $main) {
                $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
                $content_main = new $cont();
                $datas['main_modules'][] = array(
                    'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
            }

            $left_content = \App\Module::getModules($layout_id, 'content_left');
            $datas['left_content'] = array();
            foreach ($left_content as $left) {
                $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
                $left_module = new $lcontent();
                $datas['left_content'][] = array(
                    'module' => $left_module->index($left->module_id,json_decode($left->setting)),
                  );
            }

            $right_content = \App\Module::getModules($layout_id, 'content_right');
            $datas['right_content'] = array();
            foreach ($right_content as $right) {
                $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
                $right_module = new $lcontent();
                $datas['right_content'][] = array(
                    'module' => $right_module->index($right->module_id,json_decode($right->setting)),
                    );
            }

            $top_content = \App\Module::getModules($layout_id, 'content_top');
            $datas['top_content'] = array();
            foreach ($top_content as $top) {
              $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
              $top_module = new $lcontent();
                $datas['top_content'][] = array(
                'module' => $top_module->index($top->module_id,json_decode($top->setting)),
                  );
            }

            $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
            $datas['bottom_content'] = array();
            foreach ($bottom_content as $bottom) {
              $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
              $bottom_module = new $lcontent();
                $datas['bottom_content'][] = array(
                    'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
                );
            }

            $enroll_type = Enroll::get();
            $category = Category::where('seo_url', $slug)->first();
            $datas['enroll'] = EnrollReservation::where('category_id',$category->id)->where('publish_status', '1')->paginate(50);
        return view('front.enroll.index', compact('enroll_type', 'datas'));
    }

    public function homePage($slug=null)
    {

        $date = Carbon::now()->toDateString();
        $layouts= \App\Layout::where('layout_route', 'enroll')->first();
        if(isset($data->layout_id))
        {
            $layout_id = $data->layout_id;
        }
        elseif(isset($layouts->layout_id))
        {
            $layout_id = $layouts->layout_id;
        }
        else
        {
            $layout_id = '';
        }

        $settings = Settings::getSettings();
        $images = Settings::getImages();

        $setting = \App\Setting::orderBy('id', 'desc')->first();
        $image = $setting->SettingImage;


        if (is_file(DIR_IMAGE . $image->enroll)) {
            $logo = 'image/'.$image->enroll;
        } else {
            $logo = '';
        }

        $datas['logo'] = $logo;

        $datas['address'] = $setting->address;
        $datas['phone'] = $setting->telephone;
        $main_content = \App\Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
        }

        $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id,json_decode($left->setting)),
                );
        }

        $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id,json_decode($right->setting)),
                );
        }

        $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
                );
        }

        $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
            );
        }

        $enroll_type = Enroll::get();
        $datas['company_detail'] = EnrollReservation::where('seo_url', $slug)->where('publish_status', '1')->orderBy('created_at', 'asc')->first();

        $p_viewer = EnrollViewer::where('employee_id', auth()->guard('employee')->user()->id)->where('reservation_id', $datas['company_detail']->id)->first();
        if ($p_viewer == null) {
            EnrollViewer::create([
                'reservation_id' => $datas['company_detail']->id,
                'employee_id' => auth()->guard('employee')->user()->id,
                'count' => 1,
            ]);
        }else if($p_viewer->employee_id == auth()->guard('employee')->user()->id){

            EnrollViewer::where('employee_id', auth()->guard('employee')->user()->id)->update([
                'count' => $p_viewer->count + 1,

            ]);
        }

        $datas['views'] = $datas['company_detail']->views + 1;
        EnrollReservation::where('id', $datas['company_detail']->id)->update([
            'views' => $datas['views'],
        ]);

        $datas['business_user'] = \App\Employers::where('id', $datas['company_detail']->employer_id)->first();
        $datas['photos'] = $datas['company_detail']->photos;
        // $datas['banner'] = \App\Imagetool::mycrop($datas['company_detail']->banner_file, 786,480);
        $datas['banner'] = EnrollBanner::where('reservation_id', $datas['company_detail']->id)->get();
        // foreach ($datas['banner'] as $key => $banner)
        // {
        //     $resize = \App\Imagetool::mycrop($banner->image, 786,480);
        //     $datas['banner'][$key]->resize = $resize;
        // }
        return view('front.enroll.company_detail', compact('enroll_type','datas'));
    }

    public function getBusinessUser(Request $request)
    {

        $data['contacts'] = [];


        $contacts = \App\Employers::where('id', $request->receiver_id)->where('status', 1)->first();
        // foreach ($contacts as $key => $contact) {
        if($contacts){
          $number_of = false;
          $chk_msg = \App\ChatMessage::where('message_from', auth()->guard('employee')->user()->id)->where('message_to', $request->receiver_id)->where('view_status','!=', '1')->count();
          if ($chk_msg > 0) {
            $number_of = $chk_msg;
          }

          $data['contacts'][] = [
            'id'    => $contacts->id,
            'name'  => $contacts->name,
            'image'  => $contacts->image,
            'status'  => $contacts->status,
            'number_of' => $number_of,

          ];
        }

    //   $return_data = view('front.enroll.messages.message_user')->with('data',$data)->render();
        $return_data = view('employee.message_users')->with('data',$data)->render();

        return response()->json($return_data);
    }

    public function GetChatBox(Request $request)
    {
        $business_user_id = $request->business_user_id;
        // return $business_user_id;
        $page = 0;
        if ($request->page) {
            $page= $request->page;
        }
        $limit = 20;
        $start = $page * $limit;
        $data = [];
        $my_id = auth()->guard('employee')->user()->id;

        // Make read all unread message
        ChatMessage::where(['message_from' => $request->business_user_id, 'message_to' => $my_id])->update(['view_status' => 1]);

        // Get all message message_from selected user
        $messages = ChatMessage::where(function ($query) use ($business_user_id, $my_id) {
            $query->where('message_from', $business_user_id)->where('message_to', $my_id)->where('to_delete', '!=', '1');
        })->oRwhere(function ($query) use ($business_user_id, $my_id) {
            $query->where('message_from', $my_id)->where('message_to', $business_user_id)->where('from_delete', '!=', '1');
        })->orderBy('id','desc');


        $data['message'] = $messages->skip($start)->take($limit)->get()->reverse();
        $totmsg = $messages->count();
        $fetmsg = ($page + 1) * $limit;
        $data['ldmr'] = 1;

        if ($totmsg > $fetmsg) {
            $data['ldmr'] = 2;
        }

        $data['user_id'] = $business_user_id;
        $data['name'] = \App\Employers::getName($business_user_id);
        $data['image'] = \App\Employers::getPhoto($business_user_id);
        $data['page'] = $page + 1;

        if ($page > 0) {
            $return_data['data'] = view('front.enroll.messages.chats')->with('data',$data)->render();
            $return_data['ldmr'] = $data['ldmr'];
        } else{
            $return_data = view('front.enroll.messages.chat_box')->with('data',$data)->render();
        }

        return response()->json($return_data);
    }

    public function sendMessage(Request $request)
    {
        $json = [];

        $this->validate($request,[
            'receiver_id' => 'required|integer',
            'message'   => 'required'
        ]);
            $from = auth()->guard('employee')->user()->id;
            $to = $request->receiver_id;
            $message = $request->message;
            $sender_name = \App\Employees::getName($from);

            $data = new ChatMessage();
            $data->message_from = $from;
            $data->message_to = $to;
            $data->message = $message;
            $data->view_status = 0; // message will be unread when sending message
            $data->from_delete = 0;
            $data->to_delete = 0;
            $data->save();

            // pusher
            $options = array(
                'cluster' => 'ap2',
                'useTLS' => true

            );

            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                $options
            );
            $html = '<li id="chat_'.$data->id.'" class="p-1 rounded mb-1">
                                    <div class="receive-msg">
                                        <div class="receive-msg-img">
                                            <img src="'.asset(\App\Employees::getPhoto($data->message_from)).'">
                                        </div>
                                        <div class="receive-msg-desc rounded text-center mt-1 ml-1 pl-2 pr-2">
                                            <p class="mb-0 mt-1 pl-2 pr-2 rounded">'.$data->message.'</p>

                                        </div>
                                    </div>
                                    <i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i>
                                </li>';

            $pda = ['from' => $from, 'to' => $to, 'html' => $html, 'sender_name' => $sender_name]; // sending from and to user id when pressed enter
            $pusher->trigger('my-channel', 'my-event', $pda);

            $json['data'] = '<li id="chat_'.$data->id.'" class="pl-2 pr-2 rounded text-white text-center send-msg mb-1 unread_message">'.$data->message.'<i id="delete_'.$data->id.'" class="fa fa-remove delete_chat"></i></li>';
            return response()->json($json);

    }

    public function joinLiveStream($slug=null)
    {


        $date = Carbon::now()->toDateString();
        $layouts= \App\Layout::where('layout_route', 'enroll')->first();
        if(isset($data->layout_id))
        {
            $layout_id = $data->layout_id;
        }
        elseif(isset($layouts->layout_id))
        {
            $layout_id = $layouts->layout_id;
        }
        else
        {
            $layout_id = '';
        }

        $settings = Settings::getSettings();
        $images = Settings::getImages();

        $setting = \App\Setting::orderBy('id', 'desc')->first();
        $image = $setting->SettingImage;


        if (is_file(DIR_IMAGE . $image->enroll)) {
            $logo = 'image/'.$image->enroll;
        } else {
            $logo = '';
        }

        $datas['logo'] = $logo;

        $datas['address'] = $setting->address;
        $datas['phone'] = $setting->telephone;
        $main_content = \App\Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
        }

        $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id,json_decode($left->setting)),
                );
        }

        $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id,json_decode($right->setting)),
                );
        }

        $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
                );
        }

        $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
            );
        }

        $datas['enroll'] = EnrollReservation::where('seo_url', $slug)->first();
        $datas['stream'] = EnrollEmployerStream::where('channel', $datas['enroll']->seo_url)->first();
        $datas['business_user'] = \App\Employers::where('id', $datas['enroll']->employer_id)->first();

        $enroll_type = Enroll::get();

        $datas['channel'] = $slug;
        $datas['viewer'] = 1;

        return view('front.enroll.live', compact('datas', 'enroll_type'));
    }

    public function updateJoinedLivestream(Request $request)
    {

        $stream_data = EnrollEmployerStream::where('channel', $request['channel'])->first();
        $employee = auth()->guard('employee')->user();
        $data = EnrollReservation::where('seo_url', $request['channel'])->first();
        $employer_id = $data['employer_id'];
        $reservation_id = $data['id'];
        $camera_profile = '720p_6';
        $message = '';
        $viewer_count = '';
        $counter = '';
        $html='';

        if($stream_data != '' && $stream_data->channel == $request['channel'] && $stream_data->type == 'enroll'){
            //if entry channel is equal to database only update employee_id and count
                $array_data = json_decode($stream_data->employee_id);
                if(in_array($employee->id, $array_data)) {
                    $viewer_count = $stream_data->total_count;
                    $message = 'old_user';
                    $counter = $stream_data->total_count;

                }else{
                    array_push($array_data, $employee->id);
                    $viewer_count = $stream_data->total_count + 1;
                    $counter = $viewer_count;
                    EnrollEmployerStream::where('channel', $request['channel'])->update([
                        'employee_id' => json_encode($array_data),
                        'total_count' => $viewer_count,
                        'counter' => $counter,
                    ]);
                    $message = 'new_user';


                }
        }else{
            $viewer_count = 1;
            $counter = 1;

            EnrollEmployerStream::create([
                'employee_id' =>  json_encode([$employee->id]),
                'employer_id' =>  $employer_id,
                'reservation_id' => $reservation_id,
                'channel' => $request['channel'],
                'camera_profile'=> $camera_profile,
                'total_count' => $viewer_count,
                'type' => 'enroll',
                'counter' => $counter,
            ]);
            $message = 'new_user';

        }

        //   pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '6e2167f314296786dc0a',
            '000e3282c48fd7efb445',
            '1050696',
        $options
        );


        $html = '<li class="list-group-item" id="user_viewer_'.$employee->id.'">'.$employee->email.'</li>';
        $temp = ['user_id' => $employee->id, 'viewer_count' => $viewer_count, 'counter' => $counter, 'html' => $html, 'type' => 'joinstream', 'message' => $message];
        $pusher->trigger('my-audience', 'my-broadcast', $temp);
        $pusher->trigger('my-channel', 'my-event', $temp);
        return $temp;

    }

    public function streamLeave(Request $request)
    {

        $enroll_stream = EnrollEmployerStream::where('channel', $request['channel'])->first();
        if($enroll_stream->counter > 1)
        {
            $counter = $enroll_stream->couter - 1 ;
        }else{
            $counter = 0;
        }
        $enroll_stream->counter = $counter;
        $enroll_stream->save();

        $user = auth()->guard('employee')->user();
          // pusher
          $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            '6e2167f314296786dc0a',
            '000e3282c48fd7efb445',
            '1050696',
        $options
        );
        $temp = ['user_id' => $user->id,'type' => 'leavestream', 'count' => $counter];
        $pusher->trigger('my-audience', 'my-broadcast', $temp);
    }

    //Hold
    public function joinVideoCallChannel($channel=null)
    {
        $date = Carbon::now()->toDateString();
        $layouts= \App\Layout::where('layout_route', 'enroll')->first();
        if(isset($data->layout_id))
        {
            $layout_id = $data->layout_id;
        }
        elseif(isset($layouts->layout_id))
        {
            $layout_id = $layouts->layout_id;
        }
        else
        {
            $layout_id = '';
        }

        $settings = Settings::getSettings();
        $images = Settings::getImages();

        $setting = \App\Setting::orderBy('id', 'desc')->first();
        $image = $setting->SettingImage;


        if (is_file(DIR_IMAGE . $image->enroll)) {
            $logo = 'image/'.$image->enroll;
        } else {
            $logo = '';
        }

        $datas['logo'] = $logo;

        $datas['address'] = $setting->address;
        $datas['phone'] = $setting->telephone;
        $main_content = \App\Module::getModules($layout_id, 'content_main');

        $datas['main_modules'] = array();
        foreach ($main_content as $main) {
            $cont= '\App\Http\Controllers\front\module\\'.$main->module_page.'Controller';
            $content_main = new $cont();
            $datas['main_modules'][] = array(
                'module' => $content_main->index($main->module_id,json_decode($main->setting)), );
        }

        $left_content = \App\Module::getModules($layout_id, 'content_left');
        $datas['left_content'] = array();
        foreach ($left_content as $left) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$left->module_page.'Controller';
            $left_module = new $lcontent();
            $datas['left_content'][] = array(
                'module' => $left_module->index($left->module_id,json_decode($left->setting)),
                );
        }

        $right_content = \App\Module::getModules($layout_id, 'content_right');
        $datas['right_content'] = array();
        foreach ($right_content as $right) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$right->module_page.'Controller';
            $right_module = new $lcontent();
            $datas['right_content'][] = array(
                'module' => $right_module->index($right->module_id,json_decode($right->setting)),
                );
        }

        $top_content = \App\Module::getModules($layout_id, 'content_top');
        $datas['top_content'] = array();
        foreach ($top_content as $top) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$top->module_page.'Controller';
            $top_module = new $lcontent();
            $datas['top_content'][] = array(
            'module' => $top_module->index($top->module_id,json_decode($top->setting)),
                );
        }

        $bottom_content = \App\Module::getModules($layout_id, 'content_bottom');
        $datas['bottom_content'] = array();
        foreach ($bottom_content as $bottom) {
            $lcontent= '\App\Http\Controllers\front\module\\'.$bottom->module_page.'Controller';
            $bottom_module = new $lcontent();
            $datas['bottom_content'][] = array(
                'module' => $bottom_module->index($bottom->module_id,json_decode($bottom->setting)),
            );
        }
        $datas['enroll'] = EnrollReservation::where('seo_url', $channel)->where('publish_status', '1')->orderBy('created_at', 'asc')->first();
        $datas['business_user'] = $datas['enroll']->employer_id;
        $enroll_type = Enroll::get();
        $videochannel = $channel."-videocall";
        $datas['channel'] = EnrollGroupVideoChannel::where('available_channel', $videochannel)->first();

        if($datas['channel'] != null)   {

            $datas['available_channel'] = $datas['channel']->available_channel;
        }
        else{
            $datas['available_channel'] = 'No Channel Found';

        }
        return view('front.enroll.videochannel', compact('datas', 'enroll_type'));
    }

    public function updateJoinVideoCall(Request $request)
    {

        $temp_channel = str_replace("-videocall", "", $request->channel);
        $data['enroll_reservation'] = EnrollReservation::where('seo_url', $temp_channel)->first();
        $stream_data = EnrollEmployerStream::where('channel', $request['channel'])->first();

        $employee = auth()->guard('employee')->user();
        $employer_id = $data['enroll_reservation']->employer_id;
        $reservation_id = $data['enroll_reservation']->id;
        $camera_profile = '480p_4';
        $message = '';
        $viewer_count = '';
        $active_user = [];
        $counter = '';
        $html='';

        if($stream_data != '' && $stream_data->channel == $request['channel']){
            $array_data = json_decode($stream_data->employee_id);
            $active_user = json_decode($stream_data->active_user);
            if(in_array($employee->id, $array_data)) {
                if(!in_array($employee->id, $active_user)){
                    $counter = $stream_data->counter + 1;
                    $viewer_count = $stream_data->total_count;
                    array_push($active_user, $employee->id);
                    EnrollEmployerStream::where('channel', $request['channel'])->update([
                        'counter' => $stream_data->counter + 1,
                        'active_user' => $active_user,
                    ]);
                }else{
                    $viewer_count = $stream_data->total_count;
                    $counter = $stream_data->counter;
                }
                $message = 'old_user';

            }else{
                array_push($array_data, $employee->id);
                array_push($active_user, $employee->id);
                $viewer_count = $stream_data->total_count + 1;
                $counter = $stream_data->counter + 1;
                EnrollEmployerStream::where('channel', $request['channel'])->update([
                    'employee_id' => json_encode($array_data),
                    'active_user' => json_encode($active_user),
                    'total_count' => $viewer_count,
                    'counter' => $counter,
                ]);
                $message = 'new_user';


            }
        }else{
            $viewer_count = 1;
            $counter = 1;

            $new_stream = EnrollEmployerStream::create([
                'employee_id' =>  json_encode([$employee->id]),
                'active_user' =>  json_encode([$employee->id]),
                'employer_id' =>  $employer_id,
                'reservation_id' => $reservation_id,
                'channel' => $request['channel'],
                'camera_profile'=> $camera_profile,
                'total_count' => $viewer_count,
                'counter' => $counter,
                'type' => 'enroll',

                'start_time' => now(),
            ]);
            $message = 'new_user';
            $array_data = json_decode($new_stream->active_user);
        }

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );
        $pusher = new Pusher(
            '6e2167f314296786dc0a',
            '000e3282c48fd7efb445',
            '1050696',
            $options
        );

        $html = '';
        foreach ($active_user as $user){
            $html .= '<li class="list-group-item" id="user_viewer_'.$user.'">'.Employees::getName($user).'</li>';
        }

        $temp = ['user_id' => $employee->id, 'viewer_count' => $viewer_count, 'counter' => $counter, 'html' => $html, 'type' => 'joinvideocall', 'message' => $message];
        $pusher->trigger('call-audience', 'call-business', $temp);
//        $pusher->trigger('my-channel', 'my-event', $temp);
        return $temp;

    }

    public function leaveVideoCall(Request $request){

        $user = auth()->guard('employee')->user();
        $enroll_stream = EnrollEmployerStream::where('channel', $request['channel'])->first();
        // if ($enroll_stream != null) {
        if ($enroll_stream->counter > 1) {
            $counter = $enroll_stream->counter - 1 ;
            $enroll_stream->active_user = json_encode(array_diff(json_decode($enroll_stream->active_user),[$user->id]));
        }
        else{
            $counter = 1;
        }
        $enroll_stream->counter = $counter;
        $enroll_stream->save();

        // pusher
        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
        );

        $pusher = new Pusher(
            '6e2167f314296786dc0a',
            '000e3282c48fd7efb445',
            '1050696',
            $options
        );
        $temp = ['user_id' => $user->id,'type' => 'leavevideocall', 'count' => $counter];
        $pusher->trigger('call-audience', 'call-business', $temp);
        return $temp;
    }

}
