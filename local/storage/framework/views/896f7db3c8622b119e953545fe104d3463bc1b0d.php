<?php $__env->startSection('header'); ?>
<section>
  <div class="innerpage_banner">
    <div class="inner_overlay"></div>
    <div class="container z-index2">
      <?php echo $__env->make('front/common/job_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
             
          
          <div class="alert alert-danger donthavemessage">Sorry We can not find this Business Page. Please Visit Next Time</div>
          
        </div>
      </div>
    </div>
    
  </div>
</section>
<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '<?php echo e(url("/jobs/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/employer/employer_not_found.blade.php ENDPATH**/ ?>