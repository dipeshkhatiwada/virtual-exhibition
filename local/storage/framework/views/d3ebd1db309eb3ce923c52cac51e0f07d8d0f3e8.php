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
          <!-- /.col -->
        </div>
        <!-- info row -->
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
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            
            To
            <address>
              <strong><?php echo e($data['invoice']->customer_name); ?></strong><br>
              
              Phone: <?php echo e($data['invoice']->telephone); ?><br>
              Email: <?php echo e($data['invoice']->email); ?>

            </address>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
              <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Product</th>
                      <th>Product Type </th>
                      <th>Duration</th>
                      <th>Subtotal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php ($i = 1); ?>
                    <?php $__currentLoopData = $data['invoice']->invoiceItem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($i++); ?></td>
                      <td><?php echo e($item->name); ?></td>
                      <td><?php echo e($item->type); ?></td>
                      <td><?php echo e($item->duration); ?> <?php echo e($item->type == 'MemberUpgrade' ? 'Month(s)' : 'Day(s)'); ?></td>
                      <td>Rs. <?php echo e($item->amount); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tfoot>
                    <tr>
                      <td colspan="4"><strong style="float: right;">Grand Total:</strong></td>
                      <td><strong>Rs. <?php echo e($data['invoice']->amount); ?></strong></td>
                    </tr>
                    </tfoot>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
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
                      <!-- <th>Status</th> -->
                      
                      <th>Document</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php ($i = 1); ?>
                    <?php $__currentLoopData = $data['invoice']->invoiceHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      
                      <td><?php echo e($history->created_at); ?></td>
                      <td><?php echo e($history->comment); ?></td>
                      <!-- <td><?php echo e($history->invoice_status); ?></td> -->
                      
                      <td>
                        <?php if($history->document != ''): ?>
                        <a href="<?php echo e(url('image/checkout/'.$history->document)); ?>" target="_blank" class="btn btn-default"><i class="fa fa-download"></i> Download</a>
                        <?php endif; ?>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            
      </div>
    </div>
  </div>
</div>
<div class="invoice">
<p class="lead">Add History:</p>
            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(url('/employee/invoice/add-history')); ?>">
              <?php echo csrf_field(); ?>

              <input type="hidden" name="invoice_id" value="<?php echo e($data['invoice']->id); ?>">
              <div class="form-group row ">
                <div class="col-md-12 <?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
                  <label class="required">comment</label>
                   <textarea class="form-control" name="comment"><?php echo e(old('comment')); ?></textarea>
                  <?php if($errors->has('comment')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('comment')); ?></strong>
                    </span>
                  <?php endif; ?>
                </div>
               
                
              </div>
              <div class="form-group row ">
                <div class="col-md-12 <?php echo e($errors->has('file') ? ' has-error' : ''); ?>">
                  <label>file</label>
                   <input type="file" name="file" class="form-control">
                  <?php if($errors->has('file')): ?>
                    <span class="help-block">
                      <strong><?php echo e($errors->first('file')); ?></strong>
                    </span>
                  <?php endif; ?>
                </div>
               
                
              </div>
              
               <div class="form-group row">
            <div class="col-md-12">
              <button type="submit" class="btn sendbtn bluebg" style="padding: 10px;">Submit <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
             
            </form>
            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class="col-12">
                <a href="<?php echo e(url('employee/invoice/print/'.$data['invoice']->id)); ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
              </div>
            </div>
          </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.event-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employee/invoice/editform.blade.php ENDPATH**/ ?>