@extends('admin.layouts.app')
@section('content')
<style>
.err_place .card{
	margin-bottom:0;
}
</style>
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Manage Terms & Conditions</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Terms & Conditions</li>
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
                <h5 class="card-header">Terms & Conditions</h5>
                <div class="card-body">
                    <form id="update_page_form">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label text-sm-right">Page Title: </label>
                            <div class="col-12 col-sm-8 col-lg-6">
                                <input type="text" name="terms_page_title" placeholder="Enter page title" class="form-control" value="{{$page[2]->value}}">
                            </div>
                        </div>
                        <div class="form-group row err_place">
                            <textarea class="form-control" id="summernote" name="terms" rows="6" placeholder="Write Terms & Conditions...">{{$page[3]->value}}</textarea>
                        </div>

                        <div class="form-group row">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary update_page_btn">Update</button>
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