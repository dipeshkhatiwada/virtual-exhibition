@extends('front.women-master')
@section('header')
@include($datas['header'])
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="section rollingable sports-main tp80p">
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        @foreach($datas['top_content'] as $tcontent)
        <?php echo $tcontent['module']; ?>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif
<?php if (count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-7 col-12';
} else{
$class = 'col-md-12';
} ?>
<section class="section rollingable sports-main tp80p">
  <div class="container rn_container">
  <div class="row">
    
    <div class="{{$class}}">
      
          <h1 class="head-title btm10m">{{$datas['blog']['title']}}</h1>
        
       <span class="sub-title pb-4"><i class="far fa-user"></i> {{$datas['blog']['publisher']}} <span></span><i class="far fa-clock"></i> {{$datas['blog']['publish_date']}}<span></span> <i class="far fa-eye"> </i> {{$datas['blog']['views']}}<span></span> <i class="far fa-comment"> </i> {{count($datas['blog']['comments'])}}</span>
       @if($datas['blog']['image'] != '')
       <div class="main-img pt-2">
                    <div class="img-box">
                        <img src="{{asset($datas['blog']['image'])}}">
                        <div class="overlay">  
                        </div> 
                    </div>
                </div>
       @endif
     <div class="desc pt-3 btm15m"><?php echo $datas['blog']['description'];?></div>
     @if($datas['blog']['video'] != '')
     <div class="desc pt-3 btm15m">
       @php($links=str_replace('watch?v=', 'embed/', $datas['blog']['video']))

                <div class="col-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
 <iframe src="<?php echo $links;?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
