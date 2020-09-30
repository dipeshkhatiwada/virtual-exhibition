@extends('employe_master')
@section('content')
{!! csrf_field() !!}
<!-- left pannel of accordian menu and service package ended here -->
<h3 class="form_heading">Friends of {{$datas['employers_name']}}</h3>
<div class="">
  @if(count($datas['classmates']) > 0)
  
  <div class="row cm10-row tp10m">
    @foreach($datas['classmates'] as $friends)
    <div  class="col-md-4 col-sm-6 col-12">
      <div class="circle-mem">
        <div class="row cm10-row">
          <div class="col-lg-8 col-sm-8 col-8">
            <h2 class="title_one tp20m">{{$friends['name']}}</h2>
            <p><i class="fas fa-building"></i> Address: {{$friends['address']}}</p>
            @if($friends['phone'] != '')
            <p><i class="fa fa-mobile"></i> Phone #: {{$friends['phone']}}</p>
            @endif
            @if($friends['email'] != '')
            <p><i class="fa fa-at"></i> Email #: {{$friends['email']}}</p>
            @endif
          </div>
          <div class="col-lg-4 col-sm-4 col-4">
            <img src="{{asset($friends['image'])}}" alt="" class="img-circle img-fluid">
          </div>
        </div>
        <div class="block_footer center">
          @if($friends['circle_request'] == 1)
          @if(\App\UserCircle::checkCircle(auth()->guard('employee')->user()->id,$friends['id']) < 1)
          <button id="add_button{{$friends['id']}}" class="btn t-btn" onclick="addCircle('{{$friends['id']}}')">
            Add Request <i class="fas fa-plus-circle"></i>
          </button>
          @endif
          @endif
          <a href="{{url('projects/bidder_detail/'.$friends['id'])}}" target="_blank" class="btn batchbtn">
            <i class="fas fa-user"></i> View Profile
          </a>

        </div>
      </div>
    </div>
    @endforeach
  </div>
  @endif
</div>
<script type="text/javascript">
  function addCircle(user_id) {
     var token = $('input[name=\'_token\']').val();
       
        if (user_id != '') {
            $.ajax({
                type: 'POST',
                url: '{{url("/employee/add_to_circle")}}',
                data: 'user_id='+user_id+'&_token='+token,
                cache: false,
                success: function(datas){
                 
                    if (datas == 'Success') {
                        $('#add_button'+user_id).html('Request Send').attr("disabled", true);
                    } else{
                        alert(datas);
                    }

                }
            });
        }
  }
</script>

@stop()