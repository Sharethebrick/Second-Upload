@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Listings</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Listings</li>
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
                <h5 class="card-header">{{$type}} Listings</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>Listing ID</th>
                                    <!--th>Image</th-->
                                    <th>Listing Name</th>
                                    <th>Location</th>                                   
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    @if($type!='Bricks')
                                        <th>Price</th>  
                                    @endif    
                                    @if($type!='Brands')                             
                                        <th>Number of Bookings</th>
                                    @endif                                    
                                    <th>Publishment Date</th>
                                    <th>Status</th>
                                    <th>Featured</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_listings) > 0)
                                @foreach($all_listings as $listing)
                                <tr>
                                    <td>#{{$listing->id}} </td>
                                   <!--  <td>
                                        <div class="m-r-10"><img src="{{url('/')}}/uploads/files/{{$listing->image}}" alt="user" class="rounded dash-round-imgs" width="45" height="45"></div>
                                    </td> -->
                                    <td>{{$listing->name}} </td>
                                    <td>{{$listing->location_city}}</td>                           
                                    <td>#{{$listing->user_id}}</td>
                                    <td>{{$listing->fname.' '.$listing->lname}}</td>
                                    @if($type!='brick')
                                         @if($listing->type == '1')
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
                                    @endif
                                    @if($type!='Brands')           
                                        <td>{{$listing->total_bookings}}</td>
                                    @endif
                                    <td>{{showDateFormat($listing->created_at)}}</td>                                   
                                    <td><span class="badge badge-{{$listing->status == 1 ? 'success' : 'warning'}}">{{$listing->status == 1 ? 'Published' : 'Pending'}}</span></td>
                                    <td><span class="badge badge-{{$listing->is_featured == 1 ? 'success' : 'warning'}}">{{$listing->is_featured == 1 ? 'Yes' : 'No'}}</span>
                                    <button type="button" class="ad_edit_users" data-id="{{$listing->id}}" data-value="{{$listing->is_featured == '1' ? '0' : '1'}}" data-toggle="modal" data-target="#edit_featured_prop"><i class="fas fa-pencil-alt"></i></button>
                                    </td>
                                    <td>
                                        @if($listing->status == 0)
                                        <button title="Approve Listing" type="button" class="ad_deact_users" data-id="{{$listing->id}}" data-value="1" data-toggle="modal" data-target="#change_status_list_modal"><i class="fas fa-check"></i></button>
                                        @else
                                        <button title="Disapprove Listing" type="button" class="ad_act_users" data-id="{{$listing->id}}" data-value="0" data-toggle="modal" data-target="#change_status_list_modal"><i class="fas fa-lock"></i></button>
                                        @endif
                                        @if($type=='Bricks')
                                        <a href="{{url('/')}}/admin/edit-brick/{{$listing->id}}">
                                            <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                        </a>
                                        <a href="{{url('/brickdetails')}}/{{$listing->id}}" target="_blank">
                                            <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                        </a>
                                        @elseif($type=='Brands')
                                            <a href="{{url('/')}}/admin/edit-brand/{{$listing->id}}">
                                                <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                            <a href="{{url('/branddetails')}}/{{$listing->id}}" target="_blank">
                                                <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                            </a>
                                        @elseif($type=='Full Space')
                                            <a href="{{url('/')}}/admin/edit-full-space/{{$listing->id}}">
                                                <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                             <a href="{{url('/fullspacedetails')}}/{{$listing->id}}" target="_blank">
                                                <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                            </a>
                                        @elseif($type=='Partial Space')
                                            <a href="{{url('/')}}/admin/edit-partial-space/{{$listing->id}}">
                                                <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                             <a href="{{url('/partialspacedetails')}}/{{$listing->id}}" target="_blank">
                                                <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                            </a>
                                        @elseif($type=='Popup Store')
                                            <a href="{{url('/')}}/admin/edit-popup-store/{{$listing->id}}">
                                                <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                             <a href="{{url('/popupstoredetails')}}/{{$listing->id}}" target="_blank">
                                                <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                            </a>
                                        @elseif($type=='Event Fairs')
                                            <a href="{{url('/')}}/admin/edit-event-fairs/{{$listing->id}}">
                                                <button title="Edit Listing" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                             <a href="{{url('/eventdetails')}}/{{$listing->id}}" target="_blank">
                                                <button title="View Listing" type="button" class="ad_edit_users"><i class="fas fa-eye"></i></button>
                                            </a>
                                        @endif
                                        <button title="Delete Listing" type="button" class="ad_del_users" data-id="{{$listing->id}}" data-toggle="modal" data-value="2" data-target="#change_status_list_modal"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="18">No listings found.</td>
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

<!-- set featured modal -->
<div class="modal fade" id="edit_featured_prop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title feat_modal_title" id="exampleModalLabel">Featured Listing</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="feat_modal_body">Do you want to add this listing to featured listings?</p>
                <input type="hidden" id="f_listing_id">
                <input type="hidden" id="f_listing_status">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_featured_listing_action">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection