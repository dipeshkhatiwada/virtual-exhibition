<?php $__env->startSection('header'); ?>
<section class="rt_banner">
  <div class="container rn_container">
    <?php echo $__env->make('front/common/project_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Search Projects</span> <span class="greencolor"> With Category </span> </h3>
        <div class="search_background">
          <form class="search_form">
            <div class="row cm10-row">
                <div class="col-md-10 col-9">
                  <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
                </div>
                <div class="col-md-2 col-3">
                   <button type="button" id="search_button" class="btn searchbtn">Search</button>
                </div>
            </div>
          </form>
        </div>
          
        <div class="tb20p center">
          <a class="btn bluecomnbtn">TOP PROJECTS</a>
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

<?php if(count($datas['top_content']) > 0): ?>
<section id="top_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
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
  </div>
</section>
<?php endif; ?>
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-6';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-9';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      
        <div class="row">
          <?php if(count($datas['left_content']) > 0): ?>
          <aside class="col-lg-3 col-md-4 col-12">

            <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $lcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </aside>
          <?php endif; ?>
          <div class="<?php echo e($class); ?>">
            <div class="tb20p">
              <div class="list_hd btm7m hidden-xs">
                <div class="row cm10-row">
                  <div class="col-lg-3 col-md-3">
                   Projects
                  </div>
                  <div class="col-lg-7 col-md-6">
                    Description
                  </div>
                  <div class="col-lg-2 col-md-3">
                    <span> Price(NRs.) </span>
                  </div>
                </div>
              </div>
               <?php if(count($datas['projects']) > 0): ?>
               <?php $__currentLoopData = $datas['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="list_block btm7m">
                <div class="list_body btm7m">
                  <div class="row cm10-row">
                    <div class="col-lg-3 col-md-3">
                      <a class="title_three" href="<?php echo e(url('/projects/'.$project->seo_url)); ?>" title="<?php echo e($project->title); ?>"><?php echo e(\App\Library\Settings::getLimitedWords($project->title,0,10)); ?></a>
                      <div class="tb5p">
                        <p><i class="fa fa-hourglass"></i> <span class="blueclr">Active</span> <?php echo e($project->publish_date); ?> - <?php echo e(\App\ProjectApply::totalBidder($project->id)); ?> bids</p>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-6">
                      <p><?php echo e(\App\Library\Settings::getLimitedWords($project->description,0,20)); ?></p>
                    </div>
                    <div class="col-lg-2 col-md-3">
                      NRs. <?php echo e(\App\ProjectApply::getAverage($project->id)); ?>

                    </div>
                  </div>
                </div>
                <p>
                  <?php ($skills = explode(',', $project->skills)); ?>
                  <span class="blueclr"><i class="fa fa-tags"></i></span>
                  <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span><a href="<?php echo e(url('/projects/tags/'.$skill)); ?>" class="skill_list"><?php echo e($skill); ?></a></span>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
              <div class="list_block btm7m">
                <div class="list_body btm7m">
                  <div class="row cm10-row">
                    <div class="col-md-12">
                      <div class="alert alert-info"> Sorry, could not found any project yet. please visit next time</div>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>

            </div>
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['projects']->render();?>
              </nav>
            </div>
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
    <div class="white_div">
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
  </div>
</section>
<?php endif; ?>

<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '<?php echo e(url("/projects/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.tender-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/project/index.blade.php ENDPATH**/ ?>