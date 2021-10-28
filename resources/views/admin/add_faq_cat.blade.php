@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{empty($cat_id) ? 'Add' : 'Edit'}} Category</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/faq-categories" class="breadcrumb-link">FAQ Categories</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{empty($cat_id) ? 'Add' : 'Edit'}} Category</li>
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
                <h5 class="card-header">{{empty($cat_id) ? 'Add' : 'Edit'}} Category</h5>
                <div class="card-body">
                    <form id="add_cat_form">
                        @csrf
                        <input type="hidden" name="cat_id" value="{{$cat_id}}">
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Name</label>
                            <div class="col-md-8">
                                <input type="text" name="name" placeholder="Category Name" class="form-control" value="{{!empty($category) ? $category->name : ''}}">
                            </div>
                        </div>
                        
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary add_user_btn">Submit</button>
                                <a href="{{url('/')}}/admin/faq-categories">
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