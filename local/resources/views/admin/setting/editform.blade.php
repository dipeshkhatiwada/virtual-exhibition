@extends('admin_master')
@section('heading')
Setting
            <small>Detail of Setting</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           
            <li class="active">New Setting</li>
@stop
@section('content')
 
<div class="row">
    <div class="col-xs-12">
       
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Setting</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/admin/setting/update') }}">
                        <input type="hidden" name="setting_id" value="{{ $setting->id }}">
                       
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                        
                        
                       
                        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
            
            <li><a href="#tab-image" data-toggle="tab">Image</a></li>
            <li><a href="#tab-email" data-toggle="tab">Email</a></li>
            <li><a href="#tab-social" data-toggle="tab">Social</a></li>
           
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
            
           
            <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Name</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="company" value="{{ $setting->name }}" placeholder="Company/Organization Name" class="form-control" />
                              
                             @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                        </div>
                  
                  <div class="form-group {{ $errors->has('telephone') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Telephone</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="telephone" value="{{ $setting->telephone }}" placeholder="Telephone" class="form-control" />
                              
                             @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                        </div>
                  
                  <div class="form-group {{ $errors->has('fax') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Fax</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="fax" value="{{ $setting->fax }}" placeholder="Fax" class="form-control" />
                              
                             @if ($errors->has('fax'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                @endif
                               
                            </div>
                        </div>
                  
                  <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Address</label>

                            <div class="col-md-9">
                            <textarea class="form-control" name="address">{{ $setting->address }}</textarea>
                           
                               @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                               
                            </div>
                        </div>
                   <div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Meta Title</label>

                            <div class="col-md-9">
                            
                            <input type="text" name="meta_title" value="{{ $setting->meta_title }}" placeholder="Meta Tag" class="form-control" />
                               @if ($errors->has('meta_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_title') }}</strong>
                                    </span>
                                @endif

                               
                            </div>
                        </div>
                  <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Meta Tag Keyword</label>

                            <div class="col-md-9">
                            <textarea name="meta_keyword" class="form-control">{{ $setting->meta_keyword }}</textarea>
                              

                                @if ($errors->has('meta_keyword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_keyword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Meta Tag Description</label>

                            <div class="col-md-9">
                            <textarea name="meta_description" class="form-control">{{ $setting->meta_description }}</textarea>
                              

                                @if ($errors->has('meta_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            
                       
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Email</label>

                            <div class="col-md-9">
                            <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                                                  

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             <div class="form-group{{ $errors->has('item_perpage') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Item Per Page</label>

                            <div class="col-md-9">
                            <input type="text" name="item_perpage" class="form-control" value="{{ $setting->item_perpage }}">
                                                  

                                @if ($errors->has('item_perpage'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('item_perpage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                <div class="form-group{{ $errors->has('description_limit') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Description Limit</label>

                            <div class="col-md-9">
                            <input type="text" name="description_limit" class="form-control" value="{{ $setting->description_limit }}">
                                                  

                                @if ($errors->has('description_limit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                 <div class="form-group{{ $errors->has('latitude') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Latitude</label>

                            <div class="col-md-9">
                            <input type="text" name="latitude" class="form-control" value="{{ $setting->latitude }}">
                                            <span style="color:#999; font-size:11px;">To get your place Latitude and Longitude </span><a href="http://www.itouchmap.com/latlong.html" target="_blank">CLICK HERE</a>       

                                @if ($errors->has('latitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                  
                  <div class="form-group{{ $errors->has('longitude') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Longitude</label>

                            <div class="col-md-9">
                            <input type="text" name="longitude" class="form-control" value="{{ $setting->longitude }}">
                                                  

                                @if ($errors->has('longitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('longitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
              <div class="form-group">
                            <label class="col-md-3 control-label">Google Analytic Coad</label>

                            <div class="col-md-9">
                            <textarea name="google_analytic" class="form-control">{{ $setting->google_analytics }}</textarea>
                              

                              
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('project_commission') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Project Commission</label>

                            <div class="col-md-9">
                            <input type="text" name="project_commission" class="form-control" value="{{ $setting->project_commission }}">
                                                  

                                @if ($errors->has('project_commission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('project_commission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
            
            
                                                                
            
                  
               
            </div>
            
            <div class="tab-pane" id="tab-image">
               
                <?php 
                            $imageTool= new \App\Imagetool;
                            if(isset($image->logo) && !empty($image->logo))
                            {
                                $logo = \App\Imagetool::mycrop($image->logo, 100, 100);
                            }
                            else {
                                $logo = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->icon) && !empty($image->icon))
                            {
                                $icon = \App\Imagetool::mycrop($image->icon, 100, 100);
                            }
                            else {
                                $icon = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->tender) && !empty($image->tender))
                            {
                                $tender = \App\Imagetool::mycrop($image->tender, 100, 100);
                            }
                            else {
                                $tender = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->training) && !empty($image->training))
                            {
                                $training = \App\Imagetool::mycrop($image->training, 100, 100);
                            }
                            else {
                                $training = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->project) && !empty($image->project))
                            {
                                $project = \App\Imagetool::mycrop($image->project, 100, 100);
                            }
                            else {
                                $project = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->test) && !empty($image->test))
                            {
                                $test = \App\Imagetool::mycrop($image->test, 100, 100);
                            }
                            else {
                                $test = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->event) && !empty($image->event))
                            {
                                $event = \App\Imagetool::mycrop($image->event, 100, 100);
                            }
                            else {
                                $event = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            if(isset($image->job) && !empty($image->job))
                            {
                                $job = \App\Imagetool::mycrop($image->job, 100, 100);
                            }
                            else {
                                $job = \App\Imagetool::mycrop('back.png', 100, 100);
                            }

                            if(isset($image->women) && !empty($image->women))
                            {
                                $women = \App\Imagetool::mycrop($image->women, 100, 100);
                            }
                            else {
                                $women = \App\Imagetool::mycrop('back.png', 100, 100);
                            }

                            if(isset($image->able) && !empty($image->able))
                            {
                                $able = \App\Imagetool::mycrop($image->able, 100, 100);
                            }
                            else {
                                $able = \App\Imagetool::mycrop('back.png', 100, 100);
                            }

                            if(isset($image->retaired) && !empty($image->retaired))
                            {
                                $retaired = \App\Imagetool::mycrop($image->retaired, 100, 100);
                            }
                            else {
                                $retaired = \App\Imagetool::mycrop('back.png', 100, 100);
                            }
                            $placeholder = $imageTool->mycrop('back.png', 100, 100);
                            ?>
            <div class="row">
                <div class="col-md-3">
            <div class="form-group">
                            <label class="col-md-6 control-label">Logo</label>
                           
                            <div class="col-md-6">
                              <a href="" id="thumb-logo" data-toggle="image" class="img-thumbnail">

                              <img src="{{asset($logo)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="logo" value="{{ $image->logo }}" id="input-logo" />
                            </div>
                        </div>
                </div>
                <div class="col-md-3">
            <div class="form-group">
                            <label class="col-md-6 control-label">Icon</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-icon" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($icon)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="icon" value="{{ $image->icon }}" id="input-icon" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Jobs Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-job" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($job)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="job" value="{{ $image->job }}" id="input-job" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Tender Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-tender" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($tender)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="tender" value="{{ $image->tender }}" id="input-tender" />
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Training Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-training" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($training)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="training" value="{{ $image->training }}" id="input-training" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Test Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-test" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($test)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="test" value="{{ $image->test }}" id="input-test" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Project Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-project" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($project)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="project" value="{{ $image->project }}" id="input-project" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Event Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-event" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($event)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="event" value="{{ $image->event }}" id="input-event" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Women Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-women" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($women)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="women" value="{{ $image->women }}" id="input-women" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Able Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-able" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($able)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="able" value="{{ $image->able }}" id="input-able" />
                            </div>
                        </div>
                        </div>
                <div class="col-md-3">
                        <div class="form-group">
                            <label class="col-md-6 control-label">Retaired Logo</label>

                            <div class="col-md-6">
                             <a href="" id="thumb-retaired" data-toggle="image" class="img-thumbnail">
                              <img src="{{asset($retaired)}} " alt="" title="" data-placeholder="{{asset($placeholder)}} " />
                              </a>
                      <input type="hidden" name="retaired" value="{{ $image->retaired }}" id="input-retaired" />
                            </div>
                        </div>
                        </div>
                
                </div>
             <div class="form-group{{ $errors->has('thumb_height') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Thumb Size</label>

                            <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_height" class="form-control" value="{{ $image->thumb_height }}" >
                                      @if ($errors->has('thumb_height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumb_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="thumb_width" class="form-control" value="{{ $image->thumb_width }}" >
                                      @if ($errors->has('thumb_width'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('thumb_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            </div>
                        </div>
             
             <div class="form-group{{ $errors->has('image_height') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Image Size</label>

                             <div class="col-md-9">
                                <div class="col-md-6">
                                <label class="col-md-4 control-label">Image Height</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_height" class="form-control" value="{{ $image->image_height }}" >
                                      @if ($errors->has('image_height'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_height') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                             <div class="col-md-6">
                                <label class="col-md-4 control-label">Thumb Widht</label>
                                <div class="col-md-8">
                                     <input type="text" name="image_width" class="form-control" value="{{ $image->image_width }}" >
                                      @if ($errors->has('image_width'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_width') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            
                            </div>
                        </div>
                        
                        
             
                     
            </div>
            <div class="tab-pane" id="tab-email">
              
               <div class="form-group">
                            <label class="col-md-3 control-label">Protocal</label>
              
                            <div class="col-md-9">
                            <select name="protocal" onChange="changeProto()" id="protocal" class="form-control">

                                <?php
                                $proto[] = array('title' => 'SMTP', 'value' => 'smtp' );
                                $proto[] = array('title' => 'Localhost', 'value' => 'sendmail' );
                                $proto[] = array('title' => 'LocalMail', 'value' => 'mail' );
                                $proto[] = array('title' => 'Mailgun', 'value' => 'mailgun' );
                                $proto[] = array('title' => 'mandrill', 'value' => 'mandrill' );
                                foreach ($proto as $value) {
                                    if($value['value'] == $emails->protocal){
                                        ?>
                                        <option selected="selected" value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
                                        <?php 
                                    } else {
                                        ?>
                                        <option value="<?php echo $value['value'];?>"><?php echo $value['title'];?></option>
                                        <?php
                                    }
                                }
                                 ?>
            
                    </select>
                              

                               
                            </div>
                        </div>
            <div class="form-group" id="para">
                            <label class="col-md-3 control-label">Parameter</label>

                            <div class="col-md-9">
                            <input type="text" name="parameter" class="form-control" value="{{ $emails->parameter }}" >
                           
                            </div>
                        </div>
                       
            <div class="form-group" id="host">
                            <label class="col-md-3 control-label">Host Name</label>

                            <div class="col-md-9">
                            <input type="text" name="host_name" class="form-control" value="{{ $emails->host_name }}" >
                           
                            </div>
                        </div>
              <div class="form-group" id="usern">
                            <label class="col-md-3 control-label">Username</label>

                            <div class="col-md-9">
                            
                              <input type="text" name="username" class="form-control" value="{{ $emails->username }}" >

                               
                            </div>
                        </div>
              <div class="form-group" id="pass">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-9">
                            <input type="text" name="password" class="form-control" value="{{ $emails->password }}" >
                            
                            </div>
                        </div>
              <div class="form-group" id="port">
                            <label class="col-md-3 control-label">Smtp Port</label>

                            <div class="col-md-9">
                            <input type="text" name="smtp_port" class="form-control" value="{{ $emails->smtp_port }}" >
                           
                            </div>
                        </div>
            <div class="form-group" id="enc">
                            <label class="col-md-3 control-label" id="enc_lev">Mail Encryption</label>

                            <div class="col-md-9">
                            <input type="text" name="encription" class="form-control" placeholder="tsl" value="{{ $emails->encription }}" >
                           
                            </div>
                        </div>
              
            </div>
            
            
            <div class="tab-pane" id="tab-social">
               
               
            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Facebook</label>

                            <div class="col-md-9">
                             <input type="url" name="facebook" class="form-control" value="{{ $socials->facebook }}" >
                              @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            
            <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Twitter</label>

                            <div class="col-md-9">
                             <input type="url" name="twitter" class="form-control" value="{{ $socials->twitter }}" >
                              @if ($errors->has('twitter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             <div class="form-group{{ $errors->has('gplus') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">Google Plus</label>

                            <div class="col-md-9">
                             <input type="url" name="gplus" class="form-control" value="{{ $socials->gplus }}" >
                              @if ($errors->has('gplus'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gplus') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
             
             <div class="form-group{{ $errors->has('youtube') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">YouTube</label>

                            <div class="col-md-9">
                             <input type="url" name="youtube" class="form-control" value="{{ $socials->youtube }}" >
                              @if ($errors->has('youtube'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('youtube') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        
             <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                            <label class="col-md-3 control-label">LinkedIn</label>

                            <div class="col-md-9">
                             <input type="url" name="linkedin" class="form-control" value="{{ $socials->linkedin }}" >
                              @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                     
            </div>
            
          </div>
                        
                        
                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-fw fa-save"></i>Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
    $('#modal-image').remove();

    $(this).parents('.note-editor').find('.note-editable').focus();

    $.ajax({
      url: '{{ url('/admin/filemanager') }}',
      dataType: 'html',
      beforeSend: function() {
        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $('#button-image').prop('disabled', true);
      },
      complete: function() {
        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
        $('#button-image').prop('disabled', false);
      },
      success: function(html) {
        $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

        $('#modal-image').modal('show');
      }
    });
  });
  // Image Manager
  $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
    e.preventDefault();

    $('.popover').popover('hide', function() {
      $('.popover').remove();
    });

    var element = this;

    $(element).popover({
      html: true,
      placement: 'right',
      trigger: 'manual',
      content: function() {
        return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
      }
    });

    $(element).popover('show');

    $('#button-image').on('click', function() {
      $('#modal-image').remove();

      $.ajax({
        url: '{{ url('/admin/filemanager') }}' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
        dataType: 'html',
        beforeSend: function() {
          $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
          $('#button-image').prop('disabled', true);
        },
        complete: function() {
          $('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
          $('#button-image').prop('disabled', false);
        },
        success: function(html) {
          $('body').append('<div id="modal-image" class="modal" style="display: block; padding-right: 17px;" >' + html + '</div>');

          $('#modal-image').modal('show');
        }
      });

      $(element).popover('hide', function() {
        $('.popover').remove();
      });
    });

    $('#button-clear').on('click', function() {
      $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

      $(element).parent().find('input').attr('value', '');

      $(element).popover('hide', function() {
        $('.popover').remove();
      });
    });
  });

</script>
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
 <script type="text/javascript"><!--
$('#language li:first-child').addClass('active');
$('#tab-description .tab-content :first-child').addClass('active');
function changeProto(){
    var data = $('#protocal').val();
    if(data == 'sendmail'){
        $('#para').fadeOut();
        $('#host').fadeOut();
        $('#usern').fadeOut();
        $('#pass').fadeOut();
        $('#port').fadeOut();
        $('#enc').fadeOut();

    }
    else if(data == 'smtp'){
        $('#para').fadeIn();
        $('#host').fadeIn();
        $('#usern').fadeIn();
        $('#pass').fadeIn();
        $('#port').fadeIn();
        $('#enc').fadeIn();

    }
    else if(data == 'mailgun'){
        $('#para').fadeOut();
        $('#host').fadeIn();
        $('#usern').fadeOut();
        $('#pass').fadeOut();
        $('#port').fadeOut();
        $('#enc_lev').html('Secret Key');
        $('#enc').fadeIn();

    }
    else if(data == 'mandrill'){
        $('#para').fadeOut();
        $('#host').fadeOut();
        $('#usern').fadeOut();
        $('#pass').fadeOut();
        $('#port').fadeOut();
        $('#enc_lev').html('Secret Key');
        $('#enc').fadeIn();

    }
    

}
//--></script>
@endsection