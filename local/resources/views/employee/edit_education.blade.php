<form class="form-horizontal dash_forms" role="form" id="edit-education-form{{$datas['education']->id}}" method="POST" enctype="multipart/form-data" action="{{ url('/employee/educations/update') }}">
                      <input type="hidden" name="id" value="{{$datas['education']->id}}">
                      <input type="hidden" name="old_document" value="{{$datas['education']->document}}">
                     <div class="col-12 alert-danger education_error_message" id="education_error_{{$datas['education']->id}}"></div>
                      {!! csrf_field() !!}
                      
                        <div class="form-group row ">
                          <div class="col-md-6">
                          <label class="required">Country</label>
                         
                          <input type="text" required="required" class="form-control" name="country" placeholder="Country" value="{{$datas['education']->country}}">
                          
                        </div>
                        <div class="col-md-6">
                           <label class="required">Education Level</label>
                             <select class="form-control level_id" data-id="{{$datas['education']->id}}"  name="level_id">
                              <option value="0">Select Level</option>
                              @foreach($datas['educationlevel'] as $levels)
                                @if($datas['education']->level_id == $levels->id)
                                <option selected="" value="{{$levels->id}}">{{$levels->name}}</option>
                                @else
                                <option value="{{$levels->id}}">{{$levels->name}}</option>
                                @endif
                              @endforeach
                            </select>
                        </div>
                      </div>
                        
                        <div class="form-group row">
                           <div class="col-md-6">
                          <label class="required">Faculty</label>
                          
                            <select class="form-control" id="faculty_{{$datas['education']->id}}" name="faculty_id">
                               <?php echo \App\Faculty::getFaculties($datas['education']->level_id,$datas['education']->faculty_id); ?>
                            </select>
                          </div>
                          <div class="col-md-6">
                            <label class="required">Specialization</label>
                          
                            <input type="text" required="required" class="form-control" name="specialization" placeholder="Specialization" value="{{ $datas['education']->specialization }}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                             <label class="required">Institution</label>
                          
                            <input type="text" required="required" class="form-control institution" id="institution_education{{$datas['education']->id}}" data-type="education" data-id="{{$datas['education']->id}}"  name="institution" placeholder="Institution" autocomplete="off" value="{{ $datas['education']->institution }}">
                            <input type="hidden" name="employers_id" id="employer_id_education{{$datas['education']->id}}" placeholder="Employer ID" value="{{$datas['education']->employers_id}}">
                            <div id="institution_list_education{{$datas['education']->id}}" class="col-md-12 orglist">    </div>
                          </div>
                          <div class="col-md-6">
                           <label class="required">Board</label>
                          
                            <input type="text" required="required" class="form-control" name="board" placeholder="Board" value="{{$datas['education']->board}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label class="required">Mark System</label>
                          
                          <select class="form-control" name="marksystem">
                            @foreach($datas['marksystem'] as $msys)
                            @if($msys['value'] == $datas['education']->marksystem)
                            <option selected="selected" value="{{$msys['value']}}">{{$msys['title']}}</option>
                            @else
                            <option value="{{$msys['value']}}">{{$msys['title']}}</option>
                            @endif
                            @endforeach
                          </select>
                          </div>
                          <div class="col-md-6">
                             <label class="required">Percent/CGPA</label>
                          
                            <input type="text" required="required" class="form-control" name="percent" placeholder="Percent" value="{{$datas['education']->percentage}}">
                          </div>
                         
                        </div>
                       
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label class="required">Year</label>
                           
                            <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="Year" value="{{$datas['education']->year}}">
                          </div>
                          <div class="col-md-6">
                             <label class="">Document</label>
                             <input type="file" name="education_document" class="form-control">
                             @if($datas['education']->document != '')
                             @php($document = explode('/',$datas['education']->document))
                             @if(is_array($document))

                             <a href="{{asset('/image/'.$datas['education']->document)}}" target="_blank" class="document_name">{{end($document)}}</a>
                             @endif
                             @endif
                          
                          </div>
                        </div>
                        
                       
                       
                     
                      <div class="form-group row">
                        <div class="col-md-6">
                          <button type="button" id="update_button_{{$datas['education']->id}}" data-id="{{$datas['education']->id}}" class="btn bluebg sendbtn update_education"> Update <i class="fa fa-paper-plane"></i></button>
                        </div>
                        
                      </div>
                     
                    </form>



