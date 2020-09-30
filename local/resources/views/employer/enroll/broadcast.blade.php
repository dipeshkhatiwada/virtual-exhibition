<html lang="en">
    <head>
		<title>Live Stream</title>
        <meta charset="utf-8">
        <meta name="csrf_token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-2.8.0.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <style>
            #visitorCount{
                border:none;
                background: #F5F5F5;
                width: 40px;
            }
            #vido-viwer{
                margin-top: 110px;
            }
            #viewers{
                margin-left: 80px;

            }

            #viewers, .list-group list-group-flush{
                float: left;
                height: 300px;
                width: 500px;
                background: #F5F5F5;
                overflow-y: scroll;
                cursor: pointer;
            }
            #viwer_box_, .list-group-item{
                margin-left: 10px;
            }
            body {
                margin: 0;
                padding: 0;
                background-image: url('../images/rtc-logo.png');
                background-repeat: no-repeat;
                background-size: contain;
                background-position: center;
                }

            body .btn:focus{
                outline: none !important;
                box-shadow:none !important;
                }

            #buttons-container {
                position: absolute;
                z-index: 2;
                width: 100vw;
                }

            #buttons-container div {
                max-width: 250px;
                min-width: 150px;
                margin-bottom: 10px;
                }

            .btn-group button i {
                padding-left: 25px;
                }

            #full-screen-video {
                position: absolute;
                /* margin-top: 95px; */
                width: 100%;
                height: 100%;
                margin-left: 5%;
                }

            #full-screen-video-iframe {
                position: absolute;
                width: 100vw;
                height: 100vh;
                background-image: url('../images/AllThingsRTC_live-bg.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                }

            #lower-ui-bar {
                /* min-height: 50vh;
                max-width: 100vw; */
                }

            #rtmp-btn-container {
                position: relative;
                display: inline-block;
                margin-top: auto;
                z-index: 99;
                }

            .rtmp-btn {
                bottom: 5vh;
                right: 5vw;
                display: block;
                margin: 0 0 5px 0;
                }

            #add-rtmp-btn {
                padding: 0.5rem 1.15rem;
                }

            .remote-stream-container {
                display: inline-block;
                }

            #rtmp-controlers {
                height: 100%;
                margin: 0;
                }

            #local-video {
                position: absolute;
                z-index: 1;
                height: 20vh;
                max-width: 100%;
                }

            .remote-video {
                position: absolute;
                z-index: 1;
                height: 100% !important;
                width: 80%;
                max-width: 500px;
                }

            #mute-overlay {
                position: absolute;
                z-index: 2;
                bottom: 0;
                left: 0;
                color: #d9d9d9;
                font-size: 2em;
                padding: 0 0 3px 3px;
                display: none;
                }

            .mute-overlay {
                position: absolute;
                z-index: 2;
                top: 2px;
                color: #d9d9d9;
                font-size: 1.5em;
                padding: 2px 0 0 2px;
                display: none;
                }

            #no-local-video, .no-video-overlay {
                position: absolute;
                z-index: 3;
                width: 100%;
                top: 40%;
                color: #cccccc;
                font-size: 2.5em;
                margin: 0 auto;
                display: none;
                }

            .no-video-overlay {
                width: 80%;
                }

            #screen-share-btn-container {
                z-index: 99;
                }

            #watch-live-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                text-align: center;
                background-image: url('../images/AllThingsRTC_live-bg.jpg');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                }

            #external-broadcasts-container {
                max-width: 70%;
                margin: auto 0 5px;
                }

            #external-broadcasts-container input {
                width: 50%;
                }

            #external-broadcasts-container button {
                color: #fff;
                }

                /* #external-broadcasts-container .close-btn {
                padding-bottom: 1.2rem;
                } */

            #watch-live-overlay #overlay-container {
                padding: 25px;
                border-radius: 5px;
                position:relative;
                margin: 0 auto;
                top: 65%;
                width: 70%;
                }

            #watch-live-overlay button {
                display: block;
                /* margin: -50px auto; */
                color: #0096e6;
                background: #fff;
                }

            #watch-live-overlay img {
                height: auto;
                width: 100%;
                object-fit: cover;
                object-position: center;
                }

            #watch-live-overlay button i {
                padding: 0 10px;
                }

            .btn-xlg {
                padding: 20px 35px;
                font-size: 30px;
                line-height: normal;
                -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                        border-radius: 8px;
                }

            .drop-mini {
                width: inherit;
                display: inline-block;
                }

            #external-injest-config label, #rtmp-config label {
                margin: 0 .5rem .5rem 0;
                }

            #external-injest-config .row,#rtmp-config .row {
                margin-left: inherit;
                margin-right: inherit;
                }


            #addRtmpConfigModal .modal-header,
                #external-injest-config .modal-header {
                padding: 0.5rem 1rem 0;
                border-bottom: none;
                }

            #addRtmpConfigModal .modal-header .close,
                #external-injest-config .modal-header .close {
                padding: 0.5rem;
                margin: -.025rem;
                }

            #addRtmpConfigModal .modal-body,
                #external-injest-config .modal-body {
                padding: 1rem 1rem 0.25rem;
                }

            #addRtmpConfigModal .modal-footer,
                #external-injest-config .modal-footer {
                padding: 0 1rem 0.5rem;
                border-top: none;
                }

            #pushToRtmpBtn {
                padding: 10px 15px;
                }

            .close .fa-xs {
                font-size: .65em;
                }

                /* pulsating broadcast button */
            .pulse-container {
                height: 100%;
                margin: 5px 10px 0;
                }

            .pulse-button {
                position: relative;
                /* width: 32px; */
                /* height: 32px; */
                border: none;
                box-shadow: 0 0 0 0 rgba(232, 76, 61, 0.7);
                /* border-radius: 50%; */
                background-color: #e84c3d;
                background-size:cover;
                background-repeat: no-repeat;
                cursor: pointer;
                }

            .pulse-anim {
                -webkit-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
                -moz-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
                -ms-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
                animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
                }

            @-webkit-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
            @-moz-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
            @-ms-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
            @keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}

                /* Respomnsive design */

            @media only screen and (max-width: 795px) {
                #watch-live-overlay #overlay-container {
                    width: 100%;
                }
                }

            @media only screen and (max-height: 350px) {
                    #watch-live-overlay img {
                        height: auto;
                        width: 80%;
                    }
            #watch-live-overlay #overlay-container {
                    top: 60%;
                }
                .btn-xlg {
                        font-size: 1rem;
                    }
                }

            @media only screen and (max-height: 400px){
                .btn-xlg {
                    font-size: 1.25rem;
                }
                }

            @media only screen and (max-width: 400px) {
                .btn-xlg {
                    padding: 10px 17px;
                }
            }

        </style>
    </head>
    <body>
            <input type="hidden" id="company-channel" value="{{ $data['channel'] }}">
            <input type="hidden" id="pusher_key" value="6e2167f314296786dc0a">
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
                            <h1><i class="fa fa-eye" aria-hidden="true" style="color: rgb(165, 14, 14);"><input type="text" id="visitorCount" value="{{ 0 }}"> </i></h1>

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
	</body>
	<script>
		$("#mic-btn").prop("disabled", true);
		$("#video-btn").prop("disabled", true);
		$("#screen-share-btn").prop("disabled", true);
		$("#exit-btn").prop("disabled", true);
		$("#add-rtmp-btn").prop("disabled", true);
    </script>
	<script src="{{asset('js/agora/agora-broadcast.js')}}"></script>
	<script src="{{asset('js/agora/agora-screen-client.js')}}"></script>
	<script src="{{asset('js/agora/ui.js')}}"></script>
</html>
