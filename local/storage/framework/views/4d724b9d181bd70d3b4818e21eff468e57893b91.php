<header class="inner_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="main-menu">
  <div class="container">
    <div class="row cm-row">
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-xs">
        <a href="<?php echo e(url('/events')); ?>"><img src="<?php echo e(\App\library\Settings::getEventLogo()); ?>"></a>
      </div>
      <div class="col-lg-7 col-md-7 col-3">
        <nav class="navbar navbar-expand-sm mainmenu navbar-light stick-top">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse mainNav inner_nav" id="navbarNav">
                <ul class="navbar-nav nav-pills" id="menu-main-navigation">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/jobs')); ?>">Job</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/tenders')); ?>">Tender</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/projects')); ?>">Project</a>
                    </li>

                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/trainings')); ?>">Training</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/skill-test')); ?>">Test</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(url('/events/enroll')); ?>">Enroll</a>
                        </li>
                    <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(url('/events')); ?>">Event</a>
                    </li>
                </ul>

          </div>
        </nav>
      </div>
      <div class="col-lg-2 col-md-2 col-3 inner_logo hidden-lg hidden-md">
        <a href="<?php echo e(url('/events')); ?>"><img src="<?php echo e(\App\library\Settings::getEventLogo()); ?>"></a>
      </div>
      <div class="col-md-3 col-6">
        <div class="float-right loginbtns afterlogin tp12p">
          <?php if(isset(Auth::guard('employer')->user()->name)): ?>
          <a href="<?php echo e(url('/employer/dashboard')); ?>" target="_blank" title="<?php echo e(\App\Employers::getName(Auth::guard('employer')->user()->employers_id)); ?>"><span class="user-image"><img src="<?php echo e(asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))); ?>"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
            <a class="btn ipadloginbtns" href="<?php echo e(url('/employer/logout')); ?>" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>

          <?php elseif(isset(Auth::guard('employee')->user()->firstname)): ?>
          <a href="<?php echo e(url('/employee/dashboard')); ?>" title="Dashboard" target="_blank"><span class="user-image"><img src="<?php echo e(asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))); ?>"></span><span class="hidden-md hidden-xs"> <strong><?php echo e(\App\Employees::getName(Auth::guard('employee')->user()->id)); ?></strong></span></a>
            <a class="btn ipadloginbtns" href="<?php echo e(url('/employee/logout')); ?>" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
          <?php else: ?>
          <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
          <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
          <?php endif; ?>
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
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/common/event_header.blade.php ENDPATH**/ ?>