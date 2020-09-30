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
      <h3 class="form_heading">New Event</h3>
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
              <a class="nav-link active" id="event-tab" data-toggle="tab" href="#mainevent" role="tab" aria-controls="events" aria-selected="true">Event</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="photo-tab" data-toggle="tab" href="#photo" role="tab" aria-controls="photo" aria-selected="false">Photo</a>
          </li>
           <li class="nav-item">
              <a class="nav-link" id="sponsor-tab" data-toggle="tab" href="#sponsor" role="tab" aria-controls="sponsor" aria-selected="false">Sponsor</a>
          </li>
        </ul>
        <form class="dash_forms" enctype="multipart/form-data" role="form" id="testform" method="POST" action="<?php echo e(url('/employer/event/save')); ?>">
          <?php echo csrf_field(); ?>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="mainevent" role="tabpanel" aria-labelledby="event-tab">
              <div class="form-group row ">
                <div class="col-md-6 <?php echo e($errors->has('event_category') ? ' has-error' : ''); ?>">
                  <label class="required">Event Category</label>
                 <select class="form-control" name="event_category">
                   <?php $__currentLoopData = $datas['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if($category->id == old('event_category')): ?>
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
                <div class="col-md-6 <?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                  <label class="required">Title</label>
                  <input type="text" id="title"  name="title" class="form-control" value="<?php echo e(old('title')); ?>">
                  <?php if($errors->has('title')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('title')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group row ">
                  <div class="col-md-2 <?php echo e($errors->has('event_type') ? ' has-error' : ''); ?>">
                    <label class="required">Event Type</label>
                    <select class="form-control" name="event_type" id="event_type" onChange="showExternalUrl()">
                        <option value=""  selected disabled>Select...</option>
                        <option value="1"  <?php if(old('event_type') == 1): ?> <?php echo e('selected'); ?> <?php endif; ?>>Virtual Event</option>
                        <option value="2" <?php if(old('event_type') == 2): ?> <?php echo e('selected'); ?> <?php endif; ?>>External Event</option>
                    </select>
                    <?php if($errors->has('event_type')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('event_type')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>

                  <div class="col-md-2 <?php echo e($errors->has('ticket_type') ? ' has-error' : ''); ?>">
                    <label class="required">Ticket Type</label>
                    <select class="form-control" name="ticket_type" id="ticket_type" value=<?php echo e(old('ticket_type')); ?>>
                        <option value=""  selected disabled>Select...</option>
                        <option value="1"  <?php if(old('ticket_type') == 1): ?> <?php echo e('selected'); ?> <?php endif; ?>>Free Ticket</option>
                        <option value="2" <?php if(old('ticket_type') == 2): ?> <?php echo e('selected'); ?> <?php endif; ?>>Normal Ticket</option>
                        <option value="3" <?php if(old('ticket_type') == 3): ?> <?php echo e('selected'); ?> <?php endif; ?>>Special Ticket Types</option>
                    </select>
                    <?php if($errors->has('ticket_type')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('ticket_type')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>

                  <!-- <div class="col-md-1 <?php echo e($errors->has('free_event') ? ' has-error' : ''); ?>">
                    <label>Free Event</label>
                    <input type="checkbox" id="free_event"  name="free_event" value="1">
                    <?php if($errors->has('free_event')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('free_event')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div> -->
                  <div class="col-md-2 <?php echo e($errors->has('price') ? ' has-error' : '_hide'); ?> " id="price_div">
                    <label>Price</label>
                    <input type="number" id="price"  name="price" class="form-control" value="<?php echo e(old('price')); ?>">
                    <?php if($errors->has('price')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('price')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-6 <?php echo e($errors->has('external_url') ? ' has-error' : ''); ?>" style="<?php if(old('event_type')== 2 || old('event_type')!= ''): ?> <?php echo e('visibility: visible'); ?> <?php else: ?> <?php echo e('visibility: hidden'); ?> <?php endif; ?>" id="external_url_div">
                    <label class="required">External Link</label>
                    <input type="text" id="external_url"  name="external_url" class="form-control" value="<?php echo e(old('external_url')); ?>">
                    <?php if($errors->has('external_url')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('external_url')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
              </div>

              <div class="form-group row ">
                <div class="col-md-12">
                  <!-- <label >Add Ticket Type</label> &nbsp; -->
                  <!-- <input type="checkbox" name="add_ticket_type" class="form_control" onClick="toggleTicketTypeTable()" value="1"> -->
                  <div class="table-responsive-lg">
                    <table class="table table_form table-hover  <?php echo e($errors->has('special_ticket.*.*') ? ' has-error' : 'hidden'); ?>" id="ticketTypeTable">
                      <thead>
                        <tr>
                          <th class="required">Ticket Name</th>
                          <th class="required">Price</th>
                          <th class="required">Description</th>
                          <th class="required">Capacity</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody id="special_ticket">
                          <tr id="special_ticket_0">
                            <td><input type="text" name="special_ticket[0][name]" class="form-control" value="<?php echo e(old('special_ticket[0][title]')); ?>"></td>
                            <td><input type="number" name="special_ticket[0][price]" class="form-control" value="<?php echo e(old('special_ticket[0][price]')); ?>"></td>
                            <td><input type="text" name="special_ticket[0][description]" class="form-control" value="<?php echo e(old('special_ticket[0][description]')); ?>"></td>
                            <td><input type="number" name="special_ticket[0][capacity]" class="form-control" value="<?php echo e(old('special_ticket[0][capacity]')); ?>"></td>
                            <td><button type="button" onclick="$('#special_ticket_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                          </tr>
                      </tbody>
                      <tfoot>
                          <tr>
                            <td colspan="5"><button type="button" onclick="addSpecialTicket();" data-toggle="tooltip" title="Add Form" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Ticket Type</button></td>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-group row ">
                  <div class="col-md-2 <?php echo e($errors->has('participants_limit') ? ' has-error' : ''); ?>">
                    <label>No Participant Limit</label><br>
                    <input type="checkbox" id="participants_limit"  name="participants_limit" value="1">
                    <?php if($errors->has('participants_limit')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('participants_limit')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <div class="col-md-4 <?php echo e($errors->has('participants_max_limit') ? ' has-error' : ''); ?>">
                    <label>Participants Max Limit</label>
                    <input type="number" id="participants_max_limit"  name="participants_max_limit" class="form-control" value="<?php echo e(old('participants_max_limit')); ?>">
                    <?php if($errors->has('participants_max_limit')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('participants_max_limit')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
              </div>

              <div class="form-group row ">
                <div class="col-md-6 <?php echo e($errors->has('seo_url') ? ' has-error' : ''); ?>">
                  <label class="required">Seo Url</label>
                  <input type="text" id="seo_url" name="seo_url" class="form-control"  value="<?php echo e(old('seo_url')); ?>">
                    <?php if($errors->has('seo_url')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('seo_url')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 <?php echo e($errors->has('meta_title') ? ' has-error' : ''); ?>">
                  <label class="required">Meta Title</label>
                  <input type="text"  id="meta_title" name="meta_title" class="form-control" value="<?php echo e(old('meta_title')); ?>">
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
                  <input type="text"  id="meta_keyword" name="meta_keyword" class="form-control" value="<?php echo e(old('meta_keyword')); ?>">
                  <?php if($errors->has('meta_keyword')): ?>
                  <span class="help-block">
                      <strong><?php echo e($errors->first('meta_keyword')); ?></strong>
                  </span>
                  <?php endif; ?>
                </div>

                 <div class="col-md-6">
                  <label class="">Meta Description</label>
                  <textarea class="form-control" name="meta_description"><?php echo e(old('meta_description')); ?></textarea>
                </div>
                </div>
                <div class="form-group row">
                   <div class="col-md-6 <?php echo e($errors->has('venue') ? ' has-error' : ''); ?>">
                  <label>Venue</label>
                  <input type="text" id="venue"  name="venue" class="form-control" value="<?php echo e(old('venue')); ?>">
                  <?php if($errors->has('venue')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('venue')); ?></strong>
                    </span>
                  <?php endif; ?>
                </div>
                 <div class="col-md-6 <?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                  <label>Address</label>
                  <input type="text" id="address" name="address" class="form-control"  value="<?php echo e(old('address')); ?>">
                  <?php if($errors->has('address')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('address')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>

                </div>
               <div class="form-group row">
                <div class="col-md-6 <?php echo e($errors->has('latitute') ? ' has-error' : ''); ?>">
                  <label class="required">Latitude</label>
                  <input type="text" id="latitute" name="latitute" class="form-control"  value="<?php echo e(old('latitute')); ?>">
                    <?php if($errors->has('latitute')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('latitute')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                 <div class="col-md-6 <?php echo e($errors->has('longitute') ? ' has-error' : ''); ?>">
                  <label class="required">Longitude</label>
                  <input type="text" id="longitute" name="longitute" class="form-control"  value="<?php echo e(old('longitute')); ?>">
                    <?php if($errors->has('longitute')): ?>
                      <span class="help-block">
                        <strong><?php echo e($errors->first('longitute')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="center tp10p"><p>Please Visit the link : <a href="https://www.latlong.net/" target="_blank" class="greenclr">Click Here</a> to get latitude and longitute</p></div>
              </div>

              <div class="form-group row ">
                 <div class="col-md-6 <?php echo e($errors->has('video') ? ' has-error' : ''); ?>">
                  <label >Video Link</label>
                  <input type="text"  id="video" name="video" class="form-control" value="<?php echo e(old('video')); ?>">
                  <?php if($errors->has('video')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('video')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>
                <div class="col-md-6 <?php echo e($errors->has('event_image') ? ' has-error' : ''); ?>">
                  <label class="required">Event Image</label>
                  <a href="" id="user-image" data-toggle="image" class="img-thumbnail">
                    <img src="<?php echo e(asset($datas['placeholder'])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas['placeholder'])); ?>" /></a>
                  <input type="hidden" name="event_image" value="" id="input-thumb" />

                  <?php if($errors->has('event_image')): ?>
                      <span class="help-block">
                          <strong><?php echo e($errors->first('event_image')); ?></strong>
                      </span>
                  <?php endif; ?>
                </div>

              </div>
              <div class="form-group row ">
               <div class="col-md-6 <?php echo e($errors->has('event_date') ? ' has-error' : ''); ?>">
                    <label class="required">Start Date</label>
                    <input type="text"  id="event_date" name="event_date" class="form-control datepicker" value="<?php echo e(old('event_date')); ?>">
                        <?php if($errors->has('event_date')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('event_date')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>

                <div class="col-md-6 <?php echo e($errors->has('to_date') ? ' has-error' : ''); ?>">
                    <label class="required">End Date</label>
                    <input type="text"  id="to_date" name="to_date" class="form-control datepicker" value="<?php echo e(old('to_date')); ?>">
                        <?php if($errors->has('to_date')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('to_date')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>

                </div>
                <div class="form-group row">
                    <div class="col-md-4 <?php echo e($errors->has('start_time') ? ' has-error' : ''); ?>">
                    <label class="required">Start Time</label>
                    <input type="text"  id="start_time" name="start_time" class="form-control timepicker" value="<?php echo e(old('start_time')); ?>">
                        <?php if($errors->has('start_time')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('start_time')); ?></strong>
                            </span>
                        <?php endif; ?>
                </div>
                <div class="col-md-4 <?php echo e($errors->has('end_time') ? ' has-error' : ''); ?>">
                    <label class="required">End time</label>
                    <input type="text"  id="end_time" name="end_time" class="form-control timepicker" value="<?php echo e(old('end_time')); ?>">
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
                      <?php if(old('status') == $status['value']): ?>
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
                  <label class="">Event Description</label>
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
            </div>
            <div class="tab-pane fade row" id="photo" role="tabpanel" aria-labelledby="photo-tab">
                <div class="col-12">
                  <div class="table-responsive-lg">
                    <table class="table table_form table-hover">
                      <thead>
                        <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="event_photo">
                          <tr id="photo_0">
                            <td><input type="text" name="photo[0][title]" class="form-control" value="<?php echo e(old('photo[0][title]')); ?>"></td>
                            <td>
                              <a href="" id="event_image0" data-toggle="image" class="img-thumbnail">
                                <img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" />
                              </a>
                              <input type="hidden" name="photo[0][image]" id="image-thumb0">
                            </td>
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
            <div class="tab-pane fade row" id="sponsor" role="tabpanel" aria-labelledby="sponsor-tab">
                <div class="col-12">
                  <div class="table-responsive-lg">
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
                          <tr id="sponsor_0">
                            <td><input type="text" name="sponsor[0][name]" class="form-control" value=""></td>
                            <td>
                              <a href="" id="sponsorlogo_0" data-toggle="image" class="img-thumbnail">
                                <img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a>
                              <input type="hidden" name="sponsor[0][logo]" id="sponsor-thumb0">
                            </td>
                            <td><input type="text" name="sponsor[0][url]" class="form-control"></td>
                            <td><button type="button" onclick="$('#sponsor_0').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                          </tr>
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
          </div>
          <div class="form-group row">
            <div class="col-md-12">
              <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
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
  var photo_row = 1;
  var ticket_row = 1;
  function addPhoto()
  {
    var html = '<tr id="photo_'+photo_row+'"><td><input type="text" name="photo['+photo_row+'][title]" class="form-control" value=""></td>';
        html += '<td><a href="" id="event_image'+photo_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a><input type="hidden" name="photo['+photo_row+'][image]" id="image-thumb'+photo_row+'"></td>';
        html += '<td><button type="button" onclick="$(\'#photo_'+photo_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#event_photo').append(html);
        photo_row++;
  }

  function addSpecialTicket()
  {
    var html = '<tr id="special_ticket_'+ticket_row+'"><td><input type="text" name="special_ticket['+ticket_row+'][name]" class="form-control" value=""></td>';
        html += '<td><input type="number" name="special_ticket['+ticket_row+'][price]" class="form-control" value=""></td>';
        html += '<td><input type="text" name="special_ticket['+ticket_row+'][description]" class="form-control" value=""></td>';
        html += '<td><input type="number" name="special_ticket['+ticket_row+'][capacity]" class="form-control" value=""></td>';
        html += '<td><button type="button" onclick="$(\'#special_ticket_'+ticket_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#special_ticket').append(html);
        ticket_row++;
  }

  var sponsor_row = 1;
  function addSponsor()
  {
    var html ='<tr id="sponsor_'+sponsor_row+'"><td><input type="text" name="sponsor['+sponsor_row+'][name]" class="form-control" value=""></td>';

        html += '<td><a href="" id="sponsorlogo_'+sponsor_row+'" data-toggle="image" class="img-thumbnail"><img src="<?php echo e(asset($datas["placeholder"])); ?>" alt="" title="" data-placeholder="<?php echo e(asset($datas["placeholder"])); ?>" /></a><input type="hidden" name="sponsor['+sponsor_row+'][logo]" id="sponsor-thumb'+sponsor_row+'"></td>';
        html += '<td><input type="text" name="sponsor['+sponsor_row+'][url]" class="form-control"></td>';
        html += '<td><button type="button" onclick="$(\'#sponsor_'+sponsor_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';

        $('#event_sponsor').append(html);
        sponsor_row++;
  }
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
<script>
    function showExternalUrl() {
      if ($("#event_type").val() == 2) {
        $("#external_url_div").css({"visibility": "visible"});
        $("#longitute").prop('disabled', false);
        $("#latitute").prop('disabled', false);
      } else {
        $("#external_url_div").css({"visibility": "hidden"});
        $("#longitute").val('').prop('disabled', 'disabled');
        $("#latitute").val('').prop('disabled', 'disabled');
      }
    }

    $("#ticket_type").on("click change",function(){
      let val = $(this).val();
      if(val == 1)
      {
        $("#price_div").addClass('_hide');
        $("#ticketTypeTable").addClass('hidden');
        $("#participants_limit").removeAttr("disabled");
        $("#participants_max_limit").removeAttr("disabled");
      } else if (val == 2) {
        $("#ticketTypeTable").addClass('hidden');
        $("#price_div").removeClass('_hide');
        $("#participants_limit").removeAttr("disabled");
        $("#participants_max_limit").removeAttr("disabled");
      }  else if (val == 3) {
        $("#price_div").addClass('_hide');
        $("#ticketTypeTable").removeClass('hidden');
        $("#participants_max_limit").val('').attr("disabled", true);
        $("#participants_limit").attr("disabled", true);
      }
    });

    $("#participants_limit").on("click", function() {
      if (this.checked) {
        $("#participants_max_limit").val('').attr("disabled", true);
      } else {
        $("#participants_max_limit").removeAttr("disabled");
      }
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employer_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employer/event/newevent.blade.php ENDPATH**/ ?>