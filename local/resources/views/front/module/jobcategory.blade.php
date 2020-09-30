<div class="white_block btm15m">
<h3 class="h3 btm15m">{{$datas['title']}}</h3>
<div class="lft_block">
    <ul class="btm15m">
        @foreach($datas['category'] as $category)
        <li><a href="{{$category['url']}}" >{{$category['title']}} <span>({{$category['total']}})</span></a></li>
        @endforeach
    </ul>
    <a href="{{url('jobs/categories')}}" class="morejob" >All Categories <i class="fa fa-long-arrow-alt-right"></i></a>
</div>
</div>
