@extends('layouts.app')

@section('content')
<!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Contact Us</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Contact Area -->
        <section class="contact-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <div class="contact-info">
                            <div class="section-title text-left mb-4">
                                <h2>Get In Touch</h2>
                            </div>

                            <ul class="contact-list">
                                <li><i class='bx bx-map'></i> <a href="#">{{$settings->location}}</a></li>
                                <li><i class='bx bx-phone-call'></i> <a href="">{{$settings->phone}}</a></li>
                                <li><i class='bx bx-envelope'></i> <a href="">{{$settings->email}}</a></li>
                                <!-- <li><i class='bx bx-microphone'></i> Fax: <a href="">+123456789</a></li> -->
                            </ul>

                            <h3>Follow Us:</h3>
                            <ul class="social">
                                <li><a href="{{$settings->fb_link}}" class="d-block"><i class='bx bxl-facebook'></i></a></li>
                                <li><a href="{{$settings->twitter_link}}" class="d-block"><i class='bx bxl-twitter'></i></a></li>
                                <li><a href="{{$settings->insta_link}}" class="d-block"><i class='bx bxl-instagram'></i></a></li>
                                <li><a href="{{$settings->linkedin_link}}" class="d-block"><i class='bx bxl-linkedin'></i></a></li>
                                <li><a href="{{$settings->pinterest_link}}" class="d-block"><i class='bx bxl-pinterest-alt'></i></a></li>
                            </ul>
                           <!--  <ul class="social">
                                <li><a href="#"><i class='bx bxl-facebook'></i></a></li>
                                <li><a href="#"><i class='bx bxl-twitter'></i></a></li>
                                <li><a href="#"><i class='bx bxl-instagram'></i></a></li>
                            </ul> -->
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-12">
                        <div class="contact-form">
                        <form id="contactform">
                             <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Name <span>*</span></label>
                                            <input type="text" name="name" id="name" class="form-control" required placeholder="Your name">
                                           
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Email <span>*</span></label>
                                            <input type="email" name="email" id="email" class="form-control" required placeholder="Your email address">
                      
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Phone Number <span>*</span></label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" required placeholder="Your phone number">
                                       
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Your Message <span>*</span></label>
                                            <textarea name="message" id="message" cols="30" rows="5" required class="form-control" placeholder="Write your message..."></textarea>
                                     
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="submit_btn default-btn">Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->

        <!-- Map -->
        <div class="col-lg-12 col-md-12 showmap" style="display: none;">                      
            <div id="map_canvas" style="width:100%;height:380px;"></div>                       
        </div>
<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109782.69919890907!2d76.62733970232017!3d30.69845281912047!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fee906da6f81f%3A0x512998f16ce508d8!2sSahibzada%20Ajit%20Singh%20Nagar%2C%20Punjab!5e0!3m2!1sen!2sin!4v1585141869726!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->

@endsection

@section('footer_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>
<script type="text/javascript">
           var lat = {{$settings->lat}},
            lng = {{$settings->lng}};
           var titleloc = '{{$settings->location}}';
             $('.showmap').show();
            var myLatlng = new google.maps.LatLng(lat, lng);
                var myOptions = {
                zoom: 8,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: titleloc
            });
</script>
<script type="text/javascript">  
$(function($) {
    $('#contactform').validate({
    rules: {    
        name:
        {
            required:true,           
        },   
        email:
        {
            required: true,
            email: true 
        },
        message:
        {
            required: true
        },
        phone_number:{
            required: true,
           // digits:true 
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
           // alert('validate');
            $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);            
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/do_contactus',
                    data: new FormData(form),
                    contentType: false, 
                    cache: false, 
                    processData:false,
                    success:function(result)
                    { 
                      $('.submit_btn').html('Send Message').prop('disabled',false); 
                        if(result == '1'){
                             swal({title: "Success", text: "Thanks, We will be in touch soon.", type: "success"},
                                           function(){ 
                                               location.reload();
                                           }
                                         ); 
                        }else{
                          swal({title: "Error", text: "Error while submitting your query, Please try later.", type: "error"});
                        }
                    }
            });
        } 
        
    });
});

</script>
@stop