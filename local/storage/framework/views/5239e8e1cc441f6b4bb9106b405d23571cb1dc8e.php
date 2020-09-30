<section id="training" class="r_training tb60p">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="<?php echo e(asset($datas['logo'])); ?>"></p>
      <p class="whiteclr"><?php echo e($datas['description']); ?></p>
      <div class="title_bg"></div>
    </div>
   
    <div class="row cm10-row tb35p">
         <?php $__currentLoopData = array_chunk($datas['trainings'], 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-4">
        <div class="white_block training">
          <div class="training_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
          <h3 href="<?php echo e($training['href']); ?>"  class="h3"><?php echo e($training['title']); ?></h3>
          <div class="border"></div>
          <p><?php echo e($training['description']); ?></p>
          <div class="tp10p">
           <a href="<?php echo e($training['href']); ?>"  class="morejob">More <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
   
    <div class="center">
      <a href="<?php echo e(url('/trainings')); ?>"  class="btn browsebtn fffbtn">Browse all Trainings</a>
    </div>
  </div>
</section>

<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/training.blade.php ENDPATH**/ ?>