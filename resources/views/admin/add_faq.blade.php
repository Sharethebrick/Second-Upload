@extends('admin.layouts.app')
@section('content')
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{empty($id) ? 'Add' : 'Edit'}} FAQ</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/faq/{{$cat_id}}" class="breadcrumb-link">FAQ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{empty($id) ? 'Add' : 'Edit'}} FAQ</li>
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
                <h5 class="card-header">{{empty($id) ? 'Add' : 'Edit'}} FAQ</h5>
                <div class="card-body">
                    <form id="add_faq_form">
                        @csrf
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="cat_id" value="{{$cat_id}}" id="cat_id">
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Question: </label>
                            <div class="col-md-8">
                                <textarea class="form-control" name="question" rows="3">{{!empty($faq) ? $faq->question : ''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Answer: </label>
                            <div class="col-md-8">
                                 <textarea class="form-control" name="answer" rows="6">{{!empty($faq) ? $faq->answer : ''}}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary add_user_btn">Submit</button>
                                <a href="{{url('/')}}/admin/faq/{{$cat_id}}">
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