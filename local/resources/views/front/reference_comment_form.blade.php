@extends('front.tender-master')
@section('header')
<section class="rt_banner">
  <div class="container rn_container">
    @include('front/common/project_header')
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Search Projects</span> <span class="greencolor"> With Category </span> </h3>
        <div class="search_background">
          <form class="search_form">
            <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                   <button type="button" id="search_button" class="btn searchbtn">Search</button>
                </div>
            </div>
          </form>
        </div>
          
        <div class="tb20p center">
          <a class="btn bluecomnbtn">TOP PROJECTS</a>
        </div>
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')     
<style type="text/css">
  .hidden-form{
    display: none;
  }
  .dash_forms .has-error .help-block{
    color: RED;
  }
  .dash_forms .has-error label{
    color: #666666;
  }
  .dash_forms .has-error .form-control{
    border: 1px solid RED;
  }
</style>
<section class="tb35p">
            <div class="container">

<form class="dash_forms" role="form" id="testform" method="POST" action="{{ url('/referencevalidation/save') }}">
                        <input type="hidden" name="id" id="id" value="{{$data['reference_id']}}">
                        {!! csrf_field() !!}
     
                        <div class="careerfy-profile-title"><h2>Thank you, {{$data['reference_name']}}, You are giving comment for {{$data['employee_name']}}</h2></div>
                        <p class="pb-3" style="border-bottom: 1px dotted;">Please note that this reference willbe used in the overall evaluation of the applicant and your comments can not see by the candidate. This comments will see by the Job Providors where he/she apply.</p>
                         <div class="col-md-12 ">
                            <?php if (count($errors)) {
                                $first_class = 'hidden-form';
                                $second_class = '';
                            } else{
                                 $first_class = '';
                                $second_class = 'hidden-form';
                            } ?>
  
                             <div id="first_question" class="{{$first_class}} mt-3">
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <label>Do I have you permission to proceed?</label>
                                   <select id="can-procid" class="form-control">
                                                    <option value="">Selection Option</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                </div>
                              </div>
                                
                                 </div>

                            <div id="second_question" class="{{$second_class}} mt-3">
                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                  <label class="required">Name</label>
                                             <input type="text" id="name"  name="name" class="form-control" value="{{ $data['reference_name'] }}">

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                   <label class="required">Email</label>
                                             <input type="email" id="email"  name="email" class="form-control" value="{{ $data['email'] }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>
                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                   <label class="required">Current Phone</label>
                                             <input type="text" id="phone" class="form-control"  name="phone" value="{{ $data['phone'] }}">

                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('company') ? ' has-error' : '' }}">
                                   <label class="required">Current Company Name</label>
                                             <input type="text" id="company" class="form-control"  name="company" value="{{ $data['company'] }}">

                                                @if ($errors->has('company'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('company') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('relationship') ? ' has-error' : '' }}">
                                   <label class="required">What is the nature of relationship with the applicant?</label>
                                            
                                             <textarea class="form-control" name="relationship">{{ old('relationship') }}</textarea>
                                                @if ($errors->has('relationship'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('relationship') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('capacity') ? ' has-error' : '' }}">
                                   <label class="required">In what capacity is/was the applicant employed by your business?</label>
                                            
                                             <textarea class="form-control" name="capacity">{{ old('capacity') }}</textarea>
                                                @if ($errors->has('capacity'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('capacity') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                               <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('duties') ? ' has-error' : '' }}">
                                   <label class="required">What duties and responsibilities does/did the applicant have?</label>
                                            
                                             <textarea class="form-control" name="duties">{{ old('duties') }}</textarea>
                                                @if ($errors->has('duties'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('duties') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('overall_work') ? ' has-error' : '' }}">
                                   <label class="required">How would you describe the applicant's overall work performance?</label>
                                            
                                             <textarea class="form-control" name="overall_work">{{ old('overall_work') }}</textarea>
                                                @if ($errors->has('overall_work'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('overall_work') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('strengths') ? ' has-error' : '' }}">
                                  <label class="required">What would you say are the applicant's strenghts?</label>
                                            
                                             <textarea class="form-control" name="strengths">{{ old('strengths') }}</textarea>
                                                @if ($errors->has('strengths'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('strengths') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('weakness') ? ' has-error' : '' }}">
                                  <label class="required">What would you say are the applicant's development areas (eg. weaknesses)?</label>
                                            
                                             <textarea class="form-control" name="weakness">{{ old('weakness') }}</textarea>
                                                @if ($errors->has('weakness'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('weakness') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('leaving_reason') ? ' has-error' : '' }}">
                                 <label class="required">What the applicant's reson for leaving?</label>
                                            
                                             <textarea class="form-control" name="leaving_reason">{{ old('leaving_reason') }}</textarea>
                                                @if ($errors->has('leaving_reason'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('leaving_reason') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('reliability') ? ' has-error' : '' }}">
                                  <label class="required">Can you comment on the applicant's reliability?</label>
                                            
                                             <textarea class="form-control" name="reliability">{{ old('reliability') }}</textarea>
                                                @if ($errors->has('reliability'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('reliability') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                               <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('punctuality') ? ' has-error' : '' }}">
                                 <label class="required">Can you comment on the applicant's punctuality?</label>
                                            
                                             <textarea class="form-control" name="punctuality">{{ old('punctuality') }}</textarea>
                                                @if ($errors->has('punctuality'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('punctuality') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('attendance') ? ' has-error' : '' }}">
                                   <label class="required">Can you comment on the applicant's attendance?</label>
                                            
                                             <textarea class="form-control" name="attendance">{{ old('attendance') }}</textarea>
                                                @if ($errors->has('attendance'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('attendance') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                              <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('professionalism') ? ' has-error' : '' }}">
                                <label class="required">Can you comment on the applicant's professionalism?</label>
                                            
                                             <textarea class="form-control" name="professionalism">{{ old('professionalism') }}</textarea>
                                                @if ($errors->has('professionalism'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('professionalism') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                <div class="col-md-6 {{ $errors->has('re_employe') ? ' has-error' : '' }}">
                                   <label class="required">Would you re-employ the applicant? Why/Why not?</label>
                                            
                                             <textarea class="form-control" name="re_employe">{{ old('re_employe') }}</textarea>
                                                @if ($errors->has('re_employe'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('re_employe') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                              </div>

                               <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('final_comment') ? ' has-error' : '' }}">
                                <label class="required">Do you have any final comments?</label>
                                            
                                             <textarea class="form-control" name="final_comment">{{ old('final_comment') }}</textarea>
                                                @if ($errors->has('final_comment'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('final_comment') }}</strong>
                                                    </span>
                                                @endif
                                </div>
                                
                              </div>
                              <div class="form-group row">
                                <div class="col-md-6">
                                  <button type="submit" class="btn bluebg sendbtn"> Update <i class="fa fa-paper-plane"></i></button>
                                </div>
                              </div>
                               
                                 </div>
                                 
                            </div>
                           
                     
</form>
</div>
</section>
<script type="text/javascript">
    $('#can-procid').on('change', function(){
        var value = $(this).val();
        
        if (value == 1) {
            $('#first_question').fadeOut();
            $('#second_question').fadeIn();
        } else{
             $('#first_question').fadeIn();
            $('#second_question').fadeOut();
        }

    });
</script>

@stop


