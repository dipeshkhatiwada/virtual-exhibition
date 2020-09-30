<style>
 ._hide {
   visibility : hidden;
 }
</style>
<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">1</div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">2</div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">3</div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/subcategory.blade.php ENDPATH**/ ?>