<?php $__env->startSection('header'); ?>
<section class="event_banner innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    <?php echo $__env->make('front/common/event_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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


<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
} else{
$class = 'col-md-12';
} ?>
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
            <div id="event" class="">
              <div class="container rn_container">
               
                <?php $__currentLoopData = $datas['events']->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row cm10-row">
                  <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                   if (is_file(DIR_IMAGE.$event->image)) {
             $image = $event->image;
           } else{
            $image = 'no-image.png';
           }
           ?>
                    <div class="col-md-4 col-lg-3">
                      <div class="event_container whitebg center btm15m">
                        <img src="<?php echo e(asset(\App\Imagetool::mycrop($image,300,200))); ?>">
                        <a href="<?php echo e(url('/events/'.$event->seo_url)); ?>" >
                          <div class="event_overlay">
                            <h1 class="title_one text-ellipsis"><?php echo e($event->title); ?></h1>
                            <div class="btm15p">
                              <span class="greencolor"><i class="fa fa-map-marker-alt"></i></span>
                              <p><?php echo e($event->address); ?></p>
                            </div>
                            <div class="venue">
                              <span class="venue_icon float-left">
                                <i class="fa fa-landmark"></i> 
                              </span>
                              <span class=""><a href="<?php echo e(url('/events/category/'.\App\EventCategory::getUrl($event->event_category_id))); ?>" ><?php echo e(\App\EventCategory::getTitle($event->event_category_id)); ?></a></span>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="">
                 
              <nav aria-label="Page navigation example">
                <?php echo $datas['events']->render();?>
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
<?php echo $__env->make('front.event-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/event/index.blade.php ENDPATH**/ ?>