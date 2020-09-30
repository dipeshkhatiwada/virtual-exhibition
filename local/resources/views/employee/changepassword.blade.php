@extends('employe_master')
@section('content')
    <h3 class="form_heading">{{\App\Employees::getFullname($user->firstname,$user->middlename,$user->lastname)}} Change Login Detail</h3>
    <div class="form_tabbar">
        <form class="dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/updatelogin') }}">
            <input type="hidden" name="id" value="<?php echo $user->id;?>" />
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-2 control-label required">E-Mail Address</label>
                        <div class="col-md-10">
                            <input type="email" required="required" class="form-control" name="email" value="{{ $user->email }}">
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
            
            <div class="form-group row">
                <div class="col-md-10 col-md-offset-4">
                    <button type="submit" class="btn bluebg sendbtn lft15m">
                    Update <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection