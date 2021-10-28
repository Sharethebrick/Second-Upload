@extends('layouts.app')

@section('content')

<!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Profile Settings</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="bg-box-als">

                    <form id="user_update_form">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                        <div class="billing-details">
                        <h3 class="title font-strs">Profile Settings  </h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="user-img-at">
                                    <div class="img-box-st">
                                        <img src="{{!empty(Auth::User()->image) ? url('/uploads/user/').'/'.Auth::User()->image : url('/').'/img/user.png'}}" id="preview_img">
                                        <label class="edit-imgs" for="img-upload">
                                            <i class="bx bx-pencil"></i>
                                            <input type="file" id="img-upload" accept="image/*" name="image"  style="visibility:hidden; height:0px; width:0px;">
                                        </label>
                                    </div>
                                    <span class="expir-s"> Expire On: 20/05/2020 </span>
                                    <a href="{{url('/pricing')}}" class="upgrd"><i class="bx bx-dollar"> </i> Upgrade Your Account </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12">


                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>First Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::User()->name}}" name="name">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="last_name"  value="{{Auth::User()->last_name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Company Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="company_name" value="{{Auth::User()->company_name}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Company Address <span class="required">*</span></label>
                                                <input type="text" class="form-control" value="{{Auth::User()->company_address}}" name="company_address" id="autocomplete">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Business Number <span class="required">*</span></label>
                                                <input type="number" class="form-control" name="business_number" value="{{Auth::User()->business_number}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Email Address <small> (business) </small>     <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="email" value="{{Auth::User()->email}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6" style="display: none;">
                                            <div class="form-group">
                                                <label>Email Address  <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="business_email" value="{{Auth::User()->email}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Website <!--  <span class="required">*</span> --></label>
                                                <input type="text" name="website" class="form-control" value="{{Auth::User()->website}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Type of Business <span class="required">*</span></label>

                                                <div class="select-box">
                                                <input type="text" name="type_of_busines" class="form-control" value="{{Auth::User()->type_of_busines}}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Business Description <span class="required">*</span></label>
                                                <textarea name="business_desc" id="notes" cols="30" rows="5" placeholder="" class="form-control">{{Auth::User()->business_desc}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <h3 class="title mb-3">Social Media Accounts    </h3>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Facebook  <!-- <span class="required">*</span> --></label>
                                                <div class="icon-w-sc">
                                                    <input type="text" name="facebook_lnk" class="form-control" placeholder="www.facebook.com" value="{{Auth::User()->facebook_lnk}}">
                                                    <i class="bx bxl-facebook"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Twitter  <!-- <span class="required">*</span> --></label>
                                                <div class="icon-w-sc">
                                                    <input type="text" name="twitter_lnk" class="form-control" placeholder="www.twitter.com" value="{{Auth::User()->twitter_lnk}}">
                                                    <i class="bx bxl-twitter"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Instagram  <!-- <span class="required">*</span> --></label>
                                                <div class="icon-w-sc">
                                                    <input type="text" name="instagram_lnk" class="form-control" placeholder="www.instagram.com" value="{{Auth::User()->instagram_lnk}}">
                                                    <i class="bx bxl-instagram"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <button class="btn btn-save-stt submit_btn" type="submit"> Save </button>
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
    $(document).on('ready',function() {
        <?php $mes = Session::get('infomessage');
            if(isset($mes)){ ?>
            swal({title: "Error", text: "Complete the business related info first to create the listings.", type: "error"});
        <?php } ?>

    });
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
$('#user_update_form').validate({
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
        //  password:
        // {
        //  required:true,
        //  minlength: 6,
        // },
        // confirm:
        // {
        //  required:true,
        //  minlength: 6,
        //  equalTo: "#password"

        // },
        name:
        {
            required:true
        },
        last_name:
        {
            required:true
        },
        company_name:
        {
            required:true
        },
        company_address:
        {
            required:true
        },
        business_number:
        {
            required:true,
        },
        business_email:
        {
            required:true,
            email: true
        },
        // website:
        // {
        //     required:true
        // },
        type_of_busines:
        {
            required:true
        },
        business_desc:
        {
            required:true
        },
        // facebook_lnk:
        // {
        //     required:true
        // },
        // twitter_lnk:
        // {
        //     required:true
        // },
        // instagram_lnk:
        // {
        //     required:true
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
                    url:'{{url("/")}}'+'/update_profile',
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success:function(result)
                    {
                        var obj = $.parseJSON(result);
                        if(obj.status == 1){
                          swal({title: "Success!", text: "Profile updated successfully.", type: "success"},
                              function(){
                                location.reload();
                              }
                           );
                        }else{
                          swal({title: "Error", text: "Error while updating profile, Please try later.", type: "error"});
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
