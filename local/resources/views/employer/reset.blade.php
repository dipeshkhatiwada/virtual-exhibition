
@extends('front.job-master')
@section('header')
<section class="rj_banner">
            <div class="container rn_container">
                <header class="header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-4 mainlogo">
                                <div class=""><a href="{{url('/jobs')}}"><img src="{{ \App\library\Settings::getJobLogo() }}"></a></div>
                            </div>
                            <div class="col-md-3 col-2 camp_info">
                                <div class="float-right tp5p">
                                    <a><i class="fa fa-map-marker-alt" title="Bizulibazar, Kathmandu, Nepal"></i></a> <span class="hidden-xs">{{ \App\library\Settings::getSettings()->address }}</span>
                                </div>
                            </div>
                            <div class="col-md-2 col-2 camp_info">
                                <div class="float-right tp5p">
                                    <i class="fa fa-phone-volume"></i> <span class="hidden-xs">{{ \App\library\Settings::getSettings()->telephone }}</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-4">
                                <div class="float-right loginbtns tp5p">
                            <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
                                

                                <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
                               
                        </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
</section>
@stop

@section('banner')

@stop

@section('content')
<section class="reg_body">
      <div class="container reg_form">
        <div class="">
          <form method="POST" action="{{ url('/employer/password/reset') }}">
                        {!! csrf_field() !!}
                        <div class="forms reg_formwrap">
                    <h2 class="form_title btm15m">Reset Password</h2>
                         @if (Session::has('alert-danger') || Session::has('alert-success'))
                          <div class="row">
                            <div class="col-xs-12">
                              @if (Session::has('alert-danger'))
                              <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                              @endif
                              @if (Session::has('alert-success'))
                              <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                              @endif

                            </div>

                          </div>
                          @endif


                     
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}"  autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" >

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            
        </div>
      </div>
    </section>

    
@stop

