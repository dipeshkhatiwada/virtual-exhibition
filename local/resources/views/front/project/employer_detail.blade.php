@extends('front.job-master')
@section('header')
@include('front/common/project_header')
@stop
@section('banner')
<?php if ($datas['banner'] != '') {
$style = "background:url('" . asset('image/'.$datas["banner"])."'); background-size: cover; ";
}
else{
$style = "";
}
?>
<section class="innerpage_banner tb60p" style="{{$style}}" >
    <div class="banner_overlay">
    <div class="container">
        <div class="row">
            <div class="borderline"></div>
            <h1 class="employer_title">
            {{$datas['employer']->name}}
            </h1>
            <div class="borderline"></div>
        </div>
        <div class="tp30p">
            <div class="row">
                <div class="col-md-4">
                    <div class="employer_link">
                        <ul>
                            @if(!empty($datas['employer']->href))
                            <li><a href="#"><i class="fa fa-link"></i> {{$datas['employer']->href}}</a></li>
                            @endif
                            @if(!empty($datas['employer']->email))
                            <li><i class="fa fa-envelope"></i> {{$datas['employer']->email}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 center">
                    <div class="employer_logoframe">
                        <div class="employer_logo">
                            <img src="{{$datas['businesslogo']}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="tp30p float-right">
                        @if($datas['followed'] > 0)
                        <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
                        @elseif(isset(auth()->guard('employee')->user()->id))
                        <a class="btn whitebtn" onclick="followEmployer('{{$datas["employer"]->id}}')"><i class="fa fa-plus"></i> Follow</a>
                        
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
<!-- banner section with search form ended here -->
<section>
    <div class="container">
        <div class="employer_intro">
            <p><?php echo $datas['employer']->description; ?></p>
        </div>
    </div>
</section>
<!-- employer description section ended here -->
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
<section id="job" class="jobs tb35p">
    <div class="container">
        <div class="row">
            @if (count($datas['left_content']) > 0)
            <aside class="col-md-3">
                @foreach($datas['left_content'] as $lcontent)
                <?php echo $lcontent['module']; ?>
                @endforeach
            </aside>
            @endif
            <div class="{{$class}}">
                <div class="row description_tend btm15m">  <!-- Tender Description Blue Header!-->
                <div class="col-md-8">
                    TENDER DESCRIPTION
                </div>
                <div class="col-md-2">
                    VALUE
                </div>
                <div class="col-md-2">
                    <span class="float-right"> DEADLINE </span>
                </div>
            </div>
            @foreach($datas['tenders'] as $tender)
            <div class="descript_tend">
                <div class="row">
                    <div class="col-md-9">
                        <p class="greencolor rt-id ">TENDER CODE : {{$tender['code']}} </p>
                    </div>
                    <div class="col-md-3">
                        <p class="blueclr italic float-right ">
                            {{$tender['category']}}
                        </p>
                    </div>
                </div>
                <div class="row  btm15m">  <!-- Tender Sector eg: Civil Works !-->
                <div class="col-md-8">
                    <p> <span class="text_bold"> {{$tender['title']}} </span></p>
                    <p class="p_normal">{{$tender['description']}}</p>
                </div>
                <div class="col-md-2">
                    <span class="text_regular14 ">{{$tender['cost'] != '0.00' ? 'NRs. '.$tender['cost'] : ''}}</span>
                </div>
                <div class="col-md-2">
                    <p><span class="text_regular14 lb10m float-right">{{$tender['rem_days'] + 1}} Days to go</span></p>
                    <p><span class="txt_lgt_reg14 blueclr  float-right">{{$tender['submission_date']}}</span></p>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-2">
                </div>
                <div class="white_border"></div>
                <div class="col-md-10">
                    <i class="fa fa-map-marker-alt blueclr tprgt5m"></i>{{$tender['project_location']}}
                </div>
                <div class="col-md-2">
                    <a href="{{$tender['href']}}" class="btn btn-sm float-right view_button">View<i class="fa fa-eye lft10m"></i></a>
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