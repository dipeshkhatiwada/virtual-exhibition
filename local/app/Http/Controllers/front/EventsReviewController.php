<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Review;
use Auth;

class EventsReviewController extends Controller
{
    public function addReview(Request $request, $event_id)
    {
        $employee = Auth::guard('employee');
        $employer = Auth::guard('employer');
    
        $review = Review::create([
            "event_id" => $event_id,
            "employee_id" => $employee->check()?$employee->user()->id:null,
            "employers_id" => $employer->check()?$employer->user()->id:null,
            "review" => $request->review,
            "rating" => $request->rating,
            ]);
            
        return response()->json(["message" => "review successfully added.", "data" => $review], 200);
     }
        
    public function addComment(Request $request)
    {
        $reviews = Review::where('event_id', $event_id)->with('employer', 'employee')->get();
        return response()->json(["message" => "comment successfully loaded.", "data" => $reviews], 200);
    }
}
