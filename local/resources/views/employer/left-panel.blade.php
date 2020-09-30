<div class="col-md-3 dashboard-left pr-0">
					<div class="card mb-3">
						<div class="card-block p-3">
							<div class="row">
								<div class="col-md-12 pb-3">


									<h4 class="text-primary m-0 mb-2" title="ShahiMart">{{$employer->name}}</h4>
								</div>
								<div class="col-md-12 pb-3">


									<img class="mr-1 mx-auto d-block img-thumbnail" src="{{asset('image/'.$employer->logo)}}" alt="client_image">
								</div>
								<div class="col-md-12 pb-3">


									<div class="rating" style="display:block">
       		
               <div class="star-ratings-sprite"><span style="width:{{\App\EmployerQuestionAnswer::getPercent()}}%" class="star-ratings-sprite-rating"></span></div>

               <div class="rating-detail">
                <div class="rating-list">
                  <div class="remove-btn pull-right">
                    <i class="fa fa-remove" style="margin: 0px;"></i>
                  </div>
                </div>
                 @php ($groups = \App\EmployerQuestionAnswer::getQustionGroup())
                 @foreach($groups as $group)
                 <div class="rating-list">
                  <div class="r-title pull-left">
                    {{$group['title']}}
                  </div>
                  <div class="rpercent pull-right">
                    {{$group['percent']}}%
                  </div>
                 </div>

                 @endforeach
               </div>
                        </div>
								</div>
								<div class="col-md-12 pl-1 mb-1">
									<div class="col-md-6 col-sm-6 col-xs-6"><button class="btn btn-warning">{{\App\MemberType::getTitle($employer->member_type)}}</button></div>
									@if($employer->member_type != 2)
									<div class="col-md-6 col-sm-6 col-xs-6"><a href="{{url('employer/upgrade/')}}" data-toggle="modal" data-target="#generic-modal-large-box" data-remote="{{url('employer/upgrade/')}}" class="btn btn-success float-right">
                    Upgrade</a></div>
									@endif
									
								</div>
								<div class="col-md-12">
									<table class="table table-no-border table-hover font-sm mb-0">
										<tbody><tr>
											<td width="5%" class="px-1 text-muted"><span class="icon-pin"></span></td>
											<td width="35%" class="px-1 text-muted">Address<span class="float-right">:</span></td>
											<td class="px-1">{{$address->address}}</td>
										</tr>
										<tr>
											<td class="px-1 text-muted"><span class="icon-time"></span></td>
											<td class="px-1 text-muted">Last Logged In<span class="float-right">:</span></td>
											<td class="px-1">

												<span class="font-sm">

													{{$employer->last_login}}

												</span>

											</td>
										</tr>
										
									</tbody></table>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<a href="{{url('employer/logout')}}" class="">
								<strong><span class="fa fa-power-off"></span>
									<span class="improve-profile">Logout</span>
								</strong>
							</a>
						</div>
					</div>

					<div class="card mt-3">
						<a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#jobs">
						<div class="card-header">
							<strong>Jobs</strong>
							
								<i class="fa fa-chevron-right pull-right"></i>
								<i class="fa fa-chevron-down pull-right"></i>
							

						</div>
						</a>
						<div id="jobs" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
							<ul>
								<li><a href="{{url('employer/newjob')}}"><i class="fa fa-briefcase"></i>Post New Job</a></li>
								<li><a href="{{url('employer/jobs')}}"><i class="fa fa-briefcase"></i>Manage Jobs</a></li>
							</ul>

						</div>


					</div>

					<div class="card mt-3">
            <a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#profile">
            <div class="card-header">
              
              <strong>My Profile</strong>
              
                <i class="fa fa-chevron-right pull-right"></i>
                <i class="fa fa-chevron-down pull-right"></i>
              

            </div>
            </a>
            <div id="profile" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
              <ul>
                <li><a href="{{url('employer/viewprofile')}}"><i class="fa fa-eye"></i>View Profile</a></li>
                <li><a href="{{url('employer/editprofile')}}"><i class="fa fa-pencil"></i>Edit Profile</a></li>
                <li><a href="{{url('employer/all')}}"><i class="fa fa-users"></i>List Employers</a></li>
                <li><a href="{{url('employer/changepassword')}}"><i class="fa fa-pencil"></i>Change Password</a></li>
                <li><a href="{{url('employer/deactivate')}}"><i class="fa fa-pencil"></i>Deactivate</a></li>
                <li><a href="{{url('employer/blogs')}}"><i class="fa fa-hand-o-right"></i>Blogs</a></li>

              </ul>

            </div>
            
            
          </div>

          <div class="card mt-3">
            <a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#message">
            <div class="card-header">
              
              <strong>My Message</strong>
              
                <i class="fa fa-chevron-right pull-right"></i>
                <i class="fa fa-chevron-down pull-right"></i>
              

            </div>
            </a>
            <div id="message" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
              <ul>
                 <li><a href="{{url('employer/messages')}}" class="inbox"><i class="fa fa-inbox"></i>Inbox<span>{{\App\InternalMessage::countEmployerUnreadMessage()}}</span></a></li>
                <li><a href="{{url('employer/messages/sent')}}"><i class="fa fa-envelope-o"></i>Sent</a></li>
                <li><a href="{{url('employer/messages/compose')}}"><i class="fa fa-file-text-o"></i>Compose</a></li>
              
              </ul>

            </div>
            
            
          </div>

					<div class="card mt-3">
						<a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#other-jobs">
						<div class="card-header">
							<strong>Other Jobs</strong>
							
								<i class="fa fa-chevron-right pull-right"></i>
								<i class="fa fa-chevron-down pull-right"></i>
							

						</div>
						</a>
						<div id="other-jobs" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
							<ul>
								<li><a href="{{url('employer/todayjobs')}}"><i class="fa fa-briefcase"></i>Todays Jobs</a></li>
								<li><a href="{{url('employer/thisweekjobs')}}"><i class="fa fa-briefcase"></i>Jobs This Weeks</a></li>
								<li><a href="{{url('employer/allactivejobs')}}"><i class="fa fa-briefcase"></i>All Active Jobs</a></li>
							</ul>

						</div>
						
						
					</div>
					<div class="card mt-3">
						<a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#left_employer">
						<div class="card-header">
							<strong>Empoloyer Panel</strong>
							
								<i class="fa fa-chevron-right pull-right"></i>
								<i class="fa fa-chevron-down pull-right"></i>
							

						</div>
						</a>
						<div id="left_employer" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
							<ul>
								<li><a href="{{url('employer/postedjobs')}}"><i class="fa fa-hand-o-right"></i>Posted Jobs</a></li>
								<li><a href="{{url('employer/draftedjobs')}}"><i class="fa fa-hand-o-right"></i>Drafted Jobs</a></li>
								<li><a href="{{url('employer/activejobs')}}"><i class="fa fa-hand-o-right"></i>Active Jobs</a></li>
								<li><a href="{{url('employer/pendingjobs')}}"><i class="fa fa-hand-o-right"></i>Pending Jobs</a></li>
								<li><a href="{{url('employer/expiredjobs')}}"><i class="fa fa-hand-o-right"></i>Expired Jobs</a></li>
							</ul>

						</div>
						
						
					</div>

					<div class="card mt-3">
						<a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#left_resume_bank">
						<div class="card-header">
							<strong>Resume Bank</strong>
							
								<i class="fa fa-chevron-right pull-right"></i>
								<i class="fa fa-chevron-down pull-right"></i>
							

						</div>
						</a>
						<div id="left_resume_bank" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
							<ul>
								<li><a href="{{url('employer/allapplicant')}}"><i class="fa fa-hand-o-right"></i>List All Applicant</a></li>
								<li><a href="{{url('employer/activeaccess')}}"><i class="fa fa-hand-o-right"></i>Active Access</a></li>
								<li><a href="{{url('employer/listresume')}}"><i class="fa fa-hand-o-right"></i>List Resume</a></li>
								<li><a href="{{url('employer/searchresume')}}"><i class="fa fa-hand-o-right"></i>Search Resume</a></li>
								<li><a href="{{url('employer/resumeondemand')}}"><i class="fa fa-hand-o-right"></i>Resume on Demand</a></li>
							</ul>

						</div>
						
						
					</div>

					<div class="card mt-3">
						<a data-toggle="collapse" class="collapse-button" aria-expanded="false" data-target="#communication">
						<div class="card-header">
							<strong>Communication</strong>
							
								<i class="fa fa-chevron-right pull-right"></i>
								<i class="fa fa-chevron-down pull-right"></i>
							

						</div>
						</a>
						<div id="communication" class="careerfy-employer-dashboard-nav pt-0 mb-0 collapse">
							<ul>
								<li><a href="{{url('employer/emailcvbank')}}">Emails by using cv Banks</a></li>
								<li><a href="{{url('employer/emailinvitation')}}">Emails by using Invitation</a></li>
								<li><a href="{{url('employer/emailcandidate')}}">Emails to applied canddates</a></li>
								<li><a href="{{url('employer/autoresponder')}}">Autoresponder Email</a></li>
							</ul>

						</div>
						
						
					</div>


					<div class="card mt-3">
						<div class="card-header">
							<strong>Service Package</strong>
						</div>
						<div class="card-block">
							@foreach($job_types as $jobtype)
							<?php $url = url('/employer/jobtype/'.$jobtype->id);?>
							<a href="{{url('employer/jobtype/'.$jobtype->id)}}" data-toggle="modal" data-target="#generic-modal-large-box" data-remote="{{$url}}" class="no-uline img-grey">
								<div class="card mb-2 border-0">
									<div class="card-block p-2">
										<div class="media">
											<div class="media-body mx-3 pt-3">

												<h6 class="">{{$jobtype->title}}</h6>
												
											</div>
											<div class="media-right">
												<span><img src="{{asset('image/'.$jobtype->icon)}}"></span>

											</div>
											
										</div>
									</div>
								</div>
							</a>
							<hr class="my-1">
							@endforeach
							
						</div>
					</div>


				</div>

				<script type="text/javascript">
    $(document).ready(function(){

    	$('.no-uline').click(function(){
    		var w = window.innerWidth;
            	
            	if (w < 992) {
    		$('.dashboard-left').css("height","auto");
            	$('.dashboard-left').animate({
	                left: "-400"
	            });
	            $('#background_overlally').remove();
	        }
    	});
      
        $("#left-bar").click(function(){
        	var h = window.innerHeight;
        	$('.dashboard-left').css("height",h);
        	$('body').append('<div id="background_overlally" style="position: fixed;   top: 0px; left: 0px; right: 0px; bottom:0px;width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5); z-index: 9999; display:inline-block;"></div>')
            $('.dashboard-left').animate({
                left: "0"
            });
            $('#background_overlally').on('click', function(){
            	$('.dashboard-left').css("height","auto");
            	$('.dashboard-left').animate({
	                left: "-400"
	            });
	            $(this).remove();
            });
            $(window).resize(function(){
            	var w = window.innerWidth;
            	
            	if (w > 992) {
            		$('.dashboard-left').css("height","auto");
            		$('#background_overlally').remove();
            		$('.dashboard-left').animate({
	                left: "0"
	            });
            	} else{
            		
            	$('.dashboard-left').animate({
	                left: "-400"
	            });
	            
            	}
				
			})
        });

        $(".rating").click(function(){


          $(".rating-detail").fadeToggle();
      }); 
    });
</script>