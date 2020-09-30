<?php if(count($datas['blogs']) > 0): ?>
<div class="popular">
<h2 class="title_one"><i class="fas fa-chart-line"></i> <?php echo e($datas['title']); ?></h2>
<div class="news-content blogbg btm15m">
<div class="row">
                    <div class="col-md-12">
                        
                        <?php $__currentLoopData = $datas['blogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="border-buttom btm10p">
                        <div class="row cm10-row mt-2">
                            <div class="col-md-3">
                            <div class="img-box">
                                <img src="<?php echo e(asset($blog['image'])); ?>">
                                <div class="overlay"></div>
</div>
                            </div>
                            <div class="col-md-9 content">
                                <h5><a href="<?php echo e($blog['href']); ?>"><?php echo e($blog['title']); ?></a></h5>
                                <ul class="sub-title">
                                    <li><i class="far fa-clock"></i> <?php echo e($blog['date']); ?></li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                </div>
                </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/popularblog.blade.php ENDPATH**/ ?>