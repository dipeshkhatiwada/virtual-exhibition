<?php $__env->startSection('header'); ?>
<section class="enroll_content">
  <div class="inner_enroll_overlay"></div>
  <div class="container rn_container z-index2" id="enroll_header">
    <?php echo $__env->make('front/common/enroll_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div id="masthead">
            

            <div class="container">
                <div class="row">
                    <div class="col-md-12">


                        
                    </div>
                    
                </div>
            </div>
    </div>
    <div class="content">
        <div class="container" id="company_detail">
            <div class="row">
                <div class="col-md-3">
                    <div class="control-box p-3">
                        <h2 class="center"><?php echo e($company_detail->company_name); ?> <i class="fa fa-eye" aria-hidden="true">(<?php echo e($views); ?>)</i>
                        </h2>
                    </div>
                    <div class="card" id="sidbar_card">
                        <div class="list-group list-group-flush">
                            <a href="<?php echo e(route('enroll.audience', $company_detail->seo_url)); ?>" class="list-group-item list-group-item-action bg-light center">Watch the Live Stream</a>
                            <a href="<?php echo e($company_detail->company_website); ?>" target="_blank" class="list-group-item list-group-item-action bg-light center">Website</a>
                            <a href="<?php echo e(url('/enroll/group-video/joinchannel/'.$company_detail->seo_url)); ?>" class="list-group-item list-group-item-action bg-light center">Video Call</a>
                            <a href="<?php echo e(route('downlaod.businessprofile', $company_detail->id)); ?>" target="_blank" class="list-group-item list-group-item-action bg-light center">Preview Profile</a>
                            <a href="#gallery" class="list-group-item list-group-item-action bg-light center">Gallery</a>
                        </div>
                    </div>
                </div>


                <div class="col-md-9">

                    <!-- THE YOUTUBE PLAYER -->
                    <div class="vid-container">
                        <iframe id="vid_frame" src="http://www.youtube.com/embed/<?php echo e($company_detail->intro_video); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;" frameborder="0" width="560" height="315" allowfullscreen ></iframe>
                    </div>

                    <!-- THE PLAYLIST -->
                    <div class="vid-list-container">
                        <?php $__currentLoopData = $company_detail->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="vid-list">
                            <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/<?php echo e($video->link); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;'">
                                <div class="thumb"><img src="http://img.youtube.com/vi/<?php echo e($video->link); ?>/0.jpg"></div>
                                <div class="desc">
                                    <?php echo e($video->title); ?>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- LEFT AND RIGHT ARROWS -->
                    <div class="arrows">
                        <div class="arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
                        <div class="arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
                    </div>
                    <hr class="new5">
                    <div class="introduction-header">
                        <h1>Product Portfolio</h1>
                        <div class="well">
                            <p> <?php echo $company_detail->description; ?></p>
                        </div>
                    </div>

                    <section id="gallery" class="content-section">
                        <div class="section-heading">
                            <h1>Recent<br><em>Uploads</em></h1>
                            <p>Praesent pellentesque efficitur magna,
                            <br>sed pellentesque neque malesuada vitae.</p>
                        </div>
                        <div class="section-content">
                            <div class="masonry">
                                <div class="row">
                                    <?php if( count($photos) > 0): ?>
                                    <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item">
                                        <div class="col-md-4">
                                            <a href="<?php echo e(asset( 'image/'.$photo->image )); ?>" data-lightbox="image">
                                                <img src="<?php echo e(asset( 'image/'.$photo->image )); ?>" alt="image 1">
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

                            </div>
                        </div>
                    </section>
                    <div class="container" id="gallery">
                            <div class="row">
                                <?php if( count($photos) > 0): ?>
                                <?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-6 <?php echo e(count($photos) < 2 ? 'center' : ''); ?>">
                                    <div class="card">
                                        <div class="card text-white bg-info">
                                            <img class="card-img-top" src="<?php echo e(asset( 'image/'.$photo->image )); ?>" onClick="onClick(this);" width="400px;" height="250px;" alt="Card image cap">
                                            <div class="card-body">
                                            <h5 class="card-title"><?php echo e($photo->title); ?></h5>
                                            <p class="card-text"><?php echo $photo->description; ?></p>
                                            </div>
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


            </div>
        </div>
    </div>
    <script src="<?php echo e(asset('js/agora-audience-client.js')); ?>" type="text/javascript"></script>

<style>
    hr.new5{
        border: 3px solid #f5a442;
    border-radius: 5px;
    }
    #company_detail{
            margin-top: 120px;
        }
    #card_image{
        border: 0ex;
    }
    /*  VIDEO PLAYER CONTAINER
            ############################### */
         .vid-container {
		    position: relative;
		    padding-bottom: 52%;
		    padding-top: 30px;
		    height: 0;
		}

		.vid-container iframe,
		.vid-container object,
		.vid-container embed {
		    position: absolute;
		    top: 0;
		    left: 0;
		    width: 100%;
		    height: 100%;
		}


		/*  VIDEOS PLAYLIST
 		############################### */
		.vid-list-container {
			width: 92%;
			overflow: hidden;
			/* margin-top: 20px; */
			margin-left:4%;
			padding-bottom: 20px;
            background: whitesmoke;
            height: 100px;
		}

		.vid-list {
			width: 1344px;
			position: relative;
			top:0;
			left: 0;

		}

		.vid-item {
			display: block;
			width: 148px;
			height: 148px;
			float: left;
			margin: 0;
			padding: 10px;
		}

		.thumb {
			/*position: relative;*/
			overflow:hidden;
			height: 50px;
		}

		.thumb img {
			width: 100%;
			position: relative;
			top: -13px;
		}

		.vid-item .desc {
			color: #21A1D2;
			font-size: 15px;
			margin-top:5px;
		}

		.vid-item:hover {
			background: #eee;
			cursor: pointer;
		}

		.arrows {
			position:relative;
            height: 0px;
			width: 100%;
		}

		.arrow-left {
			color: #fff;
			position: absolute;
			background: #777;
			padding: 15px;
			left: -380px;
			top: -63px;
			z-index: 99;
			cursor: pointer;
		}

		.arrow-right {
			color: #fff;
			position: absolute;
			background: #777;
			padding: 15px;
			right: 380px;
			top: -63px;
			z-index:100;
			cursor: pointer;
		}

		.arrow-left:hover {
			background: #CC181E;
		}

		.arrow-right:hover {
			background: #CC181E;
		}


		@media (max-width: 624px) {
			body {
				margin: 15px;
			}
			.caption {
				margin-top: 40px;
			}
			.vid-list-container {
				padding-bottom: 20px;
			}

			/* reposition left/right arrows */
			.arrows {
				position:relative;
				margin: 0 auto;
				width:96px;
			}
			.arrow-left {
				left: 0;
				top: -17px;
			}

			.arrow-right {
				right: 0;
				top: -17px;
			}
		}

</style>

<script>
    function onClick(element) {
      document.getElementById("img01").src = element.src;
      document.getElementById("modal01").style.display = "block";
    }
</script>
<!-- JS FOR SCROLLING THE ROW OF THUMBNAILS -->
<script type="text/javascript">
    $(document).ready(function () {
        $(".arrow-right").bind("click", function (event) {
            event.preventDefault();
            $(".vid-list-container").stop().animate({
                scrollLeft: "+=336"
            }, 750);
        });
        $(".arrow-left").bind("click", function (event) {
            event.preventDefault();
            $(".vid-list-container").stop().animate({
                scrollLeft: "-=336"
            }, 750);
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.enroll-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/homepage.blade.php ENDPATH**/ ?>