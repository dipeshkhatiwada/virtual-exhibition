
@extends('employer_master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/morris.js/morris.css')}}">
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <div class="all10p">
	<div class="whitebg tb5p">
		<div class="row">
			<!-- left pannel of accordian menu and service package ended here -->
			<div class="col-md-9">

					<div class="profile_title orangeclr">
						Profile Completeness
					</div>
					<div class="tb10p">
						<div class="row cm10l-row">
							<div class="col-md-1 col-2 profile_progress">{{$data['profile_complete']}}%</div>
							<div class="col-md-10 col-8">
								<div class="progress">
									<div class="progress-bar greenbar" role="progressbar" style="width: {{$data['profile_complete']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-md-1 col-2 total_progress">100%</div>
						</div>
					</div>
					@if($data['profile_complete'] < 100)
					<div class="center">
						<p>Complete your profile to 100% to get more user interaction</p>
					</div>
					@endif

			</div>
			@if($data['profile_complete'] < 100)
			<div class="col-md-3">
				<div class="right tp20p">
					<a href="{{url('employer/editprofile')}}" class="btn skybluegradient">Improve Org. Profile</a>
				</div>
			</div>
			@endif
		</div>
	</div>
<div class= "tp10m">
<div class="row">
<div class="col-md-12 panel-heading">
    <div class="product-link btn-group ">
        <a href="{{url('/employer')}}" class="btn app_active">Job</a>
        <a href="{{url('/employer/dashboard/tender')}}" class="btn app_default">Tender</a>
         <a href="{{url('/employer/dashboard/project')}}" class="btn app_default">Project</a>
        <a href="{{url('/employer/dashboard/training')}}" class="btn app_default">Training</a>
        <a href="{{url('/employer/dashboard/event')}}" class="btn app_default">Event</a>
        <a href="{{url('/employer/dashboard/enroll')}}" class="btn app_default">Enroll</a>

    </div>

    <div id="job" class="careerfy-typo-wrap">
		<div class="careerfy-employer-dasboard btm10m">
			<div class="careerfy-employer-box-section whitebg">
			<div class="row cm10-row">
		<div class="col-md-1 col-3">
			<a href="{{url('/employer')}}" class="btn btn-block {{$data['filter_stat'] == '' ? 'whiteclr bluecomnbtn' : 'app_default'}}">Recent</a>
		</div>
		<div class="col-md-1 col-3">
			<a href="{{url('/employer?filter_stat=1')}}" class="btn btn-block {{$data['filter_stat'] == '1' ? 'whiteclr bluecomnbtn' : 'app_default'}} ">Total</a>
		</div>
		<div class="col-md-6 col-12">
			<div class="row cm10-row search_form">
				<div class="form-group col-md-4">
					<input type="text" id="from" class="form-control datepicker" placeholder="2018-12-25" value="{{$data['from']}}">
				</div>
				<div class="form-group col-md-4">
					<input type="text" id="to" class="form-control datepicker" placeholder="2018-12-25" value="{{$data['to']}}">
				</div>
			</div>
		</div>
		<div class="col-md-1">
			<button type="button" class="btn bluecomnbtn greenbg" onclick="filterStatus()"><i class="fa fa-search"></i> Search</button>
		</div>
		<div class="col-md-3 tp5p">
			<span class="greenclr lft15p">Job analytics by date.</span>
		</div>
	</div>

	<div class="row tp10p cm10-row">
		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
			<!-- small box -->
			<div class="small-box bluegradient">
				<div class="inner">
				<h3>{{$data['total_jobs']}}</h3>
				<p>Job Post</p>
				</div>
				<div class="icon">
				<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
        <div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="small-box purplegradient">
				<div class="inner">
				<h3>{{$data['application_receiving']}}</h3>
				<p>Application Receiving</p>
				</div>
				<div class="icon">
				<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
        </div>
        <div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="small-box skybluegradient">
				<div class="inner">
				<h3>{{$data['total_applicants']}}</h3>
				<p>Applicants</p>
				</div>
				<div class="icon">
				<i class="ion ion-person-add"></i>
				</div>
				<a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="small-box grengradient">
				<div class="inner">
				<h3>{{count($data['pending'])}}</h3>
				<p>Pending</p>
				</div>
				<div class="icon">
				<i class="ion ion-person-add"></i>
				</div>
				<a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="greybg">
			<div class="chart" id="bar-chart" style="height: 110px;" ></div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="greybg">
			<div class="chart" id="status-chart" style="height: 110px;" ></div>
			</div>
		</div>
	</div>

	<div class="row cm10-row">
		@if(count($data['daywise']) > 0)
		<div class="col-md-5">
			<!-- LINE CHART -->
			<div class="box box-info">
				<div class="box-header with-border">
				<h3 class="box-title">Applications</h3>
				</div>
				<div class="box-body chart-responsive">
					<span style="height:10px;width:10px;background:#E65A26;display:inline-block; border: 1px solid #E65A26; border-radious:2px; margin-right:5px;"></span>Visitors
					<span style="height:10px;width:10px;background:#3c8dbc;display:inline-block; border: 1px solid #3c8dbc; border-radious:2px; margin-right:5px; margin-left:10px"></span>Applicants
					<div class="chart" id="line-chart" style="height: 140px;"></div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		@endif
		@if(count($data['age']) > 0)
			<div class="col-md-3">
				<!-- LINE CHART -->
				<div class="box box-info">
					<div class="box-header with-border">
					<h3 class="box-title">Age Diagram</h3>
					</div>
					<div class="box-body chart-responsive">
						<div id="pieChart" style="height:160px"></div>
						<script type="text/javascript">
							google.charts.load('current', {packages: ['corechart', 'bar']});
							google.charts.setOnLoadCallback(drawBasic);
							function drawBasic() {
							var data = google.visualization.arrayToDataTable([
							['City', 'Applicant', { role: 'style' }],
							@foreach($data['age'] as $age)
							['{{$age["title"]}}', {{$age["total"]}}, '{{$age["color"]}}'],
							@endforeach
							]);

							var options = {
							title: 'Applicant Age',
							resize: true,
							chartArea: {width: '100%'},
							hAxis: {
							title: 'Applicant Age',
							minValue: 0
							},
							vAxis: {
							title: ''
							}
							};

							var chart = new google.visualization.ColumnChart(document.getElementById('pieChart'));

							chart.draw(data, options);
							}
						</script>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		@endif
		@if(count($data['districts']) > 0)
			<div class="col-md-4">
				<!-- LINE CHART -->
				<div class="box box-info">
					<div class="box-header with-border">
					<h3 class="box-title">Location Diagram</h3>
					</div>
					<div class="box-body chart-responsive">
						<div id="location_chart" style="height:160px"></div>
						<script type="text/javascript">
							google.charts.load('current', {packages: ['corechart', 'bar']});
							google.charts.setOnLoadCallback(drawBasic);
							function drawBasic() {
							var data = google.visualization.arrayToDataTable([
							['City', 'Applicant', { role: 'style' }],
							@foreach($data['districts'] as $district)
							['{{$district["title"]}}', {{$district["total"]}}, '{{$district["color"]}}'],
							@endforeach
							]);

							var options = {
							title: 'Applicant Location',
							resize: true,
							chartArea: {width: '100%'},
							hAxis: {
							title: 'Applicant Location',
							minValue: 0
							},
							vAxis: {
							title: ''
							}
							};

							var chart = new google.visualization.ColumnChart(document.getElementById('location_chart'));

							chart.draw(data, options);
							}
						</script>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		@endif
	</div>
	<div class="row tp10m">
		<div class="col-md-12">
			<div class="dash_com_block">
				<ul class="nav nav-tabs dash_tab" id="myTab" role="tablist">
					<li class="nav-item tablink">
						<a class="nav-link active" id="active_job" data-toggle="tab" href="#activejob" role="tab" aria-controls="activejob" aria-selected="true">Active Jobs</a>
					</li>
					<li class="nav-item tablink">
						<a class="nav-link" id="pending_job" data-toggle="tab" href="#pendingjob" role="tab" aria-controls="pendingjob" aria-selected="false">Pending Jobs</a>
					</li>
					<li class="nav-item tablink">
						<a class="nav-link" id="expired_job" data-toggle="tab" href="#expiredjob" role="tab" aria-controls="expiredjob" aria-selected="false">Expired Jobs</a>
					</li>
					<li class="nav-item tablink">
						<a class="nav-link" id="drafted_job" data-toggle="tab" href="#draftedjob" role="tab" aria-controls="draftedjob" aria-selected="false">Drafted Jobs</a>
					</li>
					<li class="nav-item tablink">
						<a class="nav-link" id="archive_job" data-toggle="tab" href="#archivejob" role="tab" aria-controls="archivejob" aria-selected="false">Archive Jobs</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content businesstab flex">
					<div class="tab-pane active" id="activejob" role="tabpanel" aria-labelledby="active_job">
							@if(count($data['active']) > 0)
						<div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Job Title</div>
										<div class="careerfy-table-cell">Positions</div>
										<div class="careerfy-table-cell">Job Type</div>
										<div class="careerfy-table-cell">Job View</div>
										<div class="careerfy-table-cell">Applied</div>
									</div>
								</div>
								<div class="careerfy-table-layer careerfy-managejobs-tbody">
									@foreach($data['active'] as $active)
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">
												<p><a href="{{url('/jobs/'.\App\Employers::getUrl($active->employers_id).'/'.$active->seo_url)}}">{{$active->title}}</a></p>
											<span class=""><i class="fa fa-calendar-alt"></i> Created : {{$active->publish_date}}</span>
											<span class="lft15p"><i class="fa fa-calendar-alt"></i> Expired : {{$active->deadline}}</span>
										</div>
										<div class="careerfy-table-cell"><a href="{{url('/employer/jobs/application/'.$active->id)}}" class="careerfy-managejobs-appli">{{\App\Jobs::countApplication($active->id)}} Application(s)</a>
										</div>
										<div class="careerfy-table-cell">
											<span class="btn sendbtn purplegradient lr5p"><?php echo \App\JobType::getIcon($active->job_type);?></span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countView($active->id)}}</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($active->id)}}</div>
									</div>
									@endforeach
								</div>
							</div>
						</div>
						@else
						<div class="alert alert-info text-center all10p" role="alert">
						<span class="icon-circle-warning mr-2"></span>
						You don't have any Active jobs at the moment.
						<a href="{{url('employer/newjob')}}">
							<strong>Post a Job, now!</strong></a>
						</div>
						@endif
					</div>
					<div class="tab-pane" id="pendingjob" role="tabpanel" aria-labelledby="pending_job-">
						@if(count($data['pending']) > 0)
						<div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Job Title</div>
										<div class="careerfy-table-cell">Positions</div>
										<div class="careerfy-table-cell">Job Type</div>
										<div class="careerfy-table-cell">Job View</div>
										<div class="careerfy-table-cell">Applied</div>
									</div>
								</div>
							<div class="careerfy-table-layer careerfy-managejobs-tbody">
								@foreach($data['pending'] as $pending)
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">
											<p><a href="{{url('/jobs/'.\App\Employers::getUrl($pending->employers_id).'/'.$pending->seo_url)}}">{{$pending->title}}</a></p>
											<span class=""><i class="fa fa-calendar-alt"></i> Created : {{$pending->publish_date}}</span>
											<span class="lft15p"><i class="fa fa-calendar-alt"></i> Expired : {{$pending->deadline}}</span>
										</div>
										<div class="careerfy-table-cell"><a href="{{url('/employer/jobs/application/'.$pending->id)}}" class="careerfy-managejobs-appli">{{\App\Jobs::countApplication($pending->id)}} Application(s)</a>
										</div>
										<div class="careerfy-table-cell">
											<span class="gold"><?php echo \App\JobType::getIcon($pending->job_type);?></span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countView($pending->id)}}</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($pending->id)}}</div>
									</div>
									@endforeach
							</div>
							</div>
						</div>
						@else
						<div class="alert alert-info text-center all10p" role="alert">
						<span class="icon-circle-warning mr-2"></span>
						You don't have any Active jobs at the moment.
						<a  href="{{url('employer/newjob')}}">
							<strong>Post a Job, now!</strong></a>
						</div>
						@endif
					</div>
					<div class="tab-pane" id="expiredjob" role="tabpanel" aria-labelledby="expired_job">
							@if(count($data['completed']) > 0)
						<div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Job Title</div>
										<div class="careerfy-table-cell">Positions</div>
										<div class="careerfy-table-cell">Job Type</div>
										<div class="careerfy-table-cell">Job View</div>
										<div class="careerfy-table-cell">Applied</div>
									</div>
								</div>

							<div class="careerfy-table-layer careerfy-managejobs-tbody">

								@foreach($data['completed'] as $completed)
										<div class="careerfy-table-row">
										<div class="careerfy-table-cell">
												<p><a href="{{url('/jobs/'.\App\Employers::getUrl($completed->employers_id).'/'.$completed->seo_url)}}">{{$completed->title}}</a></p>
											<span class=""><i class="fa fa-calendar-alt"></i> Created : {{$completed->publish_date}}</span>
											<span class="lft15p"><i class="fa fa-calendar-alt"></i> Expired : {{$completed->deadline}}</span>
										</div>
										<div class="careerfy-table-cell"><a href="{{url('/employer/jobs/application/'.$completed->id)}}" class="careerfy-managejobs-appli">{{\App\Jobs::countApplication($completed->id)}} Application(s)</a>
										</div>
										<div class="careerfy-table-cell">
											<span class="gold"><?php echo \App\JobType::getIcon($completed->job_type);?></span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countView($completed->id)}}</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($completed->id)}}</div>
									</div>
									@endforeach
							</div>
							</div>
						</div>
						@else
						<div class="alert alert-info text-center all10p" role="alert">
						<span class="icon-circle-warning mr-2"></span>
						You don't have any Active jobs at the moment.
						<a  href="{{url('employer/newjob')}}">
							<strong>Post a Job, now!</strong></a>
						</div>
						@endif
					</div>
					<div class="tab-pane" id="draftedjob" role="tabpanel" aria-labelledby="drafted_job">
						@if(count($data['drafted']) > 0)
						<div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Job Title</div>
										<div class="careerfy-table-cell">Positions</div>
										<div class="careerfy-table-cell">Job Type</div>
										<div class="careerfy-table-cell">Job View</div>
										<div class="careerfy-table-cell">Applied</div>
									</div>
								</div>

							<div class="careerfy-table-layer careerfy-managejobs-tbody">

								@foreach($data['drafted'] as $drafted)
										<div class="careerfy-table-row">
										<div class="careerfy-table-cell">
												<p><a href="{{url('/jobs/'.\App\Employers::getUrl($drafted->employers_id).'/'.$drafted->seo_url)}}">{{$drafted->title}}</a></p>
											<span class=""><i class="fa fa-calendar-alt"></i> Created : {{$drafted->publish_date}}</span>
											<span class="lft15p"><i class="fa fa-calendar-alt"></i> Expired : {{$drafted->deadline}}</span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($drafted->id)}} Applications(s)
										</div>
										<div class="careerfy-table-cell">
											<span class="gold"><?php echo \App\JobType::getIcon($drafted->job_type);?></span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countView($drafted->id)}}</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($drafted->id)}}</div>
									</div>
									@endforeach
							</div>
							</div>
						</div>
						@else
						<div class="alert alert-info text-center all10p" role="alert">
						<span class="icon-circle-warning mr-2"></span>
						You don't have any Active jobs at the moment.
						<a  href="{{url('employer/newjob')}}">
							<strong>Post a Job, now!</strong></a>
						</div>
						@endif
					</div>
					<div class="tab-pane" id="archivejob" role="tabpanel" aria-labelledby="archive_job">
							@if(count($data['archive']) > 0)
						<div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Job Title</div>
										<div class="careerfy-table-cell">Positions</div>
										<div class="careerfy-table-cell">Job Type</div>
										<div class="careerfy-table-cell">Job View</div>
										<div class="careerfy-table-cell">Applied</div>
									</div>
								</div>

							<div class="careerfy-table-layer careerfy-managejobs-tbody">

								@foreach($data['archive'] as $archive)
										<div class="careerfy-table-row">
										<div class="careerfy-table-cell">
												<p><a href="#">{{$archive->title}}</a></p>
											<span class=""><i class="fa fa-calendar-alt"></i> Created : {{$archive->publish_date}}</span>
											<span class="lft15p"><i class="fa fa-calendar-alt"></i> Expired : {{$archive->deadline}}</span>
										</div>
										<div class="careerfy-table-cell"><a href="{{url('/employer/jobs/application/'.$archive->id)}}" class="careerfy-managejobs-appli">{{\App\Jobs::countApplication($archive->id)}} Application(s)</a>
										</div>
										<div class="careerfy-table-cell">
											<span class="gold"><?php echo \App\JobType::getIcon($archive->job_type);?></span>
										</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countView($archive->id)}}</div>
										<div class="careerfy-table-cell">{{\App\Jobs::countApplication($archive->id)}}</div>
									</div>
									@endforeach
							</div>
							</div>
						</div>
						@else
						<div class="alert alert-info text-center all10p" role="alert">
						<span class="icon-circle-warning mr-2"></span>
						You don't have any Active jobs at the moment.
						<a  href="{{url('employer/newjob')}}">
							<strong>Post a Job, now!</strong></a>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
			</div>
		</div>
	</div>
