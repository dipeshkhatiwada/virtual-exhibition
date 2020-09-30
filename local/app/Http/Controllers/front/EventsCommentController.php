<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Auth;

class EventsCommentController extends Controller
{
    public function showComment($event_id)
    {
        $comments = Comment::where('event_id', $event_id)->with('employer', 'employee')->get();
        return response()->json(["message" => "comment successfully loaded.", "data" => $comments], 200);
    }

    public function addComment(Request $request)
    {
        $employee = Auth::guard('employee');
        $employer = Auth::guard('employer');

        $comment = Comment::create([
            "event_id" => $request->event_id,
            "employee_id" => $employee->check()?$employee->user()->id:null,
            "employers_id" => $employer->check()?$employer->user()->id:null,
            "comment" => $request->comment
        ]);

        return response()->json(["message" => "comment successfully added.", "data" => $comment], 200);
    }

    public function commentReply($event_id, $comment_id, Request $request)
    {
        $employee = Auth::guard('employee');
        $employer = Auth::guard('employer');

        $comment = Comment::create([
            "event_id" => $event_id,
            "employee_id" => $employee->check()?$employee->user()->id:null,
            "employers_id" => $employer->check()?$employer->user()->id:null,
            "comment" => $request->reply,
            "parent_id" => $comment_id,
        ]);

        return response()->json(["message" => "comment successfully added.", "data" => $comment], 200);
    }
}
