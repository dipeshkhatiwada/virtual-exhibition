@extends('front.event-master')
@section('header')
<section class="event_banner innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    @include('front/common/event_header')
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
        <div class="search_background">
          <form class="search_form">
            <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                   <button class="btn searchbtn">Search</button>
                </div>
            </div>
          </form>
        </div>

        <div class="tb20p center">
          <a class="btn bluecomnbtn">LATEST EVENTS</a>
        </div>
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')


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
    <div class="neg_margin greybg tp20p">
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
            <div id="event" class="">
              <div class="container rn_container">

                @foreach($datas['events']->chunk(4) as $events )
                <div class="row cm10-row">
                  @foreach($events as $event)
                  <?php
                   if (is_file(DIR_IMAGE.$event->image)) {
             $image = $event->image;
           } else{
            $image = 'no-image.png';
           }
           ?>
                    <div class="col-md-4 col-lg-3">
                      <div class="event_container whitebg center btm15m">
                        <img src="{{asset(\App\Imagetool::mycrop($image,300,200))}}">
                        <a href="{{url('/events/'.$event->seo_url)}}" >
                          <div class="event_overlay">
                            <h1 class="title_one text-ellipsis">{{$event->title}}</h1>
                            <div class="btm15p">
                              <span class="greencolor"><i class="fa fa-map-marker-alt"></i></span>
                              <p>{{$event->address}}</p>
                            </div>
                            <div class="venue">
                              <span class="venue_icon float-left">
                                <i class="fa fa-landmark"></i>
                              </span>
                              <span class=""><a href="{{url('/events/category/'.\App\EventCategory::getUrl($event->event_category_id))}}" >{{\App\EventCategory::getTitle($event->event_category_id)}}</a></span>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  @endforeach
                </div>
                @endforeach
                <div class="">

              <nav aria-label="Page navigation example">
                <?php echo $datas['events']->render();?>
              </nav>

                </div>
              </div>
            </div>
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
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['bottom_content'] as $bcontent)
            <?php echo $bcontent['module']; ?>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
@stop
