<?php if($data['payment_mode'] == 1): ?>

<div class="warning">Warning: The payment gateway is in Sandbox Mode. Your account will not be charged.</div>

<?php endif; ?>

<form action="<?php echo e($data['action']); ?>" method="POST">

  <input value="<?php echo e($data['total_amount']); ?>" name="tAmt" type="hidden">

 <input value="<?php echo e($data['total_amount']); ?>" name="amt" type="hidden">

 <input value="0" name="txAmt" type="hidden">

 <input value="0" name="psc" type="hidden">

 <input value="0" name="pdc" type="hidden">

 <input value="<?php echo e($data['scd']); ?>" name="scd" type="hidden">

 <input value="<?php echo e($data['id']); ?>" name="pid" type="hidden">

  

  <input type="hidden" name="su" value="<?php echo e($data['su']); ?>" />

 

  <input type="hidden" name="fu" value="<?php echo e($data['fe']); ?>" />

 

  <div class="buttons">
    <div class="center">
      <input type="submit" value="Confirm" class="btn lightgreen_gradient" />
    </div>
  </div>

</form><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/payments/esewa.blade.php ENDPATH**/ ?>