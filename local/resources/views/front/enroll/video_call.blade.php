@extends('front.enroll-master')
@section('header')
<style>
    #scrollvideo{
               height: 365px;
               width: 150px;
               background: #F5F5F5;
               overflow-y: scroll;
               margin-left: 30px;
           }
    #scrollImg img{
        width: 120px;
        height: 80px;
        object-fit: contain;
    }

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
    }
    body {
        margin: 0;
        padding: 0;
        /* background-image: url('../images/rtc-logo.png'); */
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        }

    body .btn:focus{
        outline: none !important;
        box-shadow:none !important;
        }

        /* #leave-livestream-btn{
            display: block;
            align-items: center;
            margin-left: 55px;
        } */
    #buttons-container {
        position: absolute;
        z-index: 2;
        width: 100vw;
        margin-left: -67%;

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
        position: relative;
        width: 700px;
        height: 500px;
        margin-bottom: 100px;
        margin-top:40px;

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
        height: 120px;
        max-width: 100%;
        margin-top:40px;

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
        position: relative;
        margin-bottom: 400PX;
        position: relative;
        margin-top: -86PX;
        /* right: 110px; */
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
                height: 20$;
                width: 40%;
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
<section class="event_banner">
    <div class="container">
        @include('front/common/enroll_header')
        <div class="">
          <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
          <div class="search_background">
            <form class="search_form">
              <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                  <button class="btn searchbtn">Search</button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="jobs tb35p">
    <div class="container rn_container">
        <div class="row">
            <div class="col-md-12">
                @foreach($datas['top_content'] as $tcontent)
                <?php echo $tcontent['module']; ?>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-4 col-12 center-panel';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-8 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-4 col-12';
} else{
$class = 'col-md-12';
} ?>
<section id="enroll" class="jobs tb35p">
    <div class="container rn_container">
        <div class="row">
            <aside class="col-lg-3 col-md-4 col-12">
                <div class="col-2" style="background: #fff;">
                    <div><i class="fa fa-eye"></i> <span id="visitorCount"></span></div>
                    <ul style="width: 200px;" id="user_viewer_">
                    </ul>
                </div>
            </aside>
            <div class="col-lg-8">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div id="main-container">
                                {{-- <div id="screen-share-btn-container" class="col-2 float-right text-right mt-2">
                                    <button id="screen-share-btn"  type="button" class="btn btn-lg">
                                        <i id="screen-share-icon" class="fas fa-share-square"></i>
                                    </button>
                                </div> --}}
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

                                    <div class="col-md-2 text-center btn-group">
                                        <button id="leave-video-group-channel" class="btn btn-raised btn-danger waves-effect waves-light">
                                            Leave Channel
                                        </button>
                                    </div>
                                </div>
                                <div id="full-screen-video"></div>

                                {{-- <div id="lower-video-bar" class="row fixed-bottom mb-1">
                                    <div id="remote-streams-container" class="container col-9 ml-1">
                                        <div id="remote-streams" class="row">
                                            <!-- insert remote streams dynamically -->
                                        </div>
                                    </div>

                                </div> --}}
                            </div>
                            <div id="local-stream-container" class="col p-0">
                                <div id="mute-overlay" class="col">
                                    <i id="mic-icon" class="fas fa-microphone-slash"></i>
                                </div>
                                <div id="no-local-video" class="col text-center">
                                    <i id="user-icon" class="fas fa-user"></i>
                                </div>
                                <div id="local-video" class="col p-0">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                <div class="modal fade" id="modalForm">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h4 class="modal-title w-100 font-weight-bold">Join Channel</h4>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mx-3">
                                <div class="md-form mb-5">
                                    <input type="hidden" id="form-appid" class="form-control" value="4fdfd402ce0a45ea94d850f2124f0b36">
                                    {{-- <label for="form-appid">Agora AppId</label> --}}
                                </div>

                                <div class="md-form mb-4">
                                    <input type="text" id="form-channel" class="form-control" value="{{ $datas['available_channel'] }}" disabled>
                                    <input type="hidden" id="pusher_key" value="{{'6e2167f314296786dc0a'}}">
                                    <input type="hidden" id="reservationID" value="{{ $datas['enroll']->id }}">

                                </div>

                            </div>

                            @if($datas['available_channel'] == 'No Channel Found')
                            <div class="modal-footer d-flex justify-content-center">
                                <a href="{{ url('/enroll/company/'.$datas['enroll']->seo_url) }}" class="btn btn-danger">Cancel</a>
                            </div>
                            @else
                            <div class="modal-footer d-flex justify-content-center">
                                <button id="join-channel" class="btn btn-default">Join Channel</button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if (count($datas['right_content']) > 0)
            <aside class="col-lg-2 col-md-4 col-12">
                @foreach($datas['right_content'] as $rcontent)
                <?php echo $rcontent['module']; ?>
                @endforeach
            </aside>
            @endif
        </div>
    </div>
</section>
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($datas['bottom_content'] as $bcontent)
                <?php echo $bcontent['module']; ?>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<input type="hidden" id="pusher_key" value="6e2167f314296786dc0a">
<input type="hidden" id="b_id" value="{{ $datas['business_user'] }}">
<input type="hidden" id="c_slug" value="{{ $datas['channel'] }}">

<div id="message_box_front" class="message_box">
    <h3>Messages</h3>
    <div id="contacts_front" class="business">
    </div>
</div>
<script src="{{asset('js/agora/AgoraRTCSDK-3.1.1.js')}}"></script>
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
@stop
