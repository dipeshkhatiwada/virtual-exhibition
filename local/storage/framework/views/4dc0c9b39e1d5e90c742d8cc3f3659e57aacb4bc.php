<?php $__env->startSection('content'); ?>
<div class="row tp10p cm10-row">
                               
                    <div class="col-md-12">
                    <div class="common_bg tp10m">
                        <div class="job_cat_title">
                            <i class="fas fa-grip-vertical"></i> Cart Items
                        </div>
                                        <?php if(count($datas['cart']) > 0): ?>

                                         <table class="table table_form">

                                           <thead>
                                                <th>Service Type</th>
                                                <th>Type</th>
                                                <th>Duration</th>
                                                <th>Amount</th>
                                                <th>Number</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php ($total = 0); ?>
                                                 <?php $__currentLoopData = $datas['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($cart['type']); ?></td>
                                                    <td><?php echo e($cart['job_type']); ?></td>
                                                    <td><?php echo e($cart['duration']); ?> <?php echo e($cart['type'] == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'); ?></td>
                                                    <td>NPRs. <?php echo e($cart['amount']); ?></td>
                                                    <td><?php echo e($cart['job_number']); ?></td>
                                                    <td> 
                                                        <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($cart["id"]); ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php ($total += $cart['amount']); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <td colspan="3"><strong>Total Amount</strong></td>
                                                <td colspan="2"><strong>NPRs. <?php echo e($total); ?></strong></td>
                                            </tr>
                                            <tr>
                                                 <td colspan="3"><a href="<?php echo e(url('employer/buy_package')); ?>" class="btn btn-primary">Buy Package</a></td>
                                                <td colspan="2"><a href="<?php echo e(url('employer/checkout')); ?>" class="btn btn-success">Checkout</a></td>
                                            </tr>
                                            </tfoot>
                                       
                                       </table>
                                      
                                        <?php else: ?>
                                        <div style="clear: both;"></div>
                                        <div class="alert alert-info text-center">
                                                <span class="icon-circle-warning mr-2"></span>
                                                Your Cart is Empty.
                                                <a href="<?php echo e(url('employer/newjob')); ?>">
                                                    <strong>Post a Job, now!</strong></a>
                                                </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
<script type="text/javascript">
    function confirm_delete(ids) {
        if(confirm('Do You Want To Delete This Data?')){
              var url= "<?php echo e(url('/employer/cart/delete/')); ?>"+ids;
              location = url;
              
              }
    }
</script>
                           
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/cart.blade.php ENDPATH**/ ?>