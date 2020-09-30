@extends('front.job-master')
@section('header')
<?php if ($datas['banner'] != '') {
$style = "background:url('".$datas['banner']."'); background-attachment: fixed; background-size: 100%;";
} else{
$style = '';
} ?>
<section>
  <div class="innerpage_banner" style="<?php echo $style;?>">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
   @include('front/common/job_header')
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
          <div class="col-lg-4 col-md-4 col-12 hidden-xs">
            <div class="employer_link">
              <ul>
                @if(!empty($datas['employer']->href))
                <li><a href="{{$datas['employer']->href}}" target="_blank"><i class="fa fa-link"></i> {{$datas['employer']->href}}</a></li>
                @endif
                @if($datas['employer']->email != '')
                <li><i class="fa fa-envelope"></i> {{$datas['employer']->email}}</li>
                @endif
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 hidden-lg hidden-md">
            <div class="tp30p btm15m mfollowbtn">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn" onclick="unFollow({{$datas['employer']->id}})"><i class="fa fa-plus"></i> Unfollow</a>
              @elseif(isset(auth()->guard('employee')->user()->id))
              <a class="btn whitebtn" onclick="followEmployer('{{$datas['employer']->id}}')"><i class="fa fa-plus"></i> Follow</a>
              
              @else
              <a class="btn whitebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><i class="fa fa-plus"></i> Follow</a>
              @endif
              
              <a class="btn whitebtn">Followers (<span>{{$datas['total_follower']}}</span>)</a>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 center">
            <div class="employer_logoframe">
              <div class="employer_logo">
                <img src="{{$datas['businesslogo']}}">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 hidden-xs">
            <div class="tp30p float-right">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn" onclick="unFollow({{$datas['employer']->id}})"><i class="fa fa-plus"></i> Unfollow</a>
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
                @foreach($datas['jobs'] as $job)
                <div class="white_block btm5m">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-7">
                            <h3 class="job_post">{{$job['title']}}</h3>
                            <div class="vacancy_code">{{$job['vacancy_code']}}</div>
                            <div class="opening_date">
                                <i class="fas fa-calendar-alt"></i> <span class="bold">Opening Date:</span> {{$job['published_date']}} <span class="bold">To</span>  <span class="greencolor">{{$job['deadline']}}</span>
                                <span class="job_time">
                                    <span class="part_time"><i class="far fa-clock"></i></span> {{$job['job_availability']}}
                                </span>
                                <span class="bold job_time">Job Type:</span> {{$job['job_type']}}
                                @if($job['vacancy_source'] != '')
                                <span class="bold job_time">Source:</span> {{$job['vacancy_source']}}
                                @endif
                                 @if($job['views'] > 0)
                                <span class="bold job_time"><i class="fa fa-eye"></i></span> {{$job['views']}}
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-5">
                            <a href="{{url('jobs/'.$datas['employer']->seo_url.'/'.$job['seo_url'])}}" class="btn applybtn float-right">View Detail</a>
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
function unFollow(emid)
{
var token = $('input[name=\'_token\']').val();
if (emid != '') {
$.ajax({
type: "POST",
url: "{{ url('employee/followemployer') }} ",
data: 'id='+emid+'&_token='+token+'&type=unfollow',
success: function(data){

location.reload();

}
});
}
}
</script>
@stop