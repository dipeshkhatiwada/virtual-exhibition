<section id="tender" class="tb60p tenderbg">
  <div class="container">
    <div class="center">
      <p class="titlelogo"><img src="<?php echo e(asset($datas['logo'])); ?>"></p>
      <p class="whiteclr"><?php echo e($datas['description']); ?></p>
      <div class="title_bg"></div>
    </div>
    <div class="row tb35p">
      <div class="col-md-3">
          <div class="white_block">
        <div class="lft_block">
          <h3 class="h3 btm15m">Categories</h3>
          <ul>
            <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a href="<?php echo e($category['url']); ?>" ><?php echo e($category['title']); ?> <span>(<?php echo e($category['total']); ?>)</span></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <div class="tp10p">
            <a href="<?php echo e(url('/tenders/category')); ?>" class="morejob" >All Categories <i class="fa fa-plus"></i></a>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="list_hd btm7m">
          <div class="row">
            <div class="col-md-7">
              TENDER DESCRIPTION
            </div>
            <div class="col-md-2">
              ESTIMATE COST
            </div>
            <div class="col-md-2">
              <span> DEADLINE </span>
            </div>
            <div class="col-md-1">
              IMAGE
            </div>
          </div>
        </div>
        <?php $__currentLoopData = $datas['tenders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="list_block btm7m">
          <div class="tender_list_body">
            <div class="row">
              <div class="col-md-7">
                <p class="greencolor bold">Tender Code : <?php echo e($tender['tender_code']); ?></p>
                <p>
                  <a href="<?php echo e($tender['employer_url']); ?>"  class="bold"> <?php echo e($tender['employer']); ?> </a>
                  
                </p>
                <p><?php echo e($tender['title']); ?></p>
                
              </div>
              <div class="col-md-2">
                <span class="">NRs. <?php echo e($tender['estimate_cost']); ?></span>
              </div>
              <div class="col-md-2">
                <p><?php echo e($tender['difference']); ?></p>
                <p><span class="blueclr"><?php echo e($tender['submission_date']); ?></span></p>
              </div>
              <div class="col-md-1">
                <div class="tender_thumb">
                  <img onclick="viewImage('<?php echo e($tender["id"]); ?>')" src="<?php echo e(asset($tender['thumb'])); ?>" style="cursor: pointer;">
                </div>
              </div>
            </div>
          </div>
          <div class="tp10p">
            <div class="row">  <!-- Tender Sector eg: Civil Works !-->
            <div class="col-md-10">
              <?php if($tender['tender_location'] != ''): ?>
              <span><i class="fa fa-map-marker-alt blueclr"></i> <?php echo e($tender['tender_location']); ?> </span>
              <?php endif; ?>
              <span class="blueclr italic lft10p"><?php echo e($tender['category']); ?></span>
            </div>
            <div class="col-md-2">
              <a href="<?php echo e($tender['href']); ?>" class="btn lightgreen_gradient float-right" >View <i class="fa fa-eye"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade servicemodal" id="tender-image<?php echo e($tender['id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
        <div class="modal-content">              
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <img src="<?php echo e($tender['image']); ?>" style="width: 100%;">
          </div> 
        </div>
      </div>
        
            
          </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     
    </div>
  </div>
  <div class="center">
    <a href="<?php echo e(url('/tenders')); ?>" class="btn browsebtn fffbtn" >Browse all Tenders</a>
  </div>
</div>
</section>
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/front/module/tender_list.blade.php ENDPATH**/ ?>