@extends('admin.layouts.app')
@section('content')
<style type="text/css">
  .fstElement,.fstControls{
    width:100% !important;
  }
  .fstResultItem,.fstChoiceItem,.fstQueryInput{
    font-size: 14px !important;
  }
  .image-uploda img {
    width: 100%;
    height: 120px;
    border-radius: 5px;
    border: 1px dashed rgba(8, 141, 211, 0.27);
    padding: 2px;
    object-fit: cover;
}
.image-uploda a.dlt-img {
    width: 20px;
    height: 20px;
    background: #dc3545;
    position: absolute;
    border-radius: 50%;
    color: #fff;
    text-align: center;
    font-size: 10px;
    line-height: 20px;
    right: -5px;
    top: -5px;
}
</style>
<div class="dashboard-ecommerce">
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">{{empty($cat_id) ? 'Add' : 'Edit'}} Resource</h2>
                    <div class="page-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/dashboard" class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{url('/')}}/admin/resources-list" class="breadcrumb-link">Resources</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{empty($cat_id) ? 'Add' : 'Edit'}} Resource</li>
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
                <h5 class="card-header">{{empty($cat_id) ? 'Add' : 'Edit'}} Resource</h5>
                <div class="card-body">
                    <form id="add_resource_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="resource_id" value="{{$cat_id}}">
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Title: </label>
                            <div class="col-md-8">
                                <input type="text" name="title" placeholder="Resource Title" class="form-control" value="{{!empty($resource) ? $resource->title : ''}}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                                                     
                              <label class="col-12 col-sm-3 col-form-label text-sm-right">Image: @if(!empty($resource))<img src="{{url('/uploads/files')}}/{{$resource->file}}" class="showthumbnail" height="60" width="60"> @endif</label>
                              <div class="col-md-8"> 
                              <input type="file" class="form-control images" accept="image/*" name="file" style="padding: 8px 15px;">
                      
                          </div>                         
                        </div>
                        <div class="form-group row">
                           <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Pdfs <!-- <span class="required">*</span> --></label>
                                                <!-- <label class="flds-uploads pb-4" for="upload-logo">
                                                    <i class="bx bx-cloud-upload"></i>
                                                    <h4> Click here to upload Image </h4>
                                                    <input type="file" id="upload-logo" style="visibility:hidden; width:0px; height:0px;">
                                                </label>  -->
                                        
                                              <div action="{{url('/upload_resource_files')}}" class="dropzone pictures_dropzone cs-upload" style="color:red;">
                                                  <div class="dz-message" data-dz-message>
                                                     <i class="fa fa-cloud-upload"></i>
                                                     <span class="cs-msg">Click to add or Drag and Drop</span>
                                                     <!--<button type="button" class="btn btn-default" style="background: white; color: rgb(64, 202, 90);">or select file to upload</button>-->
                                                  </div>
                                                  <div class="fallback">
                                                     <input name="uplod-img" id="uplod-img" type="file" multiple />
                                                  </div>
                                               </div>

                                                <div class="row preview_pictures">
                                                 @isset($resource)
                                                 <?php $count = 0;  ?>
                                                  @foreach($listing_images as $key) 
                                                     <div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url('/')}}/uploads/files/{{$key->name}}"><img src="{{url('/')}}/img/pdf.jpg"></a><a href="javascript:void(0);" not-delete="1" class="dlt-img del_loc_file" data-id="{{$count}}"> <i class="bx bxs-trash"></i> </a></div></div>  <?php $count++;  ?>
                                                  @endforeach
                                                @endisset
                                                </div>
                                            </div>
                                        </div>
                          </div>
                        
                       <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group err_place">
                                <label class="col-form-label text-sm-right">Discription: </label>
                                <div class="col-12 col-sm-12 col-md-12">
                                    <textarea class="form-control" id="summernote" name="description" rows="6">{{!empty($resource) ? $resource->description : ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group multislsct">
                                <label>Tags: </label>
                                <select class="multipleSelect form-control" multiple name="tags[]">
                                    
                                    @if(!empty($res_tags))
                                      @foreach($res_tags as $key)
                                        <option value="{{$key->id}}" @isset($resource){{in_array($key->id, $tags) ? 'selected' : ''}} @endisset>{{$key->name}}</option>
                                      @endforeach
                                    @endif                                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row text-right">
                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                <button type="submit" class="btn btn-space btn-primary add_user_btn">Submit</button>
                                <a href="{{url('/')}}/admin/resources-list">
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
@section('footer_scripts')

<script type="text/javascript">
            var all_uploaded_res_files = [];
            localStorage.setItem('all_uploaded_res_files',JSON.stringify(all_uploaded_res_files));
$(function() {
    
      
    
  $("#add_resource_form").validate({
  // Specify validation rules
  rules: {
     title:
      {
          required: true,
      },
      description:
      {
          required: true,
      },
      @if(empty($resource))
      file:
      {
          required: true,
      }
      @endif
  },
  // Make sure the form is submitted to the destination defined
  // in the "action" attribute of the form when valid
  submitHandler: function(form) {
      
       var anyfile = all_uploaded_res_files.filter(function(x) { return x; }).pop();
       
         var formData = new FormData($("#add_resource_form")[0]);
        formData.append('all_uploaded_res_files',JSON.stringify(all_uploaded_res_files));
      
       
    $(".signup-errors").hide().html('');
      $(".add_user_btn").html('<i class="fa fa-spinner fa-spin"></i>').attr('disabled','disabled');
        $.ajax({
            url: BASE_URL+'/admin/add_resource_submit',
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: formData,
            success: function(result) {
              $(".add_user_btn").html('Submit').removeAttr('disabled','disabled');
                if(result.status == 1){  
                  window.location.href = BASE_URL+'/admin/resources-list';             
                }
                else{
                  $(".signup-errors").show().html('Error, please try later.');
                }
            }            
        });
  }
  });
});
$('.multipleSelect').fastselect();
$(document).on('click','.del_loc_file',function(){
        var ind = $(this).attr('data-id');
        $(this).closest('.single_img_div').remove();
        var image_name = all_uploaded_res_files[ind];
        all_uploaded_res_files[ind] = 0;
        localStorage.setItem('all_uploaded_res_files',JSON.stringify(all_uploaded_res_files));
        if($(this).attr('not-delete') == '0'){
          $.ajax({
              url: '{{url("/")}}/delete_listing_res_image',
              type: 'POST',
              data: {"_token": '{{ Session::token() }}', image_name : image_name},
              dataType: 'json',
              success: function(result) {
                console.log(result);
              }            
          });
        }
    });

  var myDropzone2 = new Dropzone('.pictures_dropzone',{
         timeout:1800000,
         acceptedFiles: ".pdf",
         init: function(){   
             var new_this = this;   
             this.on('error', function(file, response) {   
               swal("Error!", response, "error");   
               console.log(response);

             }); 
             this.on('success', function(file, response) { 
                var res = JSON.parse(response);
                if(res.status == 1){
                     var img_index = all_uploaded_res_files.length;
                    all_uploaded_res_files.push(res.image_name);
                    localStorage.setItem('all_uploaded_res_files',JSON.stringify(all_uploaded_res_files));

                    $(".preview_pictures").append('<div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url("/")}}/uploads/files/'+res.image_name+'"><img src="{{url("/")}}/img/pdf.jpg"></a><a href="javascript:void(0);" not-delete="0" class="dlt-img del_loc_file" data-id="'+img_index+'"> <i class="bx bxs-trash"></i> </a></div></div>');
      
                    
                    
                         }                 
             });        
             this.on("queuecomplete", function(file) {        
                new_this.removeAllFiles();        
             });
   
           } 
   
   });
    
    
    
</script>
 @isset($resource)
 <script type="text/javascript">
    var brand = $('#select_brand').val();
            // $.ajax({
            //         type:'POST',
            //         url:'{{url("/")}}'+'/get_brand_detals_ajax',
            //         data:{id:brand,_token:'{{ Session::token() }}'},
            //         success:function(result)
            //         { 
            //         var obj = $.parseJSON(result); 
            //           $('.brand_details').html(obj.brand_details);
            //           $('#listing-popup').html(obj.listing_details);
            //           $('.listing-details-image-slides').owlCarousel({
            //             loop: true,
            //             nav: true,
            //             dots: false,
            //             autoplayHoverPause: true,
            //             autoplay: true,
            //             animateOut: 'fadeOut',
            //             items: 1,
            //             navText: [
            //                 "<i class='flaticon-left'></i>",
            //                 "<i class='flaticon-right'></i>"
            //             ],
            //         });
            //         }
            // });
            
            
</script>

 
  
  <?php $count = 1;  ?>
  @foreach($listing_images as $key) 
            <script type="text/javascript">
              all_uploaded_res_files.push("{{$key->name}}");
            </script>
            <?php $count++;  ?>
  @endforeach
@endisset

@stop


 