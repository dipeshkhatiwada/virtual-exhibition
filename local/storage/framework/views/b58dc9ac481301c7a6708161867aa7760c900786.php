<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/bootstrap/css/glyphicon.css')); ?>" />
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/plugins/timepicker/bootstrap-timepicker.min.js')); ?>"></script>
    
<h3 class="form_heading">Edit Training</h3>
        <div class="form_tabbar">
          <?php if(count($errors)): ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e('* : '.$error); ?></br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        
        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(url('/employer/training/update')); ?>">
          <?php echo csrf_field(); ?>

          <input type="hidden" name="id" value="<?php echo e($datas['training']->id); ?>">
          <div class="form-group row ">

             <div class="col-md-6 <?php echo e($errors->has('training_category') ? ' has-error' : ''); ?>">
                  <label class="required">Training Category</label>
                 <select class="form-control" name="training_category">
                   <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if($category->id == $datas['training']->training_category_id): ?>
                   <option selected="selected" value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                   <?php else: ?>
                   <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                   <?php endif; ?>
                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </select>
                  <?php if($errors->has('training_category')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('training_category')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>
            <div class="col-md-6 <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
              <label class="required">Title</label>
              <input type="text" id="training"  name="title" class="form-control" value="<?php echo e($datas['training']->title); ?>">
              <?php if($errors->has('title')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('title')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>

          
          </div>
          <div class="form-group row">
            <div class="col-md-6 <?php echo e($errors->has('seo_url') ? ' has-error' : ''); ?>">
              <label class="required">Seo Url</label>
              <input type="text" id="seo_url" name="seo_url" class="form-control"  value="<?php echo e($datas['training']->seo_url); ?>">
                <?php if($errors->has('seo_url')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('seo_url')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>
            <div class="col-md-6 <?php echo e($errors->has('meta_title') ? ' has-error' : ''); ?>">
              <label class="required">Meta Title</label>
              <input type="text"  id="meta_title" name="meta_title" class="form-control" value="<?php echo e($datas['training']->meta_title); ?>">
              <?php if($errors->has('meta_title')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('meta_title')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group row ">
            
            <div class="col-md-6 <?php echo e($errors->has('meta_keyword') ? ' has-error' : ''); ?>">
              <label class="">Meta Keyword</label>
              <input type="text"  id="meta_keyword" name="meta_keyword" class="form-control" value="<?php echo e($datas['training']->meta_keyword); ?>">
              <?php if($errors->has('meta_keyword')): ?>
              <span class="help-block">
                  <strong><?php echo e($errors->first('meta_keyword')); ?></strong>
              </span>
              <?php endif; ?>
            </div>
             <div class="col-md-6">
              <label class="">Meta Description</label>
              <textarea class="form-control" name="meta_description"><?php echo e($datas['training']->meta_description); ?></textarea>
            </div>
          </div>
           <div class="form-group row ">
            <div class="col-md-6 <?php echo e($errors->has('latitude') ? ' has-error' : ''); ?>">
              <label class="required">Latitude</label>
                  <input type="text" id="latitude" name="latitude" class="form-control" value="<?php echo e($datas['training']->latitude); ?>">
              
                <?php if($errors->has('latitude')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('latitude')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>
             <div class="col-md-6 <?php echo e($errors->has('longitude') ? ' has-error' : ''); ?>">
              <label class="required">Longitude</label>
              <input type="text" id="longitude" name="longitude" class="form-control" value="<?php echo e($datas['training']->longitude); ?>">
                <?php if($errors->has('longitude')): ?>
                  <span class="help-block">
                    <strong><?php echo e($errors->first('longitude')); ?></strong>
                  </span>
                <?php endif; ?>
            </div>
            <div class="center tp10p"><p>Please Visit the link : <a href="https://www.latlong.net/" target="_blank" class="greenclr">Click Here</a> to get latitude and longitude</p></div>
          </div>
         
         
          <div class="form-group row ">
              <div class="col-md-6 <?php echo e($errors->has('venue') ? ' has-error' : ''); ?>">
              <label class="required">Venue</label>
              <input type="text" id="venue"  name="venue" class="form-control" value="<?php echo e($datas['training']->venue); ?>">
              <?php if($errors->has('venue')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('venue')); ?></strong>
                </span>
              <?php endif; ?>
            </div>
            <div class="col-md-6 <?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
              <label class="required">Address</label>
              <input type="text" id="address" name="address" class="form-control"  value="<?php echo e($datas['training']->address); ?>">
              <?php if($errors->has('address')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('address')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            
          </div>
          
          <div class="form-group row ">
            <div class="col-md-6 <?php echo e($errors->has('start_date') ? ' has-error' : ''); ?>">
              <label class="required"> Opening Date</label>
              <input type="text"  id="start_date" name="start_date" class="form-control datepicker" value="<?php echo e($datas['training']->start_date); ?>">
                  <?php if($errors->has('start_date')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('start_date')); ?></strong>
                      </span>
                  <?php endif; ?>
            </div>
            <div class="col-md-6 <?php echo e($errors->has('start_time') ? ' has-error' : ''); ?>">
              <label class="required">Start Time</label>
              <input type="text" id="start_time"  name="start_time" class="form-control timepicker" value="<?php echo e($datas['training']->start_time); ?>">
              <?php if($errors->has('start_time')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('start_time')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            
          </div>
           <div class="form-group row ">
            
            <div class="col-md-6 <?php echo e($errors->has('end_date') ? ' has-error' : ''); ?>">
              <label class="required">Closing Date</label>
              <input type="text"  id="end_date" name="end_date" class="form-control datepicker" value="<?php echo e($datas['training']->end_date); ?>">
                  <?php if($errors->has('end_date')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('end_date')); ?></strong>
                      </span>
                  <?php endif; ?>
            </div>
            <div class="col-md-6 <?php echo e($errors->has('end_time') ? ' has-error' : ''); ?>">
              <label class="required">End Time</label>
              <input type="text" id="end_time"  name="end_time" class="form-control timepicker" value="<?php echo e($datas['training']->end_time); ?>">
              <?php if($errors->has('end_time')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('end_time')); ?></strong>
                </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group row ">
            <div class="col-md-6 <?php echo e($errors->has('image') ? ' has-error' : ''); ?>">
              <label class="required">Training Image</label>
              <a href="" id="training-image" data-toggle="image" class="img-thumbnail">
                <img src="<?php echo e(asset($datas['image'])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas['placeholder'])); ?>" /></a>
              <input type="hidden" name="image" value="<?php echo e($datas['training']->image); ?>" id="input-thumb" />
              <?php if($errors->has('image')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('image')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
            <div class="col-md-6 <?php echo e($errors->has('price') ? ' has-error' : ''); ?>">
              <label class="required">Price</label>
              <input type="text" id="address" name="price" class="form-control"  value="<?php echo e($datas['training']->price); ?>">
              <?php if($errors->has('price')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('price')); ?></strong>
                  </span>
              <?php endif; ?>
            </div>
          </div>
           <div class="form-group row">
           
           <div class="col-md-6">
                  <label>Status </label>
                    <select name="status" class="form-control">
                      <?php $__currentLoopData = $datas['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($datas['training']->status == $status['value']): ?>
                      <option value="<?php echo e($status['value']); ?>" selected="selected"><?php echo e($status['title']); ?></option>
                      
                      <?php else: ?>
                      <option value="<?php echo e($status['value']); ?>" ><?php echo e($status['title']); ?></option>
                      
                      <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
          </div>
          <div class="form-group row ">
            <div class="col-md-12 ">
              <label class="">Training Description</label>
              <textarea id="description" name="description"><?php echo e($datas['training']->description); ?></textarea>
              <script>
                  CKEDITOR.replace('description',
                  {
                                filebrowserBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html")); ?>',
                                filebrowserImageBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Images")); ?>',
                                filebrowserFlashBrowseUrl : '<?php echo e(url("assets/ckfinder/ckfinder.html?type=Flash")); ?>',
                                filebrowserUploadUrl : 
                  '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files")); ?>',
                                filebrowserImageUploadUrl : 
                  '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images")); ?>',
                                filebrowserFlashUploadUrl : '<?php echo e(url("assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash")); ?>',
                                enterMode: CKEDITOR.ENTER_BR
                               } 
                  );
              </script>
            </div>
          </div>
         
          <div class="form-group row">
            <div class="col-md-12">
              <button type="submit" class="btn sendbtn bluebg">Update <i class="fab fa-telegram"></i></button>
            </div>
          </div>
        </form>
</div>    
<script type="text/javascript">
    $('#title').blur(function(){
        var data = $(this).val();
       
        var fleter = data.match(/\b\w/g).join('');

        var se_url = data.replace(/ /g,"-");
       
        $('#seo_url').val(se_url);
        $('#meta_title').val(data);
    });
</script>
<script type="text/javascript">
$.fn.tabs = function() {
  var selector = this;
  
  this.each(function() {
    var obj = $(this); 
    
    $(obj.attr('href')).hide();
    
    $(obj).click(function() {
      $(selector).removeClass('selected');
      
      $(selector).each(function(i, element) {
        $($(element).attr('href')).hide();
      });
      
      $(this).addClass('selected');
      
      $($(this).attr('href')).show();
      
      return false;
    });
  });

  $(this).show();
  
  $(this).first().click();
};
</script>

<script type="text/javascript">
$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
    $('#modal-image').remove();

    $(this).parents('.note-editor').find('.note-editable').focus();

    $.ajax({
      url: '<?php echo e(url("/employer/filemanager")); ?>',
      dataType: 'html',
      beforeSend: function() {
        $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
        $('#button-image').prop('disabled', true);
      },
      complete: function() {
        $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
        $('#button-image').prop('disabled', false);
      },
      success: function(html) {
        $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

        $('#modal-image').modal('show');
      }
    });
  });
  // Image Manager
  $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
    e.preventDefault();

    $('.popover').popover('hide', function() {
      $('.popover').remove();
    });

    var element = this;

    $(element).popover({
      html: true,
      placement: 'right',
      trigger: 'manual',
      content: function() {
        return '<button type="button" id="button-image" class="btn sendbtn greenbg"><i class="fas fa-pencil-alt"></i></button> <button type="button" id="button-clear" class="btn sendbtn greenbg"><i class="far fa-trash-alt"></i></button>';
      }
    });

    $(element).popover('show');

    $('#button-image').on('click', function() {
      $('#modal-image').remove();

      $.ajax({
        url: '<?php echo e(url("/employer/filemanager")); ?>' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
        dataType: 'html',
        beforeSend: function() {
          $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
          $('#button-image').prop('disabled', true);
        },
        complete: function() {
          $('#button-image i').replaceWith('<i class="fa fa-pencil"></i>');
          $('#button-image').prop('disabled', false);
        },
        success: function(html) {
          $('body').append('<div id="modal-image" class="modal" style="display: block; padding-right: 17px;" >' + html + '</div>');

          $('#modal-image').modal('show');
        }
      });

      $(element).popover('hide', function() {
        $('.popover').remove();
      });
    });

    $('#button-clear').on('click', function() {
      $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));

      $(element).parent().find('input').attr('value', '');

      $(element).popover('hide', function() {
        $('.popover').remove();
      });
    });
  });
</script>

<script type="text/javascript">
  $(function(){
    $('.timepicker').timepicker({
      showMeridian:false,
      use24hours:true,
      format: 'HH:mm',
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/training/edittraining.blade.php ENDPATH**/ ?>