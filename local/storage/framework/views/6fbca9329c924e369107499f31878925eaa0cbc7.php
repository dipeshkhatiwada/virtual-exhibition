<?php $__env->startSection('heading'); ?>
Virtual Exhibition
<small>Create Enroll</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Booth</li>
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
                    <div class="panel-heading">New Booth Name & Type</div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tab-content">
                                            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll_booth_ticket.save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row <?php echo e($errors->has('booth_name') ? ' has-error' : ''); ?>">
                                                    <div class="col-md-6">
                                                        <label class="required">Booth/Stall Name</label>
                                                        <input type="text" class="form-control" id="booth_name" name="booth_name">
                                                        <?php if($errors->has('booth_name')): ?>
                                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('booth_name')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
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
                                                                        <tr id="ticket_0">
                                                                        <td><input type="text" name="ticket[0][title]" class="form-control"></td>
                                                                        <td><input type="number" name="ticket[0][price]" class="form-control"></td>
                                                                        <td><button type="button" onclick="$('#ticket_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
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

<script type="text/javascript">
    $('#category_title').blur(function(){
    var data = $(this).val();
    var se_url = data.replace(/ /g,"-");
    $('#seo_url').val(se_url);
});
</script>

<script type="text/javascript">
    var ticket_row = 1;

  function addBoothTicketPrice()
  {
    var html = '<tr id="ticket_'+ticket_row+'"><td><input type="text" name="ticket['+ticket_row+'][title]" class="form-control"></td>';
            html += '<td><input type="number" name="ticket['+ticket_row+'][price]" class="form-control"></td>';
            html += '<td><button type="button" onclick="$(\'#ticket_'+ticket_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

            $('#booth_ticket').append(html);
            ticket_row++;
  }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/booth/create.blade.php ENDPATH**/ ?>