@if(count($datas['employer']) > 0)
<div class="white_block btm15m">
                <h3 class="h3 btm15m">{{$datas['title']}}</h3>
                <div class="slider greybg platinum">
                	@foreach($datas['employer'] as $employer)
			<div>
				<center>
					<a href="{{$employer['url']}}" alt="{{$employer['title']}}" title="{{$employer['title'] }}"><img src="{{asset($employer['image'])}}"></a>
				</center>
			</div>
			@endforeach
			
			
		</div>
            </div>
@endif