


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;" rel="stylesheet"> 
</head>

<body style="padding:0px; margin:0px; font-family: 'Roboto', sans-serif;  padding-bottom: 30px; font-size:12px; color:#555; background-color:#edf0f3;">
  <div style="width: 40%; position: relative; margin:50px auto; background-color:#f6f8fa; border-radius:3px 3px 0px 0px; box-shadow:0px 2px 4px rgba(0,0,0,.25);">
    <div style="float:left; position:relative; width:98%;  padding:1% 1% 0% 1%; border:3px 3px 0px 0px;">
      
      
      <div style="width:25%; float:left; position: relative;">
          <img src="{{asset('image/nexus_logo.png')}}" style="margin-top:7px; margin-left:10px;">
      </div>
    </div>
    <div style="text-align:center; float:left; background-color:#fff;">
      <p style="padding:0px 20px; color:#008bb5; font-size:14px;">The following job is recommended by your friend <?php echo $data['name'];?></p>
      <p style="padding:10px 20px; background-color:#008bb5; color:#fff;"><?php echo $data['message']; ?></p></div>
    <div style="clear:both;"></div>
   
    <div style="clear:both;"></div>
    <div style="background-color:#fff; padding:1% 3%; border-bottom:1px solid #e7e7e7; width:94%; float:left; margin-bottom:2px;">
      <div style="width:17%; float:left; position:relative; overflow: hidden;">
      	@if($data['employer_logo'] != '')
      	<img src="{{$data['employer_logo']}}" style="width:100%;">
      	@else
      	<div style="width:170px; height:170px; color:#fff; font-size:70px; text-align:center; line-height:170px; font-weight:500;">{{$data['employer_fl']}}</div>
      	@endif
      </div>
      <div style="width:83%; line-height:5px; float:right;">
        <div style="margin-left:10px; float:none; margin-top:-5px;">
        <p style="font-size:15px; font-weight:600;">{{$data['job_title']}}</p>
        <p style="color:#008bb5;">{{$data['employer_name']}}</p>
          <p>Opening Date : {{$data['publish_date']}} <span style="font-weight:600; color:#333;">To</span> 
          <span style="color:#8ad161">{{$data['deadline']}}</span>
          <a href="{{$data['job_url']}}" style="border:1px solid #e3e3e3; color:#666666; border-radius:30px;float:right; padding:10px 15px; text-decoration:none; margin-top:-20px;">Apply</a></p>
      </div>
    </div>
    </div>
    
    
        

        <div style="text-align:center; float:left; width:100%;">
          
          <p style="padding:10px 0px; background-color:#008bb5; color:#fff; ">&copy; 2010-{{date('Y')}} Rolling Nexus. All Right Reserved. <a href="#" style="color:#fff;">Privacy Policy</a>
          </p></div>
    <div style="clear:both;"></div>
    
  </div>
</body>
</html>