
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
<section class="reg_body">
      <div class="container reg_form">
        <div class="">
          <form method="POST" action="{{ url('/employee/password/email') }}">
                        {!! csrf_field() !!}
                        <div class="forms reg_formwrap ind_login_forms">
                    <h2 class="ind_form_title btm15m">Reset Password</h2>
                         @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn lightgreen_gradient tb10m">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            
        </div>
      </div>
    </section>

    
@stop

