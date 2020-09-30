@extends('employer_master')
@section('heading')
Jobs
  <small>List of Jobs</small>
@stop
@section('breadcrubm')
  <li><a href="{{ url('/employer') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Jobs</li>
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
                    <th>Job Title</th>
                    <th>Categories</th>
                    <th>Vacancy Code</th>
                    <th>Deadline</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Process Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; 
                  foreach ($data as $row) { ?>
                    <tr>
                      <td><?php echo $i;?><span class="badge bg-red">{{\App\Jobs::countApplication($row->id)}}</span></td>
                      <td><a href="{{url('employer/job/'.$row->id)}}"><?php echo $row->title;?></a></td>
                      <td>{{\App\JobCategory::getTitle($row->category_id)}}</td>
                      <td>{{$row->vacancy_code}}</td>
                      <td>{{$row->deadline}}</td>
                      <td>{{$row->created_at}}</td>
                      <td>{{\App\Employers::getStatus($row->status)}}</td>
                      <td>{{\App\RecruitmentProcess::getTitle($row->process_status)}}</td>
                      <td>
                       <a href="{{url('employer/jobs/application/'.$row->id)}}" class="btn btn-primary" title="view"><span class="badge bg-red">{{\App\Jobs::countApplication($row->id)}}</span>Application</a>
                      </td>
                    </tr>
                <?php $i++;  }
                ?>
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
          <?php echo $data->render();?>
      </div>
    </div>
  </div>
  
 
@stop()