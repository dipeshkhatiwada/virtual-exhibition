@extends('front.tender-master')
@section('header')
<section class="rt_banner">
  <div class="container rn_container">
    @include('front/common/tender_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Get Tenders Before</span> <span class="greencolor"> Others Do! </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Road Construction">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      <p>Explore New Business Opportunities & Grow your Business </p>
      <div class="tb20p center">
        <a class="btn bluecomnbtn">ADVANCE SEARCH</a>
      </div>
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')


<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      <div class="tp20p">
        @if(count($datas['top_content']) > 0)

        <div class="row">
          <div class="col-md-12">
            @foreach($datas['top_content'] as $tcontent)
            <?php echo $tcontent['module']; ?>
            @endforeach
          </div>
        </div>
   
@endif
        <div class="row">
          @if (count($datas['left_content']) > 0)
          <aside class="col-md-3">
            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
          </aside>
          @endif
          <div class="{{$class}}">
            <div class="list_hd btm7m hidden-xs">
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
        @if(count($datas['tenders']) > 0)
        @foreach($datas['tenders'] as $tender)
        <div class="list_block btm7m">
          <div class="tender_list_body">
            <div class="row">
              <div class="col-lg-1 col-md-2 hidden-lg hidden-md">
                <div class="tender_thumb">
                  <img onclick="viewImage('{{$tender["id"]}}')" src="{{asset($tender['thumb'])}}" style="cursor: pointer;">
                </div>
              </div>
              <div class="col-lg-7 col-md-6">
                <p class="greencolor bold">Tender Code : {{$tender['tender_code']}}</p>
                <p>
                  <a href="{{$tender['employer_url']}}" target="_blank" class="bold"> {{$tender['employer']}} </a>
                  
                </p>
                <p>{{$tender['title']}}</p>
                
              </div>
              <div class="col-lg-2 col-md-2">
                <span class="">NRs. {{$tender['estimate_cost']}}</span>
              </div>
              <div class="col-lg-2 col-md-2 hidden-xs">
                <p>{{$tender['difference']}}</p>
                <p><span class="blueclr">{{$tender['submission_date']}}</span></p>
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
              <span class="blueclr italic lft10p hidden-xs">{{$tender['category']}}</span>
            </div>
            <div class="col-md-2">
              <a href="{{$tender['href']}}" class="btn lightgreen_gradient float-right">View <i class="fa fa-eye"></i></a>
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
      @else
      <div class="list_block btm7m">
          <div class="tender_list_body">
            <div class="row">
              <div class="col-md-12"><div class="alert alert-info">Sorry, No any tender found yet. Please visit next time</div>
              </div>
            </div>
          </div>
        </div>
        @endif
            @foreach($datas['main_modules'] as $main_module)
            <?php echo $main_module['module']; ?>
            @endforeach
          </div>
          @if (count($datas['right_content']) > 0)
          <aside class="col-md-2">
            @foreach($datas['right_content'] as $rcontent)
            <?php echo $rcontent['module']; ?>
            @endforeach
          </aside>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['bottom_content'] as $bcontent)
            <?php echo $bcontent['module']; ?>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '{{url("/tenders/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop