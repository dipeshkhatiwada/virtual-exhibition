<?php $__env->startSection('heading'); ?>
Enroll
<small>Reservation Dashboard</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">Reservation</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
      

            <div class="box">
                <div class="box-body">
                  <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Category</th>
                                <th>Company</th>
                                <th>Stall Reserved</th>
                                <th>Stall Paid</th>
                                <th>Remaining to Pay</th>
                                <th>Total Price</td>
                                <th>Payment Status</th>
                                <th>Platform</th>
                                <th>Publish</td>
                                <th class="center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $temp_category = '';
                                $i = 1;
                            ?>
                                <?php if( count($reservations)>0 ): ?>
                                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>

                                    <td><?php echo e($res->category->title); ?></td>

                                    <td><?php echo e($res->company_name); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $res['booth_res']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table>
                                                <tr>
                                                <td>
                                                    <?php echo e($data->booth_name); ?> | Rs. <?php echo e($data->price); ?>

                                                </td>
                                                </tr>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $res['paid_booth']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <table>
                                                <tr>
                                                <td>
                                                    <?php echo e($data->booth_name); ?> | <?php echo e($data->booth_type); ?> | Rs. <?php echo e($data->price); ?>

                                                </td>
                                                </tr>
                                            </table>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php if(count($res['unpaid_booth']) > 0): ?>
                                            <?php $__currentLoopData = $res['unpaid_booth']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <table>
                                                    <tr>
                                                    <td>
                                                        <?php echo e($data->booth_name); ?> | <?php echo e($data->booth_type); ?> | Rs. <?php echo e($data->price); ?>

                                                    </td>
                                                    </tr>
                                                </table>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                                -
                                        <?php endif; ?>
                                    </td>
                                    <td>NRs: <?php echo e($res->total_price); ?></td>

                                    <td> <?php if(count($res['paid_booth']) == count($res['booth_res'])): ?>  Completed <?php else: ?> Not Completed <?php endif; ?> </td>
                                    <td>
                                        <input type="hidden" id="reservationId" value="<?php echo e($res->id); ?>">
                                        <select id='selectplatform' width="144" style="height:19px; width:140px; text-align:center;">
                                            <option value="" selected>-Select-</option>
                                            <option id="agora">Agora</option>
                                            <option id="zoom">Zoom</option>
                                        </select>
                                        <?php if($res->platform): ?>
                                            <p><?php echo e($res->platform); ?> choosen</p>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <input type="checkbox" data-toggle="toggle" id="checkBoxId" value="<?php echo e($res->id); ?>" data-onstyle="success" <?php if($res->publish_status == 1): ?> checked <?php endif; ?>>
                                    </td>

                                    <td>
                                        <a href="<?php echo e(route('enroll_reservation.destroy', $res->id)); ?>" class="btn btn-danger btn-mini deleteRecord" title="Delete Category"><i class="fa fa-fw fa-trash"></i></a>

                                    </td>
                                    <?php $temp_category = $res->category->title ;

                                    ?>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>
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
    var base_url = window.location.origin+'/rollingnexus';

    $('select').on('change',function(){
        var platform = $(this).children(":selected").attr("id");

        // var platform =  $( "select option:selected" ).val();
        var reservation_id = $('#reservationId').val();
        console.log(platform);
        $.ajax({
            url:base_url+'/admin/enroll/update-platform',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            data: {
                'platform':platform,
                'reservationId': reservation_id,
            },
            success:function(response){
                console.log('Success');
            }
        });


})
</script>
<script>
$(document).ready(function(){

    $("input:checkbox").change(function() {
    var res_id = $(this).attr("value");
    $.ajax({
            type:'POST',
            url:'update-publish-status/'+res_id,
            headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            data: { "reservation_id" : res_id },
            success: function(response){
                console.log(response)
            }
        });
    });


});
</script>
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

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/enroll/reservation_details.blade.php ENDPATH**/ ?>