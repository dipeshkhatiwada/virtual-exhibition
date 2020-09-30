@extends('employer_master')
@section('heading')
Edit Employer 
            <small>Detail of Edit Employer</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/employer') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
           
@stop
@section('content')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Employer</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/employer/updateprofile') }}">
                        <input type="hidden" name="id" value="{{$datas['employer']->id}}">
                        {!! csrf_field() !!}
                        <div class="row">
                         <div class="col-md-10">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-general" data-toggle="tab">General Information</a></li>
                                
                                <li><a href="#tab-head" data-toggle="tab">Organization Head</a></li>
                                <li><a href="#tab-contact" data-toggle="tab">Contact Person</a></li>
                                <li><a href="#tab-address" data-toggle="tab">Organization Address</a></li>
                                <li><a href="#tab-question" data-toggle="tab">Facilities</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-general">

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
                        <div class="form-group{{ $errors->has('seo_url') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Seo Url</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="seo_url" value="{{ $datas['employer']->seo_url }}">

                                @if ($errors->has('seo_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('seo_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('organization_size') ? ' has-error' : '' }}">
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
                        
                        <div class="form-group{{ $errors->has('organization_type') ? ' has-error' : '' }}">
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

                        <div class="form-group{{ $errors->has('ownership') ? ' has-error' : '' }}">
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

                        <div class="form-group{{ $errors->has('member_type') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Member Type</label>
                            <div class="col-md-10">
                                <select name="member_type" id="member_type" class="form-control" >
                                    <?php foreach($datas['member_type'] as $member_type){ 
                                        if($datas['employer']->member_type == $member_type->id) {
                                        ?>
                                        <option selected="selected" value="{{ $member_type->id }}">{{ $member_type->name }} </option>
                                    <?php } else { ?>
                                            <option value="{{ $member_type->id }}">{{ $member_type->name }} </option>
                                    <?php }} ?>
                                </select>
                                @if ($errors->has('member_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('member_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('setting') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label">Setting</label>
                            <div class="col-md-10">
                                <label class="checkbox-inline"> <input type="checkbox" @if($datas['employer']->hide_name == 1) checked="checked" @endif name="hide_name" value="1">Hide Organization Name </label>
                                <label class="checkbox-inline"> <input type="checkbox" name="hide_address" @if($datas['employer']->hide_address == 1) checked="checked" @endif value="1">Hide Organization Address </label>
                                <label class="checkbox-inline"> <input type="checkbox" name="hide_logo" @if($datas['employer']->hide_logo == 1) checked="checked" @endif value="1">Hide Organization Logo </label>
                            </div>
                        </div>



                        <div class="form-group">
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

                        <div class="form-group">
                            <label class="col-md-2 control-label">Profile</label>

                            <div class="col-md-10">
                               <textarea class="form-control" id="profile" name="profile">{{$datas['employer']->profile}}</textarea>
                                <script>
      
       
        CKEDITOR.replace('profile',
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
                        
                         <div class="form-group">
                            <label class="col-md-2 control-label">Image</label>

                            <div class="col-md-10">
                            <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="{{ asset(\App\Imagetool::mycrop($datas['employer']->logo, 120, 100)) }}" alt="" title="" data-placeholder="{{ asset($image) }}" /></a>
                  <input type="hidden" name="image" value="{{$datas['employer']->logo}}" id="input-image" />

                               
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label required">Status</label>
                            <div class="col-md-10">
                                <select name="status" id="status" class="form-control" >
                                    @foreach($datas['status'] as $status)
                                    @if($datas['employer']->status === $status['value'])
                                    <option selected="selected" value="{{$status['value']}}">{{$status['title']}}</option>
                                    @else
                                    <option value="{{$status['value']}}">{{$status['title']}}</option>
                                    @endif
                                    @endforeach
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label ">Approval</label>
                            <div class="col-md-10">
                                <label class="checkbox-inline"><input type="checkbox" @if($datas['employer']->approval === 1) checked="checked" @endif name="approval" value="1">Approval for CV View Detail</label>
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                            <label class="col-md-2 control-label required">Sort Order</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" name="sort_order" value="{{ $datas['employer']->sort_order }}">

                                @if ($errors->has('sort_order'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sort_order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


</div>

                    
                    <div class="tab-pane" id="tab-head">
                        <div class="form-group{{ $errors->has('head_salutation') ? ' has-error' : '' }}">
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
                        <div class="form-group{{ $errors->has('head_name') ? ' has-error' : '' }}">
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
                        <div class="form-group{{ $errors->has('head_designation') ? ' has-error' : '' }}">
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

                     <div class="tab-pane" id="tab-contact">
                        <div class="form-group{{ $errors->has('contact_salutation') ? ' has-error' : '' }}">
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
                        <div class="form-group{{ $errors->has('contact_name') ? ' has-error' : '' }}">
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
                        <div class="form-group{{ $errors->has('contact_designation') ? ' has-error' : '' }}">
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
                        <div class="form-group">
                            <label class="col-md-2 control-label ">Phone Number</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['contact']->phone}}" name="contact_phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">E-mail</label>
                            <div class="col-md-10">
                                <input type="email" class="form-control" value="{{$datas['contact']->email}}" name="contact_email">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab-address">
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
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

                         <div class="form-group">
                            <label class="col-md-2 control-label ">Secondary E-mail</label>

                            <div class="col-md-10">
                                <input type="email" class="form-control" value="{{$datas['address']->secondary_email}}" name="secondary_email">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label ">Fax</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->fax}}" name="fax">

                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label ">Post Box</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->pobox}}" name="pobox">

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">Website</label>

                            <div class="col-md-10">
                                <input type="url" class="form-control" value="{{$datas['address']->website}}" placeholder="https://www.yourdomain.com" name="website">

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">Address</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->address}}" name="address">
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane" id="tab-question">
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
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

                         <div class="form-group">
                            <label class="col-md-2 control-label ">Secondary E-mail</label>

                            <div class="col-md-10">
                                <input type="email" class="form-control" value="{{$datas['address']->secondary_email}}" name="secondary_email">

                                
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-2 control-label ">Fax</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->fax}}" name="fax">

                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label ">Post Box</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->pobox}}" name="pobox">

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">Website</label>

                            <div class="col-md-10">
                                <input type="url" class="form-control" value="{{$datas['address']->website}}" name="website">

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">Address</label>

                            <div class="col-md-10">
                                <input type="text" class="form-control" value="{{$datas['address']->address}}" name="address">

                                
                            </div>
                        </div>

                    </div>
                    </div>
                </div>
                  
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-4">
                                <button type="submit" class="btn sendbtn bluebg">
                                    Save <i class="fa fa-fw fa-save"></i>
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
<script type="text/javascript">
$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
    $('#modal-image').remove();

    $(this).parents('.note-editor').find('.note-editable').focus();

    $.ajax({
      url: '{{ url('/admin/filemanager') }}',
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
        return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
      }
    });

    $(element).popover('show');

    $('#button-image').on('click', function() {
      $('#modal-image').remove();

      $.ajax({
        url: '{{ url('/admin/filemanager') }}' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
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
@endsection