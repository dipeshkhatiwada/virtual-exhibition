<?php

namespace App\Http\Controllers\admin\payments;

use App\Http\Controllers\Controller;

use App\Payments;




class EsewaController extends Controller
{
     


    public function index()
    {
      $datas['order_status'][] = ['value' => 'Complete'];
      $datas['order_status'][] = ['value' => 'Pending'];
      $datas['order_status'][] = ['value' => 'Processing'];

      $datas['status'][] = ['value' => '1', 'title' => 'Enabled'];
      $datas['status'][] = ['value' => '2', 'title' => 'Disabled'];

      $datas['yesno'][] = ['value' => '1', 'title' => 'Yes'];
      $datas['yesno'][] = ['value' => '2', 'title' => 'No'];

      $datas['tranjection'][] = ['value' => 'authorization', 'title' => 'Authorization'];
      $datas['tranjection'][] = ['value' => 'sale', 'title' => 'Sale'];
       
        return view('admin.payments.esewa.newform')->with('data', $datas);

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

       $datas['tranjection'][] = ['value' => 'authorization', 'title' => 'Authorization'];
      $datas['tranjection'][] = ['value' => 'sale', 'title' => 'Sale'];

      $datas['yesno'][] = ['value' => '1', 'title' => 'Yes'];
      $datas['yesno'][] = ['value' => '2', 'title' => 'No'];
      
        return view('admin.payments.esewa.editform')->with('data', $datas);

    }

     
     
  
   

}
