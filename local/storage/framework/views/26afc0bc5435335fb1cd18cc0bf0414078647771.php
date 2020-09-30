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
                            <th style="text-align: center"> Category </th>
                            <th style="text-align: center"> Company </th>
                            <th style="text-align: center"> Booth/Stall </th>
                            <th style="text-align: center"> Type </th>
                            <th style="text-align: center"> Price </th>
                            <th style="text-align: center"> Actions </th>
                        </thead>
                        <tbody>
                            <?php ($total = 0); ?>
                                <?php $__currentLoopData = $datas['cart']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td style="text-align: center"><?php echo e($cart['category']); ?></td>
                            <td style="text-align: center"><?php echo e($cart['company']); ?></td>
                                <td style="text-align: center"><?php echo e($cart['booth_name']); ?></td>
                                <td style="text-align: center"><?php echo e($cart['booth_type']); ?></td>
                                <td style="text-align: center"><?php echo e($cart['price']); ?></td>
                                <td style="text-align: center">
                                    <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($cart["id"]); ?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="4" style="text-align: right"><strong>Total Amount</strong></td>
                            <td colspan="2" style="text-align: left"><strong>NPRs. <?php echo e($datas['total_amount']); ?> </strong></td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <a href="<?php echo e(url('employer/checkout')); ?>" class="btn btn-success">Checkout</a>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                <?php else: ?>
                    <div style="clear: both;"></div>
                    <div class="alert alert-info text-center">
                        <span class="icon-circle-warning mr-2"></span>
                        Your Cart is Empty.
                        <a href="<?php echo e(url('employee/newjob')); ?>">
                            <strong>Post a Job, now!</strong></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function confirm_delete(ids) {
            var token = $('input[name=\'_token\']').val();
            if(confirm('Do You Want To Delete This Data?')){
                // $.ajax({
                //     type: 'DELETE',
                //     url: '/employee/cart'+ids,
                //     data: 'id='+ids+'&_token='+token,
                //     cache: false,
                //     success: function(html){
                //         location.reload();
                //     }
                // });
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll_cart.blade.php ENDPATH**/ ?>