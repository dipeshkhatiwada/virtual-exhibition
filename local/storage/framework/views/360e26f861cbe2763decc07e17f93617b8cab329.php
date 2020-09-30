<?php $__env->startSection('header'); ?>
<section class="innerpage_banner">
  <div class="container">
    <?php echo $__env->make('front/common/event_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
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
        <a class="btn bluecomnbtn"><?php echo e(strtoupper($datas['category']->title)); ?> EVENTS</a>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- job blocks section started here -->
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
        <aside class="col-md-3">
          <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $lcontent['module']; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </aside>
        <?php endif; ?>
        <div class="<?php echo e($class); ?>">
          
          <h1 class="title_one btm15m">
          <span class="greenclr"><i class="fa fa-grip-horizontal"></i></span> Event Lists
          </h1>
          <?php if(count($datas['events']) > 0): ?>
          <?php $__currentLoopData = array_chunk($datas['events'], 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $events): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="row">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
              <div class="comp_events_block">
                <div class="row cm-row">
                  <div class="col-md-5">
                    <div class="event_image">
                      <img src="<?php echo e(asset($event['thumb'])); ?>">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="com_eventinfo">
                      <div class="light_title"><?php echo e($event['title']); ?></div>
                      <span class="blueborder"></span>
                      <span class="bold">Organizer : </span>
                      <span class=""><?php echo e($event['employer']); ?></span>
                      <div class="date">
                        <span class="greenclr"><i class="fa fa-calendar-alt"></i></span> <?php echo e($event['event_date']); ?>

                      </div>
                      <div class="company_venue">
                        <span class="company_venue_icon float-left">
                          <i class="fa fa-landmark"></i>
                        </span>
                        <span class="lft15p"><?php echo e($event['venue']); ?></span>
                      </div>
                      <a href="<?php echo e($event['href']); ?>" class="btn morebtn tp10m">More <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <div class="row"><div class="col-md-12">
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['event_render']->render(); ?>
              </nav>
            </div>
          </div></div>
          <?php else: ?>
          <div class="row"><div class="col-md-12"><div class="alert alert-info">No any event found yet.</div></div>
          <?php endif; ?>
          
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
<!-- job block section ended here -->
<?php if(count($datas['bottom_content']) > 0): ?>
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $bcontent['module']; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>
<script type="text/javascript">
function followEmployer(emid)
{
var token = $('input[name=\'_token\']').val();
if (emid != '') {
$.ajax({
type: "POST",
url: "<?php echo e(url('employee/followemployer')); ?> ",
data: 'id='+emid+'&_token='+token,
success: function(data){
location.reload();
}
});
}
}
</script>
<script type="text/javascript">
function viewImage(id) {
$('#tender-image'+id).modal('show');
}
</script>
<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '<?php echo e(url("/events/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/event/category_detail.blade.php ENDPATH**/ ?>