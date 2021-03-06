<header class="header tb10p showheader">
    <div class="main-menu">
      <div class="container">
        <div class="row cm-row">
          <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-xs">
            <a href="{{url('/events')}}"><img src="{{\App\library\Settings::getEventLogo()}}"></a>
          </div>
          <div class="col-lg-7 col-md-7 col-3">
            <nav class="navbar navbar-expand-sm mainmenu navbar-light stick-top">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse mainNav inner_nav" id="navbarNav">
                    <ul class="navbar-nav nav-pills" id="menu-main-navigation">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/jobs')}}">Job</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('/tenders')}}">Tender</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('/projects')}}">Project</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="{{url('/trainings')}}">Training</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('/skill-test')}}">Test</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link"href="{{ url('/events/enroll') }}">ENROLL</a>
                            <div class="sub-menus">
                                @if($enroll_type)
                                @foreach ($enroll_type as $type)
                                <div class="sub-menu-inner"><a href="#"><strong> {{ $type->title }}</strong></a>
                                    <ul class="sub-menu">
                                        @foreach ($type->categories as $category)
                                            <li class="menu-item"><a href="{{route('enroll_singlepage.show', $category->seo_url) }}">{{ $category->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="{{url('/events')}}">Event</a>
                        </li>

                    </ul>

              </div>
            </nav>
          </div>
          <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-lg hidden-md">
            <a href="{{url('/events')}}"><img src="{{\App\library\Settings::getEventLogo()}}"></a>
          </div>
          <div class="col-md-3 col-6">
            <div class="float-right loginbtns afterlogin tp12p">

              @if(isset(Auth::guard('employee')->user()->firstname))
              <a href="{{url('/employee/dashboard')}}" title="Dashboard" target="_blank"><span class="user-image"><img src="{{asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))}}"></span><span class="hidden-md hidden-xs"> <strong>{{\App\Employees::getName(Auth::guard('employee')->user()->id)}}</strong></span></a>
                <a class="btn ipadloginbtns" href="{{url('/employee/logout')}}" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              @else
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</header>
<style type="text/css">

    .main-menu{
        padding: 20px 0;
    }
    .main-menu ul#menu-main-navigation{
        display: flex;
        justify-content: center;
        list-style: none;
           position: relative;
    }
    .main-menu ul li{
        padding: 0 20px;
    }
    .main-menu ul li a{
        color: #000;
    }
    .main-menu ul li .sub-menus{
        position: absolute;
        left: 0;
        right: 0;
        background-color: #eeeeee;
        display: none;
        z-index: 999;
        padding: 10px 20px;

    }
    .main-menu ul li:hover .sub-menus{
        display: flex;
    }

    .main-menu ul li .sub-menus ul{
        display: block;
        list-style: none;
        padding: 0;
    }

    .main-menu ul li .sub-menus .sub-menu-inner{
        padding: 10px 15px;
        box-sizing: content-box;
    }
</style>
