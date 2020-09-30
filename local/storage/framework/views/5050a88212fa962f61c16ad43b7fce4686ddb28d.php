<?php $__env->startSection('heading'); ?>
Virtual Exhibition
<small>Exhibition Dashboard</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <a href="<?php echo e(url('/admin/enroll/booth/create')); ?>" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Booth</a>
          </div>
            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Booth/Stall Name</th>
                                <th>Ticket Type</th>
                                <th>Price</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <?php if(count($booth_types) > 0): ?>
                        <?php $title = '';?>
                        <?php $__currentLoopData = $booth_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>

                                <?php if($title == $type->booth->booth_name): ?>
                                <td></td>
                                <?php else: ?>
                                <td><?php echo e($type->booth->booth_name); ?> </td>
                                <?php endif; ?>
                                <td><?php echo e($type->ticket_name); ?></td>
                                <td><?php echo e($type->price); ?></td>
                                <td class="center">
                                    <a href="<?php echo e(route('enroll.editBoothAttr', $type->id)); ?>" class="btn btn-success btn-mini" title="Edit Booth"><i class="fa fa-fw fa-pencil"></i></a>
                                    <a href="<?php echo e(route('enroll.deleteBoothAttr', $type->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Type"><i class="fa fa-fw fa-trash"></i></a>
                                    <a href="<?php echo e(route('booth.add', $type->booth->id)); ?>" class="btn btn-info btn-mini" title="Add Ticket Type"><i class="fa fa-fw fa-plus"></i></a>

                                </td>
                                <?php $title = $type->booth->booth_name; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
    <?php if(Session::has('message')): ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo session('message'); ?></strong>
    </div>
    <?php endif; ?>
</div>
<script type="text/javascript">
$(document).ready(function(){


    $('.deleteRecord').click(function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, You will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
                swal("Deleted!", "Your File has been deleted.", "success");            }
            else {
                swal("Cancelled", "Your File is safe", "error");
              }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/booth/detail.blade.php ENDPATH**/ ?>