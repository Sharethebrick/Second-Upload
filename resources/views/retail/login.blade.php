@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Login</h2>
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
                                  

                                    <h3>Login Your Account Now</h3>
                                    <p>Don't have an account ? <b> <a href="{{url('/signup')}}">Sign up</a> </b> </p>

                                    <form id="user_login_form">
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Your Email Address" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Your Password" class="form-control">
                                        </div>

                                        <button type="submit" class="submit_btn">Login</button>                                        
                                        <div class="forgot-password">
                                            <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
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
    $('#user_login_form').validate({
    rules: {    
        password:
        {
            required:true,           
        },   
        email:
        {
            required: true,
            email: true 
        }
    },  
    messages: 
        {       
   
          password:
          {
            required:'Please Enter Password', 
          },         
          email: 
          {
            required: "Please Enter  Email",
            email:"Your email address must be in the format of name@domain.com"
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
                    url:'{{url("/")}}'+'/do_login',
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
                          @if($resource_id)
                            window.location.href= '{{url("/resource_details")}}/{{$resource_id}}#comments';
                          @else
                            if(obj.redirect_to == 0){
                              window.location.href= '{{url("/")}}'+'/profile-settings';
                            }else{
                              window.location.href= obj.redirect_to;
                            }
                            
                          @endif
                            
                        }else if(obj.status == 2){
                          swal({title: "Error", text: "Please Verify Your Email For Login!", type: "error"});
                        }else{
                          swal({title: "Error", text: "Invalid Credentials!", type: "error"});
                        }
                    }
            });
        } 
        
    });
});

</script>
@stop