</div>
</div>


</div>

<div class="btm10m">
	<div class="row">
		<div class="col-md-12">
			<div class="common_bg">
				<div class="job_cat_title">
					<i class="fas fa-grip-vertical"></i> Job Seeker By Categories
				</div>
				<div class="seekerbycategory whitebg">
					<div class="row cm-row">
						@foreach($data['category'] as $category)
						<div class="col-md-4">
							<ul>
								<li>
							<a href="#">{{$category['title']}} <span class="greenclr">({{$category['total']}})</span> </a>
							</li>
							</ul>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(count($data['rm_approve']) > 0)
<div class="modal fade servicemodal" id="modal-approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title left">Approve/Disapprove Work Experience</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body">
       <div class="table-responsive-lg">
			<table class="table table-bordered table-hover table_form">
              <thead>
               	<th>Name</th>
                <th>Designation</th>
                <th>Job Level</th>
                <th>From</th>
                <th>To</th>
                <th>Action</th>
              </thead>
              <tbody>
              	 @foreach($data['rm_approve'] as $rm_approve)
              	 <tr>
              	 	<td>{{\App\Employees::getName($rm_approve->employees_id)}}</td>
              	 	<td>{{$rm_approve->designation}}</td>
                    <td>{{$rm_approve->level}}</td>
                    <td>{{$rm_approve->from}}</td>
                    <td>{{$rm_approve->to}}</td>
                    <td>
                        <button type="button" onclick="approve({{$rm_approve->id}});" data-toggle="tooltip" title="approve" class="btn whitegradient rt5m"><i class="fa fa-thums-up"></i> Approve</button>
                        <button type="button" onclick="disapprove({{$rm_approve->id}});" data-toggle="tooltip" title="Disapprove" class="btn whitegradient redclr"><i class="fa fa-thums-down"></i> Disapprove</button>
                        </td>
              	 </tr>
              	 @endforeach
              </tbody>
          </table>
        </div>
      </div>


  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="{{asset('/assets/chart.js/Chart.js')}}"></script>




