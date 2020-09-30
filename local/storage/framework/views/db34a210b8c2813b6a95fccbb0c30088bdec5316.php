<?php $__env->startSection('header'); ?>
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

    #visitorCount{
        border:none;
        background: #F5F5F5;
        width: 40px;

    }
    #vido-viwer{
        margin-top: 110px;
    }
    #viewers{
        margin-left: 80px;

    }

    #viewers, .list-group list-group-flush{
        float: left;
        height: 300px;
        width: 500px;
        background: #F5F5F5;
        overflow-y: scroll;
        cursor: pointer;
    }
    #viwer_box_, .list-group-item{
        margin-left: 10px;
    }
    body {
        margin: 0;
        padding: 0;
        /* background-image: url('../images/rtc-logo.png'); */
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
        }

    body .btn:focus{
        outline: none !important;
        box-shadow:none !important;
        }

        /* #leave-livestream-btn{
            display: block;
            align-items: center;
            margin-left: 55px;
        } */
    #buttons-container {
        position: absolute;
        z-index: 2;
        width: 100vw;
        }

    #buttons-container div {
        max-width: 250px;
        min-width: 150px;
        margin-bottom: 10px;
        }

    .btn-group button i {
        padding-left: 25px;
        }

    #full-screen-video {
        position: relative;
        width: 700px;
        height: 500px;

        }

    #full-screen-video-iframe {
        position: absolute;
        width: 100vw;
        height: 100vh;
        background-image: url('../images/AllThingsRTC_live-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        }

    #lower-ui-bar {
        /* min-height: 50vh;
        max-width: 100vw; */
        }

    #rtmp-btn-container {
        position: relative;
        display: inline-block;
        margin-top: auto;
        z-index: 99;
        }

    .rtmp-btn {
        bottom: 5vh;
        right: 5vw;
        display: block;
        margin: 0 0 5px 0;
        }

    #add-rtmp-btn {
        padding: 0.5rem 1.15rem;
        }

    .remote-stream-container {
        display: inline-block;
        }

    #rtmp-controlers {
        height: 100%;
        margin: 0;
        }

    #local-video {
        position: absolute;
        z-index: 1;
        height: 20vh;
        max-width: 100%;
        }

    .remote-video {
        position: absolute;
        z-index: 1;
        height: 100% !important;
        width: 80%;
        max-width: 500px;
        }

    #mute-overlay {
        position: absolute;
        z-index: 2;
        bottom: 0;
        left: 0;
        color: #d9d9d9;
        font-size: 2em;
        padding: 0 0 3px 3px;
        display: none;
        }

    .mute-overlay {
        position: absolute;
        z-index: 2;
        top: 2px;
        color: #d9d9d9;
        font-size: 1.5em;
        padding: 2px 0 0 2px;
        display: none;
        }

    #no-local-video, .no-video-overlay {
        position: absolute;
        z-index: 3;
        width: 100%;
        top: 40%;
        color: #cccccc;
        font-size: 2.5em;
        margin: 0 auto;
        display: none;
        }

    .no-video-overlay {
        width: 80%;
        }

    #screen-share-btn-container {
        z-index: 99;
        }

    #watch-live-overlay {
        position: relative;
        margin-bottom: 400PX;
        position: relative;
        margin-top: -86PX;
        /* right: 110px; */
        width: 100%;
        height: 100%;
        text-align: center;
        background-image: url('../images/AllThingsRTC_live-bg.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        }

    #external-broadcasts-container {
        max-width: 70%;
        margin: auto 0 5px;
        }

    #external-broadcasts-container input {
        width: 50%;
        }

    #external-broadcasts-container button {
        color: #fff;
        }

        /* #external-broadcasts-container .close-btn {
        padding-bottom: 1.2rem;
        } */

    #watch-live-overlay #overlay-container {
        padding: 25px;
        border-radius: 5px;
        position:relative;
        margin: 0 auto;
        top: 65%;
        width: 70%;
        }

    #watch-live-overlay button {
        display: block;
        /* margin: -50px auto; */
        color: #0096e6;
        background: #fff;
        }

    #watch-live-overlay img {
        height: auto;
        width: 100%;
        object-fit: cover;
        object-position: center;
        }

    #watch-live-overlay button i {
        padding: 0 10px;
        }

    .btn-xlg {
        padding: 20px 35px;
        font-size: 30px;
        line-height: normal;
        -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
                border-radius: 8px;
        }

    .drop-mini {
        width: inherit;
        display: inline-block;
        }

    #external-injest-config label, #rtmp-config label {
        margin: 0 .5rem .5rem 0;
        }

    #external-injest-config .row,#rtmp-config .row {
        margin-left: inherit;
        margin-right: inherit;
        }


    #addRtmpConfigModal .modal-header,
        #external-injest-config .modal-header {
        padding: 0.5rem 1rem 0;
        border-bottom: none;
        }

    #addRtmpConfigModal .modal-header .close,
        #external-injest-config .modal-header .close {
        padding: 0.5rem;
        margin: -.025rem;
        }

    #addRtmpConfigModal .modal-body,
        #external-injest-config .modal-body {
        padding: 1rem 1rem 0.25rem;
        }

    #addRtmpConfigModal .modal-footer,
        #external-injest-config .modal-footer {
        padding: 0 1rem 0.5rem;
        border-top: none;
        }

    #pushToRtmpBtn {
        padding: 10px 15px;
        }

    .close .fa-xs {
        font-size: .65em;
        }

        /* pulsating broadcast button */
    .pulse-container {
        height: 100%;
        margin: 5px 10px 0;
        }

    .pulse-button {
        position: relative;
        /* width: 32px; */
        /* height: 32px; */
        border: none;
        box-shadow: 0 0 0 0 rgba(232, 76, 61, 0.7);
        /* border-radius: 50%; */
        background-color: #e84c3d;
        background-size:cover;
        background-repeat: no-repeat;
        cursor: pointer;
        }

    .pulse-anim {
        -webkit-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -moz-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
        -ms-animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
        animation: pulse 2.25s infinite cubic-bezier(0.66, 0, 0, 1);
        }

    @-webkit-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
    @-moz-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
    @-ms-keyframes pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}
    @keyframes  pulse {to {box-shadow: 0 0 0 15px rgba(232, 76, 61, 0);}}

        /* Respomnsive design */

    @media  only screen and (max-width: 795px) {
        #watch-live-overlay #overlay-container {
            width: 100%;
        }
        }

    @media  only screen and (max-height: 350px) {
            #watch-live-overlay img {
                height: 20$;
                width: 40%;
            }
    #watch-live-overlay #overlay-container {
            top: 60%;
        }
        .btn-xlg {
                font-size: 1rem;
            }
        }

    @media  only screen and (max-height: 400px){
        .btn-xlg {
            font-size: 1.25rem;
        }
        }

    @media  only screen and (max-width: 400px) {
        .btn-xlg {
            padding: 10px 17px;
        }
    }

