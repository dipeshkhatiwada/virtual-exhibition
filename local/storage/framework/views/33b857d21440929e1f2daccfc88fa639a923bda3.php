<?php $__env->startSection('content'); ?>
    <h3 class="form_heading">Enroll<a href="<?php echo e(url('/employer/enroll/addnew')); ?>" class="btn lightgreen_gradient right">
        <i class="fa fa-fw fa-plus"></i>Add New Enroll</a>
        <div class="clear"></div>
    </h3>
    <div class="form_tabbar">
        <div class="table-responsive-lg">
            <table class="table table_form" id="display-table">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Category</th>
                        <th>Company name</th>
                        <th>Website</th>
                        <th>Intro Video Link </th>
                        <th>Stall Reserved</th>
                        <th class="center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                        $i = 1;
                    ?>
                    <?php if( count($reservations)>0 ): ?>
                    <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($i++); ?></td>

                            <td><?php echo e($res->category->title); ?></td>

                            <td><?php echo e($res->company_name); ?></td>
                            <td><?php echo e($res->company_website); ?> </td>
                            <td><?php echo e($res->intro_video); ?></td>
                            <td>
                                <?php $__currentLoopData = $res['boothreserves']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <table>
                                        <tr>
                                        <td>
                                            <?php echo e($booth->booth_name); ?> | <?php echo e($booth->booth_type); ?> | Rs. <?php echo e($booth->price); ?>

                                        </td>
                                        <td>
                                            <a href="<?php echo e(url('/employer/enroll/delete-booth/'.$booth->id)); ?>" class="btn whitegradient redclr deleteRecord" title="Delete Booth"><i class="fa fa-trash"></i></a>

                                            
                                        </td>
                                        </tr>
                                    </table>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td>
                                <a href="<?php echo e(url('/employer/enroll/edit/'.$res->id)); ?>" class="btn btn-success btn-mini" title="Edit Booth"><i class="fa fa-fw fa-pencil"></i></a>
                                <a href="<?php echo e(url('/employer/enroll/all-delete/'.$res->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
    <?php if(Session::has('message')): ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo session('message'); ?></strong>
    </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $('.deleteRecord').click(function (e){
        e.preventDefault();
        var url = $(this).attr('href');
        swal({
            title: "Are you sure?",
            text: "Once deleted, You will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                window.location.href = url;
                swal("Deleted!", "Your File has been deleted.", "success");            }
            else {
                swal("Cancelled", "Your File is safe", "error");
              }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/enroll_detail.blade.php ENDPATH**/ ?>