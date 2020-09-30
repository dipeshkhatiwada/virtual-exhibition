@extends('employe_master')

@section('content')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>

  <!-- left pannel of accordian menu and service package ended here -->

    <h3 class="form_heading">{{$datas['name']}} Cover Letter</h3>
    <div class="common_bg">
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/coverletter/update') }}">
          <input type="hidden" name="id" value="{{$datas['employee']->id}}">
          {!! csrf_field() !!}
          <?php if ($errors->has('title') || $errors->has('details')) {
           $title = old('title');
            $details = old('details');
            
            $fclass = 'display:block;';
            $hclass = 'display:none;';
          } else {
            $title = $datas['title'];
            $details = $datas['details'];
            $fclass = 'display:none;';
            $hclass = 'display:block;';
          } ?>
          <div id="h_data" style="{{$hclass}}" >
            <div class="col-md-12">
              <a href="javascript:void(0);" onClick="editCover()" class="btn lightgreen_gradient right btm10m"><i class="fa fa-pencil-alt"></i> Edit</a>
            </div>
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td class="tdtitle">Title</td><td>{{$datas['title']}}</td>
                </tr>
                <tr>
                  <td class="tdtitle">Letter</td>
                  <td><?php echo $datas['details'];?></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="cl_form" style="{{$fclass}}"">
            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label required">Job Title</label>
            <div class="col-md-10">
              <input type="text" id="title" class="form-control" name="title" value="{{ $title }}">
              @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </div>
          </div>
          <div class="form-group {{ $errors->has('cover_letter') ? ' has-error' : '' }}">
            <label class="col-md-2 control-label required">Job Title</label>
            <div class="col-md-10">
              <textarea class="form-control" id="details" name="details">{{ $details }}</textarea>
              <script>
                CKEDITOR.replace('details',
                {
                    filebrowserBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html")}}',
                    filebrowserImageBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Images")}}',
                    filebrowserFlashBrowseUrl : '{{ url("assets/ckfinder/ckfinder.html?type=Flash")}}',
                    filebrowserUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")}}',
                    filebrowserImageUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")}}',
                    filebrowserFlashUploadUrl : '{{ url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")}}',
                    enterMode: CKEDITOR.ENTER_BR
                });
              </script>
              @if ($errors->has('cover_letter'))
                <span class="help-block">
                  <strong>{{ $errors->first('cover_letter') }}</strong>
                </span>
              @endif
            </div>
          </div>
         
            <div class="form-group">
             
                <button type="submit" class="btn bluebg sendbtn">
                  Save <i class="fa fa-paper-plane"></i>
                </button>
           
            </div>
          
      </form>
    </div><!-- /.box-body -->
</div>
  <script type="text/javascript">
    function editCover()
    {
      $('#h_data').fadeOut();
      $('#cl_form').fadeIn();
    }
  </script>
@stop()