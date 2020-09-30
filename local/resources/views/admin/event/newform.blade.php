@extends('admin_master')
@section('heading')
New Event
<small>Detail of New Event</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li><a href="{{ url('/admin/project') }}">Events</a></li>
<li class="active">New Event</li>
@stop
@section('content')
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
@if(count($errors))
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
            {{ '* : '.$error }}</br>
            @endforeach
        </div>
    </div>
</div>
@endif
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">New Event</div>
                <div class="panel-body">
                    <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{url('/admin/event/save')}}">
                        
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#mainevent" data-toggle="tab">Event</a></li>
                                    <li><a href="#photo" data-toggle="tab">Images</a></li>
                                    <li><a href="#sponsor" data-toggle="tab">Sponsors</a></li>
                                    
                                    
                                </ul>
                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="mainevent">
                                        <div class="form-group row ">
                                            <div class="col-md-4 {{ $errors->has('employer') ? ' has-error' : '' }}">
                                            <label class="required">Employer</label>
                                                <input type="text" class="form-control" id="emp" name="emp" value="{{ old('emp') }}">
                                                <input type="hidden" name="employer" id="employer" value="{{ old('employer') }}">
                                                @if ($errors->has('employer'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('employer') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                            <div class="col-md-4 {{ $errors->has('event_category') ? ' has-error' : '' }}">
                                                <label class="required">Event Category</label>
                                                <select class="form-control" name="event_category">
                                                    @foreach($datas['category'] as $category)
                                                    @if($category->id == old('event_category'))
                                                    <option selected="selected" value="{{$category->id}}">{{$category->title}}</option>
                                                    @else
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('event_category'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('event_category') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 {{ $errors->has('title') ? ' has-error' : '' }}">
                                                <label class="required">Title</label>
                                                <input type="text" id="title"  name="title" class="form-control" value="{{ old('title') }}">
                                                @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-md-6 {{ $errors->has('seo_url') ? ' has-error' : '' }}">
                                                <label class="required">Seo Url</label>
                                                <input type="text" id="seo_url" name="seo_url" class="form-control"  value="{{old('seo_url')}}">
                                                @if ($errors->has('seo_url'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('seo_url') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 {{ $errors->has('meta_title') ? ' has-error' : '' }}">
                                                <label class="required">Meta Title</label>
                                                <input type="text"  id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                                                @if ($errors->has('meta_title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_title') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 {{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                                                <label class="">Meta Keyword</label>
                                                <input type="text"  id="meta_keyword" name="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}">
                                                @if ($errors->has('meta_keyword'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('meta_keyword') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="">Meta Discription</label>
                                                <textarea class="form-control" name="meta_description">{{ old('meta_description') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 {{ $errors->has('venue') ? ' has-error' : '' }}">
                                                <label class="required">Venue</label>
                                                <input type="text" id="venue"  name="venue" class="form-control" value="{{ old('venue') }}">
                                                @if ($errors->has('venue'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('venue') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label class="required">Address</label>
                                                <input type="text" id="address" name="address" class="form-control"  value="{{old('address')}}">
                                                @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 {{ $errors->has('latitute') ? ' has-error' : '' }}">
                                                <label class="required">Latitude</label>
                                                <input type="text" id="latitute" name="latitute" class="form-control"  value="{{old('latitute')}}">
                                                @if ($errors->has('latitute'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('latitute') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 {{ $errors->has('longitute') ? ' has-error' : '' }}">
                                                <label class="required">Longitude</label>
                                                <input type="text" id="longitute" name="longitute" class="form-control"  value="{{old('longitute')}}">
                                                @if ($errors->has('longitute'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('longitute') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="row"><p class="col-md-12"><center>Please Visit the link : <a href="https://www.latlong.net/" target="_blank" class="greenclr">Click Here</a> to get latitute and longitute</center></p></div>
                                        </div>
                                        
                                        <div class="form-group row ">
                                            <div class="col-md-6 {{ $errors->has('video') ? ' has-error' : '' }}">
                                                <label >Video</label>
                                                <input type="text"  id="video" name="video" class="form-control" value="{{ old('video') }}">
                                                @if ($errors->has('video'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('video') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 {{ $errors->has('event_image') ? ' has-error' : '' }}">
                                                <label class="required">Event Image</label>
                                                <a href="" id="user-image" data-toggle="image" class="img-thumbnail">
                                                <img src="{{ asset($datas['placeholder']) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                                                <input type="hidden" name="event_image" value="" id="input-thumb" />
                                                @if ($errors->has('event_image'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('event_image') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            
                                            <div class="col-md-6 {{ $errors->has('event_date') ? ' has-error' : '' }}">
                                                <label class="required">Start Date</label>
                                                <input type="text"  id="event_date" name="event_date" class="form-control datepicker" value="{{ old('event_date') }}">
                                                @if ($errors->has('event_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('event_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 {{ $errors->has('to_date') ? ' has-error' : '' }}">
                                                <label class="required">End Date</label>
                                                <input type="text"  id="to_date" name="to_date" class="form-control datepicker" value="{{ old('to_date') }}">
                                                @if ($errors->has('to_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('to_date') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            </div
                                            <div class="form-group row ">
                                            <div class="col-md-4 {{ $errors->has('start_time') ? ' has-error' : '' }}">
                                                <label class="required">Start Time</label>
                                                <input type="text"  id="start_time" name="start_time" class="form-control timepicker" value="{{ old('start_time') }}">
                                                @if ($errors->has('start_time'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('start_time') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4 {{ $errors->has('end_time') ? ' has-error' : '' }}">
                                                <label class="required">End Time</label>
                                                <input type="text"  id="end_time" name="end_time" class="form-control timepicker" value="{{ old('end_time') }}">
                                                @if ($errors->has('end_time'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('end_time') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="col-md-4">
                                                <label>Status </label>
                                                <select name="status" class="form-control">
                                                    @foreach($datas['status'] as $status)
                                                    @if(old('status') == $status['value'])
                                                    <option value="{{$status['value']}}" selected="selected">{{$status['title']}}</option>
                                                    
                                                    @else
                                                    <option value="{{$status['value']}}" >{{$status['title']}}</option>
                                                    
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-md-12 ">
                                                <label class="">Event Discription</label>
                                                <textarea id="description" name="description">{{old('description')}}</textarea>
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
                                    <div class="tab-pane" id="photo">
                                        <div class="col-md-12">
                                            <table class="table table_form table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="event_photo">
                                                    <tr id="photo_0">
                                                        <td><input type="text" name="photo[0][title]" class="form-control" value="{{ old('photo[0][title]') }}"></td>
                                                        <td>
                                                            <a href="" id="event_image0" data-toggle="image" class="img-thumbnail">
                                                                <img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" />
                                                            </a>
                                                            <input type="hidden" name="photo[0][image]" id="image-thumb0">
                                                        </td>
                                                        <td><button type="button" onclick="$('#photo_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3"><button type="button" onclick="addPhoto();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Photo</button></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="sponsor">
                                        <div class="col-md-12">
                                            <table class="table table_form table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Logo</th>
                                                        <th>Url</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="event_sponsor">
                                                    <tr id="sponsor_0">
                                                        <td><input type="text" name="sponsor[0][name]" class="form-control" value=""></td>
                                                        <td>
                                                            <a href="" id="sponsorlogo_0" data-toggle="image" class="img-thumbnail">
                                                            <img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" /></a>
                                                            <input type="hidden" name="sponsor[0][logo]" id="sponsor-thumb0">
                                                        </td>
                                                        <td><input type="text" name="sponsor[0][url]" class="form-control"></td>
                                                        <td><button type="button" onclick="$('#sponsor_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4"><button type="button" onclick="addSponsor();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Sponsor</button></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                                    </div>
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
    $('#title').blur(function(){
        var data = $(this).val();
       
        var fleter = data.match(/\b\w/g).join('');

        var se_url = data.replace(/ /g,"-");
       
        $('#seo_url').val(se_url);
        $('#meta_title').val(data);
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
  var photo_row = 1;
  function addPhoto()
  {
    var html = '<tr id="photo_'+photo_row+'"><td><input type="text" name="photo['+photo_row+'][title]" class="form-control" value=""></td>';
        html += '<td><a href="" id="event_image'+photo_row+'" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" /></a><input type="hidden" name="photo['+photo_row+'][image]" id="image-thumb'+photo_row+'"></td>';
        html += '<td><button type="button" onclick="$(\'#photo_'+photo_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#event_photo').append(html);
        photo_row++;
  }

  var sponsor_row = 1;
  function addSponsor()
  {
    var html ='<tr id="sponsor_'+sponsor_row+'"><td><input type="text" name="sponsor['+sponsor_row+'][name]" class="form-control" value=""></td>';
        
        html += '<td><a href="" id="sponsorlogo_'+sponsor_row+'" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" /></a><input type="hidden" name="sponsor['+sponsor_row+'][logo]" id="sponsor-thumb'+sponsor_row+'"></td>';
        html += '<td><input type="text" name="sponsor['+sponsor_row+'][url]" class="form-control"></td>';
        html += '<td><button type="button" onclick="$(\'#sponsor_'+sponsor_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#event_sponsor').append(html);
        sponsor_row++;
  }
</script>

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
$('#emp').autocomplete({
source: '{{ url("/admin/employers/autocomplete/") }}',
minlength:1,
autoFocus:true,
select:function(e,ui){
$('#employer').val(ui.item.id);
}
});
</script>
<script type="text/javascript">
   $(function () {
    $('.timepicker').timepicker({
      
      'timeFormat': 'H:i:s',
    });


});
 </script>
@endsection