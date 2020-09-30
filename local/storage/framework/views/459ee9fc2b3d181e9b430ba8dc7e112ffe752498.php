<?php $__env->startSection('content'); ?>

  <h3 class="form_heading">training<a href="<?php echo e(url('/employer/training/addnew')); ?>" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Training</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive">
      <table class="table table_form">
        <thead>
          <th>Title</th>
          <th>Venue</th>
          <th>Address</th>
          <th>Opening Date</th>
          <th>Closing Date</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php if(count($datas)): ?>
          <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
          <tr>
            <td><?php echo e($training->title); ?></td>
            <td><?php echo e($training->venue); ?></td>
            <td><?php echo e($training->address); ?></td>
            <td><?php echo e($training->start_date); ?></td>
            <td><?php echo e($training->end_date); ?></td>
            <td><?php echo e($training->status == 1 ? 'Active' : 'Deactive'); ?></td>
            <td>
              <a href="<?php echo e(url('/employer/training/edit/'.$training->id)); ?>" class="btn whitegradient greenclr left"><i class="fa fa-edit"></i> Edit</a></div>
              <?php if($training->user_type != 1): ?>
              <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($training->id); ?>')" class="btn whitegradient redclr left"><i class="fa fa-fw fa-remove"></i> Delete</a>
              <?php endif; ?>
            </td>
          </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <tr>
            <td colspan="7"><span class="col-md-12 alert alert-info">Sorry No any trainings found</span></td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $datas->render();?>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  function confirm_delete(ids){
  if(confirm('Do You Want To Delete This Data?')){
    var url= "<?php echo e(url('/employer/training/delete/')); ?>"+ids;
    location = url;
    }
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/training/index.blade.php ENDPATH**/ ?>