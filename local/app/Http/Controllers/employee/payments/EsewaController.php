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
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use Carbon\Carbon;
use DB;

class EsewaController extends Controller
{
	public function index()
	{
		$opt = \App\Payments::where('payment_page', 'Esewa')->first();
		$setting = json_decode($opt->setting);
		if ($setting->payment_mode == 2) {
			$data['action'] = 'https://esewa.com.np/epay/main';
			$data['payment_mode'] = 2;
		} else {
			$data['action'] = 'https://dev.esewa.com.np/epay/main';
			$data['payment_mode'] = 1;
		}

		$data['total_amount'] = session()->get('total_amount');
		$data['id'] = session()->get('cart_id');
		$data['scd'] = $setting->merchant_key;
		$data['su'] = url('employee/esewa/success');
		$data['fe'] = url('employee/cart');
		return view('employee.payments.esewa')->with('data', $data);
	}

	public function success(Request $request)
	{
		$order_id = 0;
		if(isset($request->oid)){
			$order_id= $request->oid;
		}
		if (Session()->has('cart_id') && Session()->has('total_amount') && Session()->has('job_id')) {
			if ($order_id == Session()->get('cart_id')) {
				DB::beginTransaction();
				try {
					$opt = \App\Payments::where('payment_page', 'Esewa')->first();
					$setting = json_decode($opt->setting);
					if ($setting->payment_mode == 2) {
						$esewa_verfication_url = 'https://esewa.com.np/epay/transrec';
					} else {
						$esewa_verfication_url = 'https://dev.esewa.com.np/epay/transrec';
					} 
					//create array of data to be posted
					$post_data['amt'] = Session()->get('total_amount');
					$post_data['scd'] = $setting->merchant_key;
					$post_data['pid'] = $order_id;
					$post_data['rid'] = $request->refId;
					
					//traverse array and prepare data for posting (key1=value1)
					foreach ($post_data as $key => $value) {
						$post_items[] = $key . '=' . $value;
					}
					
					//create the final string to be posted using implode()
					$post_string = implode('&', $post_items);

					//create cURL connection
					$curl_connection =  curl_init($esewa_verfication_url);

					//set options
					curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
					curl_setopt($curl_connection, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
					curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);
					
					//set data to be posted
					curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);
					
					//perform our request
					$result = curl_exec($curl_connection);
					
					if(curl_error($curl_connection)) {
						echo 'error:('.curl_errno($curl_connection).')' . curl_error($curl_connection);
					}
					else {
						$verification_response  = strtoupper( trim( strip_tags( $result ) ) ) ;
						if('SUCCESS' == $verification_response){
							$total = Invoice::where('created_at', 'LIKE', date('Y').'%')->count();
							$new_number = $total + 1;
							$invoice_no = 'INV-'.date('Y').'-'.$new_number;
							$employee = Employee::where('id',auth()->guard('employee')->user()->id)->first();
							$address = $employee->employeeAddress;
							$invoice = Invoice::create([
								'invoice_by' => $employee->id, 
								'invoice_no' => $invoice_no, 
								'customer_name' => $employee->name,
								'email' => auth()->guard('employee')->user()->email,
								'telephone' => $address->home_phone,
								'comment' => '',
								'amount' => Session()->get('total_amount'),
								'invoice_status' => $setting->invoice_status,
								'payment_type' => 'Esewa'
							]);
							if(isset($invoice->id)){
								$job_ids = Session()->get('job_id');
								foreach ($job_ids as $key => $job) {
									$type = '';
									$name = '';
									$cart = IndividualCart::where('id',$job)->first();
									invoiceItem::create([
										'invoice_id' => $invoice->id, 
										'product_id' => $cart->jobs_id, 
										// 'product_type' => $cart->job_type,
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
									'comment' => 'Invoice Placed Successfully'
								]);

								EventReservation::create([
									'event_id' => $cart->jobs_id,
									'employee_id' => $employee->id
								]);

								$mydata = array(
									'to_name' => $employee->name, 
									'to_email' => auth()->guard('employee')->user()->email,
									'subject' => 'Invoice for Event.',
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
							IndividualCart::where('employees_id', auth()->guard('employee')->user()->id)->delete();
							\Session::flash('alert-success','Record have been saved Successfully');
							return redirect('employee/invoice');
						}
						else{
							\Session::flash('alert-danger','Payment not success');
							return redirect('/employee/cart');
						}
					}
					//close the connection
					curl_close($curl_connection);
					DB::commit();
				} catch (\Exception $e) {
					DB::rollback();
					\Session::flash('alert-danger', $e->getMessage());
					return redirect('employee/invoice');
				}
			} else{
				\Session::flash('alert-danger','Cart id did not match');
				return redirect('employee/invoice');
			}
		} else{
			\Session::flash('alert-danger','session not found');
			return redirect('employee/invoice');
		}
	}
}
