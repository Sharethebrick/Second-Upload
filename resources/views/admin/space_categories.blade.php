@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Categories</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Space Categories</li>
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
                <h5 class="card-header">Space Categories
                    <a style="float: right;" href="{{url('/')}}/admin/add-space-category"><button type="button" class="btn btn-dark">Add New</button></a>
                </h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                   <!--  <th>Image</th> -->
                                    <th>title</th>
                                    <th>Status(Brick)</th>
                                    <th>Status(Full Space)</th>
                                    <th>Status(Popup Store)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($resources) > 0)
                                @foreach($resources as $cat)
                                <tr>
                                    <td>#{{$cat->id}}</td>
                                    <td>{{$cat->name}}</td>                                    
                                    <td><span class="badge badge-{{$cat->brick_status == 1 ? 'success' : ($cat->brick_status == 0 ? 'info' : 'danger')}}">{{$cat->brick_status == 1 ? 'Active' : ($cat->brick_status == 0 ? 'Inactive' :  'Deleted')}}</span>
                                    @if($cat->brick_status == 1)
                                    <button title="Inactive Category" type="button" class="ad_act_users" data-id="{{$cat->id}}" data-value="0" data-toggle="modal" data-field="Brick" data-target="#act_deact_space_cat_modal"><i class="fas fa-lock"></i></button>
                                    @else
                                    <button title="Activate Category" type="button" class="ad_deact_users" data-id="{{$cat->id}}" data-value="1" data-toggle="modal" data-field="Brick" data-target="#act_deact_space_cat_modal"><i class="fas fa-check"></i></button>
                                    @endif
                                            </td>
                                    <td><span class="badge badge-{{$cat->full_space_status == 1 ? 'success' : ($cat->full_space_status == 0 ? 'info' : 'danger')}}">{{$cat->full_space_status == 1 ? 'Active' : ($cat->full_space_status == 0 ? 'Inactive' :  'Deleted')}}</span>
                                     @if($cat->full_space_status == 1)
                                    <button title="Inactive Category" type="button" class="ad_act_users" data-id="{{$cat->id}}" data-value="0" data-field="Full Space" data-toggle="modal" data-target="#act_deact_space_cat_modal"><i class="fas fa-lock"></i></button>
                                    @else
                                    <button title="Activate Category" data-field="Full Space" type="button" class="ad_deact_users" data-id="{{$cat->id}}" data-value="1" data-toggle="modal" data-target="#act_deact_space_cat_modal"><i class="fas fa-check"></i></button>
                                    @endif
                                    </td>
                                    <td><span class="badge badge-{{$cat->popup_status == 1 ? 'success' : ($cat->popup_status == 0 ? 'info' : 'danger')}}">{{$cat->popup_status == 1 ? 'Active' : ($cat->popup_status == 0 ? 'Inactive' :  'Deleted')}}</span>
                                     @if($cat->popup_status == 1)
                                    <button title="Inactive Category" type="button" class="ad_act_users" data-id="{{$cat->id}}" data-value="0" data-toggle="modal" data-field="Popup Store" data-target="#act_deact_space_cat_modal"><i class="fas fa-lock"></i></button>
                                    @else
                                    <button title="Activate Category" type="button" class="ad_deact_users" data-id="{{$cat->id}}" data-value="1" data-toggle="modal" data-field="Popup Store" data-target="#act_deact_space_cat_modal"><i class="fas fa-check"></i></button>
                                    @endif</td>
                                    <td>
                                        @if($cat->status != 2)                                            
                                            <a href="{{url('/')}}/admin/edit-space-category/{{$cat->id}}">
                                                <button title="Edit Category" type="button" class="ad_edit_users"><i class="fas fa-edit"></i></button>
                                            </a>
                                            <button title="Delete Category" type="button" class="ad_del_users" data-id="{{$cat->id}}" data-toggle="modal" data-value="2" data-field="delete" data-target="#act_deact_space_cat_modal"><i class="fas fa-trash"></i></button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="13">No Resource found.</td>
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
<div class="modal fade" id="act_deact_space_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <input type="hidden" id="a_user_field">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_space_cat_deact">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection