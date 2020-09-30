@extends('front.job-master')
@section('header')
@include('front/common/blog_header')
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
<section class="article_banner tp116p btm30p">
<div class="container">
  <div class="row">
  <div class="col-lg-5 col-md-5 col-12">
<h1 class="head-title">{{$datas['article']->title}}</h1>
</div>
    <div class="col-lg-7 col-md-7 col-12">
    <div class="right whiteclr tp10p">
      <span class="sub-title rt10m"><i class="far fa-clock"></i> {{$datas['article']->created_at}}
      </span>
      <span> <i class="far fa-eye"> </i> {{$datas['article']->visit}}</span>
      </div>
    </div>
  </div>
  
</div>
</section>
@stop

@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="section rollingable sports-main tp80p">
  <div class="container ">
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
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-6 col-md-6 col-12 center-panel';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-9 col-12';
} else{
$class = 'col-md-12';
} ?>
<section class="section rollingable sports-main tp80p">
  <div class="container">
    <div class="article_intro">
      <div class="row">
        @if (count($datas['left_content']) > 0)
        <aside class="col-lg-3 col-md-3 col-12">
            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
        </aside>
        @endif
        <div class="{{$class}}">
          @if($datas['image'] != '')
          <div class="main-img pt-2">
            <div class="img-box">
              <img src="{{asset($datas['image'])}}">
              <div class="overlay">  
              </div> 
            </div>
          </div>
          @endif
          <div class="desc btm15m"><?php echo $datas['article']->description;?></div>
            @if($datas['article']->video != '')
            <div class="desc pt-3 btm15m">
              @php($links=str_replace('watch?v=', 'embed/', $datas['article']->video))
              <div class="col-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
                <iframe src="<?php echo $links;?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
              </div>     
            </div>
            @endif
            @foreach($datas['main_modules'] as $main_module)
            <?php echo $main_module['module']; ?>
            @endforeach
          </div>
          @if (count($datas['right_content']) > 0)
          <aside class="col-lg-3 col-md-3 col-12">
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
  <section id="bottom_content" class="tb10p">
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
  @stop