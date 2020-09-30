<?php if(count($datas['category']) > 0): ?>
<div class="white_block lft_block tp20m">
	<h3 class="title_three btm10m"><?php echo e($datas['title']); ?></h3>
	<ul>
		<?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><a href="<?php echo e($category['url']); ?>" ><?php echo e($category['title']); ?> <span>(<?php echo e($category['total']); ?>)</span></a></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/project_category.blade.php ENDPATH**/ ?>