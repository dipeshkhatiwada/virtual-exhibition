@extends('front.event-master')
@section('header')
<section class="event_banner innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    @include('front/common/training_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="tb20p center">
        <a class="btn bluecomnbtn">TOP TRAINING</a>
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
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-6';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      @if(count($datas['top_content']) > 0)
      
      <div class="row cm10-row">
        <div class="col-md-12">
          @foreach($datas['top_content'] as $tcontent)
          <?php echo $tcontent['module']; ?>
          @endforeach
        </div>
      </div>
      @endif
      <div class="row cm10-row">
        
        @if (count($datas['left_content']) > 0)
        <aside class="col-lg-3 col-md-4">
          @foreach($datas['left_content'] as $lcontent)
          <?php echo $lcontent['module']; ?>
          @endforeach
        </aside>
        @endif
        <div class="{{$class}}">
          <div class="trainingblock tp20m">
          @if(count($datas['trainings']) > 0)
          @foreach($datas['trainings']->chunk(3) as $trainings )
            <div class="row cm10-row">
              @foreach($trainings as $training)
              <div class="col-lg-4 col-md-6">
                <div class="white_block training">
                  <div class="training_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
                  <h3 class="h3">{{$training->title}}</h3>
                  <div class="border"></div>
                  <p>{{\App\Library\Settings::getLimitedWords($training->description,0,20)}}</p>
                  <div class="training_info">
                    <p><i class="fa fa-map-marker-alt"></i> {{$training->address}}</p>
                    <p><i class="far fa-calendar-alt"></i> {{$training->start_date.' to '.$training->end_date}}</p>
                    <p><i class="fa fa-money-bill-wave"></i> NPR {{$training->price}}</p>
                    <p><i class="fa fa-clock"></i> {{$training->start_time}} - {{$training->end_time}}</p>
                  </div>
                  <div class="tp10p">
                    <a href="{{url('/trainings/'.$training->seo_url)}}" class="morejob">More <i class="fa fa-angle-double-right"></i></a>
                  </div>
                </div>
              </div>
              @endforeach
              </div>
            @endforeach
              @else
              <div class="row cm10-row">
              <div class="col-md-12">
                <div class="alert alert-info">Sorry no any event found yet. Please visit later</div>
              </div>
              </div>
              @endif 
              
              
              
            
            <!-- Pagination started here -->
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['trainings']->render();?>
              </nav>
            </div>
            <!-- pagination ended here -->
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
var url = '{{url("/trainings/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop