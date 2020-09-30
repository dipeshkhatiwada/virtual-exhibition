<section id="tender" class="tb60p tenderbg">
  <div class="container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p class="whiteclr">{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row tb35p">
      <div class="col-md-3">
          <div class="white_block">
        <div class="lft_block">
          <h3 class="h3 btm15m">Categories</h3>
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
      </div>
      <div class="col-md-9">
        <div class="list_hd btm7m">
          <div class="row">
            <div class="col-md-7">
              TENDER DESCRIPTION
            </div>
            <div class="col-md-2">
              ESTIMATE COST
            </div>
            <div class="col-md-2">
              <span> DEADLINE </span>
            </div>
            <div class="col-md-1">
              IMAGE
            </div>
          </div>
        </div>
        @foreach($datas['tenders'] as $tender)
        <div class="list_block btm7m">
          <div class="tender_list_body">
            <div class="row">
              <div class="col-md-7">
                <p class="greencolor bold">Tender Code : {{$tender['tender_code']}}</p>
                <p>
                  <a href="{{$tender['employer_url']}}"  class="bold"> {{$tender['employer']}} </a>
                  
                </p>
                <p>{{$tender['title']}}</p>
                
              </div>
              <div class="col-md-2">
                <span class="">NRs. {{$tender['estimate_cost']}}</span>
              </div>
              <div class="col-md-2">
                <p>{{$tender['difference']}}</p>
                <p><span class="blueclr">{{$tender['submission_date']}}</span></p>
              </div>
              <div class="col-md-1">
                <div class="tender_thumb">
                  <img onclick="viewImage('{{$tender["id"]}}')" src="{{asset($tender['thumb'])}}" style="cursor: pointer;">
                </div>
              </div>
            </div>
          </div>
          <div class="tp10p">
            <div class="row">  <!-- Tender Sector eg: Civil Works !-->
            <div class="col-md-10">
              @if($tender['tender_location'] != '')
              <span><i class="fa fa-map-marker-alt blueclr"></i> {{$tender['tender_location']}} </span>
              @endif
              <span class="blueclr italic lft10p">{{$tender['category']}}</span>
            </div>
            <div class="col-md-2">
              <a href="{{$tender['href']}}" class="btn lightgreen_gradient float-right" >View <i class="fa fa-eye"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade servicemodal" id="tender-image{{$tender['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
        <div class="modal-content">              
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <img src="{{$tender['image']}}" style="width: 100%;">
          </div> 
        </div>
      </div>
        
            
          </div>
      @endforeach
     
    </div>
  </div>
  <div class="center">
    <a href="{{url('/tenders')}}" class="btn browsebtn fffbtn" >Browse all Tenders</a>
  </div>
</div>
</section>
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>