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
            <a href="<?php echo e(url('/admin/enroll/add')); ?>" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Exhibition Type</a>
          </div>
            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Exhibition Type</th>
                                <th>Exhibition Category</th>
                                <th>seo_url</th>
                                <th>Seat Limit</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(count($enroll_categories) > 0): ?>

                                <?php $__currentLoopData = $enroll_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($cat->enroll->title); ?></td>
                                    <td><?php echo e($cat->title); ?></td>
                                    <td><?php echo e($cat->seo_url); ?></td>
                                    <td><?php echo e($cat->seat_limit); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('enroll.editCategory', $cat->id)); ?>" class="btn btn-success btn-mini" title="Edit Category"><i class="fa fa-fw fa-pencil"></i></a>
                                        <a href="<?php echo e(route('enroll.destroyCategory', $cat->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>
                                        <a href="<?php echo e(route('enroll.addCategory', $cat->id)); ?>" class="btn btn-info btn-mini" title="Add Category"><i class="fa fa-fw fa-plus"></i></a>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
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

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/detail.blade.php ENDPATH**/ ?>