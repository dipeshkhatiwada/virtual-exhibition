var base_url = window.location.origin+'/rollingnexus';
var user_image = $('#user_image').val();
var receiver_id = '';
var my_id = $('#my_id').val();
var pusher_key = $('#pusher_key').val();
var interval;
var document_title = document.title; 
var boxinterval;


//Ganga
var receiver_bid = $("#b_id").val();
var slug = $("#c_slug").val();
//

$(document).ready(function(){
    var lmore = $('#datalode').val();
    $('#public-post').val('1');

    $(".txtInput").val('');
    $("#url-detail").html('');
    $('#url-title').val('');
    $('#url-description').val('');
    $('#url-image').val('');
    $('#url-video').val('');
    $('#image-session').val('1');
    $('#lodemore').val(lmore);
    $('#page').val('1');
     $('#url_id').val('');
    $('#web_url').val('');

    var bodyheight = $('.image-content').height();
    var comment_top = $('#comment_field_top').height();
    comment_top = Number(comment_top) + Number(25);
    $("#image-field").height(bodyheight - 20);
    $("#comment-field").height(bodyheight - 20);
    $('#image_comment_box').height(bodyheight - comment_top);
          


    $(window).on("resize",function() {

          var bodyheight = $('.image-content').height();
    $("#image-field").height(bodyheight - 20);
    $("#comment-field").height(bodyheight - 20);
    $('#image_comment_box').height(bodyheight - comment_top);
     });

    $(".scores").hover(function () {
        $(this).find(".tool").toggle();
    })
    // getContactUsers();
  
    // getBusinessUser(receiver_bid);

    setInterval(function(){
        // getContactUsers() // this will run after every 5 seconds
        // getBusinessUser(receiver_bid);

    }, 60000);

    

    //preser start here

    Pusher.logToConsole = false;

    var pusher = new Pusher(pusher_key, {
      cluster: 'ap2',
      'useTLS':true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data));
      if (my_id == data.from) {
                $('#contact_user_' + data.to).trigger( "click" );
            } else if (my_id == data.to) {
                if(data.data_type)
                {
                   
                    var div = document.getElementById('chat_main_'+data.from);
               
                       if (div) {
                        $('#chat_message_' + data.from +' .unread_message').append('<i class="fa fa-check" aria-hidden="true"></i>');
                        $('#chat_message_' + data.from+' li').removeClass('unread_message');
                        $('#chat_message_' + data.from +' #chat_writing').remove();
                        $('#chat_message_' + data.from).append(data.html);
                        scrollToBottomFunc();

                       

                        setTimeout(function() {
                            $('#chat_message_' + data.from +' #chat_writing').remove();
                        }, 15000);



                       }

                }else{

               var div = document.getElementById('chat_main_'+data.from);
               
               if (div) {
                $('#chat_message_' + data.from +' #chat_writing').remove();
                $('#chat_message_' + data.from).append(data.html);
                scrollToBottomFunc();
               }else{
                $('#contact_user_' + data.from).trigger( "click" );
               }

               if(document.hidden) {
                playSound();
                 pageBlink(data.sender_name);
                 
                
               } 
                var x = document.activeElement.id;



               if ( x == '#chatinput_' + data.from) {
                    $('#header_' + data.from).removeClass('blink-bg');
               } else{
                $('#header_' + data.from).addClass('blink-bg');
               }
                
               }
                
            }
    });   
    window.addEventListener('focus', stoPageBlink);
})

function playSound(){

        var audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        var source = audioCtx.createBufferSource();
        var xhr = new XMLHttpRequest();
        xhr.open('GET', base_url+'/assets/audio-autoplay.wav');
        xhr.responseType = 'arraybuffer';
        xhr.addEventListener('load', function (r) {
            audioCtx.decodeAudioData(
                    xhr.response, 
                    function (buffer) {
                        source.buffer = buffer;
                        source.connect(audioCtx.destination);
                        source.loop = false;
                    });
            source.start(0);
        });
        xhr.send();
    
}

$(document).on('focus', '.message-box textarea', function(){
    var id = $(this).attr('data_id');
    $('#header_' + id).removeClass('blink-bg');
    updateReadStatus(id);
})


function pageBlink(dt) {
    interval = setInterval(function () {
                        document.title = document_title === document.title ? dt : document_title;
                    }, 1000);
}
function stoPageBlink() {
    clearInterval(interval), (interval = null), (document.title = document_title);
}

function updateReadStatus(id) {
    var token = $('input[name=\'_token\']').val();
                $.ajax({
                    type: 'POST',
                    url: base_url+'/employee/update_message_read_status',
                    data: 'id='+id+'&_token='+token,
                    cache: false,
                    
                    success: function(datas){

                        
                       
                    }
                });
}


function getContactUsers() {
    $.ajax({
                    type: 'get',
                    url: base_url+'/employee/get_contact_users',
                    data: '',
                    cache: false,
                   
                    success: function(datas){
                       $('#contacts').html(datas);
                    }
                });
}


function toggleSidebar(){
    var h = window.innerHeight;
    $('#left_dashboard').css('height',h);
    $('body').append('<div id="background-overally" style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%; overflow-y:scroll; transition:all 500ms linear; background-color:rgba(0,0,0,0.5); z-index:99; display-inline:block;"></div>');
    document.getElementById("left_dashboard").classList.toggle('active');
    $('#background-overally').on('click', function(){
    $("#left_dashboard").removeClass('active');
    $(this).remove();
    })
    }
    $(".rating").click(function(){
    $(".rating-detail").fadeToggle();
    });
    function viewDetail(id) {
    var token = $('input[name=\'_token\']').val();
    $.ajax({
    type: 'POST',
    url: '{{url("/employer/jobtype/")}}',
    data: '_token='+token+'&id='+id,
    cache: false,
    success: function(html){
    
    $('#goldjob').html(html);
    $('#goldjob').modal('show');
    
    }
    });
    }
    $(function() {
    
    $('.mypicker').datepicker();
    
    });
    


    $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
  }, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
  });

  $('.refreshbtn').on('click', function(){
      location.reload(); 
  })

  $('.public-item').on('click',function(){
    var title = $(this).attr('data-title');
    var value = $(this).attr('data-value');
    $('#public').html(title);
    $('#public-post').val(value);
    $('.dropdown-menu').fadeOut(500);
  })


  $(function() {
  $(document).on('keyup','#post-text', function() {
   var webrl = $('#web_url').val();
   
    var $el = $(this),
        offset = $el.innerHeight() - $el.height();

    if ($el.innerHeight() < this.scrollHeight) {
      // Grow the field if scroll height is smaller
      $el.height(this.scrollHeight - offset);
    } else {
      // Shrink the field and then re-set it to the scroll height in case it needs to shrink
      $el.height(1);
      $el.height(this.scrollHeight - offset);
    }
    var id = $el.attr('data-id');
    
    var activity_image = $('#image-session').val();
    if (webrl != '') {
    return false;
   }
    if (activity_image == 1) {
       
        var text = $el.val();
    var words = text.split(" ");
        for (var i = 0; i < words.length - 1; i++) {
            if (isValidURL(words[i])) {
                
                var token = $('input[name=\'_token\']').val();
                $.ajax({
                    type: 'POST',
                    url: base_url+'/fetch-url',
                    data: 'url='+words[i]+'&_token='+token,
                    cache: false,
                    beforeSend: function() {
                    
                        $('#post-activity').html('Post <i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#post-activity').prop('disabled', true);
                    },
                    complete: function() {
                        $('#post-activity').html('Post');
                        $('#post-activity').prop('disabled', false);
                    },
                    success: function(datas){

                        json = JSON.parse(datas);
                        if (!json.error) {
                            var html = '<div class="col-md-4 url-image"><img src="'+json.web_image+'" alt="'+json.web_title+'"></div>';
                            html += '<div class="col-md-8"><p><strong>'+json.web_title+'</strong></p><p>'+json.web_description+'</p></div>';
                            $('#url-detail'+id).html(html);
                        $('#url-title').val(json.web_title);
                        $('#url-description').val(json.web_description);
                        $('#url-image').val(json.web_image);
                        $('#url-video').val(json.web_video);
                        $('#url_id').val(json.web_id);
                        $('#web_url').val(json.web_url);
                        }
                        
                       
                    }
                });
            }
        }

    }
    

  });
});

 


  function isValidURL(string) {
      var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
      return (res !== null)
    };

$('#post-activity').on('click',function(){
    var url_title = $('#url-title').val();
    var url_description = $('#url-description').val();
    var url_image = $('#url-image').val();
    var url_video = $('#url-video').val();
    var public_post = $('#public-post').val();
    var image_session = $('#image-session').val();
    var text = $('#post-text').val();
    var token = $('input[name=\'_token\']').val();
    var web_id = $('#url_id').val();
    var web_url = $('#web_url').val();

    if (url_title == '' && text == '') {
        $('#post-text').focus();
        return false;
    }

    $.ajax({
        type: 'POST',
        url: base_url+'/employee/save-activity',
        data: 'web_title='+url_title+'&_token='+token+'&web_description='+url_description+'&web_image='+url_image+'&web_video='+url_video+'&public_post='+public_post+'&image_session='+image_session+'&text='+text+'&web_id='+web_id+'&web_url='+web_url,
        cache: false,
         beforeSend: function() {
                    
                    $('#post-activity').html('Post <i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#post-activity').prop('disabled', true);
                },
                complete: function() {
                    $('#post-activity').html('Post');
                    $('#post-activity').prop('disabled', false);
                },
        success: function(datas){
                json = JSON.parse(datas);
                        if (!json.error) {
                $('#all-post-detail').prepend(json.data);
                $('#url-detail0').html('');
                $(".txtInput").val('');
    
                $('#url-title').val('');
                $('#url-description').val('');
                $('#url-image').val('');
                $('#url-video').val('');
                $('#image-session').val('1');
                 $('#url_id').val('');
                $('#web_url').val('');
                document.getElementById('post-text').style.height = "40px";

            }
        
                        
                       
        }
    });
    
})




