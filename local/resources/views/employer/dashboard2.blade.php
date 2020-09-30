

<div class="row mt-3">
	<div class="col-md-12">
		<div class="card">
			<div class="d-flex flex-row  ">




				<a class="no-uline p-2 mx-1 text-center nav-header-primary border-bottom-3-primary" href="https://merojob.com/employer/overview/">
					<span class="icon-home font-md mr-1"></span>
					<div class="font-sm hidden-xs-down">Overview</div>
				</a>

				<a class="no-uline p-2 mx-1 text-center nav-header-primary " href="https://merojob.com/employer/profile-detail/">
					<span class="icon-building font-md mr-1"></span>
					<div class="font-sm hidden-xs-down">Org. Profile</div>
				</a>

				<a class="no-uline p-2 mx-1 text-center nav-header-primary " href="https://merojob.com/employer/profile/basic-info/">
					<span class="icon-profile-edit font-md mr-1"></span>
					<div class="font-sm hidden-xs-down">Edit Profile</div>
				</a>

				<a class="no-uline p-2 mx-1 text-center nav-header-primary " href="https://merojob.com/manage/drafted/">
					<span class="icon-manage font-md mr-1"></span>
					<div class="font-sm hidden-xs-down">Manage</div>
				</a>



				<a class="no-uline p-2 mx-1 text-center nav-header-primary " href="https://merojob.com/employer/settings/privacy-setting/">
					<span class="icon-setting font-md mr-1"></span>
					<div class="font-sm hidden-xs-down">Settings</div>
				</a>




				<div class="p-3 text-center">
					<div class="float-right">



						<ul class="nav">
							<li class="nav-item dropdown dropdown-arrow">
								<a href="https://merojob.com/employer/overview/#" class="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<img class="mr-1" src="./Overview _ Employer _ merojob_files/x6bde606f47713804f2893baf2b3e873c.jpg.pagespeed.ic.9-JM4oYuWt.webp" alt=""><span class="dropdown-toggle"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right p-0">
									<div class="dropdown-item p-2">
										<div class="media">
											<div class="media-left">
												<div class="img-sm-round">


													<img class="mr-0 " src="./Overview _ Employer _ merojob_files/x0552376896f1c0bf9bd55d58eb121550.jpg.pagespeed.ic.9r_srsBhnX.webp" alt="">


												</div>
											</div>
											<div class="media-body ml-3">
												<div class="text-uppercase">Shahimart</div>
												<div class="text-muted mb-1">abhishekh@rollingplans.com.np</div>

												<div class="mt-2">
													<p class="text-muted font-sm mb-0">
														<span class="icon-time mr-1"></span>Last Logged In:
													</p>

													<span class="font-sm ml-3">

														an hour ago

													</span>

												</div>
											</div>
										</div>  
									</div>
									<div class="dropdown-divider"></div>
									<div class="pb-2">


										<a class="dropdown-item" href="https://merojob.com/employer/settings/change-password/"><span class="icon-profile-edit mr-2"></span> Change Password</a>


										<a class="dropdown-item" href="{{ url('employer/logout') }}">
											<span class="icon-logout mr-2"></span> Logout
										</a>
									</div>
								</div>
							</li>
						</ul>



					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row mt-3 " id="profile_complete_container">
	<div class="col-md-12">
		<div class="card">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-2 my-3 text-center">
						<h5 class="progressbar-data block-title text-success">29%</h5>
						<div class="progress progress-striped">
							<div class="progress-bar bg-danger" role="progressbar" data-transitiongoal="29.72972972972973" aria-valuenow="29" style="width: 29%;"></div>
						</div>
					</div>
					<div class="col-md-6 my-3">
						<div class="media">
							<div class="media-left mr-2">
								<span class="icon-building rm-2"></span> 
							</div>
							<div class="media-body">
								<h5 class="mb-1">Profile Completeness</h5>  
								<small id="profile-completion-message">
									Complete your profile to 100% to get more user interaction
								</small>
							</div>
						</div>
					</div>
					<div class="col-md-3 mt-4">
						<a href="https://merojob.com/employer/profile/basic-info/update/" class="float-right btn btn-outline-warning black">
							<strong>
								<span class="icon-user-warning mr-1"></span><span class="improve-profile">Improve Org. Profile</span>
							</strong>
						</a>
					</div>
					<div class="col-md-1">
						<span class="float-right mt-2">
							<a href="https://merojob.com/employer/overview/" data-toggle="collapse" data-target="
							#profile" id="hide_bttn" aria-expanded="true" title="Close">
							<span class="icon-circle-cancel"></span>
						</a>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="row mt-3 mb-3">
	<div class="col-md-8">

		<div class="card">
			<div class="card-header">
				<span class="icon-circle-check mr-2"></span><strong>Active Jobs</strong>
				<span class="font-xs">The list of jobs that you have posted and currently active.</span>

			</div>
			<div class="card-block">
				<div class="collapse" id="search_div">
					<input type="text" class="form-control" data-url="/manage/published/" name="search" id="search" placeholder="Search Job...">
				</div>
				@if($data['active']>0)
				<div class="table-hover table-no-border">
					<div class="text-center">
						<div class="alert alert-info" role="alert">

							<span class="icon-circle-warning mr-2"></span> You have {{count($data['active'])}} Active jobs.
							<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="#"
								<strong>View Jobs, now!</strong>
							</a>
						</div>
					</div><table class="table table-striped m-0">
					</table>
				</div>

				@else
				<div class="table-hover table-no-border">
					<div class="text-center">
						<div class="alert alert-info" role="alert">

							<span class="icon-circle-warning mr-2"></span> You have posted no jobs, yet!
							<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="#">
								<strong>Post a Job, now!</strong>
							</a>
						</div>
					</div><table class="table table-striped m-0">
					</table>
				</div>
				@endif
			</div>
		</div>


	<!-- 	<div class="card mt-3">
			<div class="card-header">

				<span class="icon-list mr-2"></span><strong>Drafted Jobs</strong>
				<span class="font-xs">The list of jobs you have drafted but not <strong>published</strong>.</span>


			</div>

			<div class="card-block">
				<div class="alert alert-info text-center">
					<span class="icon-circle-warning"></span>
					<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="https://merojob.com/employer/overview/#">
						<strong>Post a Job</strong></a> to get started!

					</div>
				</div>

			</div> -->

			<div class="row mt-3">

				<div class="col-md-12">
					<div class="card">
						<div class="card-header">


							<span class="icon-pending mr-2"></span><strong>Pending Jobs</strong>
							<span class="font-xs">The list of jobs that are complete and waiting for approval.</span>




						</div>
						<div class="card-block manage-jobs-list">

							<div class="alert alert-info text-center" role="alert">
								<span class="icon-circle-warning mr-2"></span>
								You don't have any Pending jobs at the moment.
								<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="https://merojob.com/employer/overview/#">
									<strong>Post a Job, now!</strong></a>
								</div>


							</div>
						</div>
					</div>
				</div>





				<div class="row mt-3">
