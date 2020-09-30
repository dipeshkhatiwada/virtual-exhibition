<html lang="en"><head>
    <meta charset="UTF-8">
    <link rel="apple-touch-icon" type="image/png" href="https://static.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png">
    <meta name="apple-mobile-web-app-title" content="CodePen">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico">
    <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111">
    <title>Company Detail</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style>


    body {
     padding-top:50px;
    }

    #masthead {
     min-height:250px;
    }

    #masthead h1 {
     font-size: 30px;
     line-height: 1;
     padding-top:20px;
    }

    #masthead .well {
     margin-top:8%;
    }

    @media  screen and (min-width: 768px) {
      #masthead h1 {
        font-size: 50px;
      }
    }

    .navbar-bright {
     background-color:#111155;
     color:#fff;
    }

    .affix-top,.affix{
     position: static;
    }

    @media (min-width: 979px) {
      #sidebar.affix-top {
        position: static;
          margin-top:30px;
          width:228px;
      }

      #sidebar.affix {
        position: fixed;
        top:70px;
        width:228px;
      }
    }

    #sidebar li.active {
      border:0 #eee solid;
      border-right-width:5px;
    }
    #scrollvideo{
                height: 365px;
                width: 183px;
                background: #F5F5F5;
                overflow-y: scroll;
            }
    #vsidebar{
        padding-left: 50px;
    }

    .vid-item {
        display: block;
        width: 100px;
        height: 200px;
        float: left;
        margin: 0;
        padding: 10px;
    }
        #projects .masonry .item img {
        transition: all 1s;
        width: 100%;
        overflow: hidden;
        margin-bottom: 30px;
    }
    </style>
    <script>
      window.console = window.console || function(t) {};
    </script>
    <script>
      if (document.location.search.match(/type=embed/gi)) {
        window.parent.postMessage("resize", "*");
      }
    </script>
    </head>
    <body translate="no">

        <div id="masthead">
            <div class="image-block">
                <img src="https://static.pexels.com/photos/268455/pexels-photo-268455.jpeg" class="img-responsive" >
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">


                        
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-3" id="leftCol">
                    <ul class="nav nav-stacked" id="sidebar">
                        <li><a href="#introduction">Introduction</a></li>
                        <li><a href="<?php echo e(route('enroll.audience', $company_detail->seo_url)); ?>">Watch LiveStream</a></li>
                        <li><a href="<?php echo e(url('/enroll/group-video/joinchannel/'.$company_detail->seo_url)); ?>">VideCall</a></li>
                        <li><a href="<?php echo e(route('downlaod.businessprofile', $company_detail->id)); ?>">Profile Preview</a></li>
                        <li><a href="<?php echo e($company_detail->company_website); ?>" target="_blank" >Website</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-md-9">
                    <h2 id="introduction">Introduction</h2>
                    <div class="row">
                        <div class="col-md-9">
                            <iframe id="vid_frame" src="http://www.youtube.com/embed/<?php echo e($company_detail->intro_video); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;" frameborder="0" width="690" height="365" allowfullscreen ></iframe>
                        </div>
                        <div class="col-md-3" id="vsidebar">
                            <div class="card" id="scrollvideo">
                            <?php $__currentLoopData = $company_detail->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/<?php echo e($video->link); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;'">
                                        <div class="thumb"><img src="http://img.youtube.com/vi/<?php echo e($video->link); ?>/0.jpg" width="150" height="150">
                                            <div class="desc" style="width: 120px">
                                                <?php echo e($video->title); ?>

                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        </div>
                    </div>
                    <hr>

                    <h2 id="sec1">Profile</h2>
                    <p>
                        <?php echo $company_detail->description; ?>

                    </p>
                    <hr>


                <section id="gallery" class="content-section">
                    <div class="section-heading">
                        <h1>Recent<br><em>Gallery</em></h1>
                    </div>
                    <div class="section-content">
                        <div class="masonry">
                            <div class="row">
                                <?php if( count($photos) > 0): ?>
                                <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item">
                                    <div class="col-md-4">
                                        
                                            <img src="<?php echo e(asset( 'image/'.$photo->image )); ?>" onClick="onClick(this);"alt="image 1">
                                        </a>
                                        <div class="text-content">
                                            <h4><?php echo e($photo->title); ?></h4>
                                            <p>#1 You are allowed to use Sentra Template for your business or client websites. You can use it for commercial or non-commercial or educational purposes.</p>
                                        </div>

                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
                                <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
                                <div class="w3-modal-content w3-animate-zoom">
                                  <img id="img01" style="width:100%">
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

                <hr>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
        function onClick(element) {
          document.getElementById("img01").src = element.src;
          document.getElementById("modal01").style.display = "block";
        }
    </script>
    </body>
    </html>

<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/homepage1.blade.php ENDPATH**/ ?>