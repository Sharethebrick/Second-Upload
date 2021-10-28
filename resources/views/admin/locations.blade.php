@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Locations</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Locations</li>
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
                <h5 class="card-header">Locations</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>Location ID</th>
                                    <th>Flat Number</th>
                                    <th>Address</th>
                                    <th>Address2</th>
                                    <th>City</th>
                                    <th>Postcode</th>
                                    <th>User ID</th>
                                    <th>No. of Bookings</th>
                                    <th>Publishment Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_locations) > 0)
                                @php
                                $count = 0;
                                @endphp
                                @foreach($all_locations as $loc)
                                @php
                                $count++;
                                @endphp
                                <tr>
                                    <td>{{$loc->id}}</td>
                                    <td>{{$loc->flat_number}} </td>
                                    <td>{{$loc->address}}</td>
                                    <td>{{$loc->address2}}</td>
                                    <td>{{$loc->city}}</td>
                                    <td>{{$loc->postcode}}</td>
                                    <td>{{$loc->user_id}}</td>
                                    <td>{{$loc->no_of_bookings}}</td>
                                    <td>{{ \Carbon\Carbon::parse($loc->created_at)->format('Y/m/d')}}</td>
                                    <td>
                                        <a href="{{url('/')}}/admin/edit_location/{{$loc->id}}">
                                            <button title="Edit User" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                        </a>
                                        <button title="Delete Location" type="button" class="ad_del_users" data-id="{{$loc->id}}" data-toggle="modal" data-target="#delete_loc_modal"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10">No locations found.</td>
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
<div class="modal fade" id="delete_loc_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title act_modal_title" id="exampleModalLabel">Delete Location</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="act_modal_body">Do you want to delete this location?</p>
                <input type="hidden" id="d_location_id">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_location_delete">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection