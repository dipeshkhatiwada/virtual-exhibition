<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

   <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="{{asset('assets/dist/css/font-awesome.css')}}">
    
 
    <!-- Ionicons -->
     <link rel="stylesheet" href="{{asset('assets/dist/css/ionicons.css')}}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
     <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <img src="{{asset('image/'.$data['logo'])}}" style="width: 200px;">
             <small class="pull-right">Date: {{$data['order']->created_at}}<br><b>Invoice No. #{{$data['order']->invoice_no}}</b></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
   <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          From
          <address>
            <strong>{{$data['store']}}</strong><br>
            {{$data['store_address']}}<br>
            
            Phone: {{$data['store_phone']}}<br>
            Email: {{$data['store_email']}}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
           To
          <address>
            <strong>{{$data['order']->customer_name}}</strong><br>
           
            Phone: {{$data['order']->telephone}}<br>
            Email: {{$data['order']->email}}
          </address>
          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>S.N.</th>
              <th>Product</th>
              <th>Product Type </th>
              <th>Duration</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
                @php($i = 1)
            @foreach($data['order']->orderItem as $item)
            <tr>
              <td>{{$i++}}</td>
              <td>{{$item->name}}</td>
              <td>{{$item->product_type}}</td>
             
              <td>{{$item->duration}} {{$item->type == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'}}</td>
              <td>Rs. {{$item->amount}}</td>
            </tr>
           @endforeach
           <tfoot>
               <tr>
                   <td colspan="4"><strong style="float: right;">Grand Total:</strong></td>
                   <td><strong>Rs. {{$data['order']->amount}}</strong></td>
               </tr>
           </tfoot>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
