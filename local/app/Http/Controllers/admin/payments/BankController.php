<?php

namespace App\Http\Controllers\admin\payments;
use DB;
use App\Http\Controllers\Controller;
use App\Imagetool;
use App\Payments;




class BankController extends Controller
{
     


    public function index()
    {
      $datas['order_status'][] = ['value' => 'Complete'];
      $datas['order_status'][] = ['value' => 'Pending'];
      $datas['order_status'][] = ['value' => 'Processing'];

      $datas['status'][] = ['value' => '1', 'title' => 'Enabled'];
      $datas['status'][] = ['value' => '2', 'title' => 'Disabled'];
       
       
        return view('admin.payments.bank.newform')->with('data', $datas);

    }

    public function edit($id)
    {
        
       
       $payments = Payments::where('id', $id)->first();
       $datas['payment_title'] = $payments->title;
       $datas['payment_page'] = $payments->payment_page;
       $datas['setting'] = json_decode($payments->setting);

       $datas['id'] = $id;
        $datas['order_status'][] = ['value' => 'Complete'];
      $datas['order_status'][] = ['value' => 'Pending'];
      $datas['order_status'][] = ['value' => 'Processing'];

      $datas['status'][] = ['value' => '1', 'title' => 'Enabled'];
      $datas['status'][] = ['value' => '2', 'title' => 'Disabled'];
      
        return view('admin.payments.bank.editform')->with('data', $datas);

    }

     
     
  
   

}
