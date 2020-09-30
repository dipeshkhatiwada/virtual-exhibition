<?php $__env->startSection('header'); ?>
<section class="rt_banner">
  <div class="container rn_container">
    <?php echo $__env->make('front/common/tender_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Get Tenders Before</span> <span class="greencolor"> Others Do! </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Road Construction">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      <p>Explore New Business Opportunities & Grow your Business </p>
      <div class="tb20p center">
        <a class="btn bluecomnbtn">ADVANCE SEARCH</a>
      </div>
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('banner'); ?>
<!-- banner section with search form ended here -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      <!-- Start of Search Tender By !-->
      <h3 class="center title_one tb20p">
      <span class="greencolor"> SEARCH</span> TENDER BY
      </h3>
      <div class="tender_navbar">
        <ul class="nav nav-tabs tender_tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#category" role="tab" data-toggle="tab">Categories</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#organization" role="tab" data-toggle="tab">Organization</a>
          </li>
        </ul>
      </div>
      <!-- Tab panes -->
      <div class="tab-content tender_tabcontent">
        
        <div role="tabpanel" class="tab-pane in active" id="category">
        <div class="row">
        <?php $__currentLoopData = $datas['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="col-md-3">
            <ul>
                <li><a href="<?php echo e($category['href']); ?>"><?php echo e($category['name']); ?> </a></li>
             </ul>
             </div>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
            </div>
        
         <div role="tabpanel" class="tab-pane fade" id="organization">
             <div class="row">
                 <?php $__currentLoopData = $datas['employers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="col-md-3">
                     <ul>
                         <li><a href="<?php echo e($employer['href']); ?>"><?php echo e($employer['name']); ?></a></li>
                     </ul>
                 </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
        </div>
      </div>
      <!-- end of search tender by !-->
      <!-- end of Search Tender by !-->
    </div>
  </div>
</section>
<?php if(count($datas['top_content']) > 0): ?>
<section id="top_content" class="jobs tb35p">
  <div class="container">
      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $tcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
  </div>
</section>
<?php endif; ?>
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-6';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="tp20p">
        <div class="row">
            
            
            
            
            
            
            
            
            
          <?php if(count($datas['left_content']) > 0): ?>
          <aside class="col-lg-3 col-md-4">
            <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $lcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </aside>
          <?php endif; ?>
          <div class="<?php echo e($class); ?>">
             

<div class="list_hd btm7m hidden-xs">
  <div class="row">
    <div class="col-lg-7 col-md-6">
      TENDER DESCRIPTION
    </div>
    <div class="col-md-2">
      ESTIMATE COST
    </div>
    <div class="col-md-2">
      <span> DEADLINE </span>
    </div>
    <div class="col-lg-1 col-md-2">
      IMAGE
    </div>
  </div>
</div>
<?php $__currentLoopData = $datas['tenders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php 
if (is_file(DIR_IMAGE.$tender->image)) {
                $thumb = \App\Imagetool::mycrop($tender->image,400,400);
                $image = asset('/image/'.$tender->image);
              } else{
                $thumb = \App\Imagetool::mycrop('no-image.png', 300,300);
                $image = asset('/image/no-image.png');
              }


              $diff = \Carbon\Carbon::parse($tender->submission_end_date)->diff(\Carbon\Carbon::now())->format('%D:%H:%I');
             $diffs = explode(':', $diff);
             if ($diffs[0] != 0) {
                 $difference = $diffs[0].' Days left';
             } elseif ($diffs[1] != 0) {
                 $difference = $diffs[1].' Hours left';
             }elseif ($diffs[2] != 0) {
                 $difference = $diffs[2].' Minutes left';
             } else {
                  $difference = '';
             }

                  $submission = \Carbon\Carbon::parse($tender->submission_end_date);
?>
<div class="list_block btm7m">
  <div class="tender_list_body">
    <div class="row">
        
      <div class="col-md-12  hidden-lg hidden-md">
        <div class="tender_thumb">
          <img onclick="viewImage('<?php echo e($tender["id"]); ?>')" src="<?php echo e(asset($thumb)); ?>" style="cursor: pointer;">
        </div>
      </div>
      <div class="col-lg-7 col-md-6 ">
        <p class="greencolor bold">Tender Code : <?php echo e($tender->tender_code); ?></p>
        <p>
          <a href="<?php echo e(url('/tenders/business/'.\App\Employers::getUrl($tender->employers_id))); ?>"  class="bold"> <?php echo e(\App\Employers::getName($tender->employers_id)); ?> </a>
        </p>
        <p><?php echo e($tender->title); ?></p>
        
      </div>
      <div class="col-md-2 col-6">
        <span class="">NRs. <?php echo e($tender->estimate_cost); ?></span>
      </div>
      <div class="col-md-2 col-6">
        <p><?php echo e($difference); ?></p>
        <div class="hidden-xs"><span class="blueclr"><?php echo e($tender->submission_end_date); ?></span></div>
      </div>
      <div class="col-lg-1 col-md-2 hidden-xs">
        <div class="tender_thumb">
          <img onclick="viewImage('<?php echo e($tender["id"]); ?>')" src="<?php echo e(asset($thumb)); ?>" style="cursor: pointer;">
        </div>
      </div>
    </div>
  </div>
  <div class="tp10p">
    <div class="row">  <!-- Tender Sector eg: Civil Works !-->
    <div class="col-md-10">
      <?php if($tender->project_location != ''): ?>
      <span><i class="fa fa-map-marker-alt blueclr"></i> <?php echo e($tender->project_location); ?> </span>
      <?php endif; ?>
      <div class="hidden-xs"><span class="blueclr italic lft10p"><?php echo e(\App\TenderType::getTitle($tender->tender_type_id)); ?></span></div>
    </div>
    <div class="col-md-2">
      <a href="<?php echo e(url('/tenders/'.$tender->seo_url)); ?>" class="btn lightgreen_gradient float-right" >View <i class="fa fa-eye"></i></a>
    </div>
  </div>
</div>
</div>

<div class="modal fade servicemodal" id="tender-image<?php echo e($tender['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
  <div class="modal-content">
    <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <img src="<?php echo e($image); ?>" style="width: 100%;">
    </div>
    
    
    
  </div>
</div>


</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['tenders']->render();?>
              </nav>
            </div>
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>
            <?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $main_module['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php if(count($datas['right_content']) > 0): ?>
          <aside class="col-md-2">
            <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $rcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </aside>
          <?php endif; ?>
        </div>
    </div>
  </div>
</section>
<?php if(count($datas['bottom_content']) > 0): ?>
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="tp20p">
      <div class="row">
        <div class="col-md-12">
          <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php echo $bcontent['module']; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '<?php echo e(url("/tenders/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.tender-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/tender/index.blade.php ENDPATH**/ ?>