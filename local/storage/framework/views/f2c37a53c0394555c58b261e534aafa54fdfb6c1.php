<?php $__env->startSection('heading'); ?>
Enroll
<small>Edit Category</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Enroll</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
<div class="row">
    <div class="col-xs-10">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Company List</div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="<?php echo e(route('enroll.updateCompany', $company->id)); ?>">
                     <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-10">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Type</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="type" value="<?php echo e($company->category->enroll->title); ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Category</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="category" value="<?php echo e($company->category->title); ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Company Name</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="company_name" value="<?php echo e($company->title); ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">video Link</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="video" value="<?php echo e($company->video); ?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/editCompany.blade.php ENDPATH**/ ?>