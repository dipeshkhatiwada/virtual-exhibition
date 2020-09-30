@extends('employer_master')
@section('content')
<div class="row tp10p cm10-row">
                               
                    <div class="col-md-12">
                    <div class="common_bg tp10m">
                        <div class="job_cat_title">
                            <i class="fas fa-grip-vertical"></i> Cart Items
                        </div>
                                        @if(count($datas['cart']) > 0)

                                         <table class="table table_form">

                                           <thead>
                                                <th>Service Type</th>
                                                <th>Type</th>
                                                <th>Duration</th>
                                                <th>Amount</th>
                                                <th>Number</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                @php($total = 0)
                                                 @foreach($datas['cart'] as $cart)
                                                <tr>
                                                    <td>{{ $cart['type'] }}</td>
                                                    <td>{{$cart['job_type']}}</td>
                                                    <td>{{ $cart['duration']}} {{$cart['type'] == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'}}</td>
                                                    <td>NPRs. {{$cart['amount']}}</td>
                                                    <td>{{$cart['job_number']}}</td>
                                                    <td> 
                                                        <a href="javascript:void(0);" onClick="confirm_delete('/{{$cart["id"]}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @php($total += $cart['amount'])
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <td colspan="3"><strong>Total Amount</strong></td>
                                                <td colspan="2"><strong>NPRs. {{$total}}</strong></td>
                                            </tr>
                                            <tr>
                                                 <td colspan="3"><a href="{{url('employer/buy_package')}}" class="btn btn-primary">Buy Package</a></td>
                                                <td colspan="2"><a href="{{url('employer/checkout')}}" class="btn btn-success">Checkout</a></td>
                                            </tr>
                                            </tfoot>
                                       
                                       </table>
                                      
                                        @else
                                        <div style="clear: both;"></div>
                                        <div class="alert alert-info text-center">
                                                <span class="icon-circle-warning mr-2"></span>
                                                Your Cart is Empty.
                                                <a href="{{url('employer/newjob')}}">
                                                    <strong>Post a Job, now!</strong></a>
                                                </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
<script type="text/javascript">
    function confirm_delete(ids) {
        if(confirm('Do You Want To Delete This Data?')){
              var url= "{{ url('/employer/cart/delete/') }}"+ids;
              location = url;
              
              }
    }
</script>
                           
@endsection