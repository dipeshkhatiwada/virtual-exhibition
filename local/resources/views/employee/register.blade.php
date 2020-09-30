
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
        <div class="individual">
         
            <form method="POST" action="{{ url('/employee/register') }}">
              {!! csrf_field() !!}
            <div class="forms reg_forms">
            <h2 class="ind_form_title btm15m">Register</h2>
              @if (Session::has('alert-danger') || Session::has('alert-success'))
              <div class="row">
                <div class="col-md-12">
                  @if (Session::has('alert-danger'))
                  <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                  @endif
                  @if (Session::has('alert-success'))
                  <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                  @endif
                </div>
              </div>
              @endif
            <div class="form-group row cm-row {{ $errors->has('first_name') ? ' has-error' : '' }}">
              <label for="first_name" class="col-md-3 col-12 col-form-label hidden-xs">First Name :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-address-card"></i>
              </span>


                <div class="col-md-8 col-11 first_name">
                  <input type="text" name="first_name" class="form-control form_input login_input"  value="{{old('first_name')}}" autocomplete="off" placeholder="First Name">
                  
                </div>
                @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('middle_name') ? ' has-error' : '' }}">
              <label for="middle_name" class="col-md-3 col-12 col-form-label hidden-xs">Middle Name :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-user-circle"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input  type="text" class="form-control form_input login_input" name="middle_name" value="{{ old('middle_name') }}" placeholder="Middle Name">
                </div>
                @if ($errors->has('middle_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('middle_name') }}</strong>
                    </span>
                @endif
            </div>

          

            <div class="form-group row cm-row {{ $errors->has('last_name') ? ' has-error' : '' }}">
              <label for="last_name" class="col-md-3 col-12 col-form-label hidden-xs">Last Name :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-user-plus"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="text" name="last_name" class="form-control form_input login_input" id="last_name" value="{{old('last_name')}}" placeholder="Last Name">
                </div>
                 @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('mobile_number') ? ' has-error' : '' }}">
              <label for="mobile_number" class="col-md-3 col-12 col-form-label hidden-xs">Mobile Number :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-mobile-alt"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="text" name="mobile_number" class="form-control form_input login_input" id="mobile_number" value="{{old('mobile_number')}}" placeholder="Mobile Number">
                </div>
                 @if ($errors->has('mobile_number'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-3 col-12 col-form-label hidden-xs">Email :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-envelope"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="email" name="email" class="form-control form_input login_input" id="email" value="{{old('email')}}" placeholder="info@example.com">
                </div>
                @if ($errors->has('email'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-3 col-12 col-form-label hidden-xs">Password :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-key"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="password" name="password" class="form-control form_input login_input" id="password" placeholder="type your password">
                </div>
                @if ($errors->has('password'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
            </div>
            <div class="form-group row cm-row ">
              <label for="Password" class="col-md-3 col-12 col-form-label hidden-xs">Confirm Password:</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-key"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="password" name="password_confirmation" class="form-control form_input login_input" id="staticEmail" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group row cm-row">
              <label for="staticEmail" class="col-md-3 col-12 col-form-label"></label>
              <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck1" checked="checked" name="term_condition" value="1">
                  <label class="form-check-label check-label" for="gridCheck1">
                     <a href="#" onclick="openTerm()"> I Agree to the Terms & Conditions</a>
                  </label>
                  @if ($errors->has('term_condition'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('term_condition') }}</strong>
                    </span>
                  @endif
              </div>
            </div>
          </div>
          <div class="form-group footer_reg row cm-row">
            <label for="staticEmail" class="col-md-3 col-form-label"></label>
            <div class="col-md-9">
                <button type="submit" class="btn reg_ind_btn lft15m">Register</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </section>


<div class="modal fade servicemodal" id="modal-term" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >CERTIFICATION AND AUTHORIZATION:</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      
      <div class="modal-body">
        
        I certify that the facts that will be presented in my application, personal details, resume and other documents are true and complete to the best of my knowledge and understand that, if shortlisted/ employed, false statements during my application are grounds for dismissal.

In making application, I authorize any selection team to contact any institution or individual deemed appropriate to investigate my employment history, character & qualifications and I give my full and complete consent to their revealing any & all information they wish as a result of this investigation. In addition, I hereby waive my right to bring any cause of action against these individuals for defamation, invasion of privacy or any other reason because of their statements.
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        
      </div>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
   <script>
       function openTerm()
       {
           $('#modal-term').modal('show');
       }
   </script>
@stop

