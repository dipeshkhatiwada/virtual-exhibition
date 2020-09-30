@if(count($datas) > 0)
@foreach($datas as $data)
<div class="post" id="post{{$data['id']}}">
  <div class="user-block">
    <img class="img-circle img-bordered-sm" src="{{asset($data['image'])}}" alt="user image">
        <span class="username"><a href="#">{{$data['name']}}</a>
          @if($data['share_by'] == auth()->guard('employee')->user()->id)
            <ul class="nav navbar-nav pull-right btn-box-tool blueclr">
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                <ul class="dropdown-menu min_width">
                  <li><a class="dropdown-item" onclick="deletePost({{$data['id']}})" href="javascript:void()"><i class="fa fa-remove"></i>Delete</a></li>
                  <li><a class="dropdown-item" onclick="editPost({{$data['id']}})" href="javascript:void()"><i class="fa fa-user-edit"></i>Edit</a></li>
                </ul>
              </li>
            </ul>
          @endif
        </span>
        <span class="description greenclr italic">Shared {{$data['public']}} - {{$data['date_time']}}</span>
      </div>
       <div class="row cm10-row"><div class="col-12" style="white-space: pre-wrap;" id="activity_title_{{$data['id']}}">{!! $data['title'] !!}</div></div>
      @php($totalimages = count($data['images']))
      @if($data['url_data'])

        @if (isset($data['url_data']->id))
         <div class="row cm10-row">
            @if (trim($data['url_data']->video) != '')
            
              <div class="col-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
                <iframe src="{{$data['url_data']->video}}" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
              </div>
            @elseif(trim($data['url_data']->image) != '')
              <div class="col-md-12 url-image"><img src="{{$data['url_data']->image}}" alt="{{$data['url_data']->title}}"></div>
            @endif
            <div class="col-md-12">
              <p><a href="{{$data['url_data']->url}}" target="_blank"><strong>{{$data['url_data']->title}}</strong></a></p><p>{!! $data['url_data']->description !!}</p></div>
          </div>
        @endif
      @elseif($totalimages > 0)
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
          @foreach ($data['images'] as $key => $aimg)
            @php($aim = \App\Imagetool::mycrop($aimg->image, 300, 300))
            <div class="{{$class}} aimages"><img src="{{asset($aim)}}" class="activity_images" data-parent="{{$data['id']}}" data-id="{{$aimg->id}}" alt="{{$aimg->title}}"></div>
          @endforeach
          </div>
      @endif
      <ul class="list-inline tp10p">
        @php($liked = 1)
        @if (is_array($data['likes']))
        @if (in_array(auth()->guard('employee')->user()->id, $data['likes']))
        @php($liked = 2)
        @endif
        @endif
        
          <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="shareActivity({{$data['id']}})"><i class="fa fa-share margin-r-5"></i> Share</a>
          </li>
          <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="viewShare({{$data['id']}})">({{$data['total_share']}})</a>
          </li>
          <li>
            <a href="javascript:void(0)" class="text-sm activity_like" data-id="{{$data['id']}}" id="like_attr{{$data['id']}}" data-status="{{$liked}}"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="likeText{{$data['id']}}">{{$liked == 1 ? 'Like' : 'Liked'}}</span></a>
          </li>
           <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="viewLikes({{$data['id']}})">(<span id="totalLike{{$data['id']}}">{{count($data['likes'])}}</span>)</a>
          </li>
          <li class="pull-right">
            <a href="javascript:void(0)" class=" text-sm show-comment-box" onclick="showComment({{$data['id']}})"><i class="fa fa-comments margin-r-5"></i> Comments(<span id="total_comment_{{$data['id']}}">{{count($data['comments'])}}</span>)</a>
          </li>
        
      </ul>
      <div class="box-footer">
        <form action="#" method="post">
          <div class="input-group">
            <input type="text" name="message" id="commenttext{{$data['id']}}" placeholder="Type Message ..." class="form-control comment">
            <span class="input-group-btn">
              <button type="button" id="{{$data['id']}}" class="btn greenbg btn-flat commentbutton">Send</button>
            </span>
          </div> 
        </form>
        <div id="comment-box{{$data['id']}}" class="" style="display: none;">
          @if(count($data['comments']) > 0)

          @foreach($data['comments'] as $comment)
          @php($ids = [$data['share_by'],$comment['comment_by']])
          @php($cliked = 1)
          @if (is_array($comment['likes']))
          @if (in_array(auth()->guard('employee')->user()->id, $comment['likes']))
          @php($cliked = 2)
          @endif
          @endif
          <div class=" user-block comment-box" id="comment_box_{{$comment['id']}}">
            @if(in_array(auth()->guard('employee')->user()->id,$ids))
            <div class="comment-delete activity_comment" data-parent="{{$data['id']}}" id="comment_{{$comment['id']}}"><i class="fa fa-remove"></i></div>
            @endif
            <img class="img-circle img-bordered-sm" src="{{asset($comment['image'])}}" alt="user image">
            <span class="comments"><span class="comment-name">{{$comment['name']}}</span>{!! $comment['comment_text'] !!}</span>
            <div class="like-button">
              <span> <a href="javascript:void(0)" class="text-sm comment-like" data-id="{{$comment['id']}}" id="comment-like{{$comment['id']}}" data-status="{{$cliked}}"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="commentlikeText{{$comment['id']}}">{{$cliked == 1 ? 'Like' : 'Liked'}}</span></a></span>
              <span><a href="javascript:void(0)" class=" text-sm" onclick="viewcommentLikes({{$comment['id']}})">(<span id="totalcommentLike{{$comment['id']}}">{{count($comment['likes'])}}</span>)</a></span>
              <span class="reply-btn"> <a href="javascript:void(0)" class=" text-sm" onclick="showReply({{$comment['id']}})"><i class="fa fa-comments margin-r-5"></i> Reply(<span id="total_reply_{{$comment['id']}}">{{count($comment['comments'])}}</span>)</a></span>
              <div id="comment-reply{{$comment['id']}}" style="display: none;">
              <div class=" user-block reply-box">
                
                <div class="input-group reply-group">
                  <img class="img-circle img-bordered-sm" src="{{asset(\App\Employees::getPhoto(auth()->guard('employee')->user()->id))}}" alt="user image">
                  <input type="text" name="message" id="replytext{{$comment['id']}}" placeholder="Type Message ..." class="form-control reply">
                  <span class="input-group-btn">
                    <button type="button" id="replyid{{$comment['id']}}" data-activity="{{$data['id']}}"  class="btn greenbg btn-flat replybutton">Reply</button>
                  </span>
                </div>
              </div>
              <div id="comment_replies_{{$comment['id']}}"> 
              @if(count($comment['comments']) > 0)
              @foreach($comment['comments'] as $reply)
              <div class=" user-block reply-box" id="reply_box_{{$reply['id']}}">
                
                <div class="input-group reply-group">
                  <div class="reply-delete activity_reply_delete" data-parent="{{$comment['id']}}" id="reply_{{$reply['id']}}"><i class="fa fa-remove"></i></div>
                    <img class="img-circle img-bordered-sm" src="{{asset(\App\Employees::getPhoto($reply->comment_by))}}" alt="user image">
                    <span class="replies"><span class="comment-name">{{\App\Employees::getName($reply->comment_id)}}</span>{!! $reply->comment !!}</span>
                </div>
              </div>
              @endforeach
              @endif
            </div>

            </div>
          
              
            </div>
          </div>
          @endforeach
          @endif
          
        </div>
      </div>
    </div>
  @endforeach
@endif
