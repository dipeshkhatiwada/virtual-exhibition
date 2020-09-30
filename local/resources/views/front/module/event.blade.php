<section id="event" class="tb60p eventsbg">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p>{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    
    <div class="row cm10-row tb35p">
        @foreach(array_chunk($datas['events'], 4) as $events )
      @foreach($events as $event)
        <div class="col-md-4 col-lg-3">
          <div class="event_container whitebg center btm7m">
            <img src="{{$event['image']}}">
            <a href="{{$event['href']}}" >
              <div class="event_overlay">
                <h1 class="title_one text-ellipsis">{{$event['title']}}</h1>
                <div class="btm15p">
                  <span class="greencolor"><i class="fa fa-map-marker-alt"></i></span>
                  <p>Kathmandu</p>
                </div>
                <div class="venue">
                  <span class="venue_icon float-left">
                    <i class="fa fa-landmark"></i> 
                  </span>
                  <span class=""><a href="{{$event['category_href']}}" >{{$event['category']}}</a></span>
                </div>
              </div>
            </a>
          </div>
        </div>
      @endforeach
      @endforeach
    </div>
    
    <div class="center">
      <a href="{{url('/events')}}"  class="btn browsebtn">Browse all event</a>
    </div>
  </div>
</section>
