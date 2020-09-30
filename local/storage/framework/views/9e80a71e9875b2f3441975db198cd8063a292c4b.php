<?php $__env->startSection('header'); ?>
<section class="rj_banner">
     <div class="container">
    <?php echo $__env->make('front/common/job_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="container tp30p">
        <div class="row">
            <div class="col-md-5">
                <h1 class="h1 tp30p"><span class="greenclr">We offer</span> <span class="redclr">1000+</span> job vacancies <br>Register right now !</h1>
                <p>Start building your career with us</p>
                <!-- <a href="#" class="btn aboutbtn">About Us</a> -->
            </div>
            <div class="col-md-7">
                <div class="tp30p">
                    <form class="search_form btm30p">
                        <div class="row cm10-row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="keyword" placeholder="key words">
                            </div>
                            <div class="col-md-3">
                                <select id="location" class="form-control">
                                    <option value="">Choose Job location</option>
                                    <?php $__currentLoopData = $datas['search_locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search_location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($search_location->id); ?>"><?php echo e($search_location->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="category" class="form-control">
                                    <option value="">Choose Category</option>
                                    <?php $__currentLoopData = $datas['search_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $search_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($search_category->id); ?>"><?php echo e($search_category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="search-button" class="btn searchicon right"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <ul id="tabsJustified" class="nav nav-tabs bannertab">
                        <li class="nav-item"><a href="" data-target="#function" data-toggle="tab" class="nav-link small active">Jobs by Industry</a></li>
                        <li class="nav-item"><a href="" data-target="#job_category" data-toggle="tab" class="nav-link small">Jobs by Category</a></li>
                        <li class="nav-item"><a href="" data-target="#city" data-toggle="tab" class="nav-link small">Jobs by City</a></li>
                    </ul>
                    <div id="tabsJustifiedContent" class="tab-content bannertab-content">
                        <div id="function" class="tab-pane fade active show">
                            <ul class="row">
                                <?php $__currentLoopData = $datas['functions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $function): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-md-4 text-ellipsis"><a href="<?php echo e($function['href']); ?>" title="<?php echo e($function['name']); ?> (<?php echo e($function['total']); ?>)"><?php echo e($function['name']); ?> <span>(<?php echo e($function['total']); ?>)</span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div id="job_category" class="tab-pane fade">
                            <ul class="row">
                                <?php $__currentLoopData = $datas['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-md-4 text-ellipsis"><a href="<?php echo e($category['href']); ?>" title="<?php echo e($category['name']); ?> (<?php echo e($category['total']); ?>)"><?php echo e($category['name']); ?> <span>(<?php echo e($category['total']); ?>)</span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div id="city" class="tab-pane fade">
                            <ul class="row">
                                <?php $__currentLoopData = $datas['locations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-md-4 text-ellipsis"><a href="<?php echo e($location['href']); ?>" title="<?php echo e($location['name']); ?> (<?php echo e($location['total']); ?>)"><?php echo e($location['name']); ?> <span>(<?php echo e($location['total']); ?>)</span></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
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
    <div class="container rn_container">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $datas['top_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $tcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-4 col-12 center-panel';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-8 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-4 col-12';
} else{
$class = 'col-md-12';
} ?>
<section id="job" class="jobs tb35p">
    <div class="container rn_container">
        <div class="row">
            <?php if(count($datas['left_content']) > 0): ?>
            <aside class="col-lg-3 col-md-4 col-12">
                <?php $__currentLoopData = $datas['left_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $lcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </aside>
            <?php endif; ?>
            <div class="<?php echo e($class); ?>">
                <?php $__currentLoopData = $datas['main_modules']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $main_module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $main_module['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php if(count($datas['right_content']) > 0): ?>
            <aside class="col-lg-2 col-md-4 col-12">
                <?php $__currentLoopData = $datas['right_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $rcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php if(count($datas['bottom_content']) > 0): ?>
<section id="bottom_content" class="jobs tb35p">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $__currentLoopData = $datas['bottom_content']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bcontent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $bcontent['module']; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<script type="text/javascript">
$('#search-button').on('click', function() {

var keyword = $('#keyword').val();
var location = $('#location').val();
var category = $('#category').val();
if (keyword == '' && location == '' && category == '') {
$('#keyword').focus();

} else{

var searchurl = '<?php echo e(url("/jobs/search/")); ?>';

if (keyword != '') {
    searchurl += '?keyword='+keyword;
}
if (category != '') {
    searchurl += '?category='+category;
}
if (location != '') {
    searchurl += '?location='+location;
}


window.location = searchurl;
}

})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.job-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/common/jobs.blade.php ENDPATH**/ ?>