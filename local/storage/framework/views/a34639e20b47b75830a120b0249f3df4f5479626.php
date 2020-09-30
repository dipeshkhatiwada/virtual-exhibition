<?php $__env->startSection('header'); ?>
<section class="rj_banner">
            <div class="container rn_container">
                <?php echo $__env->make('front/common/common_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="reg_body">
      <div class="container reg_form">
        <div class="">
          <form method="POST" action="<?php echo e(url('/employer/password/email')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="forms reg_formwrap">
                    <h2 class="form_title btm15m">Reset Password</h2>
                         <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>


                     
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn lightgreen_gradient tb10m">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            
        </div>
      </div>
    </section>

    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/email.blade.php ENDPATH**/ ?>