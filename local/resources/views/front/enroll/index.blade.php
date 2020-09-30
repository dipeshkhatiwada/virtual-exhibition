@extends('front.enroll-master')
@section('header')
<section class="event_banner innerpage_banner">
    <div class="inner_overlay"></div>
    @include('front/common/enroll_header')
        <div class="container rn_container z-index2">
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


    <?php
        if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
            $class = 'col-md-7';
        } elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
            $class = 'col-md-9';
        }
        elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
            $class = 'col-md-10';
        } else{
            $class = 'col-md-12';
        }
    ?>
<section>
    <div class="container">
        <div class="neg_margin greybg tp20p">
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
                    <div class="container rn_container">

                        @if(count($datas['enroll']) > 0)
                        <div class="row">
                                @foreach($datas['enroll']->chunk(4) as $companies )
                                    @foreach ($companies as $company)
                                        {{-- @if($company->publish_status == 1) --}}
                                            <div class="col-md-4">
                                                <div class="modal-header">
                                                    <h4 class="modal-title center"><strong>{{ $company->company_name}}</strong></h4>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$company->intro_video}}?&theme=dark&autohide=2&modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    @if(auth()->guard('employee')->user())
                                                        <a href="{{route('enroll_companyDetail.homepage', $company->seo_url) }}" class="btn btn-info center" data-dismiss="modal">Enter</a>
                                                    @endif
                                                </div>
                                            </div>
                                        {{-- @endif --}}
                                    @endforeach
                                @endforeach
                        </div>
                        @else
                        <div class="col-md-12">
                            <div class="alert alert-danger donthavemessage">Sorry We can not find Virtual exhibiton List. Please Visit Next Time</div>
                          </div>
                        @endif
                    </div>
                </div>
            <nav aria-label="Page navigation example">
            <?php
                echo $datas['enroll']->render();
            ?>
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
@stop
