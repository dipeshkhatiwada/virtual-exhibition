@extends('employe_master')
@section('content')
<!-- left pannel of accordian menu and service package ended here -->
<h3 class="form_heading">Job(s) you applied</h3>
<div class="common_bg all10p hidden-xs">
  <div class="careerfy-managejobs-list-wrap">
    <div class="careerfy-managejobs-list">
      <!-- Manage Jobs Header -->
      <div class="careerfy-table-layer careerfy-managejobs-thead">
        <div class="careerfy-table-row">
          <div class="careerfy-table-cell">Organization</div>
          <div class="careerfy-table-cell">Job Title</div>
          
          <div class="careerfy-table-cell">Applied Date</div>
          <div class="careerfy-table-cell">Status</div>
          <div class="careerfy-table-cell">Vacancy Status</div>
          <div class="careerfy-table-cell">Action</div>
        </div>
      </div>
      <div class="careerfy-table-layer careerfy-managejobs-tbody">
        @foreach($datas['apply'] as $apply)
        
        <div class="careerfy-table-row">
          
          <div class="careerfy-table-cell">
            {{\App\Jobs::getOrgName($apply->jobs_id)}}
          </div>
          <div class="careerfy-table-cell">
            {{\App\Jobs::getTitle($apply->jobs_id)}}
          </div>
          
          <div class="careerfy-table-cell "><span class="applied_date"> {{$apply->apply_date}}</span></div>
          @php($status =  \App\JobApply::getStatus($apply->id))
          <div class="careerfy-table-cell"><?php echo $status['status'];?></div>
          <div class="careerfy-table-cell">
            <button class="btn lightgreen_gradient" data-toggle="modal" data-target="#modal-detail-{{$apply->jobs_id}}" >Status Detail</button>
          </div>
          <div class="careerfy-table-cell">
            @php($deadline = \App\JobApply::getDeadline($apply->jobs_id))
            @if($deadline != '')
            @if($deadline < date(date('Y-m-d')))
            @if($status['selected'] > 0)
            @if($status['participated'] == 0)
            <button class="btn lightgreen_gradient" onclick="participate({{$status['process_id']}})">Will Participate</button>
            @else
            <button class="btn lightgreen_gradient">Participation Approved</button>
            @endif
            @endif
            @else
            <button class="btn lightgreen_gradient" onclick="dropApplication({{$apply->id}},'{{\App\Jobs::getTitle($apply->jobs_id)}}','{{\App\Jobs::getOrgName($apply->jobs_id)}}',{{$apply->jobs_id}})">Withdraw</button>
            @endif
            
            @endif
          </div>
          
          
        </div>
        
        @endforeach
      </div>
    </div>
  </div>
  
</div>
    <div class="hidden-lg hidden-md">
  <table class="table mob_table table-bordered ">
    <tbody>
        @foreach($datas['apply'] as $apply)
        @php($status =  \App\JobApply::getStatus($apply->id))
        <tr>
          <th>Organization</th>
          <th>
            {{\App\Jobs::getOrgName($apply->jobs_id)}}
          </th>
        </tr>
        <tr>
        <td>Job Title</td>
        <td>{{\App\Jobs::getTitle($apply->jobs_id)}}</td>
        </tr>
        <tr>
        <td>Vacancy Code</td>
        <td>{{\App\Jobs::getCode($apply->jobs_id)}}</td>
        </tr>
        <tr>
        <td>Apply Date</td>
        <td><span class="applied_date"> {{$apply->apply_date}}</span></td>
        </tr>
        <tr>
        <td>Status</td>
        <td><?php echo $status['status'];?></td>
        </tr>
        <tr>
        <td>Vacancy Status</td>
        <td><button class="btn lightgreen_gradient" data-toggle="modal" data-target="#modal-detail-{{$apply->jobs_id}}" >Status Detail</button></td>
        </tr>
        <tr>
        <td>Action</td>
        <td>
            @php($deadline = \App\JobApply::getDeadline($apply->jobs_id))
            @if($deadline != '')
            @if($deadline < date(date('Y-m-d')))
            @if($status['selected'] > 0)
            @if($status['participated'] == 0)
            <button class="btn lightgreen_gradient" onclick="participate({{$status['process_id']}})">Will Participate</button>
            @else
            <button class="btn lightgreen_gradient">Participation Approved</button>
            @endif
            @endif
            @else
            <button class="btn lightgreen_gradient" onclick="dropApplication({{$apply->id}},'{{\App\Jobs::getTitle($apply->jobs_id)}}','{{\App\Jobs::getOrgName($apply->jobs_id)}}',{{$apply->jobs_id}})">Withdraw</button>
            @endif
            
            @endif
        </td>
        </tr>
         @endforeach
    </tbody>
  </table>
</div>
<div class="col-md-12">
    <div class="dataTables_paginate paging_simple_numbers right">
      <?php echo $datas['apply']->render();?>
    </div>
  </div>

 @foreach($datas['apply'] as $apply)
<div class="modal fade servicemodal" id="modal-detail-{{$apply->jobs_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                
                <h4 class="modal-title left" >{{\App\Jobs::getProcessTitle($apply->jobs_id)}}</h4>
                <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              </div>
             
                <div class="modal-body">
                  
                  {{\App\Jobs::getProcessDetail($apply->jobs_id)}}
                  
                </div>
               
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
  @endforeach      

<div class="modal fade servicemodal" id="modal-withdraw" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Withdraw Reason</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form id="ratingsForm" method="post" action="{{url('/employee/withdraw')}}" class="dash_forms" enctype="multipart/form-data">
        <input type="hidden" name="apply_id" value="" id="apply_id">
        <input type="hidden" name="job_id" value="" id="job_id">
        {!! csrf_field() !!}
        <div class="modal-body">
          <div class="form-group row">
            
            <div class="col-md-12">
              <textarea class="form-control" name="reason"></textarea>
            </div>
          </div>
          
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default pull-left">Submit</button>
          
        </div>
      </form>
      
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
function dropApplication(apply_id,title,job,job_id)
{
if(confirm('Do you want to withdraw from '+title+' of '+job)){
$('#apply_id').val(apply_id);
$('#job_id').val(job_id);
$('#modal-withdraw').modal('show');

}
}
function participate(process_id)
{
if(confirm('Do you want to participate in this process?')){
var url = '{{url("employee/process/participate?process_id=")}}'+process_id;
location = url;

}
}
</script>

@stop()