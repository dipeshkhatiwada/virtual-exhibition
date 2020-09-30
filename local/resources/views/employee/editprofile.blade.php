@extends('employe_master')
@section('content')
<link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/app.css')}}">
        <h3 class="form_heading">Edit Profile</h3>
        <div class="form_tabbar">
          <ul class="nav nav-tabs form_tab" id="formTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#tab-general" role="tab" aria-controls="tab-general" aria-selected="true">General Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="setting-tab" data-toggle="tab" href="#tab-setting" role="tab" aria-controls="tab-setting" aria-selected="false">Setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="education-tab" data-toggle="tab" href="#tab-education" role="tab" aria-controls="tab-education" aria-selected="false">Educations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="training-tab" data-toggle="tab" href="#tab-training" role="tab" aria-controls="tab-training" aria-selected="false">Training</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experience-tab" data-toggle="tab" href="#tab-experience" role="tab" aria-controls="tab-experience" aria-selected="false">Experience</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="language-tab" data-toggle="tab" href="#tab-language" role="tab" aria-controls="tab-language" aria-selected="false">Language</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="reference-tab" data-toggle="tab" href="#tab-reference" role="tab" aria-controls="tab-reference" aria-selected="false">References</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="location-tab" data-toggle="tab" href="#tab-location" role="tab" aria-controls="tab-location" aria-selected="false">Preferred</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="document-tab" data-toggle="tab" href="#tab-document" role="tab" aria-controls="tab-document" aria-selected="false">Document</a>
            </li>
        </ul>
         <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel" aria-labelledby="info-tab">
                      
            <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/employee/updateprofile') }}">
                <input type="hidden" name="id" value="{{$datas['employee']->id}}">
                <input type="hidden" name="tab" value="setting-tab"> 
                {!! csrf_field() !!}
                @if(count($errors))
               
            <div class="col-md-12">
            <div class="alert alert-danger">
             @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
             @endforeach
                </div>
            </div>

          
       @endif
                <div class="form-group row ">
                    
                    <div class="col-md-4 {{ $errors->has('firstname') ? ' has-error' : '' }}">
                        <label class="required">First Name</label>
                        <input type="text" required="required" class="form-control" name="firstname" value="{{ $datas['employee']->firstname }}">
                        @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('middlename') ? ' has-error' : '' }}">
                        <label class="">Middle Name</label>
                        <input type="text" class="form-control" name="middlename" value="{{ $datas['employee']->middlename }}">
                        @if ($errors->has('middlename'))
                        <span class="help-block">
                            <strong>{{ $errors->first('middlename') }}</strong>
                        </span>
                        @endif
                    </div>
                     <div class="col-md-4 {{ $errors->has('lastname') ? ' has-error' : '' }}">
                        <label class="required">Last Name</label>
                        <input type="text" required="required" class="form-control" name="lastname" value="{{ $datas['employee']->lastname }}">
                        @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('gender') ? ' has-error' : '' }}">
                        <label class="required">Gender</label>
                        <select name="gender" id="gender" class="form-control" >
                            <?php foreach($datas['genders'] as $gender){
                            if($datas['employee']->gender == $gender['value']) {
                            ?>
                            <option selected="selected" value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                            <?php }} ?>
                        </select>
                        @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                        
                    </div>
                    <div class="col-md-4 {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                        <label class="required">Marital Status</label>
                        <select name="marital_status" id="marital_status" class="form-control" >
                            <?php foreach($datas['marital_status'] as $marital_status){
                            if($datas['employee']->marital_status == $marital_status['value']) {
                            ?>
                            <option selected="selected" value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                            <?php }} ?>
                        </select>
                        @if ($errors->has('marital_status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('marital_status') }}</strong>
                        </span>
                        @endif
                    </div>
                     <div class="col-md-4 {{ $errors->has('present_salary') ? ' has-error' : '' }}">
                        <label class="">Present Salary</label>
                        <input type="text" class="form-control" name="present_salary" value="{{ $datas['employee']->present_salary }}">
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('expected_salary') ? ' has-error' : '' }}">
                        <label class="">Expected Salary</label>
                        <input type="text" class="form-control" name="expected_salary" value="{{ $datas['employee']->expected_salary }}">
                    </div>
                    <div class="col-md-4 {{ $errors->has('permanent_district') ? ' has-error' : '' }}">
                        <label class="required">Permanent District</label>
                        <select class="form-control" name="permanent_district" required="required">
                            @foreach($datas['district'] as $district)
                            @if($district['value'] == $datas['employee_address']->permanent_district)
                            <option selected="selected" value="{{$district['value']}}">{{$district['value']}}</option>
                            @else
                            <option value="{{$district['value']}}">{{$district['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                        @if ($errors->has('permanent_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('permanent_district') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                        <label class="required">Permanent Address</label>
                        <input type="text" required="required" class="form-control" name="permanent_address" value="{{ $datas['employee_address']->permanent }}">
                        @if ($errors->has('permanent_address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('permanent_address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md-3 {{ $errors->has('temporary_district') ? ' has-error' : '' }}">
                        <label class="required">Temporary District</label>
                        <select class="form-control" name="temporary_district" required="required">
                            @foreach($datas['district'] as $district)
                            @if($district['value'] == $datas['employee_address']->temporary_district)
                            <option selected="selected" value="{{$district['value']}}">{{$district['value']}}</option>
                            @else
                            <option value="{{$district['value']}}">{{$district['value']}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                        @if ($errors->has('temporary_district'))
                        <span class="help-block">
                            <strong>{{ $errors->first('temporary_district') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-3 {{ $errors->has('temporary_address') ? ' has-error' : '' }}">
                        <label class="">Temporary Address</label>
                        <input type="text" class="form-control" name="temporary_address" value="{{ $datas['employee_address']->temporary }}">
                    </div>
                    <div class="col-md-3 {{ $errors->has('home_phone') ? ' has-error' : '' }}">
                        <label class="">Home Phone</label>
                        <input type="text" class="form-control" name="home_phone" value="{{ $datas['employee_address']->home_phone }}">
                    </div>
                    <div class="col-md-3 {{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label class="required">Mobile Number</label>
                        <input type="text" required="required" class="form-control" name="mobile" value="{{ $datas['employee_address']->mobile }}">
                        @if ($errors->has('mobile'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                   
                    <div class="col-md-4 {{ $errors->has('fax') ? ' has-error' : '' }}">
                        <label class="">Fax Number</label>
                        <input type="text" class="form-control" name="fax" value="{{ $datas['employee_address']->fax }}">
                    </div>
                    <div class="col-md-4 {{ $errors->has('website') ? ' has-error' : '' }}">
                        <label class="">Website</label>
                        <input type="text" class="form-control" name="website" value="{{ $datas['employee_address']->website }}">
                        @if ($errors->has('website'))
                        <span class="help-block">
                            <strong>{{ $errors->first('website') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-4 {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                        <label class="required">Date of Birth</label>
                        <input type="text" class="form-control datepicker" name="date_of_birth" value="{{ $datas['employee']->dob }}">
                        @if ($errors->has('date_of_birth'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_of_birth') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row ">
                    @if($datas['employee']->nationality != '')
                    @php($nt = $datas['employee']->nationality)
                    @else
                    @php($nt = 'Nepalese')
                    @endif
                    <div class="col-md-4 {{ $errors->has('nationality') ? ' has-error' : '' }}">
                        <label class="required">Nationality</label>
                        <select class="form-control" name="nationality">
                            @foreach($datas['nationality'] as $nationality)
                            @if($nt == ucfirst($nationality['value']))
                            <option value="{{ucfirst($nationality['value'])}}" selected="selected">{{ucfirst($nationality['value'])}}</option>
                            
                            @else
                            <option value="{{ucfirst($nationality['value'])}}">{{ucfirst($nationality['value'])}}</option>
                            @endif
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-4 {{ $errors->has('skills') ? ' has-error' : '' }}">
                                        <label class="">Skills</label>
                                         <div class="bs-example">
                                            <input type="text" name="skills" id="skills" class="form-control " value="{{$datas['skills']}}">
                                          </div>
                                        
                                         
                                            @if ($errors->has('skills'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('skills') }}</strong>
                                                </span>
                                            @endif
                                       
                                        </div>

                    <div class="col-md-4">
                        <label class="">Professional Heading</label>
                        <input type="text" class="form-control" name="professional_heading" placeholder="Developer" value="{{ $datas['employee']->professional_heading }}">
                    </div>
                    
                </div>
                
               
                <div class="form-group row ">
                   
                    <div class="col-md-8">
                        <label class="">Description</label>
                        <textarea class="form-control" name="description"><?php echo strip_tags($datas['employee']->description) ?></textarea>
                    </div>
                    
                    <div class="col-md-4">
                        <span><button id="btn_change" type="button" class="btn lightgreen_gradient btn-xs"><i class="fa fa-upload"></i> Change Picture</button></span>
                        <span><img style="width: 40%" src="{{ asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id)) }}"></span>
                        
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9 col-xs-7 col-md-offset-4">
                        <button type="submit" class="btn bluebg sendbtn">
                        Update <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

         <div class="tab-pane" id="tab-setting"  role="tabpanel">
             <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/employee/updatesetting') }}">
                <input type="hidden" name="id" value="{{$datas['employee']->id}}">
                <input type="hidden" name="tab" value="education-tab"> 
                <input type="hidden" name="date_of_birth" value="{{ $datas['employee']->dob }}">
                {!! csrf_field() !!}
                @if(count($errors))
               
            <div class="col-md-12">
            <div class="alert alert-danger">
             @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
             @endforeach
                </div>
            </div>

          
       @endif
                <div class="form-group row ">
                    <div class="col-md-4">
                        <label class="required">Travel</label>
                        <select class="form-control" name="travel">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->travel == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Willing To Relocate</label>
                        <select class="form-control" name="relocation">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->relocation == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Have Driving License</label>
                        <select class="form-control" name="license">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->license == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    
                </div>

                <div class="form-group row ">
                    
                    
                    <div class="col-md-4">
                        <label class="">License of</label>
                        <select name="license_of" id="license_of" class="form-control" >
                            <option value="">None</option>
                            <?php foreach($datas['vehicles'] as $vehicle){
                            if($datas['employee_setting']->licenseof == $vehicle['value']) {
                            ?>
                            <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php }} ?>
                        </select>
                    </div>
                     <div class="col-md-4">
                        <label class="required">Have Vehicle</label>
                        <select class="form-control" name="have_vehicle">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->have_vehicle == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="">Vehicle</label>
                        <select name="vehicle" id="vehicle" class="form-control" >
                            <option value="">None</option>
                            <?php foreach($datas['vehicles'] as $vehicle){
                            if($datas['employee_setting']->vehical == $vehicle['value']) {
                            ?>
                            <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php } else { ?>
                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                            <?php }} ?>
                        </select>
                    </div>
                </div>
                

                <div class="form-group row ">
                    <div class="col-12">
                    <h3 class="form_heading">Privacy setting</h3>
                </div>
                <div class="col-md-4">
                        <label class="required">Job Alert</label>
                        <select class="form-control" name="job_alert">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->aleartable == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                   
                   
                    <div class="col-md-4">
                        <label class="required">Profile Searchable</label>
                        <select name="searchable" id="searchable" class="form-control" >
                        @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->searchable == $yn['value'])
                            <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Profile Confidential</label>
                        <select class="form-control" name="confidential">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->confidential == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Find you in as alumni, as colleagues</label>
                        <select class="form-control" name="find_you">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->find_you == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Send you circle request</label>
                        <select class="form-control" name="circle_request">
                            @foreach($datas['yes_no'] as $yn)
                            @if($datas['employee_setting']->circle_request == $yn['value'])
                           <option selected="selected" value="{{$yn['value']}}">{{$yn['title']}} </option>
                            @else
                            <option value="{{$yn['value']}}">{{$yn['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your Email</label>
                        <select class="form-control" name="email_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->email_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Who can see your Phone Number</label>
                        <select class="form-control" name="phone_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->phone_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your Circle</label>
                        <select class="form-control" name="circle_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->circle_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see your full name</label>
                        <select class="form-control" name="name_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->name_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="required">Who can see your rank and score</label>
                        <select class="form-control" name="score_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->score_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="required">Who can see you visit profile</label>
                        <select class="form-control" name="visit_privacy">
                            @foreach($datas['whocan'] as $whocan)
                            @if($datas['employee_setting']->visit_privacy == $whocan['value'])
                           <option selected="selected" value="{{$whocan['value']}}">{{$whocan['title']}} </option>
                            @else
                            <option value="{{$whocan['value']}}">{{$whocan['title']}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div id="social_links">
                    <div  class="form-group row ">
                        <div class="col-12">
                            <h3 class="form_heading">Share you social links</h3>
                        </div>
                    </div>
                    @php($social_row = 0)
                    @if(count($datas['socials']) > 0)
                    @foreach($datas['socials'] as $social)
                     <div id="social_row{{$social_row}}" class="form-group row ">
                        <div class="col-md-4">
                            <label class="required">Title</label>
                            <input type="text" name="social[{{$social_row}}][title]" class="form-control" placeholder="Facebook" value="{{$social->title}}">
                        </div>
                        <div class="col-md-8">
                            <label class="required">URL</label>
                            <div class="input-group">

                                  <input name="social[{{$social_row}}][url]" class="form-control" placeholder="https://www.facebook.com" type="url" value="{{$social->url}}">
                                    <span class="input-group-btn">
                                      <button class="btn btn-danger delete_desc" onclick="$('#social_row{{$social_row}}').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            
                           
                        </div>
                    </div>
                    @php($social_row++)
                    @endforeach
                    @else
                    <div id="social_row{{$social_row}}" class="form-group row ">
                        <div class="col-md-4">
                            <label class="required">Title</label>
                            <input type="text" name="social[{{$social_row}}][title]" class="form-control" placeholder="Facebook">
                        </div>
                        <div class="col-md-8">
                            <label class="required">URL</label>
                            <div class="input-group">

                                  <input name="social[{{$social_row}}][url]" class="form-control" placeholder="https://www.facebook.com" type="url">
                                    <span class="input-group-btn">
                                      <button class="btn btn-danger delete_desc" onclick="$('#social_row{{$social_row}}').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button>
                                    </span>
                                </div>
                            
                           
                        </div>
                    </div>
                    @endif
                </div>

                <div class="form-group row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn bluebg sendbtn">
                        Update <i class="fa fa-paper-plane"></i>
                        </button>
                        <button type="button" onclick="addMoreLinks();" data-toggle="tooltip" title="Add More Links" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Links</button>
                    </div>
                </div>
            </form>
         </div>



         <div class="tab-pane" id="tab-education"  role="tabpanel">
             <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/employee/updateeducation') }}">
                <input type="hidden" name="id" value="{{$datas['employee']->id}}">
                <input type="hidden" name="tab" value="training-tab"> 
               
                {!! csrf_field() !!}
                @if(count($errors))
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                {{ '* : '.$error }}</br>
              @endforeach
            </div>
          </div>
        </div>
      @endif
                
                <div class="form-group hidden-xs">
      
      <div class="table-responsive-lg">
        <table class="table table-bordered table-hover table_form">
            <thead>
              <th>Country</th>
              <th>Education Level</th>
              <th>Faculty</th>
              <th>Specialization</th>
              <th>Institution</th>
              <th>Board</th>
              <th>Mark System</th>
              <th>Percent/CGPA</th>
              <th>Year</th>
              <th>Action</th>
            </thead>
            <tbody id="education">
              <?php $education_row = 0; ?>
              @foreach($datas['education'] as $education)
              @if($education->marksystem == 3)
              @php($marksystem = 'CGPA out of 10')
              @elseif($education->marksystem == 2)
              @php($marksystem = 'CGPA out of 4')
              @else
              @php($marksystem = 'Percentage')
              @endif
              <tr id="row-{{$education_row}}">
                  <td>{{$education->country}}</td>
                  <td>{{\App\faculty::getLevelTitle($education->level_id)}}</td>
                  <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
                  <td>{{$education->specialization}}</td>
                  <td>{{$education->institution}}</td>
                  <td>{{$education->board}}</td>
                  <td>{{$marksystem}}</td>
                  <td>{{$education->percentage}}</td>
                  <td>{{$education->year}}</td>
                  <td><button type="button" onclick="removeEducation({{$education->id}}, {{$education_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</button><button type="button" onclick="editEducation({{$education->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button></td>
              </tr>
              <?php $education_row++; ?>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="10"><button type="button" onclick="addmobEducation();" data-toggle="tooltip" title="Add More Education" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Education</button></td>
              </tr>
            </tfoot>
          </table>
        </div>
            
        </div>

        <div class="form-group hidden-lg hidden-md">
      {!! csrf_field() !!}
      <table class="table mob_table table-bordered ">
        <tbody id="education">
          <?php $education_row = 0; ?>
          @foreach($datas['education'] as $education)
          <tr id="row-{{$education_row}}">
            <th>Country</th>
            <th>{{$education->country}}</th>
          </tr>
          <tr>
            <td>Education Level</td>
            <td>{{\App\faculty::getLevelTitle($education->level_id)}}</td>
          </tr>
          <tr>
            <td>Faculty</td>
            <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
          </tr>
          <tr>
            <td>Specialization</td>
            <td>{{$education->specialization}}</td>
          </tr>
          <tr>
            <td>Institution</td>
            <td>{{$education->institution}}</td>
          </tr>
          <tr>
            <td>Board</td>
            <td>{{$education->board}}</td>
          </tr>
          <tr>
            <td>Percent/CGPA</td>
            <td>{{$education->percentage}}</td>
          </tr>
          <tr>
            <td>Year</td>
            <td>{{$education->year}}</td>
          </tr>
          <tr>
            <td>Action</td>
            <td> 
              <button type="button" onclick="removeEducation({{$education->id}}, {{$education_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</button>
              <button type="button" onclick="editEducation({{$education->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
          <?php $education_row++; ?>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="10"><button type="button" onclick="addmobEducation();" data-toggle="tooltip" title="Add More Education" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Education</button></td>
          </tr>
        </tfoot>
      </table>
    </div>
                

                
            </form>
         </div>


         <div class="tab-pane" id="tab-training"  role="tabpanel">
            @if(count($errors))
        <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                {{ '* : '.$error }}</br>
              @endforeach
            </div>
          </div>
        </div>
      @endif


      <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
          {!! csrf_field() !!}
          <table class="table table-bordered table-hover table_form">
            <thead>
              <th>Title</th>
              <th>Details</th>
              <th>Institution</th>
              <th>Duration</th>
              <th>Year</th>
              <th>Action</th>
            </thead>
            <tbody id="training">
              <?php $training_row = 0; ?>
              @if(count($datas['training']) > 0)
              @foreach($datas['training'] as $training)
              <tr id="row-{{$training_row}}">
                <td>{{$training->title}}</td>
                <td>{{$training->details}}</td>
                <td>{{$training->institution}}</td>
                <td>{{$training->duration}}</td>
                <td>{{$training->year}}</td>
                <td>
                  <button type="button" onclick="removeTraining({{$training->id}}, {{$training_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Delete</button>
                  <button type="button" onclick="editTraining({{$training->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                </td>
              </tr>
              <?php $training_row++; ?>
              @endforeach
              @endif
  </tbody>
  <tfoot><tr><td colspan="6"><button type="button" onclick="addmobTraining();" data-toggle="tooltip" title="Add More Training" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Training</button></td></tr></tfoot>
</table>
</div>

 

</div>
<div class="form-group hidden-lg hidden-md">
          {!! csrf_field() !!}
          <table class="table mob_table table-bordered">
            <tbody id="training">
              <?php $training_row = 0; ?>
                @if(count($datas['training']) > 0)
                @foreach($datas['training'] as $training)
                <tr id="row-{{$training_row}}">
                  <td>Title</td>
                  <td>{{$training->title}}</td>
                </tr>
                <tr>
                <td>Details</td>
                <td>{{$training->details}}</td>
                </tr>
                <tr>
                <td>Institution</td>
                <td>{{$training->institution}}</td>
                </tr>
                <tr>
                <td>Duration</td>
                <td>{{$training->duration}}</td>
                </tr>
                <tr>
                <td>Year</td>
                <td>{{$training->year}}</td>
                </tr>

                <tr>
                <td>Action</td>
                <td> 
                <button type="button" onclick="removeTraining({{$training->id}}, {{$training_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Delete</button>
                <button type="button" onclick="editTraining({{$training->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                </td>
                </tr>
                <?php $training_row++; ?>
                @endforeach
                @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="10"><button type="button" onclick="addmobTraining();" data-toggle="tooltip" title="Add More Training" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Training</button></td>
              </tr>
            </tfoot>
          </table>
        </div>

         </div>
          <div class="tab-pane" id="tab-experience"  role="tabpanel">
            <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
            {!! csrf_field() !!}
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Organization</th>
                <th>Type of Employment</th>
                <th>Organization Type</th>
                <th>Designation</th>
                <th>Job Level</th>
                <th>From</th>
                <th>To</th>
                <th>Working Status</th>
                <th>Country</th>
                <th>Action</th>
              </thead>
              <tbody id="experience">
                <?php $experience_row = 0; ?>
                @if(count($datas['experience']) > 0)
                  @foreach($datas['experience'] as $experience)
                  <tr id="row-{{$experience_row}}">
                    <td>{{$experience->organization}}</td>
                    <td>{{$experience->typeofemployment}}</td>
                    <td>{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
                    <td>{{$experience->designation}}</td>
                    <td>{{$experience->level}}</td>
                    <td>{{$experience->from}}</td>
                    <td>{{$experience->to}}</td>
                    <td>{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
                    <td>{{$experience->country}}</td>
                    <td rowspan="2">
                      <button type="button" onclick="removeexperience({{$experience->id}}, {{$experience_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                       <button type="button" onclick="editExperience({{$experience->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                  </tr>
                  <tr id="second_row_{{$experience_row}}">
                    <td colspan="9"><?php echo $experience->experience; ?></td>
                  </tr>
                  <?php $experience_row++; ?>
                  @endforeach
                  @endif
                 
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="10"><button type="button" onclick="addmobExperience();" data-toggle="tooltip" title="Add More experience" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Experience</button></td>
                </tr>
              </tfoot>
            </table>
          </div>
          
        </div>

<div class="form-group hidden-lg">
          <table class="table mob_table table-bordered ">
            {!! csrf_field() !!}
            <tbody id="experience">
            <?php $experience_row = 0; ?>
              @if(count($datas['experience']) > 0)
              @foreach($datas['experience'] as $experience)
              <tr id="row-{{$experience_row}}">
                <th>Organization</th>
                <th>{{$experience->organization}}</th>
              </tr>
              <tr>
              <td>Type of Employment</td>
              <td>{{$experience->typeofemployment}}</td>
              </tr>
              <tr>
              <td>Organization Type</td>
              <td>{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
              </tr>
              <tr>
              <td>Designation</td>
              <td>{{$experience->designation}}</td>
              </tr>
              <tr>
              <td>Job Level</td>
              <td>{{$experience->level}}</td>
              </tr>
              <tr>
              <td>From</td>
              <td>{{$experience->from}}</td>
              </tr>
              <tr>
              <td>To</td>
              <td>{{$experience->to}}</td>
              </tr>
              <tr>
              <td>Working Status</td>
              <td>{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
              </tr>
              <tr>
              <td>Country</td>
              <td>{{$experience->country}}</td>
              </tr>
              <tr>
              <tr>
             
              <td colspan="2"><strong>Description:</strong> {!! $experience->experience !!}</td>
              </tr>
              <tr>
              <td>Action</td>
              <td> 
              <button type="button" onclick="removeexperience({{$experience->id}}, {{$experience_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
              <button type="button" onclick="editExperience({{$experience->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
              </td>
              </tr>
            <?php $experience_row++; ?>
            @endforeach
            @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"><button type="button" onclick="addmobExperience();" data-toggle="tooltip" title="Add More experience" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Experience</button></td>
              </tr>
            </tfoot>
          </table>
        </div>

         </div>
          <div class="tab-pane" id="tab-language"  role="tabpanel">

            <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
            
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Languages</th>
                <th>Understand</th>
                <th>Speak</th>
                <th>Read</th>
                <th>Write</th>
                <th>Mother Tongue</th>
                <th>Action</th>
              </thead>
              <tbody id="language">
                <?php $language_row = 0; ?>
                @if(count($datas['language']) > 0)
                @foreach($datas['language'] as $language)
                <tr id="row-{{$language_row}}">
                  <td>{{$language->language}}</td>
                  <td>{{$language->understand}}</td>
                  <td>{{$language->speak}}</td>
                  <td>{{$language->reading}}</td>
                  <td>{{$language->writing}}</td>
                  <td>{{$language->mother_t == 1 ? 'Yes' : 'No'}}</td>
                  <td><button type="button" onclick="removeLanguage({{$language->id}}, {{$language_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                    <button type="button" onclick="editLanguage({{$language->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button></td>
                </tr>
                  <?php $language_row++; ?>
                  @endforeach
                  @endif
                 
              </tbody>
              <tfoot><tr><td colspan="7"><button type="button" onclick="addmobLanguage();" data-toggle="tooltip" title="Add More language" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More language</button></td></tr></tfoot>
            </table>
          </div>
           <div class="form-group">
          <button type="submit" class="btn bluebg sendbtn">
            Save <i class="fa fa-paper-plane"></i>
          </button>
        </div>
        </div>
       
        <div class="form-group hidden-lg hidden-md">
        {!! csrf_field() !!}
        <table class="table mob_table table-bordered ">
          <tbody id="language">
                <?php $language_row = 0; ?>
                @if(count($datas['language']) > 0)
                @foreach($datas['language'] as $language)
            <tr id="row-{{$language_row}}">
              <th>Language</th>
              <th>{{$language->language}}</th>
            </tr>
          
            <tr>
              <td>Understand</td>
              <td>{{$language->understand}}</td>
            </tr>
           <tr>
             <td>Speak</td>
             <td>{{$language->speak}}</td>
           </tr>
           <tr>
             <td>Read</td>
             <td>{{$language->reading}}</td>
           </tr>
           <tr>
             <td>Write</td>
             <td>{{$language->writing}}</td>
           </tr>
           <tr>
             <td>Mother Tongue</td>
             <td>{{$language->mother_t == 1 ? 'Yes' : 'No'}}</td>
           </tr>
           <tr>
             <td>Action</td>
             <td><button type="button" onclick="removeLanguage({{$language->id}}, {{$language_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                <button type="button" onclick="editLanguage({{$language->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
              </td>
           </tr>
           <?php $language_row++; ?>
            @endforeach
            @endif
                  
          <tfoot><tr><td><button type="button" onclick="addmobLanguage();" data-toggle="tooltip" title="Add More language" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More language</button></td></tr></tfoot>
        </table>
        </div>

         </div>
         <div class="tab-pane" id="tab-reference"  role="tabpanel">

            <div class="form-group dash_forms hidden-xs">
          <div class="table-responsive-lg">
            {!! csrf_field() !!}
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Name</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Office Phone</th>
                <th>Mobile</th>
                <th>E-mail</th>
                <th>Company</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody id="reference">
                <?php $reference_row = 0; ?>
                  @if(count($datas['reference']) > 0)
                    @foreach($datas['reference'] as $reference)
                    <?php $status = \App\ReferenceComment::checkComment($reference->id); ?>
                      <tr id="row-{{$reference_row}}">
                        <td>{{$reference->name}}</td>
                        <td>{{$reference->designation}}</td>
                        <td>{{$reference->address}}</td>
                        <td>{{$reference->office_phone}}</td>
                        <td>{{$reference->mobile}}</td>
                        <td>{{$reference->email}}</td>
                        <td>{{$reference->company}}</td>
                        <td>{{$status}}</td>
                        <td>
                          @if($status == '')
                          <button type="button" onclick="removeReference({{$reference->id}}, {{$reference_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                          @endif
                        </td>
                      </tr>
                    <?php $reference_row++; ?>
                    @endforeach
                  @endif
                
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="9"><button type="button" onclick="addmobReference();" data-toggle="tooltip" title="Add More reference" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More reference</button></td>
                </tr>
              </tfoot>
            </table>
            
          </div>
          
            <div class="form-group">
              
                <button type="submit" class="btn sendbtn bluebg">
                  Save <i class="fa fa-paper-plane"></i>
                </button>
             
            </div>
         
        </div>
<div class="form-group hidden-lg hidden-md">
      
      <table class="table mob_table table-bordered ">
        <tbody id="reference">
          <?php $reference_row = 0; ?>
            @if(count($datas['reference']) > 0)
            @foreach($datas['reference'] as $reference)
            <?php $status = \App\ReferenceComment::checkComment($reference->id); ?>
            <tr id="row-{{$reference_row}}">
              <th>Name</th>
              <th>{{$reference->name}}</th>
            </tr>
            <tr>
            <td>Designation</td>
            <td>{{$reference->designation}}</td>
            </tr>
            <tr>
            <td>Address</td>
            <td>{{$reference->address}}</td>
            </tr>
            <tr>
            <td>Office Phone</td>
            <td>{{$reference->office_phone}}</td>
            </tr>
            <tr>
            <td>Mobile</td>
            <td>{{$reference->mobile}}</td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td>{{$reference->email}}</td>
            </tr>
            <tr>
            <td>Company</td>
            <td>{{$reference->company}}</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>{{$status}}</td>
            </tr>
            <tr>
            <td>Action</td>
            <td> 
              @if($status == '')
                <button type="button" onclick="removeReference({{$reference->id}}, {{$reference_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
              @endif
            </td>
            </tr>
            <?php $reference_row++; ?>
            @endforeach
            @endif
        </tbody>
        <tfoot>
          <tr>
            <td><button type="button" onclick="addmobReference();" data-toggle="tooltip" title="Add More reference" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More reference</button></td>
          </tr>
        </tfoot>
      </table>
    </div>

         </div>
          <div class="tab-pane" id="tab-location"  role="tabpanel">


            <form class="form-horizontal dash_form" role="form" id="testform" method="POST" action="{{ url('/employee/location/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <input type="hidden" name="tab" value="location-tab"> 
          {!! csrf_field() !!}
          <div class="row cm-row">
            <div class="col-md-4">
              <div class="box box-warning box-solid all15p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Job Locations</h3>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-10 locations">
                    @foreach($datas['joblocation'] as $joblocation)
                    @if(in_array($joblocation->id,$datas['employee_location']))
                    <div class="form-check">
                      <input type="checkbox" checked="checked" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                      <label class="form-check-label" >{{$joblocation->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="job_location[]" value="{{$joblocation->id}}" >
                      <label class="form-check-label" >{{$joblocation->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-4">
              <div class="box box-warning box-solid all10p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Job Categories</h3>
                 
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-12 locations">
                    @foreach($datas['jobcategory'] as $jobcategory)
                    @if(in_array($jobcategory->id,$datas['employee_category']))
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" checked="checked" name="job_category[]" value="{{$jobcategory->id}}" >
                      <label class="form-check-label" >{{$jobcategory->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="job_category[]" value="{{$jobcategory->id}}" >
                      <label class="form-check-label" >{{$jobcategory->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
              <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <div class="col-md-4">
              <div class="box box-warning box-solid all10p">
                <div class="box-header with-border">
                  <h3 class="title_two btm10m">Organization Types</h3>
                 
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class=" col-me-12 locations">
                    @foreach($datas['organization_type'] as $organization_type)
                    @if(in_array($organization_type->id,$datas['employee_org']))
                    <div class="form-check">
                      <input type="checkbox" checked="checked" class="form-check-input" name="organization_type[]"  value="{{$organization_type->id}}" >
                      <label class="form-check-label" >{{$organization_type->name}}</label>
                    </div>
                    @else
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" name="organization_type[]"  value="{{$organization_type->id}}" >
                      <label class="form-check-label" >{{$organization_type->name}}</label>
                    </div>
                    @endif
                    @endforeach
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
            </div>
          <!-- /.box -->
          </div>
          <div class="col-md-10">
            <div class="form-group row">
              <div class="col-md-10 col-md-offset-4">
                <button type="submit" class="btn bluebg sendbtn">
                  Save <i class="fa fa-paper-plane"></i>
                </button>
              </div>
            </div>
          </div>  
      </form>

         </div>
          <div class="tab-pane" id="tab-document"  role="tabpanel">
            <div class="common_bg dash_forms">
    <div class="table-responsive-lg">
      <table class="table table_form employe_profile hidden-xs">
        <thead>
          <tr>
            <th>Document</th>
            <th>Title</th>
            <th>Action</th>
          </tr>
        </thead>
         
        <tbody>
          <?php $files_row = 1; ?>             
          @foreach($datas['files'] as $files)
          <tr id="document_row_{{$files_row}}">
            <td>
              <div class="uploadfile">
                <a href="{{$files['url']}}" target="_blank"><img src="{{asset($files['thumb'])}}"> {{$files['f_name']}}</a>
              </div>
            </td>
            <td>
              <span class="greenclr">{{$files['title']}}</span>
            </td>
            <td>
              <button type="button" onclick="removefiles({{$files['id']}}, '{{$files["type"]}}',{{$files_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
            </td>
          </tr>
       
          @php($files_row++)
          @endforeach
           </tbody>
      </table>
    </div>
    <div class="careerfy-table-layer careerfy-managejobs-today">
      @if($datas['employee']->resume == '') <button type="button" id="upload_resume" data-toggle="tooltip" title="Upload Files" class="btn bluebg sendbtn tp10m"><i class="fa fa-upload"></i> Upload Resume</button> @endif<div class=""><button type="button" id="upload_files" data-toggle="tooltip" title="Upload Files" class="btn sendbtn bluebg tb10m"><i class="fa fa-upload"></i> Upload files</button></div>
    </div>     
  </div>

 <div class="form-group hidden-lg hidden-md">
    {!! csrf_field() !!}
    <table class="table mob_table table-bordered ">
      <tbody id="reference">
        <?php $files_row = 1; ?>             
          @foreach($datas['files'] as $files)
          <tr>
        <th>Title</th>
        <th>{{$files['title']}}</th>
        </tr>
        <tr id="document_row_{{$files_row}}">
          <td>Document</td>
          <td>
            <div class="uploadfile">
              <a href="{{$files['url']}}" target="_blank"><img src="{{asset($files['thumb'])}}"> {{$files['f_name']}}</a>
            </div>
          </td>
        </tr>

        <tr>
        <td>Action</td>
        <td><button type="button" onclick="removefiles({{$files['id']}}, '{{$files["type"]}}',{{$files_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
        </tr>
        @php($files_row++)
        @endforeach
      </tbody>
      
    </table>
  </div>

         </div>




        </div>
<div class="modal fade servicemodal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Education</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/educations/update') }}">
        <input type="hidden" name="education_id"id="education_id" value="">
        {!! csrf_field() !!}
      <div class="modal-body" id="education_detail">
                
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        
      </div>
    </form>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<div class="modal fade servicemodal" id="modal-addmobEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Education</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/educations/save') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <input type="hidden" name="tab" value="education-tab"> 
        {!! csrf_field() !!}
        <div class="modal-body" id="education_detail">
          <div class="form-group row ">
            <label class="col-md-4 required">Country</label>
            <div class="col-md-8">
            <input type="text" required="required" class="form-control" name="country" placeholder="Country">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Education Level</label>
            <div class="col-md-8">
            <select class="form-control" id="level_id" name="level_id">
              <option value="0">Select Level</option>
              @foreach($datas['educationlevel'] as $levels)
                <option value="{{$levels->id}}">{{$levels->name}}</option>
              @endforeach
            </select>
            </div> 
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Faculty</label>
            <div class="col-md-8">
              <select class="form-control" id="faculty" name="faculty_id">
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Specialization</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="specialization" placeholder="Specialization">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Institution</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" id="institution" name="institution" placeholder="Institution">
              <input type="hidden" name="employers_id" id="employer_id" placeholder="Employer ID">
              <div id="institution_list" class="col-md-12 orglist">    </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Board</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="board" placeholder="Board">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Mark System</label>
            <div class="col-md-8">
              <select class="form-control" name="marksystem">@foreach($datas['marksystem'] as $msys)<option value="{{$msys['value']}}">{{$msys['title']}}</option>@endforeach  </select>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-4 required">Percent/CGPA</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="percent" placeholder="Percent">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Year</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="Year">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade servicemodal" id="modal-trainingedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Training</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/trainings/update') }}">
        <input type="hidden" name="training_id"id="training_id" value="">
         <input type="hidden" name="tab" value="training-tab"> 
        {!! csrf_field() !!}
      <div class="modal-body" id="tttraining_detail">
                
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        
      </div>
    </form>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade servicemodal" id="modal-addmobTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Training</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/training/save') }}">
        {!! csrf_field() !!}
        <input type="hidden" name="tab" value="training-tab"> 
        <div class="modal-body" id="training_detail">
          <div class="form-group row ">
            <label class="col-md-4 required">Title</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="title" placeholder="title">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Details</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="details" placeholder="detail">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Institution</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" id="t_institution" name="institution" placeholder="intitution">
              <input type="hidden" name="employers_id" id="t_employer_id" placeholder="74">
              <div id="t_institution_list" class="col-md-12 orglist"></div>
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Duration</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="duration" placeholder="duration">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Year</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="year">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
</div>





<div class="modal fade servicemodal" id="modal-exp-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Experience</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/experiences/update') }}">
        <input type="hidden" name="experience_id"id="experience_id" value="">
        <input type="hidden" name="tab" value="experience-tab"> 
        {!! csrf_field() !!}
      <div class="modal-body" id="experience_detail">
                
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        
      </div>
    </form>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade servicemodal" id="modal-addexperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title left">Add Experience</h4>
          <button type="button" class="close right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/experiences/save') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="tab" value="experience-tab"> 
          <div class="modal-body">
            <div class="form-group row ">
              <label class="col-md-4 required">Organization</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" id="ex_institution" name="organization" value="">
                <input type="hidden" name="employers_id" id="ex_employer_id" value="">
                <div id="ex_institution_list" class="col-md-12 orglist">    </div>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Type Of Employment</label>
              <div class="col-md-8">
                <select class="form-control" name="typeofemployment">
                  @foreach($datas["employment_type"] as $em_type)<option value="{{$em_type["value"]}}">{{$em_type["value"]}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Organization Type</label>
              <div class="col-md-8">
                <select class="form-control" name="org_type_id">
                  @foreach($datas["organization_type"] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Designation</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" name="designation" placeholder="Wordpress Developer">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Level</label>
              <div class="col-md-8">
                <select class="form-control" name="level">
                @foreach($datas["job_level"] as $job_level)<option value="{{$job_level["value"]}}">{{$job_level["value"]}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">from</label>
              <div class="col-md-8">

                <input type="text" required="required" class="form-control datepicker" name="from" placeholder="2019-12-16">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">To</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control datepicker" name="to" id="to" placeholder="2019-12-18">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Currently Working</label>
              <div class="col-md-8">
                <select class="form-control" id="currently" name="currently_working">
                  @foreach($datas["working_status"] as $working_status)<option value="{{$working_status["value"]}}">{{$working_status["title"]}}</option>@endforeach
                </select>
              </div>
            </div> 
            <div class="form-group row ">
              <label class="col-md-4 required">Country</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" name="country" placeholder ="Nepal">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Experience Detail</label>
              <div class="col-md-8">
                <textarea class="form-control" name="detail" required="required"></textarea>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
          </div>
        </form>
      </div>
    <!-- /.modal-content -->
    </div>
  <!-- /.modal-dialog -->
  </div>

  <div class="modal fade servicemodal" id="modal-addlanguage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Language</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/language/save') }}">
       <input type="hidden" name="tab" value="language-tab"> 
        {!! csrf_field() !!}
        <div class="modal-body">
        <div class="form-group row ">
          <label class="col-md-4 required">language</label>
          <div class="col-md-8">
            <input type="text" required="required" class="form-control" id="institution" name="language" value="">
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Understand</label>
          <div class="col-md-8">
            <select class="form-control" name="understand">
              <option selected="selected" value="Easily">Easily</option>
              <option value="Not Easily">Not Easily</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Speak</label>
          <div class="col-md-8">
            <select class="form-control" name="speak">
              <option selected="selected" value="Fluently">Fluently</option>
              <option value="Not Fluently">Not Fluently</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
            <label class="col-md-4 required">Read</label>
            <div class="col-md-8">
              <select class="form-control" name="read">
                <option selected="selected" value="Easily">Easily</option>
                <option value="Not Easily">Not Easily</option>
              </select>
            </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Write</label>
          <div class="col-md-8">
            <select class="form-control" name="write">
              <option selected="selected" value="Easily">Easily</option>
              <option value="Not Easily">Not Easily</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Mother Tongue</label>
          <div class="col-md-8">
            <select class="form-control" name="mother_t">
            <option selected="selected" value="0">No</option>
            <option value="1">Yes</option>
            </select>
          </div>
        </div>   
           
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
  <!-- /.modal-content -->
  </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade servicemodal" id="modal-languageedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Language</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/languages/update') }}">
        <input type="hidden" name="language_id"id="language_id" value="">
        <input type="hidden" name="tab" value="language-tab"> 
        {!! csrf_field() !!}
      <div class="modal-body" id="language_detail">
                
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        
      </div>
    </form>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>


<div class="modal fade servicemodal" id="modal-addmobReference" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Reference</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/reference/save') }}">
        {!! csrf_field() !!}
        <div class="modal-body" >
          <div class="form-group row ">
            <label class="col-md-4 required">Name</label>
            <div class="col-md-8">
            <input type="text" name="name" class="form-control" placeholder="Reference Name">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Designation</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="designation" placeholder="Designation">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Address</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="address" placeholder="Address">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Office Phone</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="office_phone" placeholder="Office Phone">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Mobile</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="mobile" placeholder="Mobile">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">E-mail</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Company</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="company" placeholder="Company">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="{{asset('/assets/bootstrap/js/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript">
    
var citynames = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '{{url("assets/citynames.json")}}',
    filter: function(list) {
      return $.map(list, function(cityname) {
        return { name: cityname }; });
    }
  }
});
citynames.initialize();

$('#skills').tagsinput({
  typeaheadjs: {
    name: 'citynames',
    displayKey: 'name',
    valueKey: 'name',
    source: citynames.ttAdapter()
  }
});

$('form').bind("keypress", function(e) {
  if (e.keyCode == 13) {               
    e.preventDefault();
    return false;
  }
});
</script>

<script type="text/javascript">
      $('#btn_change').on('click', function() {
        $('#upload_form').remove();
        var url = "{{url('/employee/uploadimage')}}";
        $('body').prepend('<form enctype="multipart/form-data" action="'+url+'" id="upload_form" method="POST" style="display: none;"><input type="file" id="file" name="file" value="" /><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

        $('#upload_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_form #file').val() != '') {
              clearInterval(timer);
                $('#upload_form').submit();
                }
          }, 500);

      });
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        var tab = '{{$datas["tab"]}}';
          $('#'+tab).trigger('click');
        });
</script>



<script type="text/javascript">

     function editEducation(education_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/educations/getedit")}}',
        data: '_token='+token+'&education_id='+education_id,
        cache: false,
        success: function(html){
          $('#education_detail').html(html);
          $('#modal-edit').modal('show');
          $('#education_id').val(education_id);
          }
  });
    }
     function removeEducation(id,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This Education?')){
      var token = $('input[name=\'_token\']').val();
          $.ajax({
            type: 'POST',
            url: '{{url("/employee/deleteeducation")}}',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#row-'+row).remove();
               
            }
        });
        }
    }

    $(document).on('change', '#level_id', function(){
       
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
          var lid = ["6", "7"];
          if (lid.includes(data)) {
            $('#faculty').removeAttr("required");
          } else{
            $('#faculty').attr("required", "required");
          }

            $.ajax({
        type: 'POST',
        url: '{{url("/employee/getfaculty")}}',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty').html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#faculty').html(html);
        }
    });

    $(document).on('keypress',"#institution", function()
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
            $('#institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#institution').val(title);
              $('#employer_id').val(id);
              
              $('#institution_list').html('').fadeOut();
            })
          } else{
            $('#institution_list').html('').fadeOut();
           
        }
          }
  });
  })

     function addmobEducation(){
    $('#modal-addmobEducation').modal('show');
  }
</script>

<script type="text/javascript">

    function removeTraining(id,row)
{
if(confirm('Are you sure, Do You Want To Delete This Training?')){
var token = $('input[name=\'_token\']').val();
$.ajax({
type: 'POST',
url: '{{url("/employee/training/delete")}}',
data: 'id='+id+'&_token='+token,
cache: false,
success: function(Success){
$('#row-'+row).remove();
}
});
}
}
   function editTraining(training_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/trainings/getedit")}}',
        data: '_token='+token+'&training_id='+training_id,
        cache: false,
        success: function(html){
          
          $('#tttraining_detail').html(html);
          $('#modal-trainingedit').modal('show');
          $('#training_id').val(training_id);
          }
  });
    }

    $(document).on('keypress',"#t_institution", function()
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
            $('.orglist').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#t_institution').val(title);
              $('#t_employer_id').val(id);
              
              $('.orglist').html('').fadeOut();
            })
          } else{
            $('.orglist').html('').fadeOut();
           
        }
          }
  });
  })
    $(document).on('keypress',"#tr_institution", function()
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
            $('#tr_institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#tr_institution').val(title);
              $('#tr_employer_id').val(id);
              
              $('#tr_institution_list').html('').fadeOut();
            })
          } else{
            $('#tr_institution_list').html('').fadeOut();
           
        }
          }
  });
  })

    function addmobTraining(){
      $('#modal-addmobTraining').modal('show');
    }
</script>


<script type="text/javascript">
   function editExperience(experience_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/experiences/getedit")}}',
        data: '_token='+token+'&experience_id='+experience_id,
        cache: false,
        success: function(html){
          $('#experience_detail').html(html);
          $('#modal-exp-edit').modal('show');
          $('#experience_id').val(experience_id);
          }
  });
    }
</script>

<script type="text/javascript">
  $(document).on('keypress',"#ex_institution", function()
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
            $('#ex_institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#ex_institution').val(title);
              $('#ex_employer_id').val(id);
              
              $('#ex_institution_list').html('').fadeOut();
            })
          } else{
            $('#ex_institution_list').html('').fadeOut();
           
        }
          }
  });
  })

   $(document).on('change',"#currently", function()
     {
      var tod = '{{date("Y-m-d")}}';
      
      var id= $(this).val();
      if (id == 1) {
        $('#to').val(tod);
      }
     })
</script>

<script type="text/javascript">

    function removeexperience(id,row)
    {
    if(confirm('Are you sure, Do You Want To Delete This experience?')){
    var token = $('input[name=\'_token\']').val();
        $.ajax({
          type: 'POST',
          url: '{{url("/employee/experience/delete")}}',
          data: 'id='+id+'&_token='+token,
          cache: false,
          success: function(Success){
            $('#row-'+row).remove();
            $('#second_row_'+row).remove();
          }
      });
      }
    }
    function addmobExperience(){
      $('#modal-addexperience').modal('show');
    }
  </script>
  <script type="text/javascript">
      function removeLanguage(id,row)
  {
  if(confirm('Are you sure, Do You Want To Delete This language?')){
  var token = $('input[name=\'_token\']').val();
  $.ajax({
  type: 'POST',
  url: '{{url("/employee/language/delete")}}',
  data: 'id='+id+'&_token='+token,
  cache: false,
  success: function(Success){
  $('#row-'+row).remove();
  
  }
  });
  }
  }


  function editLanguage(language_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/languages/getedit")}}',
        data: '_token='+token+'&language_id='+language_id,
        cache: false,
        success: function(html){
          $('#language_detail').html(html);
          $('#modal-languageedit').modal('show');
          $('#language_id').val(language_id);
          }
  });
    }

    function addmobLanguage(){
      $('#modal-addlanguage').modal('show');
    }


    function removeReference(id,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This reference?')){
      var token = $('input[name=\'_token\']').val();
          $.ajax({
            type: 'POST',
            url: '{{url("/employee/reference/delete")}}',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#row-'+row).remove();
               
            }
        });
        }
    }

    function addmobReference(){
    $('#modal-addmobReference').modal('show');
  }
  </script>


  <script type="text/javascript">
    function removefiles(id,type,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This files?')){
      var token = $('input[name=\'_token\']').val();
      if (type == 'Resume') {
        var url = '{{url("/employee/resume/delete")}}';
      } else {
        var url = '{{url("/employee/documents/delete")}}';
      }
          $.ajax({
            type: 'POST',
            url: url,
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#document_row_'+row).remove();
               
            }
        });
        }
    }
