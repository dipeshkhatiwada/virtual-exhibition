@extends('employe_master')
@section('heading')
Mailbox <small>{{\App\InternalMessage::countEmployeeUnreadMessage()}} new messages</small>     
@stop
@section('breadcrubm')
 <li><a href="{{ url('/employee') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>       
  <li class="active">Mailbox</li>
@stop
@section('content')
<style>
  .active{
    background-color: #046d8a;
  }
</style>
<section class="content all5p">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Read Message</h1>
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
                <li class="nav-item {{request()->get('type') == 1 ? 'active' : ''}}">
                  <a href="{{url('/employee/message?&type=1')}}" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">{{\App\EmployeeMessage::getMyUnseenMessage()}}</span>
                  </a>
                </li>
                <li class="nav-item {{request()->get('type') == 2 ? 'active' : ''}}">
                  <a href="{{url('/employee/message?&type=2')}}" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item {{request()->get('type') == 3 ? 'active' : ''}}">
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
              <h3 class="card-title text-white">Read Mail</h3>
              <!-- <div class="card-tools">
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
              </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
              <div class="mailbox-read-info text-white">
                <h5>Subject: {{$message->subject}}</h5>
                <h6>From: {{$message->employee_from->firstname.' '.$message->employee_from->middlename.' '.$message->employee_from->lastname}}</h6>
                <h6>To: {{$message->employee->firstname.' '.$message->employee->middlename.' '.$message->employee->lastname}}</h6>
                  <span class="mailbox-read-time float-right" style="color:grey">{{\Carbon\Carbon::parse($message->created_at)->format('d M. Y H:i a')}}</span></h6>
              </div>
              <!-- /.mailbox-read-info -->
              <!-- <div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="far fa-trash-alt"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fas fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fas fa-share"></i></button>
                </div>
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fas fa-print"></i></button>
              </div> -->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{!! $message->message !!}</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer bg-white">
            @if(count($message->employee_message_attachment) > 0)
              <label for="">Attachments:</label>
              <div class="mailbox-attachments d-flex align-items-stretch clearfix row">
                @foreach($message->employee_message_attachment as $attachment)
                  <div class="col-md-2 text-center">
                  @if($attachment->file_type=='png' || $attachment->file_type=='jpg' || $attachment->file_type=='jpeg' || $attachment->file_type=='gif')
                    <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/'.$attachment->file_path)}}" width="100px" height="100px" >{{$attachment->file_name}}</a>
                  @elseif($attachment->file_type=='pdf')
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/pdf_icon.png')}}" width="100px" height="100px">{{$attachment->file_name}}</a>
                  @elseif($attachment->file_type=='zip')
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/zip.png')}}" width="100px" height="100px">{{$attachment->file_name}}</a>
                  @elseif($attachment->file_type=='xlsx' || $attachment->file_type=='xls')
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/excel.png')}}" width="100px" height="100px">{{$attachment->file_name}}</a>
                  @elseif($attachment->file_type=='doc' || $attachment->file_type=='docx')
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/doc.png')}}" width="100px" height="100px">{{$attachment->file_name}}</a>
                  @elseif($attachment->file_type=='pptx' || $attachment->file_type=='ppt')
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/ppt.png')}}" width="100px" height="100px">{{$attachment->file_name}}</a>
                  @else
                  <a href="{{asset('/image/'.$attachment->file_path)}}" target="_blank"><img src="{{asset('/image/file.png')}}" width="100px" height="100px" target="_blank">{{$attachment->file_name}}</a>
                  @endif
                  </div>
                @endforeach
              </div>
            @else
            <p class="text-center">No Attachment</p>
            @endif
            </div>
            <!-- /.card-footer -->
            @if(request()->get('type') != 3)
            <div class="card-footer">
              <div class="float-right">
              @if($message->message_to == auth()->guard('employee')->user()->id)
                <a href="{{url('/employee/message/compose?id='.$message->id.'&replyto='.$message->message_from)}}" class="btn btn-default"><i class="fas fa-reply"></i> Reply</a>
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button> -->
                @endif
              </div>
              <form action="{{route('employee.message.delete')}}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <input type="hidden" name="ids" value="{{$message->id}}">
                <button type="submit" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
              </form>
              <!-- <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button> -->
            </div>
            @endif
            <!-- /.card-footer -->
          </div>
        </div>
    </section>
  </div>
</section>            
@endsection