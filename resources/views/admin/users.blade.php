@extends('admin.layouts.app')
@section('content')

<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Users</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                <h5 class="card-header">Users
                <a style="float: right;" href="{{url('/')}}/admin/add-user"><button type="button" class="btn btn-dark">Add User</button></a>
              
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                   <!--  <th>Image</th> -->
                                    <th>Name</th>
                                    <th>Company Name</th>                                   
                                   <!--  <th>Company Address</th>        -->                             
                                    <th>Email</th>
                                    <th>Phone Number</th>                                    
                                    <th>Listings</th>                                  
                                    <th>Bookings</th>  
                                    <th>Registration Date</th>
                                    <th>Last Connection</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_users) > 0)
                                @foreach($all_users as $user)
                                <tr>
                                    <td>#{{$user->id}}</td>
                                   <!--  <td>
                                        <div class="m-r-10"><img src="{{!empty($user->image) ? url('/uploads/user/').'/'.$user->image : url('/').'/img/user.png'}}" alt="user" class="rounded dash-round-imgs" width="45" height="45"></div>
                                    </td> -->
                                    <td>{{$user->name.' '.$user->last_name}} </td>                                   
                                    <td>{{$user->company_name}}</td>
                                   <!--  <td>{{$user->company_address}}</td> -->
                                    <td>{{$user->email}}</td>                                    
                                    <td>{{$user->business_number}}</td>                                   
                                    <td>{{$user->listings}}</td>                                  
                                    <td>{{$user->bookings}}</td>
                                    
                                    <td>{{showDateFormat($user->created_at)}}</td>
                                    <td>
                                        @if(!empty($user->logged_at))
                                            {{showDateFormat($user->logged_at)}}
                                        @else
                                            ---
                                        @endif
                                    </td>
                                    <td><span class="badge badge-{{$user->status == 1 ? 'success' : ($user->status == 0 ? 'info' : 'danger')}}">{{$user->status == 1 ? 'Active' : ($user->status == 0 ? 'Inactive' :  'Deleted')}}</span></td>
                                    <td>
                                        @if($user->status != 2)
                                            @if($user->status == 1)
                                            <button title="Inactive User" type="button" class="ad_act_users" data-id="{{$user->id}}" data-value="0" data-toggle="modal" data-target="#act_deact_modal"><i class="fas fa-lock"></i></button>
                                            @else
                                            <button title="Activate User" type="button" class="ad_deact_users" data-id="{{$user->id}}" data-value="1" data-toggle="modal" data-target="#act_deact_modal"><i class="fas fa-check"></i></button>
                                            @endif
                                            <a href="{{url('/')}}/admin/edit_user/{{$user->id}}">
                                                <button title="Edit User" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                            <button title="Delete User" type="button" class="ad_del_users" data-id="{{$user->id}}" data-toggle="modal" data-value="2" data-target="#act_deact_modal"><i class="fas fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="13">No users found.</td>
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
<div class="modal fade" id="act_deact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title act_modal_title" id="exampleModalLabel">User Activation</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="act_modal_body">Do you want to activate this user?</p>
                <input type="hidden" id="a_user_id">
                <input type="hidden" id="a_user_status">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_user_act_deact">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection