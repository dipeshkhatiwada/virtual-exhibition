@php($liked = 1)
        @if (is_array($datas['likes']))
        @if (in_array(auth()->guard('employee')->user()->id, $datas['likes']))
        @php($liked = 2)
        @endif
        @endif

<div id="comment_field_top">
        <div class="user-block">
        <img class="img-circle img-bordered-sm" id="upload_by_image" src="{{asset($datas['image'])}}" alt="user image">
        <span class="username"><a href="#" id="upload_by_name">{{$datas['name']}}</a>
         
        </span>
        <span class="description greenclr italic" id="upload_status">Shared {{$datas['public']}} - {{$datas['date_time']}}</span>
      </div>
      <div class="row cm10-row"><div class="col-12" style="white-space: pre-wrap;">{!! $datas['title'] !!}</div></div>
      <ul class="list-inline tp10p">
     
        
          
          <li>
            <a href="javascript:void(0)" class="text-sm image_like" data-id="{{$datas['id']}}"  data-status="{{$liked}}"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="image_like_text">{{$liked == 1 ? 'Like' : 'Liked'}}</span></a>
          </li>
           <li>
            <a href="javascript:void(0)" class=" text-sm" onclick="viewImageLikes({{$datas['id']}})">(<span id="total_image_like">{{count($datas['likes'])}}</span>)</a>
          </li>
          <li class="pull-right">
            <a href="javascript:void(0)" class=" text-sm show-comment-box" onclick="showImageComment({{$datas['id']}})"><i class="fa fa-comments margin-r-5"></i> Comments(<span id="total_image_comment">{{count($datas['comments'])}}</span>)</a>
          </li>
        
      </ul>
      <div class=" user-block reply-box">
                
                <div class="input-group reply-group">
                  <img class="img-circle img-bordered-sm" src="{{asset(\App\Employees::getPhoto(auth()->guard('employee')->user()->id))}}" alt="user image">
                  <input type="text" name="message" id="comment_text_{{$datas['id']}}" placeholder="Type Message ..." class="form-control photo_comment">
                  
                </div>
              </div>
            </div>
        <div id="image_comment_box">
          @if(count($datas['comments']) > 0)

          @foreach($datas['comments'] as $comment)
          @php($ids = [$datas['share_by'],$comment['comment_by']])
          @php($cliked = 1)
          @if (is_array($comment['likes']))
          @if (in_array(auth()->guard('employee')->user()->id, $comment['likes']))
          @php($cliked = 2)
          @endif
          @endif
          <div class=" user-block comment-box" id="image_comment_box_{{$comment['id']}}">
            @if(in_array(auth()->guard('employee')->user()->id,$ids))
            <div class="comment-delete image_comment_delete" data-parent="{{$datas['id']}}" id="comment_{{$comment['id']}}"><i class="fa fa-remove"></i></div>
            @endif
            <img class="img-circle img-bordered-sm" src="{{asset($comment['image'])}}" alt="user image">
            <span class="comments"><span class="comment-name">{{$comment['name']}}</span>{!! $comment['comment_text'] !!}</span>
            <div class="like-button">
              <span> <a href="javascript:void(0)" class="text-sm image_comment_like" data-id="{{$comment['id']}}" id="image_comment_like{{$comment['id']}}" data-status="{{$cliked}}"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="commentimagelikeText{{$comment['id']}}">{{$cliked == 1 ? 'Like' : 'Liked'}}</span></a></span>
              <span><a href="javascript:void(0)" class=" text-sm" onclick="viewimagecommentLikes({{$comment['id']}})">(<span id="totalimagecommentLike{{$comment['id']}}">{{count($comment['likes'])}}</span>)</a></span>
              <span class="reply-btn"> <a href="javascript:void(0)" class=" text-sm" onclick="showimageReply({{$comment['id']}})"><i class="fa fa-comments margin-r-5"></i> Reply(<span id="total_image_reply_{{$comment['id']}}">{{count($comment['comments'])}}</span>)</a></span>
              <div id="image_comment_reply{{$comment['id']}}" style="display: none;">
              <div class=" user-block reply-box">
                
                <div class="input-group reply-group">
                  <img class="img-circle img-bordered-sm" src="{{asset(\App\Employees::getPhoto(auth()->guard('employee')->user()->id))}}" alt="user image">
                  <input type="text" name="message" data-parent="{{$datas['id']}}" data-id="{{$comment['id']}}" placeholder="Type Message ..." class="form-control photo_comment_reply">
                 
                </div>
              </div>
              <div id="image_comment_replies_{{$comment['id']}}"> 
              @if(count($comment['comments']) > 0)
              @foreach($comment['comments'] as $reply)
              <div class=" user-block reply-box" id="image_reply_box_{{$reply['id']}}">
                
                <div class="input-group reply-group">
                  <div class="reply-delete image_reply_delete" data-parent="{{$comment['id']}}" id="image_reply_{{$reply['id']}}"><i class="fa fa-remove"></i></div>
                    <img class="img-circle img-bordered-sm" src="{{asset(\App\Employees::getPhoto($reply->comment_by))}}" alt="user image">
                    <span class="replies"><span class="comment-name">{{\App\Employees::getName($reply->comment_by)}}</span>{!! $reply->comment !!}</span>
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



