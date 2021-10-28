@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Choose Category</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">
                <!--div class="col-md-4">
                    <div class="listing-details-desc p-0 mt-0 mb-3">
                        <div class="listing-author mt-0  centr-prolst">
                            <div class="author-profile-header"></div>
                            <div class="author-profile">
                                <div class="author-profile-title">
                                    <div class="img-str-a">
                                        <img src="{{url('/')}}/img/user3.jpg" class="shadow-sm rounded-circle" alt="image">
                                    </div>
                                    <div class="author-profile-title-details">
                                        <div class="author-profile-details">
                                            <h4>John Smith</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="expir-s"> Expire On: 20/05/2020 </span>

                            <ul class="list-all-str">
                                <li>
                                    <a href="profile-settings.html"><i class="bx bx-user"></i> Profile Settings </a>
                                </li>
                                <li class="active">
                                    <a href="user-categories.html"><i class="bx bx-list-ul"></i> Listings </a>
                                </li>
                                <li>
                                    <a href="user-bookings.html"><i class="bx bx-calendar"></i> Bookings </a>
                                </li>
                                <li>
                                    <a href="user-partners.html"><i class="bx bxs-user-detail"></i> Partners </a>
                                </li>
                                <li >
                                    <a href="user-transactions.html"><i class="bx bx-dollar"></i> Transactions </a>
                                </li>
                                <li>
                                    <a href="#"><i class="bx bx-chat"></i> Message </a>
                                </li>
                                <li>
                                    <a href="user-payment-cards.html"><i class="bx bx-credit-card"></i> Payment Cards </a>
                                </li>
                                <li>
                                    <a href="#"><i class="bx bx-log-out"></i> Logout </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div-->
                <div class="col-md-12">
                    <div class="bg-box-als">
                        <div class="billing-details listing-categories-area p-0 list-slla list-altsr">
                            <h3 class="title font-strs font-sma">Choose Category  </h3>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg1" style="background-image: url({{url('/')}}/img/1.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-shopping-bag'></i>
                                        </div>
                                        <h3>Bricks</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-bricks" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-bricks" class="link-btn"></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg2" style="background-image: url({{url('/')}}/img/2.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-bed'></i>
                                        </div>
                                        <h3>Brands</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-brands" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-brands" class="link-btn"></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg3" style="background-image: url({{url('/')}}/img/3.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-drink'></i>
                                        </div>
                                        <h3>Full Space landlord</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-full-space" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-full-space" class="link-btn"></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg4" style="background-image: url({{url('/')}}/img/4.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-dumbbell'></i>
                                        </div>
                                        <h3>Consignment & Partial Space </h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-partial-spaces" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-partial-spaces" class="link-btn"></a>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg5" style="background-image: url({{url('/')}}/img/5.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-calendar-star'></i>
                                        </div>
                                        <h3>Pop Up Landloard</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-popup-landloard" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-popup-landloard" class="link-btn"></a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg5" style="background-image: url({{url('/')}}/img/5.jpg);">
                                        <div class="icon">
                                            <i class='bx bx-calendar-star'></i>
                                        </div>
                                        <h3>Services</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-services" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-services" class="link-btn"></a>
                                    </div>
                                </div>

                               <!--  <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="single-categories-listing-item bg6" style="background-image: url({{url('/')}}/img/6.png);">
                                        <div class="icon">
                                            <i class='bx bx-walk'></i>
                                        </div>
                                        <h3>Events Fairs Markets</h3>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-events-fairs" class="learn-more-btn">View Listings <i class='bx bx-chevron-right'></i></a>
                                        <a href="{{url('/')}}/{{getUrl()}}/user-events-fairs" class="link-btn"></a>
                                    </div>
                                </div> -->


                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->


@endsection
