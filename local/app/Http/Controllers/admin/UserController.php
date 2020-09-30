<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\UserGroup;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
    {
        $this->middleware('auth');
    }

     


    public function index(Request $request)
    {
        $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $user = User::paginate(50);

        
                    
        return view('admin.users.index')->with('data',$user);
    }

     public function addnew()
    {
        $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
           $usegroup = UserGroup::orderBy('group_title', 'asc')->get();

        return view('admin.users.newform')->with('groups', $usegroup);
    }
    public function save(Request $request)
    {
      $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $data=$request->all();
        $v= Validator::make($request->all(),
            [
                    'group' => 'required|integer',
                    'name' => 'required|min:5|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
            ]);
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else 
            {
               
                $datas = array(
                    
                    'group_id' => $data['group'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    
                    
                    );
                $user=User::create($datas);
                if($user)
                {
                    
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/user');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('admin/user'); 
                
                }
               
                

            }
        
    }

    public function delete($id)
    {
        $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $i= User::where('id',$id)->delete();
        if($i)
        {
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/user');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('admin/user'); 
        }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       $datas= User::where('id',$id)->first();
       if($datas) {

         
      $usegroup = UserGroup::orderBy('group_title', 'asc')->get();
        
        return view('admin.users.editform')->with('data',$datas)->with('groups', $usegroup);
        } else {

             \Session::flash('alert-danger','You choosed wrong users');
                    return redirect('admin/user'); 
        }
    }

    public function update(Request $request)
    {
       
       $permission = UserGroup::checkPermission('UserController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $post=$request->all();
        if($post['password'] != ''){

            $v= Validator::make($request->all(),
            [
                'group' => 'required|integer',
                'name' => 'required|min:5|max:255',
                'email'=>'required|unique:users,email,'.$post['id'].',id',
                'password' => 'confirmed|min:6',
                   
            ]);

        } else {

        $v= Validator::make($request->all(),
            [
                'group' => 'required|integer',
                'name' => 'required|min:5|max:255',
                'email'=>'required|unique:users,email,'.$post['id'].',id'
                   
            ]);
         }
        if($v->fails())
        {
            return redirect()->back()->withErrors($v);
        } else 
            {
                if($post['password'] != ''){

                $data = array(
                    'group_id' => $post['group'],
                    'name' => $post['name'],
                    'email' => $post['email'],
                    'password' => bcrypt($post['password'])
                    
                     );
                    } else {

                    $data = array(
                   'group_id' => $post['group'],
                    'name' => $post['name'],
                    'email' => $post['email']
                    
                     );

                    }
                $user= User::where('id',$post['id'])->update($data);
                if($user)
                {
                   
                   
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('admin/user');

                }
                else {
                    \Session::flash('alert-danger','Something Went Wrong on Updating Data');
                    return redirect('admin/user'); 
                }
               
                

            }
        
    }

    
}
