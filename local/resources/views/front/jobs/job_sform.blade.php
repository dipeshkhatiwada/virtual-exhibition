<?php $training_row = 0; $education_row = 0; $language_row = 0; $experience_row = 0; $reference_row = 0; ?>
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
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading"><b style="font-size:14px;">You are Applying for {{$datas['job']->title}}</b></div>
                <div class="panel-body">
                    <form class="form-horizontal dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/jobs/review') }}">
                        <input type="hidden" name="job_id" value="{{$datas['job']->id}}">
                        <input type="hidden" name="job_title" value="{{$datas['job']->title}}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-12">
                            
                            <div class="tab-content">
                                
                                    
                                    
                                        <div class="form-group {{$datas['saluation_class']}} {{ $errors->has('salutation') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Salutation</label>
                                            <div class="col-md-9">
                                                <select name="salutation" id="salutation" class="form-control" >
                                                    <?php foreach($datas['salutation'] as $salutation){ 
                                                        if(old('salutation') == $salutation->id) {
                                                        ?>
                                                        <option selected="selected" value="{{ $salutation->id }}">{{ $salutation->name }} </option>
                                                    <?php } else { ?>
                                                            <option value="{{ $salutation->id }}">{{ $salutation->name }} </option>
                                                    <?php }} ?>
                                                </select>
                                                @if ($errors->has('salutation'))
                                                    <span class="help-block">
                                                        {{ $errors->first('salutation') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['first_name_class']}} {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">First Name</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">

                                                @if ($errors->has('firstname'))
                                                    <span class="help-block">
                                                        {{ $errors->first('firstname') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['middle_name_class']}}">
                                            <label class="col-md-3 control-label ">Middle Name</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="middlename" value="{{ old('middlename') }}">

                                                @if ($errors->has('middlename'))
                                                    <span class="help-block">
                                                        {{ $errors->first('middlename') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['last_name_class']}} {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Last Name</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">

                                                @if ($errors->has('lastname'))
                                                    <span class="help-block">
                                                        {{ $errors->first('lastname') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="form-group {{$datas['email_class']}} {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">E-mail</label>

                                            <div class="col-md-9">
                                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        {{ $errors->first('email') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="form-group {{$datas['gender_class']}} {{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Gender</label>
                                            <div class="col-md-9">
                                                <select name="gender" id="gender" class="form-control" >
                                                    <option value="">Select Gender</option>
                                                    <?php foreach($datas['genders'] as $gender){ 
                                                        if(old('gender') == $gender['value']) {
                                                        ?>
                                                        <option selected="selected" value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                                                    <?php } else { ?>
                                                            <option value="{{ $gender['value'] }}">{{ $gender['value'] }} </option>
                                                    <?php }} ?>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <span class="help-block">
                                                        {{ $errors->first('gender') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['marital_status_class']}} {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Marital Status</label>
                                            <div class="col-md-9">
                                                <select name="marital_status" id="marital_status" class="form-control" >
                                                    <option value="">Select Marital Status</option>
                                                    <?php foreach($datas['marital_status'] as $marital_status){ 
                                                        if(old('marital_status') == $marital_status['value']) {
                                                        ?>
                                                        <option selected="selected" value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                                                    <?php } else { ?>
                                                            <option value="{{ $marital_status['value'] }}">{{ $marital_status['value'] }} </option>
                                                    <?php }} ?>
                                                </select>
                                                @if ($errors->has('marital_status'))
                                                    <span class="help-block">
                                                        {{ $errors->first('marital_status') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                       
                                   
                                        <div class="form-group {{$datas['permanent_address_class']}} {{ $errors->has('permanent_address') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Permanent Address</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="permanent_address" value="{{ old('permanent_address') }}">

                                                @if ($errors->has('permanent_address'))
                                                    <span class="help-block">
                                                        {{ $errors->first('permanent_address') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                       
                                        <div class="form-group {{$datas['temporary_address_class']}}">
                                            <label class="col-md-3 control-label ">Temporary Address</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="temporary_address" value="{{ old('temporary_address') }}">

                                               
                                                   
                                            </div>
                                        </div>
                                         <div class="form-group {{$datas['home_phone_class']}} {{ $errors->has('home_phone') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Home Phone</label>

                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="home_phone" value="{{ old('home_phone') }}">

                                                @if ($errors->has('home_phone'))
                                                    <span class="help-block">
                                                        {{ $errors->first('home_phone') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['mobile_phone_class']}} {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Mobile</label>

                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" name="mobile" value="{{ old('mobile') }}">

                                                 @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                        {{ $errors->first('mobile') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                  
                                        <div class="form-group {{$datas['fax_class']}}">
                                            <label class="col-md-3 control-label ">Fax</label>

                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" name="fax" value="{{ old('fax') }}">

                                               
                                            </div>
                                        </div>
                                       
                                        <div class="form-group {{$datas['website_class']}}">
                                            <label class="col-md-3 control-label ">Website</label>

                                            <div class="col-md-9">
                                                <input type="url" class="form-control" name="website" value="{{ old('website') }}">

                                               
                                            </div>
                                        </div>
                                         <div class="form-group {{$datas['dob_class']}} {{ $errors->has('dob') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Date of Birth</label>

                                            <div class="col-md-9">
                                                <div class="col-md-4">
                                                    <label class="col-md-6 control-label ">Year</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="dob_year">
                                                            <?php $now = date('Y') - 10; $prv = '1950';
                                                            for ($i=$now; $i > $prv ; $i--) { ?>
                                                            @if(old('dob_year') == $i)
                                                            <option selected="selected" value="{{$i}}">{{$i}}</option>
                                                            @else
                                                                <option value="{{$i}}">{{$i}}</option>
                                                                @endif
                                                            <?php } ?>
                                                        </select>
                                                        
                                                       
                                                    </div>
                                                </div>
                                                <?php $months = [];
                                                        $months[]  = [ 'value' => '01', 'title' => 'Jan' ]; 
                                                        $months[]  = [ 'value' => '02', 'title' => 'Feb' ]; 
                                                        $months[]  = [ 'value' => '03', 'title' => 'Mar' ]; 
                                                        $months[]  = [ 'value' => '04', 'title' => 'Apr' ]; 
                                                        $months[]  = [ 'value' => '05', 'title' => 'May' ]; 
                                                        $months[]  = [ 'value' => '06', 'title' => 'Jun' ]; 
                                                        $months[]  = [ 'value' => '07', 'title' => 'Jul' ]; 
                                                        $months[]  = [ 'value' => '08', 'title' => 'Aug' ]; 
                                                        $months[]  = [ 'value' => '09', 'title' => 'Sep' ]; 
                                                        $months[]  = [ 'value' => '10', 'title' => 'Oct' ]; 
                                                        $months[]  = [ 'value' => '11', 'title' => 'Nov' ]; 
                                                        $months[]  = [ 'value' => '12', 'title' => 'Dec' ]; ?>
                                                <div class="col-md-4">
                                                    <label class="col-md-6 control-label ">Month</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="dob_month">
                                                           @foreach($months as $month)
                                                            @if(old('dob_month') == $month['value'])
                                                            <option selected="selected" value="{{$month['value']}}">{{$month['title']}}</option>
                                                            @else
                                                                <option value="{{$month['value']}}">{{$month['title']}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                        
                                                       
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-md-6 control-label ">Day</label>
                                                    <div class="col-md-6">
                                                        <select class="form-control" name="dob_day">
                                                            <?php 
                                                            for ($i=1; $i <= 31 ; $i++) { ?>
                                                            @if(old('dob_day') == $i)
                                                            <option selected="selected" value="{{$i}}">{{$i}}</option>
                                                            @else
                                                                <option value="{{$i}}">{{$i}}</option>
                                                                @endif
                                                            <?php } ?>
                                                        </select>
                                                        
                                                       
                                                    </div>
                                                </div>
                                               @if ($errors->has('dob'))
                                                    <span class="help-block">
                                                        {{ $errors->first('dob') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['nationality_class']}} {{ $errors->has('nationality') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Nationality</label>

                                            <div class="col-md-9">
                                                <input type="text"  class="form-control" name="nationality" value="{{ old('nationality') }}">
                                                 @if ($errors->has('nationality'))
                                                    <span class="help-block">
                                                        {{ $errors->first('nationality') }}
                                                    </span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                   
                                        <div class="form-group {{$datas['vehicle_class']}}">
                                        <label class="col-md-3 control-label ">Vehicle</label>
                                            <div class="col-md-9">
                                                <select name="vehicle" id="vehicle" class="form-control" >
                                                    <option value="">None</option>
                                                    <?php foreach($datas['vehicles'] as $vehicle){ 
                                                        if(old('vehicle') == $vehicle['value']) {
                                                        ?>
                                                        <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                                                    <?php } else { ?>
                                                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                                                    <?php }} ?>
                                                </select>

                                            </div>
                                        </div>
                                         
                                       
                                        <div class="form-group {{$datas['license_of_class']}}">
                                    <label class="col-md-3 control-label ">License of</label>
                                            <div class="col-md-9">
                                                <select name="license_of" id="license_of" class="form-control" >
                                                    <option value="">None</option>
                                                    <?php foreach($datas['vehicles'] as $vehicle){ 
                                                        if(old('vehicle') == $vehicle['value']) {
                                                        ?>
                                                        <option selected="selected" value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                                                    <?php } else { ?>
                                                            <option value="{{ $vehicle['value'] }}">{{ $vehicle['value'] }} </option>
                                                    <?php }} ?>
                                                </select>

                                            </div>
                                         
                                        </div>
                                             <div class="form-group {{$datas['pp_photo_class']}} {{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Photo</label>

                                            <div class="col-md-9">
                                               
                                            <input type="file" name="image" class="form-control" value="{{ old('image') }}"  id="input-image" />
                                             @if ($errors->has('image'))
                                                    <span class="help-block">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                @endif

                                               
                                            </div>
                                        </div>
                                                                               
                                        <div class="form-group {{$datas['resume_class']}} {{ $errors->has('resume') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Resume</label>

                                            <div class="col-md-9">
                                               <input type="file" name="resume" value="{{ old('resume') }}" class="form-control">

                                                @if ($errors->has('resume'))
                                                    <span class="help-block">
                                                        {{ $errors->first('resume') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group {{$datas['cover_letter_class']}} {{ $errors->has('cover_letter') ? ' has-error' : '' }}">
                                            <label class="col-md-3 control-label ">Cover Letter</label>

                                            <div class="col-md-9">
                                               <input type="file" name="cover_letter" value="{{ old('cover_letter') }}" class="form-control">
                                                @if ($errors->has('cover_letter'))
                                                    <span class="help-block">
                                                        {{ $errors->first('cover_letter') }}
                                                    </span>
                                                @endif
                                               
                                            </div>
                                        </div>
                                        @if(count($datas['jobs_form']) > 0)
                                            @foreach($datas['jobs_form'] as $value)
                                              <div class="form-group {{ $errors->has('my_files*') ? ' has-error' : '' }} {{ $errors->has('my_datas*') ? ' has-error' : '' }}">
                                              <?php if($value['rq'] == 1){
                                                    $rq= 'required' ;
                                                  } else {
                                                    $rq='';
                                                  }
                                                   ?>   @if($value['type'] == 'file')
                                                        <input type="hidden" name="filetitle[]"  value="<?php echo $value['level'];?>" />
                                                        @else
                                                        <input type="hidden" name="optitle[]"  value="<?php echo $value['level'];?>" />
                                                        @endif
                                                        <label class="col-md-3 control-label {{$rq}}"><?php echo ucfirst($value['level']);?>:</label>
                                                        <div class="col-md-9"><?php echo $value['form'];?>
                                                            @if($value['type'] == 'file')
                                                                @if ($errors->has('my_files*'))
                                                                    <span class="help-block">
                                                                        {{ $errors->first('my_files*') }}
                                                                    </span>
                                                                @endif
                                                        @else
                                                             @if ($errors->has('my_datas*'))
                                                                    <span class="help-block">
                                                                        {{ $errors->first('my_datas*') }}
                                                                    </span>
                                                                @endif
                                                        @endif
                                                            
                                                        </div>
                                                        <div style="clear: both;"></div>
                                              </div>
                                              @endforeach
                                        @endif

<?php $i = 0; ?>
           @if(in_array('education',$datas['jobs_f_fields']))
                    
 <div class="panel-heading title"><b style="font-size:14px;">Education</b></div>
                        <table class="table table-bordered ">

                            <thead>
                                <th>Country</th>
                                <th>Education Level</th>
                                <th>Faculty</th>
                                <th>Specialization</th>
                                <th>Institution</th>
                                <th>Board</th>
                                <th>Percent/Grade</th>
                                <th>Year</th>
                                <th></th>
                            </thead>
                            <tbody id="education">
                                <?php if(count(old('educations')) > 0){ ?>
                                @foreach(old('educations') as $key => $old)

                              <tr id="education_row-{{$i}}">
                                    <td class="{{ $errors->has('educations.'.$key.'.country') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][country]" class="form-control" value="{{$old['country']}}">
                                       @if ($errors->has('educations.'.$key.'.country'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.country') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('educations.'.$key.'.level_id') ? ' has-error' : '' }}">
                                        <?php if (is_array($datas['e_levels']) && in_array($old['level_id'], $datas['e_levels'])) { ?>
                                       
                                        <input type="hidden" name="educations[{{$key}}][level_id]" value="{{$old['level_id']}}">
                                            <input type="text" readonly="readonly" value="{{\App\EducationLevel::getTitle($old['level_id'])}}" name="">
                                        <?php  } else {?>
                                      <select class="form-control level_id" id="{{$key}}" name="educations[{{$key}}][level_id]">
                                        <option value="">Select Level</option>
                                        @foreach($datas['educationlevel'] as $levels)
                                          @if($old['level_id'] == $levels->id)
                                          <option selected="" value="{{$levels->id}}">{{$levels->name}}</option>
                                          @else
                                          <option value="{{$levels->id}}">{{$levels->name}}</option>
                                          @endif
                                        @endforeach
                                      </select><span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.level_id') }}
                                                    </span>
                                                    <?php } ?>
                                                </td>
                                    <td >
                                        <select class="form-control" id="faculty_{{$key}}" name="educations[{{$key}}][faculty]">
                                          <?php echo \App\Faculty::getFaculties($old['level_id'],$old['faculty']); ?>
                                        </select>
                                      </td>
                                    <td class="{{ $errors->has('educations.'.$key.'.specialization') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][specialization]" value="{{$old['specialization']}}" class="form-control">@if ($errors->has('educations.'.$key.'.specialization'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.specialization') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('educations.'.$key.'.institution') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][institution]" value="{{$old['institution']}}" class="form-control">@if ($errors->has('educations.'.$key.'.institution'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.institution') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('educations.'.$key.'.board') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][board]" value="{{$old['board']}}" class="form-control">@if ($errors->has('educations.'.$key.'.board'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.board') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('educations.'.$key.'.percent') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][percent]" value="{{$old['percent']}}" class="form-control">@if ($errors->has('educations.'.$key.'.percent'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.percent') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('educations.'.$key.'.year') ? ' has-error' : '' }}"><input type="text" name="educations[{{$key}}][year]" value="{{$old['year']}}" maxlength="4" class="form-control">@if ($errors->has('educations.'.$key.'.year'))
                                                    <span class="help-block">
                                                        {{ $errors->first('educations.'.$key.'.year') }}
                                                    </span>
                                                @endif</td>
                                    <td> <?php if (is_array($datas['e_levels']) && !in_array($old['level_id'], $datas['e_levels'])) { ?>
                                       
                                        <button type="button" onclick="$('#education_row-{{$i}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php $i++;?>
                            @endforeach

                                <?php } elseif (is_array($datas['e_levels'])) { ?>
                                   
                                    
                                    @foreach($datas['e_levels'] as $level_id)
                                        <tr id="education_row-{{$i}}">
                                            <td class="{{ $errors->has('educations.'.$i.'.country') ? ' has-error' : '' }}">
                                                <input type="text" name="educations[{{$i}}][country]" class="form-control">
                                            </td>
                                            <td class="{{ $errors->has('educations.'.$i.'.level_id') ? ' has-error' : '' }}">
                                            <input type="hidden" name="educations[{{$i}}][level_id]" value="{{$level_id}}">
                                            <input type="text" readonly="readonly" value="{{\App\EducationLevel::getTitle($level_id)}}" name=""></td>
                                            <td><select class="form-control" id="faculty_{{$i}}" name="educations[{{$i}}][faculty]"><?php echo \App\Faculty::getFaculties($level_id,0); ?></select></td>
                                            <td class="{{ $errors->has('educations.'.$i.'.specialization') ? ' has-error' : '' }}"><input type="text" name="educations[{{$i}}][specialization]" class="form-control"></td>
                                            <td class="{{ $errors->has('educations.'.$i.'.institution') ? ' has-error' : '' }}"><input type="text" name="educations[{{$i}}][institution]" class="form-control"></td>
                                            <td class="{{ $errors->has('educations.'.$i.'.board') ? ' has-error' : '' }}"><input type="text" name="educations[{{$i}}][board]" class="form-control"></td>
                                            <td class="{{ $errors->has('educations.'.$i.'.percent') ? ' has-error' : '' }}"><input type="text" name="educations[{{$i}}][percent]" class="form-control"></td>
                                            <td class="{{ $errors->has('educations.'.$i.'.year') ? ' has-error' : '' }}"><input type="text" name="educations[{{$i}}][year]" class="form-control"></td>
                                            <td></td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                   <?php } ?>
                                <?php if(count(old('educations')) > 0){ ?>
                                <?php } elseif($datas['job']->emanual == 1) {?>
                                <tr id="education_row-{{$i}}">
                                    <td><input type="text" name="educations[{{$i}}][country]" class="form-control"></td>
                                    <td><select class="form-control level_id" id="{{$i}}" name="educations[{{$i}}][level_id]"><option value="">Select Level</option>@foreach($datas['educationlevel'] as $levels)<option value="{{$levels->id}}">{{$levels->name}}</option>@endforeach</select></td>
                                    <td><select class="form-control" id="faculty_{{$i}}" name="educations[{{$i}}][faculty]"><option value="">Select Faculty</option></select></td>
                                    <td><input type="text" name="educations[{{$i}}][specialization]" class="form-control"></td>
                                    <td><input type="text" name="educations[{{$i}}][institution]" class="form-control"></td>
                                    <td><input type="text" name="educations[{{$i}}][board]" class="form-control"></td>
                                    <td><input type="text" name="educations[{{$i}}][percent]" class="form-control"></td>
                                    <td><input type="text" name="educations[{{$i}}][year]" class="form-control"></td>
                                    <td><button type="button" onclick="$('#education_row-{{$i}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                <?php } ?>
                                
                               

                            </tbody>
                            @if($datas['job']->emanual == 1)
                            <tfoot><tr><td colspan="9"><button type="button" onclick="addEducation();" data-toggle="tooltip" title="Add More Education" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More Education</button></td></tr></tfoot>
                            @endif

                        </table>



                    
                    @endif                             
                                    
                          @if(in_array('training',$datas['jobs_f_fields']))
                    
<div class="panel-heading title"><b style="font-size:14px;">Training</b></div>
                        <table class="table table-bordered table-hover">

                            <thead>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Institution</th>
                                <th>Duration</th>
                               
                                <th>Year</th>
                                <th></th>
                            </thead>
                            <tbody id="training">
                                <?php $training_row = 0; ?>
                                @if(count(old('training')) > 0)
                            

                            @foreach(old('training') as $key => $old)
                              <tr id="training-row-{{$training_row}}">
                                    <td class="{{ $errors->has('training.'.$key.'.title') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][title]" class="form-control" value="{{$old['title']}}">
                                       @if ($errors->has('training.'.$key.'.title'))
                                                    <span class="help-block">
                                                        {{ $errors->first('training.'.$key.'.title') }}
                                                    </span>
                                                @endif
                                    </td>
                                   
                                    <td class="{{ $errors->has('training.'.$key.'.details') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][details]" value="{{$old['details']}}" class="form-control">@if ($errors->has('training.'.$key.'.details'))
                                                    <span class="help-block">
                                                        {{ $errors->first('training.'.$key.'.details') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('training.'.$key.'.institution') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][institution]" value="{{$old['institution']}}" class="form-control">@if ($errors->has('training.'.$key.'.institution'))
                                                    <span class="help-block">
                                                        {{ $errors->first('training.'.$key.'.institution') }}
                                                    </span>
                                                @endif</td>
                                    <td class="{{ $errors->has('training.'.$key.'.duration') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][duration]" value="{{$old['duration']}}" class="form-control">@if ($errors->has('training.'.$key.'.duration'))
                                                    <span class="help-block">
                                                        {{ $errors->first('training.'.$key.'.duration') }}
                                                    </span>
                                                @endif</td>
                                    
                                    <td class="{{ $errors->has('training.'.$key.'.year') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][year]" value="{{$old['year']}}" class="form-control">@if ($errors->has('training.'.$key.'.year'))
                                                    <span class="help-block">
                                                        {{ $errors->first('training.'.$key.'.year') }}
                                                    </span>
                                                @endif</td>
                                    <td><button type="button" onclick="$('#training-row-{{$training_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                <?php $training_row++; ?>
                            @endforeach
                          @else
                                <tr id="training-row-{{$training_row}}">
                                    <td><input type="text" name="training[{{$training_row}}][title]" class="form-control"></td>
                                    <td><input type="text" name="training[{{$training_row}}][details]" class="form-control"></td>
                                    <td><input type="text" name="training[{{$training_row}}][institution]" class="form-control"></td>
                                    <td><input type="text" name="training[{{$training_row}}][duration]" class="form-control"></td>
                                    <td><input type="text" name="training[{{$training_row}}][year]" maxlength="4" class="form-control"></td>
                                    
                                    <td><button type="button" onclick="$('#training-row-{{$training_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot><tr><td colspan="6"><button type="button" onclick="addTrainings();" data-toggle="tooltip" title="Add More Training" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More Training</button></td></tr></tfoot>
                        </table>



                   
                    @endif          
                        
                       @if(in_array('language',$datas['jobs_f_fields']))
                    <div class="panel-heading title"><b style="font-size:14px;">Language</b></div>

                        <table class="table table-bordered table-hover">

                            <thead>
                                <th>Languages</th>
                                <th>Understad</th>
                                <th>Speak</th>
                                <th>Read</th>
                                <th>Write</th>
                                <th>Monther Toung</th>
                                <th></th>
                            </thead>
                            <tbody id="language">
                                <?php $language_row = 0; ?>
                                @if(count(old('language')) > 0)
                            

                            @foreach(old('language') as $key => $old)
                              <tr id="language-row-{{$language_row}}">
                                    
                                   
                                    <td class="{{ $errors->has('language.'.$key.'.language') ? ' has-error' : '' }}">
                                      <input type="text" name="language[{{$language_row}}][language]" value="{{$old['language']}}" class="form-control">
                                      @if ($errors->has('language.'.$key.'.language'))
                                                    <span class="help-block">
                                                        {{ $errors->first('language.'.$key.'.language') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td><select class="form-control" name="language[{{$language_row}}][understand]">
                                        @foreach($datas['easy'] as $easy)
                                        @if($old['understand'] == $easy['value'])
                                        <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @else
                                        <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @endif
                                        @endforeach
                                         
                                        </select>
                                      </td>
                                    <td><select class="form-control" name="language[{{$language_row}}][speak]">
                                        @foreach($datas['fluent'] as $fluent)
                                        @if($old['speak'] == $fluent['value'])
                                        <option selected="selected" value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                                        @else
                                        <option value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                                        @endif
                                        @endforeach
                                    </select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][read]">
                                    @foreach($datas['easy'] as $easy)
                                        @if($old['read'] == $easy['value'])
                                        <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @else
                                        <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @endif
                                        @endforeach
                                    </select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][write]">
                                        @foreach($datas['easy'] as $easy)
                                        @if($old['write'] == $easy['value'])
                                        <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @else
                                        <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                                        @endif
                                        @endforeach

                                    </select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][mother_t]">
                                        @foreach($datas['yes_no'] as $uyn)
                                        @if($old['mother_t'] == $uyn['value'])
                                        <option selected="selected" value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                                        @else
                                        <option value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td><button type="button" onclick="$('#language-row-{{$language_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                <?php $language_row++; ?>
                            @endforeach
                          @else
                                <tr id="language-row-{{$language_row}}">
                                    <td><input type="text" name="language[{{$language_row}}][language]" class="form-control"></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][understand]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][speak]"><option value="Fluently">Fluently</option><option value="Not Fluently">Not Fluently</option></select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][read]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][write]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>
                                    <td><select class="form-control" name="language[{{$language_row}}][mother_t]"><option value="1">Yes</option><option value="{{$language_row}}">No</option></select></td>
                                    
                                    <td><button type="button" onclick="$('#language-row-{{$language_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot><tr><td colspan="7"><button type="button" onclick="addLanguage();" data-toggle="tooltip" title="Add More Language" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More Language</button></td></tr></tfoot>
                        </table>



                   
                    @endif

                     @if(in_array('experience',$datas['jobs_f_fields']))
                    <div class="panel-heading title"><b style="font-size:14px;">Experience</b></div>
                         <table class="table table-bordered table-hover">

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
                                <th></th>
                            </thead>
                            <tbody id="experience">
                                <?php $experience_row = 0; ?>
                                @if(count(old('experience')) > 0)
                            

                            @foreach(old('experience') as $key => $oldexp)
                              <tr id="exp-row-{{$experience_row}}">
                                    
                                   
                                    <td class="{{ $errors->has('experience.'.$key.'.organization') ? ' has-error' : '' }}">
                                      <input type="text" name="experience[{{$experience_row}}][organization]" value="{{$oldexp['organization']}}" class="form-control">
                                       @if ($errors->has('experience.'.$key.'.organization'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.organization') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.typeofemployment') ? ' has-error' : '' }}">
                                      <select class="form-control" name="experience[{{$experience_row}}][typeofemployment]">
                                        @foreach($datas['employment_type'] as $em_type)
                                            @if($oldexp['typeofemployment'] == $em_type['value'])
                                            <option selected="selected" value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                                            @else
                                            <option value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                      @if ($errors->has('experience.'.$key.'.typeofemployment'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.typeofemployment') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.org_type_id') ? ' has-error' : '' }}"><select class="form-control" name="experience[{{$experience_row}}][org_type_id]">
                                        @foreach($datas['organization_type'] as $org_type)
                                            @if($oldexp['org_type_id'] == $org_type->id)
                                            <option selected="selected" value="{{$org_type->id}}">{{$org_type->name}}</option>
                                            @else
                                            <option value="{{$org_type->id}}">{{$org_type->name}}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                      @if ($errors->has('experience.'.$key.'.org_type_id'))
                                                      <span class="help-block">
                                                          {{ $errors->first('experience.'.$key.'.org_type_id') }}
                                                      </span>
                                                  @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.designation') ? ' has-error' : '' }}">
                                      <input type="text" name="experience[{{$experience_row}}][designation]" value="{{$oldexp['designation']}}" class="form-control">
                                      @if ($errors->has('experience.'.$key.'.designation'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.designation') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.level') ? ' has-error' : '' }}">
                                      <select class="form-control" name="experience[{{$experience_row}}][level]">
                                        @foreach($datas['job_level'] as $job_level)
                                            @if($oldexp['level'] == $job_level['value'])
                                            <option selected="selected" value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                                            @else
                                            <option value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('experience.'.$key.'.level'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.level') }}
                                                    </span>
                                                @endif
                                  </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.from') ? ' has-error' : '' }}">
                                      <input type="text" id="form_{{$experience_row}}" name="experience[{{$experience_row}}][from]" class="form-control date" value="{{$oldexp['from']}}" placeholder="2010-01-02">
                                      @if ($errors->has('experience.'.$key.'.from'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.from') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.to') ? ' has-error' : '' }}">
                                      <input type="text" id="to_{{$experience_row}}" name="experience[{{$experience_row}}][to]" class="form-control date" value="{{$oldexp['to']}}" placeholder="2010-01-02">
                                      @if ($errors->has('experience.'.$key.'.to'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.to') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.currently_working') ? ' has-error' : '' }}">
                                      <select class="form-control" name="experience[{{$experience_row}}][currently_working]">
                                        @foreach($datas['working_status'] as $working_status)
                                            @if($oldexp['currently_working'] == $working_status['value'])
                                            <option selected="selected" value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                                            @else
                                            <option value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                                            @endif
                                        @endforeach
                                      </select>
                                      @if ($errors->has('experience.'.$key.'.currently_working'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.currently_working') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('experience.'.$key.'.country') ? ' has-error' : '' }}">
                                      <input type="text" name="experience[{{$experience_row}}][country]" value="{{$oldexp['country']}}" class="form-control">
                                      @if ($errors->has('experience.'.$key.'.country'))
                                                    <span class="help-block">
                                                        {{ $errors->first('experience.'.$key.'.country') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td><button type="button" onclick="$('#row-{{$experience_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                <?php $experience_row++; ?>
                            @endforeach
                          @else
                                <tr id="exp-row-{{$experience_row}}">
                                    <td><input type="text" name="experience[{{$experience_row}}][organization]" class="form-control"></td>
                                    <td><select class="form-control" name="experience[{{$experience_row}}][typeofemployment]">@foreach($datas['employment_type'] as $em_type)<option value="{{$em_type['value']}}">{{$em_type['value']}}</option>@endforeach</select></td>
                                    <td><select class="form-control" name="experience[{{$experience_row}}][org_type_id]">@foreach($datas['organization_type'] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach</select></td>
                                    <td><input type="text" name="experience[{{$experience_row}}][designation]" class="form-control"></td>
                                    <td><select class="form-control" name="experience[{{$experience_row}}][level]">@foreach($datas['job_level'] as $job_level)<option value="{{$job_level['value']}}">{{$job_level['value']}}</option>@endforeach</select></td>
                                    <td><input type="text" name="experience[{{$experience_row}}][from]" class="form-control date" placeholder="2010-01-02"></td>
                                    <td><input type="text" name="experience[{{$experience_row}}][to]" class="form-control date" placeholder="2010-01-02"></td>
                                    <td><select class="form-control" name="experience[{{$experience_row}}][currently_working]">@foreach($datas['working_status'] as $working_status)<option value="{{$working_status['value']}}">{{$working_status['title']}}</option>@endforeach</select></td>
                                    <td><input type="text" name="experience[{{$experience_row}}][country]" class="form-control"></td>
                                    <td><button type="button" onclick="$('#exp-row-$experience_row').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                @endif
                                @if ($errors->has('exp'))
                                <tr><td class="form-group has-error" colspan="10"><span class="help-block">{{ $errors->first('exp') }}</span></td></tr>
                                           
                                                @endif
                        
                  

                     @endif
                            </tbody>
                            <tfoot><tr><td colspan="10"><button type="button" onclick="addExperience();" data-toggle="tooltip" title="Add More Experience" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More Experience</button></td></tr></tfoot>
                        </table>
                        

                     @if(in_array('reference',$datas['jobs_f_fields']))

                     <div class="panel-heading title"><b style="font-size:14px;">Reference</b></div>

                        <table class="table table-bordered table-hover">

                            <thead>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Address</th>
                                <th>Office Phone</th>
                                <th>Mobile</th>
                                <th>E-mail</th>
                                <th>Company</th>
                                <th></th>
                            </thead>
                            <tbody id="reference">
                                <?php $reference_row = 0; ?>
                                @if(count(old('reference')) > 0)
                            

                            @foreach(old('reference') as $key => $old)
                              <tr id="reference-row-{{$reference_row}}">
                                    
                                   
                                    <td class="{{ $errors->has('reference.'.$key.'.name') ? ' has-error' : '' }}">
                                      <input type="text" name="reference[{{$reference_row}}][name]" value="{{$old['name']}}" class="form-control">
                                      @if ($errors->has('reference.'.$key.'.name'))
                                                    <span class="help-block">
                                                        {{ $errors->first('reference.'.$key.'.name') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('reference.'.$key.'.designation') ? ' has-error' : '' }}">
                                      <input type="text" name="reference[{{$reference_row}}][designation]" value="{{$old['designation']}}" class="form-control">
                                      @if ($errors->has('reference.'.$key.'.designation'))
                                                    <span class="help-block">
                                                        {{ $errors->first('reference.'.$key.'.designation') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td class="{{ $errors->has('reference.'.$key.'.address') ? ' has-error' : '' }}">
                                      <input type="text" name="reference[{{$reference_row}}][address]" value="{{$old['address']}}" class="form-control">
                                      @if ($errors->has('reference.'.$key.'.address'))
                                                    <span class="help-block">
                                                        {{ $errors->first('reference.'.$key.'.address') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td><input type="text" name="reference[{{$reference_row}}][office_phone]" value="{{$old['office_phone']}}" class="form-control"></td>
                                    <td class="{{ $errors->has('reference.'.$key.'.mobile') ? ' has-error' : '' }}">
                                      <input type="text" name="reference[{{$reference_row}}][mobile]" value="{{$old['mobile']}}" class="form-control">
                                      @if ($errors->has('reference.'.$key.'.mobile'))
                                                    <span class="help-block">
                                                        {{ $errors->first('reference.'.$key.'.mobile') }}
                                                    </span>
                                                @endif
                                    </td>

                                    <td><input type="email" name="reference[{{$reference_row}}][ref_email]" value="{{$old['ref_email']}}" class="form-control"></td>
                                    <td class="{{ $errors->has('reference.'.$key.'.company') ? ' has-error' : '' }}">
                                      <input type="text" name="reference[{{$reference_row}}][company]" value="{{$old['company']}}" class="form-control">
                                      @if ($errors->has('reference.'.$key.'.company'))
                                                    <span class="help-block">
                                                        {{ $errors->first('reference.'.$key.'.company') }}
                                                    </span>
                                                @endif
                                    </td>
                                    <td><button type="button" onclick="$('#reference-row-{{$reference_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                <?php $reference_row++; ?>
                            @endforeach
                          @else
                                <tr id="reference-row-{{$reference_row}}">
                                    <td><input type="text" name="reference[{{$reference_row}}][name]" class="form-control"></td>
                                    <td><input type="text" name="reference[{{$reference_row}}][designation]" class="form-control"></td>
                                    <td><input type="text" name="reference[{{$reference_row}}][address]" class="form-control"></td>
                                    <td><input type="text" name="reference[{{$reference_row}}][office_phone]" class="form-control"></td>
                                    <td><input type="text" name="reference[{{$reference_row}}][mobile]"  class="form-control"></td>

                                    <td><input type="email" name="reference[{{$reference_row}}][ref_email]"  class="form-control"></td>
                                    <td><input type="text" name="reference[{{$reference_row}}][company]" class="form-control"></td>
                                    <td><button type="button" onclick="$('#reference-row-{{$reference_row}}').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                </tr>
                                @endif
                            </tbody>
                            <tfoot><tr><td colspan="8"><button type="button" onclick="addReference();" data-toggle="tooltip" title="Add More Reference" class="btn btn-primary"><i class="fa fa-plus-circle"></i>Add More Reference</button></td></tr></tfoot>
                        </table>



                   
                    @endif




                    
                    
                    
                   
                     

                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Apply
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$.fn.tabs = function() {
  var selector = this;
  
  this.each(function() {
    var obj = $(this); 
    
    $(obj.attr('href')).hide();
    
    $(obj).click(function() {
      $(selector).removeClass('selected');
      
      $(selector).each(function(i, element) {
        $($(element).attr('href')).hide();
      });
      
      $(this).addClass('selected');
      
      $($(this).attr('href')).show();
      
      return false;
    });
  });

  $(this).show();
  
  $(this).first().click();
};
</script>
<script type="text/javascript">
$(function() {
 
  $(".select2").select2({ width: '100%' });
});


</script>
<script type="text/javascript">
    $(document).on('change', '.level_id', function(){
        var id = $(this).attr('id');
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '') {
            $.ajax({
        type: 'POST',
        url: '{{url("/admin/faculty/getfaculty")}}',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty_'+id).html(html);
           
        }
    });
        } else{
            $('#faculty_'+id).html('<option value="">Select Faculty</option>');
        }
    });
     var education_row = '{{$i + 1}}';
    function addEducation()
    {
       
        html = '<tr id="education_row-'+education_row+'"><td><input type="text" name="educations['+education_row+'][country]" class="form-control"></td><td><select class="form-control level_id" id="'+education_row+'" name="educations['+education_row+'][level_id]"><option value="">Select Level</option>@foreach($datas["educationlevel"] as $levels)<option value="{{$levels->id}}">{{$levels->name}}</option>@endforeach</select></td><td><select class="form-control" id="faculty_'+education_row+'" name="educations['+education_row+'][faculty]"><option value="">Select Faculty</option></select></td><td><input type="text" name="educations['+education_row+'][specialization]" class="form-control"></td><td><input type="text" name="educations['+education_row+'][institution]" class="form-control"></td><td><input type="text" name="educations['+education_row+'][board]" class="form-control"></td><td><input type="text" name="educations['+education_row+'][percent]" class="form-control"></td><td><input type="text" name="educations['+education_row+'][year]" class="form-control"></td><td><button type="button" onclick="$(\'#education_row-'+education_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $('#education').append(html);

  education_row++;
    };

    
</script>
<script type="text/javascript">
     var training_row = '{{$training_row + 1}}';
    function addTrainings()
    {
       
        html = '<tr id="training-row-'+training_row+'">';
        html += '<td><input type="text" name="training['+training_row+'][title]" class="form-control"></td>';
        html += '<td><input type="text" name="training['+training_row+'][details]" class="form-control"></td>';
        html += '<td><input type="text" name="training['+training_row+'][institution]" class="form-control"></td>';
        html += '<td><input type="text" name="training['+training_row+'][duration]" class="form-control"></td>';
        html += '<td><input type="text" name="training['+training_row+'][year]" maxlength="4" class="form-control"></td>';
        html += '<td><button type="button" onclick="$(\'#training-row-'+training_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $('#training').append(html);

  training_row++;
    };
</script>
<script type="text/javascript">
    var exp_row = '{{$experience_row + 1}}';
    function addExperience()
    {
        html = '<tr id="exp-row-'+exp_row+'">';
        html += '<td><input type="text" name="experience['+exp_row+'][organization]" class="form-control"></td>';
        html += '<td><select class="form-control" name="experience['+exp_row+'][typeofemployment]">@foreach($datas["employment_type"] as $em_type)<option value="{{$em_type["value"]}}">{{$em_type["value"]}}</option>@endforeach</select></td>';
        html += '<td><select class="form-control" name="experience['+exp_row+'][org_type_id]">@foreach($datas["organization_type"] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="experience['+exp_row+'][designation]" class="form-control"></td>';
        html += '<td><select class="form-control" name="experience['+exp_row+'][level]">@foreach($datas["job_level"] as $job_level)<option value="{{$job_level["value"]}}">{{$job_level["value"]}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="experience['+exp_row+'][from]" class="form-control date" placeholder="2010-01-02"></td>';
        html += '<td><input type="text" name="experience['+exp_row+'][to]" class="form-control date" placeholder="2010-01-02"></td>';
        html += '<td><select class="form-control" name="experience['+exp_row+'][currently_working]">@foreach($datas["working_status"] as $working_status)<option value="{{$working_status["value"]}}">{{$working_status["title"]}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="experience['+exp_row+'][country]" class="form-control"></td>';
        html += '<td><button type="button" onclick="$(\'#exp-row-'+exp_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>';

         $('#experience').append(html);

  exp_row++;
    }
</script>
<script type="text/javascript">

     var ref_row = '{{$reference_row + 1}}';
    function addReference()
    {
       
        html = '<tr id="reference-row-'+ref_row+'">';
        html += '<td><input type="text" name="reference['+ref_row+'][name]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+ref_row+'][designation]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+ref_row+'][address]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+ref_row+'][office_phone]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+ref_row+'][mobile]"  class="form-control"></td>';
        html += '<td><input type="email" name="reference['+ref_row+'][ref_email]"  class="form-control"></td>';
        html += '<td><input type="text" name="reference['+ref_row+'][company]" class="form-control"></td>';
        html += '<td><button type="button" onclick="$(\'#reference-row-'+ref_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $('#reference').append(html);

  ref_row++;
    };
</script>
<script type="text/javascript">
    var language_row = '{{$language_row + 1}}';
    function addLanguage()
    {
        html = '<tr id="language-row-'+language_row+'">';
        html += '<td><input type="text" name="language['+language_row+'][language]" class="form-control"></td>';
        html += '<td><select class="form-control" name="language['+language_row+'][understand]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
        html += '<td><select class="form-control" name="language['+language_row+'][speak]"><option value="Fluently">Fluently</option><option value="Not Fluently">Not Fluently</option></select></td>';
        html += '<td><select class="form-control" name="language['+language_row+'][read]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
        html += '<td><select class="form-control" name="language['+language_row+'][write]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
        html += '<td><select class="form-control" name="language['+language_row+'][mother_t]"><option value="1">Yes</option><option value="0">No</option></select></td>';
        html += '<td><button type="button" onclick="$(\'#language-row-'+language_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td></tr>';
        $('#language').append(html);
        language_row++;
    }
</script>
<script type="text/javascript">
    $(document).on('focus',".date", function(){ //bind to all instances of class "date". 
   $(this).datepicker();
});
</script>