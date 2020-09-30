<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Invoice</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<body>
  <section class="wrapper" style="width:900px; background-color: #fefefe; border:1px solid #f3f3f3; padding:10px; float:left;">
      <div style="border-bottom: 2px solid #f3f3f3; padding-bottom: 5px; margin-bottom: 30px;">
        <img src="{{asset('image/'.$data['logo'])}}" style="width: 200px;">
        <div style="float: right;color: #666;
        display: block;
        margin-top: 5px;
        font-size:16px;">
        <div style="color: #000; font-weight: bold;">Invoice No. :#{{$data['order_detail']->invoice_no}}</div>
        <div>Date: {{$data['order_detail']->created_at}}</div>
      </div>
      </div>
      <div style="margin-bottom: 10px; width: 100%; float: left;">
        <div style="float: left;  padding-bottom: 10px;">
          From
          <div>
              


            <strong style="color: #008bb5;">{{$data['from_name']}}</strong><br>
            {{$data['store_address']}}<br>
             Phone: {{$data['store_phone']}}<br>
            Email: {{$data['from_email']}}
          </div>
        </div>
        <div style="float: right;  right:0px; padding:0px;">
          Bill To
          <div>
            <strong>{{$data['order_detail']->customer_name}}</strong><br>
           
            Phone: {{$data['order_detail']->telephone}}<br>
            Email: {{$data['order_detail']->email}}
          </div>
        </div>
      </div>
      <div style="width: 100%; float: left; margin-top: 30px; border:1px solid #f3f3f3;">
          <table style="width: 100%;">
            <thead style="background-color: #ddd; text-align: left;">
            <tr>
               <th style="padding:5px;">S.N.</th>
              <th style="padding:5px;">Product</th>
              <th style="padding:5px;">Product Type </th>
              <th style="padding:5px;">Duration</th>
              <th style="padding:5px;">Subtotal</th>


              
            </tr>
            </thead>
            <tbody>
            @php($i = 1)
            @foreach($data['order_detail']->orderItem as $item)
            <tr>
              <td style="padding:5px;">{{$i++}}</td>
              <td style="padding:5px;">{{$item->name}}</td>
              <td style="padding:5px;">{{$item->product_type}}</td>
              <td style="padding:5px;">{{$item->duration}} {{$item->type == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'}}</td>
              <td style="padding:5px;">Rs. {{$item->amount}}</td>
            </tr>
           @endforeach
           
            <tr style="font-weight: bold;">
              <td colspan="4" style="text-align: right; padding-right: 10px; font-weight: 700">Total Amount</td>
              <td><strong>Rs. {{$data['order_detail']->amount}}</strong></td>
            </tr>
            </tbody>
          </table>
      </div>
      
      <div>
        <strong style="padding-bottom: 15px;">{{$data['from_name']}}</strong><br>
        Sales Division
      </div>
  </section>
 
</body>
</html>

