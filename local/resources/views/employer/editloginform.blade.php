@extends('employer_master')
@section('heading')
Employer Login Detail 
            <small>Detail of Employer Login</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/employers') }}">Employers</a></li>
            <li class="active">Edit Employer Login</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Employer Login Detail</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/employers/updatelogin') }}">
                        <input type="hidden" name="id" value="<?php echo $data->id;?>" />
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                       
                        
                       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">E-Mail Address</label>

                            <div class="col-md-10">
                                <input type="email" required="required" class="form-control" name="email" value="{{ $data->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Password</label>

                            <div class="col-md-10">
                                <input type="password" required="required" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Confirm Password</label>

                            <div class="col-md-10">
                                <input type="password" required="required" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                       
                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn sendbtn bluebg">
                                    Save <i class="fa fa-fw fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection