@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Update Profile</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
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
                <h5 class="card-header">Update Profile</h5>
                <div class="tab-regular">
                    <ul class="nav nav-tabs nav-fill" id="myTab7" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-justify" data-toggle="tab" href="#home-justify" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-justify" data-toggle="tab" href="#profile-justify" role="tab" aria-controls="profile" aria-selected="false">Password</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent7">
                        <div class="tab-pane fade show active" id="home-justify" role="tabpanel" aria-labelledby="home-tab-justify">
                            <div class="card-body">
                            <form id="edit_admin_form">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                                    <div class="col-sm-12 col-lg-6 mb-3 mb-sm-0">
                                        <input type="text" name="name" placeholder="Enter Your Name" class="form-control" value="{{!empty($user) ? $user->name : ''}}">
                                    </div>
    
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">E-Mail</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="email" name="email" placeholder="Enter a valid e-mail" class="form-control" value="{{!empty($user) ? $user->email : ''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Phone Number</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="number" name="phone_number" placeholder="Enter a valid phone number" class="form-control" value="{{!empty($user) ? $user->phone : ''}}">
                                    </div>
                                </div>
                                
                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <button type="submit" class="btn btn-space btn-primary edit_admin_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                        <div class="tab-pane fade" id="profile-justify" role="tabpanel" aria-labelledby="profile-tab-justify">
                            <div class="card-body">
                            <form id="change_pass_admin_form">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right"></label>
                                    <div class="col-sm-12 col-lg-6 mb-3 mb-sm-0">
                                        <div class="alert alert-danger signup-errors-p" style="display: none;"></div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Old Password</label>
                                    <div class="col-sm-12 col-lg-6 mb-3 mb-sm-0">
                                        <input type="password" name="old_password" placeholder="Old password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">New Password</label>
                                    <div class="col-sm-12 col-lg-6 mb-3 mb-sm-0">
                                        <input type="password" name="new_password" placeholder="New password" class="form-control" id="pass">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right">Confirm Password</label>
                                    <div class="col-sm-12 col-lg-6 mb-3 mb-sm-0">
                                        <input type="password" name="confirm_password" placeholder="Confirm password" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <button type="submit" class="btn btn-space btn-primary change_pass_admin_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
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
@endsection