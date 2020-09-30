<!-- job blocks section started here -->
<section id="job" class="jobs tb60p">
  <div class="container rn_container">
    <div class="center btm30p">
      <p class="titlelogo"><img src="<?php echo e(asset('images/job.png')); ?>"></p>
      <p>Find the right job</p>
      <!-- <h2 class="h2 tp20m">Rolling Jobs</h2> -->
      <div class="title_bg"></div>
    </div>

    <form class="search_form col-md-12 col-lg-8" method="POST" action="<?php echo e(url('/search')); ?>">
      <div class="row cm10-row">
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="key words">
        </div>
        <div class="col-md-3">
          <select id="inputState" name="location" class="form-control">
            <?php $__currentLoopData = $datas['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($location->id); ?>"><?php echo e($location->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-3">
          <select id="inputState" name="category" class="form-control">
            <?php $__currentLoopData = $datas['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn searchicon right"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>
    </form>
    <!-- nexus page search form section ended here -->
    
    <div class="row tb35p">
      <div class="col-md-4 col-lg-3">
        <div class="white_block">
          <h3 class="h3 btm15m">Categories</h3>
          <div class="lft_block">
            <ul>
              <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="category text-ellipsis"><a href="<?php echo e($cat['url']); ?>" ><?php echo e($cat['title']); ?> </a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="tp10p">
              <a href="<?php echo e(url('/jobs/categories')); ?>" class="morejob" >All Categories <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
          </div>
      </div>
    </div>
     <!--  left block section ended here -->

      <div class="col-md-8 col-lg-9">
        <div class="row cm10-row">
          <?php $__currentLoopData = $datas['job_type']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6">
            <h3 class="h3 btm15m"><?php echo e($jobtype['title']); ?> 
              <?php if($jobtype['image'] != ''): ?>
              <img style="max-height: 20px;" src="<?php echo e($jobtype['image']); ?>">
              <?php endif; ?>
            </h3>
            <?php $__currentLoopData = $jobtype['employer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(count($employer['jobs']) > 2) {
                $class = 'has-multiple';
                } else {
                $class = '';
                } ?>

            <div class="comn_block <?php echo e($class); ?>">
              <div class="next">
              <div class="row cm10-row">
                <div class="col-md-3 col-lg-3 col-3">
                  <div class="complogo">
                      <?php if($employer['logo'] != ''): ?>
                                <a href="<?php echo e($employer['url']); ?>"><img src="<?php echo e(asset($employer['logo'])); ?>"></a>
                                <?php else: ?>
                                <div class="noimage_sqr backgroundcolor-<?php echo e($employer['fletter']); ?>"><?php echo e($employer['fn']); ?></div>
                                <?php endif; ?>
                  </div>
                </div>
                <div class="col-md-9 col-lg-9 col-9 text-ellipsis">
                  <a class="company_name" title="<?php echo e($employer['employer_name']); ?>" href="<?php echo e($employer['url']); ?>" ><?php echo e($employer['employer_name']); ?></a>
                  <ul class="joblist">
                    <?php $__currentLoopData = $employer['jobs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="text-ellipsis"><a href="<?php echo e(url('/jobs/'.$employer['seo_url'].'/'.$job['seo_url'])); ?>" ><?php echo e($job['title']); ?></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>
            </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($jobtype['url']); ?>" class="morejob" ><?php echo e($jobtype['title']); ?> <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
          <!-- job type block ended here -->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
        
        </div>
      </div>
      <!-- right block section ended here -->
    </div>

    <div class="center">
      <a href="<?php echo e(url('/jobs')); ?>" class="btn browsebtn" >Browse all jobs</a>
    </div>
  </div>
</section>
<!-- job block section ended here -->
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/jobs.blade.php ENDPATH**/ ?>