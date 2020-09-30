<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
     public function postLogin(Request $request)
    {
        $v= Validator::make($request->all(),
            [
                    'email'=>'required|email',
                    'password' => 'required',
                    
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else {
            $auth = auth()->guard('admin');
        	$data = array(
            		'email' => $request->email,
            		'password' => $request->password,
            		'published' => 1,
            		);

        			if (Auth::attempt($data,$request->has('remember'))) 
        			{
                        if( Auth::user()->hasRole('user'))
                                {
                                return redirect()->route('client');
                                }

                                if( Auth::user()->hasRole('administrator'))
                                    {
                                return redirect()->intended('/admin');
                                }


    						if( Auth::user()->role != 1)
            					{
                					return redirect()->route('client');
            					}

            					else
            					{
                					return redirect()->route('admin.home');
            					}
            						
					}
					else 
					{
						$errordata = array('email' => 'Username or Password is incorrect', );
						return redirect()->back()->withErrors($errordata)
                        ->withInput();
					}
            
    		}

    }

    public function getHome()
    {
    	return view('welcome');
    }
}
