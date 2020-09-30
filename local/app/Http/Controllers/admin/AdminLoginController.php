<?php
namespace App\Http\Controllers\admin;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
class AdminLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function getLogin()
    {
        
        if (auth()->user()) return redirect()->route('admin.dashboard');
        return view('admin.login');
    }
    public function adminAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember')))
        {
            return redirect()->route('admin.dashboard');
        }else{
             $errordata = array('email' => 'Username or Password is incorrect', );
                        return redirect()->back()->withErrors($errordata)
                        ->withInput();
        }
    }
}