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
          <th>Booth Type</th>
          <th>Price </th>
          <th>Payment Status</th>
          <th>Action</th>
        </thead>
        <tbody>
            <?php $dump = ''?>
            <?php if(count($reserve_booths)): ?>
            <?php $__currentLoopData = $reserve_booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $res): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <?php if($res->reservations->company_name == $dump): ?> --}}
            <td></td>
            <?php else: ?>
            <td> <?php echo e($res->reservations->company_name); ?> </td>
           <?php endif; ?>
            <td> <?php echo e($res->booth_name); ?> </td>
            <td> <?php echo e($res->booth_type); ?> </td>
            <td> <?php echo e($res->price); ?> </td>
            <td> <?php echo e($res->reservations->payment_status); ?></td>
            <td>
                
                
                
                <a href="javascript:void(0);" onClick="confirm_delete('/<?php echo e($res->id); ?>')" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</a>
                <a class="btn lightgreen_gradient reserveBooth"
                    booth-id="<?php echo e($res->id); ?>"
                    booth-name="<?php echo e($res->booth_name); ?>"
                    booth-type="<?php echo e($res->type); ?>"
                    booth-price="<?php echo e($res->price); ?>"
                    total-price="<?php echo e($res->reservations->total_price); ?>"

                    >
                    <i class='fas fa-cart-plus'></i> &nbsp; Payment With</a>
                </td>
          </tr>
          <?php $dump = $res->reservations->company_name; ?>
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
    $("a.reserveBooth").click(function(){
        var booth_id = $(this).attr('booth-id');
        var booth_name = $(this).attr('booth-name');
        var booth_type = $(this).attr('booth-type');
        var booth_price = $(this).attr('booth-price');
        var total_price = $(this).attr('total-price');
        var quantity = 1;
        // alert(booth_id + " " + quantity +" "+ booth_name + " " + booth_type + " " + booth_price + " " + total_price)

        if (booth_id) {
            $.ajax({
                type: 'POST',
                url: '/employer/booth/reserve',
                headers: {'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                data: 'booth_id='+booth_id+'&booth_name='+booth_name+'&booth_type='+booth_type+'&booth_price='+booth_price+'&quantity='+quantity+ +'&total_price='+total_price,
                cache: false,
                success: function(response){
                  console.log(response);
                //   window.location.href = "/employee/cart";
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
    var url= "<?php echo e(url('/employer/enroll/delete/')); ?>"+ids;
    location = url;
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/enroll.blade.php ENDPATH**/ ?>