@extends('employer_master')
@section('content')
<style type="text/css">
.button-upload{
width: 45px;
height: 45px;
}
.button-upload a img{
width: 100%;
}
</style>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <h3 class="form_heading">Edit Profile</h3>
    @if(count($errors))
        <div class="col-xs-12">
            <div class="alert alert-danger">
             @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
             @endforeach
            </div>
        </div>
    @endif
    <div class="form_tabbar">
        <ul class="nav nav-tabs form_tab" id="formTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#tab-general" role="tab" aria-controls="tab-general" aria-selected="true">General Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="extraform-tab" data-toggle="tab" href="#tab-head" role="tab" aria-controls="tab-head" aria-selected="false">Organization Head</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="extraform-tab" data-toggle="tab" href="#tab-contact" role="tab" aria-controls="tab-contact" aria-selected="false">Contact Person</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="extraform-tab" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Primary Contact Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="extraform-tab" data-toggle="tab" href="#tab-facilities" role="tab" aria-controls="tab-facilities" aria-selected="false">Facilities</a>
            </li>
        </ul>
        <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{ $datas['href'] }}">
            <input type="hidden" name="id" value="{{$datas['employer']->id}}">
            {!! csrf_field() !!}
            
            
            
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel" aria-labelledby="info-tab">
                    
                    <div class="form-group row ">
                        <div class="col-md-4 {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="required">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $datas['employer']->name }}">
                            @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 {{ $errors->has('organization_size') ? ' has-error' : '' }}">
                            <label class="required">Organization Size</label>
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
                        <div class="col-md-4 {{ $errors->has('organization_type') ? ' has-error' : '' }}">
                            <label class="required">Organization Type</label>
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
                    <div class="form-group row ">
                        
                        <div class="col-md-4 {{ $errors->has('ownership') ? ' has-error' : '' }}">
                            <label class="required">Ownership</label>
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
                        <div class="col-lg-4 col-md-4 col-6 {{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label>Logo</label>
                            <a href="" id="logo-image" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas['logo']) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                            <input type="hidden" name="logo" value="{{$datas['employer']->logo}}" id="input-logo" />
                            
                        </div>
                        <div class="col-lg-4 col-md-4 col-6 {{ $errors->has('banner') ? ' has-error' : '' }}">
                            <label>Banner</label>
                            <a href="" id="banner-image" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas['banner']) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                            <input type="hidden" name="banner" value="{{$datas['employer']->banner}}" id="input-banner" />
                        </div>
                    </div>
                    @php($customize = \App\MemberType::getCustomizePage())
                    @if($customize == 'Yes')
                    <div class="form-group row ">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            @if(isset($datas['colors']))
                            <label>Banner</label>
                            <select class="form-control" name="color">
                                @foreach($datas['colors'] as $color)
                                @if($datas['employer']->color == $color['value'])
                                <option selected="selected" value="{{$color['value']}}" style="background: #{{$color['color']}}; color: #fff; text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);">{{$color['title']}}</option>
                                @else
                                <option value="{{$color['value']}}" style="background: #{{$color['color']}}; color: #fff !important; text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);">{{$color['title']}}</option>
                                @endif
                                @endforeach
                            </select>
                            @endif
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6 col-12">
                            @if(isset($datas['layouts']))
                             <label>Banner</label>
                             <div class="row">
                            @foreach($datas['layouts'] as $layout)
                            <div class="col-md-3 col-6">
                                <img src="{{$layout['image']}}" style="width: 100%;">
                                <center>
                                    @if($datas['employer']->layout == $layout['value'])
                                    <input type="radio" name="layout" value="{{$layout['value']}}" checked="checked">
                                    @elseif($layout['value'] == 1)
                                    <input type="radio" name="layout" value="{{$layout['value']}}" checked="checked">
                                    @else
                                    <input type="radio" name="layout" value="{{$layout['value']}}" >
                                    @endif
                                </center>
                            </div>
                            @endforeach
                        </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label class="">Description</label>
                            
                            <textarea class="form-control" id="description" name="description">{{old('description') != '' ? old('description') : $datas['employer']->description}}</textarea>
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
                    
                    
                    
                    
                </div>
                
                <div class="tab-pane" id="tab-head"  role="tabpanel">
                    <div class="form-group row">
                        <div class="col-md-4 {{ $errors->has('head_salutation') ? ' has-error' : '' }}">
                            <label>Salutation</label>
                            
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
                        <div class="col-md-4 {{ $errors->has('head_name') ? ' has-error' : '' }}">
                            <label>Name</label>
                            
                            <input type="text" value="{{old('head_name') != '' ? old('head_name') : $datas['head']->name}}" class="form-control" name="head_name">
                            @if ($errors->has('head_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('head_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 {{ $errors->has('head_designation') ? ' has-error' : '' }}">
                            <label>Designation</label>
                            
                            <input type="text" class="form-control" value="{{old('head_designation') != '' ? old('head_designation') : $datas['head']->designation}}" name="head_designation">
                            @if ($errors->has('head_designation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('head_designation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    
                    
                </div>
                <div class="tab-pane" id="tab-contact"  role="tabpanel">
                    <div class="form-group row">
                        <div class="col-md-4 {{ $errors->has('contact_salutation') ? ' has-error' : '' }}">
                            <label >Salutation</label>
                            
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
                        
                        <div class="col-md-4 {{ $errors->has('contact_name') ? ' has-error' : '' }}">
                            <label class="required">Name</label>
                            
                            <input type="text" value="{{old('contact_name') != '' ? old('contact_name') : $datas['contact']->name}}" class="form-control" name="contact_name">
                            @if ($errors->has('contact_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4 {{ $errors->has('contact_designation') ? ' has-error' : '' }}">
                            <label class="required">Designation</label>
                            
                            <input type="text" value="{{old('contact_designation') != '' ? old('contact_designation') : $datas['contact']->designation}}" class="form-control" name="contact_designation">
                            @if ($errors->has('contact_designation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_designation') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-4 {{ $errors->has('contact_phone') ? ' has-error' : '' }}">
                            <label class="required">Phone Number</label>
                            
                            <input type="text" class="form-control" value="{{old('contac_phone') != '' ? old('contac_phone') : $datas['contact']->phone}}" name="contact_phone">
                            @if ($errors->has('contact_phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4 {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                            <label class="required">E-mail</label>
                            
                            <input type="email" class="form-control" value="{{old('contact_email') != '' ? old('contact_email') : $datas['contact']->email}}" name="contact_email">
                            @if ($errors->has('contact_email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('contact_email') }}</strong>
                            </span>
                            @endif
                            
                            
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-address"  role="tabpanel">
                    <div class="form-group row ">
                        <div class="col-md-4 {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="required">Address</label>
                            
                            <input type="text" class="form-control" value="{{old('address') != '' ? old('address') : $datas['address']->address}}" name="address">
                            @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4 {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="required">Phone</label>
                            
                            <input type="text" value="{{old('phone') != '' ? old('phone') : $datas['address']->phone}}" class="form-control" name="phone">
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4 {{ $errors->has('country') ? ' has-error' : '' }}">
                            <label class="required">Country</label>
                            <select class="form-control" name="country">
                            @foreach($datas['countries'] as $countries)
                            @if($datas['address']->country == ucfirst($countries['value']))
                            <option value="{{ucfirst($countries['value'])}}" selected="selected">{{ucfirst($countries['value'])}}</option>
                            @else
                            <option value="{{ucfirst($countries['value'])}}">{{ucfirst($countries['value'])}}</option>
                            @endif
                            @endforeach
                        </select>
                           
                            @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 {{ $errors->has('city') ? ' has-error' : '' }}">
                            <label class="required">City</label>
                            
                            <input type="text" value="{{old('city') != '' ? old('city') : $datas['address']->city}}" class="form-control" name="city">
                            @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-4 {{ $errors->has('billing_address') ? ' has-error' : '' }}">
                            <label class="required">Billing Address</label>
                            
                            <input type="text" value="{{old('billing_address') != '' ? old('billing_address') : $datas['address']->billing_address}}" class="form-control" name="billing_address">
                            @if ($errors->has('billing_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('billing_address') }}</strong>
                            </span>
                            @endif
                            
                        </div>
                        <div class="col-md-4">
                            <label class="">Secondary E-mail</label>
                            
                            <input type="email" class="form-control" value="{{old('secondary_email') != '' ? old('secondary_email') : $datas['address']->secondary_email}}" name="secondary_email">
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label >Fax</label>
                            
                            <input type="text" class="form-control" value="{{old('fax') != '' ? old('fax') : $datas['address']->fax}}" name="fax">
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label>Post Box</label>
                            
                            <input type="text" class="form-control" value="{{old('pobox') != '' ? old('pobox') : $datas['address']->pobox}}" name="pobox">
                            
                            
                        </div>
                        <div class="col-md-4">
                            <label>Website(URL)</label>
                            
                            <input type="url" class="form-control" value="{{old('website') != '' ? old('website') : $datas['address']->website}}" placeholder="https://www.yourdomain.com" name="website">
                            
                        </div>
                    </div>
                    
                    <div class="form-group row ">
                        <div class="col-md-4 {{ $errors->has('billing_policy') ? ' has-error' : '' }}">
                            <input type="checkbox" checked="checked" name="billing_policy" value="1"><label class="ml10 required">I have read and accepted <a href="{{url('billing-policy')}}">Billing Policy</a></label>
                            @if ($errors->has('billing_policy'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('billing_policy') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-facilities"  role="tabpanel">
                    <div class="greenclr bold tb7p">These Facilities are used for Rating...</div>
                    @php ($qi = 1)
                    @foreach($datas['questions'] as $question)
                    <h4 class="facilities_hd btm10m">{{$question['group_title']}}</h4>
                    @if(count($question['questions']) > 0)
                    <div class="form-group row">
                        @foreach($question['questions'] as $ques)
                        <input type="hidden" name="facilities[{{$qi}}][question_id]" value="{{$ques['id']}}">
                        <input type="hidden" name="facilities[{{$qi}}][right_answer]" value="{{$ques['answer']}}">
                        <input type="hidden" name="facilities[{{$qi}}][marks]" value="{{$ques['mark']}}">
                        @if($ques['image'] != 1)
                        <div class="col-md-4 btm10m">
                            <label class="required">{{$ques['title']}}</label>
                            @php ($eanswer = \App\EmployerQuestionAnswer::getAnswer($ques['id']))
                            <select class="form-control" name="facilities[{{$qi}}][answer]">
                                <option value="">Select Option</option>
                                @foreach($ques['answers'] as $list)
                                @if($eanswer == $list)
                                <option selected="selected" value="{{$list}}">{{$list}}</option>
                                @else
                                <option value="{{$list}}">{{$list}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        @else
                        
                        <div class="col-md-4">
                            <label class="required">{{$ques['title']}}</label>
                            
                            @php ($eanswer = \App\EmployerQuestionAnswer::getAnswer($ques['id']))
                            @php ($image = \App\EmployerQuestionAnswer::getImage($ques['id']))
                            <div class="input-group">
                                <select class="form-control" name="facilities[{{$qi}}][answer]">
                                    <option value="">Select Option</option>
                                    @foreach($ques['answers'] as $list)
                                    @if($eanswer == $list)
                                    <option selected="selected" value="{{$list}}">{{$list}}</option>
                                    @else
                                    <option value="{{$list}}">{{$list}}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <span class="button-upload" id="{{$qi}}">@if($image != '')
                                    <a href="" id="image-image{{$qi}}" data-toggle="image" class="img-thumbnail"><img src="{{ asset($image) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                                    @else
                                    <a href="" id="image-image{{$qi}}" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas['placeholder']) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                                    
                                    
                                    @endif
                                    
                                    <input type="hidden" id="input-image{{$qi}}" value="{{\App\EmployerQuestionAnswer::getImageValue($ques['id'])}}" name="facilities[{{$qi}}][infa_image]" class="form-control">  
                                </span>
                            </div>
                        </div>
                        @endif
                        <?php $qi++;?>
                        
                        @endforeach
                    </div>
                    @endif
                    @endforeach
                    
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-sm-9 col-xs-7 col-md-offset-4">
                        <button type="submit" class="btn sendbtn bluebg">
                        Update <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            
        </form>
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
$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
$('#modal-image').remove();
$(this).parents('.note-editor').find('.note-editable').focus();
$.ajax({
url: '{{ url("/employer/filemanager") }}',
dataType: 'html',
beforeSend: function() {
$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
$('#button-image').prop('disabled', true);
},
complete: function() {
$('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
$('#button-image').prop('disabled', false);
},
success: function(html) {
$('body').append('<div id="modal-image" class="modal">' + html + '</div>');
$('#modal-image').modal('show');
}
});
});
// Image Manager
$(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
e.preventDefault();
$('.popover').popover('hide', function() {
$('.popover').remove();
});
var element = this;
$(element).popover({
html: true,
placement: 'right',
trigger: 'manual',
content: function() {
return '<button type="button" id="button-image" class="btn greenbg sendbtn" title="Edit"><i class="fas fa-pencil-alt"></i></button> <button type="button" id="button-clear" class="btn greenbg sendbtn" title="Delete"><i class="far fa-trash-alt"></i></button>';
}
});
$(element).popover('show');
$('#button-image').on('click', function() {
$('#modal-image').remove();
$.ajax({
url: '{{ url("/employer/filemanager") }}' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
dataType: 'html',
beforeSend: function() {
$('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
$('#button-image').prop('disabled', true);
},
complete: function() {
$('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
$('#button-image').prop('disabled', false);
},
success: function(html) {
$('body').append('<div id="modal-image" class="modal" style="display: block; padding-right: 17px;" >' + html + '</div>');
$('#modal-image').modal('show');
}
});
$(element).popover('hide', function() {
$('.popover').remove();
});
});
$('#button-clear').on('click', function() {
$(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
$(element).parent().find('input').attr('value', '');
$(element).popover('hide', function() {
$('.popover').remove();
});
});
});
</script>
@endsection