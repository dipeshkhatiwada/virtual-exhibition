<?php $__env->startSection('header'); ?>
<section class="event_banner innerpage_banner">
    <div class="inner_overlay"></div>
    <?php echo $__env->make('front/common/enroll_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container rn_container z-index2">
            <div class="">
                <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
                <div class="search_background">
                  <form class="search_form">
                    <div class="row cm10-row">
                        <div class="col-md-10 col-9">
                          <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                        </div>
                        <div class="col-md-2 col-3">
                           <button class="btn searchbtn">Search</button>
                        </div>
                    </div>
                  </form>
                </div>

                <div class="tb20p center">
                  <a class="btn bluecomnbtn">LATEST EVENTS</a>
                </div>
            </div>
        </div>
</section>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<!-- banner section with search form ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


    <?php
        if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
            $class = 'col-md-7';
        } elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
            $class = 'col-md-9';
        }
        elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
            $class = 'col-md-10';
        } else{
            $class = 'col-md-12';
        }
    ?>
<section>
    <div class="container">
        <div class="neg_margin greybg tp20p">
                <?php if(count($datas['top_content']) > 0): ?>
                    <div class="row cm10-row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $tcontent['module']; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row cm10-row">
                <?php if(count($datas['left_content']) > 0): ?>
                    <aside class="col-md-3">
                        <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $lcontent['module']; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </aside>
                <?php endif; ?>
                <div class="<?php echo e($class); ?>">
                    <div class="container rn_container">

                        <?php if(count($datas['enroll']) > 0): ?>
                        <div class="row">
                                <?php $__currentLoopData = $datas['enroll']->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $companies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                            <div class="col-md-4">
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
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger donthavemessage">Sorry We can not find Virtual exhibiton List. Please Visit Next Time</div>
                          </div>
                        <?php endif; ?>
                    </div>
                </div>
            <nav aria-label="Page navigation example">
            <?php
                echo $datas['enroll']->render();
            ?>
            </nav>

            </div>
        </div>
    </div>
        <?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $main_module['module']; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
            <?php if(count($datas['right_content']) > 0): ?>
            <aside class="col-md-2">
                <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $rcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </aside>
          <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php if(count($datas['bottom_content']) > 0): ?>
<section id="bottom_content" class="jobs tb35p">
    <div class="container">
        <div class="white_div">
            <div class="tp20p">
                <div class="row">
                    <div class="col-md-12">
                        <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $bcontent['module']; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.enroll-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/index.blade.php ENDPATH**/ ?>