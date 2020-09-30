<?php
namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Imagetool;
use App\EmployerUser;
use Carbon\Carbon;
use App\MemberType;
use App\Employers;

class UserController extends Controller
{
   
   
    public function __construct()
    {
        $this->middleware('employer');
    }
    public function index(Request $request)
    {
        $datas['users'] = EmployerUser::where('employers_id',auth()->guard('employer')->user()->employers_id)->paginate(50);
        $employer = Employers::select('member_type')->where('id',auth()->guard('employer')->user()->employers_id)->first();
        $member = MemberType::select('user_no')->where('id',$employer->member_type)->first();
        $datas['user_no'] = $member->user_no;
        return view('employer.member.index')->with('datas', $datas);
    }


    public function addnew(Request $request)
    {
        
        return view('employer.member.newform')->with('image', Imagetool::mycrop('back.png', 100, 100));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:employer_user',
            'user_name' => 'required',
            'user_designation' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);


                    $emuser = [
                        'employers_id' => auth()->guard('employer')->user()->employers_id,
                        'name' => $request->user_name,
                        'designation' => $request->user_designation,
                        'image' => $request->user_image,
                        'user_type' => 2,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        'status' => 1
                    ];
                    $member = EmployerUser::create($emuser);
        if($member)
                {
                    
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('employer/users');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('employer/users'); 
                
                }
    }

    public function edit($id, Request $request)
    {
        $member = EmployerUser::where('id', $id)->first();
        if (isset($member->id)) {
            if ($member->image != '') {
                $datas['image'] = Imagetool::mycrop($member->image, 100, 100);
                # code...
            }else{
                $datas['image'] = Imagetool::mycrop('back.png', 100, 100);
            }
            $datas['placeholder'] = Imagetool::mycrop('back.png', 100, 100);
            $datas['member'] = $member;
            return view('employer.member.editform')->with('datas', $datas);
        } else{
            \Session::flash('alert-danger','Sorry ! can not find the data you request');
                    return redirect('employer/users'); 
        }
    }

    public function update(Request $request)
    {
         if ($request->password != '') {
             $this->validate($request, [
                'id' => 'required',
                'email' => 'required|email|unique:employer_user,email,'.$request->id.',id',
                'user_name' => 'required',
                'user_designation' => 'required',
                'password' => 'required|confirmed|min:6',
            ]);

             $datas = [
                        
                        'name' => $request->user_name,
                        'designation' => $request->user_designation,
                        'image' => $request->user_image,
                        
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ];
         } else{
            $this->validate($request, [
                'id' => 'required',
                'email' => 'required|email|unique:employer_user,email,'.$request->id.',id',
                'user_name' => 'required',
                'user_designation' => 'required',
                
            ]);
            $datas = [
                       
                        'name' => $request->user_name,
                        'designation' => $request->user_designation,
                        'image' => $request->user_image,
                        
                        'email' => $request->email,
                        
                    ];
         }

         $member = EmployerUser::where('id', $request->id)->update($datas);

         if($member)
                {
                    
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('employer/users');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('employer/users'); 
                
                }
    }

    public function delete($id)
    {
        $member = EmployerUser::where('id', $id)->first();
        if (isset($member->id)) {
            if ($member->user_type == 1) {
                \Session::flash('alert-danger','Sorry you can not delete Super Administrator');
                    return redirect('employer/users'); 
            }

            EmployerUser::where('id', $id)->delete();
            \Session::flash('alert-success','Record have been deleted Successfully');
                    return redirect('employer/users');

        } else{
            \Session::flash('alert-danger','Sorry can not find the data you request');
                    return redirect('employer/users'); 
        }
    }


    
    
}