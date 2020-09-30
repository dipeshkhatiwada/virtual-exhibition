@extends('employer_master')
@section('heading')
View Job 
            <small>Detail of View Job</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/employer') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/employer/jobs') }}">Jobs</a></li>
            <li class="active">View Job</li>
@stop
@section('content')

 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">View Job</div>
                <div class="panel-heading">
                <div class="top-links btn-group">
                  <!--<a href="{{ url('/admin/jobs/makepdf/'.$datas['job']->id) }}" class="btn btn-default btn-xs"><i class="fa fa-file-pdf-o"></i>PDF</a>
                  <a href="{{ url('/admin/jobs/printprofile/'.$datas['job']->id) }}" target="_blank" class="btn btn-default btn-xs"><i class="fa fa-print"></i>Print</a> -->
                </div>
              </div>
                <div class="panel-body">
                    
                   
                    
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Job Detail</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <table class="table table-bordered table-hover">
                            <tbody>
                                <tr>
                                    <td><b> Job Title</b></td>
                                    <td>{{$datas['job']->title}}</td>
                                    <td><b> Job Url</b></td>
                                    <td>{{$datas['job']->seo_url}}</td>
                                </tr>
                                <tr>
                                    <td><b> Vacancy Code</b></td>
                                    <td>{{$datas['job']->vacancy_code}}</td>
                                    <td><b> External Link</b></td>
                                    <td>{{$datas['job']->external_link}}</td>
                                </tr>
                               
                                
                                <tr>
                                    <td><b> Job Availability</b></td>
                                    <td>{{$datas['job']->job_availability}}</td>
                                    <td><b> Minimum Experience</b></td>
                                    <td>{{$datas['job']->min_experience}} Years</td>
                                </tr>
                                <tr>
                                    <td><b> Number of Position</b></td>
                                    <td>{{$datas['job']->position}}</td>
                                    <td><b> Dead Line</b></td>
                                    <td>{{$datas['job']->deadline}}</td>
                                </tr>
                                <tr>
                                     <td><b> Status</b></td>
                                    <td>{{\App\Employees::getStatus($datas['job']->status)}}</td>
                                    <td><b> Job Locations</b></td>
                                    <td>@if(count($datas['jobs_location']) > 0) 
                                      @foreach($datas['jobs_location'] as $locations) 
                                      {{$locations->name.', '}} 
                                        @endforeach 
                                      @endif</td>
                                </tr>
                                 <tr>
                                    <td><b> Salary Negotiable</b></td>
                                    <td>{{$datas['job']->negotiable == 1 ? 'Yes' : 'No'}}</td>
                                    <td><b> Salary </b></td>
                                    <td>{{\App\Currency::getSymbol($datas['job']->salary_unit)}} {{$datas['job']->minimum_salary}}</td>
                                </tr>

                                 <tr>
                                    <td><b> Prefered Gender</b></td>
                                    <td>{{$datas['job']->gender}}</td>
                                    <td><b> Minimum Age </b></td>
                                    <td>{{$datas['job']->min_age}} years</td>
                                </tr>
                                 <tr>
                                    <td><b> Maximum Age </b></td>
                                    <td>{{$datas['job']->max_age}} years</td>
                                   <td></td><td></td>
                                    
                                </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                     @if(count($datas['job_educations']) > 0)

                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Educations</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                           <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <td>Level</td>
                                <td>Faculty</td>
                                <td>Percent</td>
                                <td>CGPA</td>
                                <td>Others</td>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($datas['job_educations'] as $education)
                                <tr>
                                  <td>{{\App\EducationLevel::getTitle($education->education_level_id)}}</td>
                                  <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
                                  <td>{{$education->percent}}</td>
                                  <td>{{$education->cgpa}}</td>
                                  <td>{{$education->others}}</td>
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>

                     @endif

                      @if(count($datas['job_experiences']) > 0)

                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Educations</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                           <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <td>Position</td>
                                <td>Duration</td>
                               
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($datas['job_experiences'] as $experience)
                                <tr>
                                  <td>{{\App\Experience::getTitle($experience->experience_id)}}</td>
                                 
                                  <td>{{$experience->experience.' '. $experience->format}}</td>
                                  
                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>

                     @endif
                      
                       @if($datas['jobs_requirements']->description != '')
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Job Description</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <?php echo $datas['jobs_requirements']->description; ?>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif

                       @if($datas['jobs_requirements']->specification != '')
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Job Specification</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          {{$datas['jobs_requirements']->specification}}
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif

                      @if($datas['jobs_requirements']->education_description != '')
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Education Description</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          {{$datas['jobs_requirements']->education_description}}
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif

                      @if($datas['jobs_requirements']->specific_requirements != '')
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Specific Requirements</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          {{$datas['jobs_requirements']->specific_requirements}}
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif

                      @if($datas['jobs_requirements']->specific_instruction != '')
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Specific Intruction</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          {{$datas['jobs_requirements']->specific_instruction}}
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif
                      @if(count($datas['jobs_form']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Extra Form</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          @foreach($datas['jobs_form'] as $value)
                          <div class="form-group">
                          <?php if($value['rq'] == 1){
                                $rq= 'required' ;
                              } else {
                                $rq='';
                              }
                               ?>
                                    <input type="hidden" name="optitle[]"  value="<?php echo $value['level'];?>" />
                                    <label class="col-md-3 control-label {{$rq}}"><?php echo ucfirst($value['level']);?>:</label>
                                    <div class="col-md-9"><?php echo $value['form'];?></div>
                                    <div style="clear: both;"></div>
                          </div>
                          @endforeach
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif
                      
                </div>
            </div>
        </div>
    </div>
</div>
</div>



@endsection