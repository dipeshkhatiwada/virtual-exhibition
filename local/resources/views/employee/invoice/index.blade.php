@extends('front.event-master')
<style>
  ._scroll{
    padding:4px; 
    width: 100%; 
    height: 38vh; 
    overflow-x: hidden; 
    overflow-y: auto; 
  }
</style>
@section('content')
<div class="row">
<div class="col-md-12 careerfy-typo-wrap">
    <div class="careerfy-employer-dasboard">
        <div class="">
            <!-- Profile Title -->
            <h3 class="form_heading">Your Orders</h3>

                <div class="careerfy-employer-box-section">
            @if(count($datas) > 0)
            <!-- Manage Jobs -->
              <div class="col-xs-12 table-responsive _scroll">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($datas as $job)
                    <tr>
                        <td>{{$job->amount}}</td>
                        <td>{{$job['invoice_status']}}</td>
                        <td>{{$job->created_at}}</td>
                        <td> 
                            <a href="{{url('employee/invoice/view/'.$job->id)}}" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                            <!-- <a href="javascript:void(0);" onClick="confirm_delete('/{{$job->id}}')" class="btn whitegradient greenclr left redclr"><i class="fa fa-trash-alt"></i> Delete</a> -->
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
<!-- </div> -->
<!-- <script type="text/javascript">
 function confirm_delete(ids){
    if(confirm('Do You Want To Delete?')){
      var url= "{{ url('/employee/invoice/delete/') }}"+ids;
      location = url;
      }
    }
</script> -->
@endsection



