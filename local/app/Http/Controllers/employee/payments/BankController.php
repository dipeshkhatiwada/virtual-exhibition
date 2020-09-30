<?php

namespace App\Http\Controllers\employee\payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payments;
use App\Invoice;
use App\InvoiceItem;
use App\InvoiceHistory;
use App\Employee;
use App\EventReservation;
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use File;
use Validator;
use App\library\Settings;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DB;

class BankController extends Controller
{
	public function index()
	{
		$opt = \App\Payments::where('payment_page', 'Bank')->first();
		$setting = json_decode($opt->setting);
		return view('employee.payments.bank')->with('data', $setting);
	}

	public function success(Request $request)
	{
		// dd(auth()->guard('employee')->user()->id);
		DB::beginTransaction();
		try {
			if (Session()->has('cart_id') && Session()->has('total_amount') && Session()->has('job_id')) {
				$order_id =  Session()->get('cart_id');
				$opt = \App\Payments::where('payment_page', 'Bank')->first();
				$setting = json_decode($opt->setting);
				$image = '';
				
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
					'invoice_status' => $setting->invoice_status,
					'payment_type' => 'Bank Transer'
				]);
				if(isset($invoice->id)){
					$job_ids = Session()->get('job_id');
					foreach ($job_ids as $key => $job) {
						$type = '';
						$name = '';
						$cart = \App\IndividualCart::where('id',$job)->first();

						// if($cart->ticket_type_id != null){
						// 	$ticket = EventReservation::where([
						// 		['event_id', $cart->jobs_id],
						// 		['ticket_type_id', $cart->ticket_type_id],
						// 	])->orderBy('created_at', 'desc')
						// 	->first();
						// 	if($ticket == null){
						// 		$ticket_no = $cart->jobs_id.'-'.$cart->ticket_type_id.'-1';
						// 	}else{
						// 		$t = explode('-', $ticket->ticket_no);
						// 		$new_t = $t[2]+1;
						// 		$ticket_no = "$t[0]"."-$t[1]-".$new_t;
						// 	}
						// 	$event_reservation = EventReservation::create([
						// 		'event_id' => $cart->jobs_id,
						// 		'ticket_type_id' => $cart->ticket_type_id,
						// 		'ticket_no' => $ticket_no,
						// 		'no_of_tickets' => $cart->quantity,
						// 		'employee_id' => $employee->id
						// 	]);
						// } else {
						// 	$event_reservation = EventReservation::create([
						// 		'event_id' => $cart->jobs_id,
						// 		'employee_id' => $employee->id
						// 	]);
						// }
						
						InvoiceItem::create([
							'invoice_id' => $invoice->id, 
							'product_id' =>  $cart->jobs_id, 
							'quantity' => $cart->quantity,
							'ticket_type_id' => $cart->ticket_type_id,
							'name' => \App\Event::getTitle($cart->jobs_id),
							'type' => 'Events',
							'duration' => $cart->duration,
							'amount' => $cart->total_amount
						]);
					}
		
					InvoiceHistory::create([
						'invoice_id' => $invoice->id, 
						'invoice_status' => $setting->invoice_status, 
						'notify' => 1,
						'comment' => 'Invoice Placed Successfully',
						'document' => $image
					]);


					// EventReservation::create([
					// 	'event_id' => $cart->jobs_id,
					// 	'ticket_type_id',
					// 	'ticket_no',
					// 	'no_of_tickets',
					// 	'employee_id' => $employee->id
					// ]);
		
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

				}
		
		
				Session()->forget('job_id');
				Session()->forget('cart_id');
				Session()->forget('total_amount');
				\App\IndividualCart::where('employees_id', auth()->guard('employee')->user()->id)->delete();
				\Session::flash('alert-success','Record have been saved Successfully');
				DB::commit();
				return redirect('employee/event/report');
				
			} else{
				// dd('session not found');
				\Session::flash('alert-danger', 'Session not found');
				return redirect('employee/invoice');
			}
		} catch (\Exception $e) {
			DB::rollback();
			// dd($e->getMessage());
			// something went wrong
			\Session::flash('alert-danger', $e->getMessage());
			return redirect('employee/invoice');
		}
	}
}
