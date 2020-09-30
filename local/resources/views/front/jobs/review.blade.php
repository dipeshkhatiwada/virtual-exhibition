<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading"><b style="font-size:14px;">You are Applying for {{$datas['datas']['job_title']}}</b></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/jobs/apply') }}">
                        <input type="hidden" name="job_id" value="{{$datas['datas']['jobs_id']}}">
                        <input type="hidden" name="job_title" value="{{$datas['datas']['job_title']}}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-12">
                            
                            <div class="tab-content">
                                        <div class="form-group {{$datas['saluation_class']}}">
                                            <label class="col-md-3 control-label ">Salutation</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{\App\Saluation::getTitle($datas['datas']['salutation'])}}">
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['first_name_class']}}">
                                            <label class="col-md-3 control-label ">First Name</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control"  value="{{ $datas['datas']['firstname'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['middle_name_class']}}">
                                            <label class="col-md-3 control-label ">Middle Name</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control"  value="{{ $datas['datas']['middlename'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['last_name_class']}}">
                                            <label class="col-md-3 control-label ">Last Name</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['lastname'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['email_class']}}">
                                            <label class="col-md-3 control-label ">E-mail</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['email'] }}">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group {{$datas['gender_class']}}">
                                            <label class="col-md-3 control-label ">Gender</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['gender'] }}">
                                                
                                               
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['marital_status_class']}}">
                                            <label class="col-md-3 control-label ">Marital Status</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['marital_status'] }}">
                                                
                                                
                                            </div>
                                        </div>
                                       
                                   
                                        <div class="form-group {{$datas['permanent_address_class']}}">
                                            <label class="col-md-3 control-label ">Permanent Address</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['permanent_address'] }}">
                                                

                                               
                                            </div>
                                        </div>
                                       
                                        <div class="form-group {{$datas['temporary_address_class']}}">
                                            <label class="col-md-3 control-label ">Temporary Address</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['temporary_address'] }}">
                                                

                                               
                                                   
                                            </div>
                                        </div>
                                         <div class="form-group {{$datas['home_phone_class']}} ">
                                            <label class="col-md-3 control-label ">Home Phone</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['home_phone'] }}">
                                                

                                                
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['mobile_phone_class']}}">
                                            <label class="col-md-3 control-label ">Mobile</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly"  class="form-control" value="{{ $datas['datas']['mobile'] }}">
                                               
                                            </div>
                                        </div>
                                  
                                        <div class="form-group {{$datas['fax_class']}}">
                                            <label class="col-md-3 control-label ">Fax</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['fax'] }}">
                                                
                                               
                                            </div>
                                        </div>
                                       
                                        <div class="form-group {{$datas['website_class']}}">
                                            <label class="col-md-3 control-label ">Website</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" name="website" value="{{ $datas['datas']['website'] }}">
                                                
                                               
                                            </div>
                                        </div>
                                         <div class="form-group {{$datas['dob_class']}}">
                                            <label class="col-md-3 control-label ">Date of Birth</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="{{ $datas['datas']['dob'] }}">
                                                
                                                
                                               
                                            </div>
                                        </div>
                                        <div class="form-group {{$datas['nationality_class']}}">
                                            <label class="col-md-3 control-label ">Nationality</label>

                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly"  class="form-control" value="{{ $datas['datas']['nationality'] }}">
                                               
                                                
                                                
                                            </div>
                                        </div>
                                   
                                        <div class="form-group {{$datas['vehicle_class']}}">
                                        <label class="col-md-3 control-label ">Vehicle</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly"  class="form-control" value="{{ $datas['datas']['vehicle'] }}">
                                                
                                                

                                            </div>
                                        </div>
                                         
                                       
                                        <div class="form-group {{$datas['license_of_class']}}">
                                    <label class="col-md-3 control-label ">License of</label>
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly"  class="form-control" value="{{ $datas['datas']['license_of'] }}">
                                                                                              

                                            </div>
                                         
                                        </div>
                                             <div class="form-group {{$datas['pp_photo_class']}}">
                                            <label class="col-md-3 control-label ">Photo</label>

                                            <div class="col-md-9">

                                               @if($datas['datas']['imagepath'] != '')
                                            <img src="{{asset('/image/'.$datas['datas']['imagepath'])}}" width="100">
                                                @endif

                                               
                                            </div>
                                        </div>
                                                                               
                                        <div class="form-group {{$datas['resume_class']}}">
                                            <label class="col-md-3 control-label ">Resume</label>

                                            <div class="col-md-9">
                                               @if($datas['datas']['resume_ext'] == 'pdf')
                                               <img src="{{asset('/image/pdf_icon.png')}}" width="100">
                                               @else
                                               <img src="{{asset('/image/ms-word.png')}}" width="100">
                                               @endif
                                               @if($datas['datas']['resume'] != '')
                                               {{$datas['datas']['resume']}}
                                               @endif
                                               
                                            </div>
                                        </div>

                                        <div class="form-group {{$datas['cover_letter_class']}}">
                                            <label class="col-md-3 control-label ">Cover Letter</label>

                                            <div class="col-md-9">
                                                @if($datas['datas']['coverletter_ext'] == 'pdf')
                                               <img src="{{asset('/image/pdf_icon.png')}}" width="100">
                                               @else
                                               <img src="{{asset('/image/ms-word.png')}}" width="100">
                                               @endif
                                               @if($datas['datas']['coverletter'] != '')
                                               {{$datas['datas']['coverletter']}}
                                               @endif
                                               
                                               
                                            </div>
                                        </div>
                                        @if(count($datas['datas']['optitle']) > 0)
                                            @foreach($datas['datas']['optitle'] as $key => $value)
                                              <div class="form-group">
                                             
                                                        <label class="col-md-3 control-label">{{$value}}:</label>
                                                        <div class="col-md-9">
                                                            <input type="text" readonly="readonly" class="form-control"  value="{{ $datas['datas']['my_datas'][$key] }}">
                                                        </div>
                                                        
                                              </div>
                                              @endforeach
                                        @endif
                                         @if(count($datas['datas']['otherfiles']) > 0)
                                            @foreach($datas['datas']['otherfiles'] as $files)
                                              <div class="form-group">
                                             
                                                        <label class="col-md-3 control-label">{{$files['file_title']}}:</label>
                                                        <div class="col-md-9">
                                                             @if($files['extension'] == 'pdf')
                                                               <img src="{{asset('/image/pdf_icon.png')}}" width="100">
                                                               
                                                               @else
                                                               <img src="{{asset('/image/'.$files['file_path'])}}" width="100">
                                                               @endif
                                                               
                                                               
                                                               
                                                        </div>
                                                        
                                              </div>
                                              @endforeach
                                        @endif


           @if(count($datas['datas']['educations']) > 0)
                    
                    <div class="panel-heading title"><b style="font-size:14px;">Education</b></div>
                        <table class="table table-bordered ">

                            <thead>
                                <th>Country</th>
                                <th>Education Level</th>
                                <th>Faculty</th>
                               
                                <th>Institution</th>
                                <th>Board</th>
                                <th colspan="2">Percent/Grade</th>
                                <th>Year</th>
                                
                            </thead>
                            <tbody>
                                
                                @foreach($datas['datas']['educations'] as $key => $old)

                                <tr>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['country']}}"></td>
                                    <td><input type="text" readonly="readonly"  class="form-control" value="{{\App\Faculty::getLevelTitle($old['level_id'])}}"></td>
                                    <td><input type="text" readonly="readonly"  class="form-control" value="{{\App\Faculty::getTitle($old['faculty'])}}"></td>
                                   
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['institution']}}"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['board']}}"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['percent']}}"></td>
                                     <td><input type="text" readonly="readonly" class="form-control" value="{{$old['pg']}}"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['year']}}"></td>
                                   
                                </tr>
                               @endforeach
                           </tbody>
                        </table>
                 


                    
                    @endif                             
                                    
                           @if(count($datas['datas']['training']) > 0)
                    
