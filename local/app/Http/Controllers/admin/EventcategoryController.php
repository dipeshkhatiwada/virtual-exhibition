<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\EventCategory;
use App\UserGroup;

class EventcategoryController extends Controller
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
        $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $event_category = EventCategory::paginate(50);

        
                    
        return view('admin.event_category.index')->with('datas',$event_category);
    }

     public function addnew()
    {
        $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }   
        return view('admin.event_category.newform');
    }
    public function save(Request $request)
    {
      
       $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $this->validate($request, [
          'title' => 'required|unique:event_category',
          'seo_url' => 'required|min:3|unique:event_category',
        ]);
       
       
               
                
                $event_category=EventCategory::create(['title' => $request->title, 'seo_url' => $request->seo_url]);
                if($event_category)
                {
                    
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/event_category');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('admin/event_category'); 
                
                }
               
                

           
        
    }

    public function delete($id)
    {
        $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $i= EventCategory::where('id',$id)->delete();
        if($i)
        {
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/event_category');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('admin/event_category'); 
        }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
       $datas= EventCategory::where('id',$id)->first();
       if($datas) {

         
      
        
        return view('admin.event_category.editform')->with('data',$datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong Data');
                    return redirect('admin/event_category'); 
        }
    }

    public function update(Request $request)
    {
       
       $permission = UserGroup::checkPermission('EventcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       $this->validate($request, [
        'title' => 'required|min:3|unique:event_category,title,'.$request->id.',id',
        'seo_url' => 'required|min:3|unique:event_category,seo_url,'.$request->id.',id',
       ]);
        

          
               
                $event_category= EventCategory::where('id',$request->id)->update(['title' => $request->title, 'seo_url' => $request->seo_url]);
                if($event_category)
                {
                   
                   
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('admin/event_category');

                }
                else {
                    \Session::flash('alert-danger','Something Went Wrong on Updating Data');
                    return redirect('admin/event_category'); 
                }
               
                

           
        
    }

    
}
