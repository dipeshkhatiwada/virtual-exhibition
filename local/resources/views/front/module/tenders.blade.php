<section id="tender" class="tb100p"> 
  <div class="container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p>{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row cm10-row tb35p">
      <div class="col-md-6 col-lg-3">
        <div class="comn_block lft_block">
          <h3 class="h3">Categories</h3>
          <ul>
            @foreach($datas['category'] as $category)
            <li><a href="{{$category['url']}}" >{{$category['title']}} <span>({{$category['total']}})</span></a></li>
            @endforeach
          </ul>
          <div class="tp10p">
          <a href="{{url('/tenders/category')}}" class="morejob" >All Categories <i class="fa fa-plus"></i></a>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        @foreach(array_chunk($datas['tenders'], 3) as $tenders )
        <div class="row">
          @foreach($tenders as $tender)

          <div class="col-md-4">
            <div class="tenderdiv">
              <div class="tenderlogo">
                <a href="{{$tender['employer_url']}}" ><img src="{{asset($tender['logo'])}}"></a>
              </div>
              <div class="tendertitle">
                <a href="{{$tender['employer_url']}}" >{{$tender['employer']}}</a>
              </div>
              <p><a href="{{$tender['href']}}" >{{$tender['title']}}</a></p>
              <a href="{{$tender['href']}}"  class="btn tender_date whitegradient tp5m"><i class="fa fa-calendar-alt"></i> {{$tender['publish_date']}} - {{$tender['submission_date']}}</a>
              <p class="tp10p bold">{{$tender['category']}}</p>
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