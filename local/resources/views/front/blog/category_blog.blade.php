@extends('front.women-master')
@section('header')
@include($datas['header'])
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="sports-main tp80p rollingable">
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
<?php if (count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-7 col-12';
} else{
$class = 'col-md-12';
} ?>
<section class="sports-main tp80p rollingable">
  <div class="container rn_container">
  <div class="row">
    <div class="{{$class}}">
      
          <h2 class="cat_title btm10m title_one">{{$datas['title']}}</h2>
        
      @if(count($datas['blogs']) > 0)
      @foreach($datas['blogs']->chunk(4) as $blogs)
      <div class="row sports-inner cm10-row">
        @foreach($blogs as $blog)
        <?php $image = 'images/noimg.png';
                if (is_file(DIR_IMAGE.$blog->image)) {
                    $image = $blog->image;
                }
                 $publish_date = \Carbon\Carbon::parse($blog->created_at);
                ?>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12 btm7m">
          <div class="img-box">
            <img class="card-img-top" src="{{asset(\App\Imagetool::mycrop($image,500,340))}}" alt="Card image cap">
            <div class="overlay"></div>
          </div>
          <div class="newsblock">
            <h5><a href="{{url('/blog/'.$datas['category'].'/'.$blog->seo_url)}}" class="card-title">{{$blog->title}}</a></h5>
            <span class="sub-title"><i class="fa fa-eye"></i> {{$blog->visits}} <i class="far fa-clock"></i> {{$publish_date->toFormattedDateString()}}</span>
              <p class="card-text">{{\App\library\Settings::getLimitedWords($blog->description,0,8)}}</p>
              <p class="text-right"><a href="{{url('/blog/'.$datas['category'].'/'.$blog->seo_url)}}" class="btn btn-readmore">Readmore <i class="fas fa-angle-double-right "></i></a></p>
            </div>
          </div>
          @endforeach
        </div>
        @endforeach
        <div class="row cm10-row sports-content mt-3 btm10m">
        <div class="col-12">
          <div class="dataTables_paginate paging_simple_numbers right">
            <?php echo $datas['blogs']->render();?>
          </div>
        </div>
      </div>
        @else
        <div class="row cm10-row sports-content mt-3">
          <div class="col-12" style="min-height: 200px;">
          <div class="alert-danger">Sorry No any Blog on this category.</div>
        </div>
        </div>
        @endif
        @foreach($datas['main_modules'] as $main_module)
        <?php echo $main_module['module']; ?>
        @endforeach
      </div>
      @if (count($datas['right_content']) > 0)
      <aside class="col-lg-3 col-md-5 col-12">
        @foreach($datas['right_content'] as $rcontent)
        <?php echo $rcontent['module']; ?>
        @endforeach
      </aside>
      @endif
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