<form class="form-horizontal dash_forms" role="form" id="edit_training_form_{{$datas['training']->id}}" method="POST" enctype="multipart/form-data" action="{{ url('/employee/trainings/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$datas['training']->id}}">
                    <input type="hidden" name="old_document" value="{{$datas['training']->document}}">
                   <div class="col-12 alert-danger training_error_message" id="training_error_{{$datas['training']->id}}"></div>
                    
                      <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Title</label>
                        
                          <input type="text" required="required" class="form-control" name="title" value="{{ $datas['training']->title }}">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Details</label>
                       
                          <input type="text" required="required" class="form-control" name="details" value="{{ $datas['training']->details }}">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Institution</label>
                       
                          <input type="text" required="required" class="form-control institution" id="institution_training{{$datas['training']->id}}" data-type="training" data-id="{{$datas['training']->id}}"  name="institution" placeholder="Institution" autocomplete="off" value="{{ $datas['training']->institution }}">
                            <input type="hidden" name="employers_id" id="employer_id_training{{$datas['training']->id}}" placeholder="Employer ID" value="{{$datas['training']->employers_id}}">
                            <div id="institution_list_training{{$datas['training']->id}}" class="col-md-12 orglist">    </div>
                        </div>
                         <div class="col-md-6">
                           <label class="required">Duration</label>
                       
                          <input type="text" required="required" class="form-control" name="duration" value="{{ $datas['training']->duration }}">
                        </div>
                      </div>
                      <div class="form-group row ">
                         <div class="col-md-6">
                          <label class="required">Year</label>
                       
                          <input type="text" required="required" class="form-control" maxlength="4" name="year" value="{{ $datas['training']->year }}">
                        </div>
                         <div class="col-md-6">
                           <label class="">Document</label>
                             <input type="file" name="training_document" class="form-control">
                              @if($datas['training']->document != '')
                             @php($document = explode('/',$datas['training']->document))
                             @if(is_array($document))

                             <a href="{{asset('/image/'.$datas['training']->document)}}" target="_blank" class="document_name">{{end($document)}}</a>
                             @endif
                             @endif
                         </div>
                      </div>
                     
                      <div class="form-group row ">
                        
                     
                    <div class="col-md-6">
                      <button type="button" id="update_training_{{$datas['training']->id}}" data-id="{{$datas['training']->id}}" class="btn bluebg sendbtn update_training"> Update <i class="fa fa-paper-plane"></i></button>
                    </div>
                  </div>
                  </form>

