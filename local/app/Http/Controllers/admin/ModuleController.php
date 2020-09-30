<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Http\Controllers\Controller;
use App\UserGroup;
use App\Module;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use File;
use App\library\myFunctions;



class ModuleController extends Controller
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
        $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
        
        
        $files = File::files(__DIR__.'/module/');
        $datas= array();
        foreach ($files as $value) {
             
            $permission = basename($value, '.php'); 
            $string = str_replace('Controller', '', $permission);

            $modules = Module::where('module_page', $string)->orderBy('module_page', 'asc')->get();

            $datas[] = array(
                'title' => $string,
                'child' => $modules,

                );
        }
         
              
               

        return view('admin.module.index')->with('datas', $datas);

    }

     public function addnew($page)
    {
       $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $cont= '\App\Http\Controllers\admin\module\\'.$page.'Controller';
       $module = new $cont();
       return $module->index();
       
    }

    public function save(Request $request)
    {
        $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        
        $mydata = array(
                    'title' => $request->title,
                    'module_page' => $request->module_page,
                    'setting' => json_encode($request->all()),
                                       
                    );
                $module = Module::create($mydata);
               
                
               
                if($module)
                { 
                    \Session::flash('alert-success','Module Created Successfully');
                    return redirect('admin/modules'); 
                } else{
                      
                    \Session::flash('alert-danger','Something Went Wrong on saving record');
                    return redirect('admin/modules'); 

               }
               
        
    }
    



    public function delete($id)
    {
        $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
        $album = Module::find($id);
        if($album){
        $i=$album->delete();
        if($i)
        {
                        
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/modules');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting Data');
                    return redirect('admin/modules'); 
        }
    } else {
        \Session::flash('alert-danger','Did not find the choosen Data');
                    return redirect('admin/modules'); 
    }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
       $value=  Module::where('id', $id)->first();
       if($value) {
        
        $cont= '\App\Http\Controllers\admin\module\\'.$value->module_page.'Controller';
       $module = new $cont();
       return $module->edit($id);

        
             
        
        } else {

             \Session::flash('alert-danger','You choosed wrong data');
                    return redirect('admin/modules'); 
        }
    }

    public function update(Request $request)
    {
       $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $mydata = array(
                    'title' => $request->title,
                    'module_page' => $request->module_page,
                    'setting' => json_encode($request->all()),
                                       
                    );
               Module::where('id', $request->module_id)->update($mydata);
               
                
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('admin/modules');


           
    }


     public function display($id)
    {

       $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        
        $module=\App\Module::where('id', $id)->first();
        if($module) {
        $data=\App\ModuleDisplay::where('module_id', $id)->get();
       
        $layout=DB::table('layout')->get();
        $lay = array();
        foreach ($layout as $layouts) {
            $lay[] = array(
                'id' => $layouts->layout_id,
                'title' => $layouts->layout_title,
                );
        }
        
        
         return view('admin.module.display')->with('datas', $data)->with('module', $module)->with('layouts', $lay);
       
    } else {
        \Session::flash('alert-danger','You choosed wrong data');
                    return redirect('admin/modules'); 

    }
       
    }

    public function displaySave(Request $request)
    {
       $permission = UserGroup::checkPermission('ModuleController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $rules = array('module_id'=>'required',
                    'tab.*.layout_id'=>'required|numeric',
                    'tab.*.status' => 'required|numeric',
                    'tab.*.position' => 'required',
                    'tab.*.sort_order' => 'required|numeric',);
        $customMessages = array(
                'tab.*.layout_id.required' => 'Layout is Required !!',
                'tab.*.layout_id.numeric' => 'Layout Must be Numeric Value !!',
                'tab.*.status.required' => 'Status is Required !!',
                'tab.*.status.numeric' => 'Status must be Numeric value !!',
                'tab.*.position.required' => 'Position is Required !!',
                'tab.*.sort_order.required' => 'Sort Order is Required !!',
                'tab.*.sort_order.numeric' => 'Sort Order must be Numeric value !!',
                );

        
         $v= Validator::make($request->all(),$rules,$customMessages);
           
        if($v->fails())
        {
            return redirect()->back()->withErrors($v)
                        ->withInput();
        } else 
            {
            
            DB::table('module_display')->where('module_id', $request->module_id)->delete();
                
               foreach ($request->tab as $key => $value) {
                   
                       
                       $display = new \App\ModuleDisplay;
                        $display->module_id = $request->module_id;
                        $display->layout_id =  $value['layout_id'];
                        $display->position = $value['position'];
                         $display->status = $value['status'];
                          $display->sort_order = $value['sort_order'];
                        
                       
                       $display->save(); 
                    }
                
               
                

                    
                    
                    \Session::flash('alert-success','Record have been saved Successfully');
                    return redirect('admin/modules');

               } 
               
    }
  
   

}