<?php $__env->startSection('heading'); ?>
Event Category
            <small>List of Event Category</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
 <li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Event Category</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <div class="row">
    <div class="col-xs-12">
      <div class="row">
        <a href="<?php echo e(url('/admin/event_category/addnew')); ?>" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Event Category</a>
      </div>

      <div class="box">
            <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.N.</th>

                         <th>Title</th>


                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>

                      <?php $i=1;
                        foreach ($datas as $row) { ?>
                          <tr>
                        <td><?php echo $i++ ;?></td>

                         <td><?php echo $row->title;?></td>


                        <td><a href="<?php echo e(url('/admin/event_category/edit/'.$row->id)); ?>" class="btn btn-primary left"><i class="fa fa-edit"></i></a>
                        </td>
                      </tr>
                      <?php  }

                      ?>


                    </table>

          </div><!-- /.box-body -->
      </div>
    </div>
  <div>

  <div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $datas->render();?>
      </div>
    </div>
  </div>

  <script type="text/javascript">
 function confirm_delete(ids){
    if(confirm('Do You Want To Delete This event_category?')){
      var url= "<?php echo e(url('/admin/event_category/delete/')); ?>"+ids;
      location = url;

      }
    }
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/event_category/index.blade.php ENDPATH**/ ?>