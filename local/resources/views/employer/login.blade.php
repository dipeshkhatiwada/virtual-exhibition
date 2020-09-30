@extends('front.job-master')
@section('header')
<section class="rj_banner" style="height:150px;">
            <div class="container">
                @include('front/common/job_header')
            </div>
</section>
@stop

@section('banner')

@stop

@section('content')

<section class="login_body">
            <div class="container form_section">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row cm-row">
                    <div class="col-md-5 hidden-xs">
                        <div class="login_info">
                            <h3 class="form_content">If you don't have an account. Please Sign up.</h3>
                            <div class="center tp20p"><a href="{{url('/employer/register')}}" class="btn signupbtn">Sign up</a></div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="forms">
                            <form method="POST" action="{{ url('/employer/login') }}">
                       {!! csrf_field() !!}
                                <h2 class="form_title btm15m">Login</h2>
                                <div class="form-group row cm-row {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="Email" class="col-md-3 col-form-label">Username :</label>
                                    <span class="col-md-1 col-2 form_icon">
                                        <i class="fa fa-user-circle"></i>
                                    </span>
                                    <div class="col-md-8 col-10">
                                        <input type="email" class="form-control form_input login_input" id="Email" name="email" value="{{old('email')}}" placeholder="info@example.com">
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group row cm-row">
                                    <label for="Password" class="col-md-3 col-form-label">Password :</label>
                                    <span class="col-md-1 col-2 form_icon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <div class="col-md-8 col-10">
                                        <input type="password" class="form-control form_input login_input" name="password" id="staticEmail" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group row cm-row">
                                    <label for="staticEmail" class="col-md-3 col-form-label"></label>
                                    <div class="form-check">
                                    <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1" value="1">
                                    <label class="form-check-label check-label" for="gridCheck1">
                                        Remember me
                                    </label>
                                </div>
                                </div>
                                <div class="form-group row cm-row">
                                    <label for="staticEmail" class="col-md-3 col-form-label"></label>
                                    <div class="col-md-9">
                                      <button type="submit" class="btn form_whitebtn">Login</button>
                                      <span class="forget"><a href="{{ url('employer/password') }}">Forgot Password ?</a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5 hidden-lg hidden-sm hidden-md">
                        <div class="center tb10p">
                            <a href="{{url('/employer/register')}}" class="btn signupbtn">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>


@stop




























