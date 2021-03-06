<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{url('/')}}/admin_files/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <!-- <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/charts/chartist-bundle/chartist.css"> -->
    <!-- <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/charts/morris-bundle/morris.css"> -->
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <!-- <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/charts/c3charts/c3.css"> -->
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/fonts/flag-icon-css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/admin_files/assets/vendor/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/summernote/css/summernote-bs4.css">
    <link rel="stylesheet" href="{{url('/')}}/css/fastselect.min.css">
      <link rel="stylesheet" href="{{url('/')}}/css/dropzone.min.css">
    <title>Admin | ShareTheBrick</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}"><img style="height: 43px;" src="{{url('/')}}/img/logo.png"/></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <!-- <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li> -->
       <!--                  <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="{{url('/')}}/admin_files/assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="{{url('/')}}/admin_files/assets/images/avatar-3.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham </span>is now following you
                                                        <div class="notification-date">2 days ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="{{url('/')}}/admin_files/assets/images/avatar-4.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan Pechi</span> is watching your main repository
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="{{url('/')}}/admin_files/assets/images/avatar-5.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li> -->
         <!--                <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/github.png" alt="" > <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/dribbble.png" alt="" > <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{url('/')}}/admin_files/assets/images/slack.png" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li> -->
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-th"></i></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{Session::get('admin_name')}} </h5>
                                </div>
                                <a class="dropdown-item" href="{{url('/')}}/admin/profile"><i class="fas fa-user mr-2"></i>Profile</a>
                                <a class="dropdown-item" href="{{url('/')}}/admin/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        @include('admin.includes.sidebar')
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            @yield('content')
            <input type="hidden" id="BASE_URL" value="{{url('/')}}">
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<!--             <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright ?? 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="{{url('/')}}/admin_files/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="{{url('/')}}/admin_files/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="{{url('/')}}/admin_files/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="{{url('/')}}/admin_files/assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/chartist-bundle/chartist.min.js"></script> -->
    <!-- sparkline js -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/sparkline/jquery.sparkline.js"></script> -->
    <!-- morris js -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/morris-bundle/raphael.min.js"></script> -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/morris-bundle/morris.js"></script> -->
    <!-- chart c3 js -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/c3charts/c3.min.js"></script> -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script> -->
    <!-- <script src="{{url('/')}}/admin_files/assets/vendor/charts/c3charts/C3chartjs.js"></script> -->
    <!-- <script src="{{url('/')}}/admin_files/assets/libs/js/dashboard-ecommerce.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/admin_files/assets/vendor/summernote/js/summernote-bs4.js"></script>
    <script src="{{url('/')}}/admin_files/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/admin_files/assets/vendor/datatables/js/data-table.js"></script>
    <script src="{{url('/')}}/admin_files/assets/libs/js/admin-custom.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>
     <script src="{{url('/')}}/js/fastselect.standalone.js"></script>
       <script src="{{url('/')}}/js/dropzone.min.js"></script>
    <script>
          var input = document.getElementById('autocomplete');
          var autocomplete = new google.maps.places.Autocomplete(input);
          google.maps.event.addListener(autocomplete, 'place_changed', function() {
                $('.showmap').show();
                var place = autocomplete.getPlace();
                var lat = place.geometry.location.lat(),
                lng = place.geometry.location.lng();
                $('#lat').val(lat);
                $('#lng').val(lng);
             });
    </script>
    @yield ('footer_scripts')
</body>
 
</html>