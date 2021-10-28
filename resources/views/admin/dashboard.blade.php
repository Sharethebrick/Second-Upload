@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content ">
        <div class="ecommerce-widget">
            <div class="row">
                <!-- ============================================================== -->
                <!-- sales  -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary" id="go_to_service_users">
                        <div class="card-body text-center">
                            <h5 class="text-muted">Users</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{$stats['total_service_users']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary" id="go_to_retail_users">
                        <div class="card-body text-center">
                            <h5 class="text-muted">Retail Users</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{$stats['total_retail_users']}}</h1>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- ============================================================== -->
                <!-- end sales  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- new customer  -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary" id="go_to_listings">
                        <div class="card-body text-center">
                            <h5 class="text-muted">Listings</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{$stats['total_listings']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end new customer  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- visitor  -->
                <!-- ============================================================== -->
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary" id="go_to_bookings">
                        <div class="card-body text-center">
                            <h5 class="text-muted">Bookings</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">{{$stats['total_bookings']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end visitor  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- total orders  -->
                <!-- ============================================================== -->
                <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="card border-3 border-top border-top-primary" id="go_to_earnings">
                        <div class="card-body text-center">
                            <h5 class="text-muted">Revenues</h5>
                            <div class="metric-value d-inline-block">
                                <h1 class="mb-1">${{$stats['total_earnings']}}</h1>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- ============================================================== -->
                <!-- end total orders  -->
                <!-- ============================================================== -->
            </div>

            <div class="row">
                <!-- ============================================================== -->
          
                <!-- ============================================================== -->

                              <!-- recent orders  -->
                <!-- ============================================================== -->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Recent Users</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0" style="text-align: center;">User ID</th>
                                            <!--th class="border-0">Image</th-->
                                            <th class="border-0">Name</th>
                                            <th class="border-0">Email</th>
                                            <th class="border-0">Phone Number</th>                              
                                            <th class="border-0">Registration Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($recent_users) > 0)
                                        @foreach($recent_users as $user)
                                        <tr>
                                            <td style="text-align: center;">#{{$user->id}}</td>
                                            <!--td>
                                                <div class="m-r-10"><img src="{{!empty($user->image) ? url('/uploads/user/').'/'.$user->image : url('/').'/images/default_user.png'}}" alt="user" class="rounded dash-round-imgs" width="45" height="45"></div>
                                            </td-->
                                            <td>{{$user->name.' '.$user->last_name}} </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->business_number}}</td>                                   
                                            <td>{{showDateFormat($user->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7"><a href="{{url('/')}}/admin/users" class="btn btn-outline-light float-right">View Details</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="6">No active user found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


               <!--  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Recent Retail Users</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0" style="text-align: center;">User ID</th>
                                            <th class="border-0">Name</th>
                                            <th class="border-0">Email</th>
                                            <th class="border-0">Phone Number</th>                              
                                            <th class="border-0">Registration Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($recent_retail_users) > 0)
                                        @foreach($recent_retail_users as $user)
                                        <tr>
                                            <td style="text-align: center;">#{{$user->id}}</td>
                                            <td>{{$user->name.' '.$user->last_name}} </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->business_number}}</td>                                   
                                            <td>{{showDateFormat($user->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7"><a href="{{url('/')}}/admin/retail-users" class="btn btn-outline-light float-right">View Details</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="6">No active user found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <h5 class="card-header">Recent Listings</h5>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0" style="text-align: center;"> ID</th>
                                            <th class="border-0">Type</th>
                                            <th class="border-0">Image</th>
                                            <th class="border-0">Listing Name</th>
                                            <th class="border-0" width="200">Location</th>
                                            <th class="border-0">User ID</th>
                                            <th class="border-0">Price</th>                                            
                                            <th class="border-0">Publishment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($recent_listings) > 0)
                                        @foreach($recent_listings as $listing)
                                        <tr>
                                            <td style="text-align: center;">#{{$listing->id}} </td>
                                            @if($listing->type == '2')
                                                <td>
                                                   Brick
                                                </td>   
                                            @elseif($listing->type == '1')
                                                <td>
                                                    Brand
                                                </td>
                                            @elseif($listing->type == '3')
                                                <td>
                                                      Full Space Landlord
                                                </td>   
                                            @elseif($listing->type == '4')
                                                <td>
                                                      Partial Space
                                                </td>   
                                            @elseif($listing->type == '5')
                                            <td>
                                              Popup Landlord
                                            </td> 
                                            @elseif($listing->type == '6')
                                                <td>
                                                     Events Fairs Markets
                                                </td>   

                                            @endif                               
                                            <td>
                                                <div class="m-r-10"><img src="{{url('/')}}/uploads/files/{{$listing->image}}" alt="user" class="rounded dash-round-imgs" width="45" height="45"></div>
                                            </td>
                                            <td>{{$listing->name}} </td>
                                            <td>{{$listing->location_city}}</td>
                                            <td>#{{$listing->user_id}}</td>
                                            @if($listing->type == '2')
                                                <td>
                                                     ---
                                                </td>   
                                            @elseif($listing->type == '1')
                                                <td>
                                                     <div class="price">
                                                            <b data-toggle="tooltip" data-placement="top">
                                                                ${{$listing->price_from}} - ${{$listing->price_to}}
                                                            </b>
                                                        </div>
                                                </td>
                                            @elseif($listing->type == '3')
                                                <td>
                                                      <div class="price">
                                                            <b data-toggle="tooltip" data-placement="top">
                                                            @if($listing->price_from)
                                                                ${{$listing->price_from}}{{$listing->price_unit}}
                                                            @endif
                                                            </b>
                                                        </div>
                                                </td>   
                                            @elseif($listing->type == '4')
                                                <td>
                                                      <div class="price">
                                                            <b data-toggle="tooltip" data-placement="top">
                                                                @if($listing->price_from)
                                                                    ${{$listing->price_from}}{{$listing->price_unit}}
                                                                @endif
                                                            </b>
                                                        </div>
                                                </td>   
                                            @elseif($listing->type == '5')
                                            <td>
                                               <ul class="list-stra-al" style="list-style-type: none;margin: 0;padding: 0;">                                                
                                                    <li> ${{$listing->daily_rate}}/day </li> 
                                                    <li> ${{$listing->weekly_rate}}/week </li> 
                                                    <li> ${{$listing->monthly_rate}}/month </li> 
                                                </ul> 
                                            </td> 
                                            @elseif($listing->type == '6')
                                                <td>
                                                     <div class="price">
                                                            <b data-toggle="tooltip" data-placement="top">
                                                                 @if($listing->price_from)
                                                                    ${{$listing->price_from}} {{$listing->price_unit}}
                                                                @endif
                                                            </b>
                                                        </div>
                                                </td>   

                                            @endif                                   
                                            <td>{{showDateFormat($listing->created_at)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="10"><a href="{{url('/')}}/admin/brick-listings" class="btn btn-outline-light float-right">View Details</a></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="10">No listings found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end recent orders  -->


                <!-- ============================================================== -->
            </div>
        </div>
    </div>
</div>
@endsection