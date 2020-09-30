@extends('employer_master')
<style>
 ._hide {
   visibility : hidden;
 }
</style>
@section('content')
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
<script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
      <h3 class="form_heading">New Enroll</h3>
        <div class="form_tabbar">
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
        <ul class="nav nav-tabs form_tab" id="formTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="enroll-tab" data-toggle="tab" href="#mainenroll" role="tab" aria-controls="enroll" aria-selected="true">Enroll</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="booth-tab" data-toggle="tab" href="#booth" role="tab" aria-controls="booth" aria-selected="false">Booth/Stall</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="video-tab" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Video</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="banner-tab" data-toggle="tab" href="#banner" role="tab" aria-controls="banner" aria-selected="false">Banner</a>
            </li>
          {{-- <li class="nav-item">
            <a class="nav-link" id="assistant-tab" data-toggle="tab" href="#assistant" role="tab" aria-controls="assistant" aria-selected="false">Booth Assistant</a>
        </li> --}}
        </ul>
        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="{{route('enroll.addnew')}}">
            @csrf
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="mainenroll" role="tabpanel" aria-labelledby="enroll-tab">
                    <div class="form-group row ">
                        <div class="col-md-6 {{ $errors->has('exhibition_category') ? ' has-error' : '' }} ">
                            <label class="required">Exhibition Category</label>
                            <select class="form-control" name="exhibition_category">
                            @foreach ($categories as $category)
                                <option selected="selected" value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                            </select>
                            @if ($errors->has('exhibition_category'))
                            <span class="help-block">
                                <strong>{{ $errors->first('exhibition_category') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-3 {{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label class="required">Company Name</label>
                            <input class="form-control" name="company_name" title="company_name" id="company_name" placeholder="Company Name">
                            @if ($errors->has('company_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3 {{ $errors->has('seo_url') ? ' has-error' : '' }}">
                            <label class="required">Seo url</label>
                            <input class="form-control" name="seo_url" title="seo_url" id="seo_url" placeholder="seo ulr">
                            @if ($errors->has('seo_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('seo_url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="required">Chat Facility</label>
                            <input type="checkbox" id="chat_facility"  name="chat_facility" value="1">
                        </div>
                        <div class="col-md-2">
                            <label class="required">Video Call Facility</label>
                            <input type="checkbox" id="video_call"  name="video_call" value="1">
                        </div>
                        <div class="col-md-2">
                            <label class="required">Livestream facility</label>
                            <input type="checkbox" id="livestream"  name="livestream" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 {{ $errors->has('company_site') ? ' has-error' : '' }}">
                            <label class="required">Company Website</label>
                            <input class="form-control" name="company_site" title="company_site" placeholder="Company Website">
                            @if ($errors->has('company_site'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company_site') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 {{ $errors->has('company_site') ? ' has-error' : '' }}">
                            <label class="required">Intro Video Link</label>
                            <input class="form-control" name="intro_video" title="intro_video" placeholder="Youtube Link">
                            @if ($errors->has('intro_video'))
                            <span class="help-block">
                                <strong>{{ $errors->first('intro_video') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6 {{ $errors->has('fair_detail') ? ' has-error' : '' }}">
                            <label class="required">Fair Details(.pdf, .doc, .docx)</label>
                            <input type="file" class="form-control" name="fair_detail" id="fair_detail" accept=".pdf, .doc, .docx"/>
                            @if ($errors->has('fair_detail'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fair_detail') }}</strong>
                            </span>
                            @endif

                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-3 {{ $errors->has('event_date') ? ' has-error' : '' }}">
                            <label class="required">Start Date</label>
                            <input type="text"  id="exhibition_date" name="exhibition_date" class="form-control datepicker" value="{{ old('exhibition_date') }}">
                                @if ($errors->has('exhibition_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exhibition_date') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="col-md-3 {{ $errors->has('to_date') ? ' has-error' : '' }}">
                            <label class="required">End Date</label>
                            <input type="text"  id="to_date" name="to_date" class="form-control datepicker" value="{{ old('to_date') }}">
                                @if ($errors->has('to_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('to_date') }}</strong>
                                    </span>
                                @endif
                        </div>

                    </div>

                    {{-- <div class="form-group row {{ $errors->has('banner_image') ? ' has-error' : '' }} ">
                        <div class="col-md-6">
                            <label class="required">Banner File Upload (High Quality)</label>
                            <a href="" id="user-image" data-toggle="image" class="img-thumbnail">
                            <img src="{{ asset($datas['placeholder']) }}" alt="" title="" data-placeholder="{{ asset($datas['placeholder']) }}" /></a>
                            <input type="hidden" name="banner_image" value="" id="banner_image" />

                            @if ($errors->has('banner_image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('banner_image') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> --}}

                    <div class="form-group row ">
                        <div class="col-md-12 {{ $errors->has('description') ? ' has-error' : '' }} ">
                            <label class="">Company Description</label>
                            <textarea id="description" name="description">{{old('description')}}</textarea>
                            @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
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
                <div class="tab-pane fade row" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                    <div class="form-group row ">
                        <div class="col-md-8">
                            <div class="table-responsive-lg">
                                <label class="required">Company Gallery</label>
                                <table class="table table_form table-hover">
                                    <thead>
                                    <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="company_photo">
                                        <tr id="photo_0">
                                        <td><input type="text" name="photo[0][title]" class="form-control" value="{{ old('photo[0][title]') }}"></td>
                                        <td>
                                            <a href="" id="company_image0" data-toggle="image" class="img-thumbnail">
                                            <img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" />
                                            </a>
                                            <input type="hidden" name="photo[0][image]" id="image-thumb0">
                                        </td>
                                        <td><textarea type="text" name="photo[0][description]" id="photo-description"></textarea></td>
                                        <td><button type="button" onclick="$('#photo_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
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
                    </div>
                </div>
                <div class="tab-pane fade row" id="booth" role="tabpanel" aria-labelledby="booth-tab">
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">No. of Booth Required</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Booth/Stall Name</th>
                                        <th class="required">Type</th>
                                        <th class="required">Price</th>
                                        <th><button type="button" name="add" class="btn lightgreen_gradient right add"><i class="fa fa-plus-circle"></i> Add</button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_booth"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade row" id="video" role="tabpanel" aria-labelledby="video-tab">
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">Videos</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Title</th>
                                        <th class="required">Youtube Link</th>
                                        <th><button type="button" name="addVideoLink" class="btn lightgreen_gradient right addVideoLink"><i class="fa fa-plus-circle"></i> Add</button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_video"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade row" id="banner" role="tabpanel" aria-labelledby="banner-tab">
                    <div class="form-group row ">
                        <div class="col-md-8">
                            <div class="table-responsive-lg">
                                <label class="required">Company Banner</label>
                                <table class="table table_form table-hover">
                                    <thead>
                                    <tr>
                                    <th>Banner Title</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="company_banner">
                                        <tr id="banner_0">
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="3"><button type="button" onclick="addBanner();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Banner</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="tab-pane fade row" id="assistant" role="tabpanel" aria-labelledby="assistant-tab">
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">Company Speaker/Booth Assistant</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Assistant Link</th>
                                        <th class="required">Meeting ID</th>
                                        <th class="required">Password</th>
                                        <th><button type="button" name="addZoomDetail" class="btn lightgreen_gradient right addZoomDetail"><i class="fa fa-plus-circle"></i> Add</button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_zoom"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                </div>
            </div>
        </form>
        @if(Session::has('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>{!! session('message') !!}</strong>
        </div>
        @endif
    </div>



<script type="text/javascript">
    $('#company_name').blur(function(){
    var data = $(this).val();
    var se_url = data.replace(/ /g,"-");
    $('#seo_url').val(se_url);
});
</script>
<script>
        $(document).ready(function(){
            var limit_to_add = 5;
            count = 1;
            $(document).on('click', '.addVideoLink', function(){
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="video['+count+'][vtitle]" class="form-control" placeholder="Title of Video" required></td>'
                html += '<td><input type="text" name="video['+count+'][vlink]" class="form-control" placeholder="Youtube/One Drive Link" required></td>';
                html += '<td><button type="button" name="remove_video" class="btn whitegradient remove_video"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';


                $('#tbody_video').append(html);
                count ++;

            });

            $(document).on('click', '.remove_video', function(){

                $(this).closest('tr').remove();

            });
        });

</script>

<script type="text/javascript">
    var photo_row = 1;
    var banner_row = 1;
    function addPhoto()
    {
        var html = '<tr id="photo_'+photo_row+'"><td><input type="text" name="photo['+photo_row+'][title]" class="form-control" value=""></td>';
            html += '<td><a href="" id="company_image'+photo_row+'" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" /></a><input type="hidden" name="photo['+photo_row+'][image]" id="image-thumb'+photo_row+'"></td>';
            html += ' <td><textarea type="text" name="photo['+photo_row+'][description]" id="photo-description"></textarea></td>';
            html += '<td><button type="button" onclick="$(\'#photo_'+photo_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

            $('#company_photo').append(html);
            photo_row++;
    }

    function addBanner()
    {
        var html = '<tr id="banner_'+banner_row+'"><td><input type="text" name="banner['+banner_row+'][title]" class="form-control" value=""></td>';
            html += '<td><a href="" id="company_bannerimage'+banner_row+'" data-toggle="image" class="img-thumbnail"><img src="{{ asset($datas["placeholder"]) }}" alt="" title="" data-placeholder="{{ asset($datas["placeholder"]) }}" /></a><input type="hidden" name="banner['+banner_row+'][image]" id="image-thumb'+banner_row+'"></td>';
            html += '<td><button type="button" onclick="$(\'#banner_'+banner_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

            $('#company_banner').append(html);
            banner_row++;
    }
</script>
{{-- <script>
$(document).ready(function(){
    var limit_to_add = 5;
    count = 1;
    $(document).on('click', '.addZoomDetail', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="zoom['+count+'][zlink]" class="form-control" placeholder="Zoom Link" required></td>';
        html += '<td><input type="text" name="zoom['+count+'][zid]" class="form-control" placeholder="Meeting ID" required></td>';
        html += '<td><input type="password" name="zoom['+count+'][password]"  class="form-control" placeholder="Password" required/></td>';
        html += '<td><button type="button" name="remove_zoom" class="btn whitegradient remove_zoom"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';


        $('#tbody_zoom').append(html);
        count ++;

    });

    $(document).on('click', '.remove_zoom', function(){

        $(this).closest('tr').remove();

    });
});

</script> --}}
<script>
    $(document).ready(function(){

            var count = 0;

            $(document).on('click', '.add', function(){
              count++;
              var html = '';
              html += '<tr>';
              html += '<td><select name="booth_name[]" class="form-control booth_name" data-sub_category_id="'+count+'"><option value="">Select Category</option> @foreach ($booths as $booth)<option value="{{ $booth->id }}">{{ $booth->booth_name }}</option>@endforeach</select></td>';
              html += '<td><select name="booth_type[]" class="form-control booth_type" id="booth_type'+count+'" data-sub_type_id="'+count+'"><option value="">Select Sub Category</option></select></td>';
              html += '<td><input type="text" name="item_price[]" id="item_price'+count+'" class="form-control item_price"/></td>';
              html += '<td><button type="button" name="remove_booth" class="btn whitegradient remove_booth"><i class="fa fa-minus-circle"></i> Remove</button></td>';
              $('#tbody_booth').append(html);
              count++;
            });

            $(document).on('click', '.remove_booth', function(){
                $(this).closest('tr').remove();
                console.log(count);
            });

            $(document).on('change', '.booth_name', function(){
                var category_id = $(this).val();
                var sub_category_id = $(this).data('sub_category_id');
                $('#booth_type'+sub_category_id).find('option').not(':first').remove();

                $.ajax({
                    type: 'get',
                    url: 'get-booth-type/'+category_id,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        var len = 0;
                        if(response['data'] != null){
                            len = response['data'].length;
                        }
                        if(len > 0){
                            // Read data and create <option >
                            for(var i=0; i<len; i++){
                                var id = response['data'][i].id;
                                var ticket_name = response['data'][i].ticket_name;
                                var option = "<option value='"+id+"'>"+ticket_name+"</option>";
                                $('#booth_type'+sub_category_id).append(option);
                            }
                        }

                    },
                });
            });

            $(document).on('change', '.booth_type', function(){
                var type_id = $(this).val();
                var sub_type_id = $(this).data('sub_type_id');

                $.ajax({
                    type: 'GET',
                    url: 'get-booth-price/'+type_id,
                    dataType: 'json',
                    success: function(response){
                        var price = response.data.price;
                        console.log(price);
                        $("#item_price"+sub_type_id).val(price);
                    },
                });
            });
    });
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
            return '<button type="button" id="button-image" class="btn greenbg sendbtn"><i class="fas fa-pencil-alt"></i></button> <button type="button" id="button-clear" class="btn greenbg sendbtn"><i class="far fa-trash-alt"></i></button>';
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
