@extends('front.event-master')
@section('header')
<section class="event_banner">
  
  <div class="container rn_container z-index2">
   @include('front/common/training_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
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
$class = 'col-lg-7 col-md-6 col-sm-12 col-xs-12';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8 col-sm-12 col-xs-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-8 col-sm-12 col-xs-12';
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
        
        @if (count($datas['right_content']) > 0)
        <aside class="col-lg-2 col-md-4 col-sm-12 col-xs-12 hidden-lg hidden-md">
          @foreach($datas['right_content'] as $rcontent)
          <?php echo $rcontent['module']; ?>
          @endforeach
        </aside>
        @endif
        <div class="{{$class}}">
          <div class="trainingblock">
            @if(isset($datas['training']->id))
            @if(!empty($datas['image']))
            <div class="row cm10-row">
              <img src="{{asset($datas['image'])}}" style="width: 100%;">
            </div>
            @endif
             <div class="row cm10-row">
             <div class="tb20p">
              <h2 class="title_two btm7m">{{$datas['training']->title}}</h2>
              <div class="title_three">Description</div>
              <div class="blueborder tp5m"></div>
              <div class="paragraph">
             <?php echo $datas['training']->description;?>
            </div>
             <div class="title_three btm15m">Organizer : <a href="{{url('/trainings/business/'.\App\Employers::getUrl($datas['training']->employers_id))}}" class="blueclr italic">{{\App\Employers::getName($datas['training']->employers_id)}}</a></div>
              
              <div class="title_three btm15m">Training Category : <a href="{{url('/trainings/category/'.\App\TrainingCategory::getUrl($datas['training']->training_category_id))}}" class="blueclr italic">{{\App\TrainingCategory::getTitle($datas['training']->training_category_id)}}</a></div>
              <div class="training_info">
                      <p><i class="fa fa-map-marker-alt"></i> {{$datas['training']->address}}</p>
                      <p><i class="fa fa-landmark"></i> {{$datas['training']->venue}}</p>
                      <p><i class="far fa-calendar-alt"></i> {{$datas['training']->start_date.' to '.$datas['training']->end_date}}</p>
                      <p><i class="fa fa-money-bill-wave"></i> NPR {{$datas['training']->price}}</p>
                      <p><i class="fa fa-clock"></i> {{date("g:iA", strtotime($datas['training']->start_time))}} - {{date("g:iA", strtotime($datas['training']->end_time))}}</p>
                    </div>
              <div class="tp20m">
                 @if(isset(Auth::guard('employee')->user()->firstname))
                <a href="{{url('/employee/training/apply/'.$datas["training"]->seo_url)}}" class="btn lightgreen_gradient">Participate Now</a>
                @else
                <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login to Join this training</a>
                @endif
              
            </div>

           <!--  Bidder list started here -->
            </div>
              </div>
              @if(isset($datas['map']))
               <div class="row cm10-row">
              <div class="col-md-12">
                <?php echo $datas['map']['js']; ?>
                <?php echo $datas['map']['html']; ?>
              </div>
              </div>

              @endif
              @else
               <div class="row cm10-row">
              <div class="col-md-12">
                <div class="alert alert-info">Sorry data not found.</div>
              </div>
              </div>
              @endif
         
              
              
              
            
           
          </div>
          @foreach($datas['main_modules'] as $main_module)
          <?php echo $main_module['module']; ?>
          @endforeach
        </div>
        @if (count($datas['right_content']) > 0)
        <aside class="col-lg-2 col-md-4 col-sm-12 col-xs-12 hidden-xs">
          @foreach($datas['right_content'] as $rcontent)
          <?php echo $rcontent['module']; ?>
          @endforeach
        </aside>
        @endif
        
      </div>
    </div>
  </div>
</section>




 






@if(count($datas['bottom_content']) > 0 || count($datas['related']) > 0)
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        @if(count($datas['related']) > 0)
          @foreach($datas['related']->chunk(3) as $related )
            <div class="row cm10-row">
             <div class="col-md-12 btm15m">
               <div class="title_three">Related Training</div>
             </div>
              @foreach($related as $training)
              <div class="col-md-4">
                <div class="white_block training">
                  <div class="training_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
                  <h3 class="h3">{{$training->title}}</h3>
                  <div class="border"></div>
                  <p>{{\App\Library\Settings::getLimitedWords($training->description,0,20)}}</p>
                  <div class="training_info">
                    <p><i class="fa fa-landmark"></i> {{$training->venue}}</p>
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
             
              @endif 
          @if(count($datas['bottom_content']) > 0)
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['bottom_content'] as $bcontent)
            <?php echo $bcontent['module']; ?>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endif
@stop