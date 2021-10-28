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
                    <h2 class="pageheader-title">Manage Privacy Policy</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manage Privacy Policy</li>
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
                <h5 class="card-header">Privacy Policy</h5>
                <div class="card-body">
                    <form id="update_page_form" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                        <div class="col-lg-12 col-md-12">
                             <div class="form-group">
                                <label class="col-form-label text-sm-right">Page Title: </label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" name="about_page_title" placeholder="Enter page title" class="form-control" value="{{$page[4]->value}}">
                                </div>
                            </div>
                            <div class="form-group err_place">
                                <label class="col-form-label text-sm-right">Left Side: </label>
                                <div class="col-12 col-sm-12 col-md-12">
                                    <textarea class="form-control" id="summernote" name="about_left_side" rows="6">{{$page[5]->value}}</textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                          <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Right Side First Image: <img src="{{url('/')}}/img/{{$page[6]->value}}" class="showthumbnail" height="60" width="60"></label>
                              <input type="file" class="form-control images" accept="image/*" name="about_right_first_img" style="padding: 8px 15px;">
                            </div>
                          </div> 
                          <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                              <label>Right Side Second Image: <img src="{{url('/')}}/img/{{$page[7]->value}}" class="showthumbnail" height="60" width="60"></label>
                              <input type="file" class="form-control images" accept="image/*" name="about_right_second_img" style="padding: 8px 15px;">
                            </div>
                          </div>                          
                        </div>
                        <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group err_place">
                                <label class="col-form-label text-sm-right">Second Section: </label>
                                <div class="col-12 col-sm-12 col-md-12">
                                    <textarea class="form-control" id="summernote1" name="about_second_section" rows="6" >{{$page[8]->value}}</textarea>
                                </div>
                            </div>
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