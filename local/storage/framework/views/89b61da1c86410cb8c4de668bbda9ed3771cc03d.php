<section id="event" class="tb60p eventsbg">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="<?php echo e(asset($datas['logo'])); ?>"></p>
      <p><?php echo e($datas['description']); ?></p>
      <div class="title_bg"></div>
    </div>
    
    <div class="row cm10-row tb35p">
        <?php $__currentLoopData = array_chunk($datas['events'], 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 col-lg-3">
          <div class="event_container whitebg center btm7m">
            <img src="<?php echo e($event['image']); ?>">
            <a href="<?php echo e($event['href']); ?>" >
              <div class="event_overlay">
                <h1 class="title_one text-ellipsis"><?php echo e($event['title']); ?></h1>
                <div class="btm15p">
                  <span class="greencolor"><i class="fa fa-map-marker-alt"></i></span>
                  <p>Kathmandu</p>
                </div>
                <div class="venue">
                  <span class="venue_icon float-left">
                    <i class="fa fa-landmark"></i> 
                  </span>
                  <span class=""><a href="<?php echo e($event['category_href']); ?>" ><?php echo e($event['category']); ?></a></span>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    <div class="center">
      <a href="<?php echo e(url('/events')); ?>"  class="btn browsebtn">Browse all event</a>
    </div>
  </div>
</section>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/event.blade.php ENDPATH**/ ?>