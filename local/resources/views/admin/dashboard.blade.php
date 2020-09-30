@extends('admin_master')

@section('content')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{count($datas['employers'])}}</h3>

              <p>Total Active Employers</p>
            </div>
            <div class="icon">
              <i class="fa fa-suitcase"></i>
            </div>
            <a href="{{url('/admin/employers')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{count($datas['jobs'])}}</h3>

              <p>Total Active Jobs</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{url('/admin/jobs')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{count($datas['users'])}}</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('/admin/user')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$datas['total_employes']}}</h3>

              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{url('/admin/employees')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
      <section class="col-lg-6 connectedSortable ui-sortable">
      	<div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                

                         <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                            
                                <input type="text" name="subject" placeholder="subject" class="form-control" value="{{old('subject')}}">

                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('from') ? ' has-error' : '' }}">
                           
                                <input type="email" placeholder="mail from" name="from" class="form-control" value="{{old('from')}}">

                                @if ($errors->has('from'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('from') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                        <div class="form-group{{ $errors->has('to') ? ' has-error' : '' }}">
                           
                                <input type="email" placeholder="mail to" name="to" class="form-control" value="{{old('to')}}">

                                @if ($errors->has('to'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                         <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                          
                                <textarea id="message" class="form-control" name="message">{{old('message')}}</textarea>
                                <script>
      
       
                                    CKEDITOR.replace('message',
                                    {
                                        filebrowserBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html")}}',
                                        filebrowserImageBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Images")}}',
                                        filebrowserFlashBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Flash")}}',
                                        filebrowserUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
                                        filebrowserImageUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
                                        filebrowserFlashUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',
                                        enterMode: CKEDITOR.ENTER_BR
                                    });
                                   
                                    
                                 
                                </script>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                        
                        <div class="box-footer clearfix">
			              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
			                <i class="fa fa-arrow-circle-right"></i></button>
			            </div>
              </form>
            </div>
            
          </div>
      	
      </section>
      <section class="col-lg-6 connectedSortable ui-sortable">
      	<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Active jobs</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <ul class="todo-list ui-sortable">
              	@if(count($datas['jobs']) > 0)
              	@foreach($datas['jobs'] as $job)
                <li>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                 
                  <span class="text">{{$job->title}}</span>
                  <!-- Emphasis label -->
                  <a href="{{url('/admin/jobs/application/'.$job->id)}}" target="_blank"><small class="label label-danger"><i class="fa fa-clock-o"></i>  Application</small></a>
                   <small class="label label-success"><i class="fa fa-clock-o"></i> {{\App\RecruitmentProcess::getTitle($job->process_status)}} Application</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                  	<a href="{{url('/admin/jobs/view/'.$job->id)}}" target="_blank">
                    <i class="fa fa-arrow-circle-right"></i> </a>
                    
                  </div>
                </li>
                @endforeach
                @endif
                
                
                
                
              </ul>
            </div>
           
            
          </div>
      </section>
      </div>
@endsection
