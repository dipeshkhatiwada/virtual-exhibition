<html lang="en">
  <head>
    <title>Enroll Live Stream</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


    <script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-2.8.0.js"></script>
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
      integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ"
      crossorigin="anonymous"
    />
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <style>

        body {
        margin: 0;
        padding: 0;
        background:#ffff;
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
        width: 50vw;
        }

        #buttons-container div {
        max-width: 150px;
        min-width: 100px;
        margin-bottom: 10px;
        }

        .btn-group button i {
        padding-left: 25px;
        }

        #full-screen-video {
            margin-top: 10%;
        position: absolute;
        width: 50vw;
        height: 50vh;
        box-shadow: 0 0 40px #04A;
        background-image: url('../images/rtc-logo.png');


        }

        #full-screen-video-iframe {
        position: absolute;
        width: 50vw;
        height: 50vh;
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
        width: 30%;
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
        .live-header{
            margin-bottom: -190px;
            color: red;
       }
    </style>
  </head>
  <body>
  <input type="text" id="join-channel" value="{{ $data['channel'] }}">
  <input type="hidden" id="pusher_key" value="{{env('PUSHER_APP_KEY')}}">

    <div class="container">
        <h2 align="center"><input type="text" id="viewerCount" style="align-items: center;" value="{{ 0 }}"></h2>
        <p align="center">person(s) currently viewing this page</p>
        <div class="live-header">
            <button class="btn btn-raised btn-primary waves-effect waves-light" id="leave-livestream-btn">Leave Live</button>
            <h3><strong>Live</strong></h3>
        </div>

        <div id="full-screen-video"></div>


        <div id="watch-live-overlay">
            <div id="overlay-container">
                <div class="col-md text-center">
                    <button
                    id="watch-live-btn"
                    type="button"
                    class="btn btn-block btn-primary btn-xlg"
                    >
                    <i id="watch-live-icon" class="fas fa-broadcast-tower"></i
                    ><span>Watch the Live Stream</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
  </body>
  <script src="{{asset('js/agora/agora-audience.js')}}" type="text/javascript"></script>
  </html>
