<!-- ============================================================== --> 
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark" style="overflow-y: auto; height:92%;>
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{url('/')}}/admin/dashboard"><i class="fa fa-fw fa-home"></i>Dashboard </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{url('/')}}/admin/users"><i class="fas fa-fw fa-user-circle"></i>Users </a>
                    </li>
                   <!--  <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/service-users') || Request::is('admin/retail-users')) ? 'active' : ''}}" href="#" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/service-users') || Request::is('admin/retail-users')) ? 'true' : 'false'}}" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-user-circle"></i>Users</a>
                        <div id="submenu-5" class="collapse submenu {{ (Request::is('admin/service-users') || Request::is('admin/retail-users')) ? 'show' : ''}}" style="">
                            <ul class="nav flex-column">
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/service-users')) ? 'active' : ''}}" href="{{url('/')}}/admin/service-users">Service</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/retail-users')) ? 'active' : ''}}" href="{{url('/')}}/admin/retail-users">Retail</a>
                                </li>                                
                            </ul>
                        </div>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/users') || Request::is('admin/add_user')) ? 'active' : '' }}" href="{{url('/')}}/admin/users"><i class="fas fa-fw fa-user-circle"></i>Users</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/listings') ? 'active' : '' }}" href="{{url('/')}}/admin/listings"><i class="fas fa-fw fa-list"></i>Listings</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/partial-space-categories') || Request::is('admin/edit-partial-space-category/*') || Request::is('admin/add-retail-category') || Request::is('admin/edit-ideal-category/*') || Request::is('admin/add-ideal-category') || Request::is('admin/edit-space-category/*') || Request::is('admin/edit-retail-category/*') || Request::is('admin/add-space-category') || Request::is('admin/add-amenities') || Request::is('admin/edit-amenities/*') || Request::is('admin/add-partial-space-category') ||  Request::is('admin/retail-categories') || Request::is('admin/space-categories') || Request::is('admin/ideal-categories') || Request::is('admin/resources-tagsa')) ? 'active' : ''}}" href="#" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/partial-space-categories') || Request::is('admin/retail-categories') || Request::is('admin/add-ideal-category') ||  Request::is('admin/add-partial-space-category') || Request::is('admin/add-space-category') || Request::is('admin/space-categories') || Request::is('admin/add-retail-category') || Request::is('admin/edit-ideal-category/*') || Request::is('admin/edit-amenities/*') || Request::is('admin/edit-space-category/*') || Request::is('admin/edit-retail-category/*') || Request::is('admin/add-amenities') || Request::is('admin/ideal-categories') || Request::is('admin/resources-tagsa')) ? 'true' : 'false'}}" data-target="#submenu11" aria-controls="submenu11"><i class="fas fa-fw fa-list"></i>Categories</a>
                        <div id="submenu11" class="collapse submenu {{ (Request::is('admin/partial-space-categories') || Request::is('admin/retail-categories') || Request::is('admin/ideal-categories') || Request::is('admin/space-categories') || Request::is('admin/add-space-category') || Request::is('admin/add-retail-category') || Request::is('admin/add-ideal-category') ||  Request::is('admin/add-partial-space-category') || Request::is('admin/edit-partial-space-category/*') || Request::is('admin/add-amenities') || Request::is('admin/edit-ideal-category/*') || Request::is('admin/edit-space-category/*') || Request::is('admin/edit-retail-category/*') || Request::is('admin/edit-amenities/*') || Request::is('admin/resources-tagsa')) ? 'show' : ''}}" style="">
                            <ul class="nav flex-column">
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/partial-space-categories') || Request::is('admin/edit-partial-space-category/*') || Request::is('admin/add-partial-space-category')) ? 'active' : ''}}" href="{{url('/')}}/admin/partial-space-categories">Partial Space Current Use</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/retail-categories') || Request::is('admin/edit-retail-category/*') || Request::is('admin/add-retail-category')) ? 'active' : ''}}" href="{{url('/')}}/admin/retail-categories">Retail Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/space-categories') || Request::is('admin/edit-space-category/*') || Request::is('admin/add-space-category')) ? 'active' : ''}}" href="{{url('/')}}/admin/space-categories">Space Type Categories</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/amenties') || Request::is('admin/add-amenities') || Request::is('admin/edit-amenities/*')) ? 'active' : ''}}" href="{{url('/')}}/admin/amenties">Amenities</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/ideal-categories') || Request::is('admin/edit-ideal-category/*') || Request::is('admin/add-ideal-category')) ? 'active' : ''}}" href="{{url('/')}}/admin/ideal-categories">Ideal Uses Categories</a>
                                </li>                              
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link {{ (Request::is('admin/brick-listings') || Request::is('admin/brand-listings') || Request::is('admin/full-space-listings') || Request::is('admin/partial-space-listings') || Request::is('admin/popup-store-listings') || Request::is('admin/event-fairs-listings')) ? 'active' : ''}}" href="#" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/brick-listings') || Request::is('admin/brand-listings') || Request::is('admin/full-space-listings') || Request::is('admin/partial-space-listings') || Request::is('admin/popup-store-listings') || Request::is('admin/event-fairs-listings')) ? 'true' : 'false'}}" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-list"></i>Listings</a>
                        <div id="submenu-7" class="collapse submenu {{ (Request::is('admin/brick-listings') || Request::is('admin/brand-listings') || Request::is('admin/full-space-listings') || Request::is('admin/partial-space-listings') || Request::is('admin/popup-store-listings') || Request::is('admin/event-fairs-listings')) ? 'show' : ''}}" style="">
                            <ul class="nav flex-column">
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/brick-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/brick-listings">Brick</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/brand-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/brand-listings">Brand</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/full-space-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/full-space-listings">Full Space</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/partial-space-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/partial-space-listings">Partial Space</a>
                                </li>  
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/popup-store-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/popup-store-listings">Popup Store</a>
                                </li>        
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/event-fairs-listings')) ? 'active' : '' }}" href="{{url('/')}}/admin/event-fairs-listings">Event Fairs</a>
                                </li>                                
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/resources-list') || Request::is('admin/resources-tags')) ? 'active' : ''}}" href="#" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/resources-list') || Request::is('admin/resources-tags')) ? 'true' : 'false'}}" data-target="#submenu9" aria-controls="submenu9"><i class="fab fa-blogger-b"></i>Resources</a>
                        <div id="submenu9" class="collapse submenu {{ (Request::is('admin/resources-list') || Request::is('admin/resources-tags')) ? 'show' : ''}}" style="">
                            <ul class="nav flex-column">
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/resources-list')) ? 'active' : ''}}" href="{{url('/')}}/admin/resources-list">List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/resources-tags')) ? 'active' : ''}}" href="{{url('/')}}/admin/resources-tags">Tags</a>
                                </li>                                
                            </ul>
                        </div>
                    </li>
                  
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/bookings') ? 'active' : '' }}" href="{{url('/')}}/admin/bookings"><i class="fas fa-fw fa-bookmark"></i>Bookings</a>
                    </li>
                   
                  <!--   <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/transactions') ? 'active' : '' }}" href="{{url('/')}}/admin/transactions"><i class="fas fa-fw fa-dollar-sign"></i>Transactions</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('admin/manageterms') || Request::is('admin/manageprivacy') || Request::is('admin/faq-categories') || Request::is('admin/managehome') || Request::is('admin/manage-aboutus')) ? 'active' : ''}}" href="#" data-toggle="collapse" aria-expanded="{{ (Request::is('admin/manageterms') || Request::is('admin/manageprivacy') || Request::is('admin/faq-categories') || Request::is('admin/managehome') || Request::is('admin/manage-aboutus')) ? 'true' : 'false'}}" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i>Pages</a>
                        <div id="submenu-6" class="collapse submenu {{ (Request::is('admin/manageterms') || Request::is('admin/manageprivacy')  || Request::is('admin/managehome') || Request::is('admin/faq-categories') || Request::is('admin/manage-aboutus')) ? 'show' : ''}}" style="">
                            <ul class="nav flex-column">
                            
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/manageterms')) ? 'active' : '' }}" href="{{url('/')}}/admin/manageterms">Terms & Conditions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/manageprivacy')) ? 'active' : '' }}" href="{{url('/')}}/admin/manageprivacy">Privacy Policy</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/manage-aboutus')) ? 'active' : '' }}" href="{{url('/')}}/admin/manage-aboutus">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/managehome')) ? 'active' : '' }}" href="{{url('/')}}/admin/managehome">Home Page</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (Request::is('admin/faq-categories')) ? 'active' : '' }}" href="{{url('/')}}/admin/faq-categories">FAQ</a>
                                </li>
                             
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/enquiries') ? 'active' : '' }}" href="{{url('/')}}/admin/enquiries"><i class="fas fa-fw fa-envelope"></i>Enquiries</a>
                    </li>
                   <!--  <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/flags') ? 'active' : '' }}" href="{{url('/')}}/admin/flags"><i class="fas fa-fw fa-flag"></i>Reports</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/profile') ? 'active' : '' }}" href="{{url('/')}}/admin/profile"><i class="fas fa-fw fa-user"></i>Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::is('admin/settings') ? 'active' : '' }}" href="{{url('/')}}/admin/settings"><i class="fas fa-fw fa-cog"></i>Settings</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ==============================================================