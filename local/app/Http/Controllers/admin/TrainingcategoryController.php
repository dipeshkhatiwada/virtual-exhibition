<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\TrainingCategory;
use App\UserGroup;

class TrainingcategoryController extends Controller
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
        $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $training_category = TrainingCategory::paginate(50);

        
                    
        return view('admin.training_category.index')->with('datas',$training_category);
    }

     public function addnew()
    {
        $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }   
        return view('admin.training_category.newform');
    }
    public function save(Request $request)
    {
      
       $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        $this->validate($request, [
          'title' => 'required|unique:training_category',
          'seo_url' => 'required|min:3|unique:training_category',
        ]);
       
       
               
                
                $training_category=TrainingCategory::create(['title' => $request->title, 'seo_url' => $request->seo_url]);
                if($training_category)
                {
                    
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/training_category');

                } else {

                    \Session::flash('alert-danger','Something Went Wrong on Saving Data');
                    return redirect('admin/training_category'); 
                
                }
               
                

           
        
    }

    public function delete($id)
    {
        $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       
        $i= TrainingCategory::where('id',$id)->delete();
        if($i)
        {
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/training_category');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('admin/training_category'); 
        }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
        
       $datas= TrainingCategory::where('id',$id)->first();
       if($datas) {

         
      
        
        return view('admin.training_category.editform')->with('data',$datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong Data');
                    return redirect('admin/training_category'); 
        }
    }

    public function update(Request $request)
    {
       
       $permission = UserGroup::checkPermission('TrainingcategoryController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        } 
       $this->validate($request, [
        'title' => 'required|min:3|unique:training_category,title,'.$request->id.',id',
        'seo_url' => 'required|min:3|unique:training_category,seo_url,'.$request->id.',id',
       ]);
        

          
               
                $training_category= TrainingCategory::where('id',$request->id)->update(['title' => $request->title, 'seo_url' => $request->seo_url]);
                if($training_category)
                {
                   
                   
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('admin/training_category');

                }
                else {
                    \Session::flash('alert-danger','Something Went Wrong on Updating Data');
                    return redirect('admin/training_category'); 
                }
               
                

           
        
    }

    
}
