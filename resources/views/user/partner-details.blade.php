@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Partner Details</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="listing-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="listing-details-desc mt-0">
                            <div class="listing-author mt-0">
                                <div class="author-profile-header"></div>
                                <div class="author-profile">
                                    <div class="author-profile-title">
                                        <img src="{{url('/')}}/img/user1.jpg" class="shadow-sm rounded-circle" alt="image">

                                        <div class="author-profile-title-details d-flex justify-content-between">
                                            <div class="author-profile-details">
                                                <h4>John Smith</h4>
                                                <span class="d-block"><i class="bx bx-envelope icon-st"></i> john@example.com</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
                                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                                    <ul class="list-cina-s">
                                        <li><a href="#"><i class="bx bxl-facebook"></i> facebook.com/johnsmith </a> </li> 
                                        <li><a href="#"><i class="bx bxl-twitter"></i> twitter.com/johnsmith </a> </li> 
                                        <li><a href="#"><i class="bx bxl-instagram"></i> instagram.com/johnsmith </a> </li> 
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="listing-sidebar-widget">
                            <div class="listing-contact-info">
                                <h3>Other Information</h3>
                                <ul class="bg-othsr">
                                    <li><span>Email Address:</span> <a> john@example.com</a></li>
                                    <li><span>Phone Number:</span> <a> +1234 567 890</a></li>
                                    <li><span>Address:</span> <a> 123 Town Street</a></li>
                                    <li><span>City:</span> <a> California</a></li>
                                    <li><span>Country:</span> <a> USA </a></li>
                                    
                                </ul>
                            </div>

                            <div class="listing-contact dtas insa">
                                <div class="text">
                                    <div class="icon">
                                        <i class='bx bx-envelope'></i>
                                    </div>
                                    <span>Email Text to Partner</span>
                                    <a href="#">demo@example.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->


@endsection