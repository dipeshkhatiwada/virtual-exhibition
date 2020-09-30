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
<section class="reg_body">
      <div class="container reg_form">
        <div class="">
            <form method="POST" action="<?php echo e(url('/employer/register')); ?>">
              <?php echo csrf_field(); ?>

            <div class="forms reg_formwrap">
            <h2 class="form_title btm15m">Register</h2>
             <?php if(Session::has('alert-danger') || Session::has('alert-success')): ?>
                <div class="row">
                  <div class="col-md-12">
                    <?php if(Session::has('alert-danger')): ?>
                    <div class="alert alert-danger"><?php echo e(Session::get('alert-danger')); ?></div>
                    <?php endif; ?>
                    <?php if(Session::has('alert-success')): ?>
                    <div class="alert alert-success"><?php echo e(Session::get('alert-success')); ?></div>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endif; ?>
            <div class="form-group row cm-row <?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
              <label for="orgname" class="col-md-3 col-form-label hidden-xs">Organization Name :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-building"></i>
              </span>
                <div class="col-md-8 col-11 orgname">
                  <input type="text" name="name" class="form-control form_input login_input" id="orgname" value="<?php echo e(old('name')); ?>" autocomplete="off" placeholder="name of organization">
                  <input type="hidden" name="employer_id" id="employer_id" value="<?php echo e(old('employer_id')); ?>">
                  <div id="orglist" class="col-md-12 orglist">
                  </div>
                </div>
                <?php if($errors->has('name')): ?>
                  <span class="invalid-feedback">
                      <strong><?php echo e($errors->first('name')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>

            <div class="form-group row cm-row <?php echo e($errors->has('org_type') ? ' has-error' : ''); ?>">
              <label for="orgtype" class="col-md-3 col-form-label hidden-xs">Organization Type :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-random"></i>
              </span>
              <div class="col-md-8 col-11">
                <select id="orgtype" name="org_type" class="form-control form_input login_input" id="orgtype" placeholder="type of organization">
                  <option value="">Select type</option>
                  <?php $__currentLoopData = $org_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($type->id == old('org_type')): ?>
                  <option selected="selected" value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <?php if($errors->has('org_type')): ?>
              <span class="invalid-feedback">
                <strong><?php echo e($errors->first('org_type')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
            <div class="form-group row cm-row <?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
              <label for="phone" class="col-md-3 col-form-label hidden-xs">Phone No. :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-blender-phone"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="text" name="phone" class="form-control form_input login_input" id="phone" value="<?php echo e(old('phone')); ?>" placeholder="phone number">
                </div>
                <?php if($errors->has('phone')): ?>
                  <span class="invalid-feedback">
                    <strong><?php echo e($errors->first('phone')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>

            <div class="form-group row cm-row <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
              <label for="email" class="col-md-3 col-form-label hidden-xs">Email :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-envelope"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="email" name="email" class="form-control form_input login_input" id="email" value="<?php echo e(old('email')); ?>" placeholder="info@example.com">
                </div>
                <?php if($errors->has('email')): ?>
                  <span class="invalid-feedback">
                      <strong><?php echo e($errors->first('email')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>
            <div class="form-group row cm-row <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
              <label for="password" class="col-md-3 col-form-label hidden-xs">Password :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-key"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="password" name="password" class="form-control form_input login_input" id="password" placeholder="type your password">
                </div>
                <?php if($errors->has('password')): ?>
                  <span class="invalid-feedback">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>
            <div class="form-group row cm-row ">
              <label for="Password" class="col-md-3 col-form-label hidden-xs">Confirm Password:</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-key"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="password" name="password_confirmation" class="form-control form_input login_input" id="staticEmail" placeholder="Password">
                </div>
            </div>
            <div class="form-group row cm-row">
              <label for="staticEmail" class="col-md-3 col-form-label hidden-xs"></label>
              <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck1" checked="checked" name="term_condition" value="1">
                  <label class="form-check-label check-label" for="gridCheck1">
                     <a href="<?php echo e(url('term-condition')); ?>"> I Agree Terms & Conditions</a>
                  </label>
                  <?php if($errors->has('term_condition')): ?>
                    <span class="invalid-feedback">
                      <strong><?php echo e($errors->first('term_condition')); ?></strong>
                    </span>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="form-group footer_reg row cm-row">
            <label for="staticEmail" class="col-md-3 col-form-label"></label>
            <div class="col-md-9">
                <button type="submit" class="btn reg_whitebtn lft15m">Register</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $('#orgname').on('keypress', function()
      {
        var token = $('input[name=\'_token\']').val();
        var name = $(this).val();
    $.ajax({
         type: 'POST',
            url: '<?php echo e(url("/employer/register/getName")); ?>',
            data: '_token='+token+'&name='+name,
            cache: false,
            success: function(html){
              if (html != '') {
                $('#orglist').html(html).fadeIn();
                $('.org-list').on('click', function(){
                  var id = $(this).attr('id');
                  var title = $('#title_'+id).html();
                  var org_type = $('#type_'+id).val();
                  $('#orgname').val(title);
                  $('#employer_id').val(id);
                  $('#orgtype').val(org_type);
                  $('#orgtype').trigger('change');
                  $('#orglist').html('').fadeOut();
                })
              } else{
                $('#orglist').html('').fadeOut();
               
            }
              }
      });
      })

      
    </script>
<?php $__env->stopSection(); ?>













<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/register.blade.php ENDPATH**/ ?>