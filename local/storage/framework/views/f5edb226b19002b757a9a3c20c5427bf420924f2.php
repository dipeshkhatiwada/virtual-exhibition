<form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(url('/employer/bank/success')); ?>">
	<?php echo csrf_field(); ?>

	<div class="form-group row ">
		<div class="col-md-12">
			<textarea class="form-control" style="height: auto;" readonly="readonly">
				<?php echo $data->bank_instruction;?>
			</textarea>
		</div>
	</div>
	<div class="form-group row ">
		<div class="col-md-12 <?php echo e($errors->has('comment') ? ' has-error' : ''); ?>">
			<label class="required">Comment</label>
			<textarea class="form-control" name="comment" ><?php echo e(old('comment')); ?></textarea>
			
			<?php if($errors->has('comment')): ?>
			<span class="help-block">
				<strong><?php echo e($errors->first('comment')); ?></strong>
			</span>
			<?php endif; ?>
		</div>
	</div>

	<div class="form-group row ">
		<div class="col-md-12 <?php echo e($errors->has('file') ? ' has-error' : ''); ?>">
			<label class="required">Bank Voucher</label>
			<input type="file" name="file" class="form-control">
			
			<?php if($errors->has('file')): ?>
			<span class="help-block">
				<strong><?php echo e($errors->first('file')); ?></strong>
			</span>
			<?php endif; ?>
		</div>
	</div>
	
	<div class="form-group row ">
		<div class="center">
			<input type="submit" value="Conform" class="btn lightgreen_gradient" />
		</div>
	</div>
</form><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/payments/bank.blade.php ENDPATH**/ ?>