<?php $__env->startSection('content'); ?>
<div class="row tp10p cm10-row">
                               
                    <div class="col-md-12">
                        <div class="common_bg tp10m">
                        <div class="job_cat_title">
                            <i class="fas fa-grip-vertical"></i> Checkout <?php echo csrf_field(); ?>

                        </div>
                                <div class="careerfy-employer-dasboard">
                                    <div class="careerfy-employer-box-section">
                                        <!-- Profile Title -->
                                       
                                        <div id="payments">
                                        <div class="form-group">
                                            <label class="col-md-12 ">Select Payment Option</label>
                                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p class="payments"><input type="radio" class="options" name="payment" value="<?php echo e($payment->id); ?>"> <?php echo e($payment->title); ?></p>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                         <button type="button" id="payment" class="btn sendbtn bluebg">Next <i class="fab fa-telegram"></i></button>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
<script type="text/javascript">
    $('#payment').click(function(){
        var id = $('input[type="radio"]:checked').val();
        var token = $('input[name=\'_token\']').val();
        if (id) {
             $.ajax({
                type: 'POST',
                url: '<?php echo e(url("/employer/checkout/payment")); ?>',
                data: 'id='+id+'&_token='+token,
                cache: false,
                success: function(html){
                    $('#payments').html(html);
                   
                }
            });
        } else{
            alert('Payment Option not seleted.');
        }
    })
</script>
                           
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/checkout.blade.php ENDPATH**/ ?>