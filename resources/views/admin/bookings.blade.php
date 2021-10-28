@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Bookings</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        @if (Session::has('message'))
           <div class="col-lg-12">
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
           </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Bookings</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                   
                                    <th>Listing ID</th>
                                    <th>User ID (Host)</th>
                                    <th>User ID (Guest)</th>
                                    <th>Type of Listing</th>
                                    <th>Request Sent on</th>
                                   <!-- <th>Dimensions</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Booking Duration</th>        
                                    <th>Booking Date</th> -->
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_bookings) > 0)
                                @foreach($all_bookings as $listing)
                                <tr>
                                    <td>#{{$listing->id}} </td>
                                  
                                    <td>#{{$listing->listing_id}} </td>
                                    <td>#{{$listing->request_to}}</td>
                                    <td>#{{$listing->request_from}}</td>                                 
                                        @if($listing->listing_type == '2')
                                                <td>
                                                   Brick
                                                </td>   
                                            @elseif($listing->listing_type == '1')
                                                <td>
                                                    Brand
                                                </td>
                                            @elseif($listing->listing_type == '3')
                                                <td>
                                                      Full Space Landlord
                                                </td>   
                                            @elseif($listing->listing_type == '4')
                                                <td>
                                                      Partial Space
                                                </td>   
                                            @elseif($listing->listing_type == '5')
                                            <td>
                                              Popup Landlord
                                            </td> 
                                            @elseif($listing->listing_type == '6')
                                                <td>
                                                     Events Fairs Markets
                                                </td>   

                                            @endif                 
                                    
                                    <td>{{showDateFormat($listing->created_at)}}</td>
                                    <td><span class="badge badge-{{$listing->status == 0 ? 'warning' : ($listing->status == 1 ? 'success' : 'danger')}}">{{$listing->status == 0 ? 'Pending' : ($listing->status == 1 ? 'Accepted' : 'Rejected')}}</span></td>
                                   <!--  <td>
                                        <a href="{{url('/')}}/admin/booking-details/{{$listing->id}}">
                                        <button title="View Booking" type="button" class="ad_deact_users" data-id="{{$listing->id}}"><i class="fas fa-eye"></i></button>
                                        </a>
                                        @if($listing->status == 0)
                                            <button title="Approve Booking" type="button" class="ad_deact_users" data-id="{{$listing->id}}" data-value="1" data-toggle="modal" data-target="#app_dis_booking_modal"><i class="fas fa-check"></i></button>
                                            <button title="Reject Booking" type="button" class="ad_del_users" data-id="{{$listing->id}}" data-value="2" data-toggle="modal" data-target="#app_dis_booking_modal"><i class="fas fa-window-close"></i></button>
                                        @endif
                                    </td> -->
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="13">No bookings found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>
    </div>
</div>

<!-- activate deactivate user modal -->
<div class="modal fade" id="change_status_list_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title act_modal_title" id="exampleModalLabel">Delete Listing</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="act_modal_body">Do you want to delete this listing?</p>
                <input type="hidden" id="a_listing_id">
                <input type="hidden" id="a_listing_status">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_listing_action">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

<!-- approve disapprove booking modal -->
<div class="modal fade" id="app_dis_booking_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ap_modal_title" id="exampleModalLabel">Approve Booking</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="ap_modal_body">Do you want to approve this booking?</p>
                <input type="hidden" id="a_booking_id">
                <input type="hidden" id="a_booking_status">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_apr_booking_action">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection