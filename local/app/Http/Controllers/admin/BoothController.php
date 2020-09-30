<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booth;
use App\BoothTicketType;
use Mail;
use App\library\Settings;

class BoothController extends Controller
{

    public function create()
    {
        return view('admin.enroll.booth.create');
    }

    public function detail(Request $request)
    {


        $booth_types = BoothTicketType::get();
        $booths = Booth::get();
        return view('admin.enroll.booth.detail', compact('booths','booth_types'));

    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'booth_name' => 'required|min:2',
        ]);
        $data = $request->all();
        $enroll_booth = new Booth();
        $enroll_booth->booth_name = $data['booth_name'];
        $enroll_booth->save();
        return redirect('admin/enroll/add')->with('message', 'Booth/Stall has been added Successfully!');

    }

    public function saveBoothTicket(Request $request)
    {

        $request->validate([
            'booth_name' => 'required',
            'ticket' => 'required',
        ]);
        $data = $request->all();

        $enroll_booth = new Booth();
        $enroll_booth->booth_name = $data['booth_name'];
        $enroll_booth->save();
        $booth_id = $enroll_booth->id;

        //Booth
        if (isset($request->ticket)) {
            foreach($request->ticket as $key => $ticket) {
                if (trim($ticket['title']) != '') {
                $data = [
                'booth_id' => $booth_id,
                'ticket_name' => $ticket['title'],
                'price' => $ticket['price'],
                ];
                BoothTicketType::create($data);
                }
            }
        }
        return redirect('admin/enroll_booth/detail')->with('message', 'Booth/Stall Ticket has been added Successfully!');

    }

    public function addBooth($id=null, Request $request)
    {
        $booth = Booth::find($id);
        if($request->isMethod('post')){

            $this->validate($request, [
                'ticket' => 'required',
            ]);

            //Booth
            if (isset($request->ticket)) {
                foreach ($request->ticket as $key => $ticket) {
                    if (trim($ticket['title']) != '') {
                        $booth = new BoothTicketType();
                        $booth->booth_id = $request->boothId;
                        $booth->ticket_name = $ticket['title'];
                        $booth->price = $ticket['price'];
                        $booth->save();
                    }
                }
            }
            return redirect('/admin/enroll_booth/detail')->with('message', 'Booth Ticket added Successfully!');

        }
        return view('admin.enroll.booth.add_booth', compact('booth'));
    }

    public function editBoothAttribute(Request $request, $id)
    {
        $ticket_type = BoothTicketType::find($id);
        return view('admin.enroll.booth.edit', compact('ticket_type'));
    }

    public function updateBoothAttribute(Request $request, $id)
    {


        $datas = $request->all();
        Booth::where(['id' => $datas['idBooth']])->update([
            'booth_name' => $datas['booth_name'],
        ]);

        BoothTicketType::where(['id' => $id])->update([
            'ticket_name' => $datas['ticket'],
            'price' => $datas['price']
        ]);

        $reservation = \App\EnrollReservation::get();

        if ($reservation) {
            foreach ($reservation as $res) {
                $employer = \App\Employers::find($res->employer_id);
                $mydata = array(
                'to_name' => $employer->name,
                'to_email' => $employer->email,
                'subject' => 'Booth Updated for the Virtual Exhibition',
                'text' => 'We are immensely pleased to present you the updated booth details of the exhibitions. We hope you will find the exhibition more informativve and fruitful.',
                'from_name' => Settings::getSettings()->name,
                'from_email' => Settings::getSettings()->email,
                'logo' => Settings::getImages()->logo,
               );
                Mail::send('admin.enroll.mail.application', ['data' => $mydata], function($mail) use ($mydata){
                    $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject($mydata['subject']);
                });
            }

        }

        return redirect('admin/enroll_booth/detail')->with('message', 'Booth/Stall Detail has been updated Successfully!');

    }

    public function deleteBoothAttribute($id=null)
    {
        BoothTicketType::find($id)->delete();
        return redirect()->back()->with('message', 'Booth/Stall Attribute deleted successfully');
    }

    public function delete($id=null)
    {

        BoothTicketType::where('booth_id', $id)->delete();
        Booth::findorFail($id)->delete();
        return redirect()->back()->with('message', 'Booth/Stall Attribute deleted successfully');

    }

}
