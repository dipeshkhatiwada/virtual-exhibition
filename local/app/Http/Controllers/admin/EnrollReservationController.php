<?php

namespace App\Http\Controllers\admin;

use App\BoothReserve;
use App\Enroll;
use App\EnrollBanner;
use App\EnrollPhoto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EnrollReservation;
use App\EnrollVideo;
use Illuminate\Support\Facades\DB;
use Mail;
use App\library\Settings;

class EnrollReservationController extends Controller
{
    public function detailReservation()
    {
        $reservations = EnrollReservation::get();

        foreach($reservations as $key => $res)
        {
            $booth_res = BoothReserve::where('reservation_id', $res->id)->get();
            $reservations[$key]->booth_res = $booth_res;

            $unpaid_booth = BoothReserve::where('reservation_id', $res->id)->where('status', 0)->get();
            $reservations[$key]->unpaid_booth = $unpaid_booth;

            $paid_booth = BoothReserve::where('reservation_id', $res->id)->where('status', 1)->get();
            $reservations[$key]->paid_booth = $paid_booth;

        }
        return view('admin.enroll.reservation_details', compact('reservations'));
    }

    public function updatePublishStatus(Request $request, $id = null)
    {


        $reserve = EnrollReservation::find($id);
        if($reserve->publish_status == 1){
            $reserve->publish_status = 0;
        } else {
            $reserve->publish_status = 1;
            $employer = \App\Employers::where('id',$reserve->employer_id)->first();
            $mydata = array(
                'to_name' => $employer->name,
                'to_email' => $employer->email,
                'subject' => 'Booking Approval for the Virtual Exhibition',
                'text' => 'Thanking you for signing up for the virtual exhibition. We have successfully processed your booking. If your have any further questions, please feel free to contact us.',
                // 'invoice_detail' => EnrollInvoice::where('id',$invoice->id)->first(),
                'from_name' => Settings::getSettings()->name,
                'logo' => Settings::getImages()->logo,
                'from_email' => Settings::getSettings()->email,
            );

            Mail::send('admin.enroll.mail.application', ['data' => $mydata], function($mail) use ($mydata){
                $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject($mydata['subject']);
            });

        }
        $reserve->save();


    }

    public function updatePlatform(Request $request)
    {
        EnrollReservation::where('id', $request['reservationId'])->update([
            'platform' => $request['platform']
        ]);
        // return $request->all();
    }
    public function destroyReservation($id=null)
    {
        BoothReserve::where('reservation_id', $id)->delete();
        EnrollPhoto::where('reservation_id',$id)->delete();
        EnrollVideo::where('reservation_id', $id)->delete();
        EnrollBanner::where('reservation_id', $id)->delete();
        EnrollReservation::find($id)->delete();
        // $abc = EnrollReservation::where('id', $id)
        //     ->with('boothreserves')
        //     ->with('photos')
        //     ->with('videos')
        //     ->with('banners')
        //     ->delete();
        // $abc->delete();
            // EnrollReservation::find($id)->delete();
        return redirect()->back();
    }
}
