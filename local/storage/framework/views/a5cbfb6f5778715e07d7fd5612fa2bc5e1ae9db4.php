<!DOCTYPE html>
<html>
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Content Management System </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/bootstrap/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/font-awesome.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/select.css')); ?>">
    <!-- Ionicons -->
     <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/ionicons.css')); ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
     <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/timepicker/jquery.timepicker.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/skins/_all-skins.min.css')); ?>">
     <script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
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
        <a href="<?php echo e(url('/admin')); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>P</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>Panel</span>
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

                  <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                </a>
                <ul class="dropdown-menu">

                  <li class="user-footer">

                    <div class="pull-right">
                      <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="get" style="display: none;">
                                       <?php echo csrf_field(); ?>

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
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo e(url('/admin')); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>

            </li>
            <li>
              <a href="<?php echo e(url('/admin/invoice')); ?>">
                <i class="fa fa-files-o" aria-hidden="true"></i> <span>Invoice</span>
              </a>
            </li>













             <li class="treeview">
              <a href="#">
                <i class="fa fa-graduation-cap"></i>
                <span>Trainings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(url('/admin/training_category')); ?>"><i class="fa fa-life-bouy"></i> Training Category</a></li>
                <li><a href="<?php echo e(url('/admin/training')); ?>"><i class="fa fa-life-bouy"></i> Trainings</a></li>


              </ul>
            </li>

              <li class="treeview">
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Events</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo e(url('/admin/event_category')); ?>"><i class="fa fa-life-bouy"></i> Event Category</a></li>
                <li><a href="<?php echo e(url('/admin/event')); ?>"><i class="fa fa-life-bouy"></i> Events</a></li>
              </ul>
             </li>

             <li class="treeview">
                <a href="#">
                  <i class="fa fa-briefcase"></i>
                  <span>Enroll</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(route('enroll.add')); ?>"><i class="fa fa-life-bouy"></i>Register Exhibition</a></li>
                    <li><a href="<?php echo e(route('enroll.index')); ?>"><i class="fa fa-life-bouy"></i>Exhibition Details</a></li>
                    <li><a href="<?php echo e(route('booth.create')); ?>"><i class="fa fa-life-bouy"></i>Register Booth</a></li>
                    <li><a href="<?php echo e(route('enroll_booth.detail')); ?>"><i class="fa fa-life-bouy"></i>Booth Details</a></li>
                    <li><a href="<?php echo e(route('enroll_reservation.detail')); ?>"><i class="fa fa-life-bouy"></i>Reservation Details</a></li>
                    <li><a href="<?php echo e(url('admin/enroll/invoice')); ?>"><i class="fa fa-files-o"></i>Enroll Invoice</a></li>
                </ul>
               </li>




              <li>
              <a href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
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
            <?php echo $__env->yieldContent('heading'); ?>
          </h1>
          <ol class="breadcrumb">
            <?php echo $__env->yieldContent('breadcrubm'); ?>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if(Session::has('alert-danger') || Session::has('alert-success')): ?>
          <div class="row">
            <div class="col-xs-12">
              <?php if(Session::has('alert-danger')): ?>
              <div class="alert alert-danger"><?php echo e(Session::get('alert-danger')); ?></div>
              <?php endif; ?>
              <?php if(Session::has('alert-success')): ?>
              <div class="alert alert-success"><?php echo e(Session::get('alert-success')); ?></div>
              <?php endif; ?>

            </div>

          </div>
          <?php endif; ?>

          <!-- Default box -->
         <?php echo $__env->yieldContent('content'); ?>

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
    <script src="<?php echo e(asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo e(asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('assets/plugins/fastclick/fastclick.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('assets/dist/js/app.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dist/js/bootstrap-checkbox.min.js')); ?>" defer></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/plugins/timepicker/jquery.timepicker.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('assets/dist/js/demo.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dist/js/select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dist/js/checkall.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/dist/js/jquery_form.js')); ?>"></script>
      <script type="text/javascript">
      $(document).on('focus',".datepicker", function(){ //bind to all instances of class "date".
         $(this).datepicker();
      });
     </script>

  </body>
</html>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin_master.blade.php ENDPATH**/ ?>