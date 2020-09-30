<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Business Dashboard Page</title>
    <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/employer/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/employer/plugin.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/employer/accordion.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('jobcss/purna.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&amp;" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/timepicker/jquery.timepicker.css')); ?>" />
    <script src='<?php echo e(asset("js/employer/jquery-3.1.1.min.js")); ?>'></script>
    <script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
    <link rel="stylesheet" href=" https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.agora.io/sdk/web/AgoraRTCSDK-2.8.0.js"></script>

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="100" class="dashboardbg">
    <input type="hidden" id="my_id" value="<?php echo e(auth()->guard('employer')->user()->id); ?>">
    <input type="hidden" id="pusher_key" value="6e2167f314296786dc0a">
<!-- header part with navigation ended here -->
<?php echo csrf_field(); ?>


<?php echo $__env->make('front/common/dash_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <!-- dashboard section started here -->
<section class="dashboard">

  <div class="row">
    <div class="col-lg-2 col-md-4 col-sm-4">
  <div id="left_dashboard" class="left_sidebar tb40p">
    <div class="employer_tagbg center">
      <div class="employerlogo">
        <img src="<?php echo e(\App\Employers::getPhoto(Auth::guard('employer')->user()->employers_id)); ?>">
        <div class="comp_name">
          <p><?php echo e(\App\Employers::getName(Auth::guard('employer')->user()->employers_id)); ?></p>
        </div>
      </div>
      <div class="tb10p">
        <div class="col-md-12 pb-3">
          <div class="rating" style="display:block">
            <div class="star-ratings-sprite"><span style="width:<?php echo e(\App\EmployerQuestionAnswer::getPercent()); ?>%" class="star-ratings-sprite-rating"></span></div>
              <div class="rating-detail">
                <div class="rating-list">
                  <div class="remove-btn pull-right">
                    <i class="fa fa-remove" style="margin: 0px;"></i>
                  </div>
                </div>
                <?php ($groups = \App\EmployerQuestionAnswer::getQustionGroup()); ?>
                <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="rating-list">
                  <div class="r-title pull-left">
                    <?php echo e($group['title']); ?>

                  </div>
                  <div class="rpercent pull-right">
                    <?php echo e($group['percent']); ?>%
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <!-- <p>
            <span class="gold"><i class="fa fa-star-half-alt"></i></span>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
            <i class="far fa-star"></i>
          </p> -->
          <?php ($member_type = \App\MemberType::getTitle(Auth::guard('employer')->user()->employers_id)); ?>
          <div class="tp10p">
            <span><a href="#" class="btn whitegradient rt5m" data-toggle="modal" data-target="#detailModal"><?php echo e($member_type); ?></a></span>
            <?php if(\App\Employers::getType(Auth::guard('employer')->user()->employers_id) != 2): ?>
             <span><a href="<?php echo e(url('/employer/upgrade')); ?>" class="btn upgradebtn" >Upgrade</a></span>
            <?php endif; ?>
          </div>
          <div class="tp10p">
            <?php if(\App\EmployerPackage::countPackage() > 0): ?>
            <span><a href="<?php echo e(url('/employer/package')); ?>" class="btn lightgreen_gradient"> Packages</a></span>
            <?php else: ?>
            <span><a href="<?php echo e(url('/employer/buy_package')); ?>" class="btn lightgreen_gradient">Buy Package</a></span>
            <?php endif; ?>

          </div>
      </div>
    </div>
    <?php ($member_detail = \App\UpgradeRequest::userDetail(Auth::guard('employer')->user()->employers_id)); ?>

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Member Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <?php if($member_detail['created_at'] != ''): ?>
        <div class="row">

          <div class="col-md-12"><strong>Member Since:</strong> <?php echo e($member_detail['created_at']); ?></div>

        </div>
         <?php endif; ?>
          <?php if($member_detail['upgrade_start'] != ''): ?>
        <div class="row">

          <div class="col-md-6"><strong><?php echo e($member_type); ?> Since:</strong> <?php echo e($member_detail['upgrade_start']); ?></div>
          <div class="col-md-6"><strong><?php echo e($member_type); ?> Till:</strong> <?php echo e($member_detail['upgrade_end']); ?></div>

        </div>
         <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    <div class="employer_address">
      <p><i class="fas fa-map-marker-alt"></i> Address : <?php echo e(\App\Employers::getAddress(Auth::guard('employer')->user()->employers_id)); ?> <span class="lft15p"></p>
      <p><i class="fa fa-clock"></i> Last Logged In : <?php echo e(\App\Employers::getLastlogin(Auth::guard('employer')->user()->employers_id)); ?></p>
      <div class="row cm-row whitegradient linkcolor">
        <a href="<?php echo e(url('/employer/logout')); ?>" class="col-lg-6 col-md-6 col-6">
          <strong><span class="fa fa-power-off"></span>
            <span class="improve-profile">Logout</span>
          </strong>
        </a>
        <a href="<?php echo e(url('/employer')); ?>" class="col-lg-6 col-md-6 col-6">
          <strong><span class="fa fa-th-large"></span>
            <span class="improve-profile">Dashboard</span>
          </strong>
        </a>

      </div>

        <div class="row cm-row whitegradient linkcolor tp5m">
        <a href="<?php echo e(url('/employer/tickets')); ?>" class="col-lg-12 col-md-12 col-12">
          <strong><span class="fa fa-comment"></span>
            <span class="improve-profile">Support Tickets</span>
          </strong>
        </a>

      </div>
    </div>
    <?php ($type_detail = \App\MemberType::getDetail(Auth::guard('employer')->user()->employers_id)); ?>

    <div class="accordion indicator-plus-before round-indicator" id="accordion" aria-multiselectable="true">
      <div class="card m-b-0">

        <!-- Enroll tab started here -->
        <div class="card-header collapsed" role="tab" id="plan" href="#plans" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="plans">
            <a class="card-title"><i class="fas fa-calendar-check"></i>Enroll</a>
        </div>
        <div id="plans" class="collapse" aria-labelledby="plans" data-parent="#accordion">
            <div class="card-body">
            <ul>
                <li><a href="<?php echo e(url('/employer/enroll/addnew')); ?>"><i class="fas fa-calendar-plus"></i>New Enroll</a></li>
                <li><a href="<?php echo e(url('/employer/enroll/all-detail')); ?>"><i class="fas fa-calendar-plus"></i>Details</a></li>
                <li><a href="<?php echo e(url('/employer/enroll/payment-detail')); ?>"><i class="fa fa-credit-card"></i>Pending Payment</a></li>
                <li><a href="<?php echo e(url('/employer/enroll/report')); ?>"><i class="fa fa-credit-card"></i>Payment Report</a></li>

            </ul>
            </div>
        </div>
        <!-- Events tab started here -->
        <div class="card-header collapsed" role="tab" id="event" href="#events" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="events">
          <a class="card-title"><i class="fas fa-calendar-check"></i> Events</a>
        </div>
        <div id="events" class="collapse" aria-labelledby="events" data-parent="#accordion">
          <div class="card-body">
            <ul>
              <li><a href="<?php echo e(url('/employer/event')); ?>"><i class="fas fa-images"></i> Events</a></li>
              <li><a href="<?php echo e(url('/employer/event/addnew')); ?>"><i class="fas fa-calendar-plus"></i> New Events</a></li>
            </ul>
          </div>
        </div>
<!-- Training tab started here -->
        <div class="card-header collapsed" role="tab" id="training" href="#trainings" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="trainings">
          <a class="card-title"><i class="fas fa-chalkboard-teacher"></i> Training</a>
        </div>
        <div id="trainings" class="collapse" aria-labelledby="trainings" data-parent="#accordion">
          <div class="card-body">
            <ul>
              <li><a href="<?php echo e(url('/employer/training')); ?>"><i class="fas fa-laptop-code"></i> Training</a></li>
              <li><a href="<?php echo e(url('/employer/training/addnew')); ?>"><i class="fas fa-laptop-medical"></i> New Training</a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- service package started here -->
    </div>
    <div class="">
      <h3 class="service_title"><i class="fab fa-staylinked"></i>Service Package</h3>
      <div class="service_package">
        <ul>
          <?php $job_types = \App\JobType::getTypes(); ?>
              <?php $__currentLoopData = $job_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="javascript:void(0);" onClick="viewDetail('<?php echo e($jobtype->id); ?>')"><?php echo e($jobtype->title); ?> <span class="gold"><img src="<?php echo e(asset('image/'.$jobtype->icon)); ?>"></span></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </div>
  </div>
  <div class="col-lg-10 col-md-12 col-sm-8">
    <div class="right_pannel_dashboard">
      <div class="form_bg">
        <div class="row tp10m tg-btn">
          <div class="col-lg-12 col-md-12">
            <div class="toggle-btn" onclick="toggleSidebar()">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
          <div class="clear"></div>
        </div>

<div id="modal_message" class="modal fade tp116p">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php if(Session::has('alert-danger') || Session::has('alert-success')): ?>
      <?php if(Session::has('alert-danger')): ?>
      <div class="alert alert-danger updatemsg"><?php echo e(Session::get('alert-danger')); ?></div>
      <?php endif; ?>
      <?php if(Session::has('alert-success')): ?>
      <div class="alert alert-success updatemsg"><?php echo e(Session::get('alert-success')); ?></div>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

      <!-- Default box -->
      <?php echo $__env->yieldContent('content'); ?>
      </div>
        <div class="tp20p">
          <div class="row">
            <div class="col-md-6 col-3">
              <div class="social_link">
                <span><a href="#" class="greycolor"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="greycolor"><i class="fab fa-twitter-square"></i></a></span>
              </div>
            </div>
            <div class="col-md-6 col-9">
              <div class="right">
              <p>2018 All Rights with <a href="#" class="blueclr">Rolling Plans Pvt. Ltd.</a></p>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
  </div>
  </div>

</section>

<!-- footer section ended here -->

<!-- for service package Pricelist popup -->
<div class="modal fade servicemodal" id="goldjob" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
</div>
<!-- for upgrade popup -->
<div class="modal fade servicemodal" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

</div>
<div id="message_box_participator" class="message_box">
    <h3>Messages</h3>
    <div id="contacts_participators" class="participate">

    </div>
</div>


<!-- Scripts -->
<script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/api.js"></script>
<script src="<?php echo e(asset('/js/employer/popper.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('/js/employer/bootstrap.min.js')); ?>" type="text/javascript"></script>

   <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->

<script src='https://codepen.io/peterbenoit/pen/eezagz.js' type="text/javascript"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/axe-core/2.4.2/axe.min.js' type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/plugins/timepicker/jquery.timepicker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dist/js/checkall.js')); ?>"></script>
<script src="<?php echo e(asset('js/profile-custom.js')); ?>" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<script type="text/javascript">
  $('#myTab a').on('click', function (e) {
    e.preventDefault()
    $(this).tab('show')
  });
