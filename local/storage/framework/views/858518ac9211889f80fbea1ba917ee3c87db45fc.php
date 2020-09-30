<?php $__env->startSection('content'); ?>
<script src="<?php echo e(asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/jquery-ui.css')); ?>">
<script src="<?php echo e(asset('assets/dist/js/jquery-ui.js')); ?>"></script>
      
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
                <a class="nav-link active" id="enroll-tab" data-toggle="tab" href="#category" role="tab" aria-controls="enrolls" aria-selected="true">Enroll Category</a>
            </li>
            </ul>
            <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(route('enroll_type.save')); ?>">
                <?php echo csrf_field(); ?>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="category" role="tabpanel" aria-labelledby="enroll-tab">

                        <div class="form-group row ">
                            <div class="col-md-5">
                            <label class="required">Enroll Type</label>
                                <select class="form-control" name="enroll_type">
                                <option selected="selected" value="1">1</option>
                                <option value="">2</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-md-6">
                                <label>Title</label>
                                <div class="field_wrapper" style="width:550px; margin-right:3px; margin-top:5px">
                                    <input type="text" id="title[]"  name="title[]" class="form-control" placeholder="Entroll Category" required>
                                    <a href="javascript:void(0);" class="btn lightgreen_gradient right add_button" title="Add field"><i class="fa fa-plus-circle">Add</i></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                            <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>


<script type="text/javascript">

   $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="field_wrapper">'+
                                '<input type="text" id="title[]"  name="title[]" class="form-control" placeholder="Entroll Category" style="width: 550px; margin-right:3px; margin-top:5px" required />'+
                                '<a href="javascript:void(0);" class="btn whitegradient redclr right remove_button"><i class="fa fa-minus-circle">Remove</i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/enroll/category.blade.php ENDPATH**/ ?>