@if(count($datas['category']) > 0)
<div class="white_block lft_block tp20m">
	<h3 class="title_three btm10m">{{$datas['title']}}</h3>
	<ul>
		@foreach($datas['category'] as $category)
		<li><a href="{{$category['url']}}" >{{$category['title']}} <span>({{$category['total']}})</span></a></li>
		@endforeach
	</ul>
</div>
@endif