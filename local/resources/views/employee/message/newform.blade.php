@extends('employe_master')
@section('content')
<script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
<script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
<div class="all5p">
  <div class="row cm10-row">
    <div class="col-md-2">
      <div class="form_heading bluebg">
        <a href="{{url('employee/messages/compose')}}" class="whiteclr">Compose <span class="fa fa-edit"></span></a>
      </div>
      <div class="box messagelist all15p">
        <div class="box-header with-border">
          <div class="box-header with-border">
            <h3 class="title_three btm10p greenclr">Folders</h3>
          </div>
        </div>
        <div class="box-body msgmail">
          <ul>
            <li class="active">
              <a href="{{url('employee/messages')}}"><i class="fa fa-inbox"></i> Inbox
              <span class="label right bluebg tp5m">{{\App\InternalMessage::countEmployeeUnreadMessage()}}</span>
              </a>
            </li>
            <li><a href="{{url('employee/messages/sent')}}"><i class="fa fa-envelope"></i> Sent</a></li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-md-10">
      <h3 class="form_heading">Compose Message</h3>
      
        @if(count($errors))
        <div class="col-xs-12">
          <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
            @endforeach
          </div>
        </div>
        @endif
        <form class="form-horizontal dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="{{ url('/employee/messages/send') }}">
          {!! csrf_field() !!}
          <div class="form-group row cm10-row">
            <div class="col-md-12">
              <label class="required">To</label>
              <input type="text" id="employe" class="form-control" name="employe" value="{{old('employe')}}" >
              <input type="hidden" id="to"  name="to" value="{{old('to')}}">
              @if ($errors->has('to'))
                  <span class="help-block">
                      <strong>{{ $errors->first('to') }}</strong>
                  </span>
              @endif
            </div>
          </div>  
          <div class="form-group row cm10-row">
            <div class="col-md-12">
              <label class="required">Subject</label>
              <input type="text" class="form-control"  id="subject" name="subject" value="{{ old('subject') }}">
              @if ($errors->has('subject'))
                <span class="help-block">
                  <strong>{{ $errors->first('subject') }}</strong>
                </span>
              @endif
            </div>
          </div>    
          <div class="form-group row cm10-row">
            <div class="col-md-12">
              <label class="required">Message</label>
              <textarea id="description" class="form-control" name="description">{{old('description')}}</textarea>
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
              @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
              @endif
            </div>
          </div>       
          <div class="form-group row cm10-row">         
            <div class="col-md-12">
            <button class="btn sendbtn bluebg" type="submit">Send <i class="fa fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
     
    </div>
  </div>
</div>
<?php $today = date('y'); ?>
<script type="text/javascript">
  $('#employe').autocomplete({
    source: '{{ url("employee/messages/autocompleteemployer/") }}',
    minlength:1,
    autoFocus:true,
    select:function(e,ui){
      $('#to').val(ui.item.id);
    }
  });
</script>
@endsection