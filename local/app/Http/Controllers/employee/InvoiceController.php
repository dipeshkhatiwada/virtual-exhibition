<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Invoice;
use App\Setting;
use App\InvoiceHistory;
use App\InvoiceItem;
use DB;
use Mail;
use App\Employee;
use App\library\Settings;
use App\library\myFunctions;

class InvoiceController extends Controller
{
    public function index ()
    {
        $invoice = Invoice::where('invoice_by', auth()->guard('employee')->user()->id)
        ->with('invoiceHistory')
        ->orderBy('created_at', 'desc')
        ->paginate(50);
        $datas = $invoice;
        // dd($datas);
        return view('employee.invoice.index')->with('datas', $invoice);
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
        return view('employee.invoice.editform')->with('data', $data);
    }

    public function addHistory(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $opt = \App\Payments::where('payment_page', 'Bank')->first();
            $setting = json_decode($opt->setting);
            $employee = Employee::where('id',auth()->guard('employee')->user()->id)->first();
    
            if ($request->hasFile('file'))  {
                $directory = DIR_IMAGE.'checkout';
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
                $this->validate($request,['file'=>'mimes:jpeg,jpg,png,gif|max:10000',]);
                $file = $request->File('file');
                $image = str_random(10).'.'.$file->getClientOriginalExtension();
                $file->move($directory, $image);
            }
            
            InvoiceHistory::create([
                'invoice_id' => $request->invoice_id, 
                'invoice_status' => $setting->invoice_status, 
                'notify' => 1,
                'comment' => 'Invoice Placed Successfully',
                'document' => $image
            ]);
    
            $mydata = array(
                'to_name' => $employee->firstname.' '.$employee->lastname, 
                'to_email' => $employee->email,
                'subject' => 'Invoice for the Event',
                'invoice_detail' => Invoice::where('id',$request->invoice_id)->first(),
                'from_name' => Settings::getSettings()->name,
                'logo' => Settings::getImages()->logo,
                'from_email' => Settings::getSettings()->email,
                'store_address' => Settings::getSettings()->address,
                'store_phone' => Settings::getSettings()->telephone,
            );
            // set_time_limit(600);
            // myFunctions::setEmail();
            Mail::send('mail.job_invoice', ['data' => $mydata], function($mail) use ($mydata){
                $mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject($mydata['subject']);
            });

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
        return view('employee.invoice.print')->with('data', $data);
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
