<?php $__env->startSection('heading'); ?>
Enroll
<small>Enroll Dashboard</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Enroll</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <a href="<?php echo e(route('enroll.add')); ?>" class="btn btn-success right"><i class="fa fa-fw fa-plus">Add New Enroll</i></a>
    </div>
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Editable table</h3>
    <div class="card-body center">
        <div class="col-md-8">
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

                                foreach ($enroll_categories as $category) { ?>
                                <tr>
                                    <td><?php echo $i++ ;?></td>

                                    <td><?php echo e($category->enroll->title); ?></td>

                                    <td>
                                    <a href="<?php echo e(route('enroll.destroyCategory', $category->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Product">Delete</button>
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
    </div>

    
    
  </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/index1.blade.php ENDPATH**/ ?>