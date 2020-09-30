<?php if(count($datas['blogs']) > 0): ?>
<?php $firstarray = array_shift($datas['blogs']);?>
    <div class="row blogs">
                    <div class="col-6 col-md-6">
                        <h4 class="title_one"><?php echo e($datas['title']); ?></h4>
                    </div>
                    <div class="col-6 col-md-6">
                        <a href="<?php echo e($datas['href']); ?>" class="btn lightgreen_gradient lr15p right">View All</a>
                    </div>
                </div>
                <div class="row cm10-row news-content btm7m">
                    <div class="col-md-6 my-2 wow fadeInLeft">
                        <div class="boxborder p-2"> 
                            
                            <div class="desc">
                                <div class="img-box">
                                <img class="card-img-top" src="<?php echo e(asset($firstarray['image'])); ?>" alt="Card image cap">
                                <div class="overlay"></div>
                            </div>
                                <h2><a href="<?php echo e($firstarray['href']); ?>"><?php echo e($firstarray['title']); ?></a></h2>
                                <ul class="sub-title">
                                    <li><i class="far fa-eye"></i> <?php echo e($firstarray['view']); ?> </li>
                                    
                                    <li><i class="far fa-clock"> </i> <?php echo e($firstarray['date']); ?></li>
                                </ul>
                                <p class="hidden-md"><?php echo  $firstarray['description']; ?><br><a href="<?php echo e($firstarray['href']); ?>" class="btn btn-more">Readmore <i class="far fa-arrow-alt-circle-right"></i></a></p>
                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 my-2 wow fadeInRight">
                        <?php $__currentLoopData = $datas['blogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="boxborder btm5m">
                            <div class="row cm10-row">
                                <div class="col-md-5">
                                    <div class="img-box">
                                        <img src="<?php echo e(asset($blog['image'])); ?>">
                                        <div class="overlay"></div>
                                    </div>
                                </div>
                                <div class="col-md-7 content">
                                    <h5><a href="<?php echo e($blog['href']); ?>"><?php echo e($blog['title']); ?></a></h5>
                                    <ul class="sub-title">
                                        <li><i class="far fa-eye"></i> <?php echo e($blog['view']); ?> </li>
                                        <li><i class="far fa-clock"></i> <?php echo e($blog['date']); ?></li>
                                    </ul>
                                    <p class="hidden-md"><?php echo $blog['description']; ?></p>
                                </div>
                            </div>
                        </div>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                    </div>
                </div>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/listblog.blade.php ENDPATH**/ ?>