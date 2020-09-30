<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EmployerLoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $token = Str::random(60);

        if (auth()->guard('employer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1]))
        {
            $emp = \App\EmployerUser::where('email', $request->input('email'))->first();
            // Auth::guard('employer')->loginUsingId($emp->id);

            \App\EmployerUser::where('id', $emp->id)->update(['api_token'=> $token]);

            return ['employers_id' => $emp->employers_id, 'token' => $token, 'message'=>'Login Successful', 'status'=>true];

        }else{
            return ['message'=>'Username or Password is incorrect','status'=>false];
        }
    }

    public function logout()
    {
        $user = \App\EmployerUser::where('api_token', auth()->guard('employer-api')->user()->api_token)->first();
        if (count($user)) {
            \App\EmployerUser::where('id',$user->id)->update(['api_token'=>null]);
            return ['message'=>'User Logged out','status'=>true];

        }else{
            return ['message'=>'Invalid Token','status'=>true];

        }
    }

}
