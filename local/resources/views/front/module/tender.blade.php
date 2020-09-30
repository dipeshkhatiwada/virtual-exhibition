<section id="tender" class="tb60p"> 
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p>{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row tb35p">
      <div class="col-md-4 col-lg-3">
        <div class="white_block">
           <h3 class="h3 btm15m">Categories</h3>
        <div class="lft_block">
          <ul>
            @foreach($datas['category'] as $category)
            <li><a href="{{$category['url']}}" >{{$category['title']}} <span>({{$category['total']}})</span></a></li>
            @endforeach
          </ul>
          <div class="tp10p">
          <a href="{{url('/tenders/category')}}" class="morejob" >All Categories <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        @foreach(array_chunk($datas['tenders'], 3) as $tenders )
        <div class="row">
          @foreach($tenders as $tender)
          <div class="col-md-6 col-lg-4">
            <div class="tenderdiv">
              <div class="tenderlogo"><a href="{{$tender['employer_url']}}" ><img src="{{asset($tender['logo'])}}"></a></div>
              <div class="tendertitle text-ellipsis"><a href="{{$tender['employer_url']}}" >{{$tender['employer']}}</a></div>
              <p class="text-ellipsis"><a href="{{$tender['href']}}" >{{$tender['title']}}</a></p>
              <a href="{{$tender['href']}}"  class="btn tender_date whitegradient tp5m"><i class="fa fa-calendar-alt"></i> {{$tender['publish_date']}} - {{$tender['submission_date']}}</a>
              <p class="tb10p bold">{{$tender['category']}}</p>
            </div>
          </div>
          @endforeach
        </div>
        @endforeach
    </div>
    </div>
    <div class="center">
      <a href="{{url('/tenders')}}" class="btn browsebtn" >Browse all Tenders</a>
    </div>
  </div>
</section>