<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\UserGroup;
use App\Layout;


class LayoutController extends Controller
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
       $permission = UserGroup::checkPermission('LayoutController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }

        $layout = Layout::orderBy('layout_title','asc')->paginate(50);
                
        return view('admin.layout.index')->with('data',$layout);
    }

     public function addnew()
    {
        $permission = UserGroup::checkPermission('LayoutController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
       
        return view('admin.layout.newform');
    }
    public function save(Request $request)
    {
        $permission = UserGroup::checkPermission('LayoutController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
      
       
       
        $this->validate($request,
            [
                    'layout_title'=>'required|min:3',
                    'route' => 'required',
                    
            ]);
       
       
                $data = array(
                    
                    'layout_title' => $request->layout_title,
                    'layout_route' => $request->route,
                    
                    );
                $language=Layout::create($data);
                if($language)
                {
                     
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/layout');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('admin/layout'); 
                
                }
               
                

           
        
    }

    public function delete($id)
    {
        $permission = UserGroup::checkPermission('LayoutController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
       
       
        $i=Layout::where('layout_id',$id)->delete();
        if($i)
        {
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/layout');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('admin/layout'); 
        }
   

        
    }

     

     
}
