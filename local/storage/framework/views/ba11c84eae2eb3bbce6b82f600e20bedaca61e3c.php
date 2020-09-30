<?php $__env->startSection('content'); ?>
  <h3 class="form_heading">Enroll<a href="<?php echo e(url('/employer/enroll/addnew')); ?>" class="btn lightgreen_gradient right">
    <i class="fa fa-fw fa-plus"></i>Add New Enroll</a>
    <div class="clear"></div>
  </h3>
  <div class="form_tabbar">
    <div class="table-responsive-lg">
      <table class="table table_form" id="display-table">
        <thead>
          <th>Company Name</th>
          <th>Booth/Stall</th>
          <th>Booth/Stall</th>
          <th>Price </th>
          <th>Payment Status</th>
          <th>Action</th>
        </thead>
        <tbody>
            <?php if(count($reserves)): ?>
            <?php $__currentLoopData = $reserves; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($res->reservations): ?>
                <td> <?php echo e($res->reservations->company_name); ?> </td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>
                <td> <?php echo e($res->booth_name); ?></td>
                <td> <?php echo e($res->booth_type); ?></td>
                <td> <?php echo e($res->price); ?></td>

                <?php if($res->reservations): ?>

                <td> <?php if($res->reservations->payment_status == 1): ?> Completed <?php else: ?> Not Completed <?php endif; ?></td>
                <?php else: ?>
                <td></td>
                <?php endif; ?>
                <td>
                    <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($res->id); ?>')" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</a>
                    <?php if($total_reservation < $res->reservations->category->seat_limit): ?>
                    <a class="btn lightgreen_gradient reserveBooth"
                        reservation-id="<?php echo e($res->reservations->id); ?>"
                        booth-id="<?php echo e($res->id); ?>"
                        >
                        <i class='fas fa-cart-plus'></i> &nbsp; Payment With</a>
                    <?php else: ?>
                        <p> Unavailable booth/stall right now. See you soon</p>
                    <?php endif; ?>
                </td>

            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <tr>
            <td colspan="6"><span class="col-md-12 alert alert-info">Sorry No any events found</span></td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>


<script type="text/javascript">
$(document).ready(function(){
    var base_url = window.location.origin+'/rollingnexus';

    $("a.reserveBooth").click(function(){
        var reservation_id = $(this).attr('reservation-id');
        var booth_id = $(this).attr('booth-id');

        if (booth_id){
            $.ajax({
                type: 'POST',
                url: base_url + '/employer/booth/reserve',
                headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                data:{
                    "booth_id": booth_id,
                    "reservation_id" : reservation_id,
                 },
                cache: false,
                success: function(response){
                  // console.log(response);
                  window.location.href = base_url + "/employer/booth/cart";
                }
            });
        } else{
            alert('Payment Option not seleted.');
        }

    });
});
</script>

<script type="text/javascript">
function confirm_delete(ids){
if(confirm('Do You Want To Delete This Data?')){
    var url= "<?php echo e(url('/employer/enroll/delete-booth/')); ?>" + ids;
    location = url;
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/payment_detail.blade.php ENDPATH**/ ?>