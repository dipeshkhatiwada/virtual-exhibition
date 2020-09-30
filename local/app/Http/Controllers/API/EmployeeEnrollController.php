<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeEnrollController extends Controller
{
    public function login(Request $request)
    {
       $request->validate([
           'email' => 'required|email',
           'password'=>'required'
       ]);
       if (auth()->guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1]))
       {
           $emp=\App\Employee::where('email',$request->email)->first();
           $tokenResult = $emp->createToken('Personal Access Token');
           $token = $tokenResult->token;
           return $token;
           Employee::where('id',$emp->id)->update(['api_token'=>hash('sha256', $token)]);
           return ['token' => $token, 'message'=>'Login Successful', 'status'=>true];
       }else{
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
       }
    }

}
