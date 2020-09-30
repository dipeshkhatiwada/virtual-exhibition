<style>
 ._hide {
   visibility : hidden;
 }
</style>
<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
      <h3 class="form_heading">New Enroll</h3>
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
        <ul class="nav nav-tabs form_tab" id="formTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="enroll-tab" data-toggle="tab" href="#mainenroll" role="tab" aria-controls="enroll" aria-selected="true">Enroll</a>
            </li>                 

        </ul>
        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll-update-nroll', $reservations->id)); ?>">
            <?php echo csrf_field(); ?>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="mainenroll" role="tabpanel" aria-labelledby="enroll-tab">
                    <div class="form-group row ">
                        <div class="col-md-6 <?php echo e($errors->has('exhibition_category') ? ' has-error' : ''); ?> ">
                            <label class="required">Exhibition Category</label>
                            <select class="form-control" name="exhibition_category">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option selected="selected" value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('exhibition_category')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('exhibition_category')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-3 <?php echo e($errors->has('company_name') ? ' has-error' : ''); ?>">
                            <label class="required">Company Name</label>
                        <input class="form-control" name="company_name" title="company_name" id="company_name" placeholder="Company Name" value="<?php echo e($reservations->company_name); ?>">
                            <?php if($errors->has('company_name')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('company_name')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-3 <?php echo e($errors->has('seo_url') ? ' has-error' : ''); ?>">
                            <label class="required">Seo url</label>
                            <input class="form-control" name="seo_url" title="seo_url" id="seo_url" placeholder="seo ulr" value="<?php echo e($reservations->seo_url); ?>">
                            <?php if($errors->has('seo_url')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('seo_url')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 <?php echo e($errors->has('company_site') ? ' has-error' : ''); ?>">
                            <label class="required">Company Website</label>
                            <input class="form-control" name="company_site" title="company_site" placeholder="Company Website" value="<?php echo e($reservations->company_website); ?>">
                            <?php if($errors->has('company_site')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('company_site')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 <?php echo e($errors->has('company_site') ? ' has-error' : ''); ?>">
                            <label class="required">Intro Video Link</label>
                            <input class="form-control" name="intro_video" title="intro_video" placeholder="Youtube Link" value="<?php echo e($reservations->intro_video); ?>">
                            <?php if($errors->has('intro_video')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('intro_video')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6 <?php echo e($errors->has('fair_detail') ? ' has-error' : ''); ?>">
                            <label class="required">Fair Details(.pdf, .doc, .docx)</label>
                            <input type="file" class="form-control" name="fair_detail" id="fair_detail" accept=".pdf, .doc, .docx" value=""/>
                            <?php if($errors->has('fair_detail')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('fair_detail')); ?></strong>
                            </span>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-3 <?php echo e($errors->has('event_date') ? ' has-error' : ''); ?>">
                            <label class="required">Start Date</label>
                            <input type="text"  id="exhibition_date" name="exhibition_date" class="form-control datepicker" value="<?php echo e($reservations->start_date); ?>">
                                <?php if($errors->has('exhibition_date')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('exhibition_date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>

                        <div class="col-md-3 <?php echo e($errors->has('to_date') ? ' has-error' : ''); ?>">
                            <label class="required">End Date</label>
                            <input type="text"  id="to_date" name="to_date" class="form-control datepicker" value="<?php echo e($reservations->end_date); ?>">
                                <?php if($errors->has('to_date')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('to_date')); ?></strong>
                                    </span>
                                <?php endif; ?>
                        </div>

                    </div>

                    <div class="form-group row ">
                        <div class="col-md-12 <?php echo e($errors->has('description') ? ' has-error' : ''); ?> ">
                            <label class="">Company Description</label>
                            <textarea id="description" name="description"><?php echo $reservations->description; ?>"</textarea>
                            <?php if($errors->has('description')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('description')); ?></strong>
                            </span>
                            <?php endif; ?>
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
                </div>
                <!-- <div class="tab-pane fade row" id="assistant" role="tabpanel" aria-labelledby="assistant-tab">
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">Company Speaker/Booth Assistant</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Assistant Link</th>
                                        <th class="required">Meeting ID</th>
                                        <th class="required">Password</th>
                                        <th><button type="button" name="addZoomDetail" class="btn lightgreen_gradient right addZoomDetail"><i class="fa fa-plus-circle"></i> Add</button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_zoom"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>  -->
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <button type="submit" class="btn sendbtn bluebg">Update <i class="fab fa-telegram"></i></button>
                </div>
            </div>
        </form>
        <?php if(Session::has('message')): ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo session('message'); ?></strong>
        </div>
        <?php endif; ?>
    </div>



<script type="text/javascript">
    $('#company_name').blur(function(){
    var data = $(this).val();
    var se_url = data.replace(/ /g,"-");
    $('#seo_url').val(se_url);
});
</script>

<script>
        $(document).ready(function(){
            var limit_to_add = 5;
            count = 1;
            $(document).on('click', '.addVideoLink', function(){
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="video['+count+'][vtitle]" class="form-control" placeholder="Title of Video" required></td>'
                html += '<td><input type="text" name="video['+count+'][vlink]" class="form-control" placeholder="Youtube/One Drive Link" required></td>';
                html += '<td><button type="button" name="remove_video" class="btn whitegradient remove_video"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';


                $('#tbody_video').append(html);
                count ++;

            });

            $(document).on('click', '.remove_video', function(){

                $(this).closest('tr').remove();

            });
        });

</script>

<script>
$(document).ready(function(){
    var limit_to_add = 5;
    count = 1;
    $(document).on('click', '.addZoomDetail', function(){
        var html = '';
        html += '<tr>';
        html += '<td><input type="text" name="zoom['+count+'][zlink]" class="form-control" placeholder="Zoom Link" required></td>';
        html += '<td><input type="text" name="zoom['+count+'][zid]" class="form-control" placeholder="Meeting ID" required></td>';
        html += '<td><input type="password" name="zoom['+count+'][password]"  class="form-control" placeholder="Password" required/></td>';
        html += '<td><button type="button" name="remove_zoom" class="btn whitegradient remove_zoom"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';


        $('#tbody_zoom').append(html);
        count ++;

    });

    $(document).on('click', '.remove_zoom', function(){

        $(this).closest('tr').remove();

    });
});

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
            return '<button type="button" id="button-image" class="btn greenbg sendbtn"><i class="fas fa-pencil-alt"></i></button> <button type="button" id="button-clear" class="btn greenbg sendbtn"><i class="far fa-trash-alt"></i></button>';
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/editenroll.blade.php ENDPATH**/ ?>