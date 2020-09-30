<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IndividualCart;
use App\Event;
use Auth;
use App\TicketType;

class IndividualCartController extends Controller
{
    public function addToIndividualCart(Request $request)
    {
        Session()->forget('job_id');
        Session()->forget('cart_id');
        Session()->forget('total_amount');

        \App\IndividualCart::where('employees_id', auth()->guard('employee')->user()->id)->delete();
        $event = Event::where('id', $request->event_id)->first();
        $employee_id = Auth::guard("employee")->user()->id;
        $rate = $request['ticket_price']== 'undefined' ?$event->price:$request['ticket_price'];
        $quantity = $request['quantity']== 'undefined' ?1:$request['quantity'];
        IndividualCart::create([
            "employees_id" => $employee_id,
            "jobs_id" => $event->id,
            "quantity" => $quantity,
            "type" => "Events",
            "rate" => $rate,
            "total_amount" => $request['ticket_price']== 'undefined' ?$rate*$quantity:$request['ticket_price']*$quantity,
            "ticket_type_id" => $request['ticket_type']== 'undefined' ?null:$request['ticket_type']
        ]);

        return response()->json(["message" =>"sucessfully inserted"], 200);
    }

    public function delete(IndividualCart $cart)
    {
        $cart->delete();
        return response()->json(["message" => "sucessfully removed"], 200);
    }

    public function showCart()
    {
        $employee_id = Auth::guard("employee")->user()->id;
        $carts = IndividualCart::where('employees_id', $employee_id)
            ->get();
        $datas = [];
        $datas['total_amount'] = 0;
        $job_id = [];
        $datas['cart'] = [];
        foreach ($carts as $cart) {
          $job_id[] = $cart->id;
            $datas['total_amount'] += $cart->total_amount;
            $datas['cart'][] = [
                'id' => $cart->id,
                'job_type_id' => $cart->job_type_id,
                'job_type' => $cart->job_type,
                'type' => $cart->type,
                'duration' => $cart->duration,
                'job_number' => $cart->number_of,
                'rate' => $cart->rate,
                'total_amount' => $cart->total_amount,
                'quantity' => $cart->quantity,
                "event_title" => Event::where('id', $cart->jobs_id)->first()->title,
                'ticket_type' => $cart->ticket_type_id != null ? TicketType::where('id', $cart->ticket_type_id)->first()->name:'',

            ];
        }
        session(['cart_id' => rand(9999,15), 'total_amount' => $datas['total_amount'], 'job_id' => $job_id]);
        return view('employee.cart')->with('datas', $datas);
    }
}
