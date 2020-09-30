@extends('employe_master')
@section('heading')
Mailbox <small>{{\App\InternalMessage::countEmployeeUnreadMessage()}} new messages</small>     
@stop
@section('breadcrubm')
 <li><a href="{{ url('/employee') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>       
  <li class="active">Mailbox</li>
@stop
@section('content')
<section class="content all5p">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Compose</h1>
          </div>
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"></li>
            </ol> -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{route('employee.message.index')}}" class="btn btn-primary btn-block mb-3">Back to Inbox</a>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="color:#fff">Folders</h3>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a href="{{url('/employee/message?&type=1')}}" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">{{\App\EmployeeMessage::getMyUnseenMessage()}}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/employee/message?&type=2')}}" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/employee/message?&type=3')}}" class="nav-link">
                    <i class="far fa-trash-alt"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <!-- /.card -->
        </div>
        <div class="col-md-9">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title" style="color: #fff">Compose New Message</h3>
                </div>
                <form action="{{route('employee.message.save')}}" method="post" enctype='multipart/form-data'>
                {!! csrf_field() !!}
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="message_from" id="message_from" value="{{auth()->guard('employee')->user()->id}}">
                        @if($user != '')
                        <input type="hidden" name="message_to" id="message_to" value="{{$user->id}}">
                        <input class="form-control" placeholder="To:" id="recipient" value="{{$user->firstname.' '.$user->middlename.' '.$user->lastname}}" disabled>
                        @else
                        <input type="hidden" name="message_to" id="message_to" value="{{old('message_to')}}">
                        <input class="form-control" name="recipient" placeholder="To:" id="recipient" value="{{old('recipient')}}">
                        @endif
                        @if ($errors->has('message_to'))
                        <span class="help-block">
                          <strong>{{ $errors->first('message_to') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                    <input class="form-control" name="subject" placeholder="Subject:" value="{{old('subject')}}">
                    </div>
                    <div class="form-group">
                        <textarea id="" name="message" class="form-control" style="height: 300px" placeholder="message here...">{{old('message')}}</textarea>
                        @if ($errors->has('message'))
                        <span class="help-block">
                          <strong>{{ $errors->first('message') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                    <div class="btn btn-default btn-file" style="color: #fff">
                        <i class="fas fa-paperclip"></i> Attachment
                        <!-- <input type="file" name="attachments[]" multiple> -->
                        <input type="file" id="files" name="files[]" multiple><br/>
                        
                        @if ($errors->has('files.0'))
                          <div class="help-block">
                              <ul role="alert"><li>{{ $errors->first('files.0') }}</li></ul>
                          </div>
                        @endif
                    </div>
                    <div id="selectedFiles" class="row p-3"><br></div>
                    <p class="help-block">Max. 2MB each</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
                    </div>
                </div>
                </form>
                </div>
            </div>
        </div>
    </section>
  </div>
</section>  
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
  <script>
    // CKEDITOR.replace('compose_textarea')
  </script>  
  <script>
    $('#recipient').autocomplete({
        source: '{{route("employee.message.getRecipient")}}',
        autoFocus:true,
        minLength: 1,
        select: function(event, ui) {
            var id = ui.item.id
            var value = ui.item.value
            console.log(ui.item)
            $('#message_to').val(id);
            $('#recipient').val(value);
        }
    });
  </script> 
  <script>
	var selDiv = "";
		
	document.addEventListener("DOMContentLoaded", init, false);
	
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
	}
		
	function handleFileSelect(e) {
		
		if(!e.target.files || !window.FileReader) return;
		
		selDiv.innerHTML = "";
		
		var files = e.target.files;
		var filesArr = Array.prototype.slice.call(files);
		filesArr.forEach(function(f) {
			if(!f.type.match("image.*")) {
        console.log(f.type)
				var reader = new FileReader();
			  reader.onload = function (e) {
          if(f.type == 'application/pdf'){
            var image = '{{url("/image/pdf_icon.png")}}'
          }
          else if(f.type == 'application/msword'){
            var image = '{{url("/image/doc.png")}}'
          }
          else if(f.type == 'application/x-zip-compressed'){
            var image = '{{url("/image/zip.png")}}'
          }
          else if(f.type == 'application/x-excel' || f.type == 'application/excel'){
            var image = '{{url("/image/excel.png")}}'
          }
          else if(f.type == 'application/vnd.ms-powerpoint' || f.type == 'application/x-mspowerpoint' || f.type == 'application/powerpoint' || f.type == 'application/mspowerpoint'){
            var image = '{{url("/image/ppt.png")}}'
          }
          else{
            var image = '{{url("/image/dfile.png")}}'
          }
          var html = "<div class='col-md-2 text-center'><img src='"+image+"' width='100px' height='100px'><p class='text-white'>" + f.name + "</p></div>";
          selDiv.innerHTML += html;				
        }
        reader.readAsDataURL(f); 
			}else{
        var reader = new FileReader();
			  reader.onload = function (e) {
          var html = "<div class='col-md-2 text-center'><img src=\"" + e.target.result + "\" width='100px' height='100px'><p class='text-white'>" + f.name + "</p></div>";
          selDiv.innerHTML += html;				
        }
        reader.readAsDataURL(f); 
      }
		});
	}
	</script>
@endsection