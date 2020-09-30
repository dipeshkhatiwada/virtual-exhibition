<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\library\Settings;
use Carbon\Carbon;
use Pusher\Pusher;
use App\ChatMessage;



class FrontEnrollController extends Controller
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

            $datas['enroll'] = \App\EnrollReservation::where('publish_status', '1')->paginate(50);

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


            $datas['enroll_type'] = \App\Enroll::get();

            return response()->json($datas, 200);
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

        $datas['enroll_type'] = \App\Enroll::get();
        $datas['category'] = \App\Category::where('seo_url', $slug)->first();
        $datas['enroll'] = \App\EnrollReservation::where('category_id',$datas['category']->id)->where('publish_status', '1')->paginate(50);
        return response()->json($datas, 200);
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

        $datas['enroll'] = \App\EnrollReservation::where('seo_url', $slug)->first();
        $datas['stream'] = \App\EnrollEmployerStream::where('channel', $datas['enroll']->seo_url)->first();
        $datas['business_user'] = \App\Employers::where('id', $datas['enroll']->employer_id)->first();

        $datas['enroll_type'] = \App\Enroll::get();

        $datas['channel'] = $slug;
        $datas['viewer'] = 1;

        return response()->json($datas, 200);
    }

    public function updateJoinedLivestream(Request $request)
    {

        $stream_data = \App\EnrollEmployerStream::where('channel', $request['channel'])->first();
        $employee = auth()->guard('employee')->user();
        $data = \App\EnrollReservation::where('seo_url', $request['channel'])->first();
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
                    \App\EnrollEmployerStream::where('channel', $request['channel'])->update([
                        'employee_id' => json_encode($array_data),
                        'total_count' => $viewer_count,
                        'counter' => $counter,
                    ]);
                    $message = 'new_user';


                }
        }else{
            $viewer_count = 1;
            $counter = 1;

            \App\EnrollEmployerStream::create([
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
        return response()->json($temp, 200);

    }

    public function streamLeave(Request $request)
    {

        $enroll_stream = \App\EnrollEmployerStream::where('channel', $request['channel'])->first();
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
        $datas['enroll'] = \App\EnrollReservation::where('seo_url', $channel)->where('publish_status', '1')->orderBy('created_at', 'asc')->first();
        $datas['business_user'] = $datas['enroll']->employer_id;
        $datas['enroll_type'] = \App\Enroll::get();
        $datas['videochannel'] = $channel."-videocall";
        $datas['channel'] = \App\EnrollGroupVideoChannel::where('available_channel', $datas['videochannel'])->first();

        if($datas['channel'] != null)   {

            $datas['available_channel'] = $datas['channel']->available_channel;
        }
        else{
            $datas['available_channel'] = 'No Channel Found';

        }
        return response()->json($datas, 200);
    }
    public function updateJoinVideoCall(Request $request)
    {

        $temp_channel = str_replace("-videocall", "", $request->channel);
        $data['enroll_reservation'] = \App\EnrollReservation::where('seo_url', $temp_channel)->first();
        $stream_data = \App\EnrollEmployerStream::where('channel', $request['channel'])->first();

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
                    \App\EnrollEmployerStream::where('channel', $request['channel'])->update([
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
                \App\EnrollEmployerStream::where('channel', $request['channel'])->update([
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

            $new_stream = \App\EnrollEmployerStream::create([
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
        return response()->json($temp, 200);
    }

    public function leaveVideoCall(Request $request){

        $user = auth()->guard('employee')->user();
        $enroll_stream = \App\EnrollEmployerStream::where('channel', $request['channel'])->first();
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
        return response()->json($temp, 200);
    }

}
