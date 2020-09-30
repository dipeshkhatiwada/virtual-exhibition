<?php if(count($datas['employer']) > 0): ?>
<div class="white_block btm15m">
                <h3 class="h3 btm15m"><?php echo e($datas['title']); ?></h3>
                <div class="slider greybg platinum">
                	<?php $__currentLoopData = $datas['employer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div>
				<center>
					<a href="<?php echo e($employer['url']); ?>" alt="<?php echo e($employer['title']); ?>" title="<?php echo e($employer['title']); ?>"><img src="<?php echo e(asset($employer['image'])); ?>"></a>
				</center>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			
		</div>
            </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/employer_type.blade.php ENDPATH**/ ?>