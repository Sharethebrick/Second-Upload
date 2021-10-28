@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Reset Password</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

    <!-- Start FAQ Area -->
        <section class="faq-area ptb-100">
            <div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 offset-lg-3 offset-mg-3">
				@if($user_id == 0)
				<div class="col-lg-12">
				   	<div class="alert alert-info">
				   		Invalid page
				   	</div>
			   	</div>
				@else
				<div class="forgot-color">
					<div class="row">
						<div class="col-lg-12">
							<div class="forgot-input">
								<form id="user_resetpassword_form" name="registration" class="w-100 form-w-roo">
								@csrf
								<input type="hidden" name="user_id" value="{{$user_id}}">
									<div class="row">
											<div class="col-md-12 forgot-errors-success" style="display: none;"></div>
											<div class="col-lg-12">
												<div class="forgot-heading mb-4">
													<h1>Reset Password</h1>
													<p>Enter new password to set your password.</p>
												</div>					 
											</div>							
											<div class="col-lg-12">
												<div class="form-group">
													<input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password">
												</div>
											</div>

											<div class="col-lg-12">
												<div class="form-group">
													<input type="password" name="confirm" id="c_password" class="form-control" placeholder="Confirm Password">
												</div>
											</div>												
											<div class="col-lg-12 col-md-12">
												<button type="submit" class="default-btn forgot-def-btn submit_btn">Set Password</button>
											</div>								
									</div>				
								</form>				
							</div>
						</div>			
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</section>

@endsection
@section('footer_scripts')
<script type="text/javascript">  
$(function($) {
    $('#user_resetpassword_form').validate({
    rules: {    
        password:
        {
        	required:true,
        	minlength: 6,
        },
        confirm:
        {
        	required:true,
        	minlength: 6,
        	equalTo: "#password"

        },
    },  
          highlight: function(element) {
            $(element).parent().addClass('has-error');
          },
          unhighlight: function(element) {
            $(element).parent().removeClass('has-error');
          },
              errorElement: 'span',
              errorClass: 'validation-error-message help-block form-helper bold',
              errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
                } else {
                  error.insertAfter(element);
               }
             },
        submitHandler: function(form) 
        { 
            $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>'); 
            $('.submit_btn').prop('disabled',true);            
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/set_password',
                    data: new FormData(form),
                    contentType: false, 
                    cache: false, 
                    processData:false,
                    success:function(result)
                    { 
                        $('.submit_btn').html('Login'); 
                        $('.submit_btn').prop('disabled',false); 
                        var obj = $.parseJSON(result); 
                        if(obj.status == 1){
                          swal({title: "Success!", text: "Password updated successfully.", type: "success"},
                              function(){ 
                                 window.location.href= '{{url("/")}}'+'/login';
                              }
                           ); 
                        }else{
                          swal({title: "Error", text: "Error while updating password, Please try later.", type: "error"});
                        }
                    }
            });
        } 
        
    });
});

</script>
@stop