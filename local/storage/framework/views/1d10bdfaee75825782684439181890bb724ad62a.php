<style>
 ._hide {
   visibility : hidden;
 }
</style>
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
                        <label class="required">Fair Details</label>
                        <input type="file" class="form-control" name="fair_detail" id="fair_detail" value=""/>
                    </div>
                </div>


                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="required">No. of Booth Required</label>
                        <select class="form-control" id="number_ofbooth" name="number_ofbooth">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-md-6">
                        <div class="table-responsive-lg">
                            <table class="table table_form table-hover" id="subcategory">
                                <thead>
                                <tr>
                                    <th class="required">Booth/Stall</th>
                                    <th class="required">Type</th>
                                    <th class="required">Price</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="booth_ticket">
                                    <tr id="booth_ticket_0">
                                    <td>
                                        <select class="form-control" id="booth_select" name="booth_select">
                                            <option selected="selected" value="">--Select Booth/Stall--</option>
                                            <?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" id="ticket_type" name="ticket_type">
                                            <option selected="selected" value="0">--Select Ticket Type--</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="price" id="price" value="" disabled>
                                    </td>
                                    <td><button type="button" onclick="$('#booth_ticket_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td colspan="5"><button type="button" onclick="addBoothTicketPrice();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                

                

                <div class="form-group row ">
                    <div class="col-md-6">
                    <label class="required">Intro Video Link</label>
                    <input type="text" id="intro_video_link" name="intro_video_link" class="form-control" placeholder="Youtube/One Drive Link">
                    </div>
                </div>

                <div class="form-group row ">
                    <div class="col-md-6">
                        <label class="required">Banner File Upload (High Quality)</label>
                        <input type="file" class="form-control" name="banner_image" id="banner_image" value="" id="input-thumb" />
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12">
                      <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript">
    booth_ticket = 1;

    function addBoothTicketPrice()
    {
    var html = '<tr id="booth_ticket_'+booth_ticket+'">';

        html += '<td><select class="form-control" id="booth_select" name="booth_select"><option selected="selected" value="">--Select Booth/Stall--</option><?php $__currentLoopData = $booths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booth): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($booth->id); ?>"><?php echo e($booth->booth_name); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select></td>';
        html += '<td><select class="form-control" id="ticket_type" name="ticket_type"><option selected="selected" value="0">--Select Ticket Type--</option></select></td>';
        html += '<td><input type="text" class="form-control" name="price" id="price" value="" disabled></td>'
        html += '<td><button type="button" onclick="$(\'#booth_ticket_'+booth_ticket+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#booth_ticket').append(html);
        booth_ticket++;
    }

</script>
<script type='text/javascript'>

$(document).ready(function(){


    $('#booth_select').change(function(e){
        // Booth id
        var id = $(this).val();
        // Empty the dropdown
        $('#ticket_type').find('option').not(':first').remove();
        // AJAX request

        $.ajax({
            type: 'GET',
            url: 'get-ticket-type/'+id,
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

                        $('#ticket_type').append(option);
                    }
                }

            },
        });
    });

    $('#ticket_type').change(function(){
        // Booth id
        var ticket_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'get-ticket-price/'+ticket_id,
            dataType: 'json',
            success: function(response){
                console.log('success');
                $("#price").val(response.data.price);
            },
        });
    });
});

</script>

<script>
$(document).ready(function(){


        $("#number_ofbooth").change(function(e){
            e.preventDefault();
            // var select_number= $("#number_ofbooth option:selected").text();
            let required_number  = $(this).val();
            if(required_number == 1){
            $("#boot_stall_second").hide();
            }else if(required_number ==2){
                $("#boot_stall_second").show();
            }
        });


});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/test.blade.php ENDPATH**/ ?>