@extends('employer_master')
@section('content')

  <h3 class="form_heading">training<a href="{{ url('/employer/training/addnew') }}" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Training</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive">
      <table class="table table_form">
        <thead>
          <th>Title</th>
          <th>Venue</th>
          <th>Address</th>
          <th>Opening Date</th>
          <th>Closing Date</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          @if(count($datas))
          @foreach($datas as $training) 
          <tr>
            <td>{{$training->title}}</td>
            <td>{{$training->venue}}</td>
            <td>{{$training->address}}</td>
            <td>{{$training->start_date}}</td>
            <td>{{$training->end_date}}</td>
            <td>{{$training->status == 1 ? 'Active' : 'Deactive'}}</td>
            <td>
              <a href="{{ url('/employer/training/edit/'.$training->id) }}" class="btn whitegradient greenclr left"><i class="fa fa-edit"></i> Edit</a></div>
              @if($training->user_type != 1)
              <a href="javascript:void(0);" onClick="confirm_delete('/{{$training->id}}')" class="btn whitegradient redclr left"><i class="fa fa-fw fa-remove"></i> Delete</a>
              @endif
            </td>
          </tr>
           @endforeach
          @else
          <tr>
            <td colspan="7"><span class="col-md-12 alert alert-info">Sorry No any trainings found</span></td>
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
    var url= "{{ url('/employer/training/delete/') }}"+ids;
    location = url;
    }
  }
</script>
@endsection