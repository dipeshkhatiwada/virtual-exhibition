<?php $__env->startSection('content'); ?>
  <h3 class="form_heading">Event<a href="<?php echo e(url('/employer/event/addnew')); ?>" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Event</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive-lg">
      <table class="table table_form">
        <thead>
          <th>Title</th>
          <th>Venue</th>
          <th>Address</th>
          <th>Event Date</th>
          <th>Status</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php if(count($datas)): ?>
          <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
          <tr>
            <td><?php echo e($event->title); ?></td>
            <td><?php echo e($event->venue); ?></td>
            <td><?php echo e($event->address); ?></td>
            <td><?php echo e($event->event_date); ?></td>
            <td><?php echo e($event->status == 1 ? 'Active' : 'Deactive'); ?></td>
            <td>
              <a href="<?php echo e(url('/employer/event/edit/'.$event->id)); ?>" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</a></div>
              <?php if($event->user_type != 1): ?>
              <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($event->id); ?>')" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</a>
              <?php endif; ?>
              <?php if(
                isset($event->eventMeeting) &&
                Auth::guard('employer')->user()->id == $event->eventMeeting->created_by &&
                "$event->event_date"." "."$event->start_time" <= $dt &&
                "$event->to_date"." "."$event->end_time" >= $dt
              ): ?>
              <a href="<?php echo e($event->eventMeeting->start_url); ?>" target="_blank" class="btn whitegradient"><i class="fa fa-fw fa-play"></i> Start</a>
              <?php endif; ?>
            </td>
          </tr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <tr>
            <td colspan="6"><span class="col-md-12 alert alert-info">Sorry No any events found</span></td>
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
    var url= "<?php echo e(url('/employer/event/delete/')); ?>"+ids;
    location = url;
    }
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/event/index.blade.php ENDPATH**/ ?>