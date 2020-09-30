@extends('front.event-master')
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
                            <th style="text-align: center">Event</th>
                            <th style="text-align: center">Type</th>
                            <th style="text-align: center">Ticket Type</th>
                            <th style="text-align: center">Duration</th>
                            <th style="text-align: center">Quantity</th>
                            <th style="text-align: center">Rate</th>
                            <th style="text-align: center">Total Amount</th>
                            <th style="text-align: center">Actions</th>
                        </thead>
                        <tbody>
                            @php($total = 0)
                                @foreach($datas['cart'] as $cart)
                            <tr>
                                <td style="text-align: center">{{ $cart['event_title'] }}</td>
                                <td style="text-align: center">{{ $cart['type'] }}</td>
                                <td style="text-align: center">{{$cart['ticket_type'] != '' ? $cart['ticket_type']: '-'}}</td>
                                <td style="text-align: center">{{ $cart['duration']}} {{$cart['type'] == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'}}</td>
                                <td style="text-align: center">{{ $cart['quantity'] }}</td>
                                <td style="text-align: center">NPRs. {{ $cart['rate']}}</td>
                                <td style="text-align: center">NPRs. {{ $cart['total_amount']}}</td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0);" onClick="confirm_delete('/{{$cart["id"]}}')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @php($total += $cart['total_amount'])
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="6" style="text-align: right"><strong>Total Amount</strong></td>
                            <td colspan="2" style="text-align: left"><strong>NPRs. {{$total}}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <!-- <a href="{{url('employee/buy_package')}}" class="btn btn-primary">Buy Package</a> -->
                            </td>
                            <td colspan="1"><a href="{{url('employee/checkout')}}" class="btn btn-success">Checkout</a></td>
                        </tr>
                        </tfoot>
                    </table>
                @else
                    <div style="clear: both;"></div>
                    <div class="alert alert-info text-center">
                        <span class="icon-circle-warning mr-2"></span>
                        Your Cart is Empty.
                        <a href="{{url('employee/newjob')}}">
                            <strong>Post a Job, now!</strong></a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirm_delete(ids) {
            var token = $('input[name=\'_token\']').val();
            if(confirm('Do You Want To Delete This Data?')){
                $.ajax({
                    type: 'DELETE',
                    url: '/employee/cart'+ids,
                    data: 'id='+ids+'&_token='+token,
                    cache: false,
                    success: function(html){
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
