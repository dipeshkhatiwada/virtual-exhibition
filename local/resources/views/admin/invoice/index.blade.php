@extends('admin_master')
@section('heading')
Invoice
            <small>List of Invoice</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">Invoice</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
      <!-- <div class="row"> -->
        <!-- <a href="{{ url('/admin/event_category/addnew') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Event Category</a> -->
      <!-- </div> -->
     
      <div class="box">
          @if(count($datas) > 0)
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Employee</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($datas as $job)
                      <tr>
                          <td>{{$job['employee']->firstname}} {{$job['employee']->lastname}}</td>
                          <td>{{$job->amount}}</td>
                          <td>{{$job['invoice_status']}}</td>
                          <td>{{$job->created_at}}</td>
                          <td> 
                              <a href="{{url('admin/invoice/view/'.$job->id)}}" class="btn btn-sm btn-primary left"><i class="fa fa-eye"></i> View</a>
                              <!-- <a href="javascript:void(0);" onClick="confirm_delete('/{{$job->id}}')" class="btn btn-sm btn-danger left"><i class="fa fa-trash-alt"></i> Delete</a> -->
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              <!-- /.col -->
            <!-- Pagination -->
            <div class="careerfy-pagination-blog">
                 <?php echo $datas->render();?>
            </div>
          @else
            <div style="clear: both;"></div>
            <div class="alert alert-info text-center">
                    <span class="icon-circle-warning mr-2"></span>
                    You don't have any Orders at the moment.
                    </div>
          @endif
      </div>
    </div>
  </div>
  
  <!-- <script type="text/javascript">
 function confirm_delete(ids){
   console.log(ids);
      if(confirm('Do You Sure You Want To Delete?')){
        var url= "{{ url('/admin/invoice/delete') }}"+ids;
        location = url;
      }
    }
 </script> -->
@stop()