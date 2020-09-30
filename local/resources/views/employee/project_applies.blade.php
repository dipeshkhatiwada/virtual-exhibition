@extends('employe_master')
@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">Project(s) you applied</h3>
    <div class="common_bg all10p hidden-xs">
      <div class="careerfy-managejobs-list-wrap">
        <div class="careerfy-managejobs-list">
          <!-- Manage Jobs Header -->
          <div class="careerfy-table-layer careerfy-managejobs-thead">
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">Project Title</div>
              <div class="careerfy-table-cell">Duration</div>
              <div class="careerfy-table-cell">Amount</div>
              <div class="careerfy-table-cell">Date</div>
              <div class="careerfy-table-cell">Status</div>
            </div>
          </div>
          <div class="careerfy-table-layer careerfy-managejobs-tbody">
            @foreach($datas['apply'] as $apply)
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">
                <a href="javascript:void(0);" onclick="detail('{{$apply->id}}')"> {{\App\Project::getTitle($apply->project_id)}}</a>
              </div>
              <div class="careerfy-table-cell">
                {{$apply->duration}} Day(s)
              </div>
              <div class="careerfy-table-cell">
                NPR. {{$apply->amount}}
              </div>
              <div class="careerfy-table-cell ">
                <span class="applied_date"> {{$apply->created_at}}</span>
              </div>
              <div class="careerfy-table-cell"><?php echo \App\ProjectApply::getStatus($apply->status, $apply->complete_status);?>
              </div>
            </div>
            <div id="detail_{{$apply->id}}" style="display: none;">
              <div class="form_bg">
                <h3 class="form_heading">Proposal</h3>
                <p class="p7"><?php echo $apply->description;?></p>
                <h3 class="form_heading">Project Milestone</h3>
                <div class="form_tabbar">
                  <table class="table table_form">
                    <thead>
                      <tr>
                        <th>Description</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($apply->ProjectMilestone as $mstone)
                      <tr>
                        <td>{{$mstone->description}}</td>
                        <td>{{$mstone->amount}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
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
            <tr>
              <th>Project Title</th>
              <th>
                <a href="javascript:void(0);" onclick="detail('{{$apply->id}}')"> {{\App\Project::getTitle($apply->project_id)}}</a>
              </th>
            </tr>
            <tr>
            <td>Duration</td>
            <td>{{$apply->duration}} Day(s)</td>
            </tr>
            <tr>
            <td>Amount</td>
            <td>NPR. {{$apply->amount}}</td>
            </tr>
            <tr>
            <td>Date</td>
            <td>{{$apply->created_at}}</td>
            </tr>
            <tr>
            <td>Status</td>
            <td><?php echo \App\ProjectApply::getStatus($apply->status, $apply->complete_status);?></td>
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
<div class="modal fade servicemodal" id="modal-bid" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Bid Detail</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      
      <div class="modal-body">
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        
      </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<script type="text/javascript">
function detail(id) {
$('#modal-bid .modal-body').html($('#detail_'+id).html());
$('#modal-bid').modal('show');
}
</script>
@stop()