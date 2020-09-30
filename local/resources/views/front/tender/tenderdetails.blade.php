@extends('front.tender-master')
@section('header')
<?php if ($datas['employer_banner'] != '') {
$style = "background:url('".$datas['employer_banner']."'); background-attachment: fixed; background-size: cover;";
} else{
$style = ''; 
} ?>
<section class="innerpage_banner" style="<?php echo $style;?>">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    @include('front/common/tender_header')
    <div class="tp115p">
      <div class="row">
        <div class="borderline"></div>
        <h1 class="employer_title">
        {{$datas['employer_name']}}
        </h1>
        <div class="borderline"></div>
      </div>
      <div class="tp30p">
        <div class="row">
          <div class="col-md-4 hidden-xs">
            <div class="employer_link">
              <ul>
                @if(!empty($datas['employer_href']))
                <li><a href="{{$datas['employer_href']}}" target="_blank"><i class="fa fa-link"></i> {{$datas['employer_href']}}</a></li>
                @endif
                <li><i class="fa fa-envelope"></i> {{$datas['employer_email']}}</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 hidden-lg hidden-md">
            <div class="tp30p btm15m mfollowbtn">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas["employer_id"]}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
            </div>
          </div>
          <div class="col-md-4 center">
            <div class="employer_logoframe">
              <div class="employer_logo">
                <img src="{{$datas['employer_logo']}}">
              </div>
            </div>
          </div>
          <div class="col-md-4 hidden-xs">
            <div class="tp30p float-right">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas["employer_id"]}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@stop
@section('banner')
<section>
  <div class="container">
    <div class="employer_intro">
      <p><?php echo $datas['employer_description'] ;?></p>
    </div>
  </div>
</section>
<!-- job blocks section started here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="jobs tb35p">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @foreach($datas['top_content'] as $tcontent)
        <?php echo $tcontent['module']; ?>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif
<!-- job blocks section started here -->
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
<section class="tb35p">
  <div class="container">
    <div class="row">
      @if (count($datas['left_content']) > 0)
      <aside class="col-md-3">
        @foreach($datas['left_content'] as $lcontent)
        <?php echo $lcontent['module']; ?>
        @endforeach
      </aside>
      @endif
      <aside class="{{$class}}">
        <div class="list_hd">  <!-- Tender Description Blue Header!-->
        <p class="lft20m"> General Detail</p>
      </div>
      <div class="general_detail">
        <div class="row">
          <div class="col-md-3">
            <p><span class="blueclr">RT ID :</span> {{$datas['tender']->tender_code}}</p>
            <p><span class="blueclr">Tender Tittle :</span> {{$datas['tender']->title}} </p>
            @if($datas['tender']->emd != '')
            <p><span class="blueclr">EMD :</span> NPR.{{$datas['tender']->emd}}</p>
            @endif
            <p><span class="blueclr">Estimated Cost :</span> Rs. {{$datas['tender']->estimate_cost}}</p>
          </div>
          
          <div class="col-md-4">
            <p><span class="blueclr">Tender Category :</span> {{$datas['tender_type']}} 1</p>
            <p><span class="blueclr">Document Available :</span> {{$datas['tender']->download_start_date}} to {{$datas['tender']->download_end_date}}</p>
            <p class="blueclr"> Bid Submission : {{$datas['tender']->submission_start_date}} to {{$datas['tender']->submission_end_date}} </p>
            <p><span class="blueclr">Pre-Bid Meeting :</span> {{$datas['tender']->pree_bid_meeting == 1 ? "Allow" : "Don't Allow"}}</p>
            
          </div>
          <div class="col-md-5">
            <p><span class="blueclr">Location: </span>{{$datas['tender']->project_location}} </p>
            <p><span class="blueclr">Document Fees : </span>Rs {{$datas['tender']->document_fee}}</p>
            <p><span class="blueclr">Delivery or Completion Period(In Days) : </span>{{$datas['tender']->completion_period}} days</p>
            <p><span class="blueclr">Event for : </span> {{$datas['tender']->event_for == 1 ? "Buy" : "Sell"}}</p>
          </div>
        </div>
        <p><span class="blueclr">Tender Detail:</span></p>
        <div class="white_div"><?php echo $datas['tender']->description; ?>
        </div>
      </div>
      <!-- Tender Bid Submission Blue Header!-->
      <h3 class="list_hd tp10m">Bid Submission</h3>
      
      <div class="general_detail btm10m">
        <div class="row">
         
          <div class="col-md-4">
            <p><span class="blueclr">Bidding Access : </span>{{$datas['tender']->submission_mode == 1 ? 'Closed' : 'Open'}}</p>
          </div>
          <div class="col-md-4">
            <p><span class="blueclr">Published Date : </span>{{$datas['tender']->publish_date}}</p>
          </div>
          <div class="col-md-4">
            <p><span class="blueclr">End Date : </span>{{$datas['tender']->submission_end_date}}</p>
          </div>
        </div>
      </div>

    
      @if($datas['tender']->tender_function < 3 && $datas['tender']->download_start_date <= date('Y-m-d') && $datas['tender']->download_end_date >= date('Y-m-d') && count($datas['tender_documents']) > 0)
      @if($datas['tender']->document_fee < 1)
  <!-- Tender Bid Tender Documents Blue Header!-->
      <h3 class="list_hd tp10m">Tender Documents</h3>

