<?php $__env->startSection('content'); ?>
<meta name="csrf_token" content="<?php echo e(csrf_token()); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-2.8.0.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/morris.js/morris.css')); ?>">
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
							<div class="col-md-1 col-2 profile_progress"></div>
							<div class="col-md-10 col-8">
								<div class="progress">
									<div class="progress-bar greenbar" role="progressbar" style="width:20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col-md-1 col-2 total_progress">100%</div>
						</div>
					</div>

			</div>

		</div>
	</div>
<div class= "tp10m">
<div class="row">
<div class="col-md-12 panel-heading">
    <div class="product-link btn-group ">
        <a href="<?php echo e(url('/employer')); ?>" class="btn app_active">Job</a>
        <a href="<?php echo e(url('/employer/dashboard/tender')); ?>" class="btn app_default">Tender</a>
         <a href="<?php echo e(url('/employer/dashboard/project')); ?>" class="btn app_default">Project</a>
        <a href="<?php echo e(url('/employer/dashboard/training')); ?>" class="btn app_default">Training</a>
        <a href="<?php echo e(url('/employer/dashboard/event')); ?>" class="btn app_default">Event</a>
        <a href="<?php echo e(url('/employer/dashboard/enroll')); ?>" class="btn app_default">Enroll</a>

    </div>

    <div id="job" class="careerfy-typo-wrap">
		<div class="careerfy-employer-dasboard btm10m">

			<div class="careerfy-employer-box-section whitebg">
			<div class="row cm10-row">
		<div class="col-md-1 col-3">
			<a href="<?php echo e(url('/employer')); ?>" class="btn btn-block">Recent</a>
		</div>
		<div class="col-md-1 col-3">
			<a href="<?php echo e(url('/employer?filter_stat=1')); ?>" class="btn btn-block ">Total</a>
		</div>
		<div class="col-md-6 col-12">
			<div class="row cm10-row search_form">
				<div class="form-group col-md-4">
					<input type="text" id="from" class="form-control datepicker" placeholder="2018-12-25" >
				</div>
				<div class="form-group col-md-4">
					<input type="text" id="to" class="form-control datepicker" placeholder="2018-12-25" >
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


	<div class="row cm10-row">
        
        <input type="hidden" id="company-channel" value="<?php echo e($data['channel']); ?>">
            <input type="hidden" id="pusher_key" value="<?php echo e(env('PUSHER_APP_KEY')); ?>">
			<div class="container-fluid p-0">
                <div class="col-md-2">
                    <button class="btn btn-raised btn-primary waves-effect waves-light" id="start_stream">Start Streaming</button>
                </div>
				<div id="main-container">
					<div id="screen-share-btn-container" class="col-2 float-right text-right mt-2">
						<button id="screen-share-btn"  type="button" class="btn btn-lg">
							<i id="screen-share-icon" class="fab fa-slideshare"></i>
						</button>
					</div>
					<div id="buttons-container" class="row justify-content-center mt-3">
						<div id="audio-controls" class="col-md-2 text-center btn-group">

							<button id="mic-btn" type="button" class="btn btn-block btn-dark btn-lg">
								<i id="mic-icon" class="fas fa-microphone"></i>
							</button>
							<button id="mic-dropdown" type="button" class="btn btn-lg btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div id="mic-list" class="dropdown-menu dropdown-menu-right">
								</div>
						</div>
						<div id="video-controls" class="col-md-2 text-center btn-group">
							<button id="video-btn"  type="button" class="btn btn-block btn-dark btn-lg">
								<i id="video-icon" class="fas fa-video"></i>
							</button>
							<button id="cam-dropdown" type="button" class="btn btn-lg btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div id="camera-list" class="dropdown-menu dropdown-menu-right">
							</div>
						</div>
						<div class="col-md-2 text-center">
							<button id="exit-btn"  type="button" class="btn btn-block btn-danger btn-lg">
								<i id="exit-icon" class="fas fa-phone-slash"></i>
							</button>
                        </div>

                    </div>

					<div id="lower-ui-bar" class="row fixed-bottom mb-1">
						<div id="rtmp-btn-container" class="col ml-3 mb-2">
							<button id="rtmp-config-btn"  type="button" class="btn btn-primary btn-lg row rtmp-btn" data-toggle="modal" data-target="#addRtmpConfigModal">
								<i id="rtmp-config-icon" class="fas fa-rotate-270 fa-sign-out-alt"></i>
							</button>
							<button id="add-rtmp-btn"  type="button" class="btn btn-secondary btn-lg row rtmp-btn" data-toggle="modal" data-target="#add-external-source-modal">
								<i id="add-rtmp-icon" class="fas fa-plug"></i>
							</button>
						</div>
						<div id="external-broadcasts-container" class="container col-flex">
							<div id="rtmp-controlers" class="col">
								<!-- insert rtmp  controls -->
							</div>
						</div>
					</div>
                </div>

                <div class="row" id="vido-viwer">
                    <div class="col-md-6">
                        <div id="full-screen-video"></div>
                    </div>
                    <div class="col-md-4">
                        <div id="viewers">
                            <h1>Viewers</h1>
                            <h1><i class="fa fa-eye" aria-hidden="true" style="color: rgb(165, 14, 14);"><input type="text" id="visitorCount" value="<?php echo e(0); ?>"> </i></h1>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" id="user_viewer_"></li>
                            </ul>

                        </div>

                    </div>
                </div>
				<!-- RTMP Config Modal -->
				<div class="modal fade slideInLeft animated" id="addRtmpConfigModal" tabindex="-1" role="dialog" aria-labelledby="rtmpConfigLabel" aria-hidden="true" data-keyboard=true>
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="rtmpConfigLabel"><i class="fas fa-sliders-h"></i></h5>
								<button type="button" class="close" data-dismiss="modal" data-reset="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form id="rtmp-config">
										<div class="form-group">
											<input id="rtmp-url" type="text" class="form-control" placeholder="URL *"/>
										</div>
										<div class="form-group">
												<label for="window-scale">Video Scale</label>
												<input id="window-scale-width" type="number" value="640" min="1" max="1000" step="1"/> (w)&nbsp;
												<input id="window-scale-height" type="number" value="360" min="1" max="1000" step="1"/> (h)
										</div>
										<div class="form-group row">
												<div class="col-flex">
													<label for="audio-bitrate">Audio Bitrate</label>
													<input id="audio-bitrate" type="number" value="48" min="1" max="128" step="2"/>
												</div>
												<div class="col-flex ml-3">
														<label for="video-bitrate">Video Bitrate</label>
														<input id="video-bitrate" type="number" value="400" min="1" max="1000000" step="2"/>
												</div>
										</div>
										<div class="form-group row">
											<div class="col-flex">
													<label for="framerate">Frame Rate</label>
													<input id="framerate" type="number" value="15" min="1" max="10000" step="1"/>
											</div>
											<div class="col-flex ml-3">
												<label for="video-gop">Video GOP</label>
												<input id="video-gop" type="number" value="30" min="1" max="10000" step="1"/>
											</div>
										</div>
										<div class="form-group">
												<label for="video-codec-profile">Video Codec Profile </label>
												<select id="video-codec-profile" class="form-control drop-mini">
													<option value="66">Baseline</option>
													<option value="77">Main</option>
													<option value="100" selected>High (default)</option>
												</select>
										</div>
										<div class="form-group">
												<label for="audio-channels">Audio Channels </label>
												<select id="audio-channels" class="form-control drop-mini">
													<option value="1" selected>Mono (default)</option>
													<option value="2">Dual sound channels</option>
													<option value="3" disabled>Three sound channels</option>
													<option value="4" disabled>Four sound channels</option>
													<option value="5" disabled>Five sound channels</option>
												</select>
										</div>
										<div class="form-group">
												<label for="audio-sample-rate">Audio Sample Rate </label>
												<select id="audio-sample-rate" class="form-control drop-mini">
													<option value="32000">32 kHz</option>
													<option value="44100" selected>44.1 kHz (default)</option>
													<option value="48000">48 kHz</option>
												</select>
										</div>
										<div class="form-group">
												<label for="background-color-picker">Background Color </label>
												<input id="background-color-picker" type="text" class="form-control drop-mini" placeholder="(optional)" value="0xFFFFFF" />
										</div>
										<div class="form-group">
												<label for="low-latancy">Low Latency </label>
												<select id="low-latancy" class="form-control drop-mini">
													<option value="true">Low latency with unassured quality</option>
													<option value="false" selected>High latency with assured quality (default)</option>
												</select>
										</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" id="start-RTMP-broadcast" class="btn btn-primary">
										<i class="fas fa-satellite-dish"></i>
								</button>
							</div>
						</div>
					</div>
				</div>
				<!-- end Modal -->
				<!-- External Injest Url Modal -->
				<div class="modal fade slideInLeft animated" id="add-external-source-modal" tabindex="-1" role="dialog" aria-labelledby="add-external-source-url-label" aria-hidden="true" data-keyboard=true>
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="add-external-source-url-label"><i class="fas fa-broadcast-tower"></i> [add external url]</i></h5>
									<button id="hide-external-url-modal" type="button" class="close" data-dismiss="modal" data-reset="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
										<form id="external-injest-config">
												<div class="form-group">
													<input id="external-url" type="text" class="form-control" placeholder="URL *"/>
												</div>
												<div class="form-group">
														<label for="external-window-scale">Video Scale</label>
														<input id="external-window-scale-width" type="number" value="640" min="1" max="1000" step="1"/> (w)&nbsp;
														<input id="external-window-scale-height" type="number" value="360" min="1" max="1000" step="1"/> (h)
												</div>
												<div class="form-group row">
														<div class="col-flex">
															<label for="external-audio-bitrate">Audio Bitrate</label>
															<input id="external-audio-bitrate" type="number" value="48" min="1" max="128" step="2"/>
														</div>
														<div class="col-flex ml-3">
																<label for="external-video-bitrate">Video Bitrate</label>
																<input id="external-video-bitrate" type="number" value="400" min="1" max="1000000" step="2"/>
														</div>
												</div>
												<div class="form-group row">
													<div class="col-flex">
															<label for="external-framerate">Frame Rate</label>
															<input id="external-framerate" type="number" value="15" min="1" max="10000" step="1"/>
													</div>
													<div class="col-flex ml-3">
														<label for="external-video-gop">Video GOP</label>
														<input id="external-video-gop" type="number" value="30" min="1" max="10000" step="1"/>
													</div>
												</div>
												<div class="form-group">
														<label for="external-audio-channels">Audio Channels </label>
														<select id="external-audio-channels" class="form-control drop-mini">
															<option value="1" selected>Mono (default)</option>
															<option value="2">Dual sound channels</option>
														</select>
												</div>
												<div class="form-group">
														<label for="external-audio-sample-rate">Audio Sample Rate </label>
														<select id="external-audio-sample-rate" class="form-control drop-mini">
															<option value="32000">32 kHz</option>
															<option value="44100" selected>44.1 kHz (default)</option>
															<option value="48000">48 kHz</option>
														</select>
												</div>
										</form>
								</div>
								<div class="modal-footer">
									<button type="button" id="add-external-stream" class="btn btn-primary">
											<i id="add-rtmp-icon" class="fas fa-plug"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<!-- end Modal -->
			</div>
		</div>
	</div>

			</div>
		</div>
	</div>
</div>
</div>
</div>



<script>
    $("#mic-btn").prop("disabled", true);
    $("#video-btn").prop("disabled", true);
    $("#screen-share-btn").prop("disabled", true);
    $("#exit-btn").prop("disabled", true);
    $("#add-rtmp-btn").prop("disabled", true);
</script>
<script src="<?php echo e(asset('js/agora/agora-broadcast.js')); ?>"></script>
<script src="<?php echo e(asset('js/agora/agora-screen-client.js')); ?>"></script>
<script src="<?php echo e(asset('js/agora/ui.js')); ?>"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="<?php echo e(asset('/assets/chart.js/Chart.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/live.blade.php ENDPATH**/ ?>