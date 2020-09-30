<?php

namespace App\Http\Controllers\admin;
use DB;
use App\Http\Controllers\Controller;
use App\UserGroup;
use App\Payments;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Imagetool;
use File;
use App\library\myFunctions;



class PaymentController extends Controller
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
        $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
        
        
        $files = File::files(__DIR__.'/payments/');
        $datas= array();
        foreach ($files as $value) {
             
            $permission = basename($value, '.php'); 
            $string = str_replace('Controller', '', $permission);

           


            $datas[] = array(
                'title' => $string,
                'child' => Payments::where('payment_page', $string)->first(),

                );
        }
         
              
               

        return view('admin.payments.index')->with('datas', $datas);

    }

     public function addnew($page)
    {
       $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $cont= '\App\Http\Controllers\admin\payments\\'.$page.'Controller';
       $payment = new $cont();
       return $payment->index();
       
    }

    public function save(Request $request)
    {
        $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        
        $mydata = array(
                    'title' => $request->title,
                    'payment_page' => $request->payment_page,
                    'status' => $request->status,
                    'setting' => json_encode($request->all()),
                                       
                    );
                $payment = Payments::create($mydata);
               
                
               
                if($payment)
                { 
                    \Session::flash('alert-success','Payments Created Successfully');
                    return redirect('admin/payments'); 
                } else{
                      
                    \Session::flash('alert-danger','Something Went Wrong on saving record');
                    return redirect('admin/payments'); 

               }
               
        
    }
    



    public function delete($id)
    {
        $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
        $album = Payments::find($id);
        if($album){
        $i=$album->delete();
        if($i)
        {
                        
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('admin/payments');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting Data');
                    return redirect('admin/payments'); 
        }
    } else {
        \Session::flash('alert-danger','Did not find the choosen Data');
                    return redirect('admin/payments'); 
    }

        
    }

     public function edit($id)
    {
        $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
            
          return view('admin.noPermission');
          exit;
        }
       $value=  Payments::where('id', $id)->first();
       if($value) {
        
        $cont= '\App\Http\Controllers\admin\payments\\'.$value->payment_page.'Controller';
       $payment = new $cont();
       return $payment->edit($id);

        
             
        
        } else {

             \Session::flash('alert-danger','You choosed wrong data');
                    return redirect('admin/payments'); 
        }
    }

    public function update(Request $request)
    {
       $permission = UserGroup::checkPermission('PaymentController');
        if($permission == 1){
           
          return view('admin.noPermission');
          exit;
        }
        $mydata = array(
                    'title' => $request->title,
                    'payment_page' => $request->payment_page,
                    'status' => $request->status,
                    'setting' => json_encode($request->all()),
                                       
                    );
               Payments::where('id', $request->id)->update($mydata);
               
                
                    \Session::flash('alert-success','Record have been updated Successfully');
                    return redirect('admin/payments');


           
    }


    
   

}