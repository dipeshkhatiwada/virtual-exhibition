@extends('employe_master')
@section('heading')
Sent Messages
            
@stop
@section('breadcrubm')
  <li><a href="{{ url('/employee') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">Sent Messages</li>
@stop
@section('content')
<script src="{{asset('assets/dist/js/checkall.js')}}"></script>

<section class="content all5p">
      <div class="row cm10-row">
        <div class="col-md-2">
          <div class="form_heading bluebg">
            <a href="{{url('employee/messages/compose')}}" class="whiteclr">Compose <span class="fa fa-edit"></span></a>
          </div>
          <div class="box messagelist all15p">
            <div class="box-header with-border">
              <h3 class="title_three btm10p greenclr">Folders</h3>
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
        <!-- /.col -->
        <div class="col-md-10">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="form_heading">Sent Items</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
             <form id="testform" class="dash_forms" method="post" action="{{url('employer/messages/delete')}}">
            <div class="box-body no-padding">
              <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" ><input type="checkbox" name="chkall" onclick="chkAll('id[]',this.checked)">
                </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                 <?php echo $datas->render();?>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
              <div class="table-responsive mailbox-messages">
               
                <table class="table table-hover table-striped">
                  <tbody>
                    @foreach($datas as $message)
                    
                  <tr>
                    <td><input type="checkbox" name="id[]" value="{{$message->id}}"></td>
                    
                    <td class="mailbox-name"><a href="{{url('employee/messages/view/'.$message->id)}}" >{{\App\Employers::getName($message->employers_id)}}</a></td>
                    <td class="mailbox-subject ">{{$message->subject}} </td>
                    
                    <td class="mailbox-date ">{{$message->created_at}}</td>
                  </tr>
                  
                  @endforeach
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  </tbody>
                </table>
            
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>

            <!-- /.box-body -->
            <div class="box-footer no-padding bordertop">
              <div class="mailbox-controls">
                <!-- Check all button -->
                
                <button type="button" class="btn btn-default btn-sm checkbox-toggle" ><input type="checkbox" name="chkall" onclick="chkAll('id[]',this.checked)">
                </button>
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                  </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                 <?php echo $datas->render();?>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
            </form>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>






                            
@endsection