$('#upload-activity-photo').on('click', function() {
    $('#form-upload').remove();
    var token = $('input[name=\'_token\']').val();
    $('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" id="activityphoto" name="file[]" multiple value="" accept="image/*"/><input type="text" name="_token" value="'+token+'" /></form>');

    $('#form-upload #activityphoto').trigger('click');

    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }

    timer = setInterval(function() {
        if ($('#form-upload #activityphoto').val() != '') {
            clearInterval(timer);

            $.ajax({
                url: base_url+'/employee/upload-activity-photo',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#form-upload')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    
                    $('#post-activity').html('Post <i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#post-activity').prop('disabled', true);
                },
                complete: function() {
                    $('#post-activity').html('Post');
                    $('#post-activity').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    } else{
                        $('#url-detail0').html(json['datas']);
                        $('#image-session').val(json['file-session']);

                    }

                    
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } 
    }, 500);
});


function removeAImage(divid,filename) {
    var token = $('input[name=\'_token\']').val();

    var image_session = $('#image-session').val();
    if (filename != '') {
        $.ajax({
        type: 'POST',
        url: base_url+'/employee/remove-activity-image',
        
        data: '_token='+token+'&image_session='+image_session+'&image='+filename,
        cache: false,
        
       
        success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    } else{
                        $('#acti-image'+divid).remove();
                        var totaldiv = $('.acti-images').length;
                        if (totaldiv === 0) {
                            $('#image-session').val('1');
                        }
                    }
           
        
                        
                       
        }
    });
    }
}


 
$(window).scroll(function() {
     var lm = $('#lodemore').val();
   
  if($(window).scrollTop() + $(window).height() >= $(document).height()){
    if (lm == 1) {
        $('#all-post-detail').append('<div class="post" id="lodemorepost">Loading <i class="fas fa-spinner fa-pulse"></i></div>');
        var token = $('input[name=\'_token\']').val();
        var page = $('#page').val();
        $('#lodemore').val('2');
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/get-more-activity',
            
            data: '_token='+token+'&page='+page,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#lodemorepost').remove();
                            $('#lodemore').val(json['lodemore']);
                            $('#all-post-detail').append(json['datas']);
                            $('#page').val(Number(page) + 1);

                        }
               
            
                            
                           
            }
        });
    }
    
     
  }
});


$(document).on('click',".activity_like", function()
  {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-status');
    

    var token = $('input[name=\'_token\']').val();
    var liked = $('#totalLike'+id).html();
    if (type == 1) {
        var liketext = 'Liked';
        var totallike = Number(liked) + Number(1);
        $(this).attr('data-status','2');
        
    }else{
        var liketext = 'Like';
        var totallike = Number(liked) - Number(1);
        
        $(this).attr('data-status','1');
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/like-activity',
            
            data: '_token='+token+'&id='+id+'&type='+type,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#totalLike'+id).html(totallike);
                            $('#likeText'+id).html(liketext);
                            

                        }
               
            
                            
                           
            }
        });
    

    });

$(document).on('click',".commentbutton", function(){
    var id = $(this).attr('id');
    var comment = $('#commenttext'+id).val();
    var token = $('input[name=\'_token\']').val();
    var total_comment = $('#total_comment_'+id).html();
    
    if (comment == '') {
        $('#commenttext'+id).focus();
        return false;
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/post-activity-comment',
            
            data: '_token='+token+'&id='+id+'&comment='+comment,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            showComment(id);
                            $('#commenttext'+id).val('');
                            total_comment = Number(total_comment) + 1;
                            $('#total_comment_'+id).html(total_comment);
                            var html = '<div class="user-block comment-box" id="comment_box_'+json['datas'].id+'">';
                                html += '<div class="comment-delete activity_comment" data-parent="'+id+'}" id="comment_'+json['datas'].id+'"><i class="fa fa-remove"></i></div>';
                                html += '<img class="img-circle img-bordered-sm" src="'+json['datas'].image+'" alt="user image">';
                                html += '<span class="comments"><span class="comment-name">'+json['datas'].name+'</span> '+json['datas'].comment+'</span>';
                                html += ' <div class="like-button"><span> <a href="javascript:void(0)" class="text-sm comment-like" data-id="'+json['datas'].id+'" id="comment-like'+json['datas'].id+'" data-status="1"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="commentlikeText'+json['datas'].id+'">like</span></a></span>';
                                html += '<span><a href="javascript:void(0)" class=" text-sm" onclick="viewcommentLikes('+json['datas'].id+')">(<span id="totalcommentLike'+json['datas'].id+'">0</span>)</a></span>';
                                html += '<span class="reply-btn"> <a href="javascript:void(0)" class=" text-sm" onclick="showReply('+json['datas'].id+')"><i class="fa fa-comments margin-r-5"></i> Reply(<span id="total_reply_'+json['datas'].id+'">0</span>)</a></span>';
                                html += '<div id="comment-reply'+json['datas'].id+'" style="display: none;"><div class=" user-block reply-box"><div class="input-group reply-group">';
                                html += '<img class="img-circle img-bordered-sm" src="'+user_image+'" alt="user image">';
                                html += '<input type="text" name="message" id="replytext'+json['datas'].id+'" placeholder="Type Message ..." class="form-control reply">';
                                html += '<span class="input-group-btn"><button type="button" id="replyid'+json['datas'].id+'" data-activity="'+id+'"  class="btn greenbg btn-flat replybutton">Reply</button></span>';
                                html += '</div></div><div id="comment_replies_'+json['datas'].id+'"> </div></div></div></div>';
                                $('#comment-box'+id).append(html);
                            

                        }
               
            
                            
                           
            }
        });
});

$(document).on('click',".replybutton", function(){
    var id = $(this).attr('id').replace('replyid','');
    var activity_id = $(this).attr('data-activity');
    var comment = $('#replytext'+id).val();
    var token = $('input[name=\'_token\']').val();
    var total_comment = $('#total_reply_'+id).html();
    
    if (comment == '') {
        $('#replytext'+id).focus();
        return false;
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/post-activity-reply',
            
            data: '_token='+token+'&id='+id+'&comment='+comment+'&activity_id='+activity_id,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            
                            $('#replytext'+id).val('');
                            total_comment = Number(total_comment) + 1;
                            $('#total_reply_'+id).html(total_comment);
                            
                            var html = '<div class=" user-block reply-box" id="reply_box_'+json['datas'].id+'">';
                
                                html += '<div class="input-group reply-group">';
                                html += '<div class="reply-delete" data-parent="'+json['datas'].parent_id+'" id="reply_'+json['datas'].id+'"><i class="fa fa-remove"></i></div>';
                                html += '<img class="img-circle img-bordered-sm" src="'+json['datas'].image+'" alt="user image">';
                                html += '<span class="replies"><span class="comment-name">'+json['datas'].name+'</span>'+json['datas'].comment+'</span></div></div>';
                                $('#comment_replies_'+id).append(html);
                            

                        }
               
            
                            
                           
            }
        });
});



function showComment(id) {
   
      $('#comment-box'+id).animate({
      height: 'toggle'
    });
}
function showReply(id) {
    $('#comment-reply'+id).animate({
      height: 'toggle'
    });
}

$(document).on('click',".activity_comment", function(){
    if(confirm('Are you sure, Do You Want To Delete This Comment?')){

     var id = $(this).attr('id').replace('comment_','');
   var parent = $(this).attr('data-parent');
    var token = $('input[name=\'_token\']').val();
    var total_comment = $('#total_comment_'+parent).html();


    $.ajax({
            type: 'POST',
            url: base_url+'/employee/delete-activity-comment',
            
            data: '_token='+token+'&id='+id,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            
                            
                            total_comment = Number(total_comment) - 1;
                            $('#total_comment_'+parent).html(total_comment);
                            $('#comment_box_'+id).remove();
                            

                        }
               
            
                            
                           
            }
        });
}

    });
$(document).on('click',".activity_reply_delete", function(){
    if(confirm('Are you sure, Do You Want To Delete This Comment?')){

     var id = $(this).attr('id').replace('reply_','');
   var parent = $(this).attr('data-parent');
    var token = $('input[name=\'_token\']').val();
    var total_comment = $('#total_reply_'+parent).html();


    $.ajax({
            type: 'POST',
            url: base_url+'/employee/delete-activity-comment',
            
            data: '_token='+token+'&id='+id,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            
                            
                            total_comment = Number(total_comment) - 1;
                            $('#total_reply_'+parent).html(total_comment);
                            $('#reply_box_'+id).remove();
                            

                        }
               
            
                            
                           
            }
        });
}

    });

