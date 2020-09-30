 <form class="form-horizontal dash_forms" role="form" id="edit_language_form_{{ $datas['language']->id }}" method="POST" action="{{ url('/employee/languages/update') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{ $datas['language']->id }}">
                    <div class="form-group row ">
                      <div class="col-12 alert-danger language_error_message" id="language_error_{{$datas['language']->id}}"></div>
                    </div>
                  
                      <div class="form-group row ">
                        <div class="col-md-6">
                        <label class="required">Language</label>
                        
                        <input type="text" name="language" class="form-control" placeholder="Nepali" value="{{$datas['language']->language}}">
                        </div>
                        <div class="col-md-6">
                           <label class="required">Understand</label>
                        
                          <select class="form-control" name="understand">
                          @foreach($datas['easy'] as $easy)
                          @if($datas['language']->understand == $easy['value'])
                          <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @else
                          <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @endif
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Speak</label>
                        
                          <select class="form-control" name="speak">
                          @foreach($datas['fluent'] as $fluent)
                          @if($datas['language']->speak == $fluent['value'])
                          <option selected="selected" value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                          @else
                          <option value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                          @endif
                          @endforeach
                          </select>
                       
                        </div>
                        <div class="col-md-6">
                           <label class="required">Read</label>
                        
                          <select class="form-control" name="read">
                          @foreach($datas['easy'] as $easy)
                          @if($datas['language']->reading == $easy['value'])
                          <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @else
                          <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @endif
                          @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row ">
                        <div class="col-md-6">
                          <label class="required">Write</label>
                        
                           <select class="form-control" name="write">
                          @foreach($datas['easy'] as $easy)
                          @if($datas['language']->writing == $easy['value'])
                          <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @else
                          <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                          @endif
                          @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="required">Mother Tongue</label>
                        
                            <select class="form-control" name="mother_t">
                            @foreach($datas['yes_no'] as $uyn)
                            @if($datas['language']->mother_t == $uyn['value'])
                            <option selected="selected" value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                            @else
                            <option value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                      </div>
                    
                      <div class="form-group row ">
                         
                         <div class="col-md-6">
                           <button type="button" id="update_language_{{$datas['language']->id}}" data-id="{{$datas['language']->id}}" class="btn bluebg sendbtn update_language"> Update <i class="fa fa-paper-plane"></i></button>
                         </div>
                      </div>
                    
                     
                  </form>
