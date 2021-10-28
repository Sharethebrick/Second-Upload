@extends('admin.layouts.app')
@section('content')
<style>
.dashboard-wrapper {
    min-height: auto!important;
}
</style>
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Enquiry Detail</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/enquiries" class="breadcrumb-link">Enquiries</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Enquiry Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header p-4">
                         <div style="float: left;">
                         <h3 class="mb-0">Enquiry ID- #{{$contact->id}}</h3>
                    
                         </div>
                       
                        <div class="float-right"> <h5 class="mb-0">{{showDateFormat($contact->created_at)}}</h5></div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <h3 class="mb-2 headsub">Details</h3>                                            
                                <h5 class="text-dark mb-1">{{$contact->name}}</h5>
                                <div>@if($contact->user_id == 0)User: Guest @else User ID: #{{$contact->user_id}} @endif</div>
                                <div>Email: {{$contact->email}}</div>
                                <div>Phone: {{$contact->phone}}</div>
                                     <h3 class="mb-2 mt-3 headsub">Message</h3>     
                                <div>{{$contact->message}} </div>
                              
                            </div>
                        </div>
                     </div>
         
                </div>
            </div>
        </div>

    </div>
</div>

@endsection