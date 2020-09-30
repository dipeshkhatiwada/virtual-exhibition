@extends('front.job-master')
@section('header')
<link rel="stylesheet" href="{{asset('css/'.$datas['employer']->color.'.css')}}">
<?php if ($datas['banner'] != '') {
$style = "background:url('".$datas['banner']."'); background-attachment: fixed; background-size: 100%;";
} else{
$style = '';
} ?>
<header class=""><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <div class="container">
    <div class="row cm-row">
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-xs">
        <a href="{{$datas['menu_url']}}"><img src="{{$datas['menu_logo']}}"></a>
      </div>
      <div class="col-lg-7 col-md-7 col-3">
        <nav class="navbar navbar-expand-sm navbar-light mainmenu stick-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
              </span>
          </button>
          <div class="collapse navbar-collapse mainNav inner_nav" id="navbarNav">
            <ul class="navbar-nav nav-pills">
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}">Home</a>
              </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{url('/jobs')}}">Job</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/tenders')}}">Tender</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/projects')}}">Project</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/trainings')}}">Training</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/skill-test')}}">Test</a>
                </li>
                
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/events')}}">Event</a>
                </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-lg hidden-md">
        <a href="{{url('/jobs')}}"><img src="{{\App\library\Settings::getJobLogo()}}"></a>
      </div>
      <div class="col-lg-3 col-md-3 col-6">
        <div class="float-right loginbtns tp11p">
          @if(isset(Auth::guard('employer')->user()->name))
          <a href="{{url('/employer/dashboard')}}" target="_blank" title="{{\App\Employers::getName(Auth::guard('employer')->user()->employers_id)}}"><span class="user-image"><img src="{{asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))}}"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
            <a class="btn ipadloginbtns" href="{{url('/employer/logout')}}" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"><strong> Logout</strong></span></a>
         
          @elseif(isset(Auth::guard('employee')->user()->firstname))
          <a href="{{url('/employee/dashboard')}}" title="Dashboard" target="_blank"><span class="user-image"><img src="{{asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))}}"></span><span class="hidden-md hidden-xs"> <strong>{{\App\Employees::getName(Auth::guard('employee')->user()->id)}}</strong></span></a>
            <a class="btn ipadloginbtns" href="{{url('/employee/logout')}}" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"><strong> Logout</strong></span></a>
          @else
          <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
          <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
          @endif
        </div>
      </div>
      
    </div>
  </div>
</header>



<section class="brand_banner brand_banner2 tp60p" style="<?php echo $style;?>">

  <div class="inner_overlay"></div>
    <div class="container">
    <div class="row">
    <div class="center brandlogo">
      <div class="lefthexa"></div>
      <div class="brand_logo4">
        <img src="{{$datas['businesslogo']}}"  title="{{$datas['employer']->name}}">
      </div>
      <div class="righthexa"></div>
    </div>
  </div>
  <div class="row">
  <h1 class="h1 center" style="z-index:1">{{$datas['employer']->name}}</h1>
</div>
</div> 

<div class="brandmenu4">
      <div class="container">
        <div class="center">
          <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-6 col-md-8 col-4">
              <nav class="navbar navbar-expand-sm brandmenu stick-top">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#brandNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse brandNav" id="brandNav">
                  <ul class="navbar-nav nav-pills">
                    
                  <li class="nav-item">
              <a class="nav-link {{$datas['tab'] == 'job' ? 'active' : ''}}" href="{{$datas['tab'] != 'job' ? url('/'.$datas['employer']->seo_url.'?tab=job') : '#'}}">Job</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'tender' ? 'active' : ''}}" href="{{$datas['tab'] != 'tender' ? url('/'.$datas['employer']->seo_url.'?tab=tender') : '#'}}">Tender</a>
              </li>
            
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'training' ? 'active' : ''}}" href="{{$datas['tab'] != 'training' ? url('/'.$datas['employer']->seo_url.'?tab=training') : '#'}}">Training</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'event' ? 'active' : ''}}" href="{{$datas['tab'] != 'event' ? url('/'.$datas['employer']->seo_url.'?tab=event') : '#'}}">Event</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'about' ? 'active' : ''}}" href="{{$datas['tab'] != 'about' ? url('/'.$datas['employer']->seo_url.'?tab=about') : '#'}}">About Us</a>
              </li>
              <li class="nav-item">
               <a class="nav-link {{$datas['tab'] == 'blog' ? 'active' : ''}}" href="{{$datas['tab'] != 'blog' ? url('/'.$datas['employer']->seo_url.'?tab=blog') : '#'}}">Blogs</a>
              </li>
                  </ul>
                </div>
              </nav>
            </div>
            
            <div class="col-lg-2 col-md-3 col-8">
          <div class="tp10p float-right">
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
            <div class="col-lg-2"></div>
          </div>
        </div>
        
      </div>
    </div> 
    
    
  </section>
  @if(count($datas['notice']) > 0)
<section class="noticeblock4">
  <div class="container">
    <div class="slider noticeplay multipleslider">


      @foreach($datas['notice'] as $notice)
                @php($dt = \Carbon\Carbon::parse($notice->date))
      


      <div>
        <div class="notice4 brandbgcolor">
          <div class="row cm10-row">
            <div class="col-lg-4 col-md-4 col-4">
              <div class="n_date">
                <span class="day bold brandcolor lr10m">{{$dt->day}}</span><br>
                <div class="brandbgcolor whiteclr">{{$dt->formatLocalized('%b')}}, {{$dt->year}}</div>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-8">
             <p onclick="viewNoticeDetail({{$notice->id}})" class="whiteclr" style="cursor: pointer;">{{$notice->title}}</p>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
 @foreach($datas['notice'] as $notice)
      <div class="modal fade servicemodal" id="notice{{$notice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                          <p>{!! $notice->description !!}</p>
                        </div>
                        
                        
                        
                      </div>
                    </div>


                    </div>
            
            @endforeach
@endif
@stop
@section('banner')

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
@php($others = 0)
@if (count($datas['right_content']) > 0 || count($datas['advertise_left']) > 0 || count($datas['notice']) > 0)
@php($others = 1)
@endif
<?php if ($others > 0) {
$class = 'col-lg-9 col-md-9 col-12';
}  else{
$class = 'col-md-12';
} ?>
<section class="tb30p">
    <div class="container">
      <div class="row">
      <div class="{{$class}}">
        {!! $datas['content'] !!}
        @foreach($datas['main_modules'] as $main_module)
                <?php echo $main_module['module']; ?>
                @endforeach
      </div>

        @if (count($datas['right_content']) > 0 || count($datas['advertise_left']) > 0)
            <aside class="col-lg-3 col-md-3 col-12">
              
                @foreach($datas['right_content'] as $rcontent)
                <?php echo $rcontent['module']; ?>
                @endforeach

                @if(count($datas['advertise_left']) > 0)

         <div class="advertisement row cm-row btm7m">
            @foreach($datas['advertise_left'] as $advertise)
            <div class="text-center col-md-12 tb5p ">
                <a href="{{$advertise->href}}" title="{{$advertise->title}}" target="_blank">
                    <img src="{{asset('/image/'.$advertise->image)}}" class="lazy img-fluid" alt="{{$advertise->title}}" style="width: 100% !important;">
                </a>
                </div>
               
            @endforeach 
      </div>
         @endif
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

function viewNoticeDetail(id) {
  $('#notice'+id).modal('show');
}
</script>
@stop
@section('script')
<script type="text/javascript" src="{{asset('js/jquery.easing.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/jquery.easy-ticker.js')}}"></script>

@stop