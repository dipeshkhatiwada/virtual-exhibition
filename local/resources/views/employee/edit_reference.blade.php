<form class="form-horizontal dash_forms" role="form" id="edit_reference_form_{{$datas['reference']->id}}" method="POST" enctype="multipart/form-data" action="{{ url('/employee/references/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$datas['reference']->id}}">
                    
                   <div class="col-12 alert-danger reference_error_message" id="reference_error_{{$datas['reference']->id}}"></div>
                   <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Name</label>
                        
                        <input type="text" name="name" class="form-control" placeholder="Reference Name" value="{{ $datas['reference']->name }}">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Designation</label>
                        
                          <input type="text" required="required" class="form-control" name="designation" placeholder="Designation" value="{{ $datas['reference']->designation }}">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Address</label>
                        
                          <input type="text" required="required" class="form-control" name="address" placeholder="Address" value="{{ $datas['reference']->address }}">
                       
                        </div>
                        <div class="col-md-6">
                           <label class="required">Office Phone</label>
                        
                          <input type="text" required="required" class="form-control" name="office_phone" placeholder="Office Phone" value="{{ $datas['reference']->office_phone }}">
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Mobile</label>
                        
                          <input type="text" required="required" class="form-control" name="mobile" placeholder="Mobile" value="{{ $datas['reference']->mobile }}">
                        </div>
                        <div class="col-md-6">
                          <label class="required">E-mail</label>
                        
                          <input type="text" required="required" class="form-control" name="email" placeholder="Email" value="{{ $datas['reference']->email }}">
                        </div>
                      </div>
                    
                      <div class="form-group row ">
                         <div class="col-md-6">
                          <label class="required">Company</label>
                        
                          <input type="text" required="required" class="form-control" name="company" placeholder="Company" value="{{ $datas['reference']->company }}">
                        </div>
                         <div class="col-md-6">
                            <button type="button" id="update_reference_{{$datas['reference']->id}}" data-id="{{$datas['reference']->id}}" class="btn bluebg sendbtn update_reference"> Update <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                  </form>

