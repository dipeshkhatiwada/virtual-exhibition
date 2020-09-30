@extends('employer_master')
@section('content')
<div class="careerfy-typo-wrap">
    <div class="careerfy-employer-dasboard">
        <div class="careerfy-employer-box-section">
            <!-- Profile Title -->
            <div class="careerfy-profile-title">
                <h2>Manage Event</h2>
                <a href="{{url('employer/events/addnew')}}" class="careerfy-employer-profile-submit ml-3 mb-3">Create Event</a>
            </div>

            @if(count($datas) > 0)
            <!-- Manage Jobs -->
            <div class="careerfy-managejobs-list-wrap">
                <div class="careerfy-managejobs-list">
                    <!-- Manage Jobs Header -->
                    <div class="careerfy-table-layer careerfy-managejobs-thead">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell">Title</div>
                            <div class="careerfy-table-cell">Created At</div>
                            <div class="careerfy-table-cell">Status</div>
                            <div class="careerfy-table-cell"></div>
                        </div>
                    </div>
                    @foreach($datas as $event)
                    <!-- Manage Jobs Body -->
                    <div class="careerfy-table-layer careerfy-managejobs-tbody">
                        <div class="careerfy-table-row">
                            <div class="careerfy-table-cell"> <h6>{{$event->title}}</h6></div>
                            <div class="careerfy-table-cell">{{$event->created_at}}</div>
                           
                           

                            <div class="careerfy-table-cell"><?php echo $event->status == 1 ? 'Active' : 'Disabled'; ?></div>
                            <div class="careerfy-table-cell">
                                <div class="careerfy-managejobs-links">
                                   
                                    <a href="{{url('employer/events/edit/'.$event->id)}}" class="edit fa fa-edit"></a>
                                    <a href="javascript:void(0);" onClick="confirm_delete('/{{$event->id}}')" class="delete fa fa-trash-o"></a>
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
                    You don't have any Event at the moment.
                    <a href="{{url('employer/events/addnew')}}">
                        <strong>Post a Event, now!</strong></a>
                    </div>
            @endif

        </div>
    </div>
</div>
<script type="text/javascript">
 function confirm_delete(ids){
    if(confirm('Do You Want To Delete This Event?')){
      var url= "{{ url('/employer/events/delete/') }}"+ids;
      location = url;
      
      }
    }
</script>
@endsection