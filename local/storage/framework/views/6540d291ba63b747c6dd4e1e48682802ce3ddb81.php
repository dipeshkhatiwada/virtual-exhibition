<?php $__env->startSection('header'); ?>
<section class="innerpage_banner">
  <div class="container">
    <header class="header">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-4 mainlogo">
            <div class=""><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(\App\library\Settings::getLogo()); ?>"></a></div>
          </div>
          <div class="col-md-3 col-2 camp_info">
            <div class="float-right tp5p">
              <a><i class="fa fa-map-marker-alt" title="<?php echo e(\App\library\Settings::getSettings()->address); ?>"></i></a> <span class="hidden-xs"><?php echo e(\App\library\Settings::getSettings()->address); ?></span>
            </div>
          </div>
          <div class="col-md-2 col-2 camp_info">
            <div class="float-right tp5p">
              <i class="fa fa-phone-volume" title="<?php echo e(\App\library\Settings::getSettings()->telephone); ?>"></i> <span class="hidden-xs"><?php echo e(\App\library\Settings::getSettings()->telephone); ?></span>
            </div>
          </div>
          <div class="col-md-3 col-4">
            <div class="float-right loginbtns tp5p">
              <?php if(isset(Auth::guard('employer')->user()->name)): ?>
              
              <a class="btn bluebtn" href="<?php echo e(url('/employer/logout')); ?>"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              <?php elseif(isset(Auth::guard('employee')->user()->firstname)): ?>
              
              <a class="btn bluebtn" href="<?php echo e(url('/employee/logout')); ?>"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              <?php else: ?>
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </header>
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
        <a class="btn bluecomnbtn">SEARCH EVENTS</a>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      
      <div class="row cm10-row">
        <div class="col-md-12">
             
          
          <div class="alert alert-danger">Sorry We can not find this Event. Please Visit Next Time</div>
          
        </div>
      </div>
    </div>
    
  </div>
</section>
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
<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/event/event_not_found.blade.php ENDPATH**/ ?>