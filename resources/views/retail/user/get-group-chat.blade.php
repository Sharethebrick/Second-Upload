@if(count($groupMsgs)>0)
            @foreach($groupMsgs as $key)
                    @if($key->sent_by == Auth::User()->id)
                    <li class="right-msg" >
                        <div class="msg-ic">
                              {{convertLinksClickable($key->message_text)}} <i class="fa fa-times-circle deleteMsg" style="color:#000;cursor: pointer;" title='Delete Message' aria-hidden="true" data-id="{{$key->id}}"></i>
                        </div>
                        <div class="msg-ic-content">
                            <span class="time-msg">
                            
                            <i class="fa fa-clock-o"></i> 
                                {{get_time($key->created_at)}} @if(get_time($key->created_at) != 'just now')ago @endif
                            </span> 
                        </div>
                    </li>
                    @else
                        <li>                        
                            <div class="msg-ic">
                                    {{convertLinksClickable($key->message_text)}}
                            </div>
                            <div class="msg-ic-content">
                            <span class="author"><small><i>{{$key->name . $key->last_name}}</i></small></span>
                            <span class="time-msg">
                                <i class="fa fa-clock-o"></i> {{get_time($key->created_at)}} @if(get_time($key->created_at) != 'just now')ago @endif</span> 
                            </div>
                        </li>
                        
                    @endif		
            @endforeach												
            
@else
    <p class="no_msg"> No Messages. </p>
@endif
