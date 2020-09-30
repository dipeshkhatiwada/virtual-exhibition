<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $datas['store_name']; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;">

  <p style="margin-top: 0px; margin-bottom: 20px;">Thank you for Applying {{$datas['job_title']}}. Please Click on The link or Copy this link to your brouser for validate your E-mail.</p>
  
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="{{url('/jobs/validate-email?email='.$datas['email'].'&token='.$datas['validation_token'])}}">{{url('/jobs/validate-email?email='.$datas['email'].'&token='.$datas['validation_token'])}}</a></p>
 Thank you
  
</div>
</body>
</html>