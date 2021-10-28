@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Edit Location</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/locations" class="breadcrumb-link">Locations</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Location</li>
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
       <div class="col-lg-12">
          <div class="alert alert-danger signup-errors" style="display: none;"></div>
       </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Edit Location</h5>
                <div class="card-body">
                    <form id="edit_loc_form">
                        @csrf
                        <input type="hidden" name="location_id" value="{{!empty($location) ? $location->id : ''}}">
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Flat number</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="flat_number" placeholder="Enter Flat Number" class="form-control" value="{{!empty($location) ? $location->flat_number : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Address</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="address" placeholder="Enter Address" class="form-control" value="{{!empty($location) ? $location->address : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Address 2</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="address2" placeholder="" class="form-control" value="{{!empty($location) ? $location->address2 : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">City</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="city" placeholder="" class="form-control" value="{{!empty($location) ? $location->city : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Postcode</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="postcode" placeholder="" class="form-control" value="{{!empty($location) ? $location->postcode : ''}}">
                            </div>
                        </div>
 
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary edit_loc_btn">Update</button>
                                <a href="{{url('/')}}/admin/locations">
                                <button type="button" class="btn btn-space btn-secondary">Cancel</button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>
    </div>
</div>
@endsection