@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Enquiries</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Enquiries</li>
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
                <h5 class="card-header">Enquiries</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered users_tbl">
                            <thead>
                                <tr>
                                    <th>Enquiry ID</th>
                                    <th>Name</th>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Phone</th> 
                                    <!-- <th>Date</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($all_contacts) > 0)
                                @php
                                $count = 0;
                                @endphp
                                @foreach($all_contacts as $contact)
                                @php
                                $count++;
                                @endphp
                                <tr>
                                    <td>
                                        #{{$contact->id}}
                                    </td>
                                    <td>{{$contact->name}} </td>
                                    <td>@if($contact->user_id == 0) Guest @else #{{$contact->user_id}} @endif</td>
                                    <td>{{$contact->email}}</td>                                
                                    <td>{{$contact->phone}}</td>
                                  <!--  <td>{{showDateFormat($contact->created_at)}}</td>          -->                        
                                    <td>
                                        <button title="Delete" type="button" class="ad_del_users" data-id="{{$contact->id}}" data-toggle="modal" data-target="#del_enquiry_modal"><i class="fas fa-trash"></i></button>
                                     <a href="{{url('/')}}/admin/viewenquiry/{{$contact->id}}">
                                        <button title="View Enquiry" type="button" class="ad_deact_users"><i class="fas fa-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8">No enquiries found.</td>
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

<div class="modal fade" id="del_enquiry_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title act_modal_title" id="exampleModalLabel">Delete Enquiry</h5>
                <a href="javascript:void(0)" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body">
                <p class="act_modal_body">Do you want to delete this record?</p>
                <input type="hidden" id="enq_id">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
            </div>
            <div class="modal-footer">        
                <button type="button" class="btn btn-primary" id="confirm_enq_delete">Yes</button>
                <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            </div>
        </div>
    </div>
</div>

@endsection