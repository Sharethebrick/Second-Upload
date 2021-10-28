@extends('layouts.app')

@section('content')
   <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Categories</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Blog Area -->
        <section class="listing-categories-area pt-100 pb-70 list-slla">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg1" style="background-image: url({{url('/')}}/img/9.jpg);">
                            <div class="icon">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                            <h3>View All Listings</h3>
                            <span>140 Listing</span>
    
                            <a href="{{ url('/listings') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/listings') }}" class="link-btn"></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg1" style="background-image: url({{url('/')}}/img/1.jpg);">
                            <div class="icon">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                            <h3>Bricks</h3>
                            <span>60 Listing</span>
    
                            <a href="{{ url('/bricks_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/bricks_listing') }}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg2" style="background-image: url({{url('/')}}/img/2.jpg);">
                            <div class="icon">
                                <i class='bx bx-bed'></i>
                            </div>
                            <h3>Brands</h3>
                            <span>21 Listing</span>
    
                            <a href="{{ url('/brands_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/brands_listing') }}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg3" style="background-image: url({{url('/')}}/img/3.jpg);">
                            <div class="icon">
                                <i class='bx bx-drink'></i>
                            </div>
                            <h3>partial Space</h3>
                            <span>58 Listing</span>
    
                            <a href="{{ url('/partial_space_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/partial_space_listing') }}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg4" style="background-image: url({{url('/')}}/img/4.jpg);">
                            <div class="icon">
                                <i class='bx bx-dumbbell'></i>
                            </div>
                            <h3>Full Space</h3>
                            <span>99 Listing</span>
    
                            <a href="{{ url('/full_space_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/full_space_listing') }}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg5" style="background-image: url({{url('/')}}/img/5.jpg);">
                            <div class="icon">
                                <i class='bx bx-calendar-star'></i>
                            </div>
                            <h3>Pop Up Stores</h3>
                            <span>21 Listing</span>
    
                            <a href="{{ url('/popup_store_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/popup_store_listing') }}" class="link-btn"></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="single-categories-listing-item bg6" style="background-image: url({{url('/')}}/img/6.png);">
                            <div class="icon">
                                <i class='bx bx-walk'></i>
                            </div>
                            <h3>Events Fairs</h3>
                            <span>49 Listing</span>
    
                            <a href="{{ url('/event_fair_listing') }}" class="learn-more-btn">View All <i class='bx bx-chevron-right'></i></a>
    
                            <a href="{{ url('/event_fair_listing') }}" class="link-btn"></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Blog Area -->

@endsection