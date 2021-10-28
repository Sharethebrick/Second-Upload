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
                    <h2 class="pageheader-title">Manage Home</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Home</li>
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
                <h5 class="card-header">Home</h5>
                <div class="card-body">
                    <form id="update_page_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                 <div class="form-group">
                                    <label class="col-form-label text-sm-right">Page Title: </label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" name="home_page_title" placeholder="Enter page title" class="form-control" value="{{$page[9]->value}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="form-group err_place">
                            <label class="col-form-label text-sm-right">Sign Up User Section: </label>
                            <div class="col-12 col-sm-12 col-md-12">
                                <textarea class="form-control" id="summernote" name="home_page_user_signup_section" rows="6" >{{$page[10]->value}}</textarea>
                            </div>
                        </div>
                        <div class="form-group err_place">
                            <label class="col-form-label text-sm-right">Sign Up Landlord Section: </label>
                            <div class="col-12 col-sm-12 col-md-12">
                                 <textarea class="form-control" id="summernote1" name="home_page_landlord_signup_section" rows="6" >{{$page[11]->value}}</textarea>
                            </div>
                        </div>
                        <div class="form-group err_place">
                            <label class="col-form-label text-sm-right">Contact Title: </label>
                            <div class="col-12 col-sm-12 col-md-12">
                                 <textarea class="form-control" id="summernote2" name="home_page_contact_title" rows="6" >{{$page[12]->value}}</textarea>
                            </div>
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
@section('footer_scripts')
<script type="text/javascript">
    
</script>
@stop