<div class="panel-heading title"><b style="font-size:14px;">Training</b></div>
                        <table class="table table-bordered table-hover">

                            <thead>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Institution</th>
                                <th>Duration</th>
                               
                                <th>Year</th>
                                
                            </thead>
                            <tbody >
                                

                            @foreach($datas['datas']['training'] as $key => $old)
                              <tr >
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$old['title']}}"> </td>
                                    <td><input type="text" readonly="readonly" value="{{$old['details']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['institution']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['duration'].' '.$old['duration_in']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['year']}}" class="form-control"></td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                   
                    @endif          
                        
                      @if(count($datas['datas']['language']) > 0)
                    <div class="panel-heading title"><b style="font-size:14px;">Language</b></div>

                        <table class="table table-bordered table-hover">

                            <thead>
                                <th>Languages</th>
                                <th>Understad</th>
                                <th>Speak</th>
                                <th>Read</th>
                                <th>Write</th>
                                
                                
                            </thead>
                            <tbody>
                                                           

                            @foreach($datas['datas']['language'] as $key => $old)
                              <tr>
                                    
                                   
                                    <td><input type="text" readonly="readonly" value="{{$old['language']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['understand']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['speak']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['read']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['write']}}" class="form-control"></td>
                                    
                                    
                                </tr>
                                @endforeach
                            </tbody>
                           
                        </table>

                 

                   
                    @endif

                     @if(count($datas['datas']['experience']) > 0)
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
                                
                            </thead>
                            <tbody>
                               
                            

                            @foreach($datas['datas']['experience'] as $key => $oldexp)
                              <tr>
                                    
                                   
                                    <td><input type="text" readonly="readonly" value="{{$oldexp['organization']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$oldexp['typeofemployment']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{\App\OrganizationType::getOrgTypeTitle($oldexp['org_type_id'])}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$oldexp['designation']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$oldexp['level']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$oldexp['from']}}"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$oldexp['to']}}"></td>
                                    <td><input type="text" readonly="readonly" class="form-control" value="{{$oldexp['currently_working'] == 1 ? 'Currently Working' : 'Not Working'}}"></td>
                                    <td><input type="text" readonly="readonly" value="{{$oldexp['country']}}" class="form-control"></td>
                                    
                                </tr>
                                
                            @endforeach
                         
                            </tbody>
                           
                        </table>
                  
                    

                     @endif

                     @if(count($datas['datas']['reference']) > 0)

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
                                
                            </thead>
                            <tbody>
                                                           

                            @foreach($datas['datas']['reference'] as $key => $old)
                              <tr>
                                                                   
                                    <td><input type="text" readonly="readonly" value="{{$old['name']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['designation']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['address']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['office_phone']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['mobile']}}" class="form-control"></td>

                                    <td><input type="email" readonly="readonly" value="{{$old['ref_email']}}" class="form-control"></td>
                                    <td><input type="text" readonly="readonly" value="{{$old['company']}}" class="form-control"></td>
                                    
                                </tr>
                                
                            @endforeach
                         
                            </tbody>
                            
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

<script>
function goBack() {
    window.history.back();
}
</script>