<?php $__env->startSection('header'); ?>
<section class="rt_banner">
  <div class="container rn_container">
    <?php echo $__env->make('front/common/test_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="">
       <h3 class="tp30p center"><span class="whiteclr">Search Test</span> <span class="greencolor"> With Category </span> </h3>
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


<?php if (count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-6';
} else{
$class = 'col-lg-9 col-md-8';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
        <?php if(count($datas['top_content']) > 0): ?>
        <div class="row">
          <div class="col-md-12">
            <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $tcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
<?php endif; ?>

<style>
    .active{
        background:#FFF !important;
    }
    
</style>
        <div class="row">
            <div class="col-md-12">
            <div class="alert-success justify">
              Rolling Test is an online based adaptive intellectual test. Based on the given answer of the previous question, the adaptive test gets harder or easier. If the candidate answers a question correctly, then there are chances of getting tougher questions onward, likewise if the candidate answers a question wrong then there are chances of getting easier questions. Mainly the test score depends on correct answer but the weightage will depend on the hardness of question and the answered time. In this way the candidates' intellectuality is tested through this test. It is based on game theory where only answering the question correctly is not enough but answering it in less time and answering the tougher question is also equally important.
            </div>
          </div>
          <aside class="col-lg-3 col-md-4 col-12">
            <div class="white_block lft_block tp20m">
              <h3 class="title_three btm10m">Test Categories</h3>
              <ul>
                  <li class="<?php echo e($datas['category_id'] == 0 ? 'active' : ''); ?>"><a href="<?php echo e(url('/skill-test')); ?>"> All</a></li>
                <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="<?php echo e($datas['category_id'] == $category['id'] ? 'active' : ''); ?>"><a href="<?php echo e($category['url']); ?>"> <?php echo e($category['title']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
              </ul>
            </div>
            <?php if(count($datas['left_content']) > 0): ?>
            <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $lcontent['module']; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             <?php endif; ?>
          </aside>
         
          <div class="<?php echo e($class); ?>">
            <div class="row cm10-row tp20p">
              <?php if(count($datas['exams']) > 0): ?>
              <?php $__currentLoopData = $datas['exams']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <a href="<?php echo e($exam['href']); ?>" class="col-lg-4 col-md-6">
                <div class="test_block">
                  <div class="row">
                    <div class="col-md-4 col-4">
                      <div class="test_logo">
                        <img src="<?php echo e($exam['image']); ?>">
                      </div>
                    </div>
                    <div class="col-md-8 col-8">
                      <div class="title_three"><?php echo e($exam['title']); ?></div>
                    </div>
                  </div>
                </div>
              </a>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <div class="col-md-12"><div class="alert alert-info">No any test found on this category. Please visit next time.</div></div>
            <?php endif; ?>
           
            </div>
            <div class="row">
              
              <div class="col-md-12">
                <div class="float-right">
                <nav aria-label="Page navigation example">
                  <?php echo $datas['pagination']->render(); ?>
                </nav>
              </div>
              </div>
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
var url = '<?php echo e(url("/skill-test/search/")); ?>';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.tender-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/skill-test/index.blade.php ENDPATH**/ ?>