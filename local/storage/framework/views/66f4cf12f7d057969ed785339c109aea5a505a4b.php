<?php if(count($datas['blogs']) > 0): ?>

<div class="row blogs mt-4 ">
                    <div class="col-6 col-md-6">
                        <h4 class="title_one"><?php echo e($datas['title']); ?></h4>
                    </div>
                    <div class="col-6 col-md-6">
                        <a href="<?php echo e($datas['href']); ?>" class="btn lightgreen_gradient lr15p right">View All</a>
                    </div>
                </div>
        <?php $__currentLoopData = array_chunk($datas['blogs'], 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blogs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row cm10-row sports-content mt-3 btm7m">
                   <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    
                    <div class='col-md-4'>
                        <div class="img-box">
                            <img class="card-img-top" src="<?php echo e(asset($blog['image'])); ?>" alt="Card image cap">
                            <div class="overlay"></div>
                        </div>
                        <div class="newsblock">
                            <h5><a href="<?php echo e($blog['href']); ?>" class="card-title"><?php echo e($blog['title']); ?></a></h5>
                            <span class="sub-title"><i class="fa fa-eye"></i> <?php echo e($blog['view']); ?> <i class="far fa-clock"></i> <?php echo e($blog['date']); ?> </span>
                            <p class="card-text"><?php echo  $blog['description']; ?></p>
                            <p class="text-right"><a href="<?php echo e($blog['href']); ?>" class="btn btn-readmore">Readmore <i class="fas fa-angle-double-right "></i></a></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php endif; ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/gridblog.blade.php ENDPATH**/ ?>