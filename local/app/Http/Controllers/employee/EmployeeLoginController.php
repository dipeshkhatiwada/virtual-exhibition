<?php
namespace App\Http\Controllers\employee;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;
use App\EmployeePasswordReset;
use App\EmployeeRegistration;
use App\EmployeeAddress;
use App\EmployeeLogin;
use App\EmployeeActivity;
class EmployeeLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/employee';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    
    public function getLogin()
    {
        
        if (auth()->guard('employee')->user()) return redirect()->route('employee.dashboard');
        session(['link' => url()->previous()]);
        return view('employee.login');
    }

    public function popLogin()
    {
        
        if (auth()->guard('employee')->user()) return redirect()->route('employee.dashboard');
        session(['link' => url()->previous()]);
        return view('employee.poplogin');
    }
    public function getRegister()
    {
        
        if (auth()->guard('employee')->user()) return redirect()->route('employee.dashboard');
        return view('employee.register');
    }

    public function regValidation(Request $request)
    {
        if (isset($request->email) && isset($request->token)) {
            $reg = EmployeeRegistration::where('email',$request->email)->where('validation_token',$request->token)->first();
            if (isset($reg->id)) {
                $datas = [
                    'firstname' => $reg->first_name,
                    'middlename' => $reg->middle_name,
                    'lastname' => $reg->last_name,
                    'email' => $reg->email,
                    'password' =>$reg->password,
                    'status' => 1
                ];
                $employee = Employee::create($datas);
                EmployeeAddress::create(['employees_id' => $employee->id, 'mobile' => $reg->mobile]);
                \App\EmployeeSetting::create(['employees_id' => $employee->id]);

                EmployeeRegistration::where('email', $request->email)->delete();
                \Session::flash('status','Your email address is validated. Please login for further access');
                    return redirect('employee/login'); 
            } else {
                \Session::flash('alert-danger','Your datas are not match with our data.');
                    return redirect('employee/login'); 
            }
        } else{
            \Session::flash('alert-danger','Required Value did not match.');
                    return redirect('employee/login'); 
        }
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required|min:8',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $check_employee = Employee::where('email', $request->email)->count();
        if ($check_employee > 0) {
            \Session::flash('alert-danger','Your E-mail address is already registered.');
            return redirect()->back()->withErrors(['email' => 'Your E-mail address is already registered.'])
                        ->withInput();
        }
        $check_register = EmployeeRegistration::where('email', $request->email)->count();
        if ($check_register > 0) {
             \Session::flash('alert-danger','Your email address is in registration process. Please check your email; if you did not receive the email, contact at info@rollingnexus.com');
            return redirect()->back()->withErrors(['email' => 'Your E-mail address is in registration process.'])
                        ->withInput();
        }

         myFunctions::setEmail();
            $token = \Str::random(16);
            $datas = ['first_name' => $request->first_name, 'middle_name' => $request->middle_name, 'last_name' => $request->last_name, 'email' => $request->email, 'mobile' => $request->mobile_number, 'password' => bcrypt($request->password), 'validation_token' => $token];
            
            
            $mydata = array(
                    'name' => $request->first_name.' '.$request->middle_name.' '.$request->last_name, 
                    'email' => $request->email,
                    'subject' => 'Job Seeker Registration Confirmation',
                    'token' => $token,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,             
                    );
             Mail::send('employee.register_conformation', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['email'],$mydata['name'])->from($mydata['store_email'],$mydata['store_name'])->subject($mydata['subject']);
                });
            
                EmployeeRegistration::create($datas);
                \Session::flash('status','Thank you for your registration. Please check your email for validation (Also check spam/junk if you do not receive the email in your inbox)');
                    return redirect('employee/login'); 
            

           

        
    }
    public function employeeAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1], $request->has('remember')))
        {
            EmployeeLogin::create(['employees_id' => auth()->guard('employee')->user()->id, 'login_ip' => $request->ip()]);
            $check = EmployeeActivity::where('employees_id',auth()->guard('employee')->user()->id)->first();
            if (isset($check->id)) {
                $total_login = 0;
                if($check->total_login > 0)
                {
                    $total_login = $check->total_login + 1;
                }
                EmployeeActivity::where('id',$check->id)->update(['total_login' => $total_login]);
            }else{
                EmployeeActivity::create(['employees_id' => auth()->guard('employee')->user()->id, 'total_login' => 1]);
            }
            if (session()->has('link')) {
                return redirect(session('link'));
            }
            return redirect()->back();
        }else{
             $errordata = array('email' => 'Username or Password is incorrect', );
                        return redirect('/employee/login')->withErrors($errordata)
                        ->withInput();
        }
    }

    public function employeePop(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('employee')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1], $request->has('remember')))
        {
            EmployeeLogin::create(['employees_id' => auth()->guard('employee')->user()->id, 'login_ip' => $request->ip()]);
            $check = EmployeeActivity::where('employees_id',auth()->guard('employee')->user()->id)->first();
            if (isset($check->id)) {
                $total_login = 0;
                if($check->total_login > 0)
                {
                    $total_login = $check->total_login + 1;
                }
                EmployeeActivity::where('id',$check->id)->update(['total_login' => $total_login]);
            }else{
                EmployeeActivity::create(['employees_id' => auth()->guard('employee')->user()->id, 'total_login' => 1]);
            }
            return redirect()->back();
        }else{
             $errordata = array('email' => 'Username or Password is incorrect', );
                        return redirect()->back()->withErrors($errordata)
                        ->withInput();
        }
    }
    public function logout(Request $request){
        auth()->guard('employee')->logout();

        $request->session()->invalidate();
        return redirect('/employee/login');
    }
    public function askemail(Request $request){
        return view('employee.email');
    }

    public function validateemail(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|email']);
        $employee = Employee::where('email', $request->email)->first();
        if (isset($employee->email)) {
             myFunctions::setEmail();
            $token = \Str::random(16);
            $datas = ['email' => $employee->email, 'token' => $token, 'created_at' => date('Y-m-d'.' '.'h:i:s')];
            EmployeePasswordReset::where('email', $employee->email)->delete();
            EmployeePasswordReset::create($datas);
            $mydata = array(
                    'name' => $employee->name, 
                    'email' => $request->email,
                    'subject' => 'Password Reset Confirmation',
                    'token' => $token,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,             
                    );
            Mail::send('employee.emailpassword', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['email'],$mydata['name'])->from($mydata['store_email'],$mydata['store_name'])->subject($mydata['subject']);
                });

            \Session::flash('status','Password Reset Link has been Sent Successfully. Please Check Your Email');
                    return redirect()->back();
        }else{
            $errordata = array('email' => 'This Email is not registered in our database email', );
                        return redirect()->back()->withErrors($errordata)
                        ->withInput();
        }
    }

    public function passwordreset(Request $request)
    {
        if (auth()->guard('employee')->user()) return redirect()->route('employee.dashboard');
        if (isset($request->email) && isset($request->token)) {
           
               return view('employee.reset')->with('email', $request->email)->with('token', $request->token);
           
        } else {
            \Session::flash('status','Required Fields are not Comming');
            return view('employee.email');
        }
    }

    public function resetpassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $check = EmployeePasswordReset::where('email', $request->email)->where('token', $request->token)->first();
           if (isset($check->email)) {
               
                Employee::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
                EmployeePasswordReset::where('email', $request->email)->delete();
               \Session::flash('status','You have Successfully Changed Password');
           return view('employee.login');

           }else{
            \Session::flash('alert_danger','Your Information Did not match');
             return redirect()->back()->withErrors($errordata)
                        ->withInput();

           }

            }
}