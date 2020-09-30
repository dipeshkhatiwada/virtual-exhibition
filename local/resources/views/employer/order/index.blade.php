@extends('employer_master')
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
            <div class="careerfy-managejobs-list-wrap">
                <div class="careerfy-managejobs-list">
                    <!-- Manage Jobs Header -->
                    <div class="careerfy-table-layer careerfy-managejobs-thead">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell">Amount</div>
                            
                            
                            <div class="careerfy-table-cell">Status</div>
                            <div class="careerfy-table-cell">Created At</div>
                            <div class="careerfy-table-cell">Action</div>
                        </div>
                    </div>
                    @foreach($datas as $job)
                    <!-- Manage Jobs Body -->
                    <div class="careerfy-table-layer careerfy-managejobs-tbody">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell"> {{$job->amount}}</div>
                            
                            <div class="careerfy-table-cell">{{$job->order_status}}</div>
                            <div class="careerfy-table-cell">{{$job->created_at}}</div>
                            <div class="careerfy-table-cell">
                                <div class="careerfy-managejobs-links">
                                    <a href="{{url('employer/order/view/'.$job->id)}}" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                                    <a href="javascript:void(0);" onClick="confirm_delete('/{{$job->id}}')" class="btn whitegradient greenclr left redclr"><i class="fa fa-trash-alt"></i> Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Manage Jobs Body -->
                    @endforeach
                </div>
            </div>
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
</div>
</div>
<script type="text/javascript">
 function confirm_delete(ids){
    if(confirm('Do You Want To Delete This Blog?')){
      var url= "{{ url('/employer/blogs/delete/') }}"+ids;
      location = url;
      }
    }
</script>
@endsection



