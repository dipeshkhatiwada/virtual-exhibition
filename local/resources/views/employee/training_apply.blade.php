@extends('employe_master')

@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">Training(s) you participated</h3>
    <div class="common_bg all10p hidden-xs">
      <div class="careerfy-managejobs-list-wrap">
        <div class="careerfy-managejobs-list">
          <!-- Manage Jobs Header -->
          <div class="careerfy-table-layer careerfy-managejobs-thead">
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">Title</div>
              <div class="careerfy-table-cell">Organizer</div>
              <div class="careerfy-table-cell">Date</div>
              <div class="careerfy-table-cell">Time</div>
              <div class="careerfy-table-cell">Apply Date</div>
              <div class="careerfy-table-cell">Action</div>
            </div>
          </div>
          <div class="careerfy-table-layer careerfy-managejobs-tbody">
            @foreach($datas['apply'] as $apply)
            <div class="careerfy-table-row">
              <div class="careerfy-table-cell">
                {{\App\Training::getTitle($apply->training_id)}}
              </div>
               <div class="careerfy-table-cell">
               {{\App\Training::getOrgName($apply->training_id)}}
              </div>
              <div class="careerfy-table-cell">
                {{\App\Training::getDate($apply->training_id)}}
              </div>
              <div class="careerfy-table-cell">
                {{\App\Training::getTime($apply->training_id)}}
              </div>
               <div class="careerfy-table-cell "><span class="applied_date"> {{$apply->apply_date}}</span></div>
              <div class="careerfy-table-cell"><button class="btn btn-danger" onclick="deleteApply('/{{$apply->id}}')"><i class="fa fa-remove"></i></button></div>
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
          <th>Title</th>
          <th>
            {{\App\Training::getTitle($apply->training_id)}}
          </th>
        </tr>
        <tr>
        <td>Organizer</td>
        <td>{{\App\Training::getOrgName($apply->training_id)}}</td>
        </tr>
        <tr>
        <td>Date</td>
        <td>{{\App\Training::getDate($apply->training_id)}}</td>
        </tr>
        <tr>
        <td>Time</td>
        <td>{{\App\Training::getTime($apply->training_id)}}</td>
        </tr>
        <tr>
        <td>Apply Date</td>
        <td><span class="applied_date">{{$apply->apply_date}}</span></td>
        </tr>
        <tr>
        <td>Action</td>
        <td><button class="btn btn-danger" onclick="deleteApply('/{{$apply->id}}')"><i class="fa fa-remove"></i></button></td>
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
<script type="text/javascript">
   function deleteApply(ids){
    if(confirm('Do You do not Want To Participate?')){
      var url= "{{ url('/employee/training/apply/delete/') }}"+ids;
      location = url;
      }
    }
</script>
  
@stop()