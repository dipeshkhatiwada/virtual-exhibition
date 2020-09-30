@extends('admin_master')
@section('heading')
Upgrade
<small>List of Upgrade</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Upgrade</li>
@stop
@section('content')
<div class="row">
  <div class="col-xs-12">
    
   
    
    <div class="box">
      <div class="box-body">
        
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Employer</th>
              <th>Current Type</th>
              <th>Upgrade Type</th>
             
              <th>Request Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            
            @php($i = 1)
            @if(count($datas))
            @foreach($datas as $upgrade)
            <tr>
              <td>{{$i++}}</td>
              <td>{{\App\Employers::getName($upgrade->employers_id)}}</td>
              <td>{{\App\MemberType::getTitle($upgrade->employers_id)}}</td>
              <td>{{\App\MemberType::getTypeTitle($upgrade->member_type_id)}}</td>
             
              <td>{{$upgrade->created_at}}</td>
              
              
              <td>
                <a href="javascript:void(0);" onClick="confirm_approve('/{{$upgrade->id}}')" class="btn btn-success left"><i class="fa fa-thumbs-up"></i> Approve</a>
                <a href="javascript:void(0);" onClick="confirm_disapprove('/{{$upgrade->id}}')" class="btn btn-danger left"><i class="fa fa-thumbs-down"></i> Disapprove</a>
               
              </td>
            </tr>
            @endforeach
            @else
            <tr><td colspan="5" class="row"><span class="col-md-12 alert alert-info">Sorry No any upgrades request</span></td></tr>
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
            <?php echo $datas->render();?>
          </div>
        </div>
      </div>
      <script type="text/javascript">
      
      function confirm_approve(ids){
      if(confirm('Do You Want To Approve This Request?')){
      var url= "{{ url('/admin/upgrade-request/approve/') }}"+ids;
      location = url;
      
      }
      }

       function confirm_disapprove(ids){
      if(confirm('Do You Want To Disapprove This Request?')){
      var url= "{{ url('/admin/upgrade-request/disapprove/') }}"+ids;
      location = url;
      
      }
      }
      
      
      </script>
      
      @stop()