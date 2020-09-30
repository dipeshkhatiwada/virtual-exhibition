<div class="chat-main" id="chat_main_{{$data['user_id']}}">
                <div class="col-md-12 chat-header rounded-top text-white" id="header_{{$data['user_id']}}">
                    <div class="row">
                        <div class="col-md-8 username pl-2">
                            @if(\App\Employees::CheckOnline($data['user_id']))
                            <i class="fa fa-circle text-success" aria-hidden="true"></i>
                            @endif
                            <h6 class="m-0">{{$data['name']}}</h6>
                        </div>
                        <div class="col-md-4 options text-right pr-2">
                            <!--<i class="fa fa-plus mr-2" aria-hidden="true"></i>
                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                            <i class="fa fa-circle text-success live-video mr-1" aria-hidden="true"></i>
                            <i class="fa fa-phone mr-2" aria-hidden="true"></i>
                            <i class="fa fa-cog mr-2" aria-hidden="true"></i> -->
                            
                            <i id="remove_chat_{{$data['user_id']}}" class="fa fa-remove remove-chat-box"></i>
                          </div>
                    </div>
                </div>
                <div class="chat-content" id="chat_content{{$data['user_id']}}">
                   
                    <div data_id="{{$data['user_id']}}" id="chatbx_{{$data['user_id']}}" data_lm="{{$data['ldmr']}}" class="chats chat_border">
                        <ul class="" id="chat_message_{{$data['user_id']}}">
                             @foreach($data['message'] as $message)
                             @php($type = ['image','document'])
                             @php($mm = $message->message)
                             @if(in_array($message->type,$type))
                             @php($mm = \App\ChatMessage::getDocuments($message->documents,$message->type,$message->id))

                             @endif
                             @if($message->message_from == auth()->guard('employee')->user()->id)
                             

                             <li id="chat_{{$message->id}}" class="pl-1 pr-1 rounded text-white text-center send-msg mb-1 {{$message->view_status == 1? '' : 'unread_message'}}">{!! $mm !!} {!! $message->view_status == 1? '<i class="fa fa-check" aria-hidden="true"></i>' : '' !!}<i id="delete_{{$message->id}}" class="fa fa-remove delete_chat"></i></li>
                             @else
                              <li id="chat_{{$message->id}}" class="p-1 rounded mb-1">
                                <div class="receive-msg">
                                    <div class="receive-msg-img">
                                        <img src="{{asset(\App\Employees::getPhoto($message->message_from))}}">
                                    </div>
                                    <div class="receive-msg-desc rounded text-center mt-1 ml-1 pl-1 pr-1">
                                        <p class="mb-0 mt-1 pl-1 pr-1 rounded ">
                                            {!! $mm !!}
                                            <div class="clear"></div>
                                             <i id="delete_{{$message->id}}" class="fa fa-remove delete_chat"></i>
                                        </p>
                                        
                                    </div>
                                </div>
                               
                            </li>
                             @endif
           
                            @endforeach
                            
                        </ul>
                    </div>
                    <div class="message-box chat_border pl-2 pr-2 border-top-0">
                        <textarea type="text" id="chatinput_{{$data['user_id']}}" data_id="{{$data['user_id']}}" class="pl-0 pr-0 w-100" placeholder="Type a message..."></textarea>
                        <input type="hidden" id="page_{{$data['user_id']}}" value="{{$data['page']}}">
                        <div class="tools">
                            <i id="chatphoto_{{$data['user_id']}}" data_id="{{$data['user_id']}}" class="fa fa-picture-o chat_photo_btn" aria-hidden="true"></i>
                            
                            <i id="emp_{{$data['user_id']}}" data_id="{{$data['user_id']}}" class="fa fa-meh-o emojipicker" aria-hidden="true"></i>
                            <i id="chatfile_{{$data['user_id']}}" data_id="{{$data['user_id']}}" class="fa fa-paperclip chat_file_btn" aria-hidden="true"></i>
                           <!-- <i class="fa fa-telegram" aria-hidden="true"></i>
                            <i class="fa fa-bell" aria-hidden="true"></i>
                            <i class="fa fa-gamepad" aria-hidden="true"></i>
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <i class="fa fa-folder" aria-hidden="true"></i>
                            <i class="fa fa-thumbs-o-up m-0" aria-hidden="true"></i>
                        -->
                        </div> 
                    </div>
                </div>
            </div>