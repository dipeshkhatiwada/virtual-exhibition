<?php $__env->startSection('heading'); ?>
Virtual Exhibition
<small>Add Exhibition Category</small>
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
    <div class="col-sm-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Virtual Exhibition Category</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content">
                                        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll.addCategory', $category->enroll->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group row <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                                                <div class="col-md-6">
                                                    <label class="required">Exhibition Type</label>
                                                    <input type="hidden" name="idType" value="<?php echo e($category->enroll->id); ?>">
                                                    <input type="text" id="vtype"  name="vtype" class="form-control" value="<?php echo e($category->enroll->title); ?>" disabled>
                                                    <?php if($errors->has('title')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group row <?php echo e($errors->has('category_title') ? ' has-error' : ''); ?>">
                                                <div class="col-md-3">
                                                    <label class="required">Category</label>
                                                    <input type="text" class="form-control" id="category_title" name="category_title" placeholder="Category of Exhibition" >
                                                    <?php if($errors->has('category_title')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('category_title')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-md-3 <?php echo e($errors->has('seo_url') ? ' has-error' : ''); ?>">
                                                    <label class="required">Seo Url</label>
                                                    <input type="text" class="form-control" id="seo_url" name="seo_url">
                                                    <?php if($errors->has('seo_url')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('seo_url')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group row <?php echo e($errors->has('seat_limit') ? ' has-error' : ''); ?>">
                                                <div class="col-md-3">
                                                    <label class="required">Seat Limit</label>
                                                    <input type="number" class="form-control" id="seat_limit" name="seat_limit" placeholder="Seat Available">
                                                    <?php if($errors->has('seat_limit')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('seat_limit')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                <button type="submit" class="btn sendbtn bluebg">Add Category <i class="fab fa-telegram"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                            </div>
                        </div>

                    </div>
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

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/add_category.blade.php ENDPATH**/ ?>