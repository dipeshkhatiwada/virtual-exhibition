<?php if(count($datas) > 0): ?>
<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="post" id="post<?php echo e($data['id']); ?>">
  <div class="user-block">
    <img class="img-circle img-bordered-sm" src="<?php echo e(asset($data['image'])); ?>" alt="user image">
        <span class="username"><a href="#"><?php echo e($data['name']); ?></a>
          <?php if($data['share_by'] == auth()->guard('employee')->user()->id): ?>
            <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                <ul class="dropdown-menu min_width">
                  <li><a class="dropdown-item" onclick="deletePost(<?php echo e($data['id']); ?>)" href="javascript:void()"><i class="fa fa-remove"></i>Delete</a></li>
                  <li><a class="dropdown-item" onclick="editPost(<?php echo e($data['id']); ?>)" href="javascript:void()"><i class="fa fa-user-edit"></i>Edit</a></li>
                </ul>
              </li>
            </ul>
          <?php endif; ?>
        </span>
        <span class="description greenclr italic">Shared <?php echo e($data['public']); ?> - <?php echo e($data['date_time']); ?></span>
      </div>
       <div class="row cm10-row"><div class="col-12" style="white-space: pre-wrap;" id="activity_title_<?php echo e($data['id']); ?>"><?php echo $data['title']; ?></div></div>
      <?php ($totalimages = count($data['images'])); ?>
      <?php if($data['url_data']): ?>

        <?php if(isset($data['url_data']->id)): ?>
         <div class="row cm10-row">
            <?php if(trim($data['url_data']->video) != ''): ?>
            
              <div class="col-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
                <iframe src="<?php echo e($data['url_data']->video); ?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
              </div>
            <?php elseif(trim($data['url_data']->image) != ''): ?>
              <div class="col-md-12 url-image"><img src="<?php echo e($data['url_data']->image); ?>" alt="<?php echo e($data['url_data']->title); ?>"></div>
            <?php endif; ?>
            <div class="col-md-12">
              <p><a href="<?php echo e($data['url_data']->url); ?>" target="_blank"><strong><?php echo e($data['url_data']->title); ?></strong></a></p><p><?php echo $data['url_data']->description; ?></p></div>
          </div>
        <?php endif; ?>
      <?php elseif($totalimages > 0): ?>
      <?php 
      if ($totalimages > 3) {
            $class = 'col-md-3';
          }elseif ($totalimages == 3) {
            $class = 'col-md-4';
          }
          elseif ($totalimages == 2) {
            $class = 'col-md-6';
          }else{
            $class = 'col-md-12';
          }
          ?>
          <div class="row cm10-row">
          <?php $__currentLoopData = $data['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $aimg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ($aim = \App\Imagetool::mycrop($aimg->image, 300, 300)); ?>
            <div class="<?php echo e($class); ?> aimages"><img src="<?php echo e(asset($aim)); ?>" class="activity_images" data-parent="<?php echo e($data['id']); ?>" data-id="<?php echo e($aimg->id); ?>" alt="<?php echo e($aimg->title); ?>"></div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
      <?php endif; ?>
      <ul class="list-inline tp10p">
        <?php ($liked = 1); ?>
        <?php if(is_array($data['likes'])): ?>
        <?php if(in_array(auth()->guard('employee')->user()->id, $data['likes'])): ?>
        <?php ($liked = 2); ?>
        <?php endif; ?>
        <?php endif; ?>
        
          <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="shareActivity(<?php echo e($data['id']); ?>)"><i class="fa fa-share margin-r-5"></i> Share</a>
          </li>
          <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="viewShare(<?php echo e($data['id']); ?>)">(<?php echo e($data['total_share']); ?>)</a>
          </li>
          <li>
            <a href="javascript:void(0)" class="text-sm activity_like" data-id="<?php echo e($data['id']); ?>" id="like_attr<?php echo e($data['id']); ?>" data-status="<?php echo e($liked); ?>"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="likeText<?php echo e($data['id']); ?>"><?php echo e($liked == 1 ? 'Like' : 'Liked'); ?></span></a>
          </li>
           <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="viewLikes(<?php echo e($data['id']); ?>)">(<span id="totalLike<?php echo e($data['id']); ?>"><?php echo e(count($data['likes'])); ?></span>)</a>
          </li>
          <li class="pull-right">
            <a href="javascript:void(0)" class=" text-sm show-comment-box" onclick="showComment(<?php echo e($data['id']); ?>)"><i class="fa fa-comments margin-r-5"></i> Comments(<span id="total_comment_<?php echo e($data['id']); ?>"><?php echo e(count($data['comments'])); ?></span>)</a>
          </li>
        
      </ul>
      <div class="box-footer">
        <form action="#" method="post">
          <div class="input-group">
            <input type="text" name="message" id="commenttext<?php echo e($data['id']); ?>" placeholder="Type Message ..." class="form-control comment">
            <span class="input-group-btn">
              <button type="button" id="<?php echo e($data['id']); ?>" class="btn greenbg btn-flat commentbutton">Send</button>
            </span>
          </div> 
        </form>
        <div id="comment-box<?php echo e($data['id']); ?>" class="" style="display: none;">
          <?php if(count($data['comments']) > 0): ?>

          <?php $__currentLoopData = $data['comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php ($ids = [$data['share_by'],$comment['comment_by']]); ?>
          <?php ($cliked = 1); ?>
          <?php if(is_array($comment['likes'])): ?>
          <?php if(in_array(auth()->guard('employee')->user()->id, $comment['likes'])): ?>
          <?php ($cliked = 2); ?>
          <?php endif; ?>
          <?php endif; ?>
          <div class=" user-block comment-box" id="comment_box_<?php echo e($comment['id']); ?>">
            <?php if(in_array(auth()->guard('employee')->user()->id,$ids)): ?>
            <div class="comment-delete activity_comment" data-parent="<?php echo e($data['id']); ?>" id="comment_<?php echo e($comment['id']); ?>"><i class="fa fa-remove"></i></div>
            <?php endif; ?>
            <img class="img-circle img-bordered-sm" src="<?php echo e(asset($comment['image'])); ?>" alt="user image">
            <span class="comments"><span class="comment-name"><?php echo e($comment['name']); ?></span><?php echo $comment['comment_text']; ?></span>
            <div class="like-button">
              <span> <a href="javascript:void(0)" class="text-sm comment-like" data-id="<?php echo e($comment['id']); ?>" id="comment-like<?php echo e($comment['id']); ?>" data-status="<?php echo e($cliked); ?>"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="commentlikeText<?php echo e($comment['id']); ?>"><?php echo e($cliked == 1 ? 'Like' : 'Liked'); ?></span></a></span>
              <span><a href="javascript:void(0)" class=" text-sm" onclick="viewcommentLikes(<?php echo e($comment['id']); ?>)">(<span id="totalcommentLike<?php echo e($comment['id']); ?>"><?php echo e(count($comment['likes'])); ?></span>)</a></span>
              <span class="reply-btn"> <a href="javascript:void(0)" class=" text-sm" onclick="showReply(<?php echo e($comment['id']); ?>)"><i class="fa fa-comments margin-r-5"></i> Reply(<span id="total_reply_<?php echo e($comment['id']); ?>"><?php echo e(count($comment['comments'])); ?></span>)</a></span>
              <div id="comment-reply<?php echo e($comment['id']); ?>" style="display: none;">
              <div class=" user-block reply-box">
                
                <div class="input-group reply-group">
                  <img class="img-circle img-bordered-sm" src="<?php echo e(asset(\App\Employees::getPhoto(auth()->guard('employee')->user()->id))); ?>" alt="user image">
                  <input type="text" name="message" id="replytext<?php echo e($comment['id']); ?>" placeholder="Type Message ..." class="form-control reply">
                  <span class="input-group-btn">
                    <button type="button" id="replyid<?php echo e($comment['id']); ?>" data-activity="<?php echo e($data['id']); ?>"  class="btn greenbg btn-flat replybutton">Reply</button>
                  </span>
                </div>
              </div>
              <div id="comment_replies_<?php echo e($comment['id']); ?>"> 
              <?php if(count($comment['comments']) > 0): ?>
              <?php $__currentLoopData = $comment['comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class=" user-block reply-box" id="reply_box_<?php echo e($reply['id']); ?>">
                
                <div class="input-group reply-group">
                  <div class="reply-delete activity_reply_delete" data-parent="<?php echo e($comment['id']); ?>" id="reply_<?php echo e($reply['id']); ?>"><i class="fa fa-remove"></i></div>
                    <img class="img-circle img-bordered-sm" src="<?php echo e(asset(\App\Employees::getPhoto($reply->comment_by))); ?>" alt="user image">
                    <span class="replies"><span class="comment-name"><?php echo e(\App\Employees::getName($reply->comment_id)); ?></span><?php echo $reply->comment; ?></span>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            </div>

            </div>
          
              
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          
        </div>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\rollingnexus\local\resources\views/employee/activity.blade.php ENDPATH**/ ?>