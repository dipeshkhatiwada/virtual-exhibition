<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $datas['store_name']; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;">
Dear {{$datas['firstname'].' '.$datas['middlename'].' '.$datas['lastname']}}, <br><br>

Thank you for submitting your Electronic Recruitment Application (ERA) for the job position of {{$datas['job_title']}}, Job ID No. {{$datas['vacancy_code']}} <br><br>

Please log in to {{url('/status')}} to know the updates of Recruitment and Selection process for this job position.<br><br>

Thank you for showing your interest in working with {{$datas['employer_name']}}.<br><br><br>

Recruitment Team<br>
Rolling Plans Private Limited<br>
More job vacancy: {{url('/careers')}} <br>

   
</div>
</body>
</html>