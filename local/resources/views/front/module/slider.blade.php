@if(count($datas['blogs']) > 0)

<div id="rwslider" class="carousel slide btm7m" data-ride="carousel">
							<ol class="carousel-indicators">
								@foreach($datas['blogs'] as $key => $blog)
								<li data-target="#rwslider" data-slide-to="{{$key}}" class=""></li>
								@endforeach
							</ol>
							<div class="carousel-inner" role="listbox">
								@foreach($datas['blogs'] as $key => $blog)
								<div class="carousel-item carousel-item-next ">
									<img class="first-slide" src="{{asset($blog['image'])}}" alt="First slide">
								<div class="carousel-caption d-none d-md-block">
									<h2 class="wow fadeInDown btm10m">{{$blog['title']}}</h2>
									<a class="btn lightgreen_gradient lr15p" href="{{$blog['href']}}" role="button">Readmore <i class="far fa-arrow-alt-circle-right"></i></a>
								</div>
								</div>
								@endforeach
							</div>
							<a class="carousel-control-prev" href="#rwslider" role="button" data-slide="prev">
								<div class="arrow-left">
									<span class="carousel-control-prev-icon " aria-hidden="true"></span>
								</div>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#rwslider" role="button" data-slide="next">
								<div class="arrow-right">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								</div>
								<span class="sr-only">Next</span>
							</a>
					</div>

@endif
		