$(document).on('click',".comment-like", function()
  {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-status');
    

    var token = $('input[name=\'_token\']').val();
    var liked = $('#totalcommentLike'+id).html();
    if (type == 1) {
        var liketext = 'Liked';
        var totallike = Number(liked) + Number(1);
        $(this).attr('data-status','2');
        
    }else{
        var liketext = 'Like';
        var totallike = Number(liked) - Number(1);
        
        $(this).attr('data-status','1');
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/like-activity-comment',
            
            data: '_token='+token+'&id='+id+'&type='+type,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#totalcommentLike'+id).html(totallike);
                            $('#commentlikeText'+id).html(liketext);
                            

                        }
               
            
                            
                           
            }
        });
    

    });

    $(document).on('click', '.activity_images', function(){
        var image_id = $(this).attr('data-id');
        var activity_id = $(this).attr('data-parent');
        var token = $('input[name=\'_token\']').val();
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/get-image-detail',
            
            data: '_token='+token+'&image_id='+image_id+'&activity_id='+activity_id+'&type=nxt',
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#popimage').attr('src',json['image']);
                            $('#prv').attr('data-id',json['prv']).attr("data-parent",activity_id);
                            $('#next').attr('data-id',json['next']).attr("data-parent",activity_id);
                            $('#comment-field').html(json['datas']);

    
                            $('#image-popup').fadeIn();
                            var bodyheight = $('.image-content').height();
                            
                            var comment_top = $('#comment_field_top').height();
                            comment_top = Number(comment_top) + Number(25);
                            $("#image-field").height(bodyheight - 20);
                            $("#comment-field").height(bodyheight - 20);
                            $('#image_comment_box').height(bodyheight - comment_top);

                        }
               
            
                            
                           
            }
        });
    })

    $(document).on('click', '.remove-popup', function(){
        $('#image-popup').fadeOut();
    })

    $(document).on('click', '.prv', function(){
        var image_id = $(this).attr('data-id');
        var activity_id = $(this).attr('data-parent');
        var token = $('input[name=\'_token\']').val();
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/get-image-detail',
            
            data: '_token='+token+'&image_id='+image_id+'&activity_id='+activity_id+'&type=prv',
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#popimage').attr('src',json['image']);
                            $('#prv').attr('data-id',json['prv']).attr("data-parent",activity_id);
                            $('#next').attr('data-id',json['next']).attr("data-parent",activity_id);
                            $('#comment-field').html(json['datas']);

    
                            $('#image-popup').fadeIn();
                            var bodyheight = $('.image-content').height();
                            
                            var comment_top = $('#comment_field_top').height();
                            comment_top = Number(comment_top) + Number(25);
                            $("#image-field").height(bodyheight - 20);
                            $("#comment-field").height(bodyheight - 20);
                            $('#image_comment_box').height(bodyheight - comment_top);

                        }
               
            
                            
                           
            }
        });
    })

    $(document).on('click', '.next', function(){
         var image_id = $(this).attr('data-id');
        var activity_id = $(this).attr('data-parent');
        var token = $('input[name=\'_token\']').val();
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/get-image-detail',
            
            data: '_token='+token+'&image_id='+image_id+'&activity_id='+activity_id+'&type=nxt',
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#popimage').attr('src',json['image']);
                            $('#prv').attr('data-id',json['prv']).attr("data-parent",activity_id);
                            $('#next').attr('data-id',json['next']).attr("data-parent",activity_id);
                            $('#comment-field').html(json['datas']);

    
                            $('#image-popup').fadeIn();
                            var bodyheight = $('.image-content').height();
                            
                            var comment_top = $('#comment_field_top').height();
                            comment_top = Number(comment_top) + Number(25);
                            $("#image-field").height(bodyheight - 20);
                            $("#comment-field").height(bodyheight - 20);
                            $('#image_comment_box').height(bodyheight - comment_top);

                        }
               
            
                            
                           
            }
        });
    })


    $(document).on('click',".image_like", function()
  {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-status');
    

    var token = $('input[name=\'_token\']').val();
    var liked = $('#total_image_like').html();
    if (type == 1) {
        var liketext = 'Liked';
        var total_image_like = Number(liked) + Number(1);
        $(this).attr('data-status','2');
        
    }else{
        var liketext = 'Like';
        var total_image_like = Number(liked) - Number(1);
        
        $(this).attr('data-status','1');
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/like-activity-image',
            
            data: '_token='+token+'&id='+id+'&type='+type,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#total_image_like').html(total_image_like);
                            $('#image_like_text').html(liketext);
                            

                        }
               
            
                            
                           
            }
        });
    

    });


    $(document).on('keyup',".photo_comment", function(e){

        if(e.keyCode == 13) {
            var id = $(this).attr('id').replace('comment_text_','');
            var comment = $(this).val();
            var token = $('input[name=\'_token\']').val();
            var total_comment = $('#total_image_comment').html();
            
            if (comment == '') {
                $('#comment_text_'+id).focus();
                return false;
            }
            $.ajax({
                    type: 'POST',
                    url: base_url+'/employee/post-activity-image-comment',
                    
                    data: '_token='+token+'&id='+id+'&comment='+comment,
                    cache: false,
                    
                   
                    success: function(json){
                            if (json['error']) {
                                    alert(json['error']);
                                } else{
                                    
                                    $('#comment_text_'+id).val('');
                                    total_comment = Number(total_comment) + 1;
                                    $('#total_image_comment').html(total_comment);
                                    var html = '<div class="user-block comment-box" id="image_comment_box_'+json['datas'].id+'">';
                                        html += '<div class="comment-delete image_comment_delete" data-parent="'+id+'}" id="comment_'+json['datas'].id+'"><i class="fa fa-remove"></i></div>';
                                        html += '<img class="img-circle img-bordered-sm" src="'+json['datas'].image+'" alt="user image">';
                                        html += '<span class="comments"><span class="comment-name">'+json['datas'].name+'</span> '+json['datas'].comment+'</span>';
                                        html += ' <div class="like-button"><span> <a href="javascript:void(0)" class="text-sm image_comment_like" data-id="'+json['datas'].id+'" id="image_comment_like'+json['datas'].id+'" data-status="1"><i class="fa fa-thumbs-up margin-r-5"></i> <span id="commentimagelikeText'+json['datas'].id+'">like</span></a></span>';
                                        html += '<span><a href="javascript:void(0)" class=" text-sm" onclick="viewimagecommentLikes('+json['datas'].id+')">(<span id="totalimagecommentLike'+json['datas'].id+'">0</span>)</a></span>';
                                        html += '<span class="reply-btn"> <a href="javascript:void(0)" class=" text-sm" onclick="showimageReply('+json['datas'].id+')"><i class="fa fa-comments margin-r-5"></i> Reply(<span id="total_image_reply_'+json['datas'].id+'">0</span>)</a></span>';
                                        html += '<div id="image_comment_reply'+json['datas'].id+'" style="display: none;"><div class=" user-block reply-box"><div class="input-group reply-group">';
                                        html += '<img class="img-circle img-bordered-sm" src="'+user_image+'" alt="user image">';
                                        html += '<input type="text" name="message" data-parent="'+id+'" data-id="'+json['datas'].id+'" placeholder="Type Message ..." class="form-control photo_comment_reply">';
                                        
                                        html += '</div></div><div id="image_reply_box_'+json['datas'].id+'"> </div></div></div></div>';
                                        $('#image_comment_box').append(html);
                                    

                                }
                       
                    
                                    
                                   
                    }
                });
        }
    });


    $(document).on('click',".image_comment_like", function()
  {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-status');
    

    var token = $('input[name=\'_token\']').val();
    var liked = $('#totalimagecommentLike'+id).html();
    if (type == 1) {
        var liketext = 'Liked';
        var totallike = Number(liked) + Number(1);
        $(this).attr('data-status','2');
        
    }else{
        var liketext = 'Like';
        var totallike = Number(liked) - Number(1);
        
        $(this).attr('data-status','1');
    }
    $.ajax({
            type: 'POST',
            url: base_url+'/employee/like-activity-image-comment',
            
            data: '_token='+token+'&id='+id+'&type='+type,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            $('#totalimagecommentLike'+id).html(totallike);
                            $('#commentimagelikeText'+id).html(liketext);
                            

                        }
               
            
                            
                           
            }
        });
    

    });

    function showimageReply(id) {
        $('#image_comment_reply'+id).animate({
          height: 'toggle'
        });
    }


    $(document).on('keyup',".photo_comment_reply", function(e){

         if(e.keyCode == 13) {
            var id = $(this).attr('data-id');
            var parent_id = $(this).attr('data-parent');
            var comment = $(this).val();
            var token = $('input[name=\'_token\']').val();
            var total_comment = $('#total_image_reply_'+id).html();
            
            if (comment == '') {
                $(this).focus();
                return false;
            }
            $.ajax({
                    type: 'POST',
                    url: base_url+'/employee/post-image-comment-reply',
                    
                    data: '_token='+token+'&id='+id+'&comment='+comment+'&parent_id='+parent_id,
                    cache: false,
                    
                   
                    success: function(json){
                            if (json['error']) {
                                    alert(json['error']);
                                } else{
                                    
                                    $('.photo_comment_reply').val('');
                                    total_comment = Number(total_comment) + 1;
                                    $('#total_image_reply_'+id).html(total_comment);
                                    
                                    var html = '<div class=" user-block reply-box" id="image_reply_box_'+json['datas'].id+'">';
                        
                                        html += '<div class="input-group reply-group">';
                                        html += '<div class="reply-delete image_reply_delete" data-parent="'+json['datas'].parent_id+'" id="image_reply_'+json['datas'].id+'"><i class="fa fa-remove"></i></div>';
                                        html += '<img class="img-circle img-bordered-sm" src="'+json['datas'].image+'" alt="user image">';
                                        html += '<span class="replies"><span class="comment-name">'+json['datas'].name+'</span>'+json['datas'].comment+'</span></div></div>';
                                        $('#image_comment_replies_'+id).append(html);
                                    

                                }
                       
                    
                                    
                                   
                    }
                });
        }
    });

    $(document).on('click',".image_comment_delete", function(){
        if(confirm('Are you sure, Do You Want To Delete This Comment?')){

            var id = $(this).attr('id').replace('comment_','');
            var parent = $(this).attr('data-parent');
            var token = $('input[name=\'_token\']').val();
            var total_comment = $('#total_image_comment').html();


            $.ajax({
                    type: 'POST',
                    url: base_url+'/employee/delete-activity-image-comment',
                    
                    data: '_token='+token+'&id='+id,
                    cache: false,
                    
                   
                    success: function(json){
                            if (json['error']) {
                                    alert(json['error']);
                                } else{
                                    
                                    
                                    total_comment = Number(total_comment) - 1;
                                    $('#total_image_comment').html(total_comment);
                                    $('#image_comment_box_'+id).remove();
                                    

                                }
                       
                    
                                    
                                   
                    }
                });
        }

    });

    $(document).on('click',".image_reply_delete", function(){
    if(confirm('Are you sure, Do You Want To Delete This Comment?')){

     var id = $(this).attr('id').replace('image_reply_','');
   var parent = $(this).attr('data-parent');
    var token = $('input[name=\'_token\']').val();
    var total_comment = $('#total_image_reply_'+parent).html();


    $.ajax({
            type: 'POST',
            url: base_url+'/employee/delete-activity-image-comment',
            
            data: '_token='+token+'&id='+id,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                            
                            
                            total_comment = Number(total_comment) - 1;
                            $('#total_image_reply_'+parent).html(total_comment);
                            $('#image_reply_box_'+id).remove();
                            

                        }
               
            
                            
                           
            }
        });
}

    });

