<html lang="en">
	<head>
		<title>Enroll | Video Chat</title>
        <meta charset="utf-8">
        <meta name="csrf_token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{asset('js/agora/style.css')}}"/>

	</head>
	<body>
		<div class="container-fluid p-0">
			<div id="main-container">
				<div id="screen-share-btn-container" class="col-2 float-right text-right mt-2">
					<button id="screen-share-btn"  type="button" class="btn btn-lg">
						<i id="screen-share-icon" class="fas fa-share-square"></i>
					</button>
				</div>
				<div id="buttons-container" class="row justify-content-center mt-3">
					<div class="col-md-2 text-center">
						<button id="mic-btn" type="button" class="btn btn-block btn-dark btn-lg">
							<i id="mic-icon" class="fas fa-microphone"></i>
						</button>
					</div>
					<div class="col-md-2 text-center">
						<button id="video-btn"  type="button" class="btn btn-block btn-dark btn-lg">
							<i id="video-icon" class="fas fa-video"></i>
						</button>
					</div>
					<div class="col-md-2 text-center">
						<button id="finish-call-by-buser" type="button" class="btn btn-block btn-danger btn-lg">
							Finish Call
						</button>
					</div>
				</div>
				<div id="full-screen-video"></div>
				<div id="lower-video-bar" class="row fixed-bottom mb-1">
					<div id="remote-streams-container" class="container col-9 ml-1">
						<div id="remote-streams" class="row">
							<!-- insert remote streams dynamically -->
						</div>
					</div>
					<div id="local-stream-container" class="col p-0">
						<div id="mute-overlay" class="col">
							<i id="mic-icon" class="fas fa-microphone-slash"></i>
						</div>
						<div id="no-local-video" class="col text-center">
							<i id="user-icon" class="fas fa-user"></i>
						</div>
						<div id="local-video" class="col p-0"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modalForm">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h4 class="modal-title w-100 font-weight-bold">Create Channel</h4>
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>
					</div>
					<div class="modal-body mx-3">
						<div class="md-form mb-5">
							<input type="hidden" id="form-appid" class="form-control" value="4fdfd402ce0a45ea94d850f2124f0b36">
                            <input type="hidden" id="reservation" class="form-control" value="{{ $datas['enroll']->id }}" disabled>
                            <input type="hidden" id="pusher_key" value="{{'6e2167f314296786dc0a'}}">

                        </div>

						<div class="md-form mb-4">
                        <input type="text" id="form-channel" class="form-control" value="{{ $datas['set_channel'] }}-videocall" disabled>

                    </div>

					</div>
					<div class="modal-footer d-flex justify-content-center">
						<button id="create-channel" class="btn btn-default">Create Channel</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="{{asset('js/agora/AgoraRTCSDK-3.1.1.js')}}"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$("#mic-btn").prop("disabled", true);
		$("#video-btn").prop("disabled", true);
		$("#screen-share-btn").prop("disabled", true);
		$("#exit-btn").prop("disabled", true);

		$(document).ready(function(){
			$("#modalForm").modal("show");
		});
	</script>
	<script src="{{asset('js/agora/ui.js')}}"></script>
    <script src="{{asset('js/agora/agora-interface.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

</html>
