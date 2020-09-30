<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Invoice;
use App\UserGroup;
use App\Setting;
use App\InvoiceHistory;
use App\InvoiceItem;
use App\EventInvoiceStatus;
use App\EventReservation;
use App\EventTicket;
use DB;
use Mail;
use App\Employee;
use App\library\Settings;
use App\library\myFunctions;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $invoice = Invoice::where('payment_type', 'Bank Transer')->with('employee')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.invoice.index')->with('datas', $invoice);
    }

    public function show(Invoice $invoice)
    {
        $data['invoice'] = $invoice->load('invoiceItem', 'invoiceHistory');
        $setting = Setting::first();
        $data['logo'] = $setting->settingImage['logo'];
        $data['store'] = $setting->name;
        $data['store_address'] = $setting->address;
        $data['store_phone'] = $setting->telephone;
        $data['store_email'] = $setting->email;
        $data['employee_id'] = $invoice->invoice_by;
        return view('admin.invoice.editform')->with('data', $data);
    }

    public function addHistory(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $opt = \App\Payments::where('payment_page', 'Bank')->first();
            $setting = json_decode($opt->setting);
            $employee = Employee::where('id', $request->employee_id)->first();
            
            Invoice::where('id', $request->invoice_id)->update(['invoice_status' => $request->status]);
            InvoiceHistory::create([
                'invoice_id' => $request->invoice_id, 
                'invoice_status' => $request->status, 
                'notify' => $request->notify_customer,
                'comment' => $request->comment
                ]);
            $invoice_item = InvoiceItem::where('invoice_id', $request->invoice_id)->first();
            
            if($invoice_item->ticket_type_id != null){
                    $created_ticket_id = [];
                    for($i=0; $i<$invoice_item->quantity; $i++){
                        $latest_ticket = EventTicket::where([
                            ['event_id', $invoice_item->product_id],
                            ['ticket_type_id', $invoice_item->ticket_type_id],
                        ])->orderBy('created_at', 'desc')
                        ->first();
                        if($latest_ticket == null){
                            $ticket_no = $invoice_item->product_id.'-'.$invoice_item->ticket_type_id.'-1';
                        }else{
                            $t = explode('-', $latest_ticket->ticket_no);
                            $new_t = $t[2]+1;
                            $ticket_no = "$t[0]"."-$t[1]-".$new_t;
                        }
                        $ticket = EventTicket::create([
                            'event_id' => $invoice_item->product_id,
                            'ticket_type_id' => $invoice_item->ticket_type_id,
                            'ticket_no' => $ticket_no,
                            // 'quantity' => $invoice_item->quantity,
                            'employee_id' => $employee->id
                        ]);
                        array_push($created_ticket_id, $ticket->id);
                    }
                } else {
                    $event_reservation = EventReservation::create([
                        'event_id' => $invoice_item->product_id,
                        'employee_id' => $employee->id
                    ]);
            }
            EventInvoiceStatus::updateOrCreate(
                ['event_id' => $request->event_id, 'employee_id' => $employee->id],
                [ 'invoice_status' => $request->status]
            );
    
            $mydata = array(
                'logo' => Settings::getImages()->logo,
                'to_name' => $employee->firstname.' '.$employee->lastname, 
                'from_name' => Settings::getSettings()->name,
                'to_email' => $employee->email,
                'from_email' => Settings::getSettings()->email
            );
            if($request->notify_customer)
            {
                // set_time_limit(600);
                // myFunctions::setEmail();
                $mydata['comment'] = $request->comment;
                $mydata['invoice_detail'] = Invoice::where('id',$request->invoice_id)->first();
                Mail::send('mail.invoice_history', ['data' => $mydata], function($mail) use ($mydata){
                    $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject('Invoice for the Event');
                });
            }

            if($invoice_item->ticket_type_id != null){
                $mydata['ticket'] = EventTicket::whereIn('id', $created_ticket_id)->with('event', 'employee', 'ticketType')->get();
                Mail::send('mail.event_ticket', ['data' => $mydata], function($mail) use ($mydata){
                    $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject("Tickets for the Event.");
                });
            }

            DB::commit();
            return redirect()->back();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('alert-danger', $e->getMessage());
            return response()->json(['error' => $e->getMessage()]);
            // something went wrong
        }
    }

    public function print(Invoice $invoice)
    {
        $data['invoice'] = $invoice;
        $setting = Setting::first();
        $data['logo'] = $setting->settingImage['logo'];
        $data['store'] = $setting->name;
        $data['store_address'] = $setting->address;
        $data['store_phone'] = $setting->telephone;
        $data['store_email'] = $setting->email;
        return view('admin.invoice.print')->with('data', $data);
    }

    public function delete($invoice_id)
    {
        DB::beginTransaction();
        try {
            InvoiceItem::where('invoice_id', $invoice_id)->delete();
            InvoiceHistory::where('invoice_id', $invoice_id)->delete();
            Invoice::where('id', $invoice_id)->delete();
            DB::commit();
            return redirect()->back();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            \Session::flash('alert-danger', $e->getMessage());
            return redirect()->back();
            // something went wrong
        }
    }
}
