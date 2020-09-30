@extends('front.women-master')
@section('header')

 @include('front/common/women_header')
<!-- header part with navigation ended here -->
@stop

@section('banner')


<!-- banner section with search form ended here -->
@stop

@section('content')
<section  class="tp80p">
@if(count($datas['top_content']) > 0)

    <div id="top_content" class="container ">
        <div class="row">
            <div class="col-md-12">
                @foreach($datas['top_content'] as $tcontent)
                <?php echo $tcontent['module']; ?>
                @endforeach
            </div>
        </div>
    </div>

@endif
<?php if (count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-7 col-12';

} else{
$class = 'col-md-12';
} ?>
<div class="container">
  <div class="row">
            
            <div class="{{$class}}">
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
@if(count($datas['bottom_content']) > 0)

    <div id="bottom_content" class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach($datas['bottom_content'] as $bcontent)
                <?php echo $bcontent['module']; ?>
                @endforeach
            </div>
        </div>
    </div>

@endif
</section>
@stop