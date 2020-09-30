<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Individual Profile Detail Page</title>
    
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
            <div class="col-lg-12 col-md-12 col-12">
              <!--Profile cover section started here-->
              
             
             
              <!--job experience section started here-->
              <div class="right_profile tp15m" id="experience_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">Setting</span>
                  
                </h2>
                
                <div class="job_experience tb10p border_bottom">
                  <h3 class="job_post btm5p bold"><span id="user_email"> {{$data['user']->email}}</span>
                    <span class=" pull-right pointer" id="change_email">Change Email</span>
                    
                  </h3>
                  <div id="change_email_box" class="job_experience tb10p hidden">
                  <form class="form-horizontal dash_forms location_form" role="form" id="change_email_form" method="POST" action="{{ url('/employee/email/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                   
                  
                      <div class="form-group row ">
                       
                        <div class="col-md-6 col-12">

                          <input type="text" class="form-control" name="email" id="email" value="{{$data['user']->email}}" >
                           <span id="email_error_message" class="help-block hidden email_message">
                                
                            </span>
                        
                        </div>
                       
                        
                      </div>
                     
                     
                    
                    
                    
                     
                  </form>
                </div> 
                 
                  </div>

                   <div class="job_experience tb10p border_bottom">
                  <h3 class="job_post btm5p bold">Password
                    <span class=" pull-right pointer" id="change_password">Change</span>
                    
                  </h3>
                  <div id="change_password_box" class="job_experience tb10p hidden">
                  <form class="form-horizontal dash_forms location_form" role="form" id="change_password_form" method="POST" action="{{ url('/employee/updatelogin') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$data['user']->id}}">
                   <div class="form-group row ">
                      <div class="col-12 alert-danger hidden" id="password_error"></div>
                    </div>
                  
                      <div class="form-group row ">
                       
                        <div class="col-md-4 col-12">
                          <label class="control-label required">Old Password</label>
                          <input type="text" class="form-control" required="required" name="old_password" id="old_password" value="" >
                           <span id="old_error_message" class="help-block hidden"></span>
                        
                        </div>
                         <div class="col-md-4 col-12">
                          <label class="control-label required">Corrnet Password</label>
                          <input type="password" class="form-control" required="required" name="password" id="password" value="" >
                          <span id="password_error_message" class="help-block hidden"></span>
                        
                        </div>
                         <div class="col-md-4 col-12">
                          <label class="control-label required">Confirm Password</label>
                          <input type="password" class="form-control" required="required" name="password_confirmation" id="password_confirmation" value="" >
                          <span id="conf_error_message" class="help-block hidden"></span>
                        </div>
                       
                        
                      </div>
                     
                     
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="password_submit" class="btn bluebg sendbtn" > Change <i class="fa fa-paper-plane"></i></button>

                         </div>
                      </div>
                    
                     
                  </form>
                </div> 
                 
                  </div>
               
              </div>

              <div class="right_profile tp15m" id="experience_box">
                <h2 class="profile_righthd border_bottom">
                  <span class="greenclr">General Setting</span>
                  <button class="btn pull-right addbutton" id="edit_setting">
                   
                  </button>
                </h2>
                <div id="edit_setting_box" class="education tb10p border_bottom">
                  <form class="form-horizontal dash_forms" role="form" id="edit_setting_form" method="POST" action="{{ url('/employee/updatesetting') }}">
                    {!! csrf_field() !!}
                    <div class="form-group row ">
                      @if(count($errors))
               
                        <div class="col-md-12">
                        <div class="alert alert-danger">
                         @foreach($errors->all() as $error)
                          {{ '* : '.$error }}</br>
                         @endforeach
                            </div>
                        </div>

                      
                   @endif
                    </div>
                   <input type="hidden" name="id" value="{{$data['user']->id}}">
                  
                      <div class="form-group row ">
                    <div class="col-md-4">
                        <label class="required">Travel</label>
                        <select class="form-control" name="travel">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->travel == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Willing To Relocate</label>
                        <select class="form-control" name="relocation">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->relocation == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Have Driving License</label>
                        <select class="form-control" name="license">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->license == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="form-group row ">
                    
                    
                    <div class="col-md-4">
                        <label class="">License of</label>
                        <select name="license_of" id="license_of" class="form-control" >
                            <option value="">None</option>
                            <?php foreach($data['vehicles'] as $vehicle){
                            if($data['employee_setting']->licenseof == $vehicle['value']) {
                            ?>
                            <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php }} ?>
                        </select>
                    </div>
                     <div class="col-md-4">
                        <label class="required">Have Vehicle</label>
                        <select class="form-control" name="have_vehicle">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->have_vehicle == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="">Vehicle</label>
                        <select name="vehicle" id="vehicle" class="form-control" >
                            <option value="">None</option>
                            <?php foreach($data['vehicles'] as $vehicle){
                            if($data['employee_setting']->vehical == $vehicle['value']) {
                            ?>
                            <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                

                <div class="form-group row ">
                    <div class="col-12">
                    <h3 class="form_heading">Privacy setting</h3>
                </div>
                <div class="col-md-4">
                        <label class="required">Job Alert</label>
                        <select class="form-control" name="job_alert">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->aleartable == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                   
                   
                    <div class="col-md-4">
                        <label class="required">Profile Searchable</label>
                        <select name="searchable" id="searchable" class="form-control" >
                        @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->searchable == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Profile Confidential</label>
                        <select class="form-control" name="confidential">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->confidential == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Find you in as alumni, as colleagues</label>
                        <select class="form-control" name="find_you">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->find_you == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Send you circle request</label>
                        <select class="form-control" name="circle_request">
                            @foreach($data['yes_no'] as $yn)
                            @if($data['employee_setting']->circle_request == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your Email</label>
                        <select class="form-control" name="email_privacy">
                            @foreach($data['whocan'] as $whocan)
                            @if($data['employee_setting']->email_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Who can see your Phone Number</label>
                        <select class="form-control" name="phone_privacy">
                            @foreach($data['whocan'] as $whocan)
                            @if($data['employee_setting']->phone_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your Circle</label>
                        <select class="form-control" name="circle_privacy">
                            @foreach($data['whocan'] as $whocan)
                            @if($data['employee_setting']->circle_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your full name</label>
                        <select class="form-control" name="name_privacy">
                            @foreach($data['whocan'] as $whocan)
                            @if($data['employee_setting']->name_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Who can see your rank and score</label>
                        <select class="form-control" name="score_privacy">
                            @foreach($data['whocan'] as $whocan)
                            @if($data['employee_setting']->score_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="social_links">
                    <div  class="form-group row ">
                        <div class="col-12">
                            <h3 class="form_heading">Share you social links</h3>
                        </div>
                    </div>
                    @php($social_row = 0)
                    @if(count($data['socials']) > 0)
                    @foreach($data['socials'] as $social)
                     <div id="social_row{{$social_row}}" class="form-group row ">
                        <div class="col-md-4">
                            <label class="required">Title</label>
                            <input type="text" name="social[{{$social_row}}][title]" class="form-control" placeholder="Facebook" value="{{$social->title}}">
                        </div>
                        <div class="col-md-8">
                            <label class="required">URL</label>
                            <div class="input-group">

                                  <input name="social[{{$social_row}}][url]" class="form-control" placeholder="https://www.facebook.com" type="url" value="{{$social->url}}">
                                    <span class="input-group-btn">
                                      <button class="btn btn-danger delete_desc" onclick="$('#social_row{{$social_row}}').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            
                           
                        </div>
                    </div>
                    @php($social_row++)
                    @endforeach
                    @else
                    <div id="social_row{{$social_row}}" class="form-group row ">
                        <div class="col-md-4">
                            <label class="required">Title</label>
                            <input type="text" name="social[{{$social_row}}][title]" class="form-control" placeholder="Facebook">
                        </div>
                        <div class="col-md-8">
                            <label class="required">URL</label>
                            <div class="input-group">

                                  <input name="social[{{$social_row}}][url]" class="form-control" placeholder="https://www.facebook.com" type="url">
                                    <span class="input-group-btn">
                                      <button class="btn btn-danger delete_desc" onclick="$('#social_row{{$social_row}}').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            
                           
                        </div>
                    </div>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn bluebg sendbtn">
                        Update <i class="fa fa-paper-plane"></i>
                        </button>
                        <button type="button" onclick="addMoreLinks();" data-toggle="tooltip" title="Add More Links" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Links</button>
                    </div>
                </div>
                     
                  

                 
                  </form>
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


</body>
</script>
    <!-- Script for dropdown hover menu -->
 <script src="{{asset('js/profile-custom.js')}}" type="text/javascript"></script>
<script type="text/javascript">
   
   
    
     @if (Session::has('alert-danger') || Session::has('alert-success'))
  $(document).ready(function(){
    $("#modal_message").modal("show");
  });
  @endif
    </script>
  <script src="{{asset('js/employer/popper.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
  </html>