<div class="topemployer">
    <div class="container">
        <center class="btm15m">
        <h3 class="btm10p blueclr"><span class="fa fa-users"></span> Top Employers</h3>
        
        </center>
        <div class="slider autoplay multipleslider">
             @foreach($datas['employers'] as $employer)
            <div>
                <center>
                    <a href="{{$employer['href'] }}" alt="{{$employer['name'] }}" title="{{$employer['name'] }}"><img src="{{asset($employer['logo'])}}" title="{{$employer['name']}}" alt="{{$employer['name'] }}"></a>
                </center>
            </div>
            @endforeach
           
        </div>
    </div>
</div>


