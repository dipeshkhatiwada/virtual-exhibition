<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Individual Profile Detail Page</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-all.min.css">

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
<!-- header part with navigation ended here -->
 @include('front/common/dash_header')
<section class="dashboard">
  <div class="container">
  <!--Profile Detail Section Started here-->
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

        <!--Profile memu Started here-->
        <div class="profile_menu">
          <ul>
            <li>
              <a class="nav-link" href="{{url('/employee')}}" title="Home">Home <i class="fa fa-home"></i></a>
            </li>
            <li><a class="nav-link" href="#" title="My Circle">My Cirle <i class="fa fa-users"></i></a></li>
            <li><a class="nav-link" href="#" title="Message">Messages <i class="fa fa-envelope"></i></a></li>
            <li><a class="nav-link" href="#" title="Notification">Notification <i class="fa fa-bell redclr"></i></a></li>
            <li><a class="nav-link" href="{{url('/employee/setting')}}" title="Setting">Setting <i class="fas fa-user-cog"></i></a></li>
          </ul>
        </div>

        <!--Profiel Detail section Started here-->
        <div class="all10p">
          <div class="row">
            <div class="col-lg-9 col-md-9 col-12">
              <!--Profile cover section started here-->
              <div class="profile_cover">
                <div class="cover_overlay"></div>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-4">
                    <div class="individual_img detail_image">
                      <img src="{{ asset($data['image']) }}" id="individual_profile_image">
                       <button id="btn_change" type="button" class="btn lightgreen_gradient btn-xs change_picture"><i class="fa fa-upload"></i> Change Picture</button>
                      
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-6 col-12">
                    <div class="profile_cover_info">
                      <h3 class="profile_righthd whiteclr">{{$data['name']}}</h3>
                      <h2 class="title_two whiteclr">{{$data['pheading']}}</h2>
                      <p>{{$data['user']->nationality}}</p>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-4 col-12">
                    <div class="profile_cover_info rt25">
                      <div class="tp40m">
                        
                        <span><a class="btn whitegradient lft5m" href="javascript:void()" id="edit_profile"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="24" height="24" focusable="false">
  <path d="M21.71 5L19 2.29a1 1 0 00-.71-.29 1 1 0 00-.7.29L4 15.85 2 22l6.15-2L21.71 6.45a1 1 0 00.29-.74 1 1 0 00-.29-.71zM6.87 18.64l-1.5-1.5L15.92 6.57l1.5 1.5zM18.09 7.41l-1.5-1.5 1.67-1.67 1.5 1.5z"></path>
