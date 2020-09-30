@extends('employer_master')
@section('content')

<h3 class="form_heading">{{Auth::guard('employer')->user()->name}} Login Detail</h3>
<form id="testform" class="dash_forms flex" role="form" method="POST" action="{{ url('/employer/updatelogin') }}">
    <input type="hidden" name="id" value="<?php echo Auth::guard('employer')->user()->id;?>" />
    {!! csrf_field() !!}
    <div class="col-lg-6 col-md-12">
        <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="col-md-4 col-sm-4 col-xs-6 control-label required">E-Mail Address</label>
            <div class="col-md-8 col-sm-8 col-xs-6">
                <input type="email" required="required" class="form-control" name="email" value="{{ Auth::guard('employer')->user()->email }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="col-md-4 col-sm-4 col-xs-6 control-label required">Password</label>
            <div class="col-md-8 col-sm-8 col-xs-6">
                <input type="password" required="required" class="form-control" name="password">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="col-md-4 col-sm-4 col-xs-6 control-label required">Confirm Password</label>
            <div class="col-md-8 col-sm-8 col-xs-6">
                <input type="password" required="required" class="form-control" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-4">
                <button type="submit" class="btn sendbtn bluebg">
                    Update <i class="fa fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</form>
              
@endsection