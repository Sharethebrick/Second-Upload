@extends('layouts.app')

@section('content')

   <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>User Account</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
		<section class="login-area ptb-100">
            <div class="container">
                <div class="bg-box-als">
					<form id="user_signup_form" enctype="multipart/form-data">
					 	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						<div class="billing-details">
						<h3 class="title font-strs">User Account	</h3>
						<div class="row">
							<div class="col-lg-4 col-md-12">
								<div class="user-img-at">
									<div class="img-box-st">
										<img id="preview_img" src="{{url('/')}}/img/user.png">
										<label class="edit-imgs" for="img-upload">
											<i class="bx bx-pencil"></i>
											<input type="file" id="img-upload" accept="image/*" name="image" style="visibility:hidden; height:0px; width:0px;">
										</label>
									</div>
								</div>
							</div>
							<div class="col-lg-8 col-md-12">


									<div class="row">
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>First Name <span class="required">*</span></label>
												<input type="text" name="name" class="form-control">
											</div>
										</div>

										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Last Name <span class="required">*</span></label>
												<input type="text" name="last_name" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<!-- <label>Company Name <span class="required">*</span></label> -->
                                                <label>Company Name</label>
												<input type="text" name="company_name" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<!-- <label>Company Address <span class="required">*</span></label> -->
                                                <label>Company Address</label>
												<input type="text" name="company_address" class="form-control" id="autocomplete">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<!-- <label>Company Address <span class="required">*</span></label> -->
                                                <label>Company Icon</label>
												<input type="file" name="company_icon" class="form-control" >
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<!-- <label>Business Number <span class="required">*</span></label> -->
                                                <label>Business Number</label>
												<input type="number" name="business_number" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Email Address <small> (business)	</small>	 <span class="required">*</span></label>
												<input type="text" name="email" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6" style="display: none;">
											<div class="form-group">
												<label>Email Address  <span class="required">*</span></label>
												<input type="text" name="business_email" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Website  <!-- <span class="required">*</span> --></label>
												<input type="text" name="website" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Password  <span class="required">*</span></label>
												<input type="password" name="password" id="password" class="form-control">
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Confirm Password  <span class="required">*</span></label>
												<input type="password" name="confirm" id="confirm" class="form-control">
											</div>
										</div>

										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<!-- <label>Type of Business <span class="required">*</span></label> -->
                                                <label>Type of Business</label>

												<div class="select-box">
												<input type="text" name="type_of_busines" class="form-control">
													<!-- <select class="form-control" name="type_of_busines">
														<option value="">Select One</option>
														<option value="1" @if($type=='1') selected @endif>Service </option>
														<option value="2" @if($type=='2') selected @endif>Retail</option>			N
													</select> -->
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12">
											<div class="form-group">
												<!-- <label>Business Description <span class="required">*</span></label> -->
                                                <label>Business Description</label>
												<textarea name="business_desc" id="notes" cols="30" rows="5" placeholder="" class="form-control"></textarea>
											</div>
										</div>
										<div class="col-lg-12 col-md-12">
											<h3 class="title mb-3">Social Media Accounts	</h3>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Facebook  <!-- <span class="required">*</span> --></label>
												<div class="icon-w-sc">
													<input type="url" name="facebook_lnk" class="form-control" placeholder="www.facebook.com">
													<i class="bx bxl-facebook"></i>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Twitter <!--  <span class="required">*</span> --></label>
												<div class="icon-w-sc">
													<input type="url" name="twitter_lnk" class="form-control" placeholder="www.twitter.com">
													<i class="bx bxl-twitter"></i>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-6">
											<div class="form-group">
												<label>Instagram  <!-- <span class="required">*</span> --></label>
												<div class="icon-w-sc">
													<input type="url" name="instagram_lnk" class="form-control" placeholder="www.instagram.com">
													<i class="bx bxl-instagram"></i>
												</div>
											</div>
										</div>
										<div class="col-lg-12 col-md-12">
											<button class="btn btn-save-stt submit_btn" type="submit"> Submit </button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</form>
				</div>
            </div>
        </section>
		<!-- End Checkout Area -->
@endsection
@section('footer_scripts')
<script type="text/javascript">
	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();

	    reader.onload = function(e) {
	      $('#preview_img').attr('src', e.target.result);
	    }

	    reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}
	$(document).on('change','#img-upload',function(){
		var fileExtension = ['jpeg', 'jpg', 'png', 'gif'];
		if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
			swal("Only formats are allowed : "+fileExtension.join(', '));
			$(this).val(null);
			return false;
   		}else{
   			readURL(this);
   		}

	});

$(function($) {
$('#user_signup_form').validate({
    ignore: [],
    rules: {
         email:
        {
            required: true,
            email: true ,
             remote: {
                    url: '{{url("/")}}'+'/checking_user',
                    type: "post",
                    data:{_token:'{{ Session::token() }}'}

                 }
        },
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
        name:
        {
        	required:true
        },
        last_name:
        {
        	required:true
        },
        // company_name:
        // {
        // 	required:true
        // },
        // company_address:
        // {
        // 	required:true
        // },
        // business_number:
        // {
        // 	required:true,
        // },
        // business_email:
        // {
        // 	required:true,
        // 	email: true
        // },
        // website:
        // {
        // 	required:true
        // },
        // type_of_busines:
        // {
        // 	required:true
        // },
        // business_desc:
        // {
        // 	required:true
        // },
        // facebook_lnk:
        // {
        // 	required:true
        // },
        // twitter_lnk:
        // {
        // 	required:true
        // },
        // instagram_lnk:
        // {
        // 	required:true
        // }
    },
    messages:
        {
          email:
          {
            email:"Your email address must be in the format of name@domain.com",
            remote: "Email already exists."
          },
           business_email:
          {
            email:"Your email address must be in the format of name@domain.com"
          },
          password:
		  {
		  	required:'Please Enter Password',
		  	minlength: "Password Should Be 6 Characheters Long",
		  },
		  confirm:
		  {
		  	required:"Please Confirm your password",
		  	equalTo:'Password Not Matched',
		  	minlength: "Password Should Be 6 Characheters Long",
		  }
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
		    if (element.is('select:hidden')) {
		        error.insertAfter(element.next('.nice-select'));
		    } else {
		        error.insertAfter(element);
		    }
		},
        submitHandler: function(form)
        {
         	$('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/do_signup',
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function(result)
                    {
                        $('.submit_btn').html('Submit').prop('disabled',false);
                       var obj = $.parseJSON(result);
                        if(obj.status == 1){
                        	swal({title: "Success!", text: "Registered Successfully! Email verification link is sent on your email, please verify your email.", type: "success"},
                              function(){
                                 window.location.href= '{{url("/")}}'+'/login';
                              }
                           );

                        }else{
                          swal({title: "Error", text: "Oops! Something went wrong.", type: "error"});
                        }
                    }
            });
        }

    });
});

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>
<script>
      var input = document.getElementById('autocomplete');
      var autocomplete = new google.maps.places.Autocomplete(input);
</script>
@stop
