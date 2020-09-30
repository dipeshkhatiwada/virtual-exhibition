@extends('employer_master')
@section('content')
  <h3 class="form_heading">Event<a href="{{ url('/employer/event/addnew') }}" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Event</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive-lg">
      <table class="table table_form">
        <thead>
          <th>Title</th>
          <th>Venue</th>
          <th>Address</th>
          <th>Event Date</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          @if(count($datas))
          @foreach($datas as $event) 
          <tr>
            <td>{{$event->title}}</td>
            <td>{{$event->venue}}</td>
            <td>{{$event->address}}</td>
            <td>{{$event->event_date}}</td>
            <td>{{$event->status == 1 ? 'Active' : 'Deactive'}}</td>
            <td>
              <a href="{{ url('/employer/event/edit/'.$event->id) }}" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</a></div>
              @if($event->user_type != 1)
              <a href="javascript:void(0);" onClick="confirm_delete('/{{$event->id}}')" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</a>
              @endif
              @if(
                isset($event->eventMeeting) &&
                Auth::guard('employer')->user()->id == $event->eventMeeting->created_by &&
                "$event->event_date"." "."$event->start_time" <= $dt &&
                "$event->to_date"." "."$event->end_time" >= $dt
              )
              <a href="{{$event->eventMeeting->start_url}}" target="_blank" class="btn whitegradient"><i class="fa fa-fw fa-play"></i> Start</a>
              @endif
            </td>
          </tr>
           @endforeach
          @else
          <tr>
            <td colspan="6"><span class="col-md-12 alert alert-info">Sorry No any events found</span></td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $datas->render();?>
        </div>
      </div>
    </div>
  </div>
<script type="text/javascript">
  function confirm_delete(ids){
  if(confirm('Do You Want To Delete This Data?')){
    var url= "{{ url('/employer/event/delete/') }}"+ids;
    location = url;
    }
  }
</script>
@endsection