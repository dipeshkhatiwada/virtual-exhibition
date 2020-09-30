@extends('front.job-master')
@section('header')
<link rel="stylesheet" href="{{asset('css/'.$datas['employer']->color.'.css')}}">
<?php if ($datas['employer_banner'] != '') {
$style = "background:url('".$datas['employer_banner']."'); background-attachment: fixed; background-size: 100%;";
} else{
$style = '';
} ?>
<header class=""><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <div class="container">
    <div class="row cm-row">
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-xs">
        <a href="{{$datas['menu_url']}}"><img src="{{$datas['menu_logo']}}"></a>
      </div>
      <div class="col-lg-7 col-md-7 col-3">
        <nav class="navbar navbar-expand-sm navbar-light mainmenu stick-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
              </span>
          </button>
          <div class="collapse navbar-collapse mainNav inner_nav" id="navbarNav">
            <ul class="navbar-nav nav-pills">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Home</a>
              </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{url('/jobs')}}">Job</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/tenders')}}">Tender</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/projects')}}">Project</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/trainings')}}">Training</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/skill-test')}}">Test</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/events')}}">Event</a>
                </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-lg hidden-md">
        <a href="{{url('/jobs')}}"><img src="{{\App\library\Settings::getJobLogo()}}"></a>
      </div>
      <div class="col-lg-3 col-md-3 col-6">
        <div class="float-right loginbtns tp11p">
          @if(isset(Auth::guard('employer')->user()->name))
          <a href="{{url('/employer/dashboard')}}" target="_blank" title="{{\App\Employers::getName(Auth::guard('employer')->user()->employers_id)}}"><span class="user-image"><img src="{{asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))}}"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
            <a class="btn ipadloginbtns" href="{{url('/employer/logout')}}" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"><strong> Logout</strong></span></a>
         
          @elseif(isset(Auth::guard('employee')->user()->firstname))
          <a href="{{url('/employee/dashboard')}}" title="Dashboard" target="_blank"><span class="user-image"><img src="{{asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))}}"></span><span class="hidden-md hidden-xs"> <strong>{{\App\Employees::getName(Auth::guard('employee')->user()->id)}}</strong></span></a>
            <a class="btn ipadloginbtns" href="{{url('/employee/logout')}}" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"><strong> Logout</strong></span></a>
          @else
          <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
          <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
          @endif
        </div>
      </div>
      
    </div>
  </div>
</header>
<section class="brand_banner tp60p" style="<?php echo $style;?>">
    <div class="brand_logo">
       @if($datas['employer_logo'] != '')
                   <img src="{{asset($datas['employer_logo'])}}" >
                @else
                <div class="noimage_circle backgroundcolor-{{$datas['fletter']}}"><a href="{{url('/'.$datas['employer_url'])}}"> {{$datas['fn']}}</a></div>
                @endif
     
    </div>
    <div class="brand_menu">
      <div class="container">
        <div class="row cm-row">
          <div class="col-lg-10 col-md-9 col-4">
        <nav class="navbar navbar-expand-sm brandmenu stick-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#brandNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>
          <div class="collapse navbar-collapse brandNav" id="brandNav">
            <ul class="navbar-nav nav-pills">
              
              <li class="nav-item">
              <a class="nav-link {{$datas['tab'] == 'job' ? 'active' : ''}}" href="{{ url('/'.$datas['employer']->seo_url.'?tab=job')}}">Job</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'tender' ? 'active' : ''}}" href="{{$datas['tab'] != 'tender' ? url('/'.$datas['employer']->seo_url.'?tab=tender') : '#'}}">Tender</a>
              </li>
            
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'training' ? 'active' : ''}}" href="{{$datas['tab'] != 'training' ? url('/'.$datas['employer']->seo_url.'?tab=training') : '#'}}">Training</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'event' ? 'active' : ''}}" href="{{$datas['tab'] != 'event' ? url('/'.$datas['employer']->seo_url.'?tab=event') : '#'}}">Event</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'about' ? 'active' : ''}}" href="{{$datas['tab'] != 'about' ? url('/'.$datas['employer']->seo_url.'?tab=about') : '#'}}">About Us</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'blog' ? 'active' : ''}}" href="{{$datas['tab'] != 'blog' ? url('/'.$datas['employer']->seo_url.'?tab=blog') : '#'}}">Blogs</a>
              </li>
            </ul>
          </div>
          </nav>
        </div>
        <div class="col-lg-2 col-md-3 col-8">
          <div class="tp10p float-right">
            @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas['employer']->id}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>

