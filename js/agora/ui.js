var base_url = window.location.origin+'/rollingnexus';
var pusher_key = $('#pusher_key').val();

$(document).ready(function() {
        // alert('sa');
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher(pusher_key, {
            cluster: 'ap2'
        });
        var channel = pusher.subscribe('call-audience');
        channel.bind('call-business', function(data) {
            // alert(JSON.stringify(data));
            if(data.type =='joinvideocall'){               
                document.getElementById("visitorCount").innerHTML=data.counter+" person(s)";
                $('#user_viewer_').empty();
                $('#user_viewer_').append(data.html);
            }
            else if(data.type == 'leavevideocall'){
                document.getElementById("visitorCount").innerHTML=data.count+" person(s)";
                $('#user_viewer_'+data.user_id).remove();
            }
        });
    });
$( "#create-channel" ).click(function( event ) {
  var agoraAppId = $('#form-appid').val();
  var channelName = $('#form-channel').val();
  var reservation = $('#reservation').val();

  initClientAndJoinChannel(agoraAppId, channelName);
  $.ajax({
    type: 'post',
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    },   
    url: base_url + '/employer/enroll/video-call/' + channelName,
    data:{
      'channel': channelName,
      'reservation_id': reservation,
    },
    cache:false,
    success:function(datas){
        console.log("Saving data", datas);
    }
  }); 

  $("#modalForm").modal("hide");
});

$("#finish-call-by-buser").click(function(){           
  var channelName = $('#form-channel').val();
  $.ajax({
      type: 'delete',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      },
      url: base_url + '/employer/enroll/video-call/finish/' + channelName,
      data:{
          'channel': channelName,
      },
      cache: false,
      success: function(datas){
          leaveChannel();
          location.replace(base_url + "/employer/dashboard/enroll");
          console.log("so sad to see you leave the channel");
      }
  });
});
 // join channel modal
 $( "#join-channel" ).click(function( event ) {
  var agoraAppId = $('#form-appid').val();
  var channelName = $('#form-channel').val();
  var seo_url = channelName.replace("-videocall", "" )
  console.log("SEO_URL", seo_url);
  $.ajax({
      type: 'post',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      },   
      url: base_url + '/enroll/group-video/' + seo_url,
      data:{
          'channel': channelName
      },
      cache:false,
      success:function(datas){
          console.log("Joining User", datas);
      }
  });
  initClientAndJoinChannel(agoraAppId, channelName);
  $("#modalForm").modal("hide");
});


$("#leave-video-group-channel").click(function(){           
  var channelName = $('#form-channel').val();
  var res_id = $('#reservationID').val();
  var seo_url = channelName.replace("-videocall", "" )
  var redirect_url = base_url + "/enroll/company/"+seo_url
  $.ajax({
      type: 'post',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      },
      url: base_url + '/enroll/group-video/leave',
      data:{
          'channel': channelName,
          'reservation_id': res_id,
      },
      cache: false,
      success: function(datas){
          location.replace(redirect_url);
          leaveChannel();
      }
  });
});

// UI buttons
function enableUiControls(localStream) {

  $("#mic-btn").prop("disabled", false);
  $("#video-btn").prop("disabled", false);
  $("#screen-share-btn").prop("disabled", false);
  $("#exit-btn").prop("disabled", false);

  $("#mic-btn").click(function(){
    toggleMic(localStream);
  });

  $("#video-btn").click(function(){
    toggleVideo(localStream);
  });

  $("#screen-share-btn").click(function(){
    toggleScreenShareBtn(); // set screen share button icon
    $("#screen-share-btn").prop("disabled",true); // disable the button on click
    if(screenShareActive){
      stopScreenShare();
    } else {
      initScreenShare(); 
    }
  });

  

  // keyboard listeners 
  $(document).keypress(function(e) {
    switch (e.key) {
      case "m":
        console.log("squick toggle the mic");
        toggleMic(localStream);
        break;
      case "v":
        console.log("quick toggle the video");
        toggleVideo(localStream);
        break; 
      case "s":
        console.log("initializing screen share");
        toggleScreenShareBtn(); // set screen share button icon
        $("#screen-share-btn").prop("disabled",true); // disable the button on click
        if(screenShareActive){
          stopScreenShare();
        } else {
          initScreenShare(); 
        }
        break;  
      case "q":
        console.log("so sad to see you quit the channel");
        leaveChannel(); 
        break;   
      default:  // do nothing
    }

    // (for testing) 
    if(e.key === "r") { 
      window.history.back(); // quick reset
    }
  });
}

function toggleBtn(btn){
  btn.toggleClass('btn-dark').toggleClass('btn-danger');
}

function toggleScreenShareBtn() {
  $('#screen-share-btn').toggleClass('btn-danger');
  $('#screen-share-icon').toggleClass('fa-share-square').toggleClass('fa-times-circle');
}

function toggleVisibility(elementID, visible) {
  if (visible) {
    $(elementID).attr("style", "display:block");
  } else {
    $(elementID).attr("style", "display:none");
  }
}

function toggleMic(localStream) {
  toggleBtn($("#mic-btn")); // toggle button colors
  $("#mic-icon").toggleClass('fa-microphone').toggleClass('fa-microphone-slash'); // toggle the mic icon
  if ($("#mic-icon").hasClass('fa-microphone')) {
    localStream.unmuteAudio(); // enable the local mic
    toggleVisibility("#mute-overlay", false); // hide the muted mic icon
  } else {
    localStream.muteAudio(); // mute the local mic
    toggleVisibility("#mute-overlay", true); // show the muted mic icon
  }
}

function toggleVideo(localStream) {
  toggleBtn($("#video-btn")); // toggle button colors
  $("#video-icon").toggleClass('fa-video').toggleClass('fa-video-slash'); // toggle the video icon
  if ($("#video-icon").hasClass('fa-video')) {
    localStream.unmuteVideo(); // enable the local video
    toggleVisibility("#no-local-video", false); // hide the user icon when video is enabled
  } else {
    localStream.muteVideo(); // disable the local video
    toggleVisibility("#no-local-video", true); // show the user icon when video is disabled
  }
}