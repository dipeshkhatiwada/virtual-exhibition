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
                <div class="panel-heading">Enroll Category Detail</div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" id="testform" method="POST" action="<?php echo e(route('enroll.updateCategory', $category->id)); ?>">
                     <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-10">

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Enroll Type</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="type" value="<?php echo e($category->enroll->title); ?>" disabled>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Category Title</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="category_title" value="<?php echo e($category->title); ?>">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Seo Url</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="seo_url" value="<?php echo e($category->seo_url); ?>">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Seat Limit</label>

                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="seat_limit" value="<?php echo e($category->seat_limit); ?>">

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

<script type="text/javascript">
    $('#category_title').blur(function(){
    var data = $(this).val();
    var se_url = data.replace(/ /g,"-");
    $('#seo_url').val(se_url);
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/editCategory.blade.php ENDPATH**/ ?>