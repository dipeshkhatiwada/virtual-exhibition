<?php $__env->startSection('header'); ?>
<section class="rj_banner" style="height:150px;">
            <div class="container">
                <?php echo $__env->make('front/common/job_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="login_body">
    <div class="container form_section">
        <?php if(session('status')): ?>
            <div class="alert alert-success" style="font-size:18px; text-align:center;">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <div class="row cm-row">
            <div class="col-md-5 col-12 hidden-xs">
                <div class="login_info">
                    <h3 class="form_content individual-form-content blueclr">If you don't have an account. Please Sign up.</h3>
                    <div class="center tp20p"><a href="<?php echo e(url('/employee/register')); ?>" class="btn signupbtn ind_signup">Sign up</a></div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="ind_login_forms">
                    <form method="POST" action="<?php echo e(url('/employee/login')); ?>">
                        <?php echo csrf_field(); ?>

                        <h2 class="ind_form_title btm15m">Login</h2>
                        <div class="form-group row cm-row <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="Email" class="col-md-3 col-3 col-form-label">Username :</label>
                            <span class="col-md-1 col-1 form_icon icon_bg">
                                <i class="fa fa-user-circle"></i>
                            </span>
                            <div class="col-md-8 col-8">
                                <input type="email" class="form-control form_input login_input" id="Email" name="email" value="<?php echo e(old('email')); ?>" placeholder="info@example.com">
                            </div>
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group row cm-row">
                            <label for="Password" class="col-md-3 col-3 col-form-label">Password :</label>
                            <span class="col-md-1 col-1 form_icon icon_bg">
                                <i class="fa fa-key"></i>
                            </span>
                            <div class="col-md-8 col-8">
                                <input type="password" class="form-control form_input login_input" name="password" id="staticEmail" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row cm-row">
                            <label for="staticEmail" class="col-md-3 col-form-label"></label>
                            <div class="form-check">
                            <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1" value="1">
                            <label class="form-check-label check-label" for="gridCheck1">
                                Remember me
                            </label>
                        </div>
                        </div>
                        <div class="form-group row cm-row">
                            <label for="staticEmail" class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                              <button type="submit" class="btn form_whitebtn blueclr">Login</button>
                              <span class="forget"><a href="<?php echo e(url('employee/password')); ?>">Forgot Password ?</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5 col-12 hidden-lg hidden-md">
                <div class="login_info">
                    <h3 class="form_content individual-form-content">If you don't have an account. Please Sign up.</h3>
                    <div class="center tp20p"><a href="<?php echo e(url('/employee/register')); ?>" class="btn signupbtn individual-signup">Sign up</a></div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employee/login.blade.php ENDPATH**/ ?>