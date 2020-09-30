
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
            <form method="POST" action="{{ url('/employer/register') }}">
              {!! csrf_field() !!}
            <div class="forms reg_formwrap">
            <h2 class="form_title btm15m">Register</h2>
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
            <div class="form-group row cm-row {{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="orgname" class="col-md-3 col-form-label hidden-xs">Organization Name :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-building"></i>
              </span>
                <div class="col-md-8 col-11 orgname">
                  <input type="text" name="name" class="form-control form_input login_input" id="orgname" value="{{old('name')}}" autocomplete="off" placeholder="name of organization">
                  <input type="hidden" name="employer_id" id="employer_id" value="{{old('employer_id')}}">
                  <div id="orglist" class="col-md-12 orglist">
                  </div>
                </div>
                @if ($errors->has('name'))
                  <span class="invalid-feedback">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('org_type') ? ' has-error' : '' }}">
              <label for="orgtype" class="col-md-3 col-form-label hidden-xs">Organization Type :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-random"></i>
              </span>
              <div class="col-md-8 col-11">
                <select id="orgtype" name="org_type" class="form-control form_input login_input" id="orgtype" placeholder="type of organization">
                  <option value="">Select type</option>
                  @foreach($org_types as $type)
                  @if($type->id == old('org_type'))
                  <option selected="selected" value="{{$type->id}}">{{$type->name}}</option>
                  @else
                  <option value="{{$type->id}}">{{$type->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              @if ($errors->has('org_type'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('org_type') }}</strong>
              </span>
              @endif
            </div>
            <div class="form-group row cm-row {{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone" class="col-md-3 col-form-label hidden-xs">Phone No. :</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-blender-phone"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="text" name="phone" class="form-control form_input login_input" id="phone" value="{{old('phone')}}" placeholder="phone number">
                </div>
                @if ($errors->has('phone'))
                  <span class="invalid-feedback">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </span>
                @endif
            </div>

            <div class="form-group row cm-row {{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-3 col-form-label hidden-xs">Email :</label>
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
              <label for="password" class="col-md-3 col-form-label hidden-xs">Password :</label>
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
              <label for="Password" class="col-md-3 col-form-label hidden-xs">Confirm Password:</label>
              <span class="col-md-1 col-1 form_icon">
                <i class="fa fa-key"></i>
              </span>
                <div class="col-md-8 col-11">
                  <input type="password" name="password_confirmation" class="form-control form_input login_input" id="staticEmail" placeholder="Password">
                </div>
            </div>
            <div class="form-group row cm-row">
              <label for="staticEmail" class="col-md-3 col-form-label hidden-xs"></label>
              <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck1" checked="checked" name="term_condition" value="1">
                  <label class="form-check-label check-label" for="gridCheck1">
                     <a href="{{url('term-condition')}}"> I Agree Terms & Conditions</a>
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
                <button type="submit" class="btn reg_whitebtn lft15m">Register</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </section>

    <script type="text/javascript">
      $('#orgname').on('keypress', function()
      {
        var token = $('input[name=\'_token\']').val();
        var name = $(this).val();
    $.ajax({
         type: 'POST',
            url: '{{url("/employer/register/getName")}}',
            data: '_token='+token+'&name='+name,
            cache: false,
            success: function(html){
              if (html != '') {
                $('#orglist').html(html).fadeIn();
                $('.org-list').on('click', function(){
                  var id = $(this).attr('id');
                  var title = $('#title_'+id).html();
                  var org_type = $('#type_'+id).val();
                  $('#orgname').val(title);
                  $('#employer_id').val(id);
                  $('#orgtype').val(org_type);
                  $('#orgtype').trigger('change');
                  $('#orglist').html('').fadeOut();
                })
              } else{
                $('#orglist').html('').fadeOut();
               
            }
              }
      });
      })

      
    </script>
@stop












