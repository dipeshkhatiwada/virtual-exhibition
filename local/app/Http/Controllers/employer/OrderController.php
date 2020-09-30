<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Payments;
use App\Order;
use App\OrderItem;
use App\OrderHistory;
use App\Employers;
use Mail;
use App\Imagetool;
use App\library\myFunctions;
use App\library\Settings;

use App\UserGroup;

class OrderController extends Controller
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
        $this->middleware('employer');
    }

     


    public function index(Request $request)
    {
        $config = array(
          'app.meta_title' => 'Order',
          'app.meta_keyword' => 'Order',
          'app.meta_description' => 'Order',
          'app.meta_image' => '',
          'app.meta_url' => url('/employer/order'),
          'app.meta_type' => 'Order',

      );




        config($config);
        $orders = Order::where('order_by',auth()->guard('employer')->user()->employers_id)->orderBy('id','desc')->paginate(50);

        
                    
        return view('employer.order.index')->with('datas',$orders);
    }

   
  

    public function delete($id)
    {
       
       
        $i= Order::where('id',$id)->delete();
        if($i)
        {
            
            \Session::flash('alert-success','Record deleted Successfully');
                    return redirect('employer/order');
        }
        else 
        {
           \Session::flash('alert-danger','Something Went Wrong on Deleting data');
                    return redirect('employer/order'); 
        }

        
    }

     public function view($id)
    {
        
        
       $order= Order::where('id',$id)->where('order_by',auth()->guard('employer')->user()->employers_id)->first();
       if($order) {

         $datas['order'] = $order;
         $datas['store'] = Settings::getSettings()->name;
         $datas['logo'] = Settings::getImages()->logo;
         $datas['store_email'] = Settings::getSettings()->email;
         $datas['store_address'] = Settings::getSettings()->address;
         $datas['store_phone'] = Settings::getSettings()->telephone;
          $datas['order_status'][] = ['value' => 'Complete'];
        $datas['order_status'][] = ['value' => 'Pending'];
        $datas['order_status'][] = ['value' => 'Processing'];
        
        return view('employer.order.editform')->with('data',$datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong Data');
                    return redirect('employer/order'); 
        }
    }

     public function print($id)
    {
       
        
       $order= Order::where('id',$id)->where('order_by',auth()->guard('employer')->user()->employers_id)->first();
       if($order) {

         $datas['order'] = $order;
         $datas['store'] = Settings::getSettings()->name;
         $datas['logo'] = Settings::getImages()->logo;
         $datas['store_email'] = Settings::getSettings()->email;
         $datas['store_address'] = Settings::getSettings()->address;
         $datas['store_phone'] = Settings::getSettings()->telephone;
         
        return view('employer.order.print')->with('data',$datas);
        } else {

             \Session::flash('alert-danger','You choosed wrong Data');
                    return redirect('employer/order'); 
        }
    }

    public function addHistory(Request $request)
    {
       
      

        $this->validate($request,[
          'order_id' => 'required|integer',
          
          'comment' => 'required',
          'file' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

         $image = '';
          if ($request->hasFile('file'))  {
            $directory = DIR_IMAGE.'checkout';
            if (!is_dir($directory)) {
              mkdir($directory,true);
            }
            $this->validate($request,['file'=>'mimes:jpeg,jpg,png,gif|max:10000',]);
            $file = $request->File('file');
            $image = str_random(10).'.'.$file->getClientOriginalExtension();

            $file->move($directory, $image);
          }

        
        OrderHistory::create([
          'order_id' => $request->order_id,
          
          'comment' => $request->comment,
          'document' => $image

        ]);
        

        
        
       \Session::flash('alert-success','Record have been updated Successfully');
        return redirect('employer/order');

               
        
    }

    
}
