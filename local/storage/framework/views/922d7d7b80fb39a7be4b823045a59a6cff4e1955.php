<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
      <h3 class="form_heading">Online Exhibition</h3>
        <div class="form_tabbar">
            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll.addnew')); ?>">
                <?php echo csrf_field(); ?>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="mainevent" role="tabpanel" aria-labelledby="event-tab">
                    <div class="form-group row ">
                        <div class="col-md-6 ">
                            <label class="required">Exhibition Category</label>
                            <select class="form-control" name="exhibition_category">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option selected="selected" value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="required">Company Name</label>
                            <input class="form-control" name="company_name" title="company_name" placeholder="Company Name" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="required">Company Website</label>
                            <input class="form-control" name="company_site" title="company_site" placeholder="Company Website" required>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label class="required">Fair Details(.pdf, .doc, .docx)</label>
                            <input type="file" class="form-control" name="fair_detail" id="fair_detail" accept=".pdf, .doc, .docx"/>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label class="required">Intro Video Link</label>
                            <table class="table table_form table-hover" id="item_table">                             >
                                <thead>
                                <tr>
                                    <th class="required">Video Link</th>
                                    <th><button type="button" name="addVideoLink" class="btn lightgreen_gradient right addVideoLink"><i class="fa fa-plus-circle"></i> Add</button></th>
                                </tr>
                                </thead>
                                <tbody id="tbody_video"></tbody>
                            </table>
                        
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label class="required">Banner File Upload (High Quality)</label>
                            <input type="file" class="form-control" name="banner_image" id="banner_image" accept="image/x-png,image/gif,image/jpeg" required />
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <label class="required">Company Gallery</label>
                                <table class="table table_form table-hover">
                                    <thead>
                                    <tr>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="company_photo">
                                        <tr id="photo_0">
                                        <td><input type="text" name="photo[0][title]" class="form-control" value="<?php echo e(old('photo[0][title]')); ?>"></td>
                                        <td>
                                            <a href="" id="company_image0" data-toggle="image" class="img-thumbnail">
                                            <img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" />
                                            </a>
                                            <input type="hidden" name="photo[0][image]" id="image-thumb0">
                                        </td>
                                        <td><textarea type="text" name="photo[0][description]" id="photo-description"></textarea></td>
                                        <td><button type="button" onclick="$('#photo_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <td colspan="3"><button type="button" onclick="addPhoto();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Photo</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">No. of Booth Required</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Booth/Stall Name</th>
                                        <th class="required">Type</th>
                                        <th class="required">Price</th>
                                        <th><button type="button" name="add" class="btn lightgreen_gradient right add"><i class="fa fa-plus-circle"></i> Add</button></th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody_booth"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <div class="col-md-6">
                            <div class="table-responsive-lg">
                                <table class="table table_form table-hover" id="item_table">
                                    <label class="required">Company Speaker/Booth Assistant</label>
                                    <thead>
                                    <tr>
                                        <th class="required">Zoom Link</th>
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

                    <div class="form-group row ">
                        <div class="col-md-12 ">
                            <label class="">Company Description</label>
                            <textarea id="description" name="description"><?php echo e(old('description')); ?></textarea>
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
                        <div class="col-md-6">
                        <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                        </div>
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
<script>
        $(document).ready(function(){
            var limit_to_add = 5;
            count = 1;
            $(document).on('click', '.addVideoLink', function(){
                var html = '';
                html += '<tr>';
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

<script type="text/javascript">
    var photo_row = 1;
    function addPhoto()
    {
        var html = '<tr id="photo_'+photo_row+'"><td><input type="text" name="photo['+photo_row+'][title]" class="form-control" value=""></td>';
            html += '<td><a href="" id="company_image'+photo_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a><input type="hidden" name="photo['+photo_row+'][image]" id="image-thumb'+photo_row+'"></td>';
            html += ' <td><textarea type="text" name="photo['+photo_row+'][description]" id="photo-description"></textarea></td>';
            html += '<td><button type="button" onclick="$(\'#photo_'+photo_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

            $('#company_photo').append(html);
            photo_row++;
    }
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
<script>
$(document).ready(function(){

        var count = 0;

        $(document).on('click', '.add', function(){
          count++;
          var html = '';
          html += '<tr>';
          html += '<td><select name="booth_name[]" class="form-control booth_name" data-sub_category_id="'+count+'"><option value="">Select Category</option> <?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td>';
          html += '<td><select name="booth_type[]" class="form-control booth_type" id="booth_type'+count+'" data-sub_type_id="'+count+'"><option value="">Select Sub Category</option></select></td>';
          html += '<td><input type="text" name="item_price[]" id="item_price'+count+'" class="form-control item_price"/></td>';
          html += '<td><button type="button" name="remove_booth" class="btn whitegradient remove_booth"><i class="fa fa-minus-circle"></i> Remove</button></td>';
          $('#tbody_booth').append(html);
          count++;
        });

        $(document).on('click', '.remove_booth', function(){
            $(this).closest('tr').remove();
            console.log(count);
        });

        $(document).on('change', '.booth_name', function(){
            var category_id = $(this).val();
            var sub_category_id = $(this).data('sub_category_id');
            $('#booth_type'+sub_category_id).find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: 'get-booth-type/'+category_id,
                dataType: 'json',
                success: function(response){
                    var len = 0;
                    if(response['data'] != null){
                        len = response['data'].length;
                    }
                    if(len > 0){
                        // Read data and create <option >
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var ticket_name = response['data'][i].ticket_name;
                            var option = "<option value='"+id+"'>"+ticket_name+"</option>";
                            $('#booth_type'+sub_category_id).append(option);
                        }
                    }

                },
            });
        });

        $(document).on('change', '.booth_type', function(){
            var type_id = $(this).val();
            var sub_type_id = $(this).data('sub_type_id');

            $.ajax({
                type: 'GET',
                url: 'get-booth-price/'+type_id,
                dataType: 'json',
                success: function(response){
                    var price = response.data.price;
                    console.log(price);
                    $("#item_price"+sub_type_id).val(price);
                },
            });
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

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/newenroll.blade.php ENDPATH**/ ?>