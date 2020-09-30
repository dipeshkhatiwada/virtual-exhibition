<?php $__env->startSection('header'); ?>
<section class="enroll_content">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    <?php echo $__env->make('front/common/enroll_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  </div>
</section>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<!-- banner section with search form ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section>
        <div class="container">
            <div class="row">
                 <!-- Modal Header -->
                <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($company->publish_status == 1): ?>
                        <div class="col-md-5" id="video_content">
                            <div class="modal-header">
                                <h4 class="modal-title center"><strong><?php echo e($company->company_name); ?></strong></h4>
                            </div>

                            <!-- Modal body -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?php echo e($company->intro_video); ?>?&theme=dark&autohide=2&modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                

                            </div>
                            <div class="modal-footer">
                                
                                <?php if(auth()->guard('employee')->user()): ?>
                                    <a href="<?php echo e(route('enroll_companyDetail.homepage', $company->seo_url)); ?>" class="btn btn-info center" data-dismiss="modal">Enter</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
</section>
<?php $__env->stopSection(); ?>
<style>
    #video_content{
        background: whitesmoke;
        margin-top: 120px;
        margin-left: 50px;
        margin-bottom: 30px;
    }
    /* .modal-body{
        background: wheat;
        display: flex;
    } */


</style>

<?php echo $__env->make('front.event-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/show.blade.php ENDPATH**/ ?>