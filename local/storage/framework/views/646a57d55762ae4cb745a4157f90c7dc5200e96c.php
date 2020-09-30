<div class="topemployer">
    <div class="container">
        <center class="btm15m">
        <h3 class="btm10p blueclr"><span class="fa fa-users"></span> Top Employers</h3>
        
        </center>
        <div class="slider autoplay multipleslider">
             <?php $__currentLoopData = $datas['employers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <center>
                    <a href="<?php echo e($employer['href']); ?>" alt="<?php echo e($employer['name']); ?>" title="<?php echo e($employer['name']); ?>"><img src="<?php echo e(asset($employer['logo'])); ?>" title="<?php echo e($employer['name']); ?>" alt="<?php echo e($employer['name']); ?>"></a>
                </center>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </div>
    </div>
</div>


<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/topemployer.blade.php ENDPATH**/ ?>