
 <form class="form-horizontal dash_forms" role="form" id="edit_experience_form_{{$datas['experience']->id}}" method="POST" action="{{ url('/employee/experiences/update') }}">
                    {!! csrf_field() !!}
                  <input type="hidden" name="id" value="{{$datas['experience']->id}}">
                      <input type="hidden" name="old_document" value="{{$datas['experience']->document}}">
                  <div class="col-12 alert-danger experience_error_message" id="experience_error_{{$datas['experience']->id}}"></div>
                      <div class="form-group row ">
                         <div class="col-md-6">
                        <label class="required">Organization</label>

                         <input type="text" required="required" class="form-control institution" id="institution_experience{{$datas['experience']->id}}" data-type="experience" data-id="{{$datas['experience']->id}}"  name="organization" placeholder="Institution" autocomplete="off" value="{{ $datas['experience']->organization }}">
                            <input type="hidden" name="employers_id" id="employer_id_experience{{$datas['experience']->id}}" placeholder="Employer ID" value="{{$datas['experience']->employers_id}}">
                            <div id="institution_list_experience{{$datas['experience']->id}}" class="col-md-12 orglist">    </div>

                        </div>
                        <div class="col-md-6">
                           <label class="required">Type Of Employment</label>
                        
                           <select class="form-control" name="typeofemployment">
                        @foreach($datas['employment_type'] as $em_type)
                          @if($datas['experience']->typeofemployment == $em_type['value'])
                          <option selected="selected" value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                          @else
                          <option value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                          @endif
                        @endforeach
                      </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                           <label class="required">Organization Type</label>
                       
                          <select class="form-control" name="org_type_id">
                            @foreach($datas['organization_type'] as $org_type)
                              @if($datas['experience']->org_type_id == $org_type->id)
                              <option selected="selected" value="{{$org_type->id}}">{{$org_type->name}}</option>
                              @else
                              <option value="{{$org_type->id}}">{{$org_type->name}}</option>
                              @endif
                            @endforeach
                          </select>
  
                        </div>
                        <div class="col-md-6">
                          <label class="required">Designation</label>
                        
                          <input type="text" required="required" class="form-control" name="designation" value="{{ $datas['experience']->designation }}">
                        </div>
                       
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                           <label class="required">Level</label>
                        
                          <select class="form-control" name="level">
                            @foreach($datas['job_level'] as $job_level)
                              @if($datas['experience']->level == $job_level['value'])
                              <option selected="selected" value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                              @else
                              <option value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                           <label class="required">from</label>
                        

                          <input type="text" required="required" class="form-control datepicker" name="from" placeholder="2019-12-16" value="{{ $datas['experience']->from }}">
                        </div>
                       
                      </div>
                      <div class="form-group row ">
                         <div class="col-md-6">
                           <label class="required">To</label>
                        
                          <input type="text" required="required" class="form-control datepicker" name="to" id="to" placeholder="2019-12-18" value="{{ $datas['experience']->to }}">
                         </div>
                          <div class="col-md-6">
                             <label class="required">Currently Working</label>
                        
                          <select class="form-control" id="currently" name="currently_working">
                            @foreach($datas['working_status'] as $working_status)
                              @if($datas['experience']->currently_working == $working_status['value'])
                              <option selected="selected" value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                              @else
                              <option value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                              @endif
                            @endforeach
                          </select>
                          </div>
                        
                        
                      </div>
                     
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Country</label>
                        
                          <input type="text" required="required" class="form-control" name="country" placeholder ="Nepal" value="{{ $datas['experience']->country }}">
                       
                        </div>
                        <div class="col-md-6">
                          <label class="">Document</label>
                             <input type="file" name="experience_document" class="form-control">
                              @if($datas['experience']->document != '')
                             @php($document = explode('/',$datas['experience']->document))
                             @if(is_array($document))

                             <a href="{{asset('/image/'.$datas['experience']->document)}}" target="_blank" class="document_name">{{end($document)}}</a>
                             @endif
                             @endif
                        </div>
                      </div>
                      
                      <div class="form-group row ">
                        <div class="col-md-12">
                         <label class="required">Experience Detail</label>
                        
                          <textarea class="form-control" name="detail" required="required"><?php echo strip_tags($datas['experience']->experience);?></textarea>
                        </div>
                      </div>
                     
                  

                    <div class="form-group row">
                      <div class="col-md-12">
                       <button type="button" id="update_experience_{{$datas['experience']->id}}" data-id="{{$datas['experience']->id}}" class="btn bluebg sendbtn update_experience"> Update <i class="fa fa-paper-plane"></i></button>
                    </div>
                  </div>
                  </form>




                   
                   
                   
                   
                   
                 


 
        