</div>
                
     </div>
     @endif
     @if(isset(Auth::guard('employee')->user()->firstname))
              <div class="list_block btm7m">
                 @if (Session::has('alert-danger'))
                                            <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                                              @endif
                                              @if (Session::has('alert-success'))
                                            <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                                              @endif
                 <form id="ratingsForm" method="post" action="{{url('/comments/blog')}}" class="dash_forms" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                   <input type="hidden" name="comment_id" value="">
                  <input type="hidden" name="blog_id" value="{{$datas['blog']['id']}}">
                    <div class="form-group row {{ $errors->has('comment') ? ' has-error' : '' }}">
                         <label for="employer" class="col-md-12 rating-label required">Comment</label>
                            <div class="col-md-12">
                                  <textarea class="form-control" name="comment">{{old('comment')}}</textarea>
                                  @if ($errors->has('comment'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('comment') }}</strong>
                                  </span>
                                  @endif
                            </div>
                    </div>
                  
                  <div class="form-group row">
                        

                            <div class="col-md-12">
                                  <button type="submit" class="btn bluebg sendbtn right">Submit</button>
                            </div>
                    </div>
                  </form>
              </div>
              @endif
      @if(count($datas['blog']['comments']) > 0)
              <h2 class="title_three blueclr italic btm10m tp10m">Recent Comments</h2>
               @foreach($datas['blog']['comments'] as $rating)
              <div class="list_block btm7m">
               
               
                @php($image = \App\Employees::getPhoto($rating->employees_id))
                @php($comment_by = \App\Employees::getName($rating->employees_id))
                @php($comments = \App\BlogComment::getSubComment($rating->id))
                <div class="row">
                 <div class="col-lg-1 col-md-2 col-sm-2 col-12">
                    <div class="bidder_image center">
                      <img src="{{asset($image)}}" alt="{{$comment_by}}" style="width: 60px; height: 60px;">
                    </div>
                  </div>
                  <div class="col-lg-11 col-md-10 col-sm-10 col-12">
                    <h2 class="title_two btm7m">{{$comment_by}}<span><i>{{$rating->created_at}}</i></span></h2>
                    <p><?php echo $rating->comment;?></p>
                    <p><span class="sub-title pb-4"><span id="{{$rating->id}}" class="like pointer"><i class="fa fa-thumbs-up"></i> <i id="like_{{$rating->id}}">{{$rating->like}}</i></span><span></span><span id="{{$rating->id}}" class="dislike pointer"><i class="fa fa-thumbs-down"></i> <i id="dislike_{{$rating->id}}">{{$rating->dislike}}</i></span><span></span> <span id="{{$rating->id}}" class="comment pointer" data-toggle="collapse" href="#colapsComments{{$rating->id}}" role="button" aria-expanded="false" aria-controls="colapsComments{{$rating->id}}"><i class="far {{count($comments) > 0 ? 'fa fa-comment-dots' : 'fa-comment'}}"></i> {{count($comments)}}</span></span>
                       @if(isset(Auth::guard('employee')->user()->firstname))
               
              <a href="javascript::void()" onclick="ReplyComment({{$rating->id}})" class="btn lightgreen_gradient btm7m right">Reply</a>
              
              
              @else
              <a class="btn lightgreen_gradient btm7m right" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Reply</a>
              @endif
                      
                    </p>
                    @if(count($comments) > 0)
                    <div class="collapse" id="colapsComments{{$rating->id}}">
                      @foreach($comments as $comment)
                       @php($comment_image = \App\Employees::getPhoto($comment->employees_id))
                      @php($comment_comment_by = \App\Employees::getName($comment->employees_id))
                    <div class="card card-body btm7m" style="width: 100%;">
                      <div class="row">
                      <div class="col-lg-2 col-md-3 col-sm-3 col-12">
                                      <div class="bidder_image center">
                                        <img src="{{asset($comment_image)}}" alt="{{$comment_comment_by}}" style="width: 60px; height: 60px;">
                                      </div>
                                    </div>
                                    <div class="col-lg-10 col-md-9 col-sm-3 col-12">
                                      <h2 class="title_two btm7m">{{$comment_comment_by}}<span><i>{{$comment->created_at}}</i></span></h2>
                                      <p><?php echo $comment->comment;?></p>
                                      <p><span class="sub-title pb-4"><span id="{{$comment->id}}" class="like pointer"><i class="fa fa-thumbs-up"></i> <i id="like_{{$comment->id}}">{{$comment->like}}</i></span><span></span><span id="{{$comment->id}}" class="dislike pointer"><i class="fa fa-thumbs-down"></i> <i id="dislike_{{$comment->id}}">{{$comment->dislike}}</i></span></span>
                                        
                                      </p>
                                    </div>
                                  </div>
                    </div>
                    @endforeach
                   
                  </div>
                    @endif
                  
                  </div>
                </div>
               
              </div>

               @endforeach
               
              @endif
        @foreach($datas['main_modules'] as $main_module)
        <?php echo $main_module['module']; ?>
        @endforeach
      </div>
      @if (count($datas['right_content']) > 0)
      <aside class="col-lg-3 col-md-5 col-12">
        @foreach($datas['right_content'] as $rcontent)
        <?php echo $rcontent['module']; ?>
        @endforeach
      </aside>
      @endif
    </div>
    </div>
  </section>
  @if(count($datas['bottom_content']) > 0)
  <section id="bottom_content" class="tb10p">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @foreach($datas['bottom_content'] as $bcontent)
          <?php echo $bcontent['module']; ?>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
        <form  method="post" action="{{url('/comments/blog')}}" class="dash_forms" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <input type="hidden" name="blog_id" value="{{$datas['blog']['id']}}">
                  <input type="hidden" name="comment_id" id="comment_id" value="">
                    <div class="form-group row {{ $errors->has('comment') ? ' has-error' : '' }}">
                         <label for="employer" class="col-md-12 rating-label required">Comment</label>
                            <div class="col-md-12">
                                  <textarea class="form-control" name="comment">{{old('comment')}}</textarea>
                                  @if ($errors->has('comment'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('comment') }}</strong>
                                  </span>
                                  @endif
                            </div>
                    </div>
                  
                  <div class="form-group row">
                        

                            <div class="col-md-12">
                                  <button type="submit" class="btn bluebg sendbtn right">Submit</button>
                            </div>
                    </div>
                  </form>
      </div>
     
    </div>
  </div>
</div>
  <script type="text/javascript">
    function ReplyComment(comment_id) {
      $('#comment_id').val(comment_id);
      $('#commentModal').modal('show');
    }
    $('.like').on('click', function() {
      var comment_id = $(this).attr('id');
      var likes = $('#like_'+comment_id).html();
      
      if (comment_id > 0) {
        var token = $('input[name=\'_token\']').val();
      
     
      $.ajax({
            type: "POST",
            url: "{{url('/comments/blog/like')}}",
            data: '_token='+token+'&comment_id='+comment_id+'&type=Like',
            success: function(data){
              var datas = data.split('|');
             if (datas[0] == 'Success') {
              var newnum = Number(likes) + Number(1);
              $('#like_'+comment_id).html(newnum);
             }
              else{
                alert(datas[1]);
              }
            }
        });
      
      }
    })

    $('.dislike').on('click', function() {
      var comment_id = $(this).attr('id');
      var likes = $('#dislike_'+comment_id).html();
      
      if (comment_id > 0) {
        var token = $('input[name=\'_token\']').val();
      
     
      $.ajax({
            type: "POST",
            url: "{{url('/comments/blog/like')}}",
            data: '_token='+token+'&comment_id='+comment_id+'&type=Dislike',
            success: function(data){
              var datas = data.split('|');
             if (datas[0] == 'Success') {
              var newnum = Number(likes) + Number(1);
              $('#dislike_'+comment_id).html(newnum);
             }
              else{
                alert(datas[1]);
              }
            }
        });
      
      }
    })
  </script>
  @stop