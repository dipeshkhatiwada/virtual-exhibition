<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Event;
use App\EventReservation;
use Auth;

class EventReservationControler extends Controller
{
    public function bookEvent(Event $event)
    {
        EventReservation::create([
            'event_id' => $event->id,
            'employee_id' => Auth::guard('employee')->user()->id
        ]);
        return response()->json(['msg' => 'sucessfully Booked']);
    }
}
