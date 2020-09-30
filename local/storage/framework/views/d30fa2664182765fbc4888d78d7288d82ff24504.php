



<?php if(count($data['contacts']) > 0): ?>
    <?php $__currentLoopData = $data['contacts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="business_user" id="contact_user_<?php echo e($contact['id']); ?>">
      <span class="user_image"><img src="<?php echo e(asset($contact['image'])); ?>"></span>
      <span class="user_name"><?php echo e($contact['name']); ?><?php if($contact['number_of']): ?><span id="count_msg<?php echo e($contact['id']); ?>"><?php echo e($contact['number_of']); ?></span><?php endif; ?></span>
      <?php if($contact['status']): ?>
      <span class="online_status"></span>
      <?php endif; ?>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<style>
.business .business_user{
  border-bottom: 1px dotted #ccc;
  padding: 2px;
  display: inline-block;
  width: 100%;
  cursor: pointer;
  position: relative;
}
.business_user .p_user{
  border-bottom: 1px dotted #ccc;
  padding: 2px;
  display: inline-block;
  width: 100%;
  cursor: pointer;
  position: relative;
}

.business_user .user_image{
  float: left;
  width: 30px;
  height: 30px;
  border: 1px solid #cccccc;
  border-radius: 50%;
  overflow: hidden;
}
.business_user .user_image img{
  width: 100%;
}
.business_user .user_name{
  margin-left: 5px;
  font-size: 11px;
  font-weight: 700;
  float: left;
  margin-top: 6px;
}
.business_user .user_name span{
  padding: 1px 5px;
  background: #005173;
  color: #ffffff;
  border-radius: 50%;
  margin-left: 5px;
}
.business_user .online_status{
  position: absolute;
  height: 5px;
  width: 5px;
  border-radius: 50%;
  top: 16px;
  right: 5px;
  background-color: GREEN;
}


</style>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/enroll/messages/message_user.blade.php ENDPATH**/ ?>