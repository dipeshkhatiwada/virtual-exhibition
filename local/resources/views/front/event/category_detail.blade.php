@extends('front.job-master')
@section('header')
<section class="innerpage_banner">
  <div class="container">
    @include('front/common/event_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="tb20p center">
        <a class="btn bluecomnbtn">{{strtoupper($datas['category']->title)}} EVENTS</a>
      </div>
    </div>
  </div>
</section>
@stop
@section('banner')
@stop
@section('content')
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
    <div class="white_div neg_margin">
      @if(count($datas['top_content']) > 0)
      
      <div class="row cm10-row">
        <div class="col-md-12">
          @foreach($datas['top_content'] as $tcontent)
          <?php echo $tcontent['module']; ?>
          @endforeach
        </div>
      </div>
      @endif
      <div class="row cm10-row">
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
          <div class="row"><div class="col-md-12">
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['event_render']->render(); ?>
              </nav>
            </div>
          </div></div>
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
<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '{{url("/events/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop