<?php $__env->startSection('header'); ?>
<section class="top_header" id="top">
  <div class="container rn_container">
    <div class="row cm10-row">
      <div class="col-lg-2 col-md-3 col-6">
        <p><span class="fa fa-envelope"></span> info@rollingnexus.com</p>
      </div>
      <div class="col-lg-2 col-md-3 col-6">
        <p><span class="fa fa-phone-volume"></span> +977-1-4784183/4785215</p>
      </div>
      <div class="col-lg-4 hidden-md hidden-xs">
         <div class="float-right loginbtns tp2m">
              <?php if(isset(Auth::guard('employer')->user()->name)): ?>
              <a href="<?php echo e(url('/employer/dashboard')); ?>" target="_blank" title="<?php echo e(\App\Employers::getName(Auth::guard('employer')->user()->employers_id)); ?>"><span class="user-image"><img src="<?php echo e(asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))); ?>"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
                <a class="btn" href="<?php echo e(url('/employer/logout')); ?>" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              <?php elseif(isset(Auth::guard('employee')->user()->firstname)): ?>
            <a href="<?php echo e(url('/employee/dashboard')); ?>" title="Dashboard" target="_blank"><span class="user-image"><img src="<?php echo e(asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))); ?>"></span><span > <strong><?php echo e(\App\Employees::getName(Auth::guard('employee')->user()->id)); ?></strong></span></a>
                <a class="btn" href="<?php echo e(url('/employee/logout')); ?>" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              <?php else: ?>
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              <?php endif; ?>
            </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="topmenu">
          <ul>
              <li><a class="nav-item nav-link active" href="<?php echo e(url('/women')); ?>" target="blank">Rolling Women</a></li>
              <li><a class="nav-item nav-link" href="<?php echo e(url('/able')); ?>" target="blank">Rolling Able</a></li>
              <li><a class="nav-item nav-link" href="<?php echo e(url('/retired')); ?>" target="blank">Rolling Yet to Retire</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="hidden-lg hidden-md">
    <div class="">
      <div class="row cm10-row">
        <div class="col-4">
            <div class="mainlogo tb5p"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(\App\library\Settings::getLogo()); ?>"></a></div>
        </div>
        <div class="col-8">
            <div class="float-right loginbtns tp20p">
              <?php if(isset(Auth::guard('employer')->user()->name)): ?>
              <a href="<?php echo e(url('/employer/dashboard')); ?>" target="_blank" title="<?php echo e(\App\Employers::getName(Auth::guard('employer')->user()->employers_id)); ?>"><span class="user-image"><img src="<?php echo e(asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))); ?>"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
                <a class="btn" href="<?php echo e(url('/employer/logout')); ?>" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              <?php elseif(isset(Auth::guard('employee')->user()->firstname)): ?>
            <a href="<?php echo e(url('/employee/dashboard')); ?>" title="Dashboard" target="_blank"><span class="user-image"><img src="<?php echo e(asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))); ?>"></span><span > <strong><?php echo e(\App\Employees::getName(Auth::guard('employee')->user()->id)); ?></strong></span></a>
                <a class="btn" href="<?php echo e(url('/employee/logout')); ?>" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              <?php else: ?>
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              <?php endif; ?>
            </div>
          </div>
      </div>
    </div>
</section>
<header class="header tb10p"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="container rn_container">
        <div class="row cm-row hidden-xs">
            <div class="col-md-2 col-sm-2">
                <div class="mainlogo hidden-xs"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(\App\library\Settings::getLogo()); ?>"></a></div>
            </div>
            <div class="col-md-6 col-sm-3">
                <nav class="navbar navbar-expand-sm mainmenu stick-top">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse mainNav" id="navbarNav">
                        <ul class="navbar-nav nav-pills">
                          <li class="nav-item">
                            <a class="nav-link" href="#job">Jobs</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#tender">Tenders</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#project">Projects</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#training">Training</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#test">Test</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#event">Events</a>
                          </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-md-4 col-4">
            <div class="float-right loginbtns tp10p">
              <?php if(isset(Auth::guard('employer')->user()->name)): ?>
              <a href="<?php echo e(url('/employer/dashboard')); ?>" target="_blank" title="<?php echo e(\App\Employers::getName(Auth::guard('employer')->user()->employers_id)); ?>"><span class="user-image"><img src="<?php echo e(asset(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id))); ?>"></span><span class="hidden-xs"><strong> Dashboard</strong></span></a>
                <a class="btn" href="<?php echo e(url('/employer/logout')); ?>" target="_blank"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
             
              <?php elseif(isset(Auth::guard('employee')->user()->firstname)): ?>
             <a href="<?php echo e(url('/employee/dashboard')); ?>" title="Dashboard" target="_blank"><span class="user-image"><img src="<?php echo e(asset(\App\Employees::getPhoto(Auth::guard('employee')->user()->id))); ?>"></span><span class="hidden-xs"> <strong><?php echo e(\App\Employees::getName(Auth::guard('employee')->user()->id)); ?></strong></span></a>
                <a class="btn" href="<?php echo e(url('/employee/logout')); ?>" title="Logout"><i class="fa fa-power-off"></i><span class="hidden-xs"> Logout</span></a>
              <?php else: ?>
              <button type="button" class="btn individualbtn bluebtn" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Individual</span></button>
              <button type="button" class="btn businessbtn greenbtn" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo"><span class="hidden-xs">Business</span></button>
              <?php endif; ?>
            </div>
          </div>
        </div>  
    </div>
