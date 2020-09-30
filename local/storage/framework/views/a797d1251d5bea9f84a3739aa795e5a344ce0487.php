<?php $__env->startSection('header'); ?>
<section class="event_banner innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    <?php echo $__env->make('front/common/training_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="tb20p center">
        <a class="btn bluecomnbtn">TOP TRAINING</a>
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
$class = 'col-lg-7 col-md-6';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
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
        <aside class="col-lg-3 col-md-4">
          <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $lcontent['module']; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </aside>
        <?php endif; ?>
        <div class="<?php echo e($class); ?>">
          <div class="trainingblock tp20m">
          <?php if(count($datas['trainings']) > 0): ?>
          <?php $__currentLoopData = $datas['trainings']->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trainings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row cm10-row">
              <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-4 col-md-6">
                <div class="white_block training">
                  <div class="training_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
                  <h3 class="h3"><?php echo e($training->title); ?></h3>
                  <div class="border"></div>
                  <p><?php echo e(\App\Library\Settings::getLimitedWords($training->description,0,20)); ?></p>
                  <div class="training_info">
                    <p><i class="fa fa-map-marker-alt"></i> <?php echo e($training->address); ?></p>
                    <p><i class="far fa-calendar-alt"></i> <?php echo e($training->start_date.' to '.$training->end_date); ?></p>
                    <p><i class="fa fa-money-bill-wave"></i> NPR <?php echo e($training->price); ?></p>
                    <p><i class="fa fa-clock"></i> <?php echo e($training->start_time); ?> - <?php echo e($training->end_time); ?></p>
                  </div>
                  <div class="tp10p">
                    <a href="<?php echo e(url('/trainings/'.$training->seo_url)); ?>" class="morejob">More <i class="fa fa-angle-double-right"></i></a>
                  </div>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <div class="row cm10-row">
              <div class="col-md-12">
                <div class="alert alert-info">Sorry no any event found yet. Please visit later</div>
              </div>
              </div>
              <?php endif; ?> 
              
              
              
            
            <!-- Pagination started here -->
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['trainings']->render();?>
              </nav>
            </div>
            <!-- pagination ended here -->
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


<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '<?php echo e(url("/trainings/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.event-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/training/index.blade.php ENDPATH**/ ?>