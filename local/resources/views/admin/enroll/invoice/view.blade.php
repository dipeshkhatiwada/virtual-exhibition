@extends('admin_master')
@section('content')
<div class="row">
    <div class="col-md-12 careerfy-typo-wrap">
        <div class="careerfy-employer-dasboard">
        <!-- Profile Title -->
            <h3 class="form_heading">Order Detail</h3>
            <div class="invoice">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <img src="{{asset('image/'.$data['logo'])}}" width="200px;">
                            <small class="pull-right">Date: {{$data['invoice']->created_at}}<br><b>Invoice No. #{{$data['invoice']->invoice_no}}</b></small>
                        </h2>
                     </div>
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
                    <div class="col-sm-4 invoice-col">

                    </div>

                    <div class="col-sm-4 invoice-col">

                        To
                        <address>
                            <strong>{{$data['invoice']->company_name}}</strong><br>

                            Phone: {{$data['invoice']->telephone}}<br>
                            Email: {{$data['invoice']->email}}
                        </address>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table style="width: 100%;">
                            <thead style="background-color: #ddd; text-align: left;">
                                <tr>
                                <th style="padding:5px;">S.N.</th>
                                <th style="padding:5px;">Product Type</th>
                                <th style="padding:5px;">Category</th>
                                <th style="padding:5px;">Booth/Stall Name</th>
                                <th style="padding:5px;">Booth/Stall Type</th>
                                <th style="padding:5px;">Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                    @foreach($data['invoice']->enrollinvoiceItem as $item)
                                    <tr>
                                        <td style="padding:5px;">{{$i++}}</td>
                                        <td style="padding:5px;">{{ $item->type }}</td>
                                        <td style="padding:5px;">{{ $item->category }}</td>
                                        <td style="padding:5px;">{{ $item->booth_name }}</td>
                                        <td style="padding:5px;">{{ $item->booth_type }}</td>
                                        <td style="padding:5px;">Rs. {{ $item->amount }} </td>
                                    </tr>
                                    @endforeach

                                    <tr style="font-weight: bold;">
                                        <td colspan="5" style="text-align: right; padding-right: 10px; font-weight: 700">Total Amount</td>
                                    <td><strong>Rs. {{ $data['invoice']->amount }}</strong></td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <p class="col-12 text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        {{$data['invoice']->comment}}
                    </p>

                    <p class="lead">Order History:</p>
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>

                                <th>Date</th>
                                <th>Comment </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($data['invoice']->enrollinvoiceHistory as $history)
                                    <tr>
                                    <td>{{$history->created_at}}</td>
                                    <td>{{$history->comment}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="{{url('employer/enroll-invoice/print/'.$data['invoice']->id)}}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
