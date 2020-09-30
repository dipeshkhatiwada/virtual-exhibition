<section>                     
    <div class="advertisement row cm-row btm7m">
    <?php $__currentLoopData = $data['advertise']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertise): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="text-center <?php echo e($data['class']); ?> mb-1">
        <a href="<?php echo e($advertise['url_link']); ?>" title="<?php echo e($advertise['title']); ?>" target="_blank">
            <img src="<?php echo e(asset($advertise['image'])); ?>" class="lazy img-fluid" alt="<?php echo e($advertise['title']); ?>" style="width: 100% !important;">
        </a>
        </div>
       
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    </div>
</section><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/advertise.blade.php ENDPATH**/ ?>