@stop
@section('banner')

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

<section class="tb30p">
    <div class="container">
      <div class="row">
      <div class="col-lg-9 col-md-9 col-12">
        <div class="job_detail">
          <h1 class="title_one" style="margin-bottom: 20px;">{{$datas['job']->title}}</h1>
          <div class="short_descp">
            <div class="row btm10p">
                  <div class="col-md-12">
            @if(count($datas['jobs_location']) > 0)
            <span><i class="fa fa-map-marker-alt"></i> 
              @foreach($datas['jobs_location'] as $location)
              {{$location->name}},
              @endforeach
            </span>
            @endif
            </div>
            </div>
            <span><i class="fa fa-hand-point-right"></i> {{$datas['job']->job_availability}}</span>
            <span class="lft40m"><i class="far fa-clock"></i> {{$datas['created']}}</span>
            @if($datas['job']->minimum_salary != '')
            <span class="lft40m"><i class="far fa-money-bill-alt"></i> {{$datas['salary']}}</span>
            @endif
             <span class="lft40m"> {{\App\JobType::getTitle($datas['job']->job_type)}}</span>
             <span class="lft40m"> <i class="fa fa-eye"></i></span> {{$datas['job']->views}}</span>
          </div>
          <h3 class="title_one tp35p btm10p">Job Detail</h3>
          <div class="row cm1-row btm35p">
            @if(!empty($datas['job_category']))
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-th-list"></i></span></div>
                        <div class="col-md-9 col-9">
                  <p>Category</p>
                  <span class="bold">{{$datas['job_category']}}</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if(!empty($datas['job']->gender))
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="far fa-user"></i></span></div>
                        <div class="col-md-9 col-9">
                  <p>Gender</p>
                  <span class="bold">{{$datas['job']->gender}}</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if($datas['job']->position != 0)
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                        
                         <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="far fa-calendar-check"></i></span></div>
                        <div class="col-md-9 col-9 ">
                  <p>No. Of openings</p>
                  <span class="bold">{{$datas['job']->position}}</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
            @if(!empty($datas['job_level']))
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                        
                         <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-sitemap"></i></span></div>
                        <div class="col-md-9 col-9">
                  <p>Job Level</p>
                  <span class="bold">{{$datas['job_level']}}</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
           <?php $exp = $datas['job']->min_experience;?>
             @foreach($datas['job_education'] as $education)
                @if($education->experience > 0)
                <?php $exp = $education->experience;?>
               
                @endif
             @endforeach
            
             @if($exp > 0)
           <?php $tot = count($datas['job_education']); $i = 1 ; ?>
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                     <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-briefcase"></i></span></div>
                        <div class="col-md-9 col-9">
                        
                  <p>Job Experience</p>
                  <span class="bold">
                      @if($datas['job']->min_experience > 0)
                      {{$datas['job']->min_experience}} Year(s)
                    
                    @elseif($tot > 0)
                                                    @foreach($datas['job_education'] as $education)
                                                    @if($education->experience > 0)
                                                    <?php $faculty = \App\Faculty::getTitle($education->faculty_id); ?>
                                                    {{\App\EducationLevel::getTitle($education->education_level_id)}} {{ $faculty != '' ? ' in '.$faculty : '' }} >
                                        
                                                    
                                        {{$education->experience}} Years @if($tot != $i) OR <br>@endif
                                                    <?php $i++; ?>
                                                    @endif
                                                    @endforeach
                                
                          
                        @endif
                        
                        </span>
                </div>
                </div>
                </div>
              </div>
            </div>
            @endif
            @if(count($datas['job_education']) > 0)
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-graduation-cap"></i></span></div>
                        <div class="col-md-9 col-9">
                  <p>Education</p>
                  <span class="bold">
                    <?php $tedu = count($datas['job_education']); $j = 1; ?>
                    @foreach($datas['job_education'] as $education)
                                                    
                                                    <?php $faculty = \App\Faculty::getTitle($education->faculty_id); ?>
                                                    {{\App\EducationLevel::getTitle($education->education_level_id)}} {{ $faculty != '' ? ' in '.$faculty : '' }} 
                                        
                                                    
                                       @if($tedu != $j) / @endif
                                                    <?php $j++; ?>
                                                   
                                                    @endforeach</span>
                </div>
                </div>
                </div>
              </div>
            </div>
            @endif
            
            @if($datas['job']->min_age)
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-hourglass-half"></i></span></div>
                        <div class="col-md-9 col-9">
                        
                  <p>Minimum Age</p>
                  <span class="bold">{{$datas['job']->min_age}} Years</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            
            @endif
            @if($datas['job']->fmax_age)
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-hourglass-start"></i></span></div>
                        <div class="col-md-9 col-9">
                        
                  <p>Maximum Age (Fresher)</p>
                  <span class="bold">{{$datas['job']->fmax_age}} Years</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
             @if($datas['job']->emax_age)
            <div class="col-lg-4 col-md-6 col-12">
              <div class="white_div tp2m greybg">
                <div class="job_shortinfo">
                    <div class="row">
                        <div class="col-md-3 col-3 center"><span class="blueclr jdicon"><i class="fa fa-hourglass-end"></i></span></div>
                        <div class="col-md-9 col-9">
                        
                  <p>Maximum Age (Experienced)</p>
                  <span class="bold">{{$datas['job']->emax_age}} Years</span>
                  </div>
                  </div>
                </div>
              </div>
            </div>
            @endif
          </div>
          @if(!empty($datas['job_description']->description))
          <div class="job_description">
            <h1 class="title_one btm15m">Job Description</h1>
            
            <?php echo $datas['job_description']->description; ?>
            
            
            
          </div>
          @endif
          
          @if($datas['job']->image != '')
                                    <div class="job_description">
                                   <div class="row" style="margin-bottom: 20px;">
                                        <div class="col-md-3">
                                    
                                            
                                            <img id="v-image" src="{{asset('/image/'.$datas['job']->image)}}" style="cursor: pointer; width:100%">
                                           
                                        </div>
                                        
                                         
                                       
                                        
                                        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="z-index:99999999;">
                                          <div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
                                            <div class="modal-content"  >              
                                              <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <img src="{{asset('/image/'.$datas['job']->image)}}" class="imagepreview" style="width: 100%;" >
                                              </div> 
                                           
                                        
                                        
                                            </div>
                                          </div>
                                        </div>
                                        <script type="text/javascript">
                                        
                                                    $('#v-image').on('click', function() {
                                                       
                                                        $('#imagemodal').modal('show');   
                                                       
                                                    });     
                                         
                                           
                                        </script>
                                    </div>
                                    </div>
                                   
                                    @endif
                         @if($datas["job"]->external_link == ''  && $datas["job"]->emails == '')           
                                    <hr>
         <div class="job_description" style="background-color:#f9f9f9; padding:0px 10px">
                                   <div class="row tb20p">
                                        <div class="col-md-12">
                                            <div style="text-align: justify;">
                                                <h3 class="title_one" style="color:#0066ff; padding-bottom:10px;">HOW TO APPLY</h3>
