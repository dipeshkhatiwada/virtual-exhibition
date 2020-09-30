<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
      <h3 class="form_heading">Online Exhibition</h3>
        <div class="form_tabbar">
        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="#">
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

                <div class="form-group row ">
                    <div class="col-md-6">
                        <label class="required">Fair Details(.pdf, .doc, .docx)</label>
                        <input type="file" class="form-control" name="fair_detail" id="fair_detail" accept=".pdf, .doc, .docx"/>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-md-6">
                        <div class="table-responsive-lg">
                            <table class="table table_form table-hover" id="item_table">
                                <label class="required">No. of Booth Required</label>
                                <thead>
                                  <tr>
                                    <th>Booth/Stall Name</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th><button type="button" name="add" class="btn lightgreen_gradient right add"><i class="fa fa-plus-circle"></i> Add</button></th>
                                  </tr>
                                </thead>
                                <tbody></tbody>
                              </table>
                        </div>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-md-6">
                    <label class="required">Intro Video Link</label>
                    <input type="text" id="intro_video_link" name="intro_video_link" class="form-control" placeholder="Youtube/One Drive Link" required>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-md-6">
                        <label class="required">Banner File Upload (High Quality)</label>
                        <input type="file" class="form-control" name="banner_image" id="banner_image" accept="image/x-png,image/gif,image/jpeg" required />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
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

        var count = 0;

        $(document).on('click', '.add', function(){
          count++;
          var html = '';
          html += '<tr>';
          html += '<td><select name="booth_name[]" class="form-control booth_name" data-sub_category_id="'+count+'"><option value="">Select Category</option> <?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td>';
          html += '<td><select name="booth_type[]" class="form-control booth_type" id="booth_type'+count+'"><option value="">Select Sub Category</option></select></td>';
          html += '<td><input type="text" name="item_price[]" id="item_price'+count+'" class="form-control item_price"/></td>';
          html += '<td><button type="button" name="remove" class="btn whitegradient remove"><i class="fa fa-minus-circle"></i> Remove</button></td>';
          $('tbody').append(html);
        });

        $(document).on('click', '.remove', function(){
            $(this).closest('tr').remove();
            console.log(count);
        });

        $(document).on('change', '.booth_name', function(){
            var category_id = $(this).val();
            var sub_category_id = $(this).data('sub_category_id');
            $('#booth_type'+sub_category_id).find('option').not(':first').remove();

            $.ajax({
                type: 'get',
                url: 'get-ticket-type/'+category_id,
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
            var booth_type = $(this).data('booth_type');

            $.ajax({
                type: 'GET',
                url: 'get-ticket-price/'+type_id,
                dataType: 'json',
                success: function(response){
                    var price = response.data.price;
                    console.log(price);
                    $("#item_price"+booth_type).val(price);
                },
            });
        });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/test12.blade.php ENDPATH**/ ?>