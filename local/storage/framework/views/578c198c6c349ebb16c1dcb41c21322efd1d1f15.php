<?php if(count($datas['blogs']) > 0): ?>

<div id="rwslider" class="carousel slide btm7m" data-ride="carousel">
							<ol class="carousel-indicators">
								<?php $__currentLoopData = $datas['blogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li data-target="#rwslider" data-slide-to="<?php echo e($key); ?>" class=""></li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ol>
							<div class="carousel-inner" role="listbox">
								<?php $__currentLoopData = $datas['blogs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="carousel-item carousel-item-next ">
									<img class="first-slide" src="<?php echo e(asset($blog['image'])); ?>" alt="First slide">
								<div class="carousel-caption d-none d-md-block">
									<h2 class="wow fadeInDown btm10m"><?php echo e($blog['title']); ?></h2>
									<a class="btn lightgreen_gradient lr15p" href="<?php echo e($blog['href']); ?>" role="button">Readmore <i class="far fa-arrow-alt-circle-right"></i></a>
								</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<a class="carousel-control-prev" href="#rwslider" role="button" data-slide="prev">
								<div class="arrow-left">
									<span class="carousel-control-prev-icon " aria-hidden="true"></span>
								</div>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#rwslider" role="button" data-slide="next">
								<div class="arrow-right">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								</div>
								<span class="sr-only">Next</span>
							</a>
					</div>

<?php endif; ?>
		<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/slider.blade.php ENDPATH**/ ?>