@if($data['completed']>0)
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">


								<span class="icon-circle-warning mr-2"></span><strong>Expired Jobs</strong>
								<span class="font-xs">The list of past jobs that are already expired on deadline and are inactive.</span>




							</div>
							<div class="card-block manage-jobs-list">

								<div class="alert alert-info text-center" role="alert">
									<span class="icon-circle-warning mr-2"></span>
									You have {{count($data['completed'])}} expired jobs at the moment.
									<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="#">
										<strong>View expired jobs, now!</strong></a>
									</div>


								</div>
							</div>
						</div>


						@else

						<div class="col-md-12">
						<div class="card">
							<div class="card-header">


								<span class="icon-circle-warning mr-2"></span><strong>Expired Jobs</strong>
								<span class="font-xs">The list of past jobs that are already expired on deadline and are inactive.</span>




							</div>
							<div class="card-block manage-jobs-list">

								<div class="alert alert-info text-center" role="alert">
									<span class="icon-circle-warning mr-2"></span>
									You don't have any Expired jobs at the moment.
									<a data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal" href="https://merojob.com/employer/overview/#">
										<strong>Post a Job, now!</strong></a>
									</div>


								</div>
							</div>
						</div>


@endif
					</div>






					<div class="card mt-3">
						<div class="card-header">
							<span class="icon-user mr-2"></span>
							<strong>Jobseeker by Categories </strong>
						</div>
						<div class="card-block">
							<div class="row">

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Accounting / Finance">
										Accounting / Finance (47801)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Architecture / Interior Designing">
										Architecture / Interio... (2247)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Banking / Insurance /Financial Services">
										Banking / Insurance /F... (122812)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Construction / Engineering / Architects">
										Construction / Enginee... (20418)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Commercial / Logistics / Supply Chain">
										Commercial / Logistics... (3745)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Creative / Graphics / Designing">
										Creative / Graphics / ... (4412)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Fashion / Textile Designing">
										Fashion / Textile Desi... (1534)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="General Mgmt. / Administration / Operations">
										General Mgmt. / Admini... (11158)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Healthcare / Pharma / Biotech / Medical / R&amp;D">
										Healthcare / Pharma / ... (8988)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Human Resource /Org. Development">
										Human Resource /Org. D... (5239)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="IT &amp; Telecommunication">
										IT &amp; Telecommunication (32605)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Journalism / Editor / Media">
										Journalism / Editor / ... (3021)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Legal Services">
										Legal Services (981)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Marketing / Advertising / Customer Service">
										Marketing / Advertisin... (14543)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Production / Maintenance / Quality">
										Production / Maintenan... (3221)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Protective / Security Services">
										Protective / Security ... (399)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Research and Development">
										Research and Development (3289)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Sales / Public Relations">
										Sales / Public Relations (8341)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Secretarial / Front Office / Data Entry">
										Secretarial / Front Of... (6856)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Teaching / Education">
										Teaching / Education (11612)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="NGO / INGO / Social work">
										NGO / INGO / Social work (48017)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Others">
										Others (11447)
									</div>
								</div>

								<div class="col-md-4 text-muted font-sm py-2">
									<div title="" data-toggle="tooltip" data-animation="false" data-original-title="Hospitality">
										Hospitality (9916)
									</div>
								</div>

							</div>
						</div>

					</div>

				</div>
				<div class="col-md-4 pl-0">
					<div class="card mb-3">
						<div class="card-block p-3">
							<div class="row">
								<div class="col-md-3 pr-2 pb-3">


									<img class="mr-1 mx-auto d-block img-thumbnail" src="{{asset('image/'.$data['employer']->logo)}}" alt="client_image">
								</div>
								<div class="col-md-9 pl-1 mb-1">
									<h4 class="text-primary m-0 mb-2" title="ShahiMart">{{$data['employer']->name}}</h4>
									<div class="font-sm mb-1 text-muted">{{$data['employer']->description}}</div>
								</div>
								<div class="col-md-12">
									<table class="table table-no-border table-hover font-sm mb-0">
										<tbody><tr>
											<td width="5%" class="px-1 text-muted"><span class="icon-pin"></span></td>
											<td width="35%" class="px-1 text-muted">Address<span class="float-right">:</span></td>
											<td class="px-1">Imadole, Imadole</td>
										</tr>
										<tr>
											<td class="px-1 text-muted"><span class="icon-time"></span></td>
											<td class="px-1 text-muted">Last Logged In<span class="float-right">:</span></td>
											<td class="px-1">

												<span class="font-sm">

													an hour ago

												</span>

											</td>
										</tr>
										<tr id="progress-card" class=" hidden-xs-up " style="display: none;">
											<td class="px-1 text-muted"><span class="icon-user-warning rm-2"></span></td>
											<td class="px-1 text-muted text-xs">Profile Completion<span class="float-right">:</span></td>
											<td class="px-1">
												<div class="font-sm text-muted">
													<div class="progress progress-striped">
														<div class="progress-bar bg-danger" role="progressbar" data-transitiongoal="29.72972972972973" aria-valuenow="29" style="width: 29%;">
															<span class="progressbar-data block-title">29%</span>
														</div>
													</div>
												</div>
											</td>
										</tr>
									</tbody></table>
								</div>
							</div>
						</div>
						<div class="card-footer text-center">
							<a href="https://merojob.com/employer/profile/basic-info/update/" class="">
								<strong><span class="icon-user-warning mr-2"></span>
									<span class="improve-profile">Improve Organisation Profile</span>
								</strong>
							</a>
						</div>
					</div>

					<div class="card">
						<div class="card-block text-center">
							<a class="btn btn-warning" href="https://merojob.com/employer/overview/#" data-remote="/post/" data-target="#generic-modal-box" data-toggle="modal">
								<span class="icon-circle-add mr-2"></span>Post a Job
							</a>
							<div class="py-2">For support, Client Relation Executive</div>





							<div class="border-1 p-2">
								<div class="right-sidebar">

									<div class="media">


										<img class="d-flex mr-3 img-grey" src="./Overview _ Employer _ merojob_files/xd180443222719f77bba1f1e12b799ca4.jpg.pagespeed.ic.7ZpjL-kn5w.webp" alt="Client relation manager">


										<div class="media-body" align="left">
											<h5 class="my-0 font-sm font-weight-bold">Aakriti Acharya</h5>
											<span class="font-xs">Client Relation Executive</span><br>
											<a href="mailto:aakriti.acharya@merojob.com" class="font-xs">aakriti.acharya@merojob.com</a><br>
											<span class="font-xs">9801078440</span>
										</div>
									</div>

								</div>
							</div>



						</div>
					</div>



					<div class="card mt-3">
						<div class="card-header">
							<strong>Job Posting Options</strong>
						</div>
						<div class="card-block">
							<a href="https://merojob.com/employer/overview/" data-toggle="modal" data-target="#generic-modal-large-box" data-remote="/top-job/?modal=True" class="no-uline img-grey">
								<div class="card mb-2 border-0">
									<div class="card-block p-2">
										<div class="media">
											<div class="media-left">
												<span class="icon-top-job icon-2x text-success"></span>
											</div>
											<div class="media-body mx-3">
												<h6 class="">Top Jobs Service</h6>
												<p class="mb-0 font-sm">Be Unique. Be on TOP</p>
											</div>
										</div>
									</div>
								</div>
							</a>
							<hr class="my-1">
							<a href="https://merojob.com/employer/overview/" data-toggle="modal" data-target="#generic-modal-large-box" data-remote="/hot-job/?modal=True" class="no-uline img-grey">
								<div class="card mb-2 border-0">
									<div class="card-block p-2">
										<div class="media">
											<div class="media-left">
												<span class="icon-hot-job icon-2x text-danger"></span>
											</div>
											<div class="media-body mx-3">
												<h6>Hot Jobs Service</h6>
												<p class="mb-0 font-sm">Be Visible. Get MORE</p>
											</div>
										</div>
									</div>
								</div>
							</a>
							<hr class="my-1">
							<a href="https://merojob.com/employer/overview/" data-toggle="modal" data-target="#generic-modal-large-box" data-remote="/featured-job/?modal=True" class="no-uline img-grey">
								<div class="card mb-2 border-0">
									<div class="card-block p-2">
										<div class="media">
											<div class="media-left">
												<span class="icon-feature-job icon-2x text-warning"></span>
											</div>
											<div class="media-body mx-3">
												<h6>Feature Jobs Service</h6>
												<p class="mb-0 font-sm">Be Seen. Pay LESS</p>
											</div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>


				</div>
			</div>
			<div class="row my-3 pl-3">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<strong>HR INSIDER</strong>
							<span class="font-xs">Learn the latest trend, news, articles and advice on HR relevant to Nepal.</span>
						</div>
						<div class="card-block">
							<div class="row">

								<div class="col-md-3">
									<a href="https://merojob.com/jobkurakani/post/detail/hr-department-a-business-partner-to-the-organization/">
										<img src="./Overview _ Employer _ merojob_files/xd236e168a17593cfdbbe2b36312230224aa6b233.jpg.pagespeed.ic.Cz30MYeeY9.webp" class="img-fluid img-grey img-responsive border-1 p-1" alt="HR Department – A Business Partner to the Organization">
										<h5 class="font-md-xxs mt-2">
											HR Department – A Business Partner to the Organ...
										</h5>
									</a>
								</div>

								<div class="col-md-3">
									<a href="https://merojob.com/jobkurakani/post/detail/recruiting-brain-re-drains-in-nepal/">
										<img src="./Overview _ Employer _ merojob_files/xac54a84ead145bae6e0fa7e2d3ed8436d486a716_py7jAeh.jpg.pagespeed.ic.SIq3By4Axo.webp" class="img-fluid img-grey img-responsive border-1 p-1" alt="Recruiting Brain Re-Drains in Nepal">
										<h5 class="font-md-xxs mt-2">
											Recruiting Brain Re-Drains in Nepal
										</h5>
									</a>
								</div>

								<div class="col-md-3">
									<a href="https://merojob.com/jobkurakani/post/detail/success-mantra-for-hiring-managing-interns/">
										<img src="./Overview _ Employer _ merojob_files/x11fa09f7bcfc08298dbbf3ff70038c64c51232bd_mZIm1yL.jpg.pagespeed.ic.5f6dANLMBL.webp" class="img-fluid img-grey img-responsive border-1 p-1" alt="Success Mantra for Hiring &amp; Managing Interns">
										<h5 class="font-md-xxs mt-2">
											Success Mantra for Hiring &amp; Managing Interns
										</h5>
									</a>
								</div>

								<div class="col-md-3">
									<a href="https://merojob.com/jobkurakani/post/detail/employee-exit-program-more-than-just-exit-interview/">
										<img src="./Overview _ Employer _ merojob_files/x316fc93c2e45603217a21b5d474236a4b860f7f9_EL3FaRc.jpg.pagespeed.ic.xMtJrJmT8m.webp" class="img-fluid img-grey img-responsive border-1 p-1" alt="Employee Exit Program: More than Just Exit Interview">
										<h5 class="font-md-xxs mt-2">
											Employee Exit Program: More than Just Exit Inte...
										</h5>
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="PopUpModal" tabindex="-1" role="dialog" aria-labelledby="PopUpModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<img src="./Overview _ Employer _ merojob_files/anniversary-offer-2017.jpg" alt="logo" width="100%">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