</style>
<section class="event_banner">
    <div class="container">
        <?php echo $__env->make('front/common/enroll_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="">
          <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
          <div class="search_background">
            <form class="search_form">
              <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                  <button class="btn searchbtn">Search</button>
                </div>
              </div>
            </form>
          </div>

        </div>
      </div>
</section>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<!-- banner section with search form ended here -->
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
                <h2 align="center"><input type="text" id="viewerCount" style="align-items: center; border:hidden; width:100px" value="<?php echo e(0); ?>"></h2>
                <p align="center"> person(s) currently viewing this page </p>
                <button class="btn btn-raised btn-green waves-effect waves-light"  style="display: center" id="watch-live-btn">Watch Livestream</button>
                <button class="btn btn-raised btn-danger waves-effect waves-light"  style="display: center" id="leave-livestream-btn">Leave Livestream</button>
            </aside>
            <div class="col-lg-8">

                <div class="live-header">
                    <h3><strong>Live</strong></h3>
                </div>
                <div id="full-screen-video">
                </div>
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
<input type="hidden" id="pusher_key" value="6e2167f314296786dc0a">
<input type="hidden" id="b_id" value="<?php echo e($datas['business_user']->id); ?>">
<input type="hidden" id="c_slug" value="<?php echo e($datas['enroll']->seo_url); ?>">
<input type="hidden" id="join-channel" value="<?php echo e($datas['channel']); ?>">

<div id="message_box_front" class="message_box">
    <h3>Messages</h3>
    <div id="contacts_front" class="business">
    </div>
</div>
<script src="<?php echo e(asset('js/agora/agora-audience.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.enroll-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/live.blade.php ENDPATH**/ ?>