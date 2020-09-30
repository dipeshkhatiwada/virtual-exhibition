@extends('admin_master')
@section('heading')
Invoice
<small>detail </small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@stop
@section('content')
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
        <h3>Invoice <small>of company</small></h3>
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Company Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                            <?php $i=1; ?>
                            @foreach ($data['invoice'] as $val)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $val['company_name'] }}</td>
                                <td>{{ $val['amount'] }}</td>
                                <td>{{ $val['invoice_status'] }}</td>
                                <td>{{ $val['created_at']}}</td>
                                <td>
                                    <a href="{{url('admin/enroll/invoice-view/'.$val->id)}}" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                            @endforeach

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
