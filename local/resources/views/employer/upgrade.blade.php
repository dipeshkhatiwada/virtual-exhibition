
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <h3 class="form_heading">Upgrade Member</h3>

        <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employer/upgraderequest') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-md-3 control-label required">Member Types</label>
                <div class="col-md-9">
                    @foreach($data['member_type'] as $mt)
                        @if($data['type'] == $mt->id)
                        <input type="radio" name="member_type" checked="checked" value="{{$mt->id}}"> {{$mt->name}} 
                            @if($mt->icon != '') 
                            <img src="{{asset('image/'.$mt->icon)}}"> 
                            @endif 
                            <a href="{{url('employer/membertype/'.$mt->id)}}" class="btn greenbg sendbtn" target="_blank">View Detail</a><br>
                            @else
                            <input type="radio" name="member_type"  value="{{$mt->id}}"> {{$mt->name}} 
                            @if($mt->icon != '') 
                            <img src="{{asset('image/'.$mt->icon)}}"> 
                            @endif 
                        <a href="{{url('employer/membertype/'.$mt->id)}}" class="btn greenbg sendbtn" target="_blank">View Detail</a><br>
                        @endif
                    @endforeach
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="form-group">
                <div class="col-md-9 col-md-offset-4">
                    <button type="submit" class="btn sendbtn bluebg">
                        Upgrade <i class="fa fa-paper-plane"></i>
                    </button>
                </div>
                <div style="clear: both;"></div>
            </div>
        </form>                             
</div>
</div>