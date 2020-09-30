@extends('employer_master')
@section('content')
<h3 class="form_heading">Detail of View Applicants
    <div class="clear"></div>
  
  </h3>


 <div class="form_tabbar">
                
                <div class="panel-body">
                   
                    <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Personal Information</h3>

                          <div class="box-tools pull-right">
                           
                                    <button type="button" id="for-written" onClick="downloadCV()" class="btn upgradebtn">Download CV</button>
                                   
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          <table class="table table-bordered table-hover">
                            <tbody>
                              <tr>
                                    <td><b> Application Id</b></td>
                                    <td>{{$datas['employee']->id}}</td>
                                </tr>
                               
                                
                                <tr>
                                    <td style="width: 25%"><b> Full Name</b></td>
                                    <td>{{\App\Employees::getFullname($datas['employee']->firstname,$datas['employee']->middlename,$datas['employee']->lastname)}}</td>
                                </tr>
                               
                                @if($datas['employee']->gender != '')
                                <tr>
                                    <td><b> Gender</b></td>
                                    <td>{{$datas['employee']->gender}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->dob != '')
                                <tr>
                                    <td><b> Date of Birth</b></td>
                                    <td>{{$datas['employee']->dob}}</td>
                                </tr>
                                @endif
                                 @if($datas['employee']->age != '')
                                <tr>
                                    <td><b> Age</b></td>
                                    <td>{{$datas['employee']->age}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->total_experience != '')
                                <tr>
                                    <td><b> Total Experience</b></td>
                                    <td>{{$datas['employee']->total_experience}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->marital_statu != '')
                                <tr>
                                    <td><b> Marital Status</b></td>
                                    <td>{{$datas['employee']->marital_status}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->vehicle != '')
                                <tr>
                                  <tr>
                                    <td><b> Vehicle</b></td>
                                    <td>{{$datas['employee']->vehicle}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->license_of != '')
                                <tr>
                                    <td><b> License Of</b></td>
                                    <td>{{$datas['employee']->license_of}}</td>
                                </tr>
                                @endif
                                @if($datas['employee']->permanent_address != '')
                                <tr>
                                    <td><b> Permanent Address</b></td>
                                    <td>{{$datas['employee']->permanent_address}}</td>
                                </tr>
                                @endif
                                  @if($datas['employee']->temporary_address != '')
                                  <tr>
                                    <td><b>Temporary Address</b></td>
                                    <td>{{$datas['employee']->temporary_address}}</td>
                                </tr>
                                  @endif
                              
                                 
                                  
                                   @if($datas['employee']->image != '')
                                  <tr>
                                    <td><b>Image</b></td>
                                    <td><a href="{{asset('image/'.$datas['employee']->image)}}" target="_blank" download></a><img src="{{asset('image/'.$datas['employee']->image)}}" height="150" download></a></td>
                                    
                                  </tr>
                                  @endif
                                 
                                  
                            </tbody>
                          </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                     @if(count($datas['education']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Education Qualification</h3>

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
                                <th>Country</th>
                                <th>Education Level</th>
                                <th>Faculty</th>
                                
                                <th>Institution</th>
                                <th>Board</th>
                                <th>Percent/Grade</th>
                                <th>Year</th>
                                
                            </thead>
                            <tbody>
                           
                              @foreach($datas['education'] as $education)
                                <tr>
                                    <td>{{$education->country}}</td>
                                    <td>{{\App\Faculty::getLevelTitle($education->level_id)}}</td>
                                    <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
                                    
                                    <td>{{$education->institution}}</td>
                                    <td>{{$education->board}}</td>
                                    <td>{{$education->percentage}}</td>
                                    <td>{{$education->year}}</td>
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                       @endif
                        @if(count($datas['training']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Training</h3>

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
                                <th>Title</th>
                                <th>Details</th>
                                <th>Institution</th>
                                <th>Duration</th>
                               
                                <th>Year</th>
                                
                            </thead>
                            <tbody>
                          
                              @foreach($datas['training'] as $training)
                                <tr>
                                    <td>{{$training->title}}</td>
                                    
                                    <td>{{$training->details}}</td>
                                    <td>{{$training->institution}}</td>
                                    <td>{{$training->duration}}</td>
                                    
                                    <td>{{$training->year}}</td>
                                </tr>
                              @endforeach
                          
                          </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      @endif
                      
                       @if(count($datas['experience']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Experiences</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
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
                                
                            </thead>
                            <tbody>
                          
                              @foreach($datas['experience'] as $experience)
                              @php($approved = '')
                                  @if($experience->status == 1)
                                  @php($approved = 'approved')
                                  @endif
                                <tr class="{{$approved}}">
                                    <td>{{$experience->organization}}</td>
                                    
                                    <td>{{$experience->typeofemployment}}</td>
                                    <td>{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
                                    <td>{{$experience->designation}}</td>
                                    
                                    <td>{{$experience->level}}</td>
                                    <td>{{$experience->from}}</td>
                                    <td>{{$experience->to}}</td>
                                    <td>{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
                                    <td>{{$experience->country}}</td>
                                    
                                </tr>
                                @if($experience->experience != '')
                                <tr><td colspan="9">{!! $experience->experience !!}</td></tr>
                                @endif
                              @endforeach
                         
                          </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                       @endif
                       @if(count($datas['language']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Languages</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table class="table table-bordered table-hover">
                               <thead>
                                <th>Languages</th>
                                <th>Understad</th>
                                <th>Speak</th>
                                <th>Read</th>
                                <th>Write</th>
                               
                               
                            </thead>
                            <tbody>
                           
                              @foreach($datas['language'] as $language)
                                <tr>
                                    <td>{{$language->language}}</td>
                                    
                                    <td>{{$language->understand}}</td>
                                    
                                    <td>{{$language->speak}}</td>
                                    
                                    <td>{{$language->reading}}</td>
                                    <td>{{$language->writing}}</td>
                                   
                                   
                                    
                                </tr>
                              @endforeach
                         
                          </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                       @endif
                       @if(count($datas['reference']) > 0)
                      <div class="box box-default box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">References</h3>

                          <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                           <table class="table table-bordered table-hover">
                               <thead>
                                <th>Name</th>
                                <th>Designation</th>
                                <th>Address</th>
                                <th>Office Phone</th>
                                <th>Mobile</th>
                                <th>E-mail</th>
                                <th>Company</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                           
                              @foreach($datas['reference'] as $reference)
                                <tr>
                                    <td>{{$reference->name}}</td>
                                    
                                    <td>{{$reference->designation}}</td>
                                    
                                    <td>{{$reference->address}}</td>
                                    
                                    <td>{{$reference->office_phone}}</td>
                                    <td>{{$reference->mobile}}</td>
                                   
                                    <td>{{$reference->email}}</td>
                                    <td>{{$reference->company}}</td>

                                    <td>
                                     
                                      {!! $reference->Comments != NULL ? '<a href="#" data-toggle="modal" data-target="#comment-modal'.$reference->id.'">View</a>' : 'Waiting' !!}
                                     
                                    </td>
                                    
                                </tr>
                               
                              @endforeach
                          
                          </tbody>
                            </table>
                            @foreach($datas['reference'] as $reference)
                             <div class="modal fade servicemodal" id="comment-modal{{$reference->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        
                                        <h4 class="modal-title left" >Comment Detail</h4>
                                        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                      </div>
                                      
                                      <div class="modal-body">
                                          @if($reference->Comments != NULL)
                                         
                                        <table class="table table-bordered table-hover">
                                            <tr>
                                                <td><strong>Name</strong></td>
                                                <td>{{$reference->Comments->name}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Email</strong></td>
                                                <td>{{$reference->Comments->email}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Company</strong></td>
                                                <td>{{$reference->Comments->company}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Phone</strong></td>
                                                <td>{{$reference->Comments->phone}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Relationship</strong></td>
                                                <td>{{$reference->Comments->relationship}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Capacity</strong></td>
                                                <td>{{$reference->Comments->capacity}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Duties and Responsibility</strong></td>
                                                <td>{{$reference->Comments->duties}}</td>
                                            </tr>
                                             <tr>
                                                <td><strong>Overal Work</strong></td>
                                                <td>{{$reference->Comments->overall_work}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Reliability</strong></td>
                                                <td>{{$reference->Comments->reliability}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Punctuality</strong></td>
                                                <td>{{$reference->Comments->punctuality}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Attendance</strong></td>
                                                <td>{{$reference->Comments->attendance}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Professionalism</strong></td>
                                                <td>{{$reference->Comments->professionalism}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Leaving Reason</strong></td>
                                                <td>{{$reference->Comments->leaving_reason}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Wish to Re-hire</strong></td>
                                                <td>{{$reference->Comments->re_employe}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Comment Date</strong></td>
                                                <td>{{$reference->Comments->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Overal Comment</strong></td>
                                                <td>{{$reference->Comments->comment}}</td>
                                            </tr>
                                        </table>
                                        @endif
                                       
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        
                                      </div>
                                    
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
                            @endforeach
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                      @endif
                     
                </div>
            </div>
        </div>
    

<form class="form-horizontal" role="form" id="testform" method="POST" action="">
                {!! csrf_field() !!}
                  
                    <input type="hidden" name="employee_id" value="{{$datas['employee']->id}}">


</form>
<script type="text/javascript">
 function downloadCV() {
   if(confirm('Are you sure you want to download CV?')){
      $('#testform').attr('action', '{{ url("/employer/searchresume/download") }}');
      
      $('#testform').submit();
      
      }
 }

</script>
@endsection