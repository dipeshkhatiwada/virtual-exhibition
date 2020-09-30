<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
      
        <div class="form_tabbar">
          <?php if(count($errors)): ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e('* : '.$error); ?></br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
            <ul class="nav nav-tabs form_tab" id="formTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="enroll-tab" data-toggle="tab" href="#mainenroll" role="tab" aria-controls="enrolls" aria-selected="true">Enroll Type</a>
            </li>
            
            </ul>
            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll_type.save')); ?>">
                <?php echo csrf_field(); ?>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="mainenroll" role="tabpanel" aria-labelledby="enroll-tab">
                        <div class="form-group row ">
                            <div class="col-md-6">
                                <label>Title</label>
                                <input type="text" id="title"  name="title" class="form-control" placeholder="Entroll List">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                            <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/type.blade.php ENDPATH**/ ?>