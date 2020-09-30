<?php $__env->startSection('heading'); ?>
Enroll
<small>Create Enroll</small>
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
<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <div class="box">
                <div class="panel panel-default">
                    <div class="panel-heading">New Enroll</div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#mainevent" data-toggle="tab">Register Type</a></li>
                                        <li><a href="#category" data-toggle="tab">Register Category</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="mainevent">
                                            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll_type.save')); ?>">
                                                <?php echo csrf_field(); ?>

                                                <div class="form-group row <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                                                    <div class="col-md-6">
                                                    <label class="required">Enroll Type</label>
                                                    <input type="text" id="title"  name="title" class="form-control" placeholder="Entroll Type">
                                                    <?php if($errors->has('title')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                    <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="tab-pane" id="category">
                                            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll_category.save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row <?php echo e($errors->has('enroll_type') ? ' has-error' : ''); ?>">
                                                    <div class="col-md-6">
                                                    <label class="required">Enroll Type</label>
                                                        <select class="form-control" name="enroll_type">
                                                            <?php $__currentLoopData = $enroll_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option selected="selected" value="<?php echo e($type->id); ?>"><?php echo e($type->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php if($errors->has('enroll_type')): ?>
                                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('enroll_type')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="form-group row <?php echo e($errors->has('category_title') ? ' has-error' : ''); ?>">
                                                    <div class="col-md-3">
                                                        <label class="required">Title</label>
                                                        <input type="text" class="form-control" id="category_title" name="category_title" >
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
                                                        <input type="number" class="form-control" id="seat_limit" name="seat_limit">
                                                        <?php if($errors->has('seat_limit')): ?>
                                                        <span class="help-block">
                                                            <strong><?php echo e($errors->first('seat_limit')); ?></strong>
                                                        </span>
                                                        <?php endif; ?>
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

        <div class="col-sm-10">
            <div class="box">
                <div class="panel panel-default">
                    <div class="panel-heading">New Enroll</div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#mainbooth" data-toggle="tab">Register Booth/Stall</a></li>
                                        <li><a href="#boothprice" data-toggle="tab">Price for Booth/Stall</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="mainbooth">
                                            <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(route('enroll_booth.add')); ?>">
                                                <?php echo csrf_field(); ?>
                                                    <div class="form-group row <?php echo e($errors->has('booth_name') ? ' has-error' : ''); ?>">
                                                        <div class="col-md-4">
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
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                                                        </div>
                                                    </div>
                                            </form>

                                        </div>
                                        <div class="tab-pane" id="boothprice">
                                            <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(route('enroll_booth_ticket.save')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row <?php echo e($errors->has('booth_name') ? ' has-error' : ''); ?>">
                                                    <div class="col-md-6">
                                                    <label class="required">Booth/Stall Name</label>
                                                        <select class="form-control" name="booth_id">
                                                            <?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option selected="selected" value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
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

<script type="text/javascript">
    $('#category_title').blur(function(){
    var data = $(this).val();
    var se_url = data.replace(/ /g,"-");
    $('#seo_url').val(se_url);
});
</script>

<script type="text/javascript">
    sub_category = 1;

  function addCompany()
  {
    var html = '<tr id="sub_category_'+sub_category+'"><td><input type="text" name="title[]" class="form-control" placeholder="Company Name" required></td>';
        html += '<td><input type="text" name="video[]" class="form-control" placeholder="Youtube/One Drive Link" required></td>';
        html += '<td><button type="button" onclick="$(\'#sub_category_'+sub_category+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#sub_category').append(html);
        sub_category++;
  }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/newenroll.blade.php ENDPATH**/ ?>