<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo e(count($datas['employers'])); ?></h3>

              <p>Total Active Employers</p>
            </div>
            <div class="icon">
              <i class="fa fa-suitcase"></i>
            </div>
            <a href="<?php echo e(url('/admin/employers')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo e(count($datas['jobs'])); ?></h3>

              <p>Total Active Jobs</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="<?php echo e(url('/admin/jobs')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo e(count($datas['users'])); ?></h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo e(url('/admin/user')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo e($datas['total_employes']); ?></h3>

              <p>Total Employees</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo e(url('/admin/employees')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
      <section class="col-lg-6 connectedSortable ui-sortable">
      	<div class="box box-info">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3>
              <!-- tools box -->
              
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <form action="#" method="post">
                

                         <div class="form-group<?php echo e($errors->has('subject') ? ' has-error' : ''); ?>">
                            
                                <input type="text" name="subject" placeholder="subject" class="form-control" value="<?php echo e(old('subject')); ?>">

                                <?php if($errors->has('subject')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            
                        </div>

                        <div class="form-group<?php echo e($errors->has('from') ? ' has-error' : ''); ?>">
                           
                                <input type="email" placeholder="mail from" name="from" class="form-control" value="<?php echo e(old('from')); ?>">

                                <?php if($errors->has('from')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('from')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            
                        </div>
                        <div class="form-group<?php echo e($errors->has('to') ? ' has-error' : ''); ?>">
                           
                                <input type="email" placeholder="mail to" name="to" class="form-control" value="<?php echo e(old('to')); ?>">

                                <?php if($errors->has('to')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('to')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            
                        </div>
                         <div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
                          
                                <textarea id="message" class="form-control" name="message"><?php echo e(old('message')); ?></textarea>
                                <script>
      
       
                                    CKEDITOR.replace('message',
                                    {
                                        filebrowserBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html")); ?>',
                                        filebrowserImageBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Images")); ?>',
                                        filebrowserFlashBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Flash")); ?>',
                                        filebrowserUploadUrl : '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")); ?>',
                                        filebrowserImageUploadUrl : '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")); ?>',
                                        filebrowserFlashUploadUrl : '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")); ?>',
                                        enterMode: CKEDITOR.ENTER_BR
                                    });
                                   
                                    
                                 
                                </script>
                                <?php if($errors->has('message')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            
                        </div>
                        
                        <div class="box-footer clearfix">
			              <button type="submit" class="pull-right btn btn-default" id="sendEmail">Send
			                <i class="fa fa-arrow-circle-right"></i></button>
			            </div>
              </form>
            </div>
            
          </div>
      	
      </section>
      <section class="col-lg-6 connectedSortable ui-sortable">
      	<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Active jobs</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
              <ul class="todo-list ui-sortable">
              	<?php if(count($datas['jobs']) > 0): ?>
              	<?php $__currentLoopData = $datas['jobs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <!-- drag handle -->
                  <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                 
                  <span class="text"><?php echo e($job->title); ?></span>
                  <!-- Emphasis label -->
                  <a href="<?php echo e(url('/admin/jobs/application/'.$job->id)); ?>" target="_blank"><small class="label label-danger"><i class="fa fa-clock-o"></i>  Application</small></a>
                   <small class="label label-success"><i class="fa fa-clock-o"></i> <?php echo e(\App\RecruitmentProcess::getTitle($job->process_status)); ?> Application</small>
                  <!-- General tools such as edit or delete-->
                  <div class="tools">
                  	<a href="<?php echo e(url('/admin/jobs/view/'.$job->id)); ?>" target="_blank">
                    <i class="fa fa-arrow-circle-right"></i> </a>
                    
                  </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                
                
                
                
              </ul>
            </div>
           
            
          </div>
      </section>
      </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>