function detail(id) {
$('#modal-bid .modal-body').html($('#detail_'+id).html());
$('#modal-bid').modal('show');
}


function deletePost(id){

    if(confirm('Are you sure, Do You Want To Delete This post?')){

     
    var token = $('input[name=\'_token\']').val();
   


    $.ajax({
            type: 'POST',
            url: base_url+'/employee/delete-activity',
            
            data: '_token='+token+'&id='+id,
            cache: false,
            
           
            success: function(json){
                    if (json['error']) {
                            alert(json['error']);
                        } else{
                           
                            $('#post'+id).remove();
                            

                        }
               
            
                            
                           
            }
        });
}

}

function editPost(id) {
    var text = $('#activity_title_'+id).html();
    var html = '<div class="form-group"><textarea class="form-control txtInput" id="edit-text-'+id+'" data-id="'+id+'" placeholder="What is in your mind">'+text+'</textarea>';
    html += '</div> <div id="url-detail'+id+'" class="row cm10-row"></div><div class="box-footer"><a href="javascript:void()" class="btn edit_button bluebg pull-right" id="post_edit'+id+'"> Update</a></div>';
    $('#activity_title_'+id).html(html);
}

$(document).on('click','.edit_button', function(){
    var id = $(this).attr('id').replace('post_edit','');
    var url_title = $('#url-title').val();
    var url_description = $('#url-description').val();
    var url_image = $('#url-image').val();
    var url_video = $('#url-video').val();
    var public_post = $('#public-post').val();
    var image_session = $('#image-session').val();
    var text = $('#post-text').val();
    var token = $('input[name=\'_token\']').val();
    var web_id = $('#url_id').val();
    var web_url = $('#web_url').val();

    if (url_title == '' && text == '' && id == '') {
        $('#post-text').focus();
        return false;
    }

    $.ajax({
        type: 'POST',
        url: base_url+'/employee/edit-activity',
        data: 'web_title='+url_title+'&_token='+token+'&web_description='+url_description+'&web_image='+url_image+'&web_video='+url_video+'&public_post='+public_post+'&image_session='+image_session+'&text='+text+'&web_id='+web_id+'&web_url='+web_url+'&id='+id,
        cache: false,
         beforeSend: function() {
                    
                    $('#post-activity').html('Post <i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#post-activity').prop('disabled', true);
                },
                complete: function() {
                    $('#post-activity').html('Post');
                    $('#post-activity').prop('disabled', false);
                },
        success: function(datas){
                json = JSON.parse(datas);
                        if (!json.error) {
                $('#post'+id).html(json.data);
                
                $(".txtInput").val('');
    
                $('#url-title').val('');
                $('#url-description').val('');
                $('#url-image').val('');
                $('#url-video').val('');
                $('#image-session').val('1');
                $('#url_id').val('');
                $('#web_url').val('');
                document.getElementById('edit-text-'+id).style.height = "40px";

            }
        
                        
                       
        }
    });
    
})


function acceptRequest(user_id)
{
    var token = $('input[name=\'_token\']').val();

    if (user_id != '') {
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/accept_request',
            data: 'user_id='+user_id+'&_token='+token+'&type=Accept',
            cache: false,
            success: function(datas){

                if (datas == 'Success') {
                    $('#friend_div'+user_id).remove();
                } else{
                    alert(datas);
                }
            }
        });
    }
}
function rejectRequest(user_id)
{
    var token = $('input[name=\'_token\']').val();

    if (user_id != '') {
        $.ajax({
        type: 'POST',
        url: base_url+'/employee/accept_request',
        data: 'user_id='+user_id+'&_token='+token+'&type=Reject',
        cache: false,
            success: function(datas){

            if (datas == 'Success') {
                $('#friend_div'+user_id).remove();
            } else{
                alert(datas);
            }
            }
        });
    }
}


$('#filter_rank').on('change',function(){
        var type = $(this).val();
        var token = $('input[name=\'_token\']').val();
        $.ajax({
            type: 'POST',
            url: base_url+'/employee/getscore',
            data: 'type='+type+'&_token='+token,
            cache: false,
            success: function(datas){
                var data = datas.split('||');
                $('#highscore').html(data[0]);
                $('#rank').html(data[1]);
                $('#colli').html(data[2]);
                $('.tool').html(data[3]);
            }
        });
    })


$(document).on('change','#filter_by_institute',function(){
        var type = $('#filter_rank').val();
        var employers = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (employers != '') {
            $.ajax({
                type: 'POST',
                url: base_url+'/employee/getscore',
                data: 'type='+type+'&_token='+token+'&employers='+employers,
                cache: false,
                success: function(datas){
                    var data = datas.split('||');
                    $('#highscore').html(data[0]);
                    $('#rank').html(data[1]);
                    $('.tool').html(data[3]);
                }
            });
        }
        
    })

$(function() {
    
    $('.datepicker').datepicker();
    
    });

$(document).on('click', '#edit_profile', function(){
    $('#editprofile-modal').modal('show');
})

