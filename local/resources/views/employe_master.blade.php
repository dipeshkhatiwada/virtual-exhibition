<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Individual Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/employer/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/employer/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/employer/plugin.css')}}">
    <link rel="stylesheet" href="{{asset('css/employer/accordion.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&amp;" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
   <!-- <script src='{{asset("js/employer/jquery-3.1.1.min.js")}}'></script> -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
  </head>
  <body data-spy="scroll" data-target=".navbar" data-offset="100" class="dashboardbg">
    <!-- header part with navigation ended here -->
 @include('front/common/dash_header')
    <!-- dashboard section started here -->
    <section class="dashboard">
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-4 ">
          <div id="left_dashboard" class="left_sidebar">
            <div class="individual_info">
                <div class="center">
                  <div class="individual_img">
                    <img src="{{ asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id)) }}">
                  </div>
                  <p>{{ Auth::guard('employee')->user()->firstname }}</p>
                  <span class="">{{ Auth::guard('employee')->user()->email }}</span>
                </div>

              <!--<div class="row cm10-row">
                <div class="col-lg-2 col-md-2 col-2">
                  <div class="individual_img">
                    <img src="{{ asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id)) }}">
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-10">
                  <p>{{ Auth::guard('employee')->user()->firstname }}</p>
                  <span class="">{{ Auth::guard('employee')->user()->email }}</span>
                </div>
              </div> -->
            </div>
            <div class="left_individualmenu">
              <div class="accordion indicator-plus-before round-indicator" id="accordion" aria-multiselectable="true">
                <div class="card m-b-0">
                  <div class="card-header remove_icon" role="tab" id="headingOne" href="#collapseOne" data-toggle="collapse" data-parent="#accordion" aria-expanded="true" aria-controls="collapseOne">
                    <a href="{{url('/employee')}}" class="card-title"><i class="fa fa-th-large"></i> Dashboard</a>
                  </div>
                  <div class="card-header collapsed" role="tab" id="headingTwo" href="#collapseTwo" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwo">
                    <a class="card-title"> <i class="fa fa-address-card"></i> Profile</a>
                  </div>
                  <div  id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                          <li><a href="{{ url('/employee/new-profile/'.auth()->guard('employee')->user()->id) }}"><i class="fas fa-eye"></i> New Profile</a></li>
                        <li><a href="{{ url('/employee/profile') }}"><i class="fas fa-eye"></i> View Profile</a></li>
                        <li><a href="{{ url('/employee/editprofile') }}"><i class="fas fa-edit"></i> Edit Profile</a></li>
                        <li><a href="{{ url('/employee/smart-cv') }}"><i class="fas fa-address-card"></i> Smart CV</a></li>
                        <li><a href="{{ url('/employee/functional-cv') }}"><i class="fas fa-address-card"></i> Functional CV</a></li>
                        <li><a href="{{ url('/employee/chronological-cv') }}"><i class="fas fa-address-card"></i> Chronological CV</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingThree" href="#collapseThree" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseThree">
                    <a href="{{ url('/employee/changepassword') }}" class="card-title"><i class="fas fa-key"></i> Change Password</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingFour" href="#collapseFour" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFour">
                    <a href="{{ url('/employee/educations') }}" class="card-title"><i class="fa fa-graduation-cap"></i> Educations</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingFive" href="#collapseFive" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFive">
                    <a href="{{ url('/employee/training') }}" class="card-title"><i class="fa fa-laptop-code"></i> Training</a>
                  </div>

                  <div class="card-header collapsed" role="tab" id="headingSix" href="#collapseSix" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseSix">
                    <a  class="card-title"><i class="fa fa-user-graduate"></i> Experiences</a>
                  </div>
                  <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                        <li><a href="{{ url('/employee/experience') }}"><i class="fas fa-clipboard-list"></i> Job Experience</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingSeven" href="#collapseSeven" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseSeven">
                    <a href="{{ url('/employee/language') }}" class="card-title"><i class="fa fa-language"></i> Languages</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingEight" href="#collapseEight" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseEight">
                    <a href="{{ url('/employee/reference') }}" class="card-title"><i class="fa fa-user-tie"></i> References</a>
                  </div>

                  <div class="card-header remove_icon" role="tab" id="headingNine" href="#collapseNine" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseNine">
                    <a href="{{ url('/employee/location') }}" class="card-title"><i class="fa fa-map-marker-alt"></i> Preferred Location</a>
                  </div>

                  <div class="card-header remove_icon" role="tab" id="headingEleven" href="#collapseEleven" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseEleven">
                    <a href="{{ url('/employee/documents') }}" class="card-title"><i class="fa fa-file-alt"></i> Documents</a>
                  </div>

                  <div class="card-header collapsed" role="tab" id="headingTwelve" href="#collapseTwelve" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseTwelve">
                    <a  class="card-title"><i class="fa fa-people-carry"></i> Recommended Jobs</a>
                  </div>
                  <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                        <li><a href="{{ url('/employee/recomended-job') }}"><i class="fas fa-briefcase"></i> Recomended Jobs</a></li>
                         <li><a href="{{ url('/employee/recomended-project') }}"><i class="fas fa-briefcase"></i> Recomended Projects</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="card-header collapsed" role="tab" id="applies" href="#applications" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="applications">
                    <a  class="card-title"><i class="fa fa-people-carry"></i> Applied</a>
                  </div>
                  <div id="applications" class="collapse" aria-labelledby="applies" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                        <li><a href="{{ url('/employee/applied') }}"><i class="fas fa-briefcase"></i> Jobs</a></li>
                         <li><a href="{{ url('/employee/project_applied') }}"><i class="fas fa-briefcase"></i>Projects</a></li>
                         <li><a href="{{ url('/employee/training_applied') }}"><i class="fas fa-briefcase"></i>Trainings</a></li>
                         <li><a href="{{ url('/employee/event_applied') }}"><i class="fas fa-briefcase"></i>Events</a></li>
                      </ul>
                    </div>
                  </div>

                  <div class="card-header collapsed" role="tab" id="headingFourteen" href="#collapseFourteen" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFourteen">
                    <a class="card-title"><i class="fa fa-keyboard"></i> Talent Test</a>
                  </div>
                  <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                        <li><a href="{{ url('/employee/finger_test') }}"><i class="fa fa-keyboard"></i> Finger Test</a></li>
                        <li><a href="{{ url('/employee/talent') }}"><i class="fa fa-life-bouy"></i> Skill Test</a></li>
                      </ul>
                    </div>
                  </div>
                   <div class="card-header collapsed" role="tab" id="headingFifteen" href="#collapseFifteen" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFifteen">
                    <a class="card-title"><i class="fa fa-rocket"></i> Challenges</a>
                  </div>
                  <div id="collapseFifteen" class="collapse" aria-labelledby="headingFifteen" data-parent="#accordion">
                    <div class="card-body">
                      <ul>
                          <li><a href="{{ url('/employee/chalange') }}"><i class="fa fa-rocket"></i> Your Challenge </a></li>
                          <li><a href="{{ url('/employee/chalange_participation') }}"><i class="fa fa-award"></i> Participation </a></li>

                      </ul>
                    </div>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingFive" href="#collapseFive" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseFive">
                    <a href="{{ url('/employee/diary') }}" class="card-title"><i class="fa fa-book"></i> Diary</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingEleven" href="#collapseEleven" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseEleven">
                    <a href="{{ url('/employee/circle') }}" class="card-title"><i class="fa fa-user-friends"></i> My Circle</a>
                  </div>

                  <div class="card-header remove_icon" role="tab" id="headingEleven" href="#collapseEleven" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseEleven">
                    <a href="{{ url('/employee/message') }}" class="card-title"><i class="fa fa-envelope-open-text"></i> Messages</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingEleven" href="#collapseEleven" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseEleven">
                    <a href="{{ url('/employee/newsfeed') }}" class="card-title"><i class="fa fa-file-alt"></i> NewsFeed</a>
                  </div>
                  <div class="card-header remove_icon" role="tab" id="headingSixteen" href="#collapseSixteen" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseSixteen">
                    <a href="{{ url('/employee/logout') }}" class="card-title" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout</a>
                  </div>
                   <div class="card-header collapsed" role="tab" id="headingHoroscope" href="#collapseHoroscope" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseHoroscope">
                    <a class="card-title"><i class="fa fa-moon-o"></i> Horoscope</a>
                  </div>
                  <div id="collapseHoroscope" class="collapse" aria-labelledby="headingHoroscope" data-parent="#accordion">
                      <div class="newsfeed">
                        <button type="button" id="toggleHoroscopeBtn" onclick="toggleHoroscopeBtn()" class="btn btn-sm" style="position: absolute;z-index: 99999; right: 20px; font-size: 10px; background-color: #74c159; color: #fff">NEP</button>
                        <input type="hidden" name="horoscopeType" id="horoscopeType" value="english">
                        <div id="horoscope" style="height:300px; overflow-y: scroll; overflow-x:hidden">
                        </div>
                      </div>
                  </div>
                  <!-- newsfeed notification  -->
                  <div class="newsfeed">
                    <h3>News Feed</h3>
                    <div id="list_notification" style="height:300px; overflow-y: scroll; overflow-x: hidden"></div>
                  </div>
                </div>
                <!-- service package started here -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-10 col-md-12 col-sm-12">
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

          </div>
          <div class="tp10m">
                <div class="row cm10-row">
                  <div class="col-md-6 col-3">
                    <div class="social_link">
                      <span><a href="#" class="greycolor"><i class="fab fa-facebook-square"></i></a>
                      <a href="#" class="greycolor"><i class="fab fa-twitter-square"></i></a></span>
                    </div>
                  </div>
                  <div class="col-md-6 col-9">
                    <div class="right">
                      <p>2018 All Rights with <a href="#" class="greenclr">Rolling Plans Pvt. Ltd.</a></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </section>
    <form id="logout-form" action="{{ url('/employee/logout') }}" method="POST" style="display: none;">
        {!! csrf_field() !!}
    </form>
    <!-- footer section ended here -->
    <div class="modal fade servicemodal" id="goldjob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    </div>
    <!-- Scripts -->
    <script src="{{asset('/js/employer/popper.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/employer/bootstrap.min.js')}}" type="text/javascript"></script>
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
    <script src='https://codepen.io/peterbenoit/pen/eezagz.js' type="text/javascript"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axe-core/2.4.2/axe.min.js' type="text/javascript"></script>
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
    <script>
  var token = $('input[name=\'_token\']').val();
  var horoscopeType = $('#horoscopeType').val();
  callHoroscope(horoscopeType);
  function callHoroscope(horoscopeType)
  {
    if(horoscopeType == 'english'){
      horoscopeType = 'nepali';
      $('#toggleHoroscopeBtn').text('ENG');
      $('#horoscopeType').val(horoscopeType);
    }else{
      horoscopeType = 'english';
      $('#toggleHoroscopeBtn').text('NEP');
      $('#horoscopeType').val(horoscopeType);
    }
    $.ajax({
        url: "{{route('employee.horoscope.getHoroscope')}}",
        data:{
            _token: token,
            type: horoscopeType,
        },
        type: 'get',
        dataType: 'JSON',
        success:function(data){
          console.log(data.msg)

          var horoscope = data.msg
          var html = '';
          if(horoscope){
            $.each(horoscope, function(index, value){
              html += '<div class="feedblock" style="white-space: initial;padding:3px 10px;"><div class="row"><div class="col-md-2"><div class="thumb" ><img class="img-circle" style="height:36px; width:25px;" src="'+value.image+'"></div></div><div class="col-md-8"><h6 style="font-weight: 600; color: #000; overflow:hidden;text-overflow:ellipsis">'+value.title+'</h6></div></div><div class="row"><div class="col-md-12"><p style="color: grey; font-size: 10px; overflow:hidden;text-overflow:ellipsis">'+value.data+'</p></div></div></div>'
            });
          }else{
            html+='<br><br><br><br><p class="text-center text-white">No Horoscope</p>'
          }
          $('#horoscope').html(html)
        },
        error:function(error){
          console.log(error)
        },
        complete:function(data){
        }
    })
  }
  function toggleHoroscopeBtn()
  {
    var horoscopeType = $('#horoscopeType').val();
    callHoroscope(horoscopeType);
  }
