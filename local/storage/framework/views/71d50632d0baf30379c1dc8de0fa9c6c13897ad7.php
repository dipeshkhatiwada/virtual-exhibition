<?php $__env->startSection('heading'); ?>
Booth/Stall
<small>Detail of New Booth/Stall</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
        <h3>Available <small>Stall price</small></h3>
        <div class="col-md-12">
            <div class="box-body">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>Company Name</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th class="center">Action</th>
                        </tr>
                    </thead>
                        <?php $i=1; ?>
                        <?php $__currentLoopData = $data['invoice']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i++); ?></td>
                            <td><?php echo e($val['company_name']); ?></td>
                            <td><?php echo e($val['amount']); ?></td>
                            <td><?php echo e($val['invoice_status']); ?></td>
                            <td><?php echo e($val['created_at']); ?></td>
                            <td>
                                <a href="<?php echo e(url('admin/enroll-invoice/view/'.$val->id)); ?>" class="btn whitegradient blueclr"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/invoice.blade.php ENDPATH**/ ?>