
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
							<div class="col-md-1 col-2 profile_progress">{{$datas['profile_complete']}}%</div>
							<div class="col-md-10 col-8">
								<div class="progress">
									<div class="progress-bar greenbar" role="progressbar" style="width: {{$datas['profile_complete']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-md-1 col-2 total_progress">100%</div>
						</div>
					</div>
					@if($datas['profile_complete'] < 100)
					<div class="center">
						<p>Complete your profile to 100% to get more user interaction</p>
					</div>
					@endif

			</div>
			@if($datas['profile_complete'] < 100)
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
        <a href="{{url('/employer/dashboard/project')}}" class="btn app_default">Freelance</a>
        <a href="{{url('/employer/dashboard/event')}}" class="btn app_default">Event</a>
        <a href="{{url('/employer/dashboard/enroll')}}" class="btn app_default">Enroll</a>
        <a href="{{url('/employer/dashboard/counselor')}}" class="btn app_default">Counseling</a>
        <a href="{{url('/employer/dashboard/cat')}}" class="btn app_default">CAT</a>
        <a href="{{url('/employer/dashboard/classroom')}}" class="btn app_default">Classroom</a>
        <a href="{{url('/employer/dashboard/contest')}}" class="btn app_default">Contest</a>
    </div>

	<div class="row tp10p cm10-row">
		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
			<!-- small box -->
			<div class="small-box bluegradient">
				<div class="inner">
				<h3>{{ count($datas['enroll']) }}</h3>
				<p>Reservation</p>
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
				<h3>{{$datas['participator']}}</h3>
				<p>Participators</p>
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
				<h3>{{$datas['total_booth']}}</h3>
				<p>Total Booth/Stall</p>
				</div>
				<div class="icon">
				<i class="ion ion-person-add"></i>
				</div>
				<a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
        </div>

        <div class="col-lg-2 col-md-2 col-xs-6 col-4">
            <!-- small box -->
              <div class="small-box purplegradient">
                  <div class="inner">
                  <h3>Rs. {{$datas['amount']}}</h3>
                  <p>Total Amount</p>
                  </div>
                  <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{url('/employer/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>

		<div class="col-lg-2 col-md-2 col-xs-6 col-4">
          <!-- small box -->
			<div class="small-box grengradient">
				<div class="inner">
				<h3>{{ $datas['pending'] }}</h3>
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
			<div class="chart" id="status-chart" style="height: 110px;" ></div>
			</div>
		</div>
	</div>

	<div class="row tp10m">
		<div class="col-md-12">
			<div class="dash_com_block">
				<ul class="nav nav-tabs dash_tab" id="myTab" role="tablist">
					<li class="nav-item tablink">
						<a class="nav-link active" id="active_enroll" data-toggle="tab" href="#activeenroll" role="tab" aria-controls="activeenroll" aria-selected="true">Active Exhibition</a>
					</li>
					<li class="nav-item tablink">
						<a class="nav-link" id="pending_enroll" data-toggle="tab" href="#pendingenroll" role="tab" aria-controls="pendingenroll" aria-selected="false">Pending Exhibition</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content businesstab flex">
					<div class="tab-pane active" id="activeenroll" role="tabpanel" aria-labelledby="active_enroll">
                        @if(count($datas['active']) > 0)
                        <div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">

									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Company Name</div>
										<div class="careerfy-table-cell">Category</div>
										<div class="careerfy-table-cell">Booth/Stall</div>
										<div class="careerfy-table-cell">Total Price</div>
										<div class="careerfy-table-cell">Action</div>
									</div>
								</div>

								<div class="careerfy-table-layer careerfy-managejobs-tbody">
									@foreach($datas['active'] as $active)
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">{{ $active->company_name }}</div>
										<div class="careerfy-table-cell">{{ $active->category->title }}</div>
										<div class="careerfy-table-cell">
                                            @foreach ($active['boothreserves'] as $stall)
                                                <table>
                                                    <tr>
                                                    <td>
                                                        {{ $stall->booth_name }} | {{ $stall->booth_type }} | {{ $stall->price }}
                                                    </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </div>
										<div class="careerfy-table-cell">  Rs. {{ $active->total_price }} </div>
										<div class="careerfy-table-cell">

                                            <a href="{{ url('employer/enroll/livestream/'.$active->seo_url) }}" class="btn btn-primary">Go for Livestrem</a>
                                            {{-- <a href="{{ url('employer/enroll/zoom-livestream/'.$active->seo_url) }}" class="btn btn-primary">Go for Livestrem</a> --}}
                                            {{-- <a href="{{ url('employer/enroll/zoom-videocall/'.$active->seo_url) }}" class="btn btn-success">zoom call</a> --}}
                                            <a href="{{ url('employer/enroll/video-call/'.$active->seo_url) }}" class="btn btn-success">Video call</a>
										</div>
									</div>
									@endforeach
								</div>
							</div>
                        </div>
                        @else
                            <div class="alert alert-info text-center all10p" role="alert">
                                <span class="icon-circle-warning mr-2"></span>
                                You don't have any Active Exhibition at the moment.
                                <a href="{{url('employer/enroll')}}">
                                    <strong>Get a Stall, now!</strong></a>
                            </div>
                        @endif
					</div>
					<div class="tab-pane" id="pendingenroll" role="tabpanel" aria-labelledby="pending_enroll">
                        @if(count($datas['inactive']) > 0)
                        <div class="careerfy-managejobs-list-wrap">
							<div class="careerfy-managejobs-list">
								<!-- Manage Jobs Header -->
								<div class="careerfy-table-layer careerfy-managejobs-thead">
									<div class="careerfy-table-row">
										<div class="careerfy-table-cell">Company Name</div>
										<div class="careerfy-table-cell">Category</div>
                                        <div class="careerfy-table-cell">Booth/Stall</div>
                                        <div class="careerfy-table-cell">Pending Payment</div>
										<div class="careerfy-table-cell">Total Price</div>
									</div>
								</div>
							    <div class="careerfy-table-layer careerfy-managejobs-tbody">
                                     @foreach($datas['inactive'] as $inactive)
                                     <div class="careerfy-table-row">
										<div class="careerfy-table-cell">{{ $inactive->company_name }}</div>
										<div class="careerfy-table-cell">{{ $inactive->category->title }}</div>
										<div class="careerfy-table-cell">
                                            @foreach ($inactive['boothreserves'] as $stall)
                                                <table>
                                                    <tr>
                                                    <td>
                                                        {{ $stall->booth_name }} | {{ $stall->booth_type }} | {{ $stall->price }}
                                                    </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </div>
                                        <div class="careerfy-table-cell">
                                            @foreach ($inactive['boothreserves'] as $stall)
                                                <table>
                                                    <tr>
                                                    <td>
                                                        @if($stall->status == 0)
                                                            {{ $stall->booth_name }} | {{ $stall->booth_type }} | {{ $stall->price }}
                                                        @endif
                                                    </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        </div>
										<div class="careerfy-table-cell">  Rs. {{ $inactive->total_price }} </div>
                                    @endforeach
							    </div>
                            </div>
                        </div>
                        @else

                            <div class="alert alert-info text-center all10p" role="alert">
                            <span class="icon-circle-warning mr-2"></span>
                            You don't have any reserved Exhibtion at the moment.
                            <a  href="{{url('employer/enroll')}}">
                                <strong>Get a Booth/Stall, now!</strong></a>
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
</div>
<!-- /.modal-dialog -->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="{{asset('/assets/chart.js/Chart.js')}}"></script>
@stop
