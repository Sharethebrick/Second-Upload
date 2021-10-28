@php
$settings = getSettings();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Share The Bricks</title>
    <!-- Links of CSS files -->
    <link rel="stylesheet" href="{{url('/')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/jquery-ui.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/animate.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="{{url('/')}}/css/boxicons.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/flaticon.css">
    <link rel="stylesheet" href="{{url('/')}}/css/magnific-popup.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/odometer.min.css">
   @if(Request::segment(1) != 'bookings' && Request::segment(1) != 'sent-bookings' && Request::segment(1) != 'payment-cards' && Request::segment(1) != 'edit-brick'  && Request::segment(1) != 'add-brick' && Request::segment(1) != 'saved-searches' && Request::segment(2) != 'edit-brick' && Request::segment(2) != 'calender' && Request::segment(2) != 'add-services' && Request::segment(2) != 'edit-service' && Request::segment(2) != 'add-brick'  )
    <link rel="stylesheet" href="{{url('/')}}/css/nice-select.min.css">
    @endif
    <link rel="stylesheet" href="{{url('/')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/slick.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/rangeSlider.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/meanmenu.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/css/responsive.css">
    <link rel="stylesheet" href="{{url('/')}}/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/amsify.suggestags.css">
    <link rel="stylesheet" href="{{url('/')}}/css/sweetalert.css">
    <link rel="stylesheet" href="{{url('/')}}/css/fastselect.min.css">
    <link rel="stylesheet" href="{{url('/')}}/css/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/example-styles.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/jquery.datetimepicker.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
