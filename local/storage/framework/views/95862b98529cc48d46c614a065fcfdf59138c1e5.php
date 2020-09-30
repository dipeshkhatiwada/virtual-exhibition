<?php $__env->startSection('header'); ?>

 <?php echo $__env->make('front/common/women_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>


<!-- banner section with search form ended here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section  class="tp80p">
<?php if(count($datas['top_content']) > 0): ?>

    <div id="top_content" class="container ">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $tcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php if (count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-7 col-12';

} else{
$class = 'col-md-12';
} ?>
<div class="container">
  <div class="row">
            
            <div class="<?php echo e($class); ?>">
                <?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $main_module['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(count($datas['right_content']) > 0): ?>
            <aside class="col-lg-3 col-md-5 col-12">
                <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $rcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </aside>
            <?php endif; ?>
        </div>
    
</div>
<?php if(count($datas['bottom_content']) > 0): ?>

    <div id="bottom_content" class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $bcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

<?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.women-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/common/womenhome.blade.php ENDPATH**/ ?>