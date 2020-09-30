<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Content Management System </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="{{asset('assets/dist/css/font-awesome.css')}}">

    
    <link rel="stylesheet" href="{{asset('assets/dist/css/select.css')}}">
    <!-- Ionicons -->
     <link rel="stylesheet" href="{{asset('assets/dist/css/ionicons.css')}}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/jquery-ui.css')}}">
    
    
    <link rel="stylesheet" href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">
     <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>


<script src="{{asset('assets/dist/js/jquery-ui.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini ">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/admin') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>P</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Marketer</b>Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <!-- User Account: style can fa fa-gears found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <span >{{ Auth::guard('marketer')->user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-footer">
                    <div class="pull-right">
                      <a class="dropdown-item" href="{{ url('/marketer/logout') }}"
                        onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                          Logout
                      </a>
                      <form id="logout-form" action="{{ url('/marketer/logout') }}" method="POST" style="display: none;">
                          {!! csrf_field() !!}
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="{{ url('/marketer') }}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
            </li>
            <li>
              <a href="{{ url('/marketer/profile') }}">
                <i class="fa fa-users"></i> <span>Profile</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/marketer/changepassword') }}">
                <i class="fa fa-users"></i> <span>Change Password</span>
              </a>
            </li>
            <li>
              <a href="{{ url('/marketer/works') }}">
                <i class="fa fa-reorder"></i> <span>Works</span>
              </a>
            </li>
            <li>
              <a href="" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> <span>Logout</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            @yield('heading')
          </h1>
          <ol class="breadcrumb">
            @yield('breadcrubm')
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          @if (Session::has('alert-danger') || Session::has('alert-success'))
          <div class="row">
            <div class="col-xs-12">
              @if (Session::has('alert-danger'))
              <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
              @endif
              @if (Session::has('alert-success'))
              <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
              @endif
            </div>
          </div>
          @endif
          <!-- Default box -->
         @yield('content')
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a target="_blank" href="http://www.purnadangal.com.np">Purna Dangal</a>.</strong> All rights reserved.
      </footer>

      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src=".{{asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/bootstrap-checkbox.min.js')}}" defer></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    <script src="{{asset('assets/dist/js/select.js')}}"></script>
    <script src="{{asset('assets/dist/js/checkall.js')}}"></script>
     <script src="{{asset('assets/dist/js/jquery_form.js')}}"></script>
  </body>
</html>
