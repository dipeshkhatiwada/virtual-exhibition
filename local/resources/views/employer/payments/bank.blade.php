<form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="{{ url('/employer/bank/success') }}">
	{!! csrf_field() !!}
	<div class="form-group row ">
		<div class="col-md-12">
			<textarea class="form-control" style="height: auto;" readonly="readonly">
				<?php echo $data->bank_instruction;?>
			</textarea>
		</div>
	</div>
	<div class="form-group row ">
		<div class="col-md-12 {{ $errors->has('comment') ? ' has-error' : '' }}">
			<label class="required">Comment</label>
			<textarea class="form-control" name="comment" >{{ old('comment') }}</textarea>
			
			@if ($errors->has('comment'))
			<span class="help-block">
				<strong>{{ $errors->first('comment') }}</strong>
			</span>
			@endif
		</div>
	</div>

	<div class="form-group row ">
		<div class="col-md-12 {{ $errors->has('file') ? ' has-error' : '' }}">
			<label class="required">Bank Voucher</label>
			<input type="file" name="file" class="form-control">
			
			@if ($errors->has('file'))
			<span class="help-block">
				<strong>{{ $errors->first('file') }}</strong>
			</span>
			@endif
		</div>
	</div>
	
	<div class="form-group row ">
		<div class="center">
			<input type="submit" value="Conform" class="btn lightgreen_gradient" />
		</div>
	</div>
</form>