<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<div class="container">
 <div class="row">
    <div class="col-xs-12">
          <div class="card">
                <div class="card-header">Edit Employer</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ url('/employer/updateprofile') }}">
                        <input type="hidden" name="id" value="{{$datas['employer']->id}}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-12">
                            <ul class="nav nav-tabs card-header-tabs float-left row" role="tablist">
                                <li class="nav-item"><a class="nav-link" id="1" data-toggle="tab" href="#" data-target="#tab-general" role="tab">
                                General Information</a></li>  
                                <li class="nav-item"><a class="nav-link" id="2" data-toggle="tab" href="#" data-target="#tab-head" role="tab">
                                Organization Head</a></li>
                                <li class="nav-item"><a class="nav-link" id="3" data-toggle="tab" href="#" data-target="#tab-contact" role="tab">
                                Contact Person</a></li>
                                <li class="nav-item"><a class="nav-link" id="4" data-toggle="tab" href="#" data-target="#tab-address" role="tab">
                                Organization Address</a></li>
                            </ul>
                        </div>

                            <div class="card-block">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-general"  role="tabpanel">

                                    <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Name</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="name" value="{{ $datas['employer']->name }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group row{{ $errors->has('organization_size') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Organization Size</label>
                            <div class="col-md-10">
                                <select name="organization_size" id="organization_size" class="form-control" >
                                    <?php foreach($datas['size'] as $size){ 
                                        if($datas['employer']->org_size == $size->id) {
                                        ?>
                                        <option selected="selected" value="{{ $size->id }}">{{ $size->name }} </option>
                                    <?php } else { ?>
                                            <option value="{{ $size->id }}">{{ $size->name }} </option>
                                    <?php }} ?>
                                </select>
                                @if ($errors->has('organization_size'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization_size') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row{{ $errors->has('organization_type') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Organization Type</label>
                            <div class="col-md-10">
                                <select name="organization_type" id="organization_type" class="form-control" >
                                    <?php foreach($datas['type'] as $type){ 
                                        if($datas['employer']->org_type == $type->id) {
                                        ?>
                                        <option selected="selected" value="{{ $type->id }}">{{ $type->name }} </option>
                                    <?php } else { ?>
                                            <option value="{{ $type->id }}">{{ $type->name }} </option>
                                    <?php }} ?>
                                </select>
                                @if ($errors->has('organization_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organization_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('ownership') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Ownership</label>
                            <div class="col-md-10">
                                <select name="ownership" id="ownership" class="form-control" >
                                    <?php foreach($datas['ownership'] as $ownership){ 
                                        if($datas['employer']->ownership == $ownership->id) {
                                        ?>
                                        <option selected="selected" value="{{ $ownership->id }}">{{ $ownership->name }} </option>
                                    <?php } else { ?>
                                            <option value="{{ $ownership->id }}">{{ $ownership->name }} </option>
                                    <?php }} ?>
                                </select>
                                @if ($errors->has('ownership'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ownership') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       


                        <div class="form-group row">
                            <label class="col-md-2 control-label">Description</label>

                            <div class="col-md-10">
                               <textarea class="form-control" id="description" name="description">{{$datas['employer']->description}}</textarea>

                                <script>
      
       
        CKEDITOR.replace('description',
        {
                                    filebrowserBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html")}}',
                                    filebrowserImageBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Images")}}',
                                    filebrowserFlashBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Flash")}}',
                                    filebrowserUploadUrl : 
'{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
                                    filebrowserImageUploadUrl : 
'{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
                                    filebrowserFlashUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',
                                    enterMode: CKEDITOR.ENTER_BR
                                 } 
        
        );
       
        
     
    </script>
                            </div>
                        </div>

                       
                         <div class="form-group row">
                            <label class="col-md-2 control-label">Image</label>

                            <div class="col-md-10">
                            <input type="file" name="logo" value="{{$datas['employer']->logo}}"  />

                            @if($datas['employer']->logo !='')

                            <div class="col-md-4">
                                <img src="{{asset('image/'.$datas['employer']->logo)}}">
                            </div>
                            @endif


                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-md-2 control-label">Banner</label>

                            <div class="col-md-10">
                            <input type="file" name="banner" value="{{$datas['employer']->banner}}"  />

                            @if($datas['employer']->banner !='')

                            <div class="col-md-4">
                                <img src="{{asset('image/'.$datas['employer']->banner)}}">
                                
                            </div>
                            @endif



                            </div>
                        </div>

                       



</div>

                    
                    <div class="tab-pane" id="tab-head"  role="tabpanel">
                        <div class="form-group row{{ $errors->has('head_salutation') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Salutation</label>

                            <div class="col-md-10">
                                <select class="form-control" name="salutation">
                                    @foreach($datas['salutation'] as $salutation)
                                    @if($datas['head']->saluation === $salutation->id)
                                    <option selected="" value="{{$salutation->id}}">{{$salutation->name}}</option>
                                    @else
                                    <option value="{{$salutation->id}}">{{$salutation->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('head_salutation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('head_salutation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('head_name') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Name</label>

                            <div class="col-md-10">
                                <input type="text" value="{{$datas['head']->name}}" class="form-control" name="head_name">

                                @if ($errors->has('head_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('head_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('head_designation') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Designation</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['head']->designation}}" name="head_designation">

                                @if ($errors->has('head_designation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('head_designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                     <div class="tab-pane" id="tab-contact"  role="tabpanel">
                        <div class="form-group row{{ $errors->has('contact_salutation') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Salutation</label>

                            <div class="col-md-10">
                                <select class="form-control" name="contact_salutation">
                                   @foreach($datas['salutation'] as $salutation)
                                    @if($datas['contact']->saluation === $salutation->id)
                                    <option selected="" value="{{$salutation->id}}">{{$salutation->name}}</option>
                                    @else
                                    <option value="{{$salutation->id}}">{{$salutation->name}}</option>
                                    @endif
                                    @endforeach
                                </select>

                                @if ($errors->has('contact_salutation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_salutation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Name</label>

                            <div class="col-md-10">
                                <input type="text" value="{{$datas['contact']->name}}" class="form-control" name="contact_name">

                                @if ($errors->has('contact_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row{{ $errors->has('contact_designation') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Designation</label>

                            <div class="col-md-10">
                                <input type="text" value="{{$datas['contact']->designation}}" class="form-control" name="contact_designation">

                                @if ($errors->has('contact_designation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_designation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label ">Phone Number</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['contact']->phone}}" name="contact_phone">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label ">E-mail</label>

                            <div class="col-md-10">
                                <input type="email" class="form-control" value="{{$datas['contact']->email}}" name="contact_email">

                                
                            </div>
                        </div>

                    </div>

                     <div class="tab-pane" id="tab-address"  role="tabpanel">
                            <div class="form-group row{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label ">Phone</label>

                            <div class="col-md-10">
                                <input type="text" value="{{$datas['address']->phone}}" class="form-control" name="phone">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label class="col-md-2 control-label ">Secondary E-mail</label>

                            <div class="col-md-10">
                                <input type="email" class="form-control" value="{{$datas['address']->secondary_email}}" name="secondary_email">

                                
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-md-2 control-label ">Fax</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->fax}}" name="fax">

                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label ">Post Box</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->pobox}}" name="pobox">

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label ">Website</label>

                            <div class="col-md-10">
                                <input type="url" class="form-control" value="{{$datas['address']->website}}" name="website">

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 control-label ">Address</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->address}}" name="address">
                            </div>
                        </div>
                    </div>
                        <div class="form-group row">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn sendbtn bluebg">
                                    Save <i class="fa fa-fw fa-save"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
    </div>
</div>
</div>
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
<script type="text/javascript">
$(function() {
 
  $(".select2").select2({ width: '100%' });
});
</script>
