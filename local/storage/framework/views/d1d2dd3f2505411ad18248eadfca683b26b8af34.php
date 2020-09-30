<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Application</title>
    <style type="text/css">
        *{margin:0px; padding:0px ; box-sizing:border-box; }


        #nomargin{margin-right:0px;}

        .Application{height:367px; width:915px; background:linear-gradient( to bottom,#d8f5fb,#ffffff); margin-top:20px;}
        .AppLeft {width:447px; height:367px;  float:left; padding:22px 0px 0px 25px; position:relative; }
        .AppLeft h1{font-size:76px; color:white;}

        .salutation{width:389px; height:36px;  position:absolute ; top:100px; font-size:15px; font-family: Montserrat SemiBold; color: #1da1f2; }
        .message{width:825px; height:36px; position:absolute ; top:150px; font-size:15px; font-family: Montserrat SemiBold; color: #000000; }
        .regards{width:750px; height:36px;  position:absolute ; top:250px; font-size:15px; font-family: Montserrat SemiBold; color: #000000; }
        .ronnie{position: relative; top: 200px; margin-left: -205px; }
        .eventLogo{position: relative; top: 100px; margin-left: 80px;}
        #lin  {text-align:left; margin-left:3px; color:#009ccd;}
        #lin2  {text-align:left; margin-left:3px; color:#61686b;}
        #line{float:right; color:#fbbe71; position:absolute;top:1px; left:215px;}
        .thinLine{width: 825px; height: 1px; background: #96bfc8;}



        .AppRight{width:468px; height:367px; float:right; text-align:center; margin: 40px 0px 0px 0px; font-family: Montserrat SemiBold; color: #1da1f2;}
        .content{border-bottom:1px solid #c0c0c0; position:relative; }
        p {padding:9px 19px 0px 0px;}

    </style>
</head>

<body>
<div class="Application">
    <div class="AppLeft"> <img src="<?php echo e(asset('image/'.$data['logo'])); ?>" height="75px" width="224">
        <div class="thinLine"> </div>
        <div class="salutation" >
            <p id="lin"> Dear, <?php echo e($data['to_name']); ?> </p>
        </div>   <!-- start/end of links-->
        <div class="message" >
             <p id="lin2"> <?php echo e($data['text']); ?> <br><br> Please feel free to contact us for further details.</p>
        </div>   <!-- start/end of links-->
        <div class="regards" >
            <p id="lin2"> Regards,  </p>
            <p id="lin"> Rolling Nexus </p> <p id="lin"> 9801365247 </p>
        </div>   <!-- start/end of links-->
    </div>
    <div class="AppRight" >
        <h2>Application Confirmation </h2>
        <div class="ronnie"> <img src="<?php echo e(asset('images/ronnie.png')); ?>" height="100px"> </div>
        <div class="eventLogo"> <img src="<?php echo e(asset('images/event.png')); ?>" height="100px"> </div>
    </div>

</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/mail/application.blade.php ENDPATH**/ ?>