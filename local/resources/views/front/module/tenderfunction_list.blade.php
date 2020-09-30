<div class="btm10m">
  <h3 class="h3">  <i class="fa fa-th blueclr"></i> {{$datas['title']}}  </h3>
</div>
<div class="btm20m">
<div class="list_hd btm7m hidden-xs">
  <div class="row">
    <div class="col-lg-7 col-md-6">
      TENDER DESCRIPTION
    </div>
    <div class="col-md-2">
      ESTIMATE COST
    </div>
    <div class="col-md-2">
      <span> DEADLINE </span>
    </div>
    <div class="col-lg-1 col-md-2">
      IMAGE
    </div>
  </div>
</div>
@foreach($datas['tenders'] as $tender)
<div class="list_block btm7m">
  <div class="tender_list_body">
    <div class="row">
      <div class="col-md-12  hidden-lg hidden-md">
        <div class="tender_thumb">
          <img onclick="viewImage('{{$tender["id"]}}')" src="{{asset($tender['thumb'])}}" style="cursor: pointer;">
        </div>
      </div>
      <div class="col-lg-7 col-md-6 ">
        <p class="greencolor bold">Tender Code : {{$tender['tender_code']}}</p>
        <p>
          <a href="{{$tender['employer_url']}}"  class="bold"> {{$tender['employer']}} </a>
        </p>
        <p>{{$tender['title']}}</p>
        
      </div>
      <div class="col-md-2 col-6">
        <span class="">NRs. {{$tender['estimate_cost']}}</span>
      </div>
      <div class="col-md-2 col-6">
        <p>{{$tender['difference']}}</p>
        <div class="hidden-xs"><span class="blueclr">{{$tender['submission_date']}}</span></div>
      </div>
      <div class="col-lg-1 col-md-2 hidden-xs">
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
      <div class="hidden-xs"><span class="blueclr italic">{{$tender['category']}}</span></div>
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
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>