$(document).on('click', '#add_education', function(){
     $('#add_education_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_experience', function(){
     $('#add_experience_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_training', function(){
     $('#add_training_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_reference', function(){
     $('#add_reference_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_language', function(){
     $('#add_language_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_location', function(){
     $('#add_location_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_category', function(){
     $('#add_category_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#add_organization_type', function(){
     $('#add_organization_type_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#edit_language', function(){
    
     $('#lang_detail').animate({
      height: 'toggle'
    });
     if ($('#lang_detail').attr('class') == 'hidden') {
        $('#lang_detail').attr("class","show");
        $('#lang').fadeOut();
        $(this).html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false"><path d="M8 7l-5.9 4L1 9.5l6.2-4.2c.5-.3 1.2-.3 1.7 0L15 9.5 13.9 11 8 7z"></path></svg>');
        
        
    } else{
        $('#lang').fadeIn();
        $('#lang_detail').attr("class","hidden");
       $(this).html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false"><path d="M8 9l5.93-4L15 6.54l-6.15 4.2a1.5 1.5 0 01-1.69 0L1 6.54 2.07 5z"></path></svg>');
    }
})

$(document).on('change', '#level_id', function(){
       
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
          var lid = ["6", "7"];
          if (lid.includes(data)) {
            $('#faculty').removeAttr("required");
          } else{
            $('#faculty').attr("required", "required");
          }

            $.ajax({
        type: 'POST',
        url: base_url+'/employee/getfaculty',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty').html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#faculty').html(html);
        }
    });
$(document).on('click', '#education_submit', function(){
            $.ajax({
                url: $('#add-education-form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add-education-form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#education_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#education_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#education_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#education_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        $('#add_education_box').fadeOut();
                        var html = '<div class="education tb10p border_bottom" id="education_row_'+json['data'].id+'">';
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown">';
                            html += '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_education" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_education" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li></ul></li></ul>';
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-2"><div class="noedu"><i class="fa fa-landmark"></i></div></div>';
                            html += '<div class="col-lg-11 col-md-10 col-10"><h3 class="job_post btm5p bold">'+json['data'].institution+'</h3>';
                            html += '<span>'+json['data'].faculty+'</span>';
                            html += '<span class="lft30m">'+json['data'].board+' - '+json['data'].year+'</span>';
                            html += '<span class="lft30m">'+json['data'].specialization+' - '+json['data'].percentage+'</span>';
                            html += '</div></div></div>';
                    $('#education_box').append(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#education_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('keypress',"#institution", function()
  {
   
    var token = $('input[name=\'_token\']').val();
    var name = $(this).val();
    $.ajax({
      type: 'POST',
        url: base_url+'/employer/register/getName',
        data: '_token='+token+'&name='+name,
        cache: false,
        success: function(html){
          if (html != '') {
            $('#institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#institution').val(title);
              $('#employer_id').val(id);
              
              $('#institution_list').html('').fadeOut();
            })
          } else{
            $('#institution_list').html('').fadeOut();
           
        }
          }
  });
  })

$(document).on('click','.remove_education', function(){
     if(confirm('Are you sure, Do You Want To Delete This Education?')){
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/deleteeducation',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#education_row_'+id).remove();
               
            }
        });
        }
})
$(document).on('click','.edit_education', function(){
    
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/educations/getedit',
            data: 'education_id='+id+'&_token='+token,
            cache: false,
            success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    }else{
                localStorage.setItem("prvitem", $('#education_row_'+id).html());
                $('#education_row_'+id).html(json['datas']);
            }
               
            }
        });
        
})

$(document).on('change', '.level_id', function(){
        var id = $(this).attr('data-id')
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
          var lid = ["6", "7"];
          if (lid.includes(data)) {
            $('#faculty').removeAttr("required");
          } else{
            $('#faculty').attr("required", "required");
          }

            $.ajax({
        type: 'POST',
        url: base_url+'/employee/getfaculty',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty_'+id).html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#faculty_'+id).html(html);
        }
    });
$(document).on('keypress',".institution", function()
  {
    var id = $(this).attr('data-id');
    var type = $(this).attr('data-type');
   
    var token = $('input[name=\'_token\']').val();
    var name = $(this).val();
    $.ajax({
      type: 'POST',
        url: base_url+'/employer/register/getName',
        data: '_token='+token+'&name='+name,
        cache: false,
        success: function(html){
          if (html != '') {
            $('#institution_list_'+type+id).html(html).fadeIn();
            $('.org-list').on('click', function(){
              var inid = $(this).attr('id');
              var title = $('#title_'+inid).html();
              var org_type = $('#type_'+inid).val();
              $('#institution_'+type+id).val(title);
              $('#employer_id_'+type+id).val(inid);
              
              $('#institution_list_'+type+id).html('').fadeOut();
            })
          } else{
            $('#institution_list_'+type+id).html('').fadeOut();
           
        }
          }
  });
  })


$(document).on('click', '.update_education', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#edit-education-form'+dataid).attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#edit-education-form'+dataid)[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.update_education i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('.update_education').prop('disabled', true);
                },
                complete: function() {
                    $('.update_education i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('.update_education').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        
                        var html = '<div class="education tb10p border_bottom" id="education_row_'+json['data'].id+'">';
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown">';
                            html += '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_education" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_education" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li></ul></li></ul>';
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-2"><div class="noedu"><i class="fa fa-landmark"></i></div></div>';
                            html += '<div class="col-lg-11 col-md-10 col-10"><h3 class="job_post btm5p bold">'+json['data'].institution+'</h3>';
                            html += '<span>'+json['data'].faculty+'</span>';
                            html += '<span class="lft30m">'+json['data'].board+' - '+json['data'].year+'</span>';
                            html += '<span class="lft30m">'+json['data'].specialization+' - '+json['data'].percentage+'</span>';
                            html += '</div></div></div>';
                    $('#education_row_'+dataid).html(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#education_error_'+dataid).show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click','.cancel_education', function(){
    var dataid = $(this).attr('data-id');
    $('#education_row_'+dataid).html(localStorage.getItem("prvitem"));

})

$(document).on('keypress',"#ex_institution", function()
  {
   
    var token = $('input[name=\'_token\']').val();
    var name = $(this).val();
    $.ajax({
      type: 'POST',
        url: base_url+'/employer/register/getName',
        data: '_token='+token+'&name='+name,
        cache: false,
        success: function(html){
          if (html != '') {
            $('#ex_institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#ex_institution').val(title);
              $('#ex_employer_id').val(id);
              
              $('#ex_institution_list').html('').fadeOut();
            })
          } else{
            $('#ex_institution_list').html('').fadeOut();
           
        }
          }
  });
  })
$(document).on('keypress',"#t_institution", function()
  {
   
    var token = $('input[name=\'_token\']').val();
    var name = $(this).val();
    $.ajax({
      type: 'POST',
        url: base_url+'/employer/register/getName',
        data: '_token='+token+'&name='+name,
        cache: false,
        success: function(html){
          if (html != '') {
            $('.orglist').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#t_institution').val(title);
              $('#t_employer_id').val(id);
              
              $('.orglist').html('').fadeOut();
            })
          } else{
            $('.orglist').html('').fadeOut();
           
        }
          }
  });
  })

   $(document).on('change',"#currently", function()
     {
      var tod = new Date().toISOString().slice(0,10);

      
      var id= $(this).val();
      if (id == 1) {
        $('#to').val(tod);
      }
     })

$(document).on('click', '#experience_save', function(){
            $.ajax({
                url: $('#add_experience_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_experience_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#experience_save i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#experience_save').prop('disabled', true);
                },
                complete: function() {
                    $('#experience_save i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#experience_save').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        $('#add_experience_box').fadeOut();
                        var html = '<div class="job_experience tb10p border_bottom" id="experience_row_'+json['datas'].id+'">';
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr">';
                            html += '<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>';
                            html += '<ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_experience" href="javascript:void()" data-id="'+json['datas'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_experience" href="javascript:void()" data-id="'+json['datas'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul><div class="row cm10-row"><div class="col-lg-1 col-md-1 col-4"><div class="exp_icon"><i class="fas fa-building"></i></div></div>';
                            html += '<div class="col-lg-10 col-md-10 col-8"><h3 class="job_post btm5p">'+json['datas'].designation+'</h3>';
                            html += '<p>'+json['datas'].organization+'</p>';
                            html += '<p><i class="fa fa-calendar"></i> '+json['datas'].from_to+'</p>';
                            html += '<p><i class="fa fa-map-marker-alt"></i> '+json['datas'].country+'</p></div></div></div>';
                    $('#experience_box').append(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#experience_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click','.edit_experience', function(){
    
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/experiences/getedit',
            data: 'experience_id='+id+'&_token='+token,
            cache: false,
            success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    }else{
                localStorage.setItem("prvitem", $('#experience_row_'+id).html());
                $('#experience_row_'+id).html(json['datas']);
            }
               
            }
        });
        
})

$(document).on('click','.remove_experience', function(){
     if(confirm('Are you sure, Do You Want To Delete This Experience?')){
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/experience/delete',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#experience_row_'+id).remove();
               
            }
        });
        }
})

$(document).on('click', '.update_experience', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#edit_experience_form_'+dataid).attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#edit_experience_form_'+dataid)[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.update_experience i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('.update_experience').prop('disabled', true);
                },
                complete: function() {
                    $('.update_experience i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('.update_experience').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       var html = '<ul class="nav navbar-nav pull-right btn-box-tool blueclr">';
                            html += '<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>';
                            html += '<ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_experience" href="javascript:void()" data-id="'+json['datas'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_experience" href="javascript:void()" data-id="'+json['datas'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul><div class="row cm10-row"><div class="col-lg-1 col-md-1 col-4"><div class="exp_icon"><i class="fas fa-building"></i></div></div>';
                            html += '<div class="col-lg-10 col-md-10 col-8"><h3 class="job_post btm5p">'+json['datas'].designation+'</h3>';
                            html += '<p>'+json['datas'].organization+'</p>';
                            html += '<p><i class="fa fa-calendar"></i> '+json['datas'].from_to+'</p>';
                            html += '<p><i class="fa fa-map-marker-alt"></i> '+json['datas'].country+'</p></div></div>';
                    $('#experience_row_'+dataid).html(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#experience_error_'+dataid).show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})


$(document).on('click', '#training_submit', function(){
            $.ajax({
                url: $('#add_training_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_training_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#training_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#training_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#training_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#training_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        $('#add_training_box').fadeOut();
                        var html = '<div class="education tb10p border_bottom" id="training_row_'+json['data'].id+'">';
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown">';
                            html += '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_training" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_training" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li></ul></li></ul>';
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-2"><div class="noedu"><i class="fa fa-landmark"></i></div></div>';
                            html += ' <div class="col-lg-11 col-md-10 col-10"><h3 class="job_post btm5p bold">'+json['data'].institute+'</h3>';
                            html += '<span>'+json['data'].title+'</span><span class="lft30m">'+json['data'].duration+'</span><span class="lft30m">'+json['data'].detail+'</span></div></div></div>';
                    $('#training_box').append(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#training_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click','.edit_training', function(){
    
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/trainings/getedit',
            data: 'training_id='+id+'&_token='+token,
            cache: false,
            success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    }else{
                localStorage.setItem("prvitem", $('#training_row_'+id).html());
                $('#training_row_'+id).html(json['datas']);
            }
               
            }
        });
        
})

$(document).on('click','.remove_training', function(){
     if(confirm('Are you sure, Do You Want To Delete This training?')){
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/training/delete',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#training_row_'+id).remove();
               
            }
        });
        }
})

$(document).on('click', '.update_training', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#edit_training_form_'+dataid).attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#edit_training_form_'+dataid)[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.update_training i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('.update_training').prop('disabled', true);
                },
                complete: function() {
                    $('.update_training i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('.update_training').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       var html = '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown">';
                            html += '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_training" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_training" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li></ul></li></ul>';
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-2"><div class="noedu"><i class="fa fa-landmark"></i></div></div>';
                            html += ' <div class="col-lg-11 col-md-10 col-10"><h3 class="job_post btm5p bold">'+json['data'].institute+'</h3>';
                            html += '<span>'+json['data'].title+'</span><span class="lft30m">'+json['data'].duration+'</span><span class="lft30m">'+json['data'].detail+'</span></div></div>';
                    $('#training_row_'+dataid).html(html);
                    }
                },
                //error: function(xhr, ajaxOptions, thrownError) {
                //    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //}
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#training_error_'+dataid).show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})


$(document).on('click', '#reference_submit', function(){
            $.ajax({
                url: $('#add_reference_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_reference_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#reference_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#reference_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#reference_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#reference_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        $('#add_reference_box').fadeOut();
                        var html = '<div class="job_experience tb10p border_bottom" id="reference_row_'+json['data'].id+'">';
                  
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_reference" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_reference" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul>';
                 
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-4"><div class="exp_icon"><i class="fas fa-building"></i></div></div>';
                            html += '<div class="col-lg-10 col-md-10 col-8"><h3 class="job_post btm5p">'+json['data'].name+'</h3>';
                            html += '<p>'+json['data'].designation+'</p><p>'+json['data'].company+'</p> <p><i class="fa fa-envelope"></i> '+json['data'].email+'</p> </div></div> </div>';
                    $('#reference_box').append(html);
                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#reference_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click','.edit_reference', function(){
    
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/references/getedit',
            data: 'reference_id='+id+'&_token='+token,
            cache: false,
            success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    }else{
                localStorage.setItem("prvitem", $('#reference_row_'+id).html());
                $('#reference_row_'+id).html(json['datas']);
            }
               
            }
        });
        
})

$(document).on('click','.remove_reference', function(){
     if(confirm('Are you sure, Do You Want To Delete This reference?')){
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/reference/delete',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#reference_row_'+id).remove();
               
            }
        });
        }
})

