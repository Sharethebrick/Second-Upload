<a href="javascript:void(0)" data-toggle="modal" data-target="#shoppingCartModal" class="toggl-navr"><i class="bx bx-menu"></i> </a>
<!-- Start User Sidebar Modal -->
<div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modl-new-navbr" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class='bx bx-x'></i></span>
            </button>

            <div class="modal-body ">
                <div class="mCustomScrollbar height-sct">
                    <div class="listing-details-desc p-0 mt-0 mb-3">
                        <div class="listing-author mt-0  centr-prolst">
                            <div class="author-profile-header"></div>
                            <div class="author-profile">
                                <div class="author-profile-title">
                                    <div class="img-str-a"> 
                                        <img src="{{!empty(Auth::User()->image) ? url('/uploads/user/').'/'.Auth::User()->image : url('/').'/img/user.png'}}" class="shadow-sm rounded-circle" alt="image">
                                                <!--label class="edit-imgs" for="img-upload">
                                                    <i class="bx bx-pencil"></i>
                                                    <input type="file" id="img-upload" style="visibility:hidden; height:0px; width:0px;">
                                                </label-->
                                            </div>
                                            <div class="author-profile-title-details">
                                                <div class="author-profile-details">
                                                    <h4>{{Auth::User()->name}} {{Auth::User()->last_name}}</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="expir-s"> Expire On: 20/05/2020 </span>
                                    
                                    <ul class="list-all-str">
                                        @if(getUrl() == 'retail')
                                        <li class="{{Request::segment(1) == 'profile-settings'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/profile-settings')}}"><i class="bx bx-user"></i> Profile Settings </a>
                                        </li>
                                        <!-- <li class="{{Request::segment(2) == 'calender'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/calender')}}"><i class="bx bx-calendar"></i> Calender  </a>
                                        </li> -->
                                        @if(Auth::check())  
                                        <li class="{{(Request::segment(2) == 'user-categories' || Request::segment(2) == 'user-bricks' || Request::segment(2) == 'user-brands' || Request::segment(2) == 'user-full-space' || Request::segment(2) == 'user-partial-spaces' || Request::segment(2) == 'user-popup-landloard' || Request::segment(2) == 'user-events-fairs')? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/user-categories')}}"><i class="bx bx-list-ul"></i> My Listings </a>
                                        </li>
                                        <li class="{{Request::segment(1) == 'create-reminder'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/create-reminder')}}"><i class="bx bx-plus"></i> Create Reminder  </a>
                                        </li>
                                        
                                        <li class="{{Request::segment(1) == 'add-brick'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/add-brick')}}"><i class="bx bx-plus"></i> Create Brick  </a>
                                        </li>                                       
                                       
                                        {{-- <li class="{{Request::segment(2) == 'member-appointment'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/member-appointment')}}"><i class="bx bx-plus"></i> Member appointments  </a>
                                        </li> --}}
                                        <li class="#">
                                            <a href="#"><i class="fa fa-envelope"></i> My Emails  </a>
                                        </li>
                                        <li class="{{Request::segment(2) == 'bookings'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/bookings')}}"><i class="bx bx-calendar"></i> Inbox {{\App\Common::getunreadcountinbox(Auth::User()->id)}}</a>
                                        </li>
                                        @endif
                                        <li class="{{Request::segment(2) == 'sent-bookings'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/sent-bookings')}}"><i class="bx bx-calendar"></i>Sent {{\App\Common::getunreadcountsent(Auth::User()->id)}} </a>
                                        </li> 
                                        <li class="{{(Request::segment(2) == 'partners' || Request::segment(2) == 'partner-details')? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/partners')}}"><i class="bx bxs-user-detail"></i> My Partners  </a>
                                        </li>
                                        <li class="{{Request::segment(2) == 'transactions'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/transactions')}}"><i class="bx bx-dollar"></i> My Billing </a>
                                        </li>
                                        <!--li>
                                            <a href="#"><i class="bx bx-chat"></i> Message </a>
                                        </li-->
                                        <li class="{{Request::segment(2) == 'payment-cards'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/payment-cards')}}"><i class="bx bx-credit-card"></i> Payment Cards </a>
                                        </li>
                                        <li class="{{Request::segment(2) == 'saved-searches'? 'active' : ''}}">
                                            <a href="{{url(getUrl().'/saved-searches')}}"><i class="bx bx-search"></i> Saved Searches </a>
                                        </li>
                                        @else
                                        <li class="{{Request::segment(2) == 'profile-settings'? 'active' : ''}}">
                                            <a href="{{url('/profile-settings')}}"><i class="bx bx-user"></i> Profile Settings </a>
                                        </li>
                                        @endif
                                        <li>
                                            <a href="{{url('/logout')}}"><i class="bx bx-log-out"></i> Logout </a>
                                        </li>

                                    </ul>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End User Sidebar Modal -->

        <!-- Start Shopping Cart Modal -->
        <!-- <div class="modal right fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class='bx bx-x'></i></span>
                    </button>

                    <div class="modal-body">
                        <h3>My Cart (3)</h3>

                        <div class="products-cart-content">
                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="{{url('/')}}/img/products/img1.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Ham Salad</a></h3>
                                    <span>Quantity: 01</span>
                                    <div class="products-price">
                                        $20
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>

                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="{{url('/')}}/img/products/img2.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Fresh Cappuccino</a></h3>
                                    <span>Quantity: 02</span>
                                    <div class="products-price">
                                        $25
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>

                            <div class="products-cart">
                                <div class="products-image">
                                    <a href="#"><img src="{{url('/')}}/img/products/img3.jpg" alt="image"></a>
                                </div>

                                <div class="products-content">
                                    <h3><a href="#">Honey Cake</a></h3>
                                    <span>Quantity: 01</span>
                                    <div class="products-price">
                                        $11
                                    </div>
                                    <a href="#" class="remove-btn"><i class='bx bx-trash'></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="products-cart-subtotal">
                            <span>Subtotal</span>

                            <span class="subtotal">$524.00</span>
                        </div>

                        <div class="products-cart-btn">
                            <a href="cart.html" class="default-btn">View Bag & Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Shopping Cart Modal -->