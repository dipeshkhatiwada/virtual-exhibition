<?php $__env->startSection('heading'); ?>
Event Category Detail 
            <small>Detail of Event Category</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
 <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo e(url('/admin/event_category')); ?>">Event Categories</a></li>
            <li class="active">Edit Event Category</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Event Category Detail</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="<?php echo e(url('/admin/event_category/update')); ?>">
                        <input type="hidden" name="id" value="<?php echo $data->id;?>" />
                        <?php echo csrf_field(); ?>

                        <div class="row">
                         <div class="col-md-10">
                       
                        
                         <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                            <label class="col-md-2 control-label">Title</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="title" value="<?php echo e($data->title); ?>">

                                <?php if($errors->has('title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                           <div class="form-group<?php echo e($errors->has('seo_url') ? ' has-error' : ''); ?>">
                            <label class="col-md-2 control-label">Seo Url</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="seo_url" value="<?php echo e($data->seo_url); ?>">

                                <?php if($errors->has('seo_url')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('seo_url')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        

                       
                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Save
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
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/event_category/editform.blade.php ENDPATH**/ ?>