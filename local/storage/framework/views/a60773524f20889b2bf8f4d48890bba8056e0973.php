<?php $__env->startSection('heading'); ?>
Invoice
            <small>List of Invoice</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
 <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">Invoice</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-xs-12">
      <!-- <div class="row"> -->
        <!-- <a href="<?php echo e(url('/admin/event_category/addnew')); ?>" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Event Category</a> -->
      <!-- </div> -->
     
      <div class="box">
          <?php if(count($datas) > 0): ?>
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Employee</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($job['employee']->firstname); ?> <?php echo e($job['employee']->lastname); ?></td>
                          <td><?php echo e($job->amount); ?></td>
                          <td><?php echo e($job['invoice_status']); ?></td>
                          <td><?php echo e($job->created_at); ?></td>
                          <td> 
                              <a href="<?php echo e(url('admin/invoice/view/'.$job->id)); ?>" class="btn btn-sm btn-primary left"><i class="fa fa-eye"></i> View</a>
                              <!-- <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($job->id); ?>')" class="btn btn-sm btn-danger left"><i class="fa fa-trash-alt"></i> Delete</a> -->
                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              <!-- /.col -->
            <!-- Pagination -->
            <div class="careerfy-pagination-blog">
                 <?php echo $datas->render();?>
            </div>
          <?php else: ?>
            <div style="clear: both;"></div>
            <div class="alert alert-info text-center">
                    <span class="icon-circle-warning mr-2"></span>
                    You don't have any Orders at the moment.
                    </div>
          <?php endif; ?>
      </div>
    </div>
  </div>
  
  <!-- <script type="text/javascript">
 function confirm_delete(ids){
   console.log(ids);
      if(confirm('Do You Sure You Want To Delete?')){
        var url= "<?php echo e(url('/admin/invoice/delete')); ?>"+ids;
        location = url;
      }
    }
 </script> -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/invoice/index.blade.php ENDPATH**/ ?>