</script>

<script type="text/javascript">
      $('#upload_files').on('click', function() {
        $('#upload_form').remove();
        var url = "{{url('/employee/uploadfile')}}";
        $('body').prepend('<form enctype="multipart/form-data" action="'+url+'" id="upload_form" method="POST" style="display: none;"><input type="file" id="file" name="documents[]" value="" multiple="multiple" /><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

        $('#upload_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_form #file').val() != '') {
              clearInterval(timer);
                $('#upload_form').submit();
                }
          }, 500);

      });
    </script>

    <script type="text/javascript">
      $('#upload_resume').on('click', function() {
        $('#upload_form').remove();
        var url = "{{url('/employee/uploadresume')}}";
        $('body').prepend('<form enctype="multipart/form-data" action="'+url+'" id="upload_form" method="POST" style="display: none;"><input type="file" id="file" name="resume" value=""/><input type="text" name="_token" value="{{ csrf_token() }}" /></form>');

        $('#upload_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_form #file').val() != '') {
              clearInterval(timer);
                $('#upload_form').submit();
                }
          }, 500);

      });
    </script> 
    
    <script type="text/javascript">
        $('.nav-link').on('click', function(){
            var id = $(this).attr('id');
            var url = '{{url("/employee/resume/delete")}}';
            var token = $('input[name=\'_token\']').val();
              $.ajax({
                type: 'POST',
                url: '{{url("/employee/changetabsession")}}',
                data: 'id='+id+'&_token='+token,
                cache: false,
                success: function(Success){
                    $('#row-'+row).remove();
                   
                }
            });
        })
    </script>
    
    <script type="text/javascript">

        var social_row = '{{$social_row}}';
        if (social_row == 0) {
            social_row = 1;
        }
        function addMoreLinks() {
            var html = ' <div id="social_row'+social_row+'" class="form-group row ">';
                html += '<div class="col-md-4"><label class="required">Title</label><input type="text" name="social['+social_row+'][title]" class="form-control" placeholder="Facebook"></div>';
                html += '<div class="col-md-8"><label class="required">URL</label><div class="input-group">';

                html += '<input name="social['+social_row+'][url]" class="form-control" placeholder="https://www.facebook.com" type="url">';
                html += '<span class="input-group-btn"><button class="btn btn-danger delete_desc" onclick="$(\'#social_row'+social_row+'\').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button></span>';
                html += '</div></div></div>';
                $('#social_links').append(html);
      social_row++;
        }
    </script>
@endsection