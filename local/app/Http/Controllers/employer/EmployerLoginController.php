<?php
namespace App\Http\Controllers\Employer;
use App\Employer;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;

use App\Layout;
use App\OrganizationType;
use App\EmployerRegistration;
use App\EmployerAddress;
use App\Employers;
use App\Size;
use App\Saluation;
use App\Ownership;
use App\MemberType;
use App\EmployerUsers;
use App\EmployerUserPasswordReset;
class EmployerLoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
   
    public function getLogin()
    {
        
        if (auth()->guard('employer')->user()) return redirect()->route('employer.dashboard');
          $config = array(
              'app.meta_title' => 'Employer Login',
              'app.meta_keyword' => 'Employer Login',
              'app.meta_description' => 'Employer Login',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/login'),
              'app.meta_type' => 'Employer Login',
              
                );
            config($config);


          return  view('employer.login');

                 


    }
    public function employerAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (auth()->guard('employer')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 1],  $request->has('remember')))
        {
          $employer = Employers::where('id', auth()->guard('employer')->user()->employers_id)->first();
        if($employer->last_login == '')
           
        {

         return redirect('employer/feditprofile');
      }

      else
      {
        Employers::where('id', auth()->guard('employer')->user()->id)->update(['last_login' => date('Y-m-d h:i:s')]);
            return redirect()->back();
        }
        }else{
            $errordata = array('email' => 'Username or Password is incorrect or you are not activated, contact in office', );
                        return redirect('employer/login')->withErrors($errordata)
                        ->withInput();
        }
    }

     public function logout(Request $request){
        auth()->guard('employer')->logout();

        $request->session()->invalidate();
        return redirect('/employer/login');
    }


    
    public function askemail(Request $request){
          $config = array(
              'app.meta_title' => 'Forgot Password Employer',
              'app.meta_keyword' => 'Forgot Password Employer',
              'app.meta_description' => 'Forgot Password Employer',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/password'),
              'app.meta_type' => 'Employer password change',
              
                );
            config($config);


                    return  view('employer.email');

                    
    }

    public function validateemail(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|email']);
        $employer = EmployerUsers::where('email', $request->email)->first();
        if (isset($employer->email)) {
            myFunctions::setEmail();
            $token = \Str::random(16);
            $datas = ['email' => $employer->email, 'token' => $token, 'created_at' => date('Y-m-d'.' '.'h:i:s')];
            EmployerUserPasswordReset::where('email', $employer->email)->delete();
            EmployerUserPasswordReset::create($datas);
            $mydata = array(
                    'name' => $employer->name, 
                    'email' => $request->email,
                    'subject' => 'Password Reset Conformation',
                    'token' => $token,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,             
                    );
            Mail::send('employer.emailpassword', ['data' => $mydata], function($mail) use ($mydata){
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

    if (isset($request->email) && isset($request->token)) {
           $check = EmployerUserPasswordReset::where('email', $request->email)->where('token', $request->token)->first();
           if (isset($check->email)) {

          $config = array(
              'app.meta_title' => 'Reset Password',
              'app.meta_keyword' => 'Reset Password Employer',
              'app.meta_description' => 'Reset Password Employer',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/passwordreset'),
              'app.meta_type' => 'Employer password reset',
              
                );
            config($config);


                    return view('employer.reset')->with('email', $request->email)->with('token', $request->token);

                   

           }else{
            \Session::flash('status','Your Information Did not match');
            return redirect('employer/password');

           }
        } else {
            \Session::flash('status','Required Fields are not Comming');
            return redirect('employer/password');
        }

    }

    public function resetpassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $check = EmployerUserPasswordReset::where('email', $request->email)->where('token', $request->token)->first();
           if (isset($check->email)) {
               
                EmployerUsers::where('email', $request->email)->update(['password' => bcrypt($request->password)]);
                EmployerUserPasswordReset::where('email', $request->email)->delete();
               \Session::flash('status','You have Successfully Changed Password');
           return redirect('employer/login');

           }else{
            \Session::flash('alert_danger','Your Information Did not match');
             return redirect()->back()->withErrors($errordata)
                        ->withInput();

           }

            }

 
    public function getregister()
    {
        
        if (auth()->guard('employer')->user()) return redirect()->route('employer.dashboard');
          $config = array(
              'app.meta_title' => 'Employer Register',
              'app.meta_keyword' => 'Employer Register',
              'app.meta_description' => 'Employer Register',
              'app.meta_image' => '',
              'app.meta_url' => url('/employer/register'),
              'app.meta_type' => 'Employer Register',
              
                );
            config($config);
            $org_type = OrganizationType::orderBy('name', 'asc')->get();

                   return  view('employer.register')->with('org_types', $org_type);

                   


    }

    public function postregister(Request $request){

         $this->validate($request, [
            'name' => 'required|min:3',
            'org_type' => 'required|integer',
            'phone' => 'required|min:8',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'term_condition' => 'required'
        ]);

         if ($request->employer_id > 0) {
           $check_user = EmployerUsers::where('employers_id', $request->employer_id)->count();
           if ($check_user > 0) {
             \Session::flash('alert-danger','This organization business account has been registered. If you forgot password go to '.url('/employer/password')).'. If you think somebody else registered your organization please contact '.Settings::getSettings()->email;
            return redirect()->back()->withErrors(['name' => 'This organization is already registered.'])
                        ->withInput();
           }
         }

         $checkname = Employers::where('name', $request->name)->first();
         if (isset($checkname->id)) {
           $check_user = EmployerUsers::where('employers_id', $checkname->id)->count();
           if ($check_user > 0) {
             \Session::flash('alert-danger','This organization business account has been registered. If you forgot password go to '.url('/employer/password')).'. If you think somebody else registered your organization please contact '.Settings::getSettings()->email;
            return redirect()->back()->withErrors(['name' => 'This organization is already registered.'])
                        ->withInput();
           }
         }

             
        $check_register = EmployerRegistration::where('email', $request->email)->count();
        if ($check_register > 0) {
             \Session::flash('alert-danger','Your business account is in registration process. Please check your email. if you did not get email please contact in '.Settings::getSettings()->email);
            return redirect()->back()->withErrors(['email' => 'Your business account is registration process.'])
                        ->withInput();
        }

        $check_email = EmployerUsers::where('email', $request->email)->count();
        if ($check_email > 0) {
          \Session::flash('alert-danger','This email is already register to another business account.');
            return redirect()->back()->withErrors(['email' => 'This email is already register to another business account.'])
                        ->withInput();
        }


           myFunctions::setEmail();
            $token = \Str::random(16);
            $datas = ['name' => $request->name, 'org_type' =>$request->org_type, 'email' => $request->email, 'phone' => $request->phone, 'password' => bcrypt($request->password), 'vtoken' => $token, 'employer_id' => $request->employer_id];
            
            
            $mydata = array(
                    'name' => $request->name, 
                    'email' => $request->email,
                    'subject' => 'Business Account Registration Conformation',
                    'token' => $token,
                    'store_name' => Settings::getSettings()->name,
                    'store_email' => Settings::getSettings()->email,    

                    );
             Mail::send('employer.register_conformation', ['data' => $mydata], function($mail) use ($mydata){
                  $mail->to($mydata['email'],$mydata['name'])->from($mydata['store_email'],$mydata['store_name'])->subject($mydata['subject']);
                });
            
                EmployerRegistration::create($datas);
                \Session::flash('status','Thank you For Registration. Please Check Your Email for validation(Please check spam/junk if you do not receive in your inbox)');
                    return redirect('employer/login'); 
            

    }

    public function regValidation(Request $request)
    {
        if (isset($request->email) && isset($request->token)) {
            $reg = EmployerRegistration::where('email',$request->email)->where('vtoken',$request->token)->first();
           
            if (isset($reg->id)) {
              if($reg->employer_id > 0)
              {
                $datas = [
                    'org_type' => $reg->org_type,
                    'member_type' => 4,
                    'seo_url' => rand(),
                    'status' => 1
                ];
                Employer::where('id', $reg->employer_id)->update($datas);
                $employerid= $reg->employer_id;
                
              } else{
                 $checkname = Employers::where('name', $reg->name)->first();
                   if (isset($checkname->id)) {
                    $employerid = $checkname->id;
                     $datas = [
                        'name' => $reg->name,
                        
                        'org_type' => $reg->org_type,
                        'member_type' => 4,
                        'seo_url' => rand(),
                        'status' => 1
                    ];
                    $employer = Employer::where('id', $employerid)->update($datas);
                    
                   } else{
                     $datas = [
                        'name' => $reg->name,
                        
                        'org_type' => $reg->org_type,
                        'member_type' => 4,
                        'seo_url' => rand(),
                        'status' => 1
                    ];
                    $employer = Employer::create($datas);
                    $employerid = $employer->id;
                   }
                
              }
              
              

              $user = [
                    'employers_id' => $employerid,
                    'name' => $reg->name,
                    'email' => $reg->email,
                    'password' => $reg->password,
                    'status' => 1
                ];

                EmployerUsers::create($user);
               
                EmployerAddress::create(['employers_id' => $employerid, 'phone' => $reg->phone]);
                \App\EmployerContactPerson::create(['employers_id' => $employerid]);
                \App\EmployerHead::create(['employers_id' => $employerid]);
                
                EmployerRegistration::where('email', $request->email)->delete();
                \Session::flash('status','Your E-mail address is validate, please login.');
                    return redirect('employer/login'); 
            } else {
                \Session::flash('alert-danger','Your datas are not match with our data.');
                    return redirect('employer/login'); 
            }
        } else{
            \Session::flash('alert-danger','Required Value did not match.');
                    return redirect('employer/login'); 
        }
    }

    public function getName(Request $request)
    {
      $data = '';
      $employers = Employers::select('id','name','logo', 'org_type')->where('name', 'LIKE', $request->name.'%')->limit(6)->get();
      if (count($employers) > 0) {
        foreach ($employers as $key => $employer) {
          $address = $employer->EmployerAddress;
          if ($employer->logo != '') {
            $image = Imagetool::mycrop($employer->logo,50,50);
          } else{
            $image = Imagetool::mycrop('logo-dummy.png',50,50);
          }
          $data .= '<div id="'.$employer->id.'" class="org-list"><img src="'.asset($image).'"><div class="title"><div id="title_'.$employer->id.'">'.$employer->name.'</div>';
          if (isset($address->address)) {
            $data .= '<span>'.$address->address.'</span>';
           } 
           $data .= '<input type="hidden" id="type_'.$employer->id.'" value="'.$employer->org_type.'"></div></div>';
        }
      }

      return $data;
    }

   

    }