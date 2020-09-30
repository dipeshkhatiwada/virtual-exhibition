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
$class = 'col-lg-7 col-md-6';
} else{
$class = 'col-lg-9 col-md-8';
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

<style>
    .active{
        background:#FFF !important;
    }
    
</style>
        <div class="row">
            <div class="col-md-12">
            <div class="alert-success justify">
              Rolling Test is an online based adaptive intellectual test. Based on the given answer of the previous question, the adaptive test gets harder or easier. If the candidate answers a question correctly, then there are chances of getting tougher questions onward, likewise if the candidate answers a question wrong then there are chances of getting easier questions. Mainly the test score depends on correct answer but the weightage will depend on the hardness of question and the answered time. In this way the candidates' intellectuality is tested through this test. It is based on game theory where only answering the question correctly is not enough but answering it in less time and answering the tougher question is also equally important.
            </div>
          </div>
          <aside class="col-lg-3 col-md-4 col-12">
            <div class="white_block lft_block tp20m">
              <h3 class="title_three btm10m">Test Categories</h3>
              <ul>
                  <li class="{{$datas['category_id'] == 0 ? 'active' : ''}}"><a href="{{url('/skill-test')}}"> All</a></li>
                @foreach($datas['category'] as $category)
                <li class="{{$datas['category_id'] == $category['id'] ? 'active' : ''}}"><a href="{{$category['url']}}"> {{$category['title']}}</a></li>
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
            <div class="row cm10-row tp20p">
              @if(count($datas['exams']) > 0)
              @foreach($datas['exams'] as $exam)
              <a href="{{$exam['href']}}" class="col-lg-4 col-md-6">
                <div class="test_block">
                  <div class="row">
                    <div class="col-md-4 col-4">
                      <div class="test_logo">
                        <img src="{{$exam['image']}}">
                      </div>
                    </div>
                    <div class="col-md-8 col-8">
                      <div class="title_three">{{$exam['title']}}</div>
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
            @else
            <div class="col-md-12"><div class="alert alert-info">No any test found on this category. Please visit next time.</div></div>
            @endif
           
            </div>
            <div class="row">
              
              <div class="col-md-12">
                <div class="float-right">
                <nav aria-label="Page navigation example">
                  <?php echo $datas['pagination']->render(); ?>
                </nav>
              </div>
              </div>
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