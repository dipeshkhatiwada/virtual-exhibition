<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title><?php echo $data['store_name']; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;">
  <p style="margin-top: 0px; margin-bottom: 20px;">Please Click on The link or Copy this link to your brouser.</p>
  
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="{{url('/employer/passwordreset?email='.$data['email'].'&token='.$data['token'])}}">{{url('/employer/passwordreset?email='.$data['email'].'&token='.$data['token'])}}</a></p>
 Thank you
  
  
  
</div>
</body>
</html>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;" rel="stylesheet"> 
</head>

<body style="padding:0px; margin:0px; font-family: 'Roboto', sans-serif;  padding-bottom: 30px; font-size:12px; color:#555;background-color:#edf0f3;">
  <div style="width: 40%; position: relative; margin:50px auto; background-color:#f6f8fa; border-radius:3px 3px 0px 0px; box-shadow:0px 2px 4px rgba(0,0,0,.25);">
    <div style="float:left; border-bottom:1px solid #daf4fc; position:relative; width:98%; background:url({{asset('image/headerbg.png')}}) repeat-x; padding:1% 1% 0% 1%; border:3px 3px 0px 0px;">
      <div style="width:50%; float:left; position: relative;">
        <h3 style="padding:0px 10px; color:#008bb5; font-size:19px;">Reset Password</h3>
      </div>
      <div style="width:50%; float:right; position: relative; text-align:right;">
        <img src="{{asset('image/nexus_logo.png')}}" style="margin-top:5px; margin-right:5px;">
      </div>
    </div>
    <div style="clear:both;"></div>
    <div style="width:94%; padding:0% 3%;">
      <h4 style="color:#008bb5; font-size:14px; font-weight:500; padding-top:0px; margin:15px 0px 10px 0px;">Dear User,</h4>
      <p>Click on the following link to create a new password for your <span style="color:#008bb5;">rollingnexus.com</span> account</p>
      <div style="text-align:center; padding:20px 0px;">
        <a href="{{url('/employer/passwordreset?email='.$data['email'].'&token='.$data['token'])}}" style="background-color:#008bb5; padding:7px 15px; text-decoration:none; color:#fff; border-radius:3px 3px 3px 3px; font-size:14px;">Create a new password</a>
      </div>
        <div style="font-size:12px; color:#333; line-height:10px;">
        <p>Above link appearing as text ? Move this email to Inbox folder.</p>
        <p>If the above link doesn't work, try the following:</p>
      </div>
      <ul style="font-size:12px; color:#555;">
        <li>Right click on the 'Create a new password' link. Select 'Copy link location' & paste the URL in the address bar.</li>
      </ul>
    <div style="padding-top:7px;">
      <p style="font-size:12px; color:#555;"><span style="color:#008bb5; font-weight:500;">Note:</span> This link will be functional for a one time use or 72 hours (whichever is earlier)</p>
    </div>
    <div style="padding-top:7px; line-height:10px; padding-bottom:20px; font-size:12px; color:#555;">
      <p style="color:#333; font-weight:500;">Regards,</p>
      <p><span style="color:#008bb5">Rollingnexus.com</span> Team</p>
    </div>
    </div>
  </div>
</body>
</html>