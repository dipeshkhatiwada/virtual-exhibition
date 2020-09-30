@extends('employe_master')
@section('heading')
NewsFeed
<small>List of employeFeed</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/employe') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li class="active">NewsFeed</li>
@stop
@section('content')
<style>
    #new_status {
        background-color: #FFF;
        border-radius: 5px;
        box-shadow: 1px 0 10px #AAA;
        font-family: 'Helvetica Neaue', 'Helvetica', sans-serif;
        margin-top: 1rem;
        padding: 0;
    }

    #post_header {
        border-bottom: solid #E8E8E8 1px;
        margin: 0 2%;
        padding: 0.65rem 0;
        width: 95.75%;
    }

    #post_header li {
        display: inline-block;
    }

    #post_header a {
        font-size: 1.2rem;
        padding: 1rem 0;
        text-decoration: none;
    }

    #post_header li+li {
        border-left: solid #E8E8E8 1px;
    }

    #post_header li:first-child a {
        padding: 0 1rem 0 0;
    }

    #post_header li:nth-child(2) a {
        padding: 0 1rem;
    }

    #post_header li:last-child a {
        padding: 0 0 0 1rem;
    }

    #post_header .glyphicon {
        margin-right: 0.5rem;
    }

    #post_content {
        margin: 0 2%;
        padding: 0;
        width: 95.75%;
    }

    #post_content img {
        border: solid #DDD 1px;
        margin: 1.25rem 0;
        padding: 0;
    }

    #post_content .textarea_wrap {
        cursor: text;
    }

    #post_content textarea {
        border: 0;
        margin: 0rem 0 0.5rem 0;
        outline: 0;
        padding: 2.5rem 0 0 1.25rem;
        resize: none;
    }

    .userspost {
        border: 0;
        margin: 0rem 0 0.5rem 0;
        outline: 0;
        padding: 2rem 0 0 1.25rem;
        resize: none;
    }

    #post_footer {
        border-top: solid #E8E8E8 1px;
        line-height: 3rem;
        padding: 0 2% 0 3%;
    }

    #post_footer .navbar-nav {
        padding: 0;
    }

    #post_footer .navbar-nav li {
        display: inline-block;
    }

    #post_footer .navbar-nav a {
        display: block;
        padding: 2rem 1.25rem 2.2rem 1.25rem;
    }

    #post_footer .navbar-nav .glyphicon {
        line-height: 0;
    }

    #post_footer :not(.btn) .glyphicon {
        color: #999;
    }

    #post_footer div {
        padding: 0;
        text-align: right;
    }

    #post_footer .btn {
        border-radius: 2px;
        font-size: 1.2rem;
        font-weight: bold;
        line-height: 2.2rem;
        padding: 0 0.75rem;
        vertical-align: middle;
    }

    #post_footer .btn-default {
        color: #666;
        margin-right: 0.5rem;
    }

    #post_footer .btn-default .glyphicon {
        color: #666;
        margin-right: 0.5rem;
    }

    #post_footer .caret {
        color: #666;
        margin-left: 0.5rem;
    }

    #post_footer .btn-primary {
        padding: 4px 20px;
    }
</style>
<div class="row">
    <div class="alert alert-success" id="post"></div>
    <div class="col-md-12">
            <div id="main_post_content">
        </div>
        <div id="loading" class="col-sm-6">
            <p class="text-center"><img src="{{asset('image/loading.gif')}}" width="100%"></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    function h(e) {
        $(e).css({'height':'65px','overflow-y':'hidden'}).height(e.scrollHeight-30);
    }
    $('textarea').each(function () {
        h(this);
    }).on('input', function () {
        h(this);
    });
</script>
<script>
    //image display via js
    $('#uploadPictureBtn').click(function(e){
        e.preventDefault();
        $('#imageUpload').trigger('click');
    })
    function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://momentjs.com/downloads/moment.min.js"></script>
