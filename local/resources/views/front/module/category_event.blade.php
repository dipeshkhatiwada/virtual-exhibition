@if(count($datas['events']) > 0)
<h1 class="title_one"><span class="greenclr"><i class="fa fa-grip-horizontal"></i></span> {{$datas['title']}}</h1>
 @foreach(array_chunk($datas['events'], 4) as $events )
<div class="row tb20p">
	@foreach($events as $event)
	  	<div class="col-lg-3 col-md-4">
            <div class="event_container center">
                <img src="{{$event['thumb']}}">
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
</div>
@endforeach
@endif
