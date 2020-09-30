<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;">

  <p style="margin-top: 0px; margin-bottom: 20px;">Dear {{$datas['name']}}, </p>
  <p style="margin-top: 0px; margin-bottom: 20px;">{{$datas['employee_name']}} add you as a reference on his profile. You are/were {{$datas['designation']}} in {{$datas['company']}}. We want to conform that he/she was working on your company/organization. Please click below (Click Here) button to conform.  </p>
  
  <a href="{{url('referencevalidation?email='.$datas['employee_email'].'&ref_email='.$datas['to_email'])}}" style=" background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">Click Here</a>
 Thank you
  
</div>
</body>
</html>