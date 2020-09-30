@extends('front.job-master')
@section('header')
<?php if ($datas['banner'] != '') {
$style = "background:url('".$datas['banner']."'); background-attachment: fixed; background-size: cover;";
} else{
$style = '';
} ?>
<section class="innerpage_banner" style="<?php echo $style;?>">
  <div class="container">
    <header class="header">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-4 mainlogo">
            <div class=""><a href="{{url('/events')}}"><img src="{{ asset($datas['event_logo']) }}"></a></div>
          </div>
          <div class="col-md-3 col-2 camp_info">
            <div class="float-right tp5p">
              <a><i class="fa fa-map-marker-alt" title="{{ \App\library\Settings::getSettings()->address }}"></i></a> <span class="hidden-xs">{{ \App\library\Settings::getSettings()->address }}</span>
            </div>
          </div>
          <div class="col-md-2 col-2 camp_info">
            <div class="float-right tp5p">
              <i class="fa fa-phone-volume" title="{{ \App\library\Settings::getSettings()->telephone }}"></i> <span class="hidden-xs">{{ \App\library\Settings::getSettings()->telephone }}</span>
            </div>
          </div>
          <div class="col-md-3 col-4">
            <div class="float-right loginbtns tp5p">
              @if(isset(Auth::guard('employer')->user()->name))
              
              <a class="btn bluebtn" href="{{url('/employer/logout')}}"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              @elseif(isset(Auth::guard('employee')->user()->firstname))
              
              <a class="btn bluebtn" href="{{url('/employee/logout')}}"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              @else
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </header>
    <div class="tp60p">
      <div class="row">
        <div class="borderline"></div>
        <h1 class="employer_title">
        {{$datas['employer']->name}}
        </h1>
        <div class="borderline"></div>
      </div>
      <div class="tp30p">
        <div class="row">
          <div class="col-md-4">
            <div class="employer_link">
              <ul>
                @if(!empty($datas['employer']->href))
                <li><a href="{{$datas['employer']->href}}" target="_blank"><i class="fa fa-link"></i> {{$datas['employer']->href}}</a></li>
                @endif
                <li><i class="fa fa-envelope"></i> {{$datas['employer']->email}}</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 center">
            <div class="employer_logoframe">
              <div class="employer_logo">
                <img src="{{$datas['businesslogo']}}">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tp30p float-right">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas["employer_id"]}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
@section('banner')
<section>
  <div class="container">
    <div class="employer_intro">
      <p><?php echo $datas['employer']->description ;?></p>
    </div>
  </div>
</section>
<!-- job blocks section started here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="jobs tb35p">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($datas['top_content'] as $tcontent)
                <?php echo $tcontent['module']; ?>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
<!-- job blocks section started here -->
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
    <div class="container">
      <div class="company_events">
        <div class="row">
            @if (count($datas['left_content']) > 0)
            <aside class="col-md-3">
                @foreach($datas['left_content'] as $lcontent)
                <?php echo $lcontent['module']; ?>
                @endforeach
            </aside>
            @endif
            <div class="{{$class}}">
               
       <h1 class="title_one btm15m">
            <span class="greenclr"><i class="fa fa-grip-horizontal"></i></span> Event Lists
          </h1>
          @if(count($datas['events']) > 0)
           @foreach(array_chunk($datas['events'], 2) as $events )
          <div class="row">
             @foreach($events as $event)       
            <div class="col-md-6">
              <div class="comp_events_block">
                <div class="row cm-row">
                  <div class="col-md-5">
                    <div class="event_image">
                      <img src="{{asset($event['thumb'])}}">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="com_eventinfo">
                      <div class="light_title">{{$event['title']}}</div>
                      <span class="blueborder"></span>
                      <span class="bold">Organizer : </span>
                      <span class="">{{$event['employer']}}</span>
                      <div class="date">
                        <span class="greenclr"><i class="fa fa-calendar-alt"></i></span> {{$event['event_date']}}
                      </div>
                      <div class="company_venue">
                        <span class="company_venue_icon float-left">
                          <i class="fa fa-landmark"></i> 
                        </span>
                        <span class="lft15p">{{$event['venue']}}</span>
                      </div>
                      <a href="{{$event['href']}}" class="btn morebtn tp10m">More <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            
            
          </div>
          @endforeach

          @else
          <div class="row"><div class="col-md-12"><div class="alert alert-info">No any event found yet.</div></div>

          @endif
     
        @foreach($datas['main_modules'] as $main_module)
        <?php echo $main_module['module']; ?>
        @endforeach
    </div>
    @if (count($datas['right_content']) > 0)
    <aside class="col-md-2">
        @foreach($datas['right_content'] as $rcontent)
        <?php echo $rcontent['module']; ?>
        @endforeach
    </aside>
    @endif
</div>
</div>
</div>
</section>
<!-- job block section ended here -->
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
<div class="container">
<div class="row">
    <div class="col-md-12">
        @foreach($datas['bottom_content'] as $bcontent)
        <?php echo $bcontent['module']; ?>
        @endforeach
    </div>
</div>
</div>
</section>
@endif
<script type="text/javascript">
function followEmployer(emid)
{
var token = $('input[name=\'_token\']').val();
if (emid != '') {
$.ajax({
type: "POST",
url: "{{ url('employee/followemployer') }} ",
data: 'id='+emid+'&_token='+token,
success: function(data){
location.reload();
}
});
}
}
</script>
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>
@stop