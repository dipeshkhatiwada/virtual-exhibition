@extends('admin_master')
@section('heading')
Events
<small>List of Events</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Events</li>
@stop
@section('content')
<div class="row">
  <div class="col-xs-12">
    
    <div class="row">
      <a href="{{ url('/admin/event/addnew') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Event</a>
    </div>
    
    <div class="box">
      <div class="box-body">
        
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Employer</th>
              <th>Title</th>
              <th>Category</th>
              <th>Venue</th>
              <th>Address</th>
              <th>Event Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td>
                <input type="hidden" id="filter_employer" value="{{$datas['filter_employer']}}">
                <input type="text" class="form-control" name="employers" id="employers" value="{{\App\Employers::getName($datas['filter_employer'])}}">
              </td>
              <td>
                <input type="text" name="filter_title" id="filter_title" value="{{$datas['filter_title']}}" class="form-control">
              </td>
              <td><select class="form-control" name="filter_category" id="filter_category">
                <option value="">Select Category</option>
                @foreach($datas['categories'] as $category)
                
                @if($datas['filter_category'] == $category->id)
                <option selected="selected" value="{{$category->id}}">{{$category->title}}</option>
                @else
                <option value="{{$category->id}}">{{$category->title}}</option>
                @endif
                @endforeach
              </select></td>
              <td></td>
              <td></td>
              <td><select class="form-control" id="filter_status">
                <option value="">Select Status</option>
                @foreach($datas['status'] as $status)
                @if($datas['filter_status'] == $status['value'])
                <option selected="selected" value="{{$status['value']}}">{{$status['title']}}</option>
                @else
                <option value="{{$status['value']}}">{{$status['title']}}</option>
                @endif
                @endforeach
              </select></td>
              <td></td>
              <td><button type="button" class="btn btn-primary" onclick="filterData()"><i class="fa fa-search"></i>Filter</button></td>
            </tr>
            @php($i = 1)
            @if(count($datas['event']))
            @foreach($datas['event'] as $event)
            <tr>
              <td>{{$i++}}</td>
              <td>{{\App\Employers::getName($event->employers_id)}}</td>
              <td>{{\App\library\Settings::getLimitedWords($event->title,0,10)}}</td>
              <td>{{\App\EventCategory::getTitle($event->event_category_id)}}</td>
              <td>{{$event->venue}}</td>
              <td>{{$event->address}}</td>
              <td>{{$event->event_date}}</td>
              <td>{{$event->status == 1 ? 'Enabled' : 'Disabled'}}</td>
              
              <td>
                <a href="{{ url('/admin/event/edit/'.$event->id) }}" class="btn btn-primary left"><i class="fa fa-edit"></i></a></div>
                @if($event->user_type != 1)
                <a href="javascript:void(0);" onClick="confirm_delete('/{{$event->id}}')" class="btn btn-danger left"><i class="fa fa-fw fa-remove"></i></a>
                @endif
              </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="9" class="row"><span class="col-md-12 alert alert-info">Sorry No any events found</span></td></tr>
            @endif
          </tbody>
        </table>
        
        </div><!-- /.box-body -->
      </div>
    </div>
    <div>
      <div>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="dataTables_paginate paging_simple_numbers right">
            <?php echo $datas['event']->render();?>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      
      function confirm_delete(ids){
      if(confirm('Do You Want To Delete This Event?')){
      var url= "{{ url('/admin/event/delete/') }}"+ids;
      location = url;
      
      }
      }
      
      
      </script>
      <script type="text/javascript">
      $('#employers').autocomplete({
      source: '{{ url("/admin/employers/autocomplete/") }}',
      minlength:1,
      autoFocus:true,
      select:function(e,ui){
      
      $('#filter_employer').val(ui.item.id);
      filterData();
      
      }
      });
      </script>
      <script type="text/javascript">
      function filterData() {
      var filter_employer = $('#filter_employer').val();
      var filter_title = $('#filter_title').val();
      var filter_category = $('#filter_category').val();
      var filter_status = $('#filter_status').val();
      var url= "{{ url('/admin/event/?') }}";
      if (filter_employer != '') {
      url += '&filter_employer='+filter_employer;
      }
      if (filter_title != '') {
      url += '&filter_title='+filter_title;
      }
      if (filter_category != '') {
      url += '&filter_category='+filter_category;
      }
      if (filter_status != '') {
      url += '&filter_status='+filter_status;
      }
      location = url;
      }
      </script>
      @stop()