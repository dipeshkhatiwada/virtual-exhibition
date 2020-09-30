<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $data['from_name']; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><img src="{{asset('image/'.$data['logo'])}}" alt="<?php echo $data['from_name']; ?>" style="margin-bottom: 20px; border: none; max-height:100px;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;">Dear <?php echo $data['to_name'];?>,</p>
  <p style="margin-top: 0px; margin-bottom: 20px;">Your Invoice ({{$data['invoice_detail']->id}}) status has been changed as {{$data['invoice_detail']->invoice_status}}.</p>
  <p style="margin-top: 0px; margin-bottom: 20px;">Remarks: {{$data['comment']}}</p>
  <p style="margin-top: 20px; margin-bottom: 20px;">{{$data['from_name']}}</p>
</div>
</body>
</html>