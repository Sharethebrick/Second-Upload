@extends('layouts.app')

@section('content')

    <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3 pdd-sechr userbanner small-bsn">
            <div class="container">
                <div class="page-title-content">
                    <h2> </h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Latest Listing Area -->
        <section class="listing-area pt-5 pb-5 ptb-100 bg-grey pdd-csts">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-search-wrap fll-s-st">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" placeholder="Keyword...">
                                        </div>
                                    </div>
                                    <div class="col">
                                        
                                        <div class="form-group">
                                            <label><a href="#"><i class="bx bx-current-location"></i></a></label>
                                            <input type="text" placeholder="Location" class="pl-28">
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <select>
                                                <option>Collaboration Type </option>
                                                <option>Full Space</option>
                                                <option>PopUp Store</option>
                                                <option>Shared Space</option>
                                                <option>Consignment </option>
                                                <option>Collaboration</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col">
                                        <div class="form-group">
                                            <select>
                                                <option>Retail Category </option>
                                                <option>Art</option>
                                                <option>Beauty</option>
                                                <option>Fashion</option>
                                                <option>Home and Living </option>
                                                <option>Jewelry </option>
                                                <option>Accessories</option>
                                                <option>Food and Drink</option>
                                                <option>Footwear</option>
                                                <option>Education</option>
                                                <option>Games and Toys</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select>
                                                <option>Price Range</option>
                                                <option>Min Price</option>
                                                <option>Max Price</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col">
                                        <div class="form-group">
                                            <select>
                                                <option>Sort by</option>
                                                <option>Recommended</option>
                                                <option>City A Z</option>
                                                <option>City Z A</option>
                                                <option>Newest</option>
                                                <option>Oldest</option>
                                                <option>Price Low to High</option>
                                                <option>Price High to Low</option>
                                            </select>
                                        </div>
                                    </div>                                      
                                </div>

                                <div class="main-search-btn">
                                    <button type="submit">Search <i class='bx bx-search-alt'></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
            
                    

                    <div class="col-lg-9 col-md-12 useraferlogin">
                    
                  
                    <div class="listings-alls">
                            <div class="row">
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/1.jpg" alt="image">
                                            </a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#24243</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Event Space in Avenue</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore</p>

                                            
                                        </div>

                                        <!--div class="listing-box-footer">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="price">
                                                    <span data-toggle="tooltip" data-placement="top">
                                                        $1500 - $2000
                                                    </span>
                                                </div>
                                                <span class="location"><i class="bx bx-map"></i> 40 Journal , NG USA</span>
                                            </div>
                                        </div-->

                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/2.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#11322</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Pop-Up Shop in Central</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do incididunt ut labore</p>

                                            
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6 offset-lg-0 offset-md-3">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/3.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#13112</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Modern Pop-Up Trendy</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consing elit, sed do eiusmod tempor incididunt ut labore</p>

                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/4.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#43215</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Centro Comercial Aricanduva</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore</p>

                                            
                                        </div>


                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/5.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#24342</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Logan Brown Room</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do incididunt ut labore</p>

                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6 offset-lg-0 offset-md-3">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/6.png" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#45342</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Centro Comercial Santafé</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consing elit, sed do eiusmod tempor incididunt ut labore</p>

                                           
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/1.jpg" alt="image">
                                            </a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#24243</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Event Space in Avenue</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut labore</p>

                                            
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/2.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#11322</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Pop-Up Shop in Central</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do incididunt ut labore</p>

                                            
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-12 col-md-6 offset-lg-0 offset-md-3">
                                    <div class="single-listing-item brands-brosr">
                                        <div class="listing-image">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><img src="{{url('/')}}/img/3.jpg" alt="image"></a>

                                            <div class="listing-tag">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-block"><b> ID: </b>#13112</a>
                                            </div>
                                        </div>

                                        <div class="listing-content">

                                            <h3><a href="javascript:void(0);" data-toggle="modal" data-target="#listing-popup" class="d-inline-block">Modern Pop-Up Trendy</a></h3>
                                            <p class="mt-2">Lorem ipsum dolor sit amet, consing elit, sed do eiusmod tempor incididunt ut labore</p>

                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="pagination-area text-center bg-grs">
                                        <a href="#" class="prev page-numbers"><i class="bx bx-chevron-left"></i></a>
                                        <span class="page-numbers current" aria-current="page">1</span>
                                        <a href="#" class="page-numbers">2</a>
                                        <a href="#" class="page-numbers">3</a>
                                        <a href="#" class="page-numbers">4</a>
                                        <a href="#" class="page-numbers">5</a>
                                        <a href="#" class="next page-numbers"><i class="bx bx-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                           </div>

                 
                    <div class="col-lg-3 col-md-12">
                        <div class="listing-widget-area">
                            <div class="listing-widget filter-list-widget widtbgs">
                                <h3 class="listing-widget-title">Current Selection</h3>

                                <div class="selected-filters-wrap-list">
                                    <ul>
                                        <li><a href="#"><i class='bx bx-x'></i> Legal Advice</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Brands</a></li>
                                        <li><a href="#"><i class='bx bx-x'></i> Financial Advice</a></li>
                                    </ul>

                                    <a href="#" class="delete-selected-filters"><i class='bx bx-trash'></i> <span>Reset All Filters</span></a>
                                </div>
                            </div>
                            
                            <div class="listing-widget facilities-list-widget widtbgs">
                                <h3 class="listing-widget-title">Categories</h3>

                                <ul class="facilities-list-row">
                                    <li><a href="bricks-listings.html">Bricks</a></li>
                                    <li class="active"><a href="brands-listings.html">Brands</a></li>
                                    <li><a href="full-space-listings.html">Full Space</a></li>
                                    <li><a href="partial-space-listings.html">Partial Space</a></li>
                                    <li><a href="popup-store-listings.html">Pop Up Stores</a></li>
                                    <li><a href="events-listings.html">Events Fairs</a></li>
                                </ul>
                            </div>

                            <div class="listing-widget price-list-widget  widtbgs">
                                <h3 class="listing-widget-title">Price</h3>

                                <div class="collection-filter-by-price">
                                    <input class="js-range-of-price" type="text" data-min="0" data-max="1055" name="filter_by_price" data-step="10">
                                </div>
                            </div>

                            <div class="listing-widget categories-list-widget widtbgs ">
                                <h3 class="listing-widget-title">Features</h3>

                                <ul class="categories-list-row features">
                                    <li><a href="#">Legal Advice</a></li>
                                    <li><a href="#">Financial Advice</a></li>
                                    <li><a href="#">Sample forms</a></li>
                                    <li><a href="#">Feature 4</a></li>
                                    <li><a href="#">Feature 5</a></li>
                                    <li><a href="#">Feature 6</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>


               </div>
            </div>
        </section>
        <!-- End Latest Listing Area -->


@endsection