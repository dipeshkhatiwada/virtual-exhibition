


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;" rel="stylesheet"> 
</head>

<body style="padding:0px; margin:0px; font-family: 'Roboto', sans-serif;  padding-bottom: 30px; font-size:12px; color:#555; background-color:#edf0f3;">
  <div style="width: 90%; position: relative; margin:50px auto; background-color:#f6f8fa; border-radius:3px 3px 0px 0px; box-shadow:0px 2px 4px rgba(0,0,0,.25);">
    <div style="float:left; border-bottom:1px solid #daf4fc; position:relative; width:98%; background:url({{asset('image/headerbg.png')}}) repeat-x; padding:1% 1% 0% 1%; border:3px 3px 0px 0px;">
      <div style="width:50%; float:left; position: relative;">
        <h3 style="padding:0px 10px; color:#008bb5; font-size:19px;">Matching Alert</h3>
      </div>
      <div style="width:50%; float:right; position: relative; text-align:right;">
        <img src="{{asset('image/nexus_logo.png')}}" style="margin-top:5px; margin-right:5px;">
      </div>
    </div>
     <div style="padding:0px 20px; color:#333; font-size:14px; float:left">
      <p>
        <span style="color:#555; font-weight:800;">Dear {{$content['to_name']}},</span> <br>
        <span style="padding:20px 0px 10px 0px; float:left; color:#008bb5;">Following are the recommended jobs that matches your preferred choice of job category. </span>
      </p>
      <div style="padding-bottom:20px;">Click on the job to apply or visit <a href="url('/jobs')" style="color:#008bb5;">rollingnexus.com</a> to browse all job postings.</div>
    </div>
   
   
   
    <div style="clear:both;"></div>
     <div style="background-color:#028cb4; padding:10px 20px; text-align:left; color:#fff; font-size:24px;margin-top:5px;">Jobs</div>
    <div style="clear:both;"></div>
    @foreach($content['jobs'] as $job)
    <div style="background-color:#fff; padding:1% 3%; border-bottom:1px solid #e7e7e7; width:94%; float:left; margin-bottom:2px;">
      <div style="width:17%; float:left; position:relative; overflow: hidden;">
      	
      	<img src="{{$job['employer_logo']}}" style="width:100%;">
      	
      </div>
      <div style="width:83%; line-height:5px; float:right;">
        <div style="margin-left:10px; float:none; margin-top:-5px;">
        <p style="font-size:15px; font-weight:600;">{{$job['job_title']}}</p>
        <p style="color:#008bb5;">{{$job['employer_name']}}</p>
          <p>Opening Date : {{$job['publish_date']}} <span style="font-weight:600; color:#333;">To</span> 
          <span style="color:#8ad161">{{$job['deadline']}}</span>
          <a href="{{$job['job_url']}}" style="border:1px solid #e3e3e3; color:#666666; border-radius:30px;float:right; padding:10px 15px; text-decoration:none; margin-top:-20px;">Apply</a></p>
      </div>
    </div>
    </div>
    
    @endforeach

    @if(count($content['projects']) > 0)
    <div style="padding:0px 20px; color:#333; font-size:14px; float:left">
      <p>
       
        <span style="padding:20px 0px 10px 0px; float:left; color:#008bb5;">Following are the recommended Projects that matches your skill with project. </span>
      </p>
      <div style="padding-bottom:20px;">Click on the project to apply or visit <a href="url('/projects')" style="color:#008bb5;">rollingnexus.com</a> to browse all project postings.</div>
    </div>
   
  
    <div style="clear:both;"></div>
     <div style="background-color:#028cb4; padding:10px 20px; text-align:left; color:#fff; font-size:24px;margin-top:5px;">Projects</div>
    <div style="clear:both;"></div>
    @foreach($content['projects'] as $project)
    <div style="background-color:#fff; padding:1% 3%; border-bottom:1px solid #e7e7e7; width:94%; float:left; margin-bottom:2px;">
      <div style="width:17%; float:left; position:relative; overflow: hidden;">
      	
      	<img src="{{asset('/images/no-image.png')}}" style="width:100%;">
      	
      </div>
      <div style="width:83%; line-height:5px; float:right;">
        <div style="margin-left:10px; float:none; margin-top:-5px;">
        <p style="font-size:15px; font-weight:600;">{{$project['title']}}</p>
        <p style="color:#008bb5;">{{$project['skills']}}</p>
          <p>Opening Date : {{$project['publish_date']}} 
          <a href="{{$project['href']}}" style="border:1px solid #e3e3e3; color:#666666; border-radius:30px;float:right; padding:10px 15px; text-decoration:none; margin-top:-20px;">Apply</a></p>
      </div>
    </div>
    </div>
    
    @endforeach
    @endif

    @if(count($content['events']) > 0)
    <div style="padding:0px 20px; color:#333; font-size:14px; float:left">
      <p>
       
        <span style="padding:20px 0px 10px 0px; float:left; color:#008bb5;">Following are the recommended Events that matches your locations. </span>
      </p>
      <div style="padding-bottom:20px;">Click on the event to apply or visit <a href="url('/events')" style="color:#008bb5;">rollingnexus.com</a> to browse all event postings.</div>
    </div>
    <div style="clear:both;"></div>
     <div style="background-color:#028cb4; padding:10px 20px; text-align:left; color:#fff; font-size:24px;margin-top:5px;">Events</div>
    <div style="clear:both;"></div>
    @foreach($content['events'] as $event)
    <div style="background-color:#fff; padding:1% 3%; border-bottom:1px solid #e7e7e7; width:94%; float:left; margin-bottom:2px;">
      <div style="width:17%; float:left; position:relative; overflow: hidden;">
      	
      	<img src="{{$event['image']}}" style="width:100%;">
      	
      </div>
      <div style="width:83%; line-height:5px; float:right;">
        <div style="margin-left:10px; float:none; margin-top:-5px;">
        <p style="font-size:15px; font-weight:600;">{{$event['title']}}</p>
        <p style="color:#008bb5;">{{$event['publish_by']}}</p>
          <p>Opening Date : {{$event['publish_date']}} <span style="font-weight:600; color:#333;">To</span> 
          <span style="color:#8ad161">{{$event['deadline']}}</span>
          <a href="{{$event['href']}}" style="border:1px solid #e3e3e3; color:#666666; border-radius:30px;float:right; padding:10px 15px; text-decoration:none; margin-top:-20px;">Apply</a></p>
      </div>
    </div>
    </div>
    
    @endforeach
    @endif

     @if(count($content['trainings']) > 0)
     <div style="padding:0px 20px; color:#333; font-size:14px; float:left">
      <p>
       
        <span style="padding:20px 0px 10px 0px; float:left; color:#008bb5;">Following are the recommended Trainings that matches your locations. </span>
      </p>
      <div style="padding-bottom:20px;">Click on the training to apply or visit <a href="url('/trainings')" style="color:#008bb5;">rollingnexus.com</a> to browse all training postings.</div>
    </div>
    <div style="clear:both;"></div>
     <div style="background-color:#028cb4; padding:10px 20px; text-align:left; color:#fff; font-size:24px;margin-top:5px;">trainings</div>
    <div style="clear:both;"></div>
    @foreach($content['trainings'] as $training)
    <div style="background-color:#fff; padding:1% 3%; border-bottom:1px solid #e7e7e7; width:94%; float:left; margin-bottom:2px;">
      <div style="width:17%; float:left; position:relative; overflow: hidden;">
      	
      	<img src="{{$training['image']}}" style="width:100%;">
      	
      </div>
      <div style="width:83%; line-height:5px; float:right;">
        <div style="margin-left:10px; float:none; margin-top:-5px;">
        <p style="font-size:15px; font-weight:600;">{{$training['title']}}</p>
        <p style="color:#008bb5;">{{$training['publish_by']}}</p>
          <p>Opening Date : {{$training['publish_date']}} <span style="font-weight:600; color:#333;">To</span> 
          <span style="color:#8ad161">{{$training['deadline']}}</span>
          <a href="{{$training['href']}}" style="border:1px solid #e3e3e3; color:#666666; border-radius:30px;float:right; padding:10px 15px; text-decoration:none; margin-top:-20px;">Apply</a></p>
      </div>
    </div>
    </div>
    
    @endforeach
    @endif
        
            <div style="clear: both;"></div>
<div style="padding:0px 20px; text-align:center; margin:0px;">
  <div style="padding:20px 0px;">You are receiving this email because you have subscribed to 'Job Alert' feature of <span style="color:#008bb5;">Rolling Nexus.</span></div>
    <div style="color:#008bb5; padding-bottom:20px;">
      <a href="{{url('/employee/editprofile')}}" style=" border-right:1px solid #999; padding-right:20px; margin:0px; color:#008bb5; text-decoration:none;">Unsubscribe from Job Alert</a>  
      <a href="{{url('/employee/editprofile')}}" style="padding-left:20px; color:#008bb5; text-decoration:none;">Manage my email Subscription</a>
    </div>
</div>
        <div style="text-align:center; float:left; width:100%;">
          
          <p style="padding:10px 0px; background-color:#008bb5; color:#fff; margin: 0px;">&copy; 2010-{{date('Y')}} Rolling Nexus. All Right Reserved. <a href="{{url('/web/article/Privacy-Policy-Individual-Account')}}" style="color:#fff;">Privacy Policy</a>
          </p></div>
    <div style="clear:both;"></div>
    
  </div>
</body>
</html>