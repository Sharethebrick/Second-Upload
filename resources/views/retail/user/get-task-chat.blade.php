<div class="chats-alls" id="main-ac">	
@if(count($taskMsg)>0)    
<ul class="list-all-chat mCustomScrollbar ScrollStyle task-chat" id="ScrollStyle">
    @foreach($taskMsg as $key)
        @if($key->sent_by == Auth::User()->id)
        <li class="right-msg" >
        @php $taskId = $key->task_id; @endphp
        
            <div class="msg-ic">
            {{convertLinksClickable($key->note_message)}} 
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
            {{convertLinksClickable($key->note_message)}} 
            </div>
            <div class="msg-ic-content">
            <span class="author"><small><i>{{$key->name . $key->last_name}}</i></small></span>
            <span class="time-msg">
                <i class="fa fa-clock-o"></i>  
                {{get_time($key->created_at)}} @if(get_time($key->created_at) != 'just now')ago @endif</span> 
            </div>
        </li>
@endif	
@endforeach	
</ul>

@else
    <p class="no_msg"> No Messages. </p>
@endif
</div>
				<div class="chat-foots" >
					<input type="hidden" name="{{Auth::user()->id}}" id="brick_id" value="{{$task_id}}">
					
					@if (Auth::check())
						@if(check_task_member($task_id,Auth::user()->id))
						<div class="cont-all-set ">	
							<input type="hidden" name="chatTaskId" id="chatTaskId" value="{{$task_id}}">										
							<input  type="text" class="fld-sa task_message_for_send" placeholder="Type message here...">
							<a href="javascript:void(0)" sender-id="{{Auth::User()->id}}"   class="sbmt-s send_task_msg_btn"> <i class="fa fa-paper-plane"></i> <span>Send</span></a>
						</div>		
						@endif
				@endif									
				</div>	

