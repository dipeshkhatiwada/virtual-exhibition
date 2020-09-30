<section id="project" class="tb60p">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="<?php echo e(asset($datas['logo'])); ?>"></p>
      <p><?php echo e($datas['description']); ?></p>
      <div class="title_bg"></div>
    </div>
    <div class="row cm10-row tb35p">
      <div class="col-md-4 col-lg-3">
        <div class="white_block tp20m">
          <h3 class="h3 btm15m">Categories</h3>
        <div class="lft_block">
          <ul>
            <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($category['url']); ?>" ><?php echo e($category['title']); ?> <span>(<?php echo e($category['total']); ?>)</span></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <div class="tp10p">
            <a href="<?php echo e(url('/projects/category')); ?>" class="morejob" >All Categories <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        <div class="tb20p">
          <div class="list_hd btm7m hidden-xs">
            <div class="row cm10-row">
              <div class="col-md-3">
                Projects
              </div>
              <div class="col-md-7">
                Description
              </div>
              <div class="col-md-2">
                <span> Price(NRs.) </span>
              </div>
            </div>
          </div>
          <?php $__currentLoopData = $datas['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="list_block btm7m">
            <div class="list_body btm7m">
              <div class="row cm10-row">
                <div class="col-md-3">
                  <a class="title_three" href="<?php echo e($project['href']); ?>" title="<?php echo e($project['title']); ?>" ><?php echo e($project['title_dis']); ?></a>
                  <div class="tb5p">
                    <p><i class="fa fa-hourglass"></i> <span class="blueclr">Open</span> <?php echo e($project['publish_date']); ?> - <?php echo e($project['total']); ?> bids</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <p><?php echo e($project['description']); ?></p>
                </div>
                <div class="col-md-2">
                  NRs. <?php echo e($project['avg']); ?>

                </div>
              </div>
            </div>
            <p>
              <span class="blueclr"><i class="fa fa-tags"></i></span>
              <?php $__currentLoopData = $project['skills']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <span><a href="<?php echo e(url('/projects/tags/'.$skill)); ?>" class="skill_list" ><?php echo e($skill); ?></a></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </p>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        </div>
        
      </div>
    </div>
    <div class="center">
      <a href="<?php echo e(url('/projects')); ?>" class="btn browsebtn" >Browse all Projects</a>
    </div>
  </div>
</section><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/projectlist.blade.php ENDPATH**/ ?>