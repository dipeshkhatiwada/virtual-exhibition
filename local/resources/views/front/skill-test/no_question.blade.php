@extends('front.tender-master')
@section('header')
<section class="rt_banner">
  <div class="container rn_container">
    @include('front/common/test_header')
    <div class="">
       <h3 class="tp30p center"><span class="whiteclr">Search Test</span> <span class="greencolor"> With Category </span> </h3>
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


<?php if (count($datas['right_content']) > 0) {
$class = 'col-md-7';
} else{
$class = 'col-md-9';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      
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
          
          <aside class="col-md-3">
            <div class="white_block lft_block tp20m">
              <h3 class="title_three btm10m">Test Categories</h3>
              <ul>
                @foreach($datas['category'] as $category)
                <li><a href="{{$category['url']}}"> {{$category['title']}}</a></li>
                @endforeach
               
              </ul>
            </div>
            @if (count($datas['left_content']) > 0)
            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
             @endif
          </aside>
         
          <div class="{{$class}}">
            <div class="row cm10-row tp30p">
             
            <div class="col-md-12"><div class="alert alert-info">No any Question found on this Test. Please visit next time.</div></div>
            
           
            </div>
            
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
var url = '{{url("/skill-test/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop