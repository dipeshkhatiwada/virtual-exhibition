<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $data['store_name']; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><img src=" {{asset('image/'.$data['logo'])}}" alt="<?php echo $data['store_name']; ?>" style="margin-bottom: 20px; border: none; max-height:100px;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;">The Following Message Received from <?php echo $data['name'];?></p>
  
  
 
  
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    
    <tbody>
      <?php for ($i=0; $i<=count($data['datas']['optitle']) ; $i++) { 
        if(!empty($data['datas']['optitle'][$i])){
       ?>
       
      <tr>
      <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">{{ $data['datas']['optitle'][$i] }}:</td>
        
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $data['datas']['my_datas'][$i]; ?></td>
      </tr>
      <?php }}?>
    
    </tbody>
    
  </table>
  
</div>
</body>
</html>