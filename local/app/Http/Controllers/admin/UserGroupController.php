<?php

namespace App\Http\Controllers\admin;
use DB;
use File;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\UserGroup;
use App\GroupAccess;

class UserGroupController extends Controller
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
        $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
       

        $usergroup = UserGroup::orderBy('group_title', 'asc')->paginate(50);

            
        return view('admin.usergroup.index')->with('data',$usergroup);
    }

     public function addnew()
    {
        $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $files = File::files(__DIR__);
        
        return view('admin.usergroup.newform')->with('files',$files);
    }
    public function save(Request $request)
    {
        
      $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
        $this->validate($request, [
                'group_title'=>'required|unique:usergroup|min:3'
            ]);
       

                $usergroups=UserGroup::create(['group_title' => $request->group_title]);
                if($usergroups)
                {
                     if(isset($request->permission))
                   {
                    foreach ($request->permission as $permission) 
                    {
                    
                     GroupAccess::create(['user_group_id' => $usergroups->id, 'access_page' => $permission]);
                    }
                }
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/usergroup');

                }
               
                

            
        
    }

    public function delete($id)
    {
             $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }  
       
        $i= UserGroup::where('id', $id)->delete();
        if($i)
        {
           
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/usergroup');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting usergroup');
                    return redirect('admin/usergroup'); 
        }

        
    }

     public function edit($id)
    {
       $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
       $datas=UserGroup::where('id',$id)->first();
       if($datas) {
       $permissions=$datas->GroupAccess;
        $files = File::files(__DIR__);
        
        return view('admin.usergroup.editform')->with('files',$files)->with('access',$permissions)->with('datas',$datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong usergroup');
                    return redirect('admin/usergroup'); 
        }
    }

    public function update(Request $request)
    {
      
       $permission = UserGroup::checkPermission('UserGroupController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
         $this->validate($request, [
                'group_title'=>'required|min:3|unique:usergroup,group_title,'.$request->id.',id'

            ]);
       
            $usergroup = UserGroup::where('id', $request->id)->update(['group_title' => $request->group_title]);
             GroupAccess::where('user_group_id', $request->id)->delete();
                   if(isset($request->permission))
                   {
                        foreach ($request->permission as $permission) 
                        {
                        
                         GroupAccess::create(['user_group_id' => $request->id, 'access_page' => $permission]);
                        }
                    }
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/usergroup');

            
                

    }


   
}
