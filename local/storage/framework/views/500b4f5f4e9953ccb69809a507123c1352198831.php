<div class="jobs_block btm15m">
  <h3 class="h3 btm15m"><?php echo e($datas['title']); ?>

    <?php if($datas['image'] != ''): ?>
    <img style="max-height: 20px;" src="<?php echo e($datas['image']); ?>">
    <?php endif; ?>
  </h3>
  <div class="row cm10-row">
    <?php $__currentLoopData = $datas['employers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(count($employer['jobs']) > 2) {
    $class = 'has-multiple';
    } else {
    $class = '';
    } ?>
    <div class="col-md-6 col-12 col-lg-4 job-types">
      <div class="comn_block <?php echo e($class); ?>">
        <div class="next">
          <div class="row cm-row">
            <div class="col-md-3 col-lg-3 col-3">
              <div class="complogo">
                  <?php if($employer['logo'] != ''): ?>
                                <a href="<?php echo e($employer['url']); ?>"><img src="<?php echo e(asset($employer['logo'])); ?>"></a>
                                <?php else: ?>
                                <div class="noimage_sqr backgroundcolor-<?php echo e($employer['fletter']); ?>"><?php echo e($employer['fn']); ?></div>
                                <?php endif; ?>
              </div>
            </div>
            <div class="col-md-9 col-lg-9 col-9 job-list text-ellipsis">
              <div class="lft10p">
              <a class="company_name" title="<?php echo e($employer['employer_name']); ?>" href="<?php echo e($employer['url']); ?>" ><?php echo e($employer['employer_name']); ?></a>
              <ul class="joblist">
                <?php $__currentLoopData = $employer['jobs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="text-ellipsis"><a title="<?php echo e($job['title']); ?>" href="<?php echo e(url('/jobs/'.$employer['seo_url'].'/'.$job['seo_url'])); ?>"><?php echo e($job['title']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
  </div>
  <a href="<?php echo e($datas['href']); ?>" class="morejob" >View more <?php echo e($datas['title']); ?> <i class="fa fa-long-arrow-alt-right"></i></a>
</div><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/JobType.blade.php ENDPATH**/ ?>