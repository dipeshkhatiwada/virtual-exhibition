<?php

namespace App\Http\Controllers\API;

use App\EnrollReservation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imagetool;
use Mail;
use App\library\Settings;
use Carbon\Carbon;
use App\library\EnrollSettings;


class EmployerEnrollController extends Controller
{

    public function index()
    {
        $reservations = \App\EnrollReservation::where('employer_id', auth()->guard('employer-api')->user()->employers_id)
        ->with('boothreserves')
        ->orderBy('created_at', 'desc')
        ->get();
        return response()->json($reservations, 200);

    }

    public function store(Request $request)
    {

        $request->validate([
            'fair_detail' => 'required|mimes:pdf,doc,docx',
            'exhibition_category' => 'required',
            'company_name' => 'required',
            'intro_video' => 'required',
            'description' => 'required',
            'booth_name' => 'required',
            'booth_type' => 'required',
            'item_price' => 'required',
            'company_site' => 'required',
            'photo' => 'required',
            'banner' => 'required',
            'seo_url' => 'required',
            'exhibition_date' => 'required',
            'to_date' => 'required',
        ]);

        $datas = $request->all();

        $reservation = new EnrollReservation();
        $reservation->category_id = $datas['exhibition_category'];
        $reservation->employer_id = auth()->guard('employer-api')->employers_id;

        $reservation->company_name = $datas['company_name'];
        $reservation->seo_url = $datas['seo_url'];
        $reservation->company_website = $datas['company_site'];
        $intro_id = $this->YoutubeID($datas['intro_video']);
        $reservation->intro_video = $intro_id ;
        $reservation->start_date = $datas['exhibition_date'];
        $reservation->end_date = $datas['to_date'];
        $reservation->description = $datas['description'];

        if($request['chat_facility'] != null)
        {
            $chat_f = 1;
        }else{
            $chat_f = 0;
        }
        $reservation->chat_facility = $chat_f;
        if($request['video_call'] != null)
        {
            $video_f = 1;
        }else{
            $video_f = 0;
        }
        $reservation->video_facility = $video_f;
        if($request['livestream'] != null)
        {
            $livestream_f = 1;
        }else{
            $livestream_f = 0;
        }
        $reservation->livestream_facility = $livestream_f;

        $reservation->payment_status = 0;

            //Fair detail
        if($request->hasFile('fair_detail'))
            {
            $file_temp = $request->file('fair_detail');
            if($file_temp->isValid()){
                $filenameWithExtension = $file_temp->getClientOriginalName();
                $extension = $file_temp->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                $filenameToStore = $filenameWithoutExtension.'_'.time().'.'.$extension;
                $path = $file_temp->move(DIR_IMAGE.'companies/fairDetails', $filenameToStore);
                $reservation->fair_detail = $path;

            }

        }
        $reservation->save();
        $reservation_id = $reservation->id;

        //Video
        if(isset($request->video)){
            foreach($request->video as $key => $video){
                if(trim($video['vlink']) != ''){
                    $vid = $this->YoutubeID($video['vlink']);
                    $data = [
                        'reservation_id' => $reservation_id,
                        'title' => $video['vtitle'],
                        'link' => $vid,
                    ];
                    \App\EnrollVideo::create($data);
                }
            }
        }
        //Photo
        if (isset($request->photo)) {
            foreach($request->photo as $key => $photo) {
                if (trim($photo['title']) != '') {
                $data = [
                    'reservation_id' => $reservation_id,
                    'title' => $photo['title'],
                    'image' => $photo['image'],
                    'description' => $photo['description']
                ];
                \App\EnrollPhoto::create($data);
                }
            }
        }
        //Banner
        if (isset($request->banner)) {
            foreach($request->banner as $key => $banner) {
                if (trim($banner['title']) != '') {
                $data = [
                    'reservation_id' => $reservation_id,
                    'title' => $banner['title'],
                    'image' => $banner['image'],
                ];
                \App\EnrollBanner::create($data);
                }
            }
        }

        // Booth Reserve
        foreach ($datas['booth_name'] as $key=>$val)
        {

            $booth = new \App\BoothReserve();
            $booth->reservation_id = $reservation_id;
            $booth->employer_id = auth()->guard('employer-api')->employers_id;
            $temp_name = \App\Booth::select('booth_name')->where('id', $val)->first();
            $booth->booth_name = $temp_name['booth_name'];
            $type_id = $datas['booth_type'][$key];
            $temp = \App\BoothTicketType::select('ticket_name', 'price')->where('id', $type_id)->first();
            $booth->booth_type = $temp['ticket_name'];
            $booth->price = $temp['price'];
            $booth->save();
        }

        $total_price = \App\BoothReserve::where('reservation_id', $reservation_id)->sum('price');
            EnrollReservation::where('id', $reservation_id)->update([
                'total_price' => $total_price
        ]);
        $employer = \App\Employers::where('id', auth()->guard('employer-api')->user()->employers_id)->first();

        $mydata = array(
            'to_name' => $employer->name,
            'to_email' => $employer->email,
            'subject' => 'Booking Conformation for the Virtual Exhibition',
            'text' => 'This email is to notify that your booth(s) for the upcoming virtual exhibition has been successfully booked. We will reach to you soon for more details.',
            // 'invoice_detail' => EnrollInvoice::where('id',$invoice->id)->first(),
            'from_name' => Settings::getSettings()->name,
            'logo' => Settings::getImages()->logo,
            'from_email' => Settings::getSettings()->email,
            'store_address' => Settings::getSettings()->address,
            'store_phone' => Settings::getSettings()->telephone,
        );

        Mail::send('employer.enroll.mail.application', ['data' => $mydata], function($mail) use ($mydata){
            $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject($mydata['subject']);
        });

        return response()->json(['message'=> "Successufully reserved", 200]);

    }

