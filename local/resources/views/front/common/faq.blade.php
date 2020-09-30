@extends('front.job-master')
@section('header')
<section class="event_banner innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    @include('front/common/event_header')
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
        <div class="search_background">
          <form class="search_form">
            <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                   <button class="btn searchbtn">Search</button>
                </div>
            </div>
          </form>
        </div>
          
        <div class="tb20p center">
          <a class="btn bluecomnbtn">LATEST EVENTS</a>
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
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
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
          <aside class="col-md-3">
            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
          </aside>
          @endif
          <div class="{{$class}}">
            <div id="event" class="">
              <div class="container rn_container">
                @if(count($datas['faqs']) > 0)
                
               <div id="accordion">
                @foreach($datas['faqs'] as $faq)
                <div class="list_hd btm7m tp15m hidden-xs">
                  
                    <div class="col-lg-12 col-md-12 col-12">
                      {{$faq['title']}}
                    </div>
                    
                   
                  
                  
                </div>
                @foreach($faq['questions'] as $question)
                <div class="card faq-card">
                  <div class="card-header" id="heading{{$question->id}}">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$question->id}}" aria-expanded="true" aria-controls="collapse{{$question->id}}">
                        {!! $question->question !!}
                      </button>
                    </h5>
                  </div>

                  <div id="collapse{{$question->id}}" class="collapse" aria-labelledby="heading{{$question->id}}" data-parent="#accordion">
                    <div class="card-body">
                      {!! $question->answer !!}
                    </div>
                  </div>
                </div>
                @endforeach
                @endforeach
                </div>
                @endif
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
@stop