<?php $__env->startSection('heading'); ?>
Enroll
<small>Enroll Dashboard</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Enroll</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
        <div class="row">
            <a href="<?php echo e(route('enroll.add')); ?>" class="btn btn-success right"><i class="fa fa-fw fa-plus"></i>Add New Enroll Category</a>
        </div>
        <div class="row">
        <div class="col-xs-12">

        <div class="row">
            <h3>Enroll  <small>Type</small></h3>
        </div>

            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Type</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i=1;
                            foreach ($enroll_types as $type) { ?>
                            <tr>
                                <td><?php echo $i++ ;?></td>
                                <td><?php echo e($type->title); ?></td>
                                <td>

                                    <a href="<?php echo e(route('enroll.destroyType', $type->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Type"><i class="fa fa-fw fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php  }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <div class="row">
                <h3>Enroll  <small>Category</small></h3>
            </div>

            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Seo_url</th>
                                <th>Seat Limit</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                                <?php $temp = ''; ?>

                                <?php $__currentLoopData = $enroll_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <?php if($category->enroll->title == $temp): ?>
                                    <td></td>
                                    <?php else: ?>
                                    <td><?php echo e($category->enroll->title); ?></td>
                                    <?php endif; ?>
                                    <td><?php echo e($category->title); ?></td>
                                    <td><?php echo e($category->seo_url); ?></td>
                                    <td><?php echo e($category->seat_limit); ?></td>

                                    <td>
                                    <a href="<?php echo e(route('enroll.editCategory', $category->id)); ?>" class="btn btn-success btn-mini" title="Edit Category"><i class="fa fa-fw fa-pencil"></i></button>

                                    <a href="<?php echo e(route('enroll.destroyCategory', $category->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $temp = $category->enroll->title;?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
            </div>
            </div>
            </div>
        </div>
    <div>

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

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/index.blade.php ENDPATH**/ ?>