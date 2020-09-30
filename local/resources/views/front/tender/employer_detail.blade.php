@extends('front.job-master')
@section('header')
<?php if ($datas['banner'] != '') {
$style = "background:url('".$datas['banner']."'); background-attachment: fixed; background-size: cover;";
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
        {{$datas['employer']->name}}
        </h1>
        <div class="borderline"></div>
      </div>
      <div class="tp30p">
        <div class="row">
          <div class="col-md-4 hidden-xs">
            <div class="employer_link">
              <ul>
                @if(!empty($datas['employer']->href))
                <li><a href="{{$datas['employer']->href}}" target="_blank"><i class="fa fa-link"></i> {{$datas['employer']->href}}</a></li>
                @endif
                <li><i class="fa fa-envelope"></i> {{$datas['employer']->email}}</li>
              </ul>
            </div>
          </div>
           <div class="col-md-4 hidden-lg hidden-md">
            <div class="tp30p btm15m mfollowbtn">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas['employer']->id}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
            </div>
          </div>
          <div class="col-md-4 center">
            <div class="employer_logoframe">
              <div class="employer_logo">
                <img src="{{$datas['businesslogo']}}">
              </div>
            </div>
          </div>
          <div class="col-md-4 hidden-xs">
            <div class="tp30p float-right">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas['employer']->id}}')"><i class="fa fa-plus"></i> Follow</a>
              
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
  <div class="container rn_container">
    <div class="employer_intro">
      <p><?php echo $datas['employer']->description ;?></p>
    </div>
  </div>
</section>
<!-- job blocks section started here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="jobs tb35p">
    <div class="container rn_container">
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
<section id="job" class="jobs tb35p">
    <div class="container rn_container">
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
            <div class="col-lg-7 col-md-6">
              TENDER DESCRIPTION
            </div>
            <div class="col-lg-2 col-md-2">
              ESTIMATE COST
            </div>
            <div class="col-lg-2 col-md-2">
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
              <div class="col-lg-1 col-md-2 hidden-lg hidden-md">
                <div class="tender_thumb">
                  <img onclick="viewImage('{{$tender["id"]}}')" src="{{asset($tender['thumb'])}}" style="cursor: pointer;">
                </div>
              </div>
              <div class="col-lg-7 col-md-6">
                <p class="greencolor bold">Tender Code : {{$tender['tender_code']}}</p>
                <p>
                  <a href="{{$tender['employer_url']}}" target="_blank" class="bold"> {{$tender['title']}} </a>
                </p>
                <p>{{$tender['description']}}</p>
                
              </div>
              <div class="col-lg-2 col-md-2">
                <span class="">NRs. {{$tender['estimate_cost']}}</span>
              </div>
              <div class="col-lg-2 col-md-2">
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
            <div class="col-lg-10 col-md-10 col-8">
              @if($tender['tender_location'] != '')
              <span><i class="fa fa-map-marker-alt blueclr"></i> {{$tender['tender_location']}} </span>
              @endif
              <span class="blueclr italic lft10p hidden-xs">{{$tender['category']}}</span>
            </div>
            <div class="col-lg-2 col-md-2 col-4">
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
</section>
<!-- job block section ended here -->
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
<div class="container rn_container">
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
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>
@stop