$(document).on('click', '.update_reference', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#edit_reference_form_'+dataid).attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#edit_reference_form_'+dataid)[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.update_reference i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('.update_reference').prop('disabled', true);
                },
                complete: function() {
                    $('.update_reference i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('.update_reference').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       var html = '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_reference" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_reference" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul>';
                 
                            html += '<div class="row cm10-row"><div class="col-lg-1 col-md-1 col-4"><div class="exp_icon"><i class="fas fa-building"></i></div></div>';
                            html += '<div class="col-lg-10 col-md-10 col-8"><h3 class="job_post btm5p">'+json['data'].name+'</h3>';
                            html += '<p>'+json['data'].designation+'</p><p>'+json['data'].company+'</p> <p><i class="fa fa-envelope"></i> '+json['data'].email+'</p> </div></div>';
                    $('#reference_row_'+dataid).html(html);
                    }
                },
                //error: function(xhr, ajaxOptions, thrownError) {
                //    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //}
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#reference_error_'+dataid).show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click', '#language_submit', function(){
            $.ajax({
                url: $('#add_language_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_language_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#language_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#language_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#language_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#language_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                        $('#add_language_box').fadeOut();
                        var html = '<div class="education tb10p border_bottom" id="language_row_'+json['data'].id+'">';
                  
                            html += '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_language" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_language" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul>';
                 
                            html += '<div class="row cm10-row"><div class="col-lg-12 col-md-12 col-12"><h3 class="job_post btm5p bold">'+json['data'].language+'</h3>';
                            html += '<span><b>Understand: </b>'+json['data'].understand+'</span><span class="lft30m"><b>Speak: </b>'+json['data'].speak+'</span>';
                            html += '<span class="lft30m"><b>Read: </b>'+json['data'].reading+'</span><span class="lft30m"><b>Write: </b>'+json['data'].writing+'</span>';
                            html += '<span class="lft30m"><b>Mother Tongue: </b>'+json['data'].mother_tongue+'</span></div></div></div>';
                    $('#lang_detail').append(html);
                        var lang = $('#lang').html();
                            lang += '<div id="language_'+json['data'].id+'"><span class="squrebullet"></span><span>'+json['data'].language+'</span></div>';
                        $('#lang').html(lang);

                    }
                },
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#language_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})


$(document).on('click','.edit_language', function(){
    
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/languages/getedit',
            data: 'language_id='+id+'&_token='+token,
            cache: false,
            success: function(json){
                if (json['error']) {
                        alert(json['error']);
                    }else{
                localStorage.setItem("prvitem", $('#language_row_'+id).html());
                $('#language_row_'+id).html(json['datas']);
            }
               
            }
        });
        
})

$(document).on('click','.remove_language', function(){
     if(confirm('Are you sure, Do You Want To Delete This language?')){
      var token = $('input[name=\'_token\']').val();
      var id = $(this).attr('data-id');
          $.ajax({
            type: 'POST',
            url: base_url+'/employee/language/delete',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#language_row_'+id).remove();
                $('#language_'+id).remove();
               
            }
        });
        }
})

$(document).on('click', '.update_language', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#edit_language_form_'+dataid).attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#edit_language_form_'+dataid)[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.update_language i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('.update_language').prop('disabled', true);
                },
                complete: function() {
                    $('.update_language i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('.update_language').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       var html = '<ul class="nav navbar-nav pull-right btn-box-tool blueclr"><li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a><ul class="dropdown-menu min_width">';
                            html += '<li><a class="dropdown-item remove_language" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-remove"></i>Remove</a></li>';
                            html += '<li><a class="dropdown-item edit_language" href="javascript:void()" data-id="'+json['data'].id+'"><i class="fa fa-user-edit"></i>Edit</a></li>';
                            html += '</ul></li></ul>';
                 
                            html += '<div class="row cm10-row"><div class="col-lg-12 col-md-12 col-12"><h3 class="job_post btm5p bold">'+json['data'].language+'</h3>';
                            html += '<span><b>Understand: </b>'+json['data'].understand+'</span><span class="lft30m"><b>Speak: </b>'+json['data'].speak+'</span>';
                            html += '<span class="lft30m"><b>Read: </b>'+json['data'].read+'</span><span class="lft30m"><b>Write: </b>'+json['data'].writing+'</span>';
                            html += '<span class="lft30m"><b>Mother Tongue: </b>'+json['data'].mother_tongue+'</span></div></div>';
                    $('#language_row_'+dataid).html(html);
                    $('#language_'+json['data'].id).html(json['data'].language);
                    }
                },
                //error: function(xhr, ajaxOptions, thrownError) {
                //    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //}
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#language_error_'+dataid).show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})
$(document).on('click', '#location_submit', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#add_location_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_location_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#location_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#location_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#location_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#location_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       $('#add_location_box').fadeOut();
                       $('#locations').html('<div class="emp_loc col-12">'+json['data']+'</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
                
            });
})

$(document).on('click', '#category_submit', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#add_category_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_category_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#category_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#category_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#category_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#category_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       $('#add_category_box').fadeOut();
                       $('#categorys').html('<div class="emp_loc col-12">'+json['data']+'</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
})
$(document).on('click', '#organization_type_submit', function(){
    var dataid = $(this).attr('data-id');
            $.ajax({
                url: $('#add_organization_type_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_organization_type_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#organization_type_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#organization_type_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#organization_type_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#organization_type_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       $('#add_organization_type_box').fadeOut();
                       $('#organization_types').html('<div class="emp_loc col-12">'+json['data']+'</div>');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
})


$('#btn_change').on('click', function() {
        $('#upload_image_form').remove();
        var token = $('input[name=\'_token\']').val();
        $('body').prepend('<form enctype="multipart/form-data" action="" id="upload_image_form" method="POST" style="display: none;"><input type="file" id="file" name="file" value="" /><input type="text" name="_token" value="'+token+'" /></form>');

        $('#upload_image_form #file').trigger('click');
        if (typeof timer != 'undefined') {
              clearInterval(timer);
          }

          timer = setInterval(function() {
            if ($('#upload_image_form #file').val() != '') {
              clearInterval(timer);
                 $.ajax({
                    url: base_url+'/employee/uploadimage',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData($('#upload_image_form')[0]),
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btn_change i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                        $('#btn_change').prop('disabled', true);
                    },
                    complete: function() {
                        $('#btn_change i').replaceWith('<i class="fa fa-upload"></i>');
                        $('#btn_change').prop('disabled', false);
                    },
                    success: function(json) {
                        if (json['error']) {
                            alert(json['error']);
                        }else{

                           
                           $('#individual_profile_image').attr('src',json['image']);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
                }
          }, 500);

      });

function ValidateEmail(inputText)
{
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if(inputText.match(mailformat))
    {
        
        return false;
    }
    else
    {
       
        return true;
    }
}

$(document).on('click', '#change_email', function(){
     $('#change_email_box').animate({
      height: 'toggle'
    });
})
$(document).on('click', '#change_password', function(){
     $('#change_password_box').animate({
      height: 'toggle'
    });
     $('#password_submit').prop('disabled', true);
})
$(document).on('blur', '#email', function(){
   var email = $(this).val();
   if (email == '') {
    $('#email_error_message').show().html('Please type valid email address');
    return false;
   }
   if (ValidateEmail(email)) {
    $('#email_error_message').show().html('Please type valid email address');
    return false;
    
   }
            $.ajax({
                url: $('#change_email_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#change_email_form')[0]),
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function() {
                        $('#email_error_message').show().html('');
                        
                    },
                complete: function() {
                        //$('#email_error_message').show().html('');
                        
                    },
                
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{

                       $('#change_email_box').fadeOut();
                       $('#user_email').html(email);
                    }
                },
                error: function(data) {
                    
                   var errors = data.responseJSON;
                    var errorsHtml = '';

                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });

                        $('#email_error_message').show().html(errorsHtml); 

                    
                }
            });
})

$(document).on('blur', '#old_password', function(){
   var old_password = $(this).val();
   if (old_password == '') {
    $('#old_error_message').show().html('Please type valid old_password');
    return false;
   }
  
            $.ajax({
                url: base_url+'/employee/check_old_password',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#change_password_form')[0]),
                cache: false,
                contentType: false,
                processData: false,

                beforeSend: function() {
                        $('#old_error_message').show().html('');
                        
                    },
                complete: function() {
                        //$('#email_error_message').show().html('');
                        
                    },
                
                success: function(json) {
                    if (json['error']) {
                        $('#old_error_message').show().html(json['error']); 
                        
                    }else{

                       $('#change_email_box').fadeOut();
                       
                    }
                },
                error: function(data) {
                    
                   var errors = data.responseJSON;
                    var errorsHtml = '';

                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });

                        $('#old_error_message').show().html(errorsHtml); 

                    
                }
            });
})

