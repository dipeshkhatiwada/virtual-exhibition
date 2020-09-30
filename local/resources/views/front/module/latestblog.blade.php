@if(count($datas['blogs']) > 0)
<div class="popular">
<h2 class="title_one"><i class="fas fa-chart-line"></i> {{$datas['title']}}</h2>
<div class="news-content blogbg btm15m">
<div class="row">
                    <div class="col-md-12">
                        
                        @foreach($datas['blogs'] as $blog)
                        <div class="border-buttom btm10p">
                        <div class="row cm10-row mt-2">
                            <div class="col-md-3">
                                <div class="img-box">
                                <img src="{{asset($blog['image'])}}">
                                <div class="overlay"></div>
                                </div>
                            </div>
                            <div class="col-md-9 content">
                                <h5><a href="{{$blog['href']}}">{{$blog['title']}}</a></h5>
                                <ul class="sub-title">
                                    <li><i class="far fa-clock"></i> {{$blog['date']}}</li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                       @endforeach
                    </div>
                </div>
                </div>
                </div>
@endif