<script type="text/javascript">
	$(function(){


	var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: 'Male/Female', a: '{{$data["total_male"]}}', b: '{{$data["total_female"]}}'},


      ],
      barColors: ['#5dc121', '#f36267'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Male', 'Female'],
      hideHover: 'auto'
    });

    var bar = new Morris.Bar({
      element: 'status-chart',
      resize: true,
      data: [
        {y: 'Single/Married/Divorced', a: '{{$data["total_single"]}}', b: '{{$data["total_married"]}}', c: '{{$data["total_divorced"]}}'},


      ],
      barColors: ['#900C3F', '#0000FF','#76448a '],
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Single', 'Married', 'Divorced'],
      hideHover: 'auto'
    });


    @if(count($data['daywise']) > 0)
     var line = new Morris.Line({
      element: 'line-chart',
      resize: true,

      data: [
      @foreach($data["daywise"] as $dy)

        {y: '{{$dy["title"]}}', item1: '{{$dy["total_visit"]}}', item2: '{{$dy["total_application"]}}'},

        @endforeach
      ],
      xkey: 'y',
      ykeys: ['item1', 'item2'],
      labels: ['Visitors', 'Applications'],
      lineColors: ['#E65A26','#3c8dbc'],
      axes: true,
      grid: true,
      hideHover: 'auto'
    });
     @endif





	});


</script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#modal-approve').modal('show');
	});

	function approve(id){
	    if(confirm('Are you sure you want to Approve this?')){
	        var url = '{{url("/employer/approve-experience?type=1")}}';
	        url += '&id='+id;

	        location = url;
	    }
	}
	function disapprove(id){
	    if(confirm('Are you sure you want to Disapprove this?')){
	        var url = '{{url("/employer/approve-experience?type=2")}}';
	        url += '&id='+id;

	        location = url;
	    }
	}

	function filterStatus()
{
    var url = '{{url('/employer?')}}'
    var from = $('#from').val();
    var to = $('#to').val();

    if(from != '' && to != '')
    {
        url += 'from='+from+'&to='+to;
    }
    location = url;
}
</script>
@endif

@stop
