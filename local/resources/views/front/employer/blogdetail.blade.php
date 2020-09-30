
@php($cdate = \Carbon\Carbon::parse($data->created_at))
@if(is_file(DIR_IMAGE.$data->image))

<div class="img-box">
								<div class="blogpost_date">
									<p>{{$cdate->day}} <br>{{$cdate->formatLocalized('%b')}}.</p>
									<p class="year brandbgcolor">{{$cdate->year}}</p>
								</div>
								<img src="{{asset(\App\Imagetool::mycrop($data->image,1080,600))}}">
							</div>
@endif					
						<div class="content">
							<h5 class="tp20p"><a class="brandcolor" href="#">{{$data->title}}</a></h5>
							<p>{!! $data->description !!}</p>
							
						</div>
