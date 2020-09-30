
    <div class="contact_user" id="contact_user_<?php echo e($business_user['id']); ?>">
      <span class="user_image"><img src="<?php echo e(asset($business_user['image'])); ?>"></span>
      <span class="user_name"><?php echo e($business_user['name']); ?><?php if($business_user['number_of']): ?><span id="count_msg<?php echo e($business_user['id']); ?>"><?php echo e($business_user['number_of']); ?></span><?php endif; ?></span>
      <?php if($business_user['status']): ?>
      <span class="online_status"></span>
      <?php endif; ?>
    </div>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/messages/index.blade.php ENDPATH**/ ?>