$(document).on('blur', '#password', function(){
   var password = $(this).val();
   if (password == '') {
    $('#password_error_message').show().html('Please type valid password');
    return false;
   }else{
    $('#password_error_message').show().html('');
    return true;
   }

   })
$(document).on('keyup','#password_confirmation', function() {
    var password = $('#password').val();
    if (password == $(this).val()) {
        $('#conf_error_message').addClass('greenclr').show().html('Password Matched');
        $('#password_submit').prop('disabled', false);
    } else{
        $('#conf_error_message').removeClass('greenclr').show().html('Password did not match');
        $('#password_submit').prop('disabled', true);
    }
    
})


$(document).on('click', '#password_submit', function(){
   
            $.ajax({
                url: $('#change_password_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#change_password_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#password_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#password_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#password_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#password_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{
                        $('#change_password_box').fadeOut();
                       $('#password').val('');
                       $('#old_password').val('');
                       $('#password_confirmation').val('');
                        $('#conf_error_message').removeClass('greenclr').hide().html('');
                        $('#password_error_message').hide().html('');
                        $('#old_error_message').hide().html(''); 
                    }
                },
                //error: function(xhr, ajaxOptions, thrownError) {
                //    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //}
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#password_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

 var social_row = '{{$social_row}}';
        if (social_row == 0) {
            social_row = 1;
        }
        function addMoreLinks() {
            var html = ' <div id="social_row'+social_row+'" class="form-group row ">';
                html += '<div class="col-md-4"><label class="required">Title</label><input type="text" name="social['+social_row+'][title]" class="form-control" placeholder="Facebook"></div>';
                html += '<div class="col-md-8"><label class="required">URL</label><div class="input-group">';

                html += '<input name="social['+social_row+'][url]" class="form-control" placeholder="https://www.facebook.com" type="url">';
                html += '<span class="input-group-btn"><button class="btn btn-danger delete_desc" onclick="$(\'#social_row'+social_row+'\').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></button></span>';
                html += '</div></div></div>';
                $('#social_links').append(html);
      social_row++;
        }


$(document).on('click', '#add_skill', function(){

     $('#add_skill_box').animate({
      height: 'toggle'
    });
})

$(document).on('click', '#edit_skill', function(){
    
     $('#skill_detail').animate({
      height: 'toggle'
    });
     if ($('#skill_detail').attr('class') == 'hidden') {
         
        $('#skill_detail').attr("class","show");
       $('#skl').fadeOut();
        $(this).html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false"><path d="M8 7l-5.9 4L1 9.5l6.2-4.2c.5-.3 1.2-.3 1.7 0L15 9.5 13.9 11 8 7z"></path></svg>');
        
        
    } else{
        $('#skl').fadeIn();
        $('#skill_detail').attr("class","hidden");
       $(this).html('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" data-supported-dps="16x16" fill="currentColor" width="16" height="16" focusable="false"><path d="M8 9l5.93-4L15 6.54l-6.15 4.2a1.5 1.5 0 01-1.69 0L1 6.54 2.07 5z"></path></svg>');
    }
})

$(document).on('click', '#skill_submit', function(){
   
            $.ajax({
                url: $('#add_skill_form').attr('action'),
                type: 'post',
                dataType: 'json',
                data: new FormData($('#add_skill_form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#skill_submit i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#skill_submit').prop('disabled', true);
                },
                complete: function() {
                    $('#skill_submit i').replaceWith('<i class="fa fa-paper-plane"></i>');
                    $('#skill_submit').prop('disabled', false);
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    }else{
                        $('#add_skill_box').fadeOut();
                       $('#total_skill_display').html(json['datas']);
                       
                    }
                },
                //error: function(xhr, ajaxOptions, thrownError) {
                //    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //}
                error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   var errors = data.responseJSON;
                    var errorsHtml = '';
                    $.each(errors.errors, function( key, value ) {
                      errorsHtml += '<p>' + value[0] + '</p>';
                    });
                        $('#skill_error').show().html(errorsHtml); //this is my div with messages
                    
                }
            });
})

$(document).on('click', '.contact_user', function(){
    var id = $(this).attr('id').replace('contact_user_','');
    register_popup(id)
    });


 //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
       
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
           
            //arrays of popups ids
            var popups = [];
       
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                       
                        document.getElementById('chat_main_'+id).remove();
                       
                        calculate_popups();
                       
                        return;
                    }
                }  
            }
       
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
               
                var iii = 0;

                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var eid = popups[iii];

                        var element = document.getElementById('chat_main_'+eid);


                        element.style.right = right + "px";
                        right = right + 275;
                        
                        element.style.display = "block";
                    }
                }
               
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById('chat_main_'+popups[jjj]);
                    element.style.display = "none";
                }
            }
           
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id)
            {
               
                for(var iii = 0; iii < popups.length; iii++)
                {  
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                   
                        popups.unshift(id);
                       
                        calculate_popups();
                       
                       
                        return;
                    }
                } 
               
               
              

                $.ajax({
                        type: "get",
                        url: base_url+'/employee/get_chat_box/'+id,
                        data: "",
                        cache: false,
                        success: function (datas) {

                          $('#count_msg'+id).remove();
                            
                            document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + datas;
                            scrollToBottomFunc();
                             popups.unshift(id);
                       
                            calculate_popups();
                            //$('.message-box textarea').emojioneArea();
                            pickImojiButton(id);
                            $('#chatinput_'+id).focus();

                        }
                    });         
            }
           
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //270 is width of a single popup box
                    total_popups = parseInt(width/270);
                }
               
                display_popups();
               
            }
           
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);


function scrollToBottomFunc() {
        $('.chats').animate({
            scrollTop: $('.chats').get(0).scrollHeight
        }, 50);
    }
$(document).on('click', '.chat-header', function(){
   
        var id = $(this).attr('id').replace('header_','');
        
        $('#chat_content'+id).slideToggle();
});
$(document).on('click', '.remove-chat-box', function(){
   
        var id = $(this).attr('id').replace('remove_chat_','');
        
        close_popup(id);
});


