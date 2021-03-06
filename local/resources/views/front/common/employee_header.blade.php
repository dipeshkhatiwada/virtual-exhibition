<header class="inner_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <div class="container">
    <div class="row cm-row">
      <div class="col-md-2 col-3 hidden-xs">
        <div class="mainlogo"><a href="{{url('/')}}"><img src="{{ \App\library\Settings::getLogo() }}"></a></div>
      </div>

      <div class="col-md-7 col-3 hidden-xs">
        <nav class="navbar navbar-expand-sm mainmenu stick-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse mainNav inner_nav" id="navbarNav">
             <ul class="navbar-nav nav-pills">
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
                  <a class="nav-link" href="{{url('/events')}}">Event</a>
                </li>
            </ul>
          </div>
        </nav>
      </div>
      <div class="col-md-2 col-3 hidden-lg hidden-md">
        <div class="mainlogo"><a href="{{url('/')}}"><img src="{{ \App\library\Settings::getLogo() }}"></a></div>
      </div>
      <div class="col-md-3 col-6">
          <div class="float-right loginbtns tp11p">
            @if(isset(Auth::guard('employer')->user()->name))
            <a class="btn ipadloginbtns" href="{{url('/employer/dashboard')}}" target="_blank"><i class="fa fa-th-large"></i><span class="hidden-xs"> Dashboard</span></a>
              <a class="btn ipadloginbtns" href="{{url('/employer/logout')}}"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>

            @elseif(isset(Auth::guard('employee')->user()->firstname))
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
</header>