</header>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('banner'); ?>
<section class="rn_banner" style="background:url(images/banner.jpg); background-attachment: fixed;background-size: cover;" data-aos="fade-up" data-aos-delay="100">
    <div class="container rn_container">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 float-right tp30p">
                <h1 class="h1 lft100p" data-aos="fade-up" data-aos-delay="200">Login to Rolling Nexus to <br>get all these features</h1>
                <div class="tp20p lft100p" data-aos="fade-right" data-aos-delay="200">
                  <div class="front_tab_block">
                    <ul id="tabsJustified" class="nav nav-tabs home_bannertab">
                        <li class="nav-item"><a href="" data-target="#individual" data-toggle="tab" class="nav-link active">Individual Account</a></li>
                        <li class="nav-item lft2m"><a href="" data-target="#business" data-toggle="tab" class="nav-link">Business Account</a></li>
                    </ul>
                    <div id="tabsJustifiedContent" class="tab-content home_bannertab-content">
                        <div id="individual" class="tab-pane fade active show">
                            <ul>
                                <li>Apply for Job/Internship</li>
                                <li>Bid for Projects</li>
                                <li>Apply for Events</li>
                                <li>Apply for Training</li>
                                <li>Network With Professionals</li>
                                <li>Get Skill Endorsement</li>
                                <li>Take Tests/Increase your skills/upgrade your Ranking</li>
                                <li>Get Certified from companies</li>
                            </ul>
                             <?php if(!isset(Auth::guard('employee')->user()->firstname)): ?>
                            <button type="button" class="btn whitegradient blueclr lft25m" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Individual Login</button>
                            <?php endif; ?>
                        </div>
                        <div id="business" class="tab-pane fade">
                             <ul>
                                <li>Post Jobs</li>
                                <li>Post Projects</li>
                                <li>Post Bids/tender/apply for bids</li>
                                <li>Post Events</li>
                                <li>Increase your Corporate ranking</li>
                            </ul>
                             <?php if(!isset(Auth::guard('employer')->user()->name)): ?>
                            <button type="button" class="btn whitegradient greenclr lft25m" data-toggle="modal" data-target="#businessModal" data-whatever="@mdo">Business Login</button>
                            <?php endif; ?>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 float-left hidden-xs hidden-md">
                <div class="nexusinfo" data-aos="fade-left" data-aos-delay="200">
                <!--  <img src="<?php echo e(asset('images/nexusinfo.png')); ?>" alt="rollingnexuslogo"> -->
                <div id="infographic">
            <div class="rjobs">
              <img src="<?php echo e(asset('images/nexus_info/logo_red.png')); ?>">
            </div>
            <div class="rtenders">
              <img src="<?php echo e(asset('images/nexus_info/logo_green.png')); ?>">
            </div>
            <div class="rprojects">
              <img src="<?php echo e(asset('images/nexus_info/logo_orange.png')); ?>">
            </div>
            <div class="rtests">
              <img src="<?php echo e(asset('images/nexus_info/logo_bluedark.png')); ?>">
            </div>
            <div class="rtrainings">
              <img src="<?php echo e(asset('images/nexus_info/logo_blue.png')); ?>">
            </div>
            <div class="revents">
              <img src="<?php echo e(asset('images/nexus_info/logo_grey.png')); ?>">
            </div>  
            <div class="circle">
              <img src="<?php echo e(asset('images/nexus_info/circle.png')); ?>">
            </div>
            <div class="nexuslogo" data-aos="fade-in" data-aos-delay="400">
              <a href="#"><img src="<?php echo e(asset('images/nexus_info/rnlogo.png')); ?>"></a>
            </div>
          </div>  
                </div>
                <div  id="set-8" class="nexusmenu">
                    <ul class="hi-icon-wrap hi-icon-effect-8">
                        <li data-aos="fade-up" data-aos-delay="600"><a href="#job" class="hi-icon"><img src="<?php echo e(asset('images/job.png')); ?>"></a></li>
                        <li data-aos="fade-up" data-aos-delay="1000"><a href="#tender" class="hi-icon"><img src="<?php echo e(asset('images/tender.png')); ?>"></a></li>
                        <li data-aos="fade-up" data-aos-delay="1400"><a href="#project" class="hi-icon"><img src="<?php echo e(asset('images/project.png')); ?>"></a></li>
                        <li data-aos="fade-up" data-aos-delay="1800"><a href="#test" class="hi-icon"><img src="<?php echo e(asset('images/test.png')); ?>"></a></li>
                        <li data-aos="fade-up" data-aos-delay="2200"><a href="#training" class="hi-icon"><img src="<?php echo e(asset('images/training.png')); ?>"></a></li>
                        <li data-aos="fade-up" data-aos-delay="2600"><a href="#event" class="hi-icon"><img src="<?php echo e(asset('images/event.png')); ?>"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <svg class="arrows">
      <path class="a1" d="M0 0 L30 32 L60 0"></path>
      <path class="a2" d="M0 20 L30 52 L60 20"></path>
      <path class="a3" d="M0 40 L30 72 L60 40"></path>
    </svg>
</section>


<!-- banner section with search form ended here -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php echo $main_module['module']; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.front-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/common/home.blade.php ENDPATH**/ ?>