</script>


<!-- newsfeed notification  -->

  <script src="https://momentjs.com/downloads/moment.min.js"></script>
  <script>
    var timeout = null;
    var page = 1;
    getNewsFeedNotification(page);
    $('#list_notification').on('scroll', function(){
      if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
        page++;
        getNewsFeedNotification(page);
      }
    });
    function getNewsFeedNotification(page){
      var token = $('input[name=\'_token\']').val();
      $.ajax({
        url: "{{route('employee.newsfeed.notification')}}?page="+page,
        data:{
            _token: token,
            page: page,
        },
        type: 'get',
        dataType: 'JSON',
        success:function(data){
          console.log(data.msg)
          var notifications = data.msg.data
          var notificationHtml = '';
          $.each(notifications, function(index, value){
            var image = 'noimage.png';
            if(value.employee.image){
              image = value.employee.image
            }
            var created_at = ''
            var created_at = moment(value.created_at).fromNow()
            notificationHtml+= '<div class="feedblock"><a href="{{url("employee/newsfeed")}}'+'/'+value.newsfeed_id+'"><div class="row cm10-row"><div class="col-md-3"><div class="thumb"><img class="img-circle" src="{{asset("image")}}'+'/'+image+'"></div></div><div class="col-md-9"><div class=""><p>'+value.message+'<span class="pull-right" style="color: grey; font-size: 10px;">'+created_at+'</span></p></div></div></div></a></div>'
          });
          if(data.msg.last_page == page){
              notificationHtml += '<div class="feedblock"><p class="text-center">No More Data</p></div>';
          }
          if(page==1){
              $('#list_notification').html(notificationHtml);
          }else{
              $('#list_notification').append(notificationHtml);
          }
        },
        error:function(error){
          console.log(error)
        },
        complete:function(data){
        }
      })
    }

  </body>
</html>