</svg></a></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--cover photo section ended here-->
              <div class="belowprofile">
                <div class="row">
                  <div class="col-lg-2 col-md-0 col-12"></div>
                  <div class="col-lg-7 col-md-7 col-6">
                    <span><a href="{{url('employee/circle')}}" class=""><i class="fa fa-user-circle"></i> {{$data['total_circle']}} Circles</a></span>
                    <span class="squrebullet"></span>
                    <span><a href="javascript:void()" class="" id="contact_info"><i class="fa fa-user-circle"></i> Contact Info</a></span>
                  </div>
                 
                </div>
              </div>
              <!--profile completeness section start here-->
              <div class="right_profile tp15m">
                <div class="profile_title">
                  Profile Completion 
                </div>
                <div class="tb10p">
                  <div class="row cm10l-row">
                    <div class="col-md-1 col-2 profile_progress">{{$data['profile_complete']}}%</div>
                    <div class="col-md-10 col-8 progress">
                      <div class="progress-bar greenbar" role="progressbar" style="width: {{$data['profile_complete']}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="col-md-1 col-2 total_progress">100%</div>
                  </div>
                </div>
                <div class="center">
                  <p>Complete your profile to 100% to get more user interaction</p>
                </div>
              </div>
              <!--job experience section started here-->
              <div class="right_profile tp15m" id="experience_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Job Experience</span>
                  <button class="btn pull-right addbutton" id="add_experience">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                </h2>
                <div id="add_experience_box" class="education tb10p border_bottom">
                  <form class="form-horizontal dash_forms" role="form" id="add_experience_form" method="POST" action="{{ url('/employee/experiences/save') }}">
                    {!! csrf_field() !!}
                    <div class="form-group row ">
                      <div class="col-12 alert-danger" id="experience_error"></div>
                    </div>
                   <input type="hidden" name="id" value="{{$data['user']->id}}">
                  
                      <div class="form-group row ">
                         <div class="col-md-6">
                        <label class="required">Organization</label>
                       
                          <input type="text" required="required" class="form-control" id="ex_institution" name="organization" value="">
                          <input type="hidden" name="employers_id" id="ex_employer_id" value="">
                          <div id="ex_institution_list" class="col-md-12 orglist">    </div>
                        </div>
                        <div class="col-md-6">
                           <label class="required">Type Of Employment</label>
                        
                          <select class="form-control" name="typeofemployment">
                            @foreach($data["employment_type"] as $em_type)<option value="{{$em_type["value"]}}">{{$em_type["value"]}}</option>@endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                           <label class="required">Organization Type</label>
                       
                          <select class="form-control" name="org_type_id">
                            @foreach($data["organization_type"] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="required">Designation</label>
                        
                          <input type="text" required="required" class="form-control" name="designation" placeholder="Wordpress Developer">
                        </div>
                       
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                           <label class="required">Level</label>
                        
                          <select class="form-control" name="level">
                          @foreach($data["job_level"] as $job_level)<option value="{{$job_level["value"]}}">{{$job_level["value"]}}</option>@endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                           <label class="required">from</label>
                        

                          <input type="text" required="required" class="form-control datepicker" name="from" placeholder="2019-12-16">
                        </div>
                       
                      </div>
                      <div class="form-group row ">
                         <div class="col-md-6">
                           <label class="required">To</label>
                        
                          <input type="text" required="required" class="form-control datepicker" name="to" id="to" placeholder="2019-12-18">
                         </div>
                          <div class="col-md-6">
                             <label class="required">Currently Working</label>
                        
                          <select class="form-control" id="currently" name="currently_working">
                            @foreach($data["working_status"] as $working_status)<option value="{{$working_status["value"]}}">{{$working_status["title"]}}</option>@endforeach
                          </select>
                          </div>
                        
                        
                      </div>
                     
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Country</label>
                        
                          <input type="text" required="required" class="form-control" name="country" placeholder ="Nepal">
                       
                        </div>
                        <div class="col-md-6">
                          <label class="">Document</label>
                             <input type="file" name="experience_document" class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group row ">
                        <div class="col-md-12">
                         <label class="required">Experience Detail</label>
                        
                          <textarea class="form-control" name="detail" required="required"></textarea>
                        </div>
                      </div>
                     
                  

                    <div class="form-group row">
                      <div class="col-md-12">
                      <button type="button" id="experience_save" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
                    </div>
                  </div>
                  </form>
                </div>
                @if(count($data['user']->EmployeeExperience) > 0)
                @foreach($data['user']->EmployeeExperience as $experience)
                <div class="job_experience tb10p border_bottom" id="experience_row_{{$experience->id}}">
                  <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu min_width">
                        <li><a class="dropdown-item remove_experience" href="javascript:void()" data-id="{{$experience->id}}"><i class="fa fa-remove"></i>Remove</a></li>
                        <li><a class="dropdown-item edit_experience" href="javascript:void()" data-id="{{$experience->id}}"><i class="fa fa-user-edit"></i>Edit</a></li>
                      </ul>
                    </li>
                  </ul>
                  <div class="row cm10-row">
                    <div class="col-lg-1 col-md-1 col-4">
                      <div class="exp_icon"><i class="fas fa-building"></i></div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-8">
                      <h3 class="job_post btm5p">{{$experience->designation}}</h3>
                      <p>{{$experience->organization}}</p>
                      <p><i class="fa fa-calendar"></i> {{$experience->from}} - {{$experience->currently_working == '1' ? 'Present' : $experience->to}}</p>
                      <p><i class="fa fa-map-marker-alt"></i> {{$experience->country}}</p>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
               
              </div>
              <!--job experience section ended here-->

              <div class="right_profile tp15m" id="education_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Education</span>
                  <button class="btn pull-right addbutton" id="add_education">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                </h2>
                <div id="add_education_box" class="education tb10p border_bottom">
                   <form class="form-horizontal dash_forms" role="form" id="add-education-form" method="POST" enctype="multipart/form-data" action="{{ url('/employee/educations/save') }}">
                      <input type="hidden" name="id" value="{{$data['user']->id}}">
                     <div class="form-group row ">
                      <div class="col-12 alert-danger" id="education_error"></div>
                    </div>
                      {!! csrf_field() !!}
                      
                        <div class="form-group row ">
                          <div class="col-md-6">
                          <label class="required">Country</label>
                         
                          <input type="text" required="required" class="form-control" name="country" placeholder="Country">
                          
                        </div>
                        <div class="col-md-6">
                           <label class="required">Education Level</label>
                           <select class="form-control" id="level_id" name="level_id">
                            <option value="0">Select Level</option>
                            @foreach($data['educationlevel'] as $levels)
                              <option value="{{$levels->id}}">{{$levels->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                        
                        <div class="form-group row">
                           <div class="col-md-6">
                          <label class="required">Faculty</label>
                          
                            <select class="form-control" id="faculty" name="faculty_id">
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label class="required">Specialization</label>
                          
                            <input type="text" required="required" class="form-control" name="specialization" placeholder="Specialization">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                             <label class="required">Institution</label>
                          
                            <input type="text" required="required" class="form-control" id="institution" name="institution" placeholder="Institution" autocomplete="off">
                            <input type="hidden" name="employers_id" id="employer_id" placeholder="Employer ID">
                            <div id="institution_list" class="col-md-12 orglist">    </div>
                          </div>
                          <div class="col-md-6">
                           <label class="required">Board</label>
                          
                            <input type="text" required="required" class="form-control" name="board" placeholder="Board">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label class="required">Mark System</label>
                          
                            <select class="form-control" name="marksystem">@foreach($data['marksystem'] as $msys)<option value="{{$msys['value']}}">{{$msys['title']}}</option>@endforeach  </select>
                          </div>
                          <div class="col-md-6">
                             <label class="required">Percent/CGPA</label>
                          
                            <input type="text" required="required" class="form-control" name="percent" placeholder="Percent">
                          </div>
                         
                        </div>
                       
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label class="required">Year</label>
                          
                            <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="Year">
                          </div>
                          <div class="col-md-6">
                             <label class="">Document</label>
                             <input type="file" name="education_document" class="form-control">
                          
                          </div>
                        </div>
                        
                       
                       
                     
                      <div class="form-group row">
                        <div class="col-md-12">
                          <button type="button" id="education_submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
                        </div>
                        
                      </div>
                    </form>
                </div> 
                @if(count($data['user']->EmployeeEducation) > 0)
                @foreach($data['user']->EmployeeEducation as $education)
                <div class="education tb10p border_bottom" id="education_row_{{$education->id}}">
                  <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu min_width">
                         <li><a class="dropdown-item remove_education" href="javascript:void()" data-id="{{$education->id}}"><i class="fa fa-remove"></i>Remove</a></li>
                        <li><a class="dropdown-item edit_education" href="javascript:void()" data-id="{{$education->id}}"><i class="fa fa-user-edit"></i>Edit</a></li>
                      </ul>
                    </li>
                  </ul>
                  <div class="row cm10-row">
                    <div class="col-lg-1 col-md-1 col-2">
                      <div class="noedu"><i class="fa fa-landmark"></i></div>
                    </div>
                    <div class="col-lg-11 col-md-10 col-10">
                      <h3 class="job_post btm5p bold">{{$education->institution}}</h3>
                      <span>{{\App\Faculty::getLevelTitle($education->level_id)}} in {{\App\Faculty::getTitle($education->faculty_id)}}</span>
                      <span class="lft30m">{{$education->board}} - {{$education->year}}</span>
                      <span class="lft30m">{{$education->specialization}} - {{$education->percentage}}{{$education->marksystem == 1 ? '%' : 'CGPA'}}</span>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
                
              </div>
              <!-- Education section ended here -->
              <div class="right_profile tp15m" id="training_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Training</span>
                  <button class="btn pull-right addbutton" id="add_training">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                </h2>
                 <div id="add_training_box" class="education tb10p border_bottom">
                  <form class="form-horizontal dash_forms" role="form" id="add_training_form" method="POST" enctype="multipart/form-data" action="{{ url('/employee/training/save') }}">
                    {!! csrf_field() !!}
                   <div class="form-group row ">
                      <div class="col-12 alert-danger" id="training_error"></div>
                    </div>
                    
                      <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Title</label>
                        
                          <input type="text" required="required" class="form-control" name="title" placeholder="title">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Details</label>
                       
                          <input type="text" required="required" class="form-control" name="details" placeholder="detail">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Institution</label>
                       
                          <input type="text" required="required" class="form-control" id="t_institution" name="institution" placeholder="intitution">
                          <input type="hidden" name="employers_id" id="t_employer_id" placeholder="74">
                          <div id="t_institution_list" class="col-md-12 orglist"></div>
                        </div>
                         <div class="col-md-6">
                           <label class="required">Duration</label>
                       
                          <input type="text" required="required" class="form-control" name="duration" placeholder="duration">
                        </div>
                      </div>
                      <div class="form-group row ">
                         <div class="col-md-6">
                          <label class="required">Year</label>
                       
                          <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="year">
                        </div>
                         <div class="col-md-6">
                           <label class="">Document</label>
                             <input type="file" name="training_document" class="form-control">
                         </div>
                      </div>
                     
                      <div class="form-group row ">
                        
                     
                    <div class="col-md-6">
                      <button type="button" id="training_submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
                    </div>
                  </div>
                  </form>
                 </div>
                @if(count($data['user']->EmployeeTraining) > 0)
                @foreach($data['user']->EmployeeTraining as $training)
                <div class="education tb10p border_bottom" id="training_row_{{$training->id}}">
                  <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu min_width">
                         <li><a class="dropdown-item remove_training" href="javascript:void()" data-id="{{$training->id}}"><i class="fa fa-remove"></i>Remove</a></li>
                        <li><a class="dropdown-item edit_training" href="javascript:void()" data-id="{{$training->id}}"><i class="fa fa-user-edit"></i>Edit</a></li>
                      </ul>
                    </li>
                  </ul>
                  <div class="row cm10-row">
                    <div class="col-lg-1 col-md-1 col-2">
                      <div class="noedu"><i class="fa fa-landmark"></i></div>
                    </div>
                    <div class="col-lg-11 col-md-10 col-10">
                      <h3 class="job_post btm5p bold">{{$training->institution}}</h3>
                      <span>{{$training->title}}</span>
                      <span class="lft30m">{{$training->duration}} - {{$training->year}}</span>
                      <span class="lft30m">{{$training->details}}</span>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
                
              </div>
              <!-- training section ended here -->

               <!--job reference section started here-->
              <div class="right_profile tp15m" id="reference_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">References</span>
                  <button class="btn pull-right addbutton" id="add_reference">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                </h2>
                <div id="add_reference_box" class="job_experience tb10p border_bottom">
                  <form class="form-horizontal dash_forms" role="form" id="add_reference_form" method="POST" action="{{ url('/employee/reference/save') }}">
                    {!! csrf_field() !!}
                    <div class="form-group row ">
                      <div class="col-12 alert-danger" id="reference_error"></div>
                    </div>
                  
                      <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Name</label>
                        
                        <input type="text" name="name" class="form-control" placeholder="Reference Name">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Designation</label>
                        
                          <input type="text" required="required" class="form-control" name="designation" placeholder="Designation">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Address</label>
                        
                          <input type="text" required="required" class="form-control" name="address" placeholder="Address">
                       
                        </div>
                        <div class="col-md-6">
                           <label class="required">Office Phone</label>
                        
                          <input type="text" required="required" class="form-control" name="office_phone" placeholder="Office Phone">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Mobile</label>
                        
                          <input type="text" required="required" class="form-control" name="mobile" placeholder="Mobile">
                        </div>
                        <div class="col-md-6">
                          <label class="required">E-mail</label>
                        
                          <input type="text" required="required" class="form-control" name="email" placeholder="Email">
                        </div>
                      </div>
                    
                      <div class="form-group row ">
                         <div class="col-md-6">
                          <label class="required">Company</label>
                        
                          <input type="text" required="required" class="form-control" name="company" placeholder="Company">
                        </div>
                         <div class="col-md-6">
                           <button type="button" id="reference_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                @if(count($data['user']->EmployeeReference) > 0)
                @foreach($data['user']->EmployeeReference as $reference)
                 <?php $status = \App\ReferenceComment::checkComment($reference->id); ?>
                <div class="job_experience tb10p border_bottom" id="reference_row_{{$reference->id}}">
                   @if($status == '')
                  <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                      <ul class="dropdown-menu min_width">
                        <li><a class="dropdown-item remove_reference" href="javascript:void()" data-id="{{$reference->id}}"><i class="fa fa-remove"></i>Remove</a></li>
                        <li><a class="dropdown-item edit_reference" href="javascript:void()" data-id="{{$reference->id}}"><i class="fa fa-user-edit"></i>Edit</a></li>
                      </ul>
                    </li>
                  </ul>
                  @endif
                  <div class="row cm10-row">
                    <div class="col-lg-1 col-md-1 col-4">
                      <div class="exp_icon"><i class="fas fa-building"></i></div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-8">
                      <h3 class="job_post btm5p">{{$reference->name}}</h3>
                      <p>{{$reference->designation}}</p>
                      <p>{{$reference->company}}</p>
                      <p><i class="fa fa-envelope"></i> {{$reference->email}}, {{$reference->mobile}}, {{$reference->office_phone}}, {{$reference->address}}</p>
                    </div>
                  </div>
                </div>
                @endforeach
                @endif
               
              </div>
              <!--job reference section ended here-->

              <div class="right_profile tp15m">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Accomplishments</span>
                </h2>
                <div class="row" id="languages">
                  
                  <div class="col-lg-12 col-md-12 col-12">
                  <h3 class="job_post btm5p bold">Languages
                    <button class="btn pull-right addbutton" id="add_language">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                    <button class="btn pull-right addbutton" id="edit_language"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false">
  <path d="M8 9l5.93-4L15 6.54l-6.15 4.2a1.5 1.5 0 01-1.69 0L1 6.54 2.07 5z"></path>
</svg></button>
                  </h3>
                  <div id="add_language_box" class="job_experience tb10p border_bottom">
                  <form class="form-horizontal dash_forms" role="form" id="add_language_form" method="POST" action="{{ url('/employee/language/save') }}">
                    {!! csrf_field() !!}
                    <div class="form-group row ">
                      <div class="col-12 alert-danger" id="language_error"></div>
                    </div>
                  
                      <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Language</label>
                        
                        <input type="text" name="language" class="form-control" placeholder="Nepali">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Understand</label>
                        
                          <select class="form-control" name="understand">
                            <option selected="selected" value="Easily">Easily</option>
                            <option value="Not Easily">Not Easily</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Speak</label>
                        
                          <select class="form-control" name="speak">
                            <option selected="selected" value="Fluently">Fluently</option>
                            <option value="Not Fluently">Not Fluently</option>
                          </select>
                       
                        </div>
                        <div class="col-md-6">
                           <label class="required">Read</label>
                        
                          <select class="form-control" name="read">
                            <option selected="selected" value="Easily">Easily</option>
                            <option value="Not Easily">Not Easily</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Write</label>
                        
                           <select class="form-control" name="write">
                            <option selected="selected" value="Easily">Easily</option>
                            <option value="Not Easily">Not Easily</option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="required">Mother Tongue</label>
                        
                            <select class="form-control" name="mother_t">
                              <option selected="selected" value="0">No</option>
                              <option value="1">Yes</option>
                            </select>
                        </div>
                      </div>
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="language_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                  
                  @php($total_language = count($data['language']))
                  @if($total_language > 0)
                  <div id="lang"> 
                  @foreach($data['language'] as $key => $language)
                  <div id="language_{{$language->id}}">
                    <span class="squrebullet"></span><span>{{$language->language}}</span>
                  </div>
                  @endforeach
                  </div>
                  <div id="lang_detail" class="hidden">
                    @if($total_language > 0)
                    @foreach($data['language'] as $key => $language)
                    <div class="education tb10p border_bottom" id="language_row_{{$language->id}}">
                      <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                          <ul class="dropdown-menu min_width">
                             <li><a class="dropdown-item remove_language" href="javascript:void()" data-id="{{$language->id}}"><i class="fa fa-remove"></i>Remove</a></li>
                            <li><a class="dropdown-item edit_language" href="javascript:void()" data-id="{{$language->id}}"><i class="fa fa-user-edit"></i>Edit</a></li>
                          </ul>
                        </li>
                      </ul>
                      <div class="row cm10-row">
                        
                        <div class="col-lg-12 col-md-12 col-12">
                          <h3 class="job_post btm5p bold">{{$language->language}}</h3>
                          <span><b>Understand: </b>{{$language->understand}}</span>
                          <span class="lft30m"><b>Speak: </b>{{$language->speak}}</span>
                          <span class="lft30m"><b>Read: </b>{{$language->reading}}</span>
                          <span class="lft30m"><b>Write: </b>{{$language->writing}}</span>
                          <span class="lft30m"><b>Mother Tongue: </b>{{$language->mother_t == 1 ? 'Yes' : 'No'}}</span>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>


                 @endif

                  </div>
                </div>
              </div>


              <div class="right_profile tp15m">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Prefered</span>
                </h2>
                
                  
                  <div class="job_experience tb10p border_bottom">
                  <h3 class="job_post btm5p bold">Location
                    <button class="btn pull-right addbutton" id="add_location">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                    
                  </h3>
                  <div id="add_location_box" class="job_experience tb10p border_bottom">
                  <form class="form-horizontal dash_forms location_form" role="form" id="add_location_form" method="POST" action="{{ url('/employee/location/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                   
                  
                      <div class="form-group row ">
                        @foreach($data['joblocation'] as $joblocation)
                        @if(in_array($joblocation->id,$data['employee_location']))
                        <div class="col-md-3 col-6 form-check">
                          <input type="checkbox" checked="checked" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                          <label class="form-check-label" >{{$joblocation->name}}</label>
                        </div>
                        @else
                        <div class="col-md-3 col-6 form-check">
                          <input type="checkbox" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                          <label class="form-check-label" >{{$joblocation->name}}</label>
                        </div>
                        @endif
                        @endforeach
                        
                      </div>
                     
                     
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="location_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                  
                 
                  <div id="locations" class="row location_row"> 
                    <div class="emp_loc col-12">
                  @foreach($data['employee_location'] as $key => $employee_location)
                  <div>
                    <span class="squrebullet"></span><span>{{\App\JobLocation::getName($employee_location)}}</span>
                  </div>
                  @endforeach
                </div>
                  </div>
                  


               

                  </div>

                  <div class="job_experience tb10p border_bottom">
                  <h3 class="job_post btm5p bold">Job Category
                    <button class="btn pull-right addbutton" id="add_category">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                    
                  </h3>
                  <div id="add_category_box" class="job_experience tb10p border_bottom">
                  <form class="form-horizontal dash_forms location_form" role="form" id="add_category_form" method="POST" action="{{ url('/employee/location/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                   
                  
                      <div class="form-group row ">
                        @foreach($data['jobcategory'] as $jobcategory)
                        @if(in_array($jobcategory->id,$data['employee_category']))
                        <div class="col-md-4 col-12 form-check">
                          <input type="checkbox" checked="checked" class="form-check-input" name="job_category[]" value="{{$jobcategory->id}}" >
                          <label class="form-check-label" >{{$jobcategory->name}}</label>
                        </div>
                        @else
                        <div class="col-md-4 col-12 form-check">
                          <input type="checkbox" class="form-check-input" name="job_category[]" value="{{$jobcategory->id}}" >
                          <label class="form-check-label" >{{$jobcategory->name}}</label>
                        </div>
                        @endif
                        @endforeach
                        
                      </div>
                     
                     
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="category_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                  
                 
                  <div id="categorys" class="row category_row"> 
                    <div class="emp_loc col-12">
                  @foreach($data['employee_category'] as $key => $employee_category)
                  <div>
                    <span class="squrebullet"></span><span>{{\App\JobCategory::getTitle($employee_category)}}</span>
                  </div>
                  @endforeach
                </div>
                  </div>
                  
                  </div>

                  <div class="job_experience tb10p border_bottom">
                  <h3 class="job_post btm5p bold">Organization Type
                    <button class="btn pull-right addbutton" id="add_organization_type">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                    
                  </h3>
                  <div id="add_organization_type_box" class="job_experience tb10p border_bottom">
                  <form class="form-horizontal dash_forms location_form" role="form" id="add_organization_type_form" method="POST" action="{{ url('/employee/location/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                   
                  
                      <div class="form-group row ">
                        @foreach($data['organization_type'] as $organization_type)
                        @if(in_array($organization_type->id,$data['employee_org']))
                        <div class="col-md-4 col-12 form-check">
                          <input type="checkbox" checked="checked" class="form-check-input" name="organization_type[]" value="{{$organization_type->id}}" >
                          <label class="form-check-label" >{{$organization_type->name}}</label>
                        </div>
                        @else
                        <div class="col-md-4 col-12 form-check">
                          <input type="checkbox" class="form-check-input" name="organization_type[]" value="{{$organization_type->id}}" >
                          <label class="form-check-label" >{{$organization_type->name}}</label>
                        </div>
                        @endif
                        @endforeach
                        
                      </div>
                     
                     
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="organization_type_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                  
                 
                  <div id="organization_types" class="row organization_type_row"> 
                    <div class="emp_loc col-12">
                  @foreach($data['employee_org'] as $key => $employee_org)
                  <div>
                    <span class="squrebullet"></span><span>{{\App\OrganizationType::getOrgTypeTitle($employee_org)}}</span>
                  </div>
                  @endforeach
                </div>
                  </div>
                  
                  </div>
               

                
                  
                 
                



              </div>

              <div class="right_profile tp15m">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Skills & Endorsements</span>
                </h2>
                <div class="row" id="skills">
                  
                  <div class="col-lg-12 col-md-12 col-12">
                  <h3 class="job_post btm5p bold">
                    <button class="btn pull-right addbutton" id="add_skill">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" width="15" height="15" focusable="false"> <path d="M21 13h-8v8h-2v-8H3v-2h8V3h2v8h8v2z"></path></svg>
                  </button>
                    <button class="btn pull-right addbutton" id="edit_skill"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false">
  <path d="M8 9l5.93-4L15 6.54l-6.15 4.2a1.5 1.5 0 01-1.69 0L1 6.54 2.07 5z"></path>
</svg></button>
<div class="clear"></div>
                  </h3>
                  <div id="add_skill_box" class="job_experience tb10p border_bottom hidden">
                  <form class="form-horizontal dash_forms" role="form" id="add_skill_form" method="POST" action="{{ url('/employee/skill/save') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                    <div class="form-group row ">
                      <div class="col-md-12 alert-danger hidden" id="skill_error"></div>
                    </div>
                  
                      <div class="form-group row ">
                        <div class="col-md-12">
                        
                       
                      <input type="text" data-role="taginput" data-cls-tag-title="text-bold fg-white" data-cls-tag="bg-olive" data-cls-tag-remover="bg-darkOlive fg-white" value="{{$data['employee_skills']}}" name="skills">
                        </div>
                      
                      </div>
                     
                   
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="skill_submit" class="btn bluebg sendbtn" > Save <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                  <div id="total_skill_display"> 
                  @php($total_skill = count($data['user']->Skills))
                  @if($total_skill > 0)
                  <div id="skl"> 
                  @foreach($data['user']->Skills as $key => $skill)
                  <div id="skill_{{$skill->id}}">
                    <span class="squrebullet"></span><span>{{$skill->title}}</span>
                  </div>
                  @endforeach
                  </div>
                  <div id="skill_detail" class="hidden">
                    @if($total_skill > 0)
                    @foreach($data['user']->Skills as $key => $skill)
                    <div class="education tb10p border_bottom" id="skill_row_{{$skill->id}}">
                      
                      <div class="row cm10-row">
                        @php($total_endorse = 0)
                        @php($endorse = json_decode($skill->endorsed))
                        @if(is_array($endorse))
                        @php($total_endorse = count($endorse))
                        @endif
                        <div class="col-lg-12 col-md-12 col-12">
                          <h3 class="job_post btm5p bold">{{$skill->title}}</h3>
                          @if($total_endorse > 0)
                          <span><b>Understand: </b></span>
                          @foreach($endorse as $nd)
                          <span class="lft30m">{{\App\Employees::getName($nd)}}</span>
                          @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif
                  </div>


                 @endif
               </div>

                  </div>
                </div>
              </div>

              
            

             
            </div>

            <!--Profile right pannel-->
            <div class="col-lg-3 col-md-3 col-12">
              <div class="right_profile games">
                 <h2 class="profile_righthd border_bottom">
                    <span class="greenclr">Games</span>
                  </h2>
                <div class="row">
                <a href="{{url('/employee/games/snake')}}" class="game_icon">
                  <img src="{{asset('/assets/snake/snake.png')}}">
                </a>
                <a href="{{url('/employee/games/snake')}}" class="game_icon">
                  <img src="{{asset('/assets/snake/snake.png')}}">
                </a>
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
</section>

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="editprofile-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

  
<div class="modal-dialog modal-lg">
  <div class="modal-content">
  <div class="modal-body">
  <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/employee/updateprofile') }}">
                <input type="hidden" name="id" value="{{$data['user']->id}}">
                <input type="hidden" name="tab" value="setting-tab"> 
                {!! csrf_field() !!}
               
                <div class="form-group row ">
                    
                    <div class="col-md-4 {{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label class="required">First Name</label>
                        <input type="text" required="required" class="form-control" name="firstname" value="{{ $data['user']->firstname }}">
                        @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('middlename') ? ' has-error' : '' }}">
                        <label class="">Middle Name</label>
                        <input type="text" class="form-control" name="middlename" value="{{ $data['user']->middlename }}">
                        @if ($errors->has('middlename'))
                        <span class="help-block">
                            <strong>{{ $errors->first('middlename') }}</strong>
                        </span>
                        @endif
                    </div>
                     <div class="col-md-4 {{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label class="required">Last Name</label>
                        <input type="text" required="required" class="form-control" name="lastname" value="{{ $data['user']->lastname }}">
                        @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label class="required">Gender</label>
                        <select name="gender" id="gender" class="form-control" >
                            <?php foreach($data['genders'] as $gender){
                            if($data['user']->gender == $gender['value']) {
                            ?>
                            <option selected="selected" value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                            <?php }} ?>
                        </select>
                        @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                        
                    </div>
                    <div class="col-md-4 {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                        <label class="required">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" >
                            <?php foreach($data['marital_status'] as $marital_status){
                            if($data['user']->marital_status == $marital_status['value']) {
                            ?>
                            <option selected="selected" value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                            <?php }} ?>
                        </select>
                        @if ($errors->has('marital_status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('marital_status') }}</strong>
                        </span>
                        @endif
                    </div>
                     <div class="col-md-4 {{ $errors->has('present_salary') ? ' has-error' : '' }}">
                        <label class="">Present Salary</label>
                        <input type="text" class="form-control" name="present_salary" value="{{ $data['user']->present_salary }}">
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('expected_salary') ? ' has-error' : '' }}">
                        <label class="">Expected Salary</label>
                        <input type="text" class="form-control" name="expected_salary" value="{{ $data['user']->expected_salary }}">
                    </div>
                    <div class="col-md-4 {{ $errors->has('permanent_district') ? ' has-error' : '' }}">
                        <label class="required">Permanent District</label>
                        <select class="form-control" name="permanent_district" required="required">
                            @foreach($data['district'] as $district)
                            @if($district['value'] == $data['employee_address']->permanent_district)
                            <option selected="selected" value="{{$district['value']}}">{{$district['value']}}</option>
                            @else
                            <option value="{{$district['value']}}">{{$district['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                        @if ($errors->has('permanent_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('permanent_district') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                        <label class="required">Permanent Address</label>
                        <input type="text" required="required" class="form-control" name="permanent_address" value="{{ $data['employee_address']->permanent }}">
                        @if ($errors->has('permanent_address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('permanent_address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md-3 {{ $errors->has('temporary_district') ? ' has-error' : '' }}">
                        <label class="required">Temporary District</label>
                        <select class="form-control" name="temporary_district" required="required">
                            @foreach($data['district'] as $district)
                            @if($district['value'] == $data['employee_address']->temporary_district)
                            <option selected="selected" value="{{$district['value']}}">{{$district['value']}}</option>
                            @else
                            <option value="{{$district['value']}}">{{$district['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                        @if ($errors->has('temporary_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('temporary_district') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-3 {{ $errors->has('temporary_address') ? ' has-error' : '' }}">
                        <label class="">Temporary Address</label>
                        <input type="text" class="form-control" name="temporary_address" value="{{ $data['employee_address']->temporary }}">
                    </div>
                    <div class="col-md-3 {{ $errors->has('home_phone') ? ' has-error' : '' }}">
                        <label class="">Home Phone</label>
                        <input type="text" class="form-control" name="home_phone" value="{{ $data['employee_address']->home_phone }}">
                    </div>
                    <div class="col-md-3 {{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label class="required">Mobile Number</label>
                        <input type="text" required="required" class="form-control" name="mobile" value="{{ $data['employee_address']->mobile }}">
                        @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('fax') ? ' has-error' : '' }}">
                        <label class="">Fax Number</label>
                        <input type="text" class="form-control" name="fax" value="{{ $data['employee_address']->fax }}">
                    </div>
                    <div class="col-md-4 {{ $errors->has('website') ? ' has-error' : '' }}">
                        <label class="">Website</label>
                        <input type="text" class="form-control" name="website" value="{{ $data['employee_address']->website }}">
                        @if ($errors->has('website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                        <label class="required">Date of Birth</label>
                        <input type="text" class="form-control datepicker" name="date_of_birth" value="{{ $data['user']->dob }}">
                        @if ($errors->has('date_of_birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                    @if($data['user']->nationality != '')
                    @php($nt = $data['user']->nationality)
                    @else
                    @php($nt = 'Nepalese')
                    @endif
                    <div class="col-md-4 {{ $errors->has('nationality') ? ' has-error' : '' }}">
                        <label class="required">Nationality</label>
                        <select class="form-control" name="nationality">
                            @foreach($data['nationality'] as $nationality)
                            @if($nt == ucfirst($nationality['value']))
                            <option value="{{ucfirst($nationality['value'])}}" selected="selected">{{ucfirst($nationality['value'])}}</option>
                            
                            @else
                            <option value="{{ucfirst($nationality['value'])}}">{{ucfirst($nationality['value'])}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                    </div>
                  

                    <div class="col-md-4">
                        <label class="">Professional Heading</label>
                        <input type="text" class="form-control" name="professional_heading" placeholder="Developer" value="{{ $data['user']->professional_heading }}">
                    </div>
                    
                </div>
                
               
                <div class="form-group row ">
                   
                    <div class="col-md-8">
                        <label class="">Description</label>
                        <textarea class="form-control" name="description"><?php echo strip_tags($data['user']->description) ?></textarea>
                    </div>
                    
                   
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9 col-xs-7 col-md-offset-4">
                        <button type="submit" class="btn bluebg sendbtn">
                        Update <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>

</div>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" id="collegious-modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">

</div>
</div>
</body>
</script>
    <!-- Script for dropdown hover menu -->
 
<script type="text/javascript">
   
   
    
     @if (Session::has('alert-danger') || Session::has('alert-success'))
  $(document).ready(function(){
    $("#modal_message").modal("show");
  });
  @endif
    </script>
   
  <script src="{{asset('js/employer/popper.js')}}" type="text/javascript"></script>
  <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
     <script src="{{asset('js/profile-custom.js')}}" type="text/javascript"></script>
  

  </html>