</script>
  <script type="text/javascript">
    function toggleSidebar(){
      var h = window.innerHeight;
      $('#left_dashboard').css('height',h);
      $('body').append('<div id="background-overally" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; overflow-y:scroll; transition:all 500ms linear; background-color:rgba(0,0,0,0.5); z-index:99; display-inline:block;"></div>');
      document.getElementById("left_dashboard").classList.toggle('active');
      $('#background-overally').on('click', function(){
        $("#left_dashboard").removeClass('active');
        $(this).remove();
      })
    }

     $(".rating").click(function(){


          $(".rating-detail").fadeToggle();
      });

     function viewDetail(id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
             type: 'POST',
                url: '<?php echo e(url("/employer/jobtype/")); ?>',
                data: '_token='+token+'&id='+id,
                cache: false,
                success: function(html){

                  $('#goldjob').html(html);
                  $('#goldjob').modal('show');

                }
          });
     }

  $(function() {

  $('.datepicker').datepicker();

});
  <?php if(Session::has('alert-danger') || Session::has('alert-success')): ?>
  $(document).ready(function(){
    $("#modal_message").modal("show");
  });
  <?php endif; ?>
  </script>
  <script type="text/javascript">
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


    /*to remove the popup edit and delete button while click on next tab*/
    $('body').click(function(){
    $('.bs-popover-right').remove();
});
  </script>

  <?php ($setting= \App\library\Settings::getSettings()); ?>

<script type="text/javascript">
   $(function () {
    $('.timepicker').timepicker({

      'timeFormat': 'H:i:s',
    });


});

   function chkAll(name, value) {
// hardcoded form name
  var frm = document.getElementById('testform');
// get all inputs from the form into an array
  var inputs = frm.getElementsByTagName('input');

// loop through the form inputs
  for (var i=0; i<inputs.length;i++) {
//if the name matches, set the value to match the calling element
    if (inputs[i].name == name) {
      inputs[i].checked = value;
    }
  }
}
 </script>


 <?php echo $__env->yieldContent('__scripts'); ?>



  </body>
  
</html>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer_master.blade.php ENDPATH**/ ?>