    public function YoutubeID($url)
    {
        if(strlen($url) > 11)
        {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match))
            {
                return $match[1];
            }
            else
                return false;
        }

        return $url;
    }

    public function update(Request $request, $id=null)
    {
        $data = $request->all();
        if ($request->hasFile('fair_detail')) {
            $file_temp = $request->file('fair_detail');
            if ($file_temp->isValid()) {
                $filenameWithExtension = $file_temp->getClientOriginalName();
                $extension = $file_temp->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
                $filenameToStore = $filenameWithoutExtension.'_'.time().'.'.$extension;
                $path = $file_temp->move(DIR_IMAGE.'companies/fairDetails', $filenameToStore);
                $fair_detail = $path;
            }
        }else{
            $fair_detail = '';
        }

        if($data['intro_video'])
        {
            $vid = $this->YoutubeID($data['intro_video']);
        }

        \App\EnrollReservation::where('id', $id)->update([
        'category_id' => $data['exhibition_category'],
        'company_name' => $data['company_name'],
        'company_website' => $data['company_site'],
        'employer_id' => auth()->guard('employer-api')->user()->employers_id,
        'intro_video' => $vid,
        'description' => $data['description'],
        'start_date' => $data['exhibition_date'],
        'end_date' => $data['to_date'],
        'payment_status' => '0',
        'fair_detail' => $fair_detail,
        ]);
        return response()->json(['message'=> 'updated successfully', 'code' => 200]);

    }

    public function delete($id = null)
    {
        \App\BoothReserve::where('reservation_id', $id)->delete();
        \App\EnrollPhoto::where('reservation_id',$id)->delete();
        \App\EnrollVideo::where('reservation_id', $id)->delete();
        \App\EnrollBanner::where('reservation_id', $id)->delete();
        \App\EnrollReservation::find($id)->delete();
        return response()->json(['message'=>'Deleted Successfully', 'code' =>200 ]);
    }

    public function dashboard()
    {

        $employer = \App\Employers::where('id', auth()->guard('employer-api')->user()->employers_id)->first();
        $pr = 0;
        if($employer->org_type != 0)
        {
            $pr += 1;
        }
        if($employer->ownership != 0)
        {
            $pr += 1;
        }
        if($employer->logo != '')
        {
            $pr += 1;
        }
        if($employer->banner != '')
        {
            $pr += 1;
        }
        if($employer->description != '')
        {
            $pr += 1;
        }
        if($employer->approval != 0)
        {
            $pr += 1;
        }

        $address = $employer->EmployerAddress;
        $head = $employer->EmployerHead;
        $contactperson = $employer->EmployerContactPerson;
        if($address->phone != '')
        {
            $pr += 1;
        }

        if($address->secondary_email != '')
        {
            $pr += 1;
        }
        if($address->fax != '')
        {
            $pr += 1;
        }
        if($address->pobox != '')
        {
            $pr += 1;
        }
        if($address->website != '')
        {
            $pr += 1;
        }
        if($address->address != '')
        {
            $pr += 1;
        }
        if($address->country != '')
        {
            $pr += 1;
        }
        if($address->city != '')
        {
            $pr += 1;
        }
        if($address->billing_address != '')
        {
            $pr += 1;
        }

        if($contactperson->phone != ''){
            $pr += 1;
        }
        if($contactperson->name != ''){
            $pr += 1;
        }
        if($contactperson->designation != ''){
            $pr += 1;
        }
        if($contactperson->email != ''){
            $pr += 1;
        }
        if($head->name != ''){
            $pr += 1;
        }
        if($head->designation != ''){
            $pr += 1;
        }
        $employer_id = $employer->id;
        $percent = ($pr / 21) * 100;
        $datas['profile_complete'] = number_format($percent);
        $today = Carbon::now()->toDateString();

        $datas['enroll'] = EnrollReservation::where('employer_id', auth()->guard('employer-api')->user()->employers_id)
        ->with('boothreserves')
        ->with('viewers')
        ->orderBy('created_at', 'desc')
        ->paginate(50);
        // dd($datas);
        $datas['participator']= 0;
        $datas['total_booth'] = 0;
        $datas['pending'] = 0;
        $datas['amount'] = 0;
        foreach ($datas['enroll'] as $key => $val)
        {
            foreach($val['viewers'] as $viewer)
            {
                $datas['participator'] += $viewer->count();
            }
            foreach($val['boothreserves'] as $booth)
            {
                if($booth->status == 0)
                {
                    $datas['pending'] += 1;
                }
            }

            $datas['amount'] += $val->total_price;
            $datas['total_booth'] += $val['boothreserves']->count();
        }
        $datas['active'] = EnrollReservation::where('employer_id', auth()->guard('employer-api')->user()->employers_id)->where('publish_status', 1)
                            ->with('boothreserves')
                            ->orderBy('created_at', 'desc')
                            ->with('viewers')
                            ->paginate(50);

        $datas['inactive'] = EnrollReservation::where('employer_id', auth()->guard('employer-api')->user()->employers_id)->where('publish_status', 0)
                            ->with('boothreserves')
                            ->with('viewers')
                            ->orderBy('created_at', 'desc')
                            ->paginate(50);


        return response()->json($datas, 200);
    }

    public function getBoothType($id=null )
    {
        $ticket_type = \App\BoothTicketType::where('booth_id', $id)->get();
        return response()->json($ticket_type, 200);

    }

    public function getBoothPrice($id=null)
    {
        $ticket_price = \App\BoothTicketType::where('id',$id)->first();
        return response()->json($ticket_price, 200);
    }

    public function deleteBooth($id=null)
    {
        \App\BoothReserve::where('id', $id)->delete();
        return response()->json(['message'=> 'Booth Deleted Successfully', 'status'=>200]);
    }

    //Agora
    public function checkLivestreamPlatform($slug = null)
    {

        $data['enroll'] = EnrollReservation::where('seo_url', $slug)->first();
        if($data['enroll']->platform == "agora")
        {
            $data = EnrollSettings::livestream($data['enroll']->seo_url);
            return response()->json($data, 200);
        }else{
            return response()->json(['message'=>'Required Platform not found', 'status'=>404]);
        }

    }

    public function storeStartTime($channel=null){
        \App\EnrollEmployerStream::where('channel', $channel)->update([
            'start_time' => now()
        ]);
        return response()->json(['message'=>'start time store successfully', 'status'=>200]);
    }

    public function storeEndTime($channel=null){
        \App\EnrollEmployerStream::where('channel', $channel)->update([
            'end_time' => now()
        ]);
        return response()->json(['message'=>'end time store successfully', 'status'=>200]);
    }


    public function checkVideoCallPlatform($channel=null)
    {

        $data['enroll'] = EnrollReservation::where('seo_url', $channel)->first();
        if($data['enroll']->platform == "agora")
        {
            $datas = EnrollSettings::videoCall($channel);
            return response()->json($datas, 200);
        }else{
            return response()->json(['message'=>'Required Platform not found', 'status'=>404]);
        }

    }

    public function saveVideoCallChannel($channel=null)
    {
        $data['res'] = EnrollReservation::where('seo_url', $channel)->first();
        $data['group_channel'] = \App\EnrollGroupVideoChannel::where('reservation_id', $data['res']->id)->first();
        if($data['group_channel'] != null){
            return;
        }else{
            \App\EnrollGroupVideoChannel::create([
                'reservation_id' => $data['res']->id,
                'available_channel' => $channel,
                'start_time' => now()
            ]);
            return response()->json(['message'=>'group channel created', 'status'=>200]);
        }
    }

    public function deleteVideoCallChannel( $channel )
    {
        \App\EnrollEmployerStream::where('channel', $channel)->update([
            'end_time' => now()
        ]);
        \App\EnrollGroupVideoChannel::where('available_channel', $channel)->delete();
        return response()->json(['message'=>'channel deleted', 'status'=>200]);

    }


}
