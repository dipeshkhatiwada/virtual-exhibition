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
<script src="{{asset('assets/dist/js/checkall.js')}}"></script>
<section class="content all5p">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inbox</h1>
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
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{route('employee.message.compose')}}" class="btn btn-primary btn-block mb-3">Compose</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="color:#fff">Folders</h3>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item {{$type==1 ? 'active' : ''}}">
                  <a href="{{url('/employee/message?&type=1')}}" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">{{\App\EmployeeMessage::getMyUnseenMessage()}}</span>
                  </a>
                </li>
                <li class="nav-item {{$type==2 ? 'active' : ''}}">
                  <a href="{{url('/employee/message?&type=2')}}" class="nav-link">
                    <i class="far fa-envelope"></i> Sent
                  </a>
                </li>
                <li class="nav-item {{$type==3 ? 'active' : ''}}">
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
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title" style="color: #fff">Inbox</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fas fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-2">
              <div class="mailbox-controls">
                <!-- Check all button -->
                @if($type != 3)
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" id="deleteBtn"><i class="far fa-trash-alt"></i></button>
                  <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i></button> -->
                </div>
                @endif
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" onclick="reloadPage()"><i class="fas fa-sync-alt"></i></button>
                <div class="float-right" style="color:#fff">
                   {{$messages->firstItem()}} - {{$messages->lastItem()}} / {{$messages->total()}}
                   <?php 
                    $page = $messages->currentPage();
                    $lastPage = $messages->lastPage();
                    if($page == $lastPage && $page == 1){
                      $prevurl = url('/employee/message?type='.request()->get('type').'&page='.$page);
                      $nexturl = url('/employee/message?type='.request()->get('type').'&page='.$page);
                    }elseif($page == $lastPage && $page != 1){
                      $prevurl = url('/employee/message?type='.request()->get('type').'&page='.($page-1));
                      $nexturl = url('/employee/message?type='.request()->get('type').'&page='.$page);
                    }elseif($page != $lastPage && $page == 1){
                      $prevurl = url('/employee/message?type='.request()->get('type').'&page='.$page);
                      $nexturl = url('/employee/message?type='.request()->get('type').'&page='.($page+1));
                    }elseif($page != $lastPage && $page != 1){
                      $prevurl = url('/employee/message?type='.request()->get('type').'&page='.($page-1));
                      $nexturl = url('/employee/message?type='.request()->get('type').'&page='.($page+1));
                    }else{
                      $prevurl = '';
                      $nexturl = '';
                    }
                   ?>
                  <div class="btn-group">
                    <a href="{{$prevurl}}" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></a> &nbsp;
                    <a href="{{$nexturl}}" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></a>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @if(count($messages) > 0)
                  @foreach($messages as $message)
                  <tr @if($message->status == 0 && $message->message_to == auth()->guard('employee')->user()->id) style="background-color:#dedede;" @endif>
                    <td>
                      <div class="icheck-primary">
                        <input type="checkbox" name="message_ids[]" value="{{$message->id}}" id="check1">
                        <label for="check1"></label>
                      </div>
                    </td>
                    
                    <td class="mailbox-name">
                    <a href="{{url('/employee/message/view/'.$message->id.'?type='.$type)}}">
                    @if($type==1)
                    {{$message->employee_from->firstname.' '.$message->employee_from->middlename.' '.$message->employee_from->lastname}}
                    @else
                    {{$message->employee->firstname.' '.$message->employee->middlename.' '.$message->employee->lastname}}
                    @endif
                    </a>
                    </td>
                    <td class="mailbox-subject"><b>{{$message->subject}}</b> - {{str_limit($message->message, 40)}}
                    </td>
                    <td class="mailbox-attachment">
                    @if(count($message->employee_message_attachment) > 0)
                    <i class="fas fa-paperclip"></i>
                    @endif
                    </td>
                    <td class="mailbox-date">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</td>
                  </tr>
                  @endforeach
                  @else 
                  <tr>
                    <td colspan="5" class="text-center">No Messages</td>
                  </tr>
                  @endif
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              <div class="mailbox-controls">
              
                <!-- Check all button -->
                <!-- /.float-right -->
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
</section>   
<script>
    var token = $('input[name=\'_token\']').val();
</script> 
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })
  })
</script>  
<script>
    $(document).ready(function() {
        $("#deleteBtn").click(function(){
            var ids = [];
            $.each($("input[name='message_ids[]']:checked"), function(){
                ids.push($(this).val());
            });
            var url = '{{url("/employee/message/delete?ids=")}}'+ids
            location = url;
        });
    });
</script>      
<script>
  function reloadPage()
  {
    location.reload();
  }
</script>      
@endsection