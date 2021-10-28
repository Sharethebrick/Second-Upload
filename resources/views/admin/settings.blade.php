@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Settings</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
       @if (Session::has('message'))
           <div class="col-lg-12">
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
           </div>
        @endif
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Settings</h5>
                <div class="card-body">
                    <form id="admin_settings_form" method="post">
                        @csrf
                        <input type="hidden" name="id" value="1">

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">E-Mail</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="email" name="email" placeholder="" class="form-control" required value="{{!empty($setting) ? $setting->email : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Phone Number</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="phone" placeholder="" class="form-control" required value="{{!empty($setting) ? $setting->phone : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Address</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <textarea name="location" placeholder="" class="form-control" required id="autocomplete">{{!empty($setting) ? $setting->location : ''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Facebook Link</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="fb_link" class="form-control" value="{{!empty($setting) ? $setting->fb_link : ''}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Twitter Link</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="twitter_link" class="form-control" value="{{!empty($setting) ? $setting->twitter_link : ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Instagram Link</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="insta_link" class="form-control" value="{{!empty($setting) ? $setting->insta_link : ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">LinkedIn Link</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="linkedin_link" class="form-control" value="{{!empty($setting) ? $setting->linkedin_link : ''}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Pinterest Link</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="pinterest_link" class="form-control" value="{{!empty($setting) ? $setting->pinterest_link : ''}}" required>
                            </div>
                        </div>
                        <input type="hidden" name="lat" id="lat">
                        <input type="hidden" name="lng" id="lng">
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary update_setting_btn">Update</button>
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