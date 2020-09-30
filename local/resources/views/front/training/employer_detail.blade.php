@extends('front.event-master')
@section('header')
<section class="innerpage_banner">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    <header class="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-4 mainlogo">
            <div class=""><a href="{{url('/trainings')}}"><img src="{{asset($datas['training_logo'])}}"></a></div>
          </div>
          <div class="col-md-3 col-2 camp_info">
            <div class="float-right tp5p">
              <a><i class="fa fa-map-marker-alt" title="{{$datas['address']}}"></i></a> <span class="hidden-xs">{{$datas['address']}}</span>
            </div>
          </div>
          <div class="col-md-2 col-2 camp_info">
            <div class="float-right tp5p">
              <i class="fa fa-phone-volume"></i> <span class="hidden-xs">{{$datas['phone']}}</span>
            </div>
          </div>
          <div class="col-md-3 col-4">
            <div class="float-right loginbtns tp5p">
              @if(isset(Auth::guard('employer')->user()->name))
              
              <a class="btn bluebtn" href="{{url('/employer/logout')}}"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              @elseif(isset(Auth::guard('employee')->user()->firstname))
              
              <a class="btn bluebtn" href="{{url('/employee/logout')}}"><i class="fa fa-power-off"></i><span class="hidden-xs">Logout</span></a>
              @else
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              @endif
              
            </div>
          </div>
        </div>
      </div>
    </header>
   <div class="tp60p">
      <div class="row">
        <div class="borderline"></div>
        <h1 class="employer_title">
        {{$datas['employer']->name}}
        </h1>
        <div class="borderline"></div>
      </div>
      <div class="tp30p">
        <div class="row">
          <div class="col-md-4">
            <div class="employer_link">
              <ul>
                @if(!empty($datas['employer']->href))
                <li><a href="{{$datas['employer']->href}}" target="_blank"><i class="fa fa-link"></i> {{$datas['employer']->href}}</a></li>
                @endif
                <li><i class="fa fa-envelope"></i> {{$datas['employer']->email}}</li>
              </ul>
            </div>
          </div>
          <div class="col-md-4 center">
            <div class="employer_logoframe">
              <div class="employer_logo">
                <img src="{{$datas['businesslogo']}}">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tp30p float-right">
              @if($datas['followed'] > 0)
              <a class="btn whitebtn"><i class="fa fa-plus"></i> Followed</a>
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
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<section>
  <div class="container">
    <div class="employer_intro">
      <p><?php echo $datas['employer']->description ;?></p>
    </div>
  </div>
</section>
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
          <div class="trainingblock tp20m">
          @if(count($datas['trainings']) > 0)
          @foreach($datas['trainings']->chunk(3) as $trainings )
            <div class="row cm10-row">
              @foreach($trainings as $training)
              <div class="col-md-4">
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
                <div class="alert alert-info">Sorry no any Training found yet. Please visit later</div>
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
@stop