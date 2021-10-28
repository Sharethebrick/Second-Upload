@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Forgot Password</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Blog Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
            <div class="login-content">
                        <div class="d-table">
                            <div class="d-table-cell">
                                <div class="login-form">
                                  

                                    <h3>Forgot Your Password</h3>
                                    <p>Please enter your email to reset your password.  </p>

                                    <form id="forgot-pass-form"> 
                                    @csrf
                                    <div class="col-md-12 forgot-errors-success" style="display: none;"></div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Your Email Address" class="form-control">
                                        </div>

                                        <button type="submit" class="forgot-def-btn">Reset Password</button>
                                        
                                        <div class="forgot-password text-center">
                                            <a href="{{ url('/login') }}">Go back to Login?</a>
                                        </div>

                                        <div class="connect-with-social">
                                        <div class="or"><span>Login With </span><hr></div>
                                            <button type="submit" class="facebook"><i class="bx bxl-facebook"></i> </button>
                                            <button type="submit" class="twitter"><i class="bx bxl-twitter"></i></button>
                                            <button type="submit" class="instagram"><i class="bx bxl-instagram"></i> </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 </div>
                         
                 </div>
            </div>
        </section>
        <!-- End Blog Area -->


@endsection
@section('footer_scripts')
<script type="text/javascript">  
$(function($) {
     $("#forgot-pass-form").validate({
    // Specify validation rules
    rules: {
       email:
        {
            required: true,
            email: true ,
             remote: {
                    url: '{{url("/")}}'+'/checking_user_forgot',
                    type: "post",
                    data:{_token:'{{ Session::token() }}'}                   

                 }
        }
    },
    messages: {
      email: 
          {
            required: "Please Enter  Email",
            email:"Your email address must be in the format of name@domain.com",
            remote: "Email doesn't exists on our system."
          }
    },
    submitHandler: function(form) {
      $(".forgot-def-btn").html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
        $.ajax({
            url: '{{url("/")}}'+'/forgot_password',
            type: 'POST',
            data: new FormData(form),
            contentType: false, 
            cache: false, 
            processData:false,
            success: function(result) {
                var obj = $.parseJSON(result); 
                $(".forgot-def-btn").html('Reset Password').prop('disabled',false);
                if(obj.status == 1){  
                    swal({title: "Success", text: "An email has been sent with reset password instructions.", type: "success"},
                                       function(){ 
                                           location.reload();
                                       }
                    ); 
                }
                else if(obj.status == 2){
                   swal({title: "Error", text: "Your account is inactive, Please contact with admin.", type: "error"});
                }else{
                   swal({title: "Error", text: "Email doesn't exists on our system.", type: "error"});
                }
            }     
        });
    }
  });
});
</script>
@stop