<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Business Dashboard Page</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/employer/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/employer/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('css/employer/accordion.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('jobcss/purna.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&amp;" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/timepicker/jquery.timepicker.css')}}" />
    <script src='{{asset("js/employer/jquery-3.1.1.min.js")}}'></script>
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-2.8.0.js"></script>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="100" class="dashboardbg">
    <input type="hidden" id="my_id" value="{{auth()->guard('employer')->user()->id}}">
    <input type="hidden" id="pusher_key" value="6e2167f314296786dc0a">
<!-- header part with navigation ended here -->
{!! csrf_field() !!}

@include('front/common/dash_header')


  <!-- dashboard section started here -->
<section class="dashboard">

  <div class="row">
    <div class="col-lg-2 col-md-4 col-sm-4">
  <div id="left_dashboard" class="left_sidebar tb40p">
    <div class="employer_tagbg center">
      <div class="employerlogo">
        <img src="{{ \App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id) }}">
        <div class="comp_name">
          <p>{{ \App\Employers::getName(Auth::guard('employer')->user()->employers_id) }}</p>
        </div>
      </div>
      <div class="tb10p">
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
          <!-- <p>
            <span class="gold"><i class="fa fa-star-half-alt"></i></span>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
          </p> -->
          @php($member_type = \App\MemberType::getTitle(Auth::guard('employer')->user()->employers_id))
          <div class="tp10p">
            <span><a href="#" class="btn whitegradient rt5m" data-toggle="modal" data-target="#detailModal">{{$member_type}}</a></span>
            @if(\App\Employers::getType(Auth::guard('employer')->user()->employers_id) != 2)
             <span><a href="{{url('/employer/upgrade')}}" class="btn upgradebtn" >Upgrade</a></span>
            @endif
          </div>
          <div class="tp10p">
            @if(\App\EmployerPackage::countPackage() > 0)
            <span><a href="{{url('/employer/package')}}" class="btn lightgreen_gradient"> Packages</a></span>
            @else
            <span><a href="{{url('/employer/buy_package')}}" class="btn lightgreen_gradient">Buy Package</a></span>
            @endif

          </div>
      </div>
    </div>
    @php($member_detail = \App\UpgradeRequest::userDetail(Auth::guard('employer')->user()->employers_id))

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Member Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         @if($member_detail['created_at'] != '')
        <div class="row">

          <div class="col-md-12"><strong>Member Since:</strong> {{$member_detail['created_at']}}</div>

        </div>
         @endif
          @if($member_detail['upgrade_start'] != '')
        <div class="row">

          <div class="col-md-6"><strong>{{$member_type}} Since:</strong> {{$member_detail['upgrade_start']}}</div>
          <div class="col-md-6"><strong>{{$member_type}} Till:</strong> {{$member_detail['upgrade_end']}}</div>

        </div>
         @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    <div class="employer_address">
      <p><i class="fas fa-map-marker-alt"></i> Address : {{\App\Employers::getAddress(Auth::guard('employer')->user()->employers_id)}} <span class="lft15p"></p>
      <p><i class="fa fa-clock"></i> Last Logged In : {{\App\Employers::getLastlogin(Auth::guard('employer')->user()->employers_id)}}</p>
      <div class="row cm-row whitegradient linkcolor">
        <a href="{{url('/employer/logout')}}" class="col-lg-6 col-md-6 col-6">
          <strong><span class="fa fa-power-off"></span>
            <span class="improve-profile">Logout</span>
          </strong>
        </a>
        <a href="{{url('/employer')}}" class="col-lg-6 col-md-6 col-6">
          <strong><span class="fa fa-th-large"></span>
            <span class="improve-profile">Dashboard</span>
          </strong>
        </a>

      </div>

        <div class="row cm-row whitegradient linkcolor tp5m">
        <a href="{{url('/employer/tickets')}}" class="col-lg-12 col-md-12 col-12">
          <strong><span class="fa fa-comment"></span>
            <span class="improve-profile">Support Tickets</span>
          </strong>
        </a>

      </div>
    </div>
    @php($type_detail = \App\MemberType::getDetail(Auth::guard('employer')->user()->employers_id))

    <div class="accordion indicator-plus-before round-indicator" id="accordion" aria-multiselectable="true">
      <div class="card m-b-0">

        <!-- Enroll tab started here -->
        <div class="card-header collapsed" role="tab" id="plan" href="#plans" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="plans">
            <a class="card-title"><i class="fas fa-calendar-check"></i>Enroll</a>
        </div>
        <div id="plans" class="collapse" aria-labelledby="plans" data-parent="#accordion">
            <div class="card-body">
            <ul>
                <li><a href="{{url('/employer/enroll/addnew')}}"><i class="fas fa-calendar-plus"></i>New Enroll</a></li>
                <li><a href="{{url('/employer/enroll/all-detail')}}"><i class="fas fa-calendar-plus"></i>Details</a></li>
                <li><a href="{{url('/employer/enroll/payment-detail')}}"><i class="fa fa-credit-card"></i>Pending Payment</a></li>
                <li><a href="{{url('/employer/enroll/report')}}"><i class="fa fa-credit-card"></i>Payment Report</a></li>

            </ul>
            </div>
        </div>
        <!-- Events tab started here -->
        <div class="card-header collapsed" role="tab" id="event" href="#events" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="events">
          <a class="card-title"><i class="fas fa-calendar-check"></i> Events</a>
        </div>
        <div id="events" class="collapse" aria-labelledby="events" data-parent="#accordion">
          <div class="card-body">
            <ul>
              <li><a href="{{url('/employer/event')}}"><i class="fas fa-images"></i> Events</a></li>
              <li><a href="{{url('/employer/event/addnew')}}"><i class="fas fa-calendar-plus"></i> New Events</a></li>
            </ul>
          </div>
        </div>
<!-- Training tab started here -->
        <div class="card-header collapsed" role="tab" id="training" href="#trainings" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="trainings">
          <a class="card-title"><i class="fas fa-chalkboard-teacher"></i> Training</a>
        </div>
        <div id="trainings" class="collapse" aria-labelledby="trainings" data-parent="#accordion">
          <div class="card-body">
            <ul>
              <li><a href="{{url('/employer/training')}}"><i class="fas fa-laptop-code"></i> Training</a></li>
              <li><a href="{{url('/employer/training/addnew')}}"><i class="fas fa-laptop-medical"></i> New Training</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- service package started here -->
    </div>
    <div class="">
      <h3 class="service_title"><i class="fab fa-staylinked"></i>Service Package</h3>
      <div class="service_package">
        <ul>
          <?php $job_types = \App\JobType::getTypes(); ?>
              @foreach($job_types as $jobtype)
          <li><a href="javascript:void(0);" onClick="viewDetail('{{$jobtype->id}}')">{{$jobtype->title}} <span class="gold"><img src="{{asset('image/'.$jobtype->icon)}}"></span></a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  </div>
  <div class="col-lg-10 col-md-12 col-sm-8">
    <div class="right_pannel_dashboard">
      <div class="form_bg">
        <div class="row tp10m tg-btn">
          <div class="col-lg-12 col-md-12">
            <div class="toggle-btn" onclick="toggleSidebar()">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <div class="clear"></div>
        </div>

<div id="modal_message" class="modal fade tp116p">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      @if (Session::has('alert-danger') || Session::has('alert-success'))
      @if (Session::has('alert-danger'))
      <div class="alert alert-danger updatemsg">{{ Session::get('alert-danger') }}</div>
      @endif
      @if (Session::has('alert-success'))
      <div class="alert alert-success updatemsg">{{ Session::get('alert-success') }}</div>
      @endif
      @endif
    </div>
  </div>
</div>

      <!-- Default box -->
      @yield('content')
      </div>
        <div class="tp20p">
          <div class="row">
            <div class="col-md-6 col-3">
              <div class="social_link">
                <span><a href="#" class="greycolor"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="greycolor"><i class="fab fa-twitter-square"></i></a></span>
              </div>
            </div>
            <div class="col-md-6 col-9">
              <div class="right">
              <p>2018 All Rights with <a href="#" class="blueclr">Rolling Plans Pvt. Ltd.</a></p>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
  </div>

</section>

<!-- footer section ended here -->

<!-- for service package Pricelist popup -->
<div class="modal fade servicemodal" id="goldjob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
</div>
<!-- for upgrade popup -->
<div class="modal fade servicemodal" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

</div>
<div id="message_box_participator" class="message_box">
    <h3>Messages</h3>
    <div id="contacts_participators" class="participate">

    </div>
</div>


<!-- Scripts -->
<script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
<script src="{{asset('/js/employer/popper.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/employer/bootstrap.min.js')}}" type="text/javascript"></script>

   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->

<script src='https://codepen.io/peterbenoit/pen/eezagz.js' type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/axe-core/2.4.2/axe.min.js' type="text/javascript"></script>
<script type="text/javascript" src="{{asset('assets/plugins/timepicker/jquery.timepicker.js')}}"></script>
<script src="{{asset('assets/dist/js/checkall.js')}}"></script>
<script src="{{asset('js/profile-custom.js')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">
  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
</script>
  <script type="text/javascript">
    function toggleSidebar(){
      var h = window.innerHeight;
      $('#left_dashboard').css('height',h);
      $('body').append('<div id="background-overally" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; overflow-y:scroll; transition:all 500ms linear; background-color:rgba(0,0,0,0.5); z-index:99; display-inline:block;"></div>');
      document.getElementById("left_dashboard").classList.toggle('active');
      $('#background-overally').on('click', function(){
        $("#left_dashboard").removeClass('active');
        $(this).remove();
      })
    }

     $(".rating").click(function(){


          $(".rating-detail").fadeToggle();
      });

     function viewDetail(id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
             type: 'POST',
                url: '{{url("/employer/jobtype/")}}',
                data: '_token='+token+'&id='+id,
                cache: false,
                success: function(html){

                  $('#goldjob').html(html);
                  $('#goldjob').modal('show');

                }
          });
     }

  $(function() {

  $('.datepicker').datepicker();

});
  @if (Session::has('alert-danger') || Session::has('alert-success'))
  $(document).ready(function(){
    $("#modal_message").modal("show");
  });
  @endif
  </script>
  <script type="text/javascript">
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


    /*to remove the popup edit and delete button while click on next tab*/
    $('body').click(function(){
    $('.bs-popover-right').remove();
});
  </script>

  @php($setting= \App\library\Settings::getSettings())
{{-- <script type="text/javascript">
    (function () {
        var options = {
            facebook: "rollingplans", // Facebook page ID
            email: "{{ $setting->email }}", // Email
            call: "{{$setting->telephone}}", // Call phone number
            company_logo_url: "{{\App\library\Settings::getLogo()}}", // URL of company logo (png, jpg, gif)
            greeting_message: "Hello, how may we help you? Just send us a message now to get assistance.", // Text of greeting message
            call_to_action: "Meet us", // Call to action
            button_color: "#541547", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,call,email" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script> --}}
<script type="text/javascript">
   $(function () {
    $('.timepicker').timepicker({

      'timeFormat': 'H:i:s',
    });


});

   function chkAll(name, value) {
// hardcoded form name
  var frm = document.getElementById('testform');
// get all inputs from the form into an array
  var inputs = frm.getElementsByTagName('input');

// loop through the form inputs
  for (var i=0; i<inputs.length;i++) {
//if the name matches, set the value to match the calling element
    if (inputs[i].name == name) {
      inputs[i].checked = value;
    }
  }
}
 </script>


 @yield('__scripts')



  </body>
  {{-- <script>
    var base_url = window.location.origin+'/rollingnexus';
    var receiver_id = '';
    var interval;
    var document_title = document.title;

    var my_id = $('#my_id').val();
    var pusher_key = $('#pusher_key').val();

    $(document).ready(function () {

        getParticipateUsers();
        setInterval(function(){
            getParticipateUsers();  //refresh after 10sec
        }, 10000);

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = false;

        var pusher = new Pusher(pusher_key, {
            cluster: 'ap2',
            useTLS:true

        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data));
            if (my_id == data.from) {
                $('#contact_user_' + data.to).trigger( "click" );

            }else if (my_id == data.to) {
                if(data.data_type){
                    var div = document.getElementById('chat_main_'+data.from);

                    if (div) {
                        $('#chat_message_' + data.from +' .unread_message').append('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#chat_message_' + data.from+' li').removeClass('unread_message');
                        $('#chat_message_' + data.from +' #chat_writing').remove();
                        $('#chat_message_' + data.from).append(data.html);
                        scrollToBottomFunc();
                        setTimeout(function() {
                            $('#chat_message_' + data.from +' #chat_writing').remove();
                        }, 10000);
                    }

                }else{

                    var div = document.getElementById('chat_main_'+data.from);

                    if (div) {
                        $('#chat_message_' + data.from +' #chat_writing').remove();
                        $('#chat_message_' + data.from).append(data.html);
                        scrollToBottomFunc();
                    } else {

                        $('#contact_user_' + data.from).trigger( "click" );
                    }

                    if(document.hidden) {
                        playSound();
                        pageBlink(data.sender_name);
                    }
                    var x = document.activeElement.id;
                    if ( x == '#chatinput_' + data.from) {
                        $('#header_' + data.from).removeClass('blink-bg');
                    } else{
                        $('#header_' + data.from).addClass('blink-bg');
                    }
                }
            }
        });
        window.addEventListener('focus', stoPageBlink);

        $(document).on('click', '#message_box h3', function(){
            $('#contacts').slideToggle();

        });
    });

    function getParticipateUsers()
    {
        $.ajax({
                type: 'get',
                url: base_url+'/employer/get_participate_users',
                data: '',
                cache: false,
                success: function(datas){
                    $('#contacts').html(datas);
                }
        });
    }

    $(document).on('click', '.contact_user', function(){
        var id = $(this).attr('id').replace('contact_user_','');
        register_popup(id)
    });



    //this function can remove a array element.
    Array.remove = function(array, from, to) {
        var rest = array.slice((to || from) + 1 || array.length);
        array.length = from < 0 ? array.length + from : from;
        return array.push.apply(array, rest);
    };

    //this variable represents the total number of popups can be displayed according to the viewport width
    var total_popups = 0;

    //arrays of popups ids
    var popups = [];

    function register_popup(id)
    {

        for(var iii = 0; iii < popups.length; iii++)
        {
            //already registered. Bring it to front.
            if(id == popups[iii])
            {
                Array.remove(popups, iii);

                popups.unshift(id);

                calculate_popups();


                return;
            }
        }

        $.ajax({
            type: "get",
            url: base_url+'/employer/get_chat_box/'+id,
            data: "",
            cache: false,
            success: function (datas) {
                $('#count_msg'+id).remove();
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + datas;
                // scrollToBottomFunc();
                popups.unshift(id);

                calculate_popups();
                //$('.message-box textarea').emojioneArea();
                pickImojiButton(id);
                $('#chatinput_'+id).focus();

            }
        });
    }

    function calculate_popups(){
        var width = window.innerWidth;
        if(width < 540)
        {
            total_popups = 0;
        }
        else
        {
            width = width - 200;
            //270 is width of a single popup box
            total_popups = parseInt(width/270);
        }

        display_popups();

    }

        //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
    function display_popups(){
        var right = 220;

        var iii = 0;
        for(iii; iii < total_popups; iii++)
        {
            if(popups[iii] != undefined)
            {
                var eid = popups[iii];

                var element = document.getElementById('chat_main_'+eid);

                element.style.right = right + "px";

                right = right + 275;

                element.style.display = "block";
            }
        }

        for(var jjj = iii; jjj < popups.length; jjj++)
        {

            var element = document.getElementById('chat_main_'+popups[jjj]);
            element.style.display = "none";
        }
    }

    function stoPageBlink() {
        clearInterval(interval), (interval = null), (document.title = document_title);
    }

    function pickImojiButton(id){

        var button = document.querySelector('#emp_'+id);
        var picker = new EmojiButton({
        position: 'right-end',
        emojisPerRow: 6,

        });

        picker.on('emoji', emoji => {
        document.querySelector('#chatinput_'+id).value += emoji;
        });

        button.addEventListener('click', () => {
        picker.togglePicker(button);
        });
    }

    function stoPageBlink() {
        clearInterval(interval), (interval = null), (document.title = document_title);
    }


    $(document).on('click', '.chat-header', function(){

        var id = $(this).attr('id').replace('header_','');
        $('#chat_content'+id).slideToggle();
    });

    $(document).on('keyup', '.message-box textarea', function (e) {

        var message = $(this).val();
        var receiver_id = $(this).attr('data_id');
        var token = $('input[name=\'_token\']').val();

        // check if enter key is pressed and message is not null also receiver is selected
        if (e.keyCode == 13 && message != '' && receiver_id != '') {
            $(this).val(''); // while pressed enter text box will be empty

            var datastr = "receiver_id=" + receiver_id + "&message=" + message+ '&_token=' + token;
            $.ajax({
                type: 'post',
                url: base_url + '/employer/send-message',
                data: datastr,
                cache: false,
                success: function (data) {
                    console.log(data);
                    $('#chat_message_'+receiver_id).append(data['data']);
                },
                error: function(data) {
                    // console.log(data);
                    var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                    errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        alert(errorsHtml); //this is my div with messages

                },
                complete: function () {
                    scrollToBottomFunc();
                }
            });
        }
    });

    function scrollToBottomFunc() {
        $('.chats').animate({
            scrollTop: $('.chats').get(0).scrollHeight
        }, 50);
    }

    $(document).on('click', '.remove-chat-box', function(){

        var id = $(this).attr('id').replace('remove_chat_','');

        close_popup(id);
    });

    function close_popup(id)
    {
            for(var iii = 0; iii < popups.length; iii++)
            {
                if(id == popups[iii])
                {
                    Array.remove(popups, iii);

                    document.getElementById('chat_main_'+id).remove();

                    calculate_popups();

                    return;
                }
            }
    }




</script> --}}
</html>
