@foreach($data['message'] as $message)
                             @php($type = ['image','document'])
                             @php($mm = $message->message)
                             @if(in_array($message->type,$type))
                             @php($mm = \App\ChatMessage::getDocuments($message->documents,$message->type,$message->id))

                             @endif
                             @if($message->message_from == auth()->guard('employee')->user()->id)
                             

                             <li id="chat_{{$message->id}}" class="pl-2 pr-2 rounded text-white text-center send-msg mb-1 {{$message->view_status == 1? '' : 'unread_message'}}">{!! $mm !!} {!! $message->view_status == 1? '<i class="fa fa-check" aria-hidden="true"></i>' : '' !!}<i id="delete_{{$message->id}}" class="fa fa-remove delete_chat"></i></li>
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