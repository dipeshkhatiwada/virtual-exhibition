<?php $__env->startSection('heading'); ?>
Edit Booth/Stall
<small>Detail of Booth/Stall</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Booth/Stall Information</div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="mainevent">
                                        <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(route('enroll.updateBootAttr', $ticket_type->id )); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row ">
                                                    <div class="col-md-6">
                                                        <label class="required">Booth/Stall Name</label>
                                                        <input type="hidden" name="idBooth" value="<?php echo e($ticket_type->booth->id); ?>">
                                                        <input type="text" class="form-control" id="booth_name" name="booth_name" value="<?php echo e($ticket_type->booth->booth_name); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive-lg">
                                                        <table class="table table_form table-hover" id="subcategory">
                                                            <thead>
                                                            <tr>
                                                                <th class="required">Ticket Type</th>
                                                                <th class="required">Price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="booth_ticket">
                                                                <tr id="booth_ticket_0">
                                                                <td><input type="text" name="ticket" class="form-control" placeholder="Ticket Type" value="<?php echo e($ticket_type->ticket_name); ?>" required></td>
                                                                <td><input type="number" name="price" class="form-control" placeholder="Price" value="<?php echo e($ticket_type->price); ?>" required></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
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
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/booth/edit.blade.php ENDPATH**/ ?>