@extends('layouts.app')

@section('content')

  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>User Transactions</h2>
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
                                        <img src="assets/img/user3.jpg" class="shadow-sm rounded-circle" alt="image">
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
                                <li>
                                    <a href="user-categories.html"><i class="bx bx-list-ul"></i> Listings </a>
                                </li>
                                <li>
                                    <a href="user-bookings.html"><i class="bx bx-calendar"></i> Bookings </a>
                                </li>
                                <li>
                                    <a href="user-partners.html"><i class="bx bxs-user-detail"></i> Partners </a>
                                </li>
                                <li class="active">
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
                            <h3 class="title font-strs font-sma">User Transactions  </h3>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-lessons">
                                            <thead>
                                                <tr>
                                                    <th> Transaction ID</th>
                                                    <th> Property ID</th>
                                                    <th> Date/Time </th>
                                                    <th> Price </th>
                                                    <th> Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> #12345 </td>
                                                    <td> 1334243 </td>
                                                    <td> 12/01/2020 at 12:04am </td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-danger"> Pending </label>  </td>
                                                </tr>
                                                <tr>
                                                    <td> #12312 </td>
                                                    <td> 5456542 </td>
                                                    <td> 04/01/2020  at 11:04am</td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-success"> Paid </label>  </td>
                                                </tr>
                                                <tr>
                                                    <td> #32131 </td>
                                                    <td> 4554534 </td>
                                                    <td> 14/02/2020  at 10:24am</td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-danger"> Pending </label>  </td>
                                                </tr>
                                                <tr>
                                                    <td> #44212 </td>
                                                    <td> 2345521 </td>
                                                    <td> 12/01/2020 at 12:04am</td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-success"> Paid </label>  </td>
                                                </tr>
                                                <tr>
                                                    <td> #42421 </td>
                                                    <td> 2332412 </td>
                                                    <td> 03/02/2020 at 10:22am</td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-danger"> Pending </label>  </td>
                                                </tr>
                                                <tr>
                                                    <td> #14525 </td>
                                                    <td> 2114525 </td>
                                                    <td> 01/02/2020  at 12:04am</td>
                                                    <td> $39.00 </td>
                                                    <td> <label class="badge badge-success"> Paid </label>  </td>
                                                </tr>
                                            </tbody>    
                                        </table>
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


@endsection