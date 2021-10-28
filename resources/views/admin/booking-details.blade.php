@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Booking Details</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/bookings" class="breadcrumb-link">Bookings</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Booking Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header p-4">
                         <div style="float: left;">
                         <h3 class="mb-0">{{$booking->storage_feature}}</h3>
                         Start: {{ \Carbon\Carbon::parse($booking->start_date)->format('Y/m/d')}}<br>
                         End: {{ \Carbon\Carbon::parse($booking->end_date)->format('Y/m/d')}}
                         </div>
                       
                        <div class="float-right"> <h3 class="mb-0">Booking #{{$booking->id}}</h3>
                        Created at: {{ \Carbon\Carbon::parse($booking->created_at)->format('Y/m/d')}}</div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h5 class="mb-3">From:</h5>                                            
                                <h3 class="text-dark mb-1">{{$booking->r_first_name.' '.$booking->r_surname}}</h3>
                             
                                <div>{{(!empty($booking->r_address)) ?  $booking->r_address.', ' : ''}} {{(!empty($booking->r_postcode)) ?  $booking->r_postcode : ''}} </div>
                                <div>Email: {{$booking->r_email}}</div>
                                <div>Phone: {{$booking->r_phone_number}}</div>
                            </div>
                            <div class="col-sm-6">
                                <h5 class="mb-3">To:</h5>
                                <h3 class="text-dark mb-1">{{$booking->first_name.' '.$booking->surname}}</h3>                                            
                                <div>{{(!empty($booking->address)) ?  $booking->address.', ' : ''}} {{(!empty($booking->u_postcode)) ?  $booking->u_postcode : ''}} </div>
                                <div>Email: {{$booking->email}}</div>
                                <div>Phone: {{$booking->phone_number}}</div>
                            </div>
                        </div>
                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Description</th>
                                        <th class="right">Dimensions</th>
                                        <!-- <th class="right">Transport</th> -->
                                        <!-- <th class="right">Insurance</th> -->
                                        <th class="center">Status</th>
                                        <th class="center">Payment</th>
                                        <th class="right">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="center"><img src="{{url('/uploads/listings/').'/'.$booking->listing_image}}" alt="user" class="rounded dash-round-imgs" width="45" height="45"></td>
                                        <td class="left strong">{{$booking->description}}</td>
                                        <td class="right">{{$booking->space_booked}} Sq. ft.</td>
                                        <!-- <td class="center">{{$booking->transport}}</td> -->
                                        <!-- <td class="center">{{$booking->insurance}}</td> -->
                                        <td class="center"><span class="badge badge-{{$booking->status == 0 ? 'warning' : ($booking->status == 1 ? 'success' : 'danger')}}">{{$booking->status == 0 ? 'Pending' : ($booking->status == 1 ? 'Accepted' : 'Rejected')}}</span></td>
                                        
                                        <td class="center">{{$booking->card_type}} ending with {{substr($booking->card_number,-4)}}</td>
                                        <td class="right">£{{$booking->checkout_price}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
         <!--            <div class="card-footer bg-white">
                        <div class="row">
                            <div class="col-md-4">
                                <b>Driving License</b>
                            </div>
                            <div class="col-md-4">
                                <b>Passport</b>
                            </div>
                            <div class="col-md-4">
                                <b>National ID</b>
                            </div>
                            <div class="col-md-4">
                                <img width="300" src="{{url('/uploads/listings/').'/'.$booking->driving_license}}">
                            </div>
                            <div class="col-md-4">
                                <img width="300" src="{{url('/uploads/listings/').'/'.$booking->passport}}">
                            </div>
                            <div class="col-md-4">
                                <img width="300" src="{{url('/uploads/listings/').'/'.$booking->national_id}}">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>

    </div>
</div>

@endsection