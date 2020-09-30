<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<script nomodule src="https://unpkg.com/@google/model-viewer/dist/model-viewer-legacy.js"></script>
<?php $__env->startSection('header'); ?>

    <?php echo $__env->make('front/common/enroll_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<style>
    #scrollvideo{
               height: 365px;
               width: 150px;
               background: #F5F5F5;
               overflow-y: scroll;
               margin-left: 30px;
           }
    #scrollImg img{
        width: 120px;
        height: 80px;
        object-fit: contain;
    }
    .title-effect {
        color: palevioletred;
        z-index: 99;
        position: relative;
        display: inline-block;
        transition: transform 0.5s, color 0.5s;
        transition-timing-function: cubic-bezier(0.2,1,0.3,1);
    }
    .clients-box {
        background: #f7f7f7;
        padding: 20px;
        margin-bottom: 30px;
        margin-top: 20px;
        }
    .clients-photo { position: relative; margin-right: 20px; width: 200px; height: 200px; float: left; display: table-cell; text-align: center; vertical-align: middle; background: #fff; }
    .clients-photo img { position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; }
    .clients-info { display: table; }
    .clients-info i { padding-right: 10px; }
    .clients-info a { font-size: 14px; color: #84ba3f; }
    .clients-info a:hover { color: #626262; }
    .clients-info p { margin-top: 10px; }


</style>
<?php $__env->startSection('banner'); ?>
    <?php echo $__env->make('front/enroll/includes/banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php if(count($datas['top_content']) > 0): ?>
    <section id="top_content" class="jobs tb35p">
        <div class="container rn_container">
            <div class="row">
                <div class="col-md-12">
                    <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $tcontent['module']; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-4 col-12 center-panel';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-8 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-4 col-12';
} else{
$class = 'col-md-12';
} ?>

<section id="enroll" class="jobs tb35p">
    <div class="container rn_container">

        <div class="row">
            <aside class="col-lg-3 col-md-4 col-12">
                <div class="white_block btm15m">
                    <h3 class="h3 btm15m">Category</h3>
                    <div class="lft_block">
                        <ul class="btm15m">
                            <li><a href="<?php echo e($datas['company_detail']->company_website); ?>" target="_blank" >Company website</a></li>
                            <li><a href="<?php echo e(route('enroll.audience', $datas['company_detail']->seo_url)); ?>">Watch Livestream</a></li>
                            <li><a href="<?php echo e(url('/enroll/group-video/'.$datas['company_detail']->seo_url)); ?>">Vide Call</a></li>
                            <li><a href="<?php echo e(asset('image/'.$datas['company_detail']->fair_detail)); ?>" target="_blank">Profile Preview</a></li>
                        </ul>
                        <a href="http://localhost/rollingnexus/events/enroll" class="morejob">All Categories <i class="fa fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </aside>
            <div class="col-lg-8">

                    <!--First row-->
                    <div class="row wow fadeIn" data-wow-delay="0.4s" id="introduction">
                        <div class="col-lg-12">
                            <div class="divider-new">
                                <h2 class="center">Welcome to <?php echo e($datas['company_detail']->company_name); ?></h2>
                            </div>
                        </div>
                    </div>
                    <!--/.First row-->
                    <br>
                    <hr class="extra-margins">

                    <div class="row">
                        <div class="col-md-9">
                            <iframe id="vid_frame" src="http://www.youtube.com/embed/<?php echo e($datas['company_detail']->intro_video); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;" frameborder="0" width="660" height="365" allowfullscreen ></iframe>
                        </div>
                        <div class="col-md-2">
                            <div class="card" id="scrollvideo">
                                <?php $__currentLoopData = $datas['company_detail']->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/<?php echo e($video->link); ?>/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;'">
                                    <div class="thumb" id="scrollImg"><img src="http://img.youtube.com/vi/<?php echo e($video->link); ?>/0.jpg"></div>
                                        <div class="desc" style="margin-left: 14px;">
                                        <?php echo e($video->title); ?>

                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr class="extra-margins">


                    <!-- Section: Gallery -->
                  <section class="section wow fadeIn" data-wow-delay="0.3s" >
                    <!-- Section heading -->
                    <h1 class="center">Profile</h1>
                    <!-- Section description -->
                    <p> <?php echo $datas['company_detail']->description; ?></p>

                  </section>
                  <br>
                  <hr class="extra-margins">

                <!-- /Section: Gallery -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="section-title text-center">
                            <h6>Our Recent</h6>
                            <h2 class="title-effect">Company's photo</h2>
                            <h6>of the year</h6>
                        </div>
                   </div>
                 </div>
                <div class="row">
                    <?php $__currentLoopData = $datas['photos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="clients-box mb-30 clearfix">
                                <div class="clients-photo">
                                <img src="<?php echo e(asset(\App\Imagetool::mycrop($photo->image, 200,200))); ?>" alt="">
                                </div>
                                <div class="clients-info sm-pt-20">
                                <h5><?php echo e($photo->title); ?></h5>
                                
                                <p><?php echo $photo->description; ?> </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <model-viewer src="<?php echo e(asset('image/3d.glb')); ?>" alt="A 3D model of an astronaut" auto-rotate camera-controls></model-viewer>

                </div>

                    <!--/.Second row-->
            </div>
            <?php if(count($datas['right_content']) > 0): ?>
            <aside class="col-lg-2 col-md-4 col-12">
                <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $rcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if(count($datas['bottom_content']) > 0): ?>
<section id="bottom_content" class="jobs tb35p">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $bcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<input type="hidden" id="pusher_key" value="<?php echo e(env('PUSHER_APP_KEY')); ?>">
<input type="hidden" id="b_id" value="<?php echo e($datas['business_user']->id); ?>">
<input type="hidden" id="c_slug" value="<?php echo e($datas['company_detail']->seo_url); ?>">

<div id="message_box_front" class="message_box">
    <h3>Messages</h3>
    <div id="contacts_front" class="business">

    </div>
</div>
<script src="<?php echo e(asset('js/agora/agora-audience.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.enroll-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/company_detail.blade.php ENDPATH**/ ?>