All applications must be submitted through online system. Applicant should register and signup to apply this vacancy. The system will send you an email for your email validation, please check your email for validation and follow the instruction for further process to go-ahead for applying job.<br />
<strong>Getting started</strong><br />
You must duly fill all the asterisked (*) field to apply for job requirement. This includes filling in personal information, education, experience, languages, skills and other information as required. You may fill/ answer few answer of some specific questions asked by the system for some job positions. Make sure that the application for a specific vacancy is submitted before the closing date.<br />
<strong>Submitting an application</strong><br />
Once you read all the requirements for the job position, you can apply to specific vacancy. Please make sure that you only apply to position. At this point, you may be asked to fill your name, valid email address and your contact cell number to upload documents relevant to a particular vacancy. Once you are done, click the &lsquo;Submit application&rsquo; button. (This section may not apply for some job positions)<br />
Some of the job positions are re-direct to main employer for application submission.<br />
<strong>Recruitment process</strong><br />
Once the vacancy announcement posting has passed, the applications are thoroughly reviewed and processing for shortlisting. If you are shortlisted you may be invited for an assessment. The hiring unit will contact you if that is the case through Email and/or SMS and/or Telephone for further selection process.<br />
The assessments vary depending of the specific function, however it will often start with a technical assessment/s followed by a competency based interview.</div>

                                            </div>
                                    </div>
                            </div>
            @endif
                             <hr>
          <div class="recommendation tp20p">
             <a class="large_bluebtn" data-toggle="modal" data-target="#recomendModal">Recommend to your friend</a>
            @if($datas['job']->job_file != '')
            <a href="{{asset('/image/'.$datas['job']->job_file)}}" download class="large_bluebtn" style="background: #5dc121; border: 1px solid #5dc121;">Download ToR</a> 
                                    @endif
            <div class="modal fade" id="recomendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
              <form action="#" method="post" enctype="multipart/form-data" id="contact" class="form-contact">
                <div class="modal-content recommend_form">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recommend to your friend</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="job_url" value="{{url('/jobs/'.$datas['employer_url'].'/'.$datas['job']->seo_url)}}" />
                    {!! csrf_field() !!}
                    <input type="hidden" name="employer_url" value="{{url('/'.$datas['employer_url'])}}" />
                    <input type="hidden" name="employer_logo" value="{{$datas['employer_logo']}}" />
                    <input type="hidden" name="employer_fl" value="{{$datas['fn']}}" />
                    <input type="hidden" name="employer_name" value="{{$datas['employer_name']}}">
                    <input type="hidden" name="job_title" value="{{$datas['job']->title}}">
                    <input type="hidden" name="publish_date" value="{{$datas['created']}}">
                    <input type="hidden" name="deadline" value="{{$datas['deadline']}}">
                    <fieldset>
                      <div class="contact-label">
                        <label for="input-name" class="required"> Your Name</label>
                        <div>
                          <input type="text" name="name" value="" id="input-name" class="form-control" />
                        </div>
                      </div>
                      <div class="contact-label">
                        <label for="input-email" class="required"> Your E-Mail Address</label>
                        <div>
                          <input type="text" name="from_email" value="" id="from-email" class="form-control" />
                        </div>
                      </div>
                      <div class="contact-label">
                        <label for="input-friend" class="required"> Friend's Name</label>
                        <div>
                          <input type="text" name="friend_name" value="" id="friend-name" class="form-control" />
                        </div>
                      </div>
                      <div class="contact-label">
                        <label for="input-email" class="required"> Friend's E-Mail Address</label>
                        <div>
                          <input type="text" name="to_email" value="" id="to-email" class="form-control" />
                        </div>
                      </div>
                      <div class="contact-label">
                        <label for="input-enquiry" class="required"> Message to Friend</label>
                        <div>
                          <textarea name="enquiry" rows="7" id="input-enquiry" class="form-control"></textarea>
                        </div>
                      </div>
                    </fieldset>
                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn bluebtn" data-dismiss="modal">Close</button>
                    <button id="sub_mit" class="btn greenbtn" type="submit">Submit</button>
                    
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
          <script type="text/javascript">
                    function IsEmail(email) {
                    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                    return regex.test(email);
                    }
                    $('#sub_mit').on('click', function(){
                    var valid = true;
                    
                    if($('#input-name').val().length < 3 || $('#input-name').val().length > 32){
                    $('#input-name').addClass("error");
                    valid = false;
                    } else {
                    $('#input-name').removeClass("error");
                    }
                    if($('#friend-name').val().length < 3 || $('#friend-name').val().length > 32){
                    $('#friend-name').addClass("error");
                    valid = false;
                    } else {
                    $('#friend-name').removeClass("error");
                    }
                    if(IsEmail($('#from-email').val())) {
                    $('#from-email').removeClass("error");
                    } else {
                    $('#from-email').addClass("error");
                    valid = false;
                    }
                    
                    if(IsEmail($('#to-email').val())) {
                    $('#to-email').removeClass("error");
                    } else {
                    $('#to-email').addClass("error");
                    valid = false;
                    }
                    if($('#input-enquiry').val().length < 10 || $('#input-enquiry').val().length > 3000){
                    $('#input-enquiry').addClass("error");
                    valid = false;
                    } else {
                    $('#input-enquiry').removeClass("error");
                    }
                    if(valid) {
                    $('#sub_mit').html('Loading <i class="fa fa-spinner fa-spin"></i>').attr("disabled", true);
                    $.ajax({
                    type: "POST",
                    url: "{{url('/refer_friend')}}",
                    data: $("#contact").serialize(), // serializes the form's elements.
                    
                    success: function(data)
                    {
                    alert(data); // show response from the php script.
                    $('#sub_mit').html('Submit').attr("disabled", false);
                    $('#recomendModal').modal('hide');
                    //$.magnificPopup.close();
                    }
                    });
                    return false;
                    } else {
                    return false;
                    }
                    });
                    </script>
          <div class="tp20m share-button">
            <span class="greenclr"><i class="fa fa-share-alt"></i></span>
            <script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script>
            <span class="facebook"><a href="http://www.facebook.com/share.php?u=<{{$datas['url']}}>" onclick="return fbs_click()" target="_blank"><i class="fab fa-facebook-square"></i></a></span>
            <span class="twitter"><ahref="http://twitter.com/home?status=Currentlyreading {{$datas['url']}}" target="_blank" data-original-title="twitter"><i class="fab fa-twitter-square"></i></a></span>
            <span class="linkedin"><a href="http://www.linkedin.com/shareArticle?mini=true&url={{$datas['url']}}&title={{$datas['job']->title}}&source={{$datas['url']}}" target="_blank" data-original-title="linkedin"><i class="fab fa-linkedin"></i></a></span>
          </div>
       
        @foreach($datas['main_modules'] as $main_module)
                <?php echo $main_module['module']; ?>
                @endforeach
      </div>

       </div>
            <aside class="col-lg-3 col-md-3 col-12">
        <div class="row cm10-row btm5m ">
          <div class="col-lg-12 col-md-12 col-7">
          <div class="deadline">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-4">
                <i class="fa fa-clock"></i>
              </div>
              <div class="col-lg-9 col-md-8 col-8">
                <p class="greenclr">Deadline</p>
                <span class="bold">{{$datas['deadline']}}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-5 tp20m">
          <div class="center">
              @if($datas["job"]->external_link != '')
              <a target="_blank" href="{{$datas["job"]->external_link}}" class="large_greenbtn">Apply</a>
              @elseif($datas["job"]->emails != '')
              <a href="mailto:{{$datas["job"]->emails}}" class="large_greenbtn">Apply</a>
              @elseif(isset(Auth::guard('employee')->user()->firstname)))
               
              <a href="{{url('/employee/jobapply/'.$datas["job"]->seo_url)}}" class="large_greenbtn">Apply</a>
              
              
              @else
              <a class="large_greenbtn tp15m" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login</a>
              @endif
            
          </div>
        </div>
      </div>
        @if(count($datas['related_jos']) > 0)
        <div class="white_div tp10m btm7m">
          <h3 class="h3 btm15m">Related Jobs</h3>
          @foreach($datas['related_jos'] as $job)
          <div class="jobpost">
            <div class="row cm10-row tb10p">
              <div class="col-md-1 col-1">
                <div class="complogo greenclr">
                    <i class="fa fa-search-location"></i>
                  <!--<a href="{{url('/jobs/'.$datas['employer_url'].'/'.$job->seo_url)}}"><img src="{{$datas['employer_logo']}}" alt="{{$datas['employer_name']}}"></a>-->
                </div>
              </div>
              <div class="col-md-11 col-11">
                <p class="company_name">
                    <a href="{{url('/jobs/'.$datas['employer_url'].'/'.$job->seo_url)}}">{{$job->title}}</a>
                </p>
              </div>
            </div>
          </div>
          @endforeach
          
          
        </div>
        @endif
        
         @if(count($datas['advertise_left']) > 0)

         <div class="advertisement row cm-row btm7m tp15m">
            @foreach($datas['advertise_left'] as $advertise)
            <div class="text-center col-md-12 tb5p ">
                <a href="{{$advertise->href}}" title="{{$advertise->title}}" target="_blank">
                    <img src="{{asset('/image/'.$advertise->image)}}" class="lazy img-fluid" alt="{{$advertise->title}}" style="width: 100% !important;">
                </a>
                </div>
               
            @endforeach 
      </div>
         @endif
      </aside>
           
      
    </div>
    </div>
  </section>

<!-- job block section ended here -->
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
    <div class="container rn_container">
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
<script type="text/javascript">
function followEmployer(emid)
{
var token = $('input[name=\'_token\']').val();
if (emid != '') {
$.ajax({
type: "POST",
url: "{{ url('employee/followemployer') }} ",
data: 'id='+emid+'&_token='+token,
success: function(data){

location.reload();

}
});
}
}

function viewNoticeDetail(id) {
  $('#notice'+id).modal('show');
}
</script>
@stop

