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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
   <!-- <script src='{{asset("js/employer/jquery-3.1.1.min.js")}}'></script> -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>

  </head>
<body data-spy="scroll" data-target=".navbar" data-offset="100" class="dashboardbg">
  <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
  <input type="hidden" id="lodemore" value="{{$data['lodemore']}}">
  <input type="hidden" id="datalode" value="{{$data['lodemore']}}">
  <input type="hidden" id="user_image" value="{{asset(\App\Employees::getPhoto(auth()->guard('employee')->user()->id))}}">
  <input type="hidden" id="page" value="1">
<!-- header part with navigation ended here -->
 @include('front/common/dash_header')
<section class="dashboard">
  <div class="row">
    <div class="col-lg-2 col-md-2 col-sm-4 col-6">
      <div id="left_dashboard" class="left_sidebar">
        <div class="individual_info">
          <div class="center">
            <div class="individual_img">
              <img src="{{ asset($data['image']) }}">
            </div>
            <p>{{$data['name']}}</p>
            <span class="">{{ $data['user']->email }}</span>
            <p><a class="btn whitegradient tp5m" href="{{url('employee/view-profile/'.$data['user']->id)}}">View Profile</a></p>
          </div>
        </div>
        <div class="left_individualmenu ind_leftmenu">
          <ul>
            <li><i class="fa fa-user-check"></i> 
              Following <a class="pull-right" href="#" data-toggle="modal" data-target="#following-modal">{{count($data['total_following'])}}</a>
            </li>
            <li><i class="fa fa-podcast"></i> 
              Circle <a class="pull-right" href="{{url('employee/circle')}}">{{$data['total_circle']}}</a>
            </li>
            <li><i class="fa fa-users"></i> 
              Colleagues <a href="#" class="pull-right" data-toggle="modal" data-target="#collegious-modal">{{$data['total_work_friend']}}</a>
            </li>
            <li> <i class="fa fa-graduation-cap"></i>
              Alumni <a class="pull-right" href="#" data-toggle="modal" data-target="#classmate-modal">{{$data['total_college_friends']}}</a>
            </li>
          </ul>

          <div class="profile_info">
            <h2 class="info_title">Activity by you</h2>
          </div>
          <ul>
            <li><i class="fa fa-briefcase"></i> Job 
              <a class="pull-right" href="{{url('employee/applied')}}">{{$data['total_job_apply']}}</a>
            </li>
            <li><i class="fa fa-lightbulb"></i> Project 
              <a class="pull-right" href="{{url('employee/project_applied')}}">{{$data['total_project_apply']}}</a>
            </li>
            <li><i class="fa fa-chalkboard-teacher"></i> Training 
              <a href="{{url('employee/training_applied')}}" class="pull-right" >{{$data['total_training_apply']}}</a>
            </li>
            <li><i class="fa fa-calendar-check"></i> Event 
              <a class="pull-right" href="{{url('employee/event_applied')}}" >{{$data['total_event_apply']}}</a>
            </li>
          </ul>

          <div class="profile_info">
            <h2 class="info_title">Skill Assessment</h2>
          </div>
          <ul>
            <li><i class="fa fa-user-shield"></i> Talent <a class="pull-right" href="{{url('employee/talent')}}">{{$data['total_talent_test']}}</a>
            </li>
            <li><i class="fa fa-keyboard"></i> Finger Test <a class="pull-right" href="{{url('employee/finger_test')}}">{{$data['total_finger_test']}}</a>
            </li>
            
          </ul>
           <div class="profile_info">
            <h2 class="info_title">Activity by Others</h2>
          </div>
          <ul>
            <li class="scores"><i class="fa fa-address-card"></i> Profile Visit 
              <a class="pull-right" href="#">{{auth()->guard('employee')->user()->visits}}</a>
              <div class="tool">{!! $data['visitors'] !!}</div>
            </li>
            <li><i class="fa fa-file-download"></i> CV Download 
              <a class="pull-right" href="#">{{auth()->guard('employee')->user()->cv_download > 0 ? auth()->guard('employee')->user()->cv_download : '0.00'}}</a>
            </li>
            <li><i class="fa fa-file-download"></i> Skill Endorse 
              <a href="javascript:void(0)" onclick="$('#modal-skill').modal('show');" class="pull-right" >{{$data['total_skill_endorse']}}</a>
            </li>
           
          </ul>

            <!--Profile info started here-->
          <div class="profile_info">
            <h2 class="info_title">About Me</h2>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-book"></i> Education</h3>
              <p>{{$data['education']}}</p>
            </div>

            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-map-marker-alt"></i> Location</h3>
              <p>{{$data['address']}}</p>
            </div>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-key"></i> Skills</h3>
              <ul>
                @if(count($data['skills'])> 0)
                @foreach($data['skills'] as $skill)
                <li>{{$skill->title}}</li>
                @endforeach
                @endif
              </ul>
            </div>
            <div class="profilebox">
              <h3 class="profile_hd"><i class="fa fa-file-alt"></i> Notes</h3>
              <p>{!! $data['user']->description !!}</p>
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
                  <a class="nav-link" href="{{url('/employee')}}" title="Home">Home <i class="fa fa-home"></i></a>
                </li>
                <li><a class="nav-link" href="{{url('employee/circle')}}" title="My Circle">My Cirle <i class="fa fa-users"></i></a></li>
                <li><a class="nav-link" href="#" title="Message">Messages <i class="fa fa-envelope"></i></a></li>
                <li><a class="nav-link" href="#" title="Notification">Notification <i class="fa fa-bell redclr"></i></a></li>
              </ul>
            </div>
          <div class="accordion tp10p" id="accordionExample">
    <div class="card">
      <div class="points_heading dash_forms collapsed" id="headingOne">
        <div class="row">
          <div class="col-md-2 col-4 "><span><label>Assessment</label></span></div>
          <div class="col-md-2 col-4 scores"><label>rScore : <sapn class="bluebg pbr" id="highscore">{{$data['ranks']['score']}}/{{$data['ranks']['highscore']}}</sapn></label><div class="tool">{!! $data['topthree'] !!}</div></div>
          <div class="col-md-2 col-4 scores"><label>rRank : <sapn class="greenbg pbr" id="rank">{{$data['ranks']['rank']}}/{{$data['ranks']['total']}}</sapn></label><div class="tool">{!! $data['topthree'] !!}</div></div>
          
          <div class="col-md-2 col-4">
            <form class="form-horizontal"><label>Filter by :</label> 
              <select id="filter_rank">
                <option value="All">All</option>
                <option value="Alumni">Almuni</option>
                <option value="Colleagues">Collagues</option>
                @if(count($data['skills']) > 0)
                <option value="Functional">Functional</option>
                @endif
                <option value="Circle">Circle</option>
              </select>
              
            </form>
          </div>
          <div class="col-md-4 col-8" >
            <form class="" id="colli">
            </form>
            <a href="#" class="right tp10p" type="button" data-toggle="collapse" data-target="#rpoint" aria-expanded="true" aria-controls="collapseTwo" style="position: absolute; top: 2px; right: 10px;">
                <span class="blueclr"><i class="fa fa-plus-circle"></i></span>
              </a>
          </div>
        </div>
      </div>
      
      <div id="rpoint" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <div class="common_bg">
        <div class="table-responsive">
        <table class="table assessment_table ">
          <thead>
            <tr>
            <th>&nbsp</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Score from 10 r Assessment ( 10 assessments will include 3 subject tests and other 7 other management assessment) (Candidates can take hundreds of quizes but that will be for engagement and only 10 test will be listed as r Test)">rTest</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Another major factor is your participation in talent community discussion forums. Employers and recruiters value not only your test scores but also your contribution to learing and development of the people in your talent communities. Participation in discussion forums yield points, which build up your Reputation for the talent. Asking relevant questions, giving informative and impactful answers liked by others, moderating a forum, etc. ears different points.">rLeader</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Completeness of Profile, Video CV, Profile Verificaiton, Reference Check, Employer Check, College Check, Experience letter etc">rVerify</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Get skills endorsements and recommendations from others">rEndorse</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Make r Quiz and r Test in your subject matter and its activity will be reflected in this score">rChallenge</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Sharing on Social Media">rShare</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Upgrading to Premium Profile">rPremium</th>
            <th data-toggle="tooltip" tabindex="0" data-placement="top"  title="Login activity at rollingnexus.com site">rActivity</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Weightage</td>
              <td>17%</td>
              <td>17%</td>
              <td>17%</td>
              <td>17%</td>
              <td>17%</td>
              <td>5%</td>
              <td>5%</td>
              <td>5%</td>
            </tr>
            <tr>
              <td>Score</td>
              <td><span class="wtpointbg">{{$data['points']['testpointscore']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['leaderpoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['verifypoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['endorsepoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['chalangepoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['sharepoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['premiumpoint']}}</span></td>
              <td><span class="wtpointbg">{{$data['points']['activitypoint']}}</span></td>
            </tr>
            <tr>
              <td>Weightage Score</td>
              <td>{{$data['points']['testpointscoreweithtage']}}</td>
              <td>{{$data['points']['leaderpointweithtage']}}</td>
              <td>{{$data['points']['verifypointweithtage']}}</td>
              <td>{{$data['points']['endorsepointweithtage']}}</td>
              <td>{{$data['points']['chalangepointweithtage']}}</td>
              <td>{{$data['points']['sharepointweithtage']}}</td>
              <td>{{$data['points']['premiumpointweithtage']}}</td>
              <td>{{$data['points']['activitypointweithtage']}}</td>
            </tr>
          </tbody>
        </table>
        </div>
        </div>
      </div>
      </div>
    </div>
  </div>
          

          <div class="all10p">
            <div class="row">
              <div class="col-lg-7 col-md-7 col-12">
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{asset($data['image'])}}" alt="user image">
                    <span class="username">
                      <a href="#">{{$data['name']}}</a>
                      <!-- <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe-asia"></i> <span id="public">Public</span><b class="caret"></b></a>
                          <ul class="dropdown-menu min_width">
                            <p class="btm5p">Who can see this?</p>
                            <li><a class="dropdown-item public-item" href="#" data-title="Public" data-value="1"><i class="fa fa-globe-asia"></i>Public</a></li>
                            <li><a class="dropdown-item public-item" href="#" data-title="Circle Only" data-value="2"><i class="fa fa-users"></i>Circle Only</a></li>
                            <li><a class="dropdown-item public-item" href="#" data-title="Only Me" data-value="3"><i class="fa fa-grin"></i>Only me</a></li>
                          </ul>
                        </li>
                      </ul> -->
                    </span>
                    <span class="description uploadimage" id="upload-activity-photo">Photos <i class="fa fa-file-image"></i> </span>
                  </div>
                  
                  
                  <div class="form-group">
                    <input type="hidden" id="public-post" value="">
                     <input type="hidden" id="url-title" value="">
                    <input type="hidden" id="url-description" value="">
                    <input type="hidden" id="url-image" value="">
                    <input type="hidden" id="url-video" value="">
                    <input type="hidden" id="image-session" value="1">
                    <input type="hidden" id="url_id" value="">
                    <input type="hidden" id="web_url" value="">
                      <textarea class="form-control txtInput" id="post-text" data-id="0" placeholder="What is in your mind"></textarea>
                  </div>
                  <div id="url-detail0" class="row cm10-row">
                   
                    
                  </div>
                  <div class="box-footer">
                    <a href="#" class="btn postbtn bluebg pull-right" id="post-activity"> Post</a>
                  </div>
                </div>
                <!--New post section ended here-->
                <div id="all-post-detail">
                {!! $data['activities'] !!}
                <!--Posted feed ended here-->

              </div>
                    <!--ended post with image-->
              </div>
              <div class="col-lg-5 col-md-5 col-12">
                @if(count($data['friend_request']) > 0)
                 <div class="right_profile">
                   <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Friend Request</span>
                   
                  </h2>
                   
                   <div class="row cm10-row">
                    @foreach($data['friend_request'] as $friends)
                      <div id="friend_div{{$friends['id']}}"  class="col-md-6 col-sm-6 col-12">
                        <div class="circle-mem">
                          <div class="row cm10-row">
                            
                            <div class="col-lg-2 col-sm-2 col-2">
                              <img src="{{asset($friends['image'])}}" alt="" class="img-circle img-fluid">
                            </div>
                            <div class="col-lg-10 col-sm-10 col-10">
                              <h2 class="title_one ">{{$friends['name']}}</h2>
                              <a href="javascript:void()" onclick="acceptRequest('{{$friends['id']}}')" class="btn whitegradient blueclr">
                                <i class="fa fa-thumbs-up"></i> Accept
                              </a>
                              <a href="javascript:void()" class="btn whitegradient redclr" onclick="rejectRequest('{{$friends['id']}}')">
                                <i class="fa fa-thumbs-down"></i> Reject
                              </a>
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      @endforeach
                   
                  
                  </div>
                    
                  </div>

                @endif

               @if(count($data['chalanges']) > 0)
                <div class="right_profile">
                   <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Quiz Chalange By Friends</span>
                   
                  </h2>
                      
                  <div class="careerfy-managejobs-list-wrap">
                    <div class="careerfy-managejobs-list">
                      <!-- Manage Jobs Header -->
                      <div class="careerfy-table-layer careerfy-managejobs-thead">
                        <div class="careerfy-table-row ">
                         
                          <div class="careerfy-table-cell" >Chalange By</div>
                          <div class="careerfy-table-cell" >Category</div>
                          <div class="careerfy-table-cell">Title</div>
                          
                         
                          <div class="careerfy-table-cell">Action</div>
                        </div>
                      </div>
                      <div class="careerfy-table-layer careerfy-managejobs-tbody">
                      
                        @foreach($data['chalanges'] as $chalange)
                        <div class="careerfy-table-row">
                          
                         
                          <div class="careerfy-table-cell">{{$chalange['posted_by']}}</div>
                          <div class="careerfy-table-cell ">{{$chalange['category']}}</div>
                         <div class="careerfy-table-cell ">{{$chalange['title']}}</div>
                          
                          <div class="careerfy-table-cell">
                           
                                          <a href="{{ url('/employee/chalange_participation/'.$chalange['seo_url']) }}" class="btn whitegradient greenclr"><i class="fa fa-arrow-right"></i> Participate</a>
                                          
                                         
                          </div>
                         
                        </div>
                        
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                @endif
               

                <div class="right_profile">
                 <div class="dash_fingertest whitebg">
                  <div class="row">
                    <div class="col-md-3 center">
                      <img src="{{asset('/images/typingtest.png')}}">
                    </div>
                    <div class="col-md-9">
                      <p>Take typing test to increase your typing speed and accuracy</p>
                      <a href="{{url('/employee/finger_test')}}" class="btn">Click here !</a>
                    </div>
                  </div>
                </div>
                </div>
                <div class="right_profile">
                 <div class="dash_fingertest whitebg">
                  <div class="row">
                    <div class="col-md-3 center">
                      <img src="{{asset('/images/skilltest.png')}}">
                    </div>
                    <div class="col-md-9">
                      <p>Take knowledge based tests of various areas to enhance your proficiency</p>
                      <a href="{{url('/employee/talent')}}" class="btn greenclr">Click here !</a>
                    </div>
                  </div>
                </div>
                </div>

                  @if(count($data['recomended_jobs']) > 0)
                  <div class="right_profile">
                  <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Recommended Jobs</span>
                    @if(count($data['recomended_jobs']) > 2)
                    <a href="{{url('employee/recomended_jobs')}}" class="pull-right font12">More <i class="fa fa-ellipsis-h"></i></a>
                    @endif
                  </h2>
                @foreach($data['recomended_jobs'] as $recomended)
                
                @php($rempurl = \App\Employers::getUrl($recomended['employers_id']))
                <div class="border_bottom tb10p">
                     <h3><a href="{{url('/jobs/'.$rempurl.'/'.$recomended['seo_url'])}}" target="_blank" class="job_post btm5p">{{$recomended['title']}}</a></h3>
                    <span class="smallbtn bluebg">{{$recomended['availability']}}</span>
                    <span class="smallbtn vacancynum lft15m">Nos : {{$recomended['position']}}</span>
                    <span class="pull-right">{{$recomended['vacancy_code']}}</span>
                  </div>
                
               
                @endforeach
                
                 </div>
                @endif


                @if(count($data['recomended_project']) > 0)
                <div class="right_profile tp15m">
                   <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Recommended Projects</span>
                     @if(count($data['recomended_project']) > 2)
                    <a href="{{url('employee/recomended_project')}}" class="pull-right font12">More <i class="fa fa-ellipsis-h"></i></a>
                    @endif
                    <span class="pull-right font12">More <i class="fa fa-ellipsis-h"></i></span>
                  </h2>
                @foreach($data['recomended_project'] as $project)
                <div class="border_bottom tb10p">
                    <h3 class="job_post btm5p">{{$project['title']}}</h3>
                    <span class="blueclr">Skills : </span> 
                    @php($pskills = explode(',',$project['skills']))
                    @if(is_array($pskills))
                    @foreach($pskills as $skill)
                    <span class="smallbtn whitebg border">{{$skill}}</span> 
                    
                    @endforeach
                    @endif
                    <span class="bold lft15m">Published on : </span><span class="greenclr">{{$project['publish_date']}}</span>
                    <span class="pull-right"><a href="{{$project['href']}}" class="smallbtn whitebg border" target="_blank">Detail</a></span>
                  </div>
                
               
                @endforeach
                </div>
                
                @endif



                  @if(count($data['jobs_applied']) > 0)
                   <div class="right_profile tp15m">
                    <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Applied Jobs</span>
                    @if(count($data['jobs_applied']) > 2)
                    <a href="{{url('employee/applied')}}" class="pull-right font12">More <i class="fa fa-ellipsis-h"></i></a>
                    @endif
                  </h2>
                @foreach($data['jobs_applied'] as $job_applied)
                 @php($status =  \App\JobApply::getStatus($job_applied->id))
                <div class="border_bottom tb10p">
                    <h3 class="job_post btm5p">{{\App\Jobs::getOrgName($job_applied->jobs_id)}}</h3>
                    <span class="blueclr">{{\App\Jobs::getTitle($job_applied->jobs_id)}} </span> 
                    <span class="bold lft15m">Apply Date : </span><span class="blueclr">{{$job_applied->apply_date}}</span>
                    <span class="lft15m"> {{\App\Jobs::getCode($job_applied->jobs_id)}}</span>
                    <span class="pull-right"><?php echo $status['status'];?></span>
                  </div>


              
                @endforeach
                
                
                  
                </div>
                @endif
                  
                  @if(count($data['project_applied']) > 0)
                  <div class="right_profile tp15m">
                  <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Applied Projects</span>
                   @if(count($data['project_applied']) > 2)
                    <a href="{{url('employee/project_applied')}}" class="pull-right font12">More <i class="fa fa-ellipsis-h"></i></a>
                    @endif
                  </h2>
                @foreach($data['project_applied'] as $project_applied)
                <div class="border_bottom tb10p">
                    <h3 class="job_post btm5p"> <a href="javascript:void(0);" onclick="detail('{{$project_applied->id}}')"> {{\App\Project::getTitle($project_applied->project_id)}}</a></h3>
                    <span class="blueclr">Duration : </span> <span class="bold">{{$project_applied->duration}} Day(s)</span>
                    <span class="smallbtn bluebg lft15m"> NPR. {{$project_applied->amount}}</span>
                    <span class="bold lft15m">Date : </span><span class="blueclr">{{$project_applied->created_at}}</span>
                    <span class="pull-right"><a href="#" class="smallbtn orangebg"><?php echo \App\ProjectApply::getStatus($project_applied->status, $project_applied->complete_status);?></a></span>
                  </div>


               
                <div id="detail_{{$project_applied->id}}" style="display: none;">
                  <div class="form_bg">
                    <h3 class="form_heading">Proposal</h3>
                    <p class="p7"><?php echo $project_applied->description;?></p>
                    <h3 class="form_heading">Project Milestone</h3>
                    <div class="form_tabbar">
                      <table class="table table_form">
                        <thead>
                          <tr>
                            <th>Description</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($project_applied->ProjectMilestone as $mstone)
                          <tr>
                            <td>{{$mstone->description}}</td>
                            <td>{{$mstone->amount}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                @endforeach
                
                </div>
                @endif
                 
               
               
             

            
              
              
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>

    
  </div>
</section>

@if(count($data['skills']) > 0)
<div class="modal fade servicemodal" id="modal-skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      
      <h4 class="modal-title left" >Skills & Endorsements</h4>
      
    </div>
    
    <div class="modal-body">
      @foreach($data['skills'] as $skl)
      @php($total_endorse = 0)
      @php($endorse = json_decode($skl->endorsed))
      @if(is_array($endorse))
      @php($total_endorse = count($endorse))
      @endif
      <div class="col-12 employe_skill">
        <div class="skill-title">{{$skl->title}} <span>{{$total_endorse}}</span></div>
        <div class="endorse"> <span>Endorsed By:</span> 
          @if($total_endorse > 0)
          @foreach($endorse as $nd)
          <span class="spans">{{\App\Employees::getName($nd)}}</span>
          @endforeach
          @endif
        </div>
      </div>
      @endforeach
      
      
    </div>
    
  </div>
  <!-- /.modal-dialog -->
</div>
</div>
@endif

@if(count($data['total_following']) > 0)
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="following-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content totalblock-modal">
      <div class="row btm10m">
        @foreach($data['total_following'] as $total_following)
        <div class="col-lg-6">
          <div class="member-block">
            <div class="row">
              <div class="col-lg-3">
                <div class="eduboard-logo">
                  <img src="{{\App\Employers::getPhoto($total_following['employers_id'])}}">
                </div>
              </div>
              <div class="col-lg-9">
                <h3 class="company-name text-ellipse">{{\App\Employers::getName($total_following['employers_id'])}}</h3>
                <p>Address:: {{\App\Employers::getAddress($total_following['employers_id'])}}</p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endif
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="classmate-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content totalblock-modal">
      <div class="row">
        @if($data['total_college_friends'] > 0)
        @foreach($data['college_friends'] as $college_friends)
        <div class="col-lg-6">
          <div class="member-block">
            <div class="row">
              <div class="col-lg-4">
                <div class="eduboard-logo">
                  <img src="{{$college_friends['company_logo']}}">
                </div>
              </div>
              <div class="col-lg-8">
                <h3 class="company-name text-ellipse">{{$college_friends['company_name']}}</h3>
                <p class="total-frinend">Total Classmates: <a href="{{url('/employee/classmates?institute_id='.$college_friends['college_id'])}}" class="btn t-btn">{{$college_friends['total_friends']}}</a></p>
                <p>{{$college_friends['batch']}} Batch : <a href="{{url('/employee/classmates?institute_id='.$college_friends['college_id'].'&batch='.$college_friends['batch'])}}" class="btn batchbtn">{{$college_friends['batch_friend']}}</a></p>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="collegious-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content totalblock-modal">
    <div class="row">
        @if($data['total_work_friend'] > 0)
        @foreach($data['work_company'] as $work_company)
        <div class="col-lg-6">
            <div class="member-block">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="eduboard-logo">
                            <img src="{{$work_company['company_logo']}}">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <h3 class="company-name text-ellipse">{{$work_company['company_name']}}</h3>
                        <p class="total-frinend">Total Collegious: <a href="{{url('/employee/collegious?company_id='.$work_company['company_id'])}}" class="btn t-btn">{{$work_company['total_friends']}}</a></p>
                        <p>{{$work_company['batch']}} Batch : <a href="{{url('/employee/collegious?company_id='.$work_company['company_id'].'&batch='.$work_company['batch'])}}" class="btn batchbtn">{{$work_company['batch_friend']}}</a></p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
</div>
</div>
<div class="image-popup" id="image-popup">
  <div class="remove-popup"><i class="fa fa-remove"></i></div>
  <div class="image-content">
    <div class="row cm10-row">
      <div class="col-md-9 image-field" id="image-field">
        <div class="prv" id="prv" data-id="" data-parent=""><i class="fas fa-angle-left"></i></div>
        <div class="next" id="next" data-id="" data-parent=""><i class="fas fa-angle-right"></i></div>
        <img src="{{asset('/image/myphoto.jpg')}}" id="popimage">
      </div>
      <div class="col-md-3 comment-field" id="comment-field">
        
      </div>
    </div>
  </div>
 </div>
  <div class="modal fade servicemodal" id="modal-bid" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    
    <h4 class="modal-title left" >Bid Detail</h4>
    <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  </div>
  
  <div class="modal-body">
    
    
    
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
    
  </div>
  
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
</body>


    <script src="{{asset('js/profile-custom.js')}}" type="text/javascript"></script>
  <script src="{{asset('js/employer/popper.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
  </html>