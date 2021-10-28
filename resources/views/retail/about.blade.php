@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>{!!$page[4]->value!!}</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start About Area -->
        <section class="about-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <!-- <div class="about-content">
                            <span class="sub-title">About Us</span>
                            <h2>Sed ut perspiciatis unde</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris </p>

                            <div class="features-text">
                                <p><i class='bx bx-arrow-to-right'></i> Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
                                <p><i class='bx bx-arrow-to-right'></i> Accusantium doloremque laudantium, totam rem aperiam</p>
                                <p><i class='bx bx-arrow-to-right'></i> Eaque ipsa quae ab illo inventore veritatis et</p>
                                <p><i class='bx bx-arrow-to-right'></i> quasi architecto beatae vitae dicta sunt explicabo</p>
                            </div>
                        </div> -->
                        {!!$page[5]->value!!}
                    </div> 
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="about-image">
                            <img src="{{url('/')}}/img/{{$page[6]->value}}" class="shadow" alt="image">
                            <img src="{{url('/')}}/img/{{$page[7]->value}}" class="shadow" alt="image">
                        </div>
                    </div>
                </div>

                <!-- <div class="about-inner-area">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="about-text">
                                <h3>Sed ut perspiciatis</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                
                                <ul class="features-list">
                                    <li><i class='bx bx-check'></i> Lorem ipsum dolor sit amet</li>
                                    <li><i class='bx bx-check'></i> Consectetur adipiscing elit</li>
                                    <li><i class='bx bx-check'></i> Sed do eiusmod tempor</li>
                                    <li><i class='bx bx-check'></i> Incididunt ut labore et dolore</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="about-text">
                                <h3>Unde omnis iste</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                
                                <ul class="features-list">
                                    <li><i class='bx bx-check'></i> Lorem ipsum dolor sit amet</li>
                                    <li><i class='bx bx-check'></i> Consectetur adipiscing elit</li>
                                    <li><i class='bx bx-check'></i> Sed do eiusmod tempor</li>
                                    <li><i class='bx bx-check'></i> Incididunt ut labore et dolore</li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-md-3 offset-sm-3">
                            <div class="about-text">
                                <h3>Natus error sit</h3>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                
                                <ul class="features-list">
                                    <li><i class='bx bx-check'></i> Lorem ipsum dolor sit amet</li>
                                    <li><i class='bx bx-check'></i> Consectetur adipiscing elit</li>
                                    <li><i class='bx bx-check'></i> Sed do eiusmod tempor</li>
                                    <li><i class='bx bx-check'></i> Incididunt ut labore et dolore</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                {!!$page[8]->value!!}
            </div>
        </section>
        <!-- End About Area -->

@endsection