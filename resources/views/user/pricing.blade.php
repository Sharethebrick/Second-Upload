@extends('layouts.app')

@section('content')

         <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>Pricing Plan</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->
<div id="generic_price_table">
    <section>
        <div class="container">
            <!--BLOCK ROW START-->
            <div class="row">
            <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-6">
                    <!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                                <!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Free</span>
                                </div>
                                <!--//HEAD END-->
                            </div>
                            <!--//HEAD CONTENT END-->
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">    
                                <span class="price">
                                <span class="sign">$</span>
                                <span class="currency">00</span>
                                <span class="cent">.00</span>
                                <span class="month">/MON</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                        </div>
                        <!--//HEAD PRICE DETAIL END-->
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                            <ul>
                                <li><span>5 </span> Pics Upload</li>
                                <li><span>Push </span> Notifications</li>
                                <li><span>24/7</span> Support</li>
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                            <a class="" href="javascript:void(0)"  data-toggle="modal" data-target="#addnew-card">Choose Plan</a>
                        </div>
                        <!--//BUTTON END-->
                    </div>
                    <!--//PRICE CONTENT END-->
                </div>
                <div class="col-md-6">
                    <!--PRICE CONTENT START-->
                    <div class="generic_content active clearfix">
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                                <!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>Standard</span>
                                </div>
                                <!--//HEAD END-->
                            </div>
                            <!--//HEAD CONTENT END-->
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">    
                                <span class="price">
                                <span class="sign">$</span>
                                <span class="currency">39</span>
                                <span class="cent">.00</span>
                                <span class="month">/MON</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                        </div>
                        <!--//HEAD PRICE DETAIL END-->
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                            <ul>
                                <li><span>10 </span> Pics Upload</li>
                                <li><span>Push </span> Notifications</li>
                                <li><span>24/7</span> Support</li>
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        <!--BUTTON START-->
                        <div class="generic_price_btn clearfix">
                            <a class="" href="javascript:void(0)"  data-toggle="modal" data-target="#addnew-card">Choose Plan</a>
                        </div>
                        <!--//BUTTON END-->
                    </div>
                    <!--//PRICE CONTENT END-->
                </div>
            </div>
            </div>
            </div>
            <!--//BLOCK ROW END-->
        </div>
    </section>
</div>



</div>

@endsection