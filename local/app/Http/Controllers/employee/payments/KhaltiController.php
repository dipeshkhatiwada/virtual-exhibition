<?php

namespace App\Http\Controllers\employee\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payments;
use App\Invoice;
use App\InvoiceItem;
use App\InvoiceHistory;
use App\Employee;
use App\IndividualCart;
use App\EventReservation;
use App\EventInvoiceStatus;
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use Carbon\Carbon;
use DB;

class KhaltiController extends Controller
{
	public function index()
	{
		$opt = \App\Payments::where('payment_page', 'Khalti')->first();
		$setting = json_decode($opt->setting);
        $data['amount'] = session()->get('total_amount');
        $data['productIdentity'] = session()->get('cart_id');
        $data['productName'] = "Events";
        $data['productUrl'] = \URL::to('/')."/events";
        $data['publicKey'] = $setting->public_key;
		return view('employee.payments.khalti')->with('data', $data);
	}

	public function verify(Request $request)
	{
		DB::beginTransaction();
		try {
			$opt = \App\Payments::where('payment_page', 'Khalti')->first();
			$setting = json_decode($opt->setting);
			$args = http_build_query(array(
				'token' => $request['token'],
				'amount'  => session()->get('total_amount')*100
			));

			$url = "https://khalti.com/api/v2/payment/verify/";

			# Make the call using API.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$headers = ['Authorization: Key '.$setting->secret_key];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			// Response
			$response = curl_exec($ch);
			$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			$total = Invoice::where('created_at', 'LIKE', date('Y').'%')->count();
			$new_number = $total + 1;
			$invoice_no = 'INV-'.date('Y').'-'.$new_number;
			$employee = Employee::where('id',auth()->guard('employee')->user()->id)->first();
			$address = $employee->employeeAddress;

            $invoice = Invoice::create([
				'invoice_by' => $employee->id,
				'invoice_no' => $invoice_no,
				'customer_name' => $employee->firstname.' '.$employee->lastname,
				'email' => auth()->guard('employee')->user()->email,
				'telephone' => $address->home_phone,
				'comment' => $request->comment,
				'amount' => Session()->get('total_amount'),
				'invoice_status' => 'Completed',
				'payment_type' => 'Khalti'
            ]);


			if(isset($invoice->id)){
				$job_ids = Session()->get('job_id');
				foreach ($job_ids as $key => $job) {
					$type = '';
					$name = '';
					$cart = IndividualCart::where('id',$job)->first();
					InvoiceItem::create([
						'invoice_id' => $invoice->id,
						'product_id' =>  $cart->jobs_id,
						// 'product_type' => $cart->job_type,
						'name' => \App\Event::getTitle($cart->jobs_id),
						'type' => 'Events',
						'duration' => $cart->duration,
						'amount' => $cart->total_amount
					]);
				}

				InvoiceHistory::create([
					'invoice_id' => $invoice->id,
					'invoice_status' => "Complete",
					'notify' => 1,
					'comment' => 'Invoice Placed Successfully',
				]);

				EventReservation::create([
					'event_id' => $cart->jobs_id,
					'employee_id' => $employee->id
				]);

				EventInvoiceStatus::updateOrCreate(
					['event_id' => $cart->jobs_id, 'employee_id' => $employee->id],
					[ 'invoice_status' => "Complete"]
				);

				$mydata = array(
					'to_name' => $employee->firstname.' '.$employee->lastname,
					'to_email' => auth()->guard('employee')->user()->email,
					'subject' => 'Invoice for the Event',
					'invoice_detail' => Invoice::where('id',$invoice->id)->first(),
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

				Mail::send('mail.event_ticket', ['data' => $mydata], function($mail) use ($mydata){
					$mail->to($mydata['to_email'],$mydata['to_name'])->from($mydata['from_email'],$mydata['from_name'])->subject($mydata['subject']);
				});
			}
			Session()->forget('job_id');
			Session()->forget('cart_id');
			Session()->forget('total_amount');
			\App\IndividualCart::where('employees_id', auth()->guard('employee')->user()->id)->delete();
			// \Session::flash('alert-success','');

			DB::commit();
			return response()->json(['message'  => 'Record have been saved Successfully', "response" => $response]);
		} catch (\Exception $e) {
			DB::rollback();
			// \Session::flash('alert-danger', $e->getMessage());
			return response()->json(['message'  => $e->getMessage()], 400);
		}
	}
}