$(document).on('keyup', '.message-box textarea', function (e) {
            var message = $(this).val();
            var receiver_id = $(this).attr('data_id');
            var token = $('input[name=\'_token\']').val();

            // check if enter key is pressed and message is not null also receiver is selected
            if (e.keyCode == 13 && message != '' && receiver_id != '') {
                $(this).val(''); // while pressed enter text box will be empty

                var datastr = "receiver_id=" + receiver_id + "&message=" + message+ '&_token=' + token;
                
                $.ajax({
                    type: 'post',
                    url: base_url+'/employee/post_chat',
                    data: datastr,
                    cache: false,
                    success: function (data) {
                        $('#chat_message_'+receiver_id).append(data['data']);
                    },
                    error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                       var errors = data.responseJSON;
                        var errorsHtml = '';
                        $.each(errors.errors, function( key, value ) {
                          errorsHtml += '<p>' + value[0] + '</p>';
                        });
                            alert(errorsHtml); //this is my div with messages
                        
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });

$(document).on('click','.delete_chat', function(){
    if(confirm('Are you sure,  You Want To Delete This Conversation?')){
        var id = $(this).attr('id').replace('delete_','');
        var token = $('input[name=\'_token\']').val();
        $.ajax({
                    type: 'post',
                    url: base_url+'/employee/delete_chat',
                    data: '_token='+ token + '&id='+ id,
                    cache: false,
                    success: function (json) {
                        if (json['error']) {
                            alert(json['error']);
                        }else{
                            
                            $('#chat_'+id).remove();
                        }
                    },
                    error: function(data) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                       var errors = data.responseJSON;
                        var errorsHtml = '';
                        $.each(errors.errors, function( key, value ) {
                          errorsHtml += '<p>' + value[0] + '</p>';
                        });
                            alert(errorsHtml); //this is my div with messages
                        
                    },
                    complete: function () {
                        
                    }
                })
    }

})


function pickImojiButton(id){

      var button = document.querySelector('#emp_'+id);
      var picker = new EmojiButton({
        position: 'right-end',
        emojisPerRow: 6,

      });

      picker.on('emoji', emoji => {
        document.querySelector('#chatinput_'+id).value += emoji;
      });

      button.addEventListener('click', () => {
        picker.togglePicker(button);
      });
}

$(document).on('click', '#message_box h3', function(){ 
       
        
        $('#contacts').slideToggle();
});
$(document).on('click', '#message_link', function(){
   
       
        
        $('#contacts').slideToggle();
});
$(document).on('click', '.chat_photo_btn', function(){

  
    var id = $(this).attr('data_id');
    $('#form_chat_photo_upload').remove();
    var token = $('input[name=\'_token\']').val();
    $('body').prepend('<form enctype="multipart/form-data" id="form_chat_photo_upload" style="display: none;"><input type="file" id="chatphoto" name="file[]" multiple value="" accept="image/*"/><input type="text" name="_token" value="'+token+'" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="type" value="image" /></form>');

    $('#form_chat_photo_upload #chatphoto').trigger('click');

    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }

    timer = setInterval(function() {
        if ($('#form_chat_photo_upload #chatphoto').val() != '') {
            clearInterval(timer);

            $.ajax({
                url: base_url+'/employee/upload-chat-photo',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#form_chat_photo_upload')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    
                    $('#chatphoto_'+id).removeClass('fa fa-picture-o chat_photo_btn').addClass('fa fa-circle-o-notch fa-spin');
                    $('#chatphoto_'+id).prop('disabled', true);
                },
                complete: function() {
                    $('#chatphoto_'+id).removeClass('fa fa-circle-o-notch fa-spin').addClass('fa fa-picture-o chat_photo_btn');
                    $('#chatphoto_'+id).prop('disabled', false);
                    scrollToBottomFunc();
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    } else{
                       $('#chat_message_'+id).append(json['datas']);

                    }                    
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } 
    }, 500);
});

$(document).on('click', '.chat_file_btn', function(){

  
    var id = $(this).attr('data_id');
    $('#form_chat_photo_upload').remove();
    var token = $('input[name=\'_token\']').val();
    $('body').prepend('<form enctype="multipart/form-data" id="form_chat_photo_upload" style="display: none;"><input type="file" id="chatphoto" name="file[]" multiple value=""/><input type="text" name="_token" value="'+token+'" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="type" value="document" /></form>');

    $('#form_chat_photo_upload #chatphoto').trigger('click');

    if (typeof timer != 'undefined') {
        clearInterval(timer);
    }

    timer = setInterval(function() {
        if ($('#form_chat_photo_upload #chatphoto').val() != '') {
            clearInterval(timer);

            $.ajax({
                url: base_url+'/employee/upload-chat-photo',
                type: 'post',
                dataType: 'json',
                data: new FormData($('#form_chat_photo_upload')[0]),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    
                    $('#chatfile_'+id).removeClass('fa fa-paperclip chat_file_btn').addClass('fa fa-circle-o-notch fa-spin');
                    $('#chatfile_'+id).prop('disabled', true);
                },
                complete: function() {
                    $('#chatfile_'+id).removeClass('fa fa-circle-o-notch fa-spin').addClass('fa fa-paperclip chat_file_btn');
                    $('#chatfile_'+id).prop('disabled', false);
                    scrollToBottomFunc();
                },
                success: function(json) {
                    if (json['error']) {
                        alert(json['error']);
                    } else{
                       $('#chat_message_'+id).append(json['datas']);

                    }

                    
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } 
    }, 500);
});
$('.chats').on('scroll',function(){
    alert('scorlled');
})
$(document).on('scroll', '.chats', function(){


    let div = $(this).get(0);
    console.log(div.clientHeight+' '+div.scrollHeight+' '+div.scrollTop);
    
    if(div.scrollTop == 0) {
        console.log(div.clientHeight+' '+div.scrollHeight+' '+div.scrollTop);
    }
});

document.addEventListener('scroll', function (event) {
    var cls = $(event.target).attr('class');
    var ids = $(event.target).attr('id');
    var id = $(event.target).attr('data_id');
    var lm = $(event.target).attr('data_lm');
    var page = $('#page_'+id).val();
    
    if (cls === 'chats chat_border') { // or any other filtering condition      

        let div = $('#'+ids).get(0);
        if (div.scrollTop === 0) {

            if (lm == 2) {
                console.log(ids+' '+cls);  
                $.ajax({
                        type: "get",
                        url: base_url+'/employee/get_chat_box/'+id,
                        data: "page="+page,
                        cache: false,
                        beforeSend: function() {
                            $('#lodemorechat').remove();
                            var text = '<span style="--i:1">W</span><span style="--i:2">r</span><span style="--i:3">i</span><span style="--i:4">t</span><span style="--i:5">i</span><span style="--i:6">n</span><span style="--i:7">g</span><span style="--i:8"> </span><span style="--i:9">.</span><span style="--i:10">.</span><span style="--i:11">.</span>';
                            var html = '<li id="lodemorechat" class="pl-2 pr-2 rounded text-white text-center send-msg mb-1 unread_message">'+text+'</li>';
                            $('#chat_message_'+id).prepend(html);
                        },
                        success: function (datas) {
                            $('#lodemorechat').remove();
                         $('#chat_message_'+id).prepend(datas['data']);
                         $('#'+ids).attr('data_lm',datas['ldmr']);
                         $('#page_'+id).val(Number(page) + Number(1));

                        }
                    });
            }
        }
    }
}, true /*Capture event*/);


//Ganga for participator
$(document).on('click', '#message_box_front h3', function(){

    $('#contacts_front').slideToggle();
    $.ajax({
        type:'get',
        url: base_url + '/enroll/company/' + slug + '/show-business-user/'+ receiver_bid,
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        data: { "receiver_id": receiver_bid},
        success: function(response){
            $('#contacts_front').html(response);
        }
    });
});

$(document).on('click', '.business_user', function(){
    var business_id = $(this).attr('id').replace('contact_user_','');
    register_popup_business(business_id);
});

function register_popup_business(business_id){

    for(var iii = 0; iii < popups.length; iii++)
    {
        //already registered. Bring it to front.
        if(business_id == popups[iii])
        {
            Array.remove(popups, iii);

            popups.unshift(business_id);

            calculate_popups();


            return;
        }
    }


    $.ajax({
            type: "get",
            url:  base_url + '/enroll/company/' + slug + '/get_chat_box/'+business_id,
            data: {"business_user_id" : business_id},
            cache: false,
            success: function (datas) {                
                $('#count_msg'+business_id).remove();

                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + datas;
                scrollToBottomFunc();
                popups.unshift(business_id);

                calculate_popups();
                //$('.message-box textarea').emojioneArea();
                pickImojiButton(business_id);
                $('#chatinput_'+business_id).focus();

            }
        });
}

$(document).on('click', '.chat-header-business', function(){
    var id = $(this).attr('id').replace('header_','');
    $('#chat_content'+id).slideToggle();
});

$(document).on('keyup', '.message-box-for-participate textarea', function (e) {

    var message = $(this).val();
    var receiver_id = $(this).attr('data_id');
    var token = $('input[name=\'_token\']').val();

    // check if enter key is pressed and message is not null also receiver is selected
    if (e.keyCode == 13 && message != '' && receiver_id != '') {
        $(this).val(''); // while pressed enter text box will be empty

        var datastr = "receiver_id=" + receiver_id + "&message=" + message+ '&_token=' + token;
        $.ajax({
            type: 'post',
            url: base_url + '/enroll/company/' + slug + '/send-message',
            data: datastr,
            cache: false,
            success: function (data) {
                // console.log(data);
                $('#chat_message_'+receiver_id).append(data['data']);
            },
            error: function(data) {
                // console.log(data);
                var errors = data.responseJSON;
                var errorsHtml = '';
                $.each(errors.errors, function( key, value ) {
                  errorsHtml += '<p>' + value[0] + '</p>';
                });
                    alert(errorsHtml); //this is my div with messages

            },
            complete: function () {
                scrollToBottomFunc();
            }
        });
    }
});


//For business
$(document).on('click', '#message_box_participator h3', function(){
    $('#contacts_participators').slideToggle();
    $.ajax({
        type: 'get',
        url: base_url+'/employer/get_participate_users',
        data: '',
        cache: false,
        success: function(datas){
            $('#contacts_participators').html(datas);
        }
    });
});

$(document).on('click', '.participate_user', function(){
    var id = $(this).attr('id').replace('contact_user_','');
    register_popup_participator(id)
});

function register_popup_participator(id){

        for(var iii = 0; iii < popups.length; iii++)
        {
            //already registered. Bring it to front.
            if(id == popups[iii])
            {
                Array.remove(popups, iii);

                popups.unshift(id);

                calculate_popups();


                return;
            }
        }

        $.ajax({
            type: "get",
            url: base_url+'/employer/get_chat_box/'+id,
            data: {
                'user_id' : id,
            },
            cache: false,
            success: function (datas) {
                // console.log(datas);
                $('#count_msg'+id).remove();
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + datas;
                // scrollToBottomFunc();
                popups.unshift(id);

                calculate_popups();
                //$('.message-box textarea').emojioneArea();
                pickImojiButton(id);
                $('#chatinput_'+id).focus();

            }
        });
}

$(document).on('click', '.chat-header-participate', function(){

    var id = $(this).attr('id').replace('header_','');
    $('#chat_content'+id).slideToggle();
});

$(document).on('keyup', '.message-box-for-business textarea', function (e) {

    var message = $(this).val();
    var receiver_id = $(this).attr('data_id');
    var token = $('input[name=\'_token\']').val();

    // check if enter key is pressed and message is not null also receiver is selected
    if (e.keyCode == 13 && message != '' && receiver_id != '') {
        $(this).val(''); // while pressed enter text box will be empty

        var datastr = "receiver_id=" + receiver_id + "&message=" + message+ '&_token=' + token;
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            url: base_url + '/employer/send-message',
            data: datastr,
            cache: false,
            success: function (data) {
                $('#chat_message_'+receiver_id).append(data['data']);
            },
            error: function(data) {
                // console.log(data);
                var errors = data.responseJSON;
                var errorsHtml = '';
                $.each(errors.errors, function( key, value ) {
                errorsHtml += '<p>' + value[0] + '</p>';
                });
                    alert(errorsHtml); //this is my div with messages

            },
            complete: function () {
                scrollToBottomFunc();
            }
        });
    }
});
//