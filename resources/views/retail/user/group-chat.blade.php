@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Group Chat</h2>
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
						<!-- <div class="box-main-stc"> -->
						@if($admin == null)<span class="badge badge-primary" style="cursor: pointer;" id="leftGrop">Left Group</span>@endif
						<!-- </div> -->
                       <div class="messages-cont">
							<div class="row">							
								<div class="col-md-12">
									<div class="msgs-all">
										<div class="hads-es">
                                        <h3> <a href="{{url(getUrl().'/groups')}}"><i class="fa fa-angle-left"></i></a>  <b>@isset($groupData){{$groupData->group_name}}@endisset  Group </b></h3>
										
										</div>
										<input type="hidden" id="count_msg_id" value="">
										<div class="chats-alls" id="main-ac">
											<ul class="list-all-chat mCustomScrollbar group-chat"></ul>
											
										</div>
										
										<div class="chat-foots" >
											<i  class="fa fa-paperclip image"><small>Upload file</small></i> &nbsp;&nbsp;
                                            <i style="color:green; display: none;" class="fa fa-check-circle" aria-hidden="true"></i><small>&nbsp;Max file Size 4MB</small>
    										&nbsp;
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline1" name="visibility" class="custom-control-input visibility" checked="checked" value="private">
                                                <label class="custom-control-label" for="customRadioInline1">Private</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="customRadioInline2" name="visibility" class="custom-control-input visibility" value="public">
                                                <label class="custom-control-label" for="customRadioInline2">Public</label>
                                            </div>
                                            <input type="file" id="my_file" style="display: none;" />
                                            <input type="hidden" name="group_id" id="group_id" value="@isset($groupData){{$groupData->id}}@endisset">
											<div class="cont-all-set">
										
												<input  type="text" class="fld-sa text_message_for_send" placeholder="Type message here...">
												<a href="javascript:void(0)" sender-id="{{Auth::User()->id}}"   class="sbmt-s send_text_msg_btn"> <i class="fa fa-paper-plane"></i> <span>Send</span></a>
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
<link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">

$(document).on("click", '.deleteMsg', function(event) { 
    var form = this;
    var msgId = $(this).attr("data-id")
    swal({
          title: "Are you sure?",
          text: "Your message will be removed permanentaly",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {           
			jQuery.ajax({
                    data: {'msgId':msgId,"_token": "{{ csrf_token() }}"},       
                    type: 'post',
                    url:'{{url("/")}}'+'/retail/delete-msg',
                    success:function(result)
                    {            
                       
                        var res = JSON.parse(result);
                        if(res.status == 1)   {         
                        swal({
                            title: 'Success',
                            icon: 'success'
                            });
                            setTimeout(function(){ 
                                location.reload();
                            }, 500);
                        }else{
                            swal("Something went wrong");
                        }
                    }
			});
           
          } 
        //   else {
        //     swal("Cancelled", "Something went wrong :)", "error");
        //   }
        });
});



	$("#leftGrop").click(function() {
      var form = this;  
	  var group_id = jQuery("#group_id").val();
      swal({
          title: "Are you sure?",
          text: "You will be removed from group permanentaly",
          icon: "warning",
          buttons: [
            'No, cancel it!',
            'Yes, I am sure!'
          ],
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {           
			jQuery.ajax({
                    data: {'group_id':group_id,"_token": "{{ csrf_token() }}"},       
                    type: 'post',
                    url:'{{url("/")}}'+'/retail/left-group',
                    success:function(data)
                    {                        
                        swal({
                            title: 'Success',
                            icon: 'success'
                            });
                            setTimeout(function(){ 
                                location.reload();
                            }, 500);
                    }
			});
           
          } else {
            swal("Cancelled", "Something went wrong :)", "error");
          }
        });
    });
  

setTimeout(function(){ $('#main-ac .mCustomScrollbar').mCustomScrollbar("scrollTo","bottom"); }, 2000);
jQuery( document ).ready(function() {
    console.log( "ready!" );
    var group_id = jQuery("#group_id").val();
    load_chat(group_id);
    
});



$(".image").click(function() {
    $("input[id='my_file']").click();
    
});

$("input[id='my_file']").change(function() {
    $(".fa-check-circle").show();
});

function load_chat(group_id){
    jQuery.ajax({
					
                    data: {'group_id':group_id,"_token": "{{ csrf_token() }}"},       
                    type: 'post',
                    url:'{{url("/")}}'+'/retail/get-group-chat',
                    success:function(data)
                    {                        
                        jQuery(".group-chat").html(data);
                    }
			});
}
// setInterval(function(){ 
//     var group_id = jQuery("#group_id").val();
//     load_chat(group_id); 
// }, 4000);

$(document).on('click', '.send_text_msg_btn', function() {
	var file_data = $('#my_file').prop('files')[0];
   
	var form_data = new FormData();
	var message = '';
	var visibility = $(".visibility:checked").val();
    
	var content ='';
		if(file_data === null || file_data === undefined){
			 message = $('.text_message_for_send').val();
		}else{
			message = file_data;
			content ='file';
		}
		form_data.append("message", message); 
		
    	var dis = $(this);
    	// var message = $('.text_message_for_send').val();
       
       
    	if(message != ''){
		
			$(this).find('span').html('<i class="fa fa-spinner fa-spin"></i>');  
			$(this).prop('disabled',true);
			var sender = $(this).attr('sender-id');			
            var group_id = jQuery("#group_id").val();
			
			
			form_data.append("content", content); 
			form_data.append("sent_by", sender); 
			form_data.append("group_id", group_id); 
			form_data.append("visibility", visibility); 
			form_data.append('_token', '{{ Session::token() }}');
			$.ajax({
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,       
						type: 'post',
						url:'{{url("/")}}'+'/retail/save-group-msg',
						success:function(result)
						{ 
                            $('.text_message_for_send').val('');
                            $('#my_file').val('');
							var res = JSON.parse(result);                           
							if(res.status == 1){
                                load_chat(group_id);
                                $(".fa-check-circle").hide();
                            }else if(res.status == 2){
                                swal("Allowed file size exceeded. (Max. 4 MB)");
                                $(".fa-check-circle").hide();
                            }else if(res.status == 3){
                                swal("This field allows xls,csv,doc and pdf files only ");
                                $(".fa-check-circle").hide();
                            }else{
                                swal("Something went wrong!");
                                $(".fa-check-circle").hide();
                            }

							dis.prop('disabled',false);
							dis.find('span').html('Send');						  
				}
			});
        }else{
      	swal("Please type Any message!");
    	}
   });
</script>
@stop