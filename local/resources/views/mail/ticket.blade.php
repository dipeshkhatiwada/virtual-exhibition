
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;" rel="stylesheet"> 
</head>

<body style="padding:0px; margin:0px; font-family: 'Roboto', sans-serif;  padding-bottom: 30px; font-size:12px; color:#555;background-color:#edf0f3;">
  <div style="width: 700px; position: relative; margin:50px auto; background-color:#f6f8fa; border-radius:3px 3px 0px 0px; box-shadow:0px 2px 4px rgba(0,0,0,.25);">
    <div style="float:left; border-bottom:1px solid #daf4fc; position:relative; width:98%; background:url({{asset('image/headerbg.png')}}) repeat-x; padding:1% 1% 0% 1%; border:3px 3px 0px 0px;">
      <div style="width:50%; float:left; position: relative;">
        <h3 style="padding:0px 10px; color:#008bb5; font-size:19px;">Ticket Created</h3>
      </div>
      <div style="width:50%; float:right; position: relative; text-align:right;">
        <img src="{{asset('/image/'.$data['logo'])}}" style="margin-top:5px; margin-right:5px;">
      </div>
    </div>
    <div style="clear:both;"></div>
    <div style="width:94%; padding:0% 3%;">
      <h4 style="color:#008bb5; font-size:14px; font-weight:500; padding-top:0px; margin:15px 0px 10px 0px;">Dear {{$data['name']}},</h4>
      <p><?php echo $data['message'];?></p>
      <a href="{{$data['ticket_url']}}" style="border-radius: 3px; box-shadow: none; border: 1px solid transparent; display: inline-block; font-weight: 400; text-align: center; white-space: nowrap; vertical-align: middle; line-height: 1.5; text-decoration: none;background-image: linear-gradient(90deg, #008dcf, #70bf55); padding: 10px 15px; color: #fff !important; font-size: 16px;">View Ticket</a>
     
       
     
   
    <div style="padding-top:7px; line-height:10px; padding-bottom:20px; font-size:12px; color:#555;">
      <p style="color:#333; font-weight:500;">Regards,</p>
     
      <p><span style="color:#008bb5"> {{$data['store_name']}}</span></p>
    </div>
    </div>
  </div>
</body>
</html>
