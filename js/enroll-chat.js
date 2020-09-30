var base_url = window.location.origin+'/rollingnexus';
var user_image = $('#user_image').val();
var my_id = $('#my_id').val();
var pusher_key = $('#pusher_key').val();
var interval;
var document_title = document.title; 
var boxinterval;
var receiver_bid = $("#b_id").val();
var slug = $("#c_slug").val();

$(document).ready(function(){    

    // getContactUsers();
    // getBusinessUser(receiver_bid);
    // getBusinessUser(receiver_bid);

    // setInterval(function(){
    //     getContactUsers() // this will run after every 5 seconds
    //     getBusinessUser(receiver_bid);

    // }, 60000);   

    //preser start here

    Pusher.logToConsole = false;

    var pusher = new Pusher(pusher_key, {
      cluster: 'ap2',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      
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