</head>
<body>
     <!-- Start Header Area -->
        <header class="header-area">

            <!-- Start Navbar Area -->
            <div class="navbar-area">
                <div class="bricks-responsive-nav">
                    <div class="container">
                        <div class="bricks-responsive-menu">
                            <div class="logo">
                                <a href="index.html">
                                    <img class="logo-scrlout" src="{{url('/')}}/img/logo.png" alt="logo">
                                    <img class="logo-scrl" src="{{url('/')}}/img/logo-white.png" alt="logo" style="display:none">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bricks-nav">
                    <div class="container-fluid">
                        <nav class="navbar navbar-expand-md navbar-light">


                            <div class="collapse navbar-collapse mean-menu">
                                <ul class="navbar-nav">
                                @if(getUrl() == 'retail')
                                    <li class="nav-item"><a href="{{ url(getUrl().'/aboutus') }}" class="nav-link">About Us</a></li>

                                    <li class="nav-item"><a href="{{ url(getUrl().'/contact') }}" class="nav-link">Contact</a></li>
                                    <li class="nav-item"><a href="{{ url(getUrl().'/help') }}" class="nav-link">Help</a></li>
                                    <li class="nav-item"><a href="{{ url(getUrl().'/resource') }}" class="nav-link">Resources</a></li>
                                    <li class="nav-item logo-vntrs">
                                     <a class="navbar-brand" href="{{ url('/') }}">
                                            <img class="logo-scrlout" src="{{url('/')}}/img/logo.png" alt="logo">
                                            <img class="logo-scrl" src="{{url('/')}}/img/logo-white.png" alt="logo" style="display:none">
                                        </a>
                                    </li>
                                    @if(Auth::check())
                                                <li class="nav-item drop-usres">
                                                    <a href="{{url(getUrl().'/profile-settings')}}" class="nav-link">
                                                    <img src="{{!empty(Auth::User()->image) ? url('/uploads/user/').'/'.Auth::User()->image : url('/').'/img/user.png'}}" class="img-usrea"> {{Auth::User()->name}} {{Auth::User()->last_name}}
                                                    </a>
                                                </li>
                                    @endif
                                @else
                                    <li class="nav-item"><a href="{{ url('/aboutus') }}" class="nav-link">About Us</a></li>

                                    <li class="nav-item"><a href="{{ url('/contact') }}" class="nav-link">Contact</a></li>
                                    <li class="nav-item"><a href="{{ url('/help') }}" class="nav-link">Help</a></li>
                                    <li class="nav-item"><a href="{{ url('/resource') }}" class="nav-link">Resources</a></li>
                                    <li class="nav-item logo-vntrs">
                                     <a class="navbar-brand" href="{{ url('/') }}">
                                            <img class="logo-scrlout" src="{{url('/')}}/img/logo.png" alt="logo">
                                            <img class="logo-scrl" src="{{url('/')}}/img/logo-white.png" alt="logo" style="display:none">
                                        </a>
                                    </li>
                                     @if(Auth::check())
                                            <li class="nav-item drop-usres">
                                                <a href="{{route('profile-settings')}}" class="nav-link">
                                                <img src="{{!empty(Auth::User()->image) ? url('/uploads/user/').'/'.Auth::User()->image : url('/').'/img/user.png'}}" class="img-usrea"> {{Auth::User()->name}} {{Auth::User()->last_name}}
                                                </a>
                                            </li>
                                    @endif
                                @endif
                                <li class="pdd-cns">
                                    <div class="others-option">
                                        <div class="d-flex align-items-center">
                                            <ul class="header-contact-info">
                                                <li>
                                                    <div class="dropdown language-switcher d-inline-block">
                                                        <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span>Eng <i class='bx bx-chevron-down'></i></span>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a href="#" class="dropdown-item d-flex align-items-center">
                                                                <span>Eng</span>
                                                            </a>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="option-item">
                                                @if(!Auth::check())
                                                    <a href="{{ url('/login') }}" class="default-btn mr-3"><!--i class="bx bxs-log-in"></i--> Login / Sign Up</a>
                                                @endif
                                                @if(getUrl() == 'retail')
                                                    <div class="dropdown drop-vrs add_listing_dropdown">
                                                    <button class="default-btn fillclr dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <!--i class="bx bx-plus"></i--> Add Listing
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                        <div class="dropdown-header-vrs">Seeking Space & Alliances</div>
                                                        <a class="dropdown-item" href="{{ url(getUrl().'/add-brick') }}">Add Brick</a>
                                                        <a class="dropdown-item" href="{{ url(getUrl().'/add-brand') }}">Add Brand</a>
                                                        <div class="dropdown-header-vrs">Offering Space</div>
                                                        <a class="dropdown-item" href="{{ url(getUrl().'/add-full-space-landlord') }}">Full Space Landlord</a>
                                                        <a class="dropdown-item" href="{{ url(getUrl().'/add-partial-space-landlord') }}">Partial Space Landlord</a>
                                                        <a class="dropdown-item" href="{{url(getUrl().'/add-popup-landlord')}}">Pop-Up Landlord</a>
                                                        <a class="dropdown-item" href="{{url(getUrl().'/add-services')}}">Services</a>
                                                    </div>
                                                    </div>
                                                @endif
                                           </div>
                                          
                                           @if(getUrl() == 'retail')
                                            <div class="r-plan-btn"><a href="{{ url(getUrl().'/pricing') }}">Plans</a></div>
                                           @endif
                                        </div>
                                    </div>
                                </li>
                               </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- End Navbar Area -->

        </header>
        <!-- End Header Area -->
        @yield('content')
        @if(Auth::check())
               @include('includes.sidebar')
       @endif


        <input type="hidden" id="BASE_URL" value="{{url('/')}}">
        <!-- Start Footer Area -->
        <footer class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h3>Contact Us</h3>

                            <div class="about-the-store">
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do</p> -->
                                <ul class="footer-contact-info">
                                    <li><i class='bx bx-map'></i> <a href="#">{{$settings->location}}</a></li>
                                    <li><i class='bx bx-phone-call'></i> <a href="">{{$settings->phone}}</a></li>
                                    <li><i class='bx bx-envelope'></i> <a href="">{{$settings->email}}</a></li>
                                </ul>
                            </div>

                            <ul class="social-link">
                                <li><a href="{{$settings->fb_link}}" class="d-block"><i class='bx bxl-facebook'></i></a></li>
                                <li><a href="{{$settings->twitter_link}}" class="d-block"><i class='bx bxl-twitter'></i></a></li>
                                <li><a href="{{$settings->insta_link}}" class="d-block"><i class='bx bxl-instagram'></i></a></li>
                                <li><a href="{{$settings->linkedin_link}}" class="d-block"><i class='bx bxl-linkedin'></i></a></li>
                                <li><a href="{{$settings->pinterest_link}}" class="d-block"><i class='bx bxl-pinterest-alt'></i></a></li>
                            </ul>
                        </div>
                    </div>
                    @if(getUrl() == 'retail')
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-footer-widget pl-4">
                                <h3>Quick Links</h3>

                                <ul class="quick-links">
                                    <li><a href="{{url(getUrl().'/')}}">Home</a></li>
                                    <li><a href="{{url(getUrl().'/aboutus')}}">About Us</a></li>
                                   <!--  <li><a href="{{url('/categories')}}">Categories</a></li> -->
                                    <li><a href="{{url(getUrl().'/resource')}}">Resources</a></li>
                                    <li><a href="{{url(getUrl().'/contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="single-footer-widget pl-4">
                                <h3>Quick Links</h3>

                                <ul class="quick-links">
                                    <li><a href="{{url('/')}}">Home</a></li>
                                    <li><a href="{{url('/aboutus')}}">About Us</a></li>
                                   <!--  <li><a href="{{url('/categories')}}">Categories</a></li> -->
                                    <li><a href="{{url('/resource')}}">Resources</a></li>
                                    <li><a href="{{url('/contact')}}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if(getUrl() == 'retail')
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h3>Categories</h3>

                            <ul class="customer-support">
                                <li><a href="{{url(getUrl().'/bricks_listing')}}">Bricks</a></li>
                                <li><a href="{{url(getUrl().'/brands_listing')}}">Brands</a></li>
                                <li><a href="{{url(getUrl().'/full_space_listing')}}">Full Spaces</a></li>
                                <li><a href="{{url(getUrl().'/partial_space_listing')}}">Partial Spaces</a></li>
                                <li><a href="{{url(getUrl().'/popup_store_listing')}}">Pop Up Stores</a></li>
                               <!--  <li><a href="{{url('/event_fair_listing')}}">Events Fairs</a></li> -->
                            </ul>
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h3>Newsletter</h3>

                            <div class="footer-newsletter-box">
                                <p>To get the latest news and latest updates from us.</p>

                                <form class="newsletter-form">
                                    <label>Your E-mail Address:</label>
                                    <input type="email" class="input-newsletter" placeholder="Enter your email" name="EMAIL" required>
                                    <button type="submit">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom-area">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-md-6">
                            <p>Copyright <i class='bx bx-copyright'></i>{{date("Y")}} All rights reserved.</p>
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <ul>
                                <li><a href="{{url(getUrl().'/privacy-policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url(getUrl().'/terms-conditions')}}">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </footer>
         <!-- End Footer Area -->

        <div class="go-top"><i class='bx bx-chevron-up'></i></div>

        <!-- Links of JS files -->
        <script src="{{url('/')}}/js/jquery.min.js"></script>
        <script src="{{url('/')}}/js/popper.min.js"></script>
        <script src="{{url('/')}}/js/bootstrap.min.js"></script>
        <script src="{{url('/')}}/js/owl.carousel.min.js"></script>
        <script src="{{url('/')}}/js/magnific-popup.min.js"></script>
        <script src="{{url('/')}}/js/appear.min.js"></script>
        <script src="{{url('/')}}/js/odometer.min.js"></script>
        <script src="{{url('/')}}/js/jquery-ui.min.js"></script>
        <script src="{{url('/')}}/js/parallax.min.js"></script>
        <script src="{{url('/')}}/js/slick.min.js"></script>
        <script src="{{url('/')}}/js/rangeSlider.min.js"></script>
        @if(Request::segment(1) != 'bookings' && Request::segment(1) != 'sent-bookings' && Request::segment(1) != 'payment-cards' && Request::segment(1) != 'edit-brick' && Request::segment(1) != 'saved-searches' && Request::segment(1) != 'add-brick' && Request::segment(2) != 'add-services' && Request::segment(2) != 'edit-service'  && Request::segment(2) != 'edit-brick' && Request::segment(2) != 'calender' && Request::segment(2) != 'add-brick' )
             <script src="{{url('/')}}/js/nice-select.min.js"></script>
        @endif

        <script src="{{url('/')}}/js/isotope.pkgd.min.js"></script>
        <script src="{{url('/')}}/js/meanmenu.min.js"></script>
        <script src="{{url('/')}}/js/wow.min.js"></script>
        <script src="{{url('/')}}/js/form-validator.min.js"></script>
        <script src="{{url('/')}}/js/contact-form-script.js"></script>
        <script src="{{url('/')}}/js/ajaxchimp.min.js"></script>
        <script src="{{url('/')}}/js/bricks-map.js"></script>
        <script src="{{url('/')}}/js/main.js"></script>
        <script src="{{url('/')}}/js/dropzone.min.js"></script>
        <script src="{{url('/')}}/js/sweetalert.min.js"></script>
        <script src="{{url('/')}}/js/jquery.amsify.suggestags.js"></script>
        <script src="{{url('/')}}/js/jquery.datetimepicker.js"></script>
        <script src="{{url('/')}}/js/jquery-payment.js"></script>
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script src="{{url('/')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
        <script type="text/javascript">
            $('input[name="color"]').amsifySuggestags({
                type : 'amsify'
            });
        </script>
       <!--  <script src="https://rawgit.com/dbrekalo/attire/master/dist/js/build.min.js"></script> -->
        <script src="{{url('/')}}/js/fastselect.standalone.js"></script>
        <script>
             $('.drop-vrs').hover(function(){
              $('.dropdown-toggle', this).trigger('click');
            });
        </script>
        <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            var all_uploaded_pictures = [];
            var all_uploaded_files = [];
            localStorage.setItem('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
            localStorage.setItem('all_uploaded_files',JSON.stringify(all_uploaded_files));

            //For Chat
            function doWork() {

                var sender = $('.send_text_msg_btn').attr('sender-id');
                var receiver = $('.send_text_msg_btn').attr('receiver-id');
                var listing_id = $('.send_text_msg_btn').attr('listing-id');
                var start = $('#count_msg_id').val();
                $.ajax({
                          type:'POST',
                          url:'{{url("/")}}'+'/get_chat',
                          data: {sender:sender,receiver:receiver,listing_id:listing_id,start:start,_token:'{{ Session::token() }}'},
                          success:function(data)
                          {
                           var obj = $.parseJSON(data);
                          $('.chat_data_list').append(obj.html);
                          $('#count_msg_id').val(parseInt(start)+parseInt(obj.count));
                          if(parseInt(obj.count) != 0){
                            $('#main-ac .mCustomScrollbar').mCustomScrollbar("scrollTo","bottom");
                          }
                    }
                  });

                repeater = setTimeout(doWork, 3000);
               }
               setTimeout(function(){
                    var get_val = $('.irs-to').html();
                    if(get_val == '500'){
                        $('.irs-to').append('+');
                    }
                }, 1000);
               //Search Listing start here
               $('#search_listing').validate({
                    submitHandler: function(form)
                    {
                            $('.search_submit').html('Searching<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
                            $.ajax({
                                    url:'{{url("/")}}/{{getUrl()}}'+'/search_listing',
                                    type: 'POST',
                                    processData: false,
                                    contentType: false,
                                    data: new FormData(form),
                                    dataType: 'json',
                                    success:function(result)
                                    {
                                        $('.search_submit').html('Search <i class="bx bx-search-alt"></i>').prop('disabled',false);
                                        $('.load_more').attr('data-id',result.count);
                                        $('.load_more').attr('total',result.total_count);
                                        if(parseInt(result.total_count)>parseInt(result.count)){
                                            $('.load_more').show();
                                        }else{
                                            $('.load_more').hide();
                                        }

                                        $('.searched_data').html(result.html);

                                    }
                            });
                    }

                });
            $(document).on('click','.load_more',function(){
                var data_loaded = parseInt($(this).attr('data-id'));
                var total = parseInt($(this).attr('total'));
                var data1 = $('#search_listing').serializeArray();
                data1.push({name: 'data', value: data_loaded});
                if(parseInt(total)>data_loaded){
                    $(this).attr('data-id',data_loaded+{{items_count()}});
                    $(this).html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);
                    $.ajax({
                            type:'POST',
                             url:'{{url("/")}}/{{getUrl()}}'+'/load_more_listing',
                            data: data1,
                            dataType: 'json',
                            success:function(result)
                            {
                                $('.load_more').html('Load More').prop('disabled',false);
                                $('.searched_data').append(result.html);
                                if(parseInt(total)<=parseInt($('.load_more').attr('data-id'))){
                                    $('.load_more').hide();
                                }
                            }
                     });
                }else{
                    $(this).hide();
                }
            });
        </script>
        @yield ('footer_scripts')
</body>
</html>
