<?php $__env->startSection('heading'); ?>
Edit Event
<small>Detail of Edit Event</small>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrubm'); ?>
<li><a href="<?php echo e(url('/admin')); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li><a href="<?php echo e(url('/admin/project')); ?>">Events</a></li>
<li class="active">Edit Event</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="<?php echo e(asset('assets/ckeditor/ckeditor.js')); ?>"></script>
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
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Event</div>
                <div class="panel-body">
                    <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="<?php echo e(url('/admin/event/update')); ?>">
                        
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="id" value="<?php echo e($datas['mainevent']->id); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#mainevent" data-toggle="tab">Event</a></li>
                                    <li><a href="#photo" data-toggle="tab">Images</a></li>
                                    <li><a href="#sponsor" data-toggle="tab">Sponsors</a></li>
                                    
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="mainevent">
                                        <div class="form-group row ">
                                            <div class="col-md-4 <?php echo e($errors->has('employer') ? ' has-error' : ''); ?>">
                                                <label class="required">Employer</label>
                                                <input type="text" class="form-control" id="emp" name="emp" value="<?php echo e(\App\Employers::getName($datas['mainevent']->employers_id)); ?>">
                                                <input type="hidden" name="employer" id="employer" value="<?php echo e($datas['mainevent']->employers_id); ?>">
                                                <?php if($errors->has('employer')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('employer')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4 <?php echo e($errors->has('event_category') ? ' has-error' : ''); ?>">
                                                <label class="required">Event Category</label>
                                                <select class="form-control" name="event_category">
                                                    <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($category->id == $datas['mainevent']->event_category_id): ?>
                                                    <option selected="selected" value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                                    <?php else: ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('event_category')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('event_category')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4 <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                                                <label class="required">Title</label>
                                                <input type="text" id="title"  name="title" class="form-control" value="<?php echo e($datas['mainevent']->title); ?>">
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
                                                <input type="text" id="seo_url" name="seo_url" class="form-control"  value="<?php echo e($datas['mainevent']->seo_url); ?>">
                                                <?php if($errors->has('seo_url')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('seo_url')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 <?php echo e($errors->has('meta_title') ? ' has-error' : ''); ?>">
                                                <label class="required">Meta Title</label>
                                                <input type="text"  id="meta_title" name="meta_title" class="form-control" value="<?php echo e($datas['mainevent']->meta_title); ?>">
                                                <?php if($errors->has('meta_title')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('meta_title')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6 <?php echo e($errors->has('meta_keyword') ? ' has-error' : ''); ?>">
                                                <label class="">Meta Keyword</label>
                                                <input type="text"  id="meta_keyword" name="meta_keyword" class="form-control" value="<?php echo e($datas['mainevent']->meta_keyword); ?>">
                                                <?php if($errors->has('meta_keyword')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('meta_keyword')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="">Meta Discription</label>
                                                <textarea class="form-control" name="meta_description"><?php echo e($datas['mainevent']->meta_description); ?></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group row ">
                                            
                                            <div class="col-md-6 <?php echo e($errors->has('venue') ? ' has-error' : ''); ?>">
                                                <label class="required">Venue</label>
                                                <input type="text" id="venue"  name="venue" class="form-control" value="<?php echo e($datas['mainevent']->venue); ?>">
                                                <?php if($errors->has('venue')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('venue')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 <?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                                                <label class="required">Address</label>
                                                <input type="text" id="address" name="address" class="form-control"  value="<?php echo e($datas['mainevent']->address); ?>">
                                                <?php if($errors->has('address')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('address')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            
                                            <div class="col-md-6 <?php echo e($errors->has('latitute') ? ' has-error' : ''); ?>">
                                                <label class="required">Latitude</label>
                                                <input type="text" id="latitute" name="latitute" class="form-control"  value="<?php echo e($datas['mainevent']->latitute); ?>">
                                                <?php if($errors->has('latitute')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('latitute')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 <?php echo e($errors->has('longitute') ? ' has-error' : ''); ?>">
                                                <label class="required">Longitude</label>
                                                <input type="text" id="longitute" name="longitute" class="form-control"  value="<?php echo e($datas['mainevent']->longitute); ?>">
                                                <?php if($errors->has('longitute')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('longitute')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="center tp10p"><p>Please Visit the link : <a href="https://www.latlong.net/" target="_blank" class="greenclr">Click Here</a> to get latitute and longitute</p></div>
                                        </div>
                                        
                                        
                                        
                                        
                                        <div class="form-group row ">
                                            <div class="col-md-6 <?php echo e($errors->has('video') ? ' has-error' : ''); ?>">
                                                <label >Video</label>
                                                <input type="text"  id="video" name="video" class="form-control" value="<?php echo e($datas['mainevent']->video); ?>">
                                                <?php if($errors->has('video')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('video')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 <?php echo e($errors->has('event_image') ? ' has-error' : ''); ?>">
                                                <label class="required">Event Image</label>
                                                <a href="" id="user-image" data-toggle="image" class="img-thumbnail">
                                                <img src="<?php echo e(asset($datas['image'])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas['placeholder'])); ?>" /></a>
                                                <input type="hidden" name="event_image" value="<?php echo e($datas['mainevent']->image); ?>" id="input-thumb" />
                                                <?php if($errors->has('event_image')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('event_image')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-md-6 <?php echo e($errors->has('start_date') ? ' has-error' : ''); ?>">
                                                <label class="required">Start Date</label>
                                                <input type="text"  id="event_date" name="event_date" class="form-control datepicker" value="<?php echo e($datas['mainevent']->event_date); ?>">
                                                <?php if($errors->has('start_date')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('start_date')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-6 <?php echo e($errors->has('to_date') ? ' has-error' : ''); ?>">
                                                <label class="required">End Date</label>
                                                <input type="text"  id="to_date" name="to_date" class="form-control datepicker" value="<?php echo e($datas['mainevent']->to_date); ?>">
                                                <?php if($errors->has('to_date')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('to_date')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            </div>
                                            <div class="from-group row">
                                                <div class="col-md-4 <?php echo e($errors->has('start_time') ? ' has-error' : ''); ?>">
                                                <label class="required">Start Time</label>
                                                <input type="text"  id="start_time" name="start_time" class="form-control timepicker" value="<?php echo e($datas['mainevent']->start_time); ?>">
                                                <?php if($errors->has('start_time')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('start_time')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4 <?php echo e($errors->has('end_time') ? ' has-error' : ''); ?>">
                                                <label class="required">End Time</label>
                                                <input type="text"  id="end_time" name="end_time" class="form-control timepicker" value="<?php echo e($datas['mainevent']->end_time); ?>">
                                                <?php if($errors->has('end_time')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('end_time')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Status </label>
                                                <select name="status" class="form-control">
                                                    <?php $__currentLoopData = $datas['status']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($datas['mainevent']->status == $status['value']): ?>
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
                                                <label>Event Discription</label>
                                                <textarea id="description" name="description"><?php echo e($datas['mainevent']->description); ?></textarea>
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
                                    <div class="tab-pane" id="photo">
                                        <div class="col-md-12">
                                            <table class="table table_form table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="event_photo">
                                                    <?php $__currentLoopData = $datas['photos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr id="photo_<?php echo e($key); ?>">
                                                        <td><input type="text" name="photo[<?php echo e($key); ?>][title]" class="form-control" value="<?php echo e($photo['title']); ?>"></td>
                                                        <td>
                                                            <a href="" id="event_image<?php echo e($key); ?>" data-toggle="image" class="img-thumbnail">
                                                                <img src="<?php echo e(asset($photo["thumb"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" />
                                                            </a>
                                                            <input type="hidden" name="photo[<?php echo e($key); ?>][image]" value="<?php echo e($photo['image']); ?>" id="image-thumb<?php echo e($key); ?>">
                                                        </td>
                                                        <td><button type="button" onclick="$('#photo_<?php echo e($key); ?>').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="3"><button type="button" onclick="addPhoto();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Photo</button></td>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="sponsor">
                                        <div class="col-md-12">
                                            <table class="table table_form table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Logo</th>
                                                        <th>Url</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="event_sponsor">
                                                    <?php $__currentLoopData = $datas['sponsors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr id="sponsor_<?php echo e($key); ?>">
                                                        <td><input type="text" name="sponsor[<?php echo e($key); ?>][name]" class="form-control" value="<?php echo e($sponsor['name']); ?>"></td>
                                                        <td>
                                                            <a href="" id="sponsorlogo_<?php echo e($key); ?>" data-toggle="image" class="img-thumbnail">
                                                            <img src="<?php echo e(asset($sponsor["logo_thumb"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a>
                                                            <input type="hidden" name="sponsor[<?php echo e($key); ?>][logo]" value="<?php echo e($sponsor['logo']); ?>" id="sponsor-thumb<?php echo e($key); ?>">
                                                        </td>
                                                        <td><input type="text" name="sponsor[<?php echo e($key); ?>][url]" class="form-control" value="<?php echo e($sponsor['url']); ?>"></td>
                                                        <td><button type="button" onclick="$('#sponsor_<?php echo e($key); ?>').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="4"><button type="button" onclick="addSponsor();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Sponsor</button></td>
                                                </tr>
                                                </tfoot>
                                            </table>
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
                        
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
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
var photo_row = 1;
function addPhoto()
{
var html = '<tr id="photo_'+photo_row+'"><td><input type="text" name="photo['+photo_row+'][title]" class="form-control" value=""></td>';
html += '<td><a href="" id="event_image'+photo_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a><input type="hidden" name="photo['+photo_row+'][image]" id="image-thumb'+photo_row+'"></td>';
html += '<td><button type="button" onclick="$(\'#photo_'+photo_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
$('#event_photo').append(html);
photo_row++;
}
var sponsor_row = 1;
function addSponsor()
{
var html ='<tr id="sponsor_'+sponsor_row+'"><td><input type="text" name="sponsor['+sponsor_row+'][name]" class="form-control" value=""></td>';

html += '<td><a href="" id="sponsorlogo_'+sponsor_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a><input type="hidden" name="sponsor['+sponsor_row+'][logo]" id="sponsor-thumb'+sponsor_row+'"></td>';
html += '<td><input type="text" name="sponsor['+sponsor_row+'][url]" class="form-control"></td>';
html += '<td><button type="button" onclick="$(\'#sponsor_'+sponsor_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
$('#event_sponsor').append(html);
sponsor_row++;
}
</script>
<script type="text/javascript">
$(document).delegate('button[data-toggle=\'image\']', 'click', function() {
$('#modal-image').remove();
$(this).parents('.note-editor').find('.note-editable').focus();
$.ajax({
url: '<?php echo e(url('/admin/filemanager')); ?>',
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
return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
}
});
$(element).popover('show');
$('#button-image').on('click', function() {
$('#modal-image').remove();
$.ajax({
url: '<?php echo e(url('/admin/filemanager')); ?>' + '?target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
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
$('#emp').autocomplete({
source: '<?php echo e(url("/admin/employers/autocomplete/")); ?>',
minlength:1,
autoFocus:true,
select:function(e,ui){
$('#employer').val(ui.item.id);
}
});
</script>

<script type="text/javascript">
   $(function () {
    $('.timepicker').timepicker({
      
      'timeFormat': 'H:i:s',
    });


});
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/admin/event/editform.blade.php ENDPATH**/ ?>