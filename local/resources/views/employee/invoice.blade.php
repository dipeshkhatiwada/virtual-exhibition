<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Individual Profile Page</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/employer/plugin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    
    <link rel="stylesheet" href="{{asset('css/employer/accordion.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('css/purna.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&amp;" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
   <script src='{{asset("js/employer/jquery-3.1.1.min.js")}}'></script> -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>

  </head>
<body data-spy="scroll" data-target=".navbar" data-offset="100" class="dashboardbg">
<!-- header part with navigation ended here -->
 @include('front/common/dash_header')
<section class="dashboard">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-4 col-6">
      <div id="left_dashboard" class="left_sidebar">
        <div class="individual_info">
          <div class="center">
            <div class="individual_img">
            </div>
            <p>Purna Nepali</p>
            <span class="">purna@rollingplans.com.np</span>
            <p><a class="btn whitegradient tp5m" href="{{url('employee/profile/'.$data['user']->id)}}">View Profile</a></p>
          </div>
        </div>
        
        <div class="left_individualmenu ind_leftmenu">
          <ul>
            <li><i class="fa fa-user-check"></i> 
              Following 
            </li>
            <li><i class="fa fa-podcast"></i> 
              Circle 
            </li>
            <li><i class="fa fa-users"></i> 
              Colleagues 
            </li>
            <li> <i class="fa fa-graduation-cap"></i>
              Alumni 
            </li>
          </ul>

          <div class="profile_info">
            <h2 class="info_title">Activity by you</h2>
          </div>
          <ul>
            <li><i class="fa fa-briefcase"></i> Job 
            </li>
            <li><i class="fa fa-lightbulb"></i> Project 
            </li>
            <li><i class="fa fa-chalkboard-teacher"></i> Training 
            </li>
            <li><i class="fa fa-calendar-check"></i> Event 
            </li>
          </ul>

          <div class="profile_info">
            <h2 class="info_title">Skill Assessment</h2>
          </div>
          <ul>
            <li><i class="fa fa-user-shield"></i> Talent 
            </li>
            <li><i class="fa fa-keyboard"></i> Finger Test
            </li>
            
          </ul>
           <div class="profile_info">
            <h2 class="info_title">Activity by Others</h2>
          </div>
          <ul>
            <li class="scores"><i class="fa fa-address-card"></i> Profile Visit 
              <div class="tool">200</div>
            </li>
            <li><i class="fa fa-file-download"></i> CV Download 
            </li>
            <li><i class="fa fa-file-download"></i> Skill Endorse 
            </li>
           
          </ul>

            <!--Profile info started here-->
          <div class="profile_info">
            <h2 class="info_title">About Me</h2>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-book"></i> Education</h3>
              <p>BIT</p>
            </div>

            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-map-marker-alt"></i> Location</h3>
              <p>Jawalakhel</p>
            </div>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-key"></i> Skills</h3>
              <ul>
                 <li>computer</li>
                <li>music</li>
              </ul>
            </div>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-file-alt"></i> Notes</h3>
              <p>description goes here.</p>
            </div>
          </div>
        </div>


      </div>
    </div>
    <!--left dashboard ended here-->

    <div class="col-lg-10 col-md-10 col-12">
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
            <div class="profile_menu">
              <ul>
                <li>
                  <a class="nav-link" href="http://dev.event.com/employee" title="Home">Home <i class="fa fa-home"></i></a>
                </li>
                <li><a class="nav-link" href="http://dev.event.com/employee/circle" title="My Circle">My Cirle <i class="fa fa-users"></i></a></li>
                <li><a id="message_link" class="nav-link" href="javascript:void()" title="Message">Messages <i class="fa fa-envelope"></i></a></li>
                <li><a class="nav-link" href="#" title="Notification">Notification <i class="fa fa-bell redclr"></i></a></li>
                <li><a class="nav-link" href="http://dev.event.com/employee/setting" title="Setting">Setting <i class="fas fa-user-cog"></i></a></li>
              </ul>
            </div>
          <div class="all10p">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-12">
                <!--New post section ended here-->
                <div id="all-post-detail">
                    <div class="row">
                        <div class="col-md-12 careerfy-typo-wrap">
                            <div class="careerfy-employer-dasboard">
                                <div class="">
                                    <!-- Profile Title -->
                                    <h3 class="form_heading">Your Orders</h3>

                                        <div class="careerfy-employer-box-section">
                                    @if(count($data['invoice']) > 0)
                                    <!-- Manage Jobs -->
                                    <div class="col-xs-12 table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data['invoice'] as $job)
                                            <tr>
                                                <td>{{$job->amount}}</td>
                                                <td>{{$job['invoice_status']}}</td>
                                                <td>{{$job->created_at}}</td>
                                                <td> 
                                                    <a href="{{url('employee/invoice/view/'.$job->id)}}" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                                                    <!-- <a href="javascript:void(0);" onClick="confirm_delete('/{{$job->id}}')" class="btn whitegradient greenclr left redclr"><i class="fa fa-trash-alt"></i> Delete</a> -->
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    <!-- /.col -->
                                    <!-- Pagination -->
                                    
                                    @else
                                    <div style="clear: both;"></div>
                                    <div class="alert alert-info text-center">
                                            <span class="icon-circle-warning mr-2"></span>
                                            You don't have any Orders at the moment.
                                            </div>
                                    @endif
                                

                                </div>
                            </div>
                        </div>
                <!--Posted feed ended here-->
                </div>
                <!--ended post with image-->
              </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>


  </div>
</section>


</body>
<script type="text/javascript">
//  function confirm_delete(ids){
//     if(confirm('Do You Want To Delete?')){
//       var url= "{{ url('/employee/invoice/delete/') }}"+ids;
//       location = url;
//       }
//     }
</script>
 <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
    <script src="{{asset('js/profile-custom.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/employer/popper.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script type="text/javascript" src="{{ asset('/assets/facybox/jquery.fancybox.js?v=2.1.5') }}" ></script>
<script type="text/javascript" src="{{ asset('/assets/facybox/jquery.fancybox-media.js?v=1.0.6') }}" ></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/facybox/fancybox.css?v=2.1.5') }}" media="screen" />
<script type="text/javascript" src="{{ asset('/assets/facybox/myfunction.js?v=2.1.5') }}" ></script>
  </html>