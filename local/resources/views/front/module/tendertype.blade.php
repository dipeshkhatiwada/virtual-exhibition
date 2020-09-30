<div class="tb20p">
  <h3 class="h3">  <i class="fa fa-th blueclr"></i> {{$datas['title']}}  </h3>
</div>
 @foreach(array_chunk($datas['tenders'], 3) as $tenders )
<div class="row cm10-row">
  @foreach($tenders as $tender)
  <div class="col-md-4">
    <div class="tender_block center">
      <div class="companylogo"><a href="{{$tender['employer_url']}}" ><img src="{{asset($tender['logo'])}}" class="image_unrotate"></a></div>
      <p class="company_tenders tp20p"><a href="{{$tender['employer_url']}}" >{{$tender['employer']}}</a></p>
      <p class="btm10p"><a href="{{$tender['href']}}" >{{$tender['title']}}</a></p>
      <a class="tender_date"><i class="fa fa-calendar-alt"></i> {{$tender['publish_date']}} - {{$tender['submission_date']}}</a>
      <p class="tp10p bold" >{{$tender['category']}}</p>
      
    </div>
  </div>
  @endforeach
</div>
@endforeach