<script>
    var newsFeedId = '<?php echo $newsFeedId; ?>';
    var token = $('input[name=\'_token\']').val();
    $.ajax({
        url: "{{route('employee.newsfeed.getPostById')}}",
        data:{
            _token: token,
            id: newsFeedId
        },
        type: 'get',
        dataType: 'JSON',
        success:function(data){
            value = data.msg;
            console.log(value)
            var id = value.id
            var image = 'noimage.png';
            if(value.employee.image)
            {
                image = value.employee.image;
            }
            var imageTag = '';
            if(value.image){
                imageTag = '<img src="{{asset("/image")}}'+"/"+value.image+'"alt="" width="100%">';
            }
            var created_at = moment(value.created_at);
            var postTime = created_at.fromNow();
            
            var setting = '';
            if(value.employee_id== '<?php echo auth()->guard("employee")->user()->id; ?>')
            {
                setting = '<div style="position:absolute;top: 0;right:25px;"><div class="dropdown"><a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="left: -120px !important; background-color: #dcdcdc; !important;"><a class="dropdown-item" style="padding-left: 5px;" href="JavaScript:void(0)" onclick="editPost('+value.id+')">Edit</a><a class="dropdown-item" style="padding-left: 5px;" href="JavaScript:void(0)" onclick="deleteNewsFeed('+value.id+')">Delete</a></div></div></div>';
            }

            // var likeSection = '<a href="JavaScript:void(0)" onclick="togglePostLike('+value.id+')" id="postLike'+value.id+'"><i class="fa fa-thumbs-o-up"></i>Like </a>';

            var commentSection = '<a href="JavaScript:void(0)" onclick="commentArea('+value.id+')" id="postComment'+value.id+'"><i class="fa fa-comments"></i> Comment </a>';

            var commentForm = '<br/><div class="row col-md-12"><div class="col-md-10" id="commentForm'+value.id+'"><div class="form-group"><textarea name="comment" id="myComment'+value.id+'" class="form-control" placeholder="comment here.."></textarea></div></div><div class="col-md-2"><button type="button" class="btn btn-info" onclick="submitComment('+value.id+')"><i class="fa fa-paper-plane"></i></button></div></div>';

            poststat(value.id)
            commentsByUser(value.id)

            var html = '<div class="box" id="newFeedBox'+value.id+'"><div class="box-body col-md-6"><div class="col-md-12" id="new_status"><div class="col-xs-12"><div class="textarea_wrap" style="padding: 15px 0 0 15px;"><div class="row"><div class="col-lg-1"><div class="product-img"><img src="{{asset("/image")}}'+"/"+image+'"" alt="Staff Image" class="img-circle" style="object-fit: contain; width:50px; height:50px; border: 1px solid #e4e2e2"></div></div><div class="col-lg-11"><div class="product-info tp7p" style="padding-left: 10px !important"><div class=""><b>'+value.employee.firstname+'</b></div><span style="font-size: 12px; color:grey;">'+postTime+'</span></div>'+setting+'</div></div></div><div class=""><input type="hidden" id="myPostValue'+value.id+'" value="'+value.description+'"><p style="margin: 10px 10px 10px 0; padding-left: 15px; text-align: justify; overflow-wrap: break-word;" id="postDescription'+value.id+'">'+value.description+'</p><p style="margin: 10px 10px 10px 0; padding-left: 15px; text-align: justify; overflow-wrap: break-word;">'+imageTag+'</p></div><div class="box-footer"><div class="col-lg-12" id="postStat'+value.id+'"></p>'+'</div><br><div class="row col-lg-12"><div class="col-lg-6" id="likeSection'+value.id+'"></div><div class="col-lg-6">'+commentSection+'</div></div></div><br><div id="comment_section'+value.id+'" style="display:none;"><div id="comments'+value.id+'"></div>'+commentForm+'</div></div></div></div></div></div><div class="clearfix"></div>'

            $('#main_post_content').html(html);
        },
        error: function(error){
            console.log(error)
        },
        complete: function(data) {
                $('#loading').hide();
            }
    });
    function togglePostLike(id){
        $.ajax({
            url: "{{route('employee.newsfeed.togglePostLike')}}",
            data:{
                _token: token,
                id: id
            },
            type: 'post',
            dataType: 'JSON',
            success:function(data){
                var isDeleted = data.msg;
                if(isDeleted == 'deleted'){
                    $('#postLike'+id).html('<i class="fa fa-thumbs-up"></i> Like')  
                }else{
                    $('#postLike'+id).html('<span style="color: #07b2e6;"><i class="fa fa-thumbs-up"></i> You Like This</span>')
                }
                poststat(id); //post statistics
            },
            error: function(error){

            }
        });
    }
    function poststat(id) //to get total like and comment in real time
    {
        $.ajax({  
            url: "{{route('employee.newsfeed.getPostStat')}}",
            data:{
                _token: token,
                id: id
            },
            type: 'get',
            dataType: 'JSON',
            success:function(data){
                post = data.msg;
                if(post.authLike){
                    $('#likeSection'+id).html('<a href="JavaScript:void(0)" onclick="togglePostLike('+id+')" id="postLike'+id+'"><span style="color: #07b2e6;"><i class="fa fa-thumbs-up"></i> You Like This</span></a>')
                }else{
                    $('#likeSection'+id).html('<a href="JavaScript:void(0)" onclick="togglePostLike('+id+')" id="postLike'+id+'"><i class="fa fa-thumbs-up"></i> Like </a>')
                }
                $('#postStat'+id).html('<p>'+post.like+' Likes and '+post.comment+' comment</p>')
            },
            error:function(error){
                console.log(error)
            }
        })
    }
    function commentArea(id)
    {
        $('#comment_section'+id).toggle();
    }
    function submitComment(id)
    {
        $.ajax({
            url: "{{route('employee.newsfeed.submitComment')}}",
            data:{
                _token: token,
                id: id,
                comment: $('#myComment'+id).val()
            },
            type: 'POST',
            dataType: 'JSON',
            success:function(data){
                console.log(data.msg)
                $('#myComment'+id).val('');
                poststat(id); //post statistics
                commentsByUser(id)
            },
            error:function(error){
                alert('comment is required')
            }
        });
    }
    function commentsByUser(id)
    {
        $.ajax({
            url: "{{route('employee.newsfeed.getCommentByUser')}}",
            data:{
                _token: token,
                id: id,
            },
            type: 'GET',
            dataType: 'JSON',
            success:function(data){
                var comments = data.msg;
                var commentHtml = '';
                if(comments.length == 4){
                    commentHtml = '<p><a href="javascript:void(0)" onclick="moreComment('+id+')" style="color: #07b2e6; margin-left: 15px;">more comments</a></p>';
                }
                $.each(comments, function(index, value){
                    if(index==3){
                        return false;
                    }
                    var image = 'noimage.png';
                    if(value.employee.image)
                    {
                        image = value.employee.image;
                    }
                    var created_at = moment(value.created_at).fromNow()
                    var commentAction = '';
                    if(value.employee_id == '<?php echo auth()->guard("employee")->user()->id; ?>'){
                        commentAction = '<a href="javascript:void(0)" class="text-danger pull-right" onclick="deleteComment('+value.id+')"><i class="fa fa-trash"></i></a>'
                    }
                    commentHtml += '<div style="" id="commentDiv'+value.id+'"><div class="row col-md-12"><div class="col-md-2"><img class="img-circle" src="{{asset("image")}}'+'/'+image+'" style="object-fit: contain; width:50px; height:50px; border: 1px solid #e4e2e2"></div><div class="col-md-10"><p ><b>'+value.employee.firstname+'</b><span style="font-size: 10px; color:grey;" class="pull-right">'+created_at+'</span></p><p class="text-justify">'+value.description+commentAction+'</p></div></div></div>'
                })
                $('#comments'+id).html(commentHtml);
            },
            error:function(error){
                console.log(error)
            }
        });
    }
    function moreComment(id)
    {
        $.ajax({
            url: "{{route('employee.newsfeed.getAllCommentByUser')}}",
            data:{
                _token: token,
                id: id,
            },
            type: 'GET',
            dataType: 'JSON',
            success:function(data){
                var comments = data.msg;
                var commentHtml = '';
                $.each(comments, function(index, value){
                    var image = 'noimage.png';
                    if(value.employee.image)
                    {
                        image = value.employee.image;
                    }
                    var created_at = moment(value.created_at).fromNow()
                    var commentAction = '';
                    if(value.employee_id == '<?php echo auth()->guard("employee")->user()->id; ?>'){
                        commentAction = '<a href="javascript:void(0)" class="text-danger pull-right" onclick="deleteComment('+value.id+')"><i class="fa fa-trash"></i></a>'
                    }
                    commentHtml += '<div style="" id="commentDiv'+value.id+'"><div class="row col-md-12"><div class="col-md-2"><img class="img-circle" src="{{asset("image")}}'+'/'+image+'" style="object-fit: contain; width:50px; height:50px; border: 1px solid #e4e2e2"></div><div class="col-md-10"><p><b>'+value.employee.firstname+'</b><span style="font-size: 10px; color:grey;" class="pull-right">'+created_at+'</span></p><p>'+value.description+commentAction+'</p></div></div></div>'
                })
                $('#comments'+id).html(commentHtml);
            },
            error:function(error){
                console.log(error)
            }
        });
    }
    function deleteNewsFeed(id)
    {
        var check = confirm('Are you sure?')
        if(check == true){
            $.ajax({
                url: "{{route('employee.newsfeed.deleteNewsFeedPost')}}",
                data:{
                    _token: token,
                    id: id,
                },
                type: 'POST',
                dataType: 'JSON',
                success:function(data){
                    console.log(data.msg)
                    $('#newFeedBox'+id).remove();
                    var url = '{{url("employee/newsfeed")}}'
                    location = url;
                },
                error:function(error){
                    console.log(error)
                }
            })
        }
    }
    function deleteComment(id)
    {
        var check = confirm('Are you sure?')
        if(check == true){
            $.ajax({
                url: "{{route('employee.newsfeed.deleteComment')}}",
                data:{
                    _token: token,
                    id: id,
                },
                type: 'POST',
                dataType: 'JSON',
                success:function(data){
                    console.log(data.msg)
                    $('#commentDiv'+id).remove();
                    var newsfeedId = data.msg
                    poststat(newsfeedId)
                },
                error:function(error){
                    console.log(error)
                }
            })
        }
    }
    function editPost(id)
    {
        var description = $('#myPostValue'+id).val();
        var editpostHtml = '<div class="col-md-10" id="editForm'+id+'"><div class="form-group"><textarea name="comment" id="myPostEdit'+id+'" class="form-control">'+description+'</textarea></div></div><div class="col-md-2"><button type="button" class="btn btn-info" onclick="submitEditPost('+id+')"><i class="fa fa-paper-plane"></i></button></div>';
        $('#postDescription'+id).html(editpostHtml);
    }
    function submitEditPost(id)
    {
       $.ajax({
            url: "{{route('employee.newsfeed.postCommentByUser')}}",  //post edit
            data:{
                _token: token,
                id: id,
                status: $('#myPostEdit'+id).val()
            },
            type: 'POST',
            dataType: 'JSON',
            success:function(data){
                console.log(data.msg)
                value = data.msg
                var image = 'noimage.png';
                if(value.employee.image)
                {
                    image = value.employee.image;
                }
                var imageTag = '';
                if(value.image){
                    imageTag = '<img src="{{asset("/image")}}'+"/"+value.image+'"alt="" width="100%">';
                }
                var created_at = moment(value.created_at);
                var postTime = created_at.fromNow();
                
                var setting = '';
                if(value.employee_id== '<?php echo auth()->guard("employee")->user()->id; ?>')
                {
                    setting = '<div style="position:absolute;top: 0;right:25px;"><div class="dropdown"><a class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="left: -120px !important; background-color: #dcdcdc; !important;"><a class="dropdown-item" style="padding-left: 5px;" href="JavaScript:void(0)" onclick="editPost('+value.id+')">Edit</a><a class="dropdown-item" style="padding-left: 5px;" href="JavaScript:void(0)" onclick="deleteNewsFeed('+value.id+')">Delete</a></div></div></div>';
                }

                var likeSection = '<a href="JavaScript:void(0)" onclick="togglePostLike('+value.id+')" id="postLike'+value.id+'"><i class="fa fa-thumbs-up"></i> Like </a>';

                var commentSection = '<a href="JavaScript:void(0)" onclick="commentArea('+value.id+')" id="postComment'+value.id+'"><i class="fa fa-comments"></i> Comment </a>';

                var commentForm = '<br/><div class="row col-md-12"><div class="col-md-10" id="commentForm'+value.id+'"><div class="form-group"><textarea name="comment" id="myComment'+value.id+'" class="form-control"></textarea></div></div><div class="col-md-2"><button type="button" class="btn btn-info" onclick="submitComment('+value.id+')"><i class="fa fa-paper-plane"></i></button></div></div>';

                poststat(value.id)
                commentsByUser(value.id)
                var updateHtml = '<div class="box" id="newFeedBox'+value.id+'"><div class="box-body col-md-6"><div class="col-md-12" id="new_status"><div class="col-xs-12"><div class="textarea_wrap" style="padding: 15px 0 0 15px;"><div class="row"><div class="col-lg-1"><div class="product-img"><img src="{{asset("/image")}}'+"/"+image+'"" alt="Staff Image" class="img-circle" style="object-fit: contain; width:50px; height:50px; border: 1px solid #e4e2e2"></div></div><div class="col-lg-11"><div class="product-info tp7p" style="padding-left: 10px !important"><div class=""><b>'+value.employee.firstname+'</b></div><span style="font-size: 12px; color:grey;">'+postTime+'</span></div>'+setting+'</div></div></div><div class=""><input type="hidden" id="myPostValue'+value.id+'" value="'+value.description+'"><p style="margin: 10px 10px 10px 0; padding-left: 15px; text-align: justify; overflow-wrap: break-word;" id="postDescription'+value.id+'">'+value.description+'</p><p style="margin: 10px 10px 10px 0; padding-left: 15px; text-align: justify; overflow-wrap: break-word;">'+imageTag+'</p></div><div class="box-footer"><div class="col-lg-12" id="postStat'+value.id+'"></p>'+'</div><br><div class="row col-lg-12"><div class="col-lg-6" id="likeSection'+value.id+'"></div><div class="col-lg-6">'+commentSection+'</div></div></div><br><div id="comment_section'+value.id+'" style="display:none;"><div id="comments'+value.id+'"></div>'+commentForm+'</div></div></div></div></div></div><div class="clearfix"></div>'
                $('#newFeedBox'+id).html(updateHtml);
            },
            error:function(error){
                console.log(error)
            }
        }) 
    }
    
</script>

@stop()