<div class="white_div btm35m">
  @if(isset(Auth::guard('employer')->user()->name))
  
  <div class="row">
    
    
    <div class="col-md-12">
      <p><span class="fonts_id">Documents : </span>
       @foreach($datas['tender_documents'] as $document) 
       <a href="{{url('/image/'.$document->document)}}" target="_blank" download="download" class="btn lightgreen_gradient"> Download {{$document->title}} </a>
        @endforeach</p>
    </div>
    
  </div>
  
  @else
  <div class="row">
    <div class="col-md-12">Please Login to download document <a href="{{url('/employer/login')}}" class="btn btn-primary "> Login </a></div>
  </div>
  @endif
</div>
@endif
@endif
@if(count($datas['tender_items']) > 0)
      
      <h3 class="tb10p title_three">Listing Items</h3>       <!-- Tender Bid Listing Items Blue Header!-->
      <table class="table tender_price">
        <thead class="list_hd">
          <tr>
            <th>Item No.</th>
            <th>Quantity</th>
            <th>Price(Rs)</th>
            <th>Total Price(Rs)</th>
          </tr>
        </thead>
        <tbody>
           @foreach($datas['tender_items'] as $item)
            <tr>
              <td>{{$item->title}}</td>
              <td>{{$item->quantity}}</td>
              <td>Rs. {{$item->perunit}}</td>
              <td>Rs. {{$item->amount}}</td>
            </tr>
           @endforeach
        
        </tbody>
      </table>

@endif

@if($datas['tender']->tender_function == 1)
@if(isset(Auth::guard('employer')->user()->name))
@if(Auth::guard('employer')->user()->employers_id != $datas['tender']->employers_id)
@if($datas['apply_enable'])
<a class="btn btn-sm bluebg applybtn" href="{{url('/employer/tenders/apply/'.$datas['tender']->tender_code)}}">Apply</a>

@else
<span class="greenclr">You already applied for this Tender</span>
@endif
@endif
@else
<span class="greenclr">Please login to Participate on this Tender</span> <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Login</span></button>
@endif
@endif
     



      @foreach($datas['main_modules'] as $main_module)
      <?php echo $main_module['module']; ?>
      @endforeach
    </aside>
    <div class="col-md-2 ">   <!-- start of advertisment !-->
    @foreach($datas['right_content'] as $rcontent)
    <?php echo $rcontent['module']; ?>
    @endforeach
    </div> <!-- end of advertisment !-->
  </div>
</div>
</section>
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @foreach($datas['bottom_content'] as $bcontent)
      <?php echo $bcontent['module']; ?>
      @endforeach
    </div>
  </div>
</div>
</section>
@endif

<script type="text/javascript">
function followEmployer(emid)
{
var token = $('input[name=\'_token\']').val();
if (emid != '') {
$.ajax({
type: "POST",
url: "{{ url('employee/followemployer') }} ",
data: 'id='+emid+'&_token='+token,
success: function(data){
location.reload();
}
});
}
}
</script>
@stop