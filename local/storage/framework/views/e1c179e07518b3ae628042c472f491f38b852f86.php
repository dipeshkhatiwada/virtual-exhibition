<div class="white_block btm15m">
<h3 class="h3 btm15m"><?php echo e($datas['title']); ?></h3>
<div class="lft_block">
    <ul class="btm15m">
        <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="<?php echo e($category['url']); ?>" ><?php echo e($category['title']); ?> <span>(<?php echo e($category['total']); ?>)</span></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <a href="<?php echo e(url('jobs/categories')); ?>" class="morejob" >All Categories <i class="fa fa-long-arrow-alt-right"></i></a>
</div>
</div>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/jobcategory.blade.php ENDPATH**/ ?>