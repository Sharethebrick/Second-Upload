@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Chat</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <div class="bg-box-als">
						<div class="box-main-stc">
							<img src="{{url('/')}}/uploads/files/{{$listing_details[0]->image}}" class="icm-str">
							<h4> <b> Property: </b> 	{{$listing_details[0]->name}} <span class="rigtd"><b> ID </b> #{{$listing_details[0]->id}} </span> </h4>
							<h5> <b> Client </b> {{$listing_details[0]->fname}} {{$listing_details[0]->lname}} </h5>
							<h5> <b> Date/Time </b> {{showDateFormatam($booking_details->created_at)}} </h5>
							<h5> <b> Area </b> @if($listing_details[0]->type == 3 || $listing_details[0]->type == 4 || $listing_details[0]->type == 5  || $listing_details[0]->type == 6){{$listing_details[0]->size}} {{$listing_details[0]->size_unit}} @else --- @endif </h5>
						</div>
                       <div class="messages-cont">
							<div class="row">
								<!--div class="col-md-4 pr-0">
									<div class="list-chts">
										<div class="heds">
											<h5> Messages (14) </h5>
										</div>
										<ul class="list-usrs mCustomScrollbar"> 
											<li> 
												<a href="#" class="name-ls">
													<span class="onln-dot"></span>
													<img src="{{url('/')}}/img/11.jpg">
													<h4> John Smith </h4>
													<p> johnsmith@gmail.com</p>
												</a>
											</li>
											
											<li> 
												<a href="#" class="name-ls">
													<span class="onln-dot"></span>
												<img src="{{url('/')}}/img/12.jpg">
													<h4> Hanry James </h4>
													<p> hanryjames@gmail.com</p>
												</a>
											</li>
											<li> 
												<a href="#" class="name-ls">
													<span class="onln-dot"></span>
												<img src="{{url('/')}}/img/13.jpg">
													<h4> John Smith </h4>
													<p> johnsmith@gmail.com</p>
												</a>
											</li>
											<li> 
												<a href="#" class="name-ls active">
													<img src="{{url('/')}}/img/14.jpg">
													<h4> Christon James </h4>
														<p> christon@gmail.com</p>
												</a>
											</li>
											<li> 
												<a href="#" class="name-ls">
													<span class="onln-dot"></span>
													<img src="{{url('/')}}/img/15.jpg">
													<h4> Hanry James </h4>
														<p> hanryjames@gmail.com</p>
												</a>
											</li>
											<li> 
												<a href="#" class="name-ls">
													<span class="onln-dot"></span>
												<img src="{{url('/')}}/img/16.jpg">
													<h4> John Smith </h4>
													<p> johnsmith@gmail.com</p>
												</a>
											</li>

										</ul>
									</div>
								</div-->
								<div class="col-md-12">
									<div class="msgs-all">
										<div class="hads-es">
										<img src="{{!empty($other_user->image) ? url('/uploads/user/').'/'.$other_user->image : url('/').'/img/user.png'}}">
											<h4> {{$other_user->name}} {{$other_user->last_name}} </h4>
											<span class="onln"> <i class="fa fa-circle" aria-hidden="true"></i> Online </span>
										</div>
										<input type="hidden" id="count_msg_id" value="{{count($chat)}}">
										<div class="chats-alls" id="main-ac">
											<ul class="list-all-chat mCustomScrollbar">
												 @if(count($chat)>0)
												    @foreach($chat as $key)
														 @if($key->senderid == Auth::User()->id)
														 	<li class="right-msg">
																<div class="msg-ic">
																	{{convertLinksClickable($key->message)}}
																</div>
																<span class="time-msg"><i class="fa fa-clock-o"></i> {{get_time($key->sent_on)}} @if(get_time($key->sent_on) != 'just now')ago @endif</span> 
															</li>
														 @else
														 	<li>
																<img src="{{!empty($key->senderimage) ? url('/uploads/user/').'/'.$key->senderimage : url('/').'/img/user.png'}}" class="user-img">
																<div class="msg-ic">
																	{{convertLinksClickable($key->message)}}
																</div>
																<span class="time-msg"><i class="fa fa-clock-o"></i> {{get_time($key->sent_on)}} @if(get_time($key->sent_on) != 'just now')ago @endif</span> 
															</li>
														 @endif	
													@endforeach												
													
												@else
													<p class="no_msg"> No Messages. </p>
												@endif
												 <span class="chat_data_list"></span>
											</ul>
										</div>
										<div class="chat-foots">
											<div class="cont-all-set">
												<input type="text" class="fld-sa text_message_for_send" placeholder="Type message here...">
												<a href="javascript:void(0)" sender-id="{{Auth::User()->id}}" receiver-id="{{$other_user->id}}" listing-id="{{$listing_details[0]->id}}" class="sbmt-s send_text_msg_btn"> <i class="fa fa-paper-plane"></i> <span>Send</span></a>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
                </div>
            </div>
        </section>


@endsection
@section('footer_scripts')
<script type="text/javascript">
	setTimeout(function(){ $('#main-ac .mCustomScrollbar').mCustomScrollbar("scrollTo","bottom"); }, 2000);
	  //chat start here
   
   $(document).on('click', '.send_text_msg_btn', function() {
    	var dis = $(this);
    	var message = $('.text_message_for_send').val();
    	if(message != ''){
			$(this).find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
			$(this).prop('disabled',true);
			var sender = $(this).attr('sender-id');
			var receiver = $(this).attr('receiver-id');
			var listing_id = $(this).attr('listing-id');
			var form_data = new FormData();
			form_data.append("message", message); 
			form_data.append("sender", sender); 
			form_data.append("receiver", receiver); 
			form_data.append("listing_id", listing_id); 
			form_data.append('_token', '{{ Session::token() }}');
   
			$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,       
						type: 'post',
						url:'{{url("/")}}'+'/save_listing_message',
						success:function(data)
						{ 
							$('.no_msg').hide();
							@if(count($chat) == 0)
							setTimeout(function(){ doWork(); }, 500);
							@endif
							$('.text_message_for_send').val('');
		
							dis.prop('disabled',false);
							dis.find('span').html('Send');  
				}
			});
        }else{
      	swal("Please type Any message!");
    	}
   
    
   });
   $(".text_message_for_send").keypress(function(e) {
      if(e.which == 13) {
   
   var message = $('.text_message_for_send').val();
    if(message != ''){
      $('.send_text_msg_btn').find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
      $('.send_text_msg_btn').prop('disabled',true);
      var sender = $('.send_text_msg_btn').attr('sender-id');
      var receiver = $('.send_text_msg_btn').attr('receiver-id');
      var listing_id = $('.send_text_msg_btn').attr('listing-id');
      var form_data = new FormData();
      form_data.append("message", message); 
      form_data.append("sender", sender); 
      form_data.append("receiver", receiver); 
      form_data.append("listing_id", listing_id); 
      form_data.append('_token', '{{ Session::token() }}');
   
      $.ajax({
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,       
                type: 'post',
                url:'{{url("/")}}'+'/save_listing_message',
                success:function(data)
                { 
                 	$('.no_msg').hide();
	             	@if(count($chat) == 0)
	                   setTimeout(function(){ doWork(); }, 500);
	             	@endif
              		$('.text_message_for_send').val('');
   
		            $('.send_text_msg_btn').prop('disabled',false);
		          	$('.send_text_msg_btn').find('span').html('Send');  
          }
        });
    }else{
      swal("Please type Any message!");
    }
      
      }
   });

    @if(count($chat)>0)
  	 setTimeout(function(){ doWork(); }, 500);
	@endif
		
</script>
@stop