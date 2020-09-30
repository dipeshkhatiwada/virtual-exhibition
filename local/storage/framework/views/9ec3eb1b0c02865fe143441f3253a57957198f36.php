<?php if(count($data['contacts']) > 0): ?>
    <?php $__currentLoopData = $data['contacts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="contact_user" id="contact_user_<?php echo e($contact['id']); ?>">
      <span class="user_image"><img src="<?php echo e(asset($contact['image'])); ?>"></span>
      <span class="user_name"><?php echo e($contact['name']); ?><?php if($contact['number_of']): ?><span id="count_msg<?php echo e($contact['id']); ?>"><?php echo e($contact['number_of']); ?></span><?php endif; ?></span>
      <?php if($contact['status']): ?>
      <span class="online_status"></span>
      <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employee/message_users.blade.php ENDPATH**/ ?>