@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{empty($user_id) ? 'Add' : 'Edit'}} User</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                
                                 <li class="breadcrumb-item"><a href="{{url('/')}}/admin/users" class="breadcrumb-link">Users</a></li>
                               
                                <li class="breadcrumb-item active" aria-current="page">{{empty($user_id) ? 'Add' : 'Edit'}} User</li>
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
                <h5 class="card-header">{{empty($user_id) ? 'Add' : 'Edit'}} User</h5>
                <div class="card-body">
                    <form id="add_users_form">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}">
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                <input type="text" name="name" placeholder="First Name" class="form-control" value="{{!empty($user) ? $user->name : ''}}">
                            </div>
                            <div class="col-sm-4 col-lg-3">
                                <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{!empty($user) ? $user->last_name : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">E-Mail</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="email" name="email" placeholder="Enter a valid e-mail" class="form-control" value="{{!empty($user) ? $user->email : ''}}">
                            </div>
                        </div>
                         <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Type of business</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="type_of_busines" class="form-control" value="{{!empty($user) ? $user->type_of_busines : ''}}" placeholder="Enter type of business">
                            </div>
                        </div>
                        <input type="hidden" id="user_type" value="{{$type}}">
                        @if(empty($user_id))
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Password</label>
                            <div class="col-sm-4 col-lg-3 mb-3 mb-sm-0">
                                <input id="pass" name="password" type="password" required="" placeholder="Create Password" class="form-control">
                            </div>
                            <div class="col-sm-4 col-lg-3">
                                <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control" >
                            </div>
                        </div>
                        @else
                            <input id="pass" name="password" type="hidden" value="******">
                            <input name="confirm_password" type="hidden" value="******">
                        @endif
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Phone Number</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="number" name="business_number" placeholder="Enter a valid phone number" class="form-control" value="{{!empty($user) ? $user->business_number : ''}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Company Name</label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="company_name" placeholder="Company Name" class="form-control" value="{{!empty($user) ? $user->company_name : ''}}">
                            </div>
                        </div>
                        
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary add_user_btn">Submit</button>
                                 @if($type == 'service')
                                     <a href="{{url('/')}}/admin/service-users">
                                @else
                                    <a href="{{url('/')}}/admin/retail-users">
                                @endif
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