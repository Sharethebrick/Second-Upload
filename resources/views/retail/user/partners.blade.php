@extends('layouts.app')

@section('content')

 <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>User Partners</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="row">

                <div class="col-md-12 col-lg-12">
                    <div class="billing-details">
                        <h3 class="title font-strs font-sma">Partners    </h3>
                    </div>
                     <div class="listings-alls list-st">
                        <div class="row">


                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="single-listing-item new-stl-lyt ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="{{url('/')}}/{{getUrl()}}/partner-details" class="d-block"><img src="{{url('/')}}/img/user1.jpg" alt="image"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h5><a href="{{url('/partner-details')}}" class="d-inline-block">John Smith</a></h5>
                                                <span class="location pull-left">

                                                        <i class="bx bx-envelope"></i> johnsmith@gmail.com

                                                    </span>
                                                    <span class="location pull-right">

                                                        <i class="bx bx-phone"></i> 9874563210

                                                    </span>
                                                    <div class="clearfix"></div>
                                                    <!--p class="mt-2 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore</p-->
                                                    <ul class="list-socl">
                                                    <li><a href="#"><i class="bx bxl-facebook"></i> www.facebook.com/johnSmith </a> </li>
                                                    <li><a href="#"><i class="bx bxl-twitter"></i> www.twitter.com/johnSmith </a> </li>
                                                    <li><a href="#"><i class="bx bxl-instagram"></i> www.instagram.com/johnSmith </a> </li>
                                                    </ul>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-pop" class="delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                    <span class="location"><i class="bx bx-map"></i> 40 Journal , NG USA</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="single-listing-item new-stl-lyt">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="{{url('/partner-details')}}" class="d-block"><img src="{{url('/')}}/img/user2.jpg" alt="image"></a>


                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h5><a href="{{url('/partner-details')}}" class="d-inline-block">Andrew Smith</a></h5>
                                                <span class="location pull-left">

                                                        <i class="bx bx-envelope"></i> andrewsmith@gmail.com

                                                    </span>
                                                        <span class="location pull-right">

                                                        <i class="bx bx-phone"></i> 9874563210

                                                    </span>
                                                    <div class="clearfix"></div>
                                                <ul class="list-socl">
                                                    <li><a href="#"><i class="bx bxl-facebook"></i> www.facebook.com/andrewsmith </a> </li>
                                                    <li><a href="#"><i class="bx bxl-twitter"></i> www.twitter.com/andrewsmith </a> </li>
                                                    <li><a href="#"><i class="bx bxl-instagram"></i> www.instagram.com/andrewsmith </a> </li>
                                                </ul>

                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-pop" class="delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                    <span class="location"><i class="bx bx-map"></i> 40 Journal , NG USA</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="single-listing-item new-stl-lyt">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="{{url('/partner-details')}}" class="d-block"><img src="{{url('/')}}/img/user3.jpg" alt="image"></a>


                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h5><a href="{{url('/partner-details')}}" class="d-inline-block">Steve Jones</a></h5>
                                                <span class="location  pull-left">

                                                        <i class="bx bx-envelope"></i> stevejones@gmail.com

                                                    </span>
                                                        <span class="location pull-right">

                                                        <i class="bx bx-phone"></i> 9874563210

                                                    </span>
                                                    <div class="clearfix"></div>
                                                <ul class="list-socl">
                                                    <li><a href="#"><i class="bx bxl-facebook"></i> www.facebook.com/stevejones </a> </li>
                                                    <li><a href="#"><i class="bx bxl-twitter"></i> www.twitter.com/stevejones </a> </li>
                                                    <li><a href="#"><i class="bx bxl-instagram"></i> www.instagram.com/stevejones </a> </li>
                                                </ul>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-pop" class="delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                    <span class="location"><i class="bx bx-map"></i> 40 Journal , NG USA</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>




                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="single-listing-item new-stl-lyt">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="listing-image">
                                                <a href="{{url('/partner-details')}}" class="d-block"><img src="{{url('/')}}/img/user4.jpg" alt="image"></a>


                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="listing-content pl-0">
                                                <h5><a href="{{url('/partner-details')}}" class="d-inline-block">Johnson Charles</a></h5>
                                                <span class="location pull-left">

                                                        <i class="bx bx-envelope"></i> johnsonchalres@gmail.com

                                                    </span>
                                                        <span class="location pull-right">

                                                        <i class="bx bx-phone"></i> 9874563210

                                                    </span>
                                                    <div class="clearfix"></div>
                                                <ul class="list-socl">
                                                    <li><a href="#"><i class="bx bxl-facebook"></i> www.facebook.com/johnsonchalres </a> </li>
                                                    <li><a href="#"><i class="bx bxl-twitter"></i> www.twitter.com/johnsonchalres </a> </li>
                                                    <li><a href="#"><i class="bx bxl-instagram"></i> www.instagram.com/johnsonchalres </a> </li>
                                                </ul>
                                            </div>
                                            <div class="listing-box-footer br-st-a">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#delete-pop" class="delete-ayr"> <i class="bx bx-trash"></i> </a>
                                                    <span class="location"><i class="bx bx-map"></i> 40 Journal , NG USA</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                    </div>

                </div>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->

        <div class="modal fade" id="delete-pop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-delete" role="document">
            <div class="modal-content">

              <div class="modal-body">
                <div class="delte-con-pop">
                    <i class="bx bx-trash"></i>
                    <h5> Are you sure! </h5>
                    <p> Are you sure, you wants to delete it ? </p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger">Yes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
            </div>
          </div>
        </div>



@endsection
