
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php $__currentLoopData = $datas['banner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="carousel-item <?php if($key===0): ?> active <?php endif; ?>">
            <img class="d-block w-100" src="<?php echo e(asset(\App\Imagetool::mycrop($banner->image, 786,480))); ?>" alt="First slide">
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/includes/banner.blade.php ENDPATH**/ ?>