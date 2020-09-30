<?php $__env->startSection('heading'); ?>
Booth/Stall
<small>Detail of New Booth/Stall</small>
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
                <div class="panel-heading">New Booth/Stall</div>
                <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#mainevent" data-toggle="tab">Register Booth/Stall</a></li>
                                    <li><a href="#booth_ticket" data-toggle="tab">Price for Booth/Stall</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="mainevent">
                                    <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(route('enroll_booth.save')); ?>">
                                        <?php echo csrf_field(); ?>
                                            <div class="form-group row ">
                                                <div class="col-md-4">
                                                    <label class="required">Booth/Stall Name</label>
                                                    <input type="text" class="form-control" id="booth_name" name="booth_name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="tab-pane" id="booth_ticket">
                                        <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(route('enroll_booth_ticket.save')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group row ">
                                                <div class="col-md-6">
                                                <label class="required">Booth/Stall Name</label>
                                                    <select class="form-control" name="booth_name">
                                                        <?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option selected="selected" value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
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
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="booth_ticket">
                                                            <tr id="booth_ticket_0">
                                                            <td><input type="text" name="ticket[]" class="form-control" placeholder="Ticket Type" required></td>
                                                            <td><input type="number" name="price[]" class="form-control" placeholder="Price" required></td>
                                                            <td><button type="button" onclick="$('#booth_ticket_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                            <td colspan="5"><button type="button" onclick="addBoothTicketPrice();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Sub Category</button></td>
                                                            </tr>
                                                        </tfoot>
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



<script type="text/javascript">
    booth_ticket = 1;

  function addBoothTicketPrice()
  {
    var html = '<tr id="booth_ticket_'+booth_ticket+'"><td><input type="text" name="ticket[]" class="form-control" placeholder="Ticket Type" required></td>';
        html += '<td><input type="number" name="price[]" class="form-control" placeholder="Price" required></td>';
        html += '<td><button type="button" onclick="$(\'#booth_ticket_'+booth_ticket+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#booth_ticket').append(html);
        booth_ticket++;
  }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/booth/createb.blade.php ENDPATH**/ ?>