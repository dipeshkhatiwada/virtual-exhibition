<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12 careerfy-typo-wrap">
        <div class="careerfy-employer-dasboard">
        <!-- Profile Title -->
            <h3 class="form_heading">Order Detail</h3>
            <div class="invoice">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-header">
                            <img src="<?php echo e(asset('image/'.$data['logo'])); ?>" width="200px;">
                            <small class="pull-right">Date: <?php echo e($data['invoice']->created_at); ?><br><b>Invoice No. #<?php echo e($data['invoice']->invoice_no); ?></b></small>
                        </h2>
                     </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong><?php echo e($data['store']); ?></strong><br>
                            <?php echo e($data['store_address']); ?><br>

                            Phone: <?php echo e($data['store_phone']); ?><br>
                            Email: <?php echo e($data['store_email']); ?>

                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">

                    </div>

                    <div class="col-sm-4 invoice-col">

                        To
                        <address>
                            <strong><?php echo e($data['invoice']->company_name); ?></strong><br>
                            Email: <?php echo e($data['invoice']->email); ?><br>
                            Phone: <?php echo e($data['invoice']->telephone); ?>

                        </address>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table style="width: 100%;">
                            <thead style="background-color: #ddd; text-align: left;">
                                <tr>
                                <th style="padding:5px;">S.N.</th>
                                <th style="padding:5px;">Product Type</th>
                                <th style="padding:5px;">Category</th>
                                <th style="padding:5px;">Booth/Stall Name</th>
                                <th style="padding:5px;">Booth/Stall Type</th>
                                <th style="padding:5px;">Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php ($i = 1); ?>
                                    <?php $__currentLoopData = $data['invoice']->enrollinvoiceItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="padding:5px;"><?php echo e($i++); ?></td>
                                        <td style="padding:5px;"><?php echo e($item->type); ?></td>
                                        <td style="padding:5px;"><?php echo e($item->category); ?></td>
                                        <td style="padding:5px;"><?php echo e($item->booth_name); ?></td>
                                        <td style="padding:5px;"><?php echo e($item->booth_type); ?></td>
                                        <td style="padding:5px;">Rs. <?php echo e($item->amount); ?> </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <tr style="font-weight: bold;">
                                        <td colspan="5" style="text-align: right; padding-right: 10px; font-weight: 700">Total Amount</td>
                                    <td><strong>Rs. <?php echo e($data['invoice']->amount); ?></strong></td>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <p class="col-12 text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        <?php echo e($data['invoice']->comment); ?>

                    </p>

                    <p class="lead">Order History:</p>
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>

                                <th>Date</th>
                                <th>Comment </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php ($i = 1); ?>
                                <?php $__currentLoopData = $data['invoice']->enrollinvoiceHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e($history->created_at); ?></td>
                                    <td><?php echo e($history->comment); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <a href="<?php echo e(url('employer/enroll-invoice/print/'.$data['invoice']->id)); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/invoice/editform.blade.php ENDPATH**/ ?>