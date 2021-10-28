@extends('layouts.app')

@section('content')
<style type="text/css">
    .validation-error-message{
        color: red;
    }
</style>
  <!-- Start Page Title Area -->
        <div class="page-title-area page-title-bg3">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{$title}}</h2>
                </div>
            </div>
        </div>
        <!-- End Page Title Area -->

        <!-- Start Checkout Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="bg-box-als">
                    
                        
                        <div class="row">
                          
                            <div class="col-lg-12 col-md-12">
                            <input type="hidden" id="is_admin" value="@isset($is_admin){{$is_admin}}@endisset">
                                <form id="add_brand">
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                <input type="hidden" name="brand_id" value="@if(@isset($brand_details)){{$brand_details->id}}@else{{0}}@endif">
                                    <div class="billing-details">
                                    <h3 class="title font-strs">Brand Profile   </h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Brand Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="name" value="@isset($brand_details){{$brand_details->name}}@endisset">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Retail Category <span class="required">*</span></label>
                                                <select class="form-control" name="retail_category">
                                                    <option value="">Select One</option>
                                                    @foreach($retail_categories as $key)
                                                     <option value="{{$key->id}}" @isset($brand_details){{$brand_details->retail_category == $key->id ? 'selected' : ''}} @endisset>{{$key->name}} </option>
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="required">*</span></label>
                                                <textarea name="description" id="notes" cols="30" rows="5" placeholder="" class="form-control">@isset($brand_details){{$brand_details->description}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Open To Collaborations</label>                              
                                                <ul class="list-chkes row list-nw">  
                                                <li class="col-md-2 col-sm-4 mb-0"> 
                                                      <label class="costm-radio"><span class="cla"> Yes </span>
                                                        <input type="radio" class="open_to_collaborations" name="open_to_collaborations" checked value="1" @isset($brand_details){{$brand_details->open_to_collaborations == 1 ? 'checked' : ''}} @endisset>
                                                        <span class="checkmark"></span>
                                                      </label>
                         
                                                  </li>                                 
                                                  <li class="col-md-2 col-sm-4 mb-0">
                                                      <label class="costm-radio"> <span class="cla"> No </span>
                                                          <input type="radio" class="open_to_collaborations" name="open_to_collaborations" value="0" @isset($brand_details){{$brand_details->open_to_collaborations == 0 ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>                            
                                   
                                                  </li>   
                                                              
                                              </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 collaboration_type_div">
                                            <div class="form-group">
                                                <label>Collaboration Type <span class="required">*</span> <small> (What am I looking for?  ) </small></label>
                                                <ul class="list-chkes row list-nw collab_type_class">
                                                @foreach($collaboration_types as $key)
                                                    <li class="col-md-2 col-sm-4">
                                                        <label class="costm-check">{{$key->name}}<input class="collaboration_type_class" type="checkbox" name="collaboration_type[]" value="{{$key->id}}" @isset($brand_details){{in_array($key->id, $collaboration_types_arr) ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                          
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Location City <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="location_city" id="autocomplete" value="@isset($brand_details){{$brand_details->location_city}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Street and Number <span class="required">*</span></label>
                                                <div class="form-row">
													<div class="col-md-6">
														<input type="text" class="form-control" name="street" placeholder="Enter Street" id="street" value="@isset($brand_details){{$brand_details->street}}@endisset">
													</div>
													<div class="col-md-6">
														  <input type="text" class="form-control" name="street_no" id="street_no" value="@isset($brand_details){{$brand_details->street_no}}@endisset" placeholder="Street Number">
													</div>
												</div>
                                              
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>City<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="city" id="city" value="@isset($brand_details){{$brand_details->city}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Province/State<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="state" id="state" value="@isset($brand_details){{$brand_details->state}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Postal code/Zip Code <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="zip" id="zip" value="@isset($brand_details){{$brand_details->zip}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Country <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="country" id="country" value="@isset($brand_details){{$brand_details->country}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group price-list-widget prics">
                                                <label>Your Product Price range  <span class="required">*</span></label>
                                                <div class="collection-filter-by-price">
                                                  <input class="range_input" type="text" data-min="@if(@isset($brand_details)){{$brand_details->price_from}}@else{{50}}@endif" data-max="@if(@isset($brand_details)){{$brand_details->price_to}}@else{{500}}@endif" name="filter_by_price" data-step="10">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Pictures <!-- <span class="required">*</span> --></label>
                                                <div action="{{url('/upload_files')}}" class="dropzone pictures_dropzone cs-upload" style="color:red;">
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
                                                @isset($brand_details)
                                                 <?php $count = 0;  ?>
                                                  @foreach($listing_images as $key) 
                                                      @if($key->name != 'dummy_listing.jpg')
                                                       <div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url('/')}}/uploads/files/{{$key->name}}"><img src="{{url('/')}}/uploads/files/{{$key->name}}"></a><a href="javascript:void(0);" not-delete="1" class="dlt-img del_loc_img" data-id="{{$count}}"> <i class="bx bxs-trash"></i> </a></div></div>   <?php $count++;  ?>
                                                       @endif
                                                  @endforeach
                                                @endisset
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>File Upload <!-- <span class="required">*</span> --></label>
                                                <!-- <label class="flds-uploads pb-4" for="upload-logo">
                                                    <i class="bx bx-cloud-upload"></i>
                                                    <h4> Click here to upload File </h4>
                                                    <input type="file" id="upload-logo" style="visibility:hidden; width:0px; height:0px;">
                                                </label> -->
                                                <div action="{{url('/upload_files')}}" class="dropzone files_dropzone cs-upload" style="color:red;">
                                                  <div class="dz-message" data-dz-message>
                                                     <i class="fa fa-cloud-upload"></i>
                                                     <span class="cs-msg">Click to add or Drag and Drop</span>
                                                     <!--<button type="button" class="btn btn-default" style="background: white; color: rgb(64, 202, 90);">or select file to upload</button>-->
                                                  </div>
                                                  <div class="fallback">
                                                     <input name="uplod-img1" id="uplod-img1" type="file" multiple  />
                                                  </div>
                                               </div>
                                                <div class="row preview_files">
                                                @isset($brand_details)
                                                 <?php $count = 0;  ?>
                                                  @foreach($listing_files as $key) 
                                                     <div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url('/')}}/uploads/files/{{$key->name}}"><img src="{{url('/')}}/img/pdf.jpg"></a><a href="javascript:void(0);" not-delete="1" class="dlt-img del_loc_file" data-id="{{$count}}"> <i class="bx bxs-trash"></i> </a></div></div>  <?php $count++;  ?>
                                                  @endforeach
                                                @endisset
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>File Upload Viewer</label>
                                                <!-- <select class="form-control" name="file_upload_viewer">
                                                    <option value="">Select One</option>
                                                    <option value="0">Public  </option>
                                                    <option value="1">Private </option>
                                                </select> -->
                                                <ul class="list-chkes row list-nw">                                
                                                  <li class="col-md-2 col-sm-4 mb-0">
                                                      <label class="costm-radio"> <span class="cla"> Public </span>
                                                          <input type="radio" checked name="file_upload_viewer" value="0" @isset($brand_details){{$brand_details->file_upload_viewer == 0 ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>                            
                                   
                                                  </li>   
                                                  <li class="col-md-2 col-sm-4 mb-0"> 
                                                      <label class="costm-radio"><span class="cla"> Private </span>
                                                        <input type="radio" name="file_upload_viewer" value="1" @isset($brand_details){{$brand_details->file_upload_viewer == 1 ? 'checked' : ''}} @endisset>
                                                        <span class="checkmark"></span>
                                                      </label>
                         
                                                  </li>               
                                              </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12 col-md-12 mt-2">
                                            <h3 class="title mb-3">Social Media Accounts    </h3>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Facebook </label>
                                                <div class="icon-w-sc">
                                                    <input type="url" class="form-control" name="fblink" value="@isset($brand_details){{$brand_details->fblink}}@endisset" placeholder="www.facebook.com">
                                                    <i class="bx bxl-facebook"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Twitter </label>
                                                <div class="icon-w-sc">
                                                    <input type="url" class="form-control" value="@isset($brand_details){{$brand_details->twitterlink}}@endisset" name="twitterlink" placeholder="www.twitter.com">
                                                    <i class="bx bxl-twitter"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group">
                                                <label>Instagram </label>
                                                <div class="icon-w-sc">
                                                    <input type="url" class="form-control" name="instalink" value="@isset($brand_details){{$brand_details->instalink}}@endisset" placeholder="www.instagram.com">
                                                    <i class="bx bxl-instagram"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10">
                                            <div class="form-group">
                                                <label class="costm-check">Publish <small> (By Publishing you accept all Privacy and terms.) </small>
                                                  <input type="checkbox" name="terms" @isset($brand_details) checked @endisset>
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="lat" id="lat" value="@isset($brand_details){{$brand_details->lat}}@endisset">
                                        <input type="hidden" name="lng" id="lng" value="@isset($brand_details){{$brand_details->lng}}@endisset">
                                        <div class="col-lg-12 col-md-12">
                                            <button class="btn btn-save-stt submit_btn" type="submit"> Save </button>
                                        </div>
                                    </div>
                                </div>
                               </form>
                            </div>

                        </div>
                   </div>
            </div>
        </section>
        <!-- End Checkout Area -->

@endsection
@section('footer_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>
<script type="text/javascript">
$(".range_input").ionRangeSlider({
        type: "double",
        drag_interval: true,
        min_interval: null,
        max_interval: null,
        onFinish: function (data) {
            if(data.to == '500'){
                $('.irs-to').append('+');
            }
        },
    });   
var input = document.getElementById('autocomplete');
var autocomplete = new google.maps.places.Autocomplete(input);
var componentForm = {
          street_number: 'short_name',
          route: 'long_name',
          locality: 'long_name',
          administrative_area_level_1: 'long_name',
          country: 'long_name',
          postal_code: 'short_name'
        };
google.maps.event.addListener(autocomplete, 'place_changed', function() {
    $('.showmap').show();
    $('#street').val('');$('#street_no').val('');$('#city').val('');$('#state').val('');$('#country').val('');$('#zip').val('');
            var place = autocomplete.getPlace();
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                  var val = place.address_components[i][componentForm[addressType]];
                  if(addressType == 'street_number'){
                    $('#street').val(val);
                  }
                  if(addressType == 'route'){
                    $('#street_no').val(val);
                  }
                  if(addressType == 'locality'){
                    $('#city').val(val);
                  }
                  if(addressType == 'administrative_area_level_1'){
                    $('#state').val(val);
                  }
                  if(addressType == 'country'){
                    $('#country').val(val);
                  }
                  if(addressType == 'postal_code'){
                    $('#zip').val(val);
                  }
                 // console.log(addressType+': '+val);
                }
              }
              var lat = place.geometry.location.lat(),
              lng = place.geometry.location.lng();
              $('#lat').val(lat);
              $('#lng').val(lng);
 });

$(function($) {   
    var myDropzone = new Dropzone('.pictures_dropzone',{
         timeout:1800000,
         acceptedFiles: ".jpeg,.jpg,.png,.gif",
         init: function(){   
             var new_this = this;   
             this.on('error', function(file, response) {   
               swal("Error!", response, "error");   
               console.log(response);

             }); 
             this.on('success', function(file, response) { 
                var res = JSON.parse(response);
                if(res.status == 1){
                    var img_index = all_uploaded_pictures.length;
                    all_uploaded_pictures.push(res.image_name);
                    localStorage.setItem('all_uploaded_files',JSON.stringify(all_uploaded_pictures));

                    $(".preview_pictures").append('<div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url("/")}}/uploads/files/'+res.image_name+'"><img src="{{url("/")}}/uploads/files/'+res.image_name+'"></a><a href="javascript:void(0);" class="dlt-img del_loc_img" not-delete="0" data-id="'+img_index+'"> <i class="bx bxs-trash"></i> </a></div></div>');
                }                 
             });        
             this.on("queuecomplete", function(file) {        
                new_this.removeAllFiles();        
             });
   
           } 
   
   });
    myDropzone.on('sending', function(file, xhr, formData) {
      formData.append('_token', '{{ Session::token() }}');
    });
  
  var myDropzone1 = new Dropzone('.files_dropzone',{
         timeout:1800000,
         acceptedFiles: ".PDF",
         init: function(){   
             var new_this = this;   
             this.on('error', function(file, response) {   
               swal("Error!", response, "error");   
               console.log(response);

             }); 
             this.on('success', function(file, response) { 
                var res = JSON.parse(response);
                if(res.status == 1){
                    var img_index = all_uploaded_files.length;
                    all_uploaded_files.push(res.image_name);
                    localStorage.setItem('all_uploaded_files',JSON.stringify(all_uploaded_files));

                    $(".preview_files").append('<div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url("/")}}/uploads/files/'+res.image_name+'"><img src="{{url("/")}}/img/pdf.jpg"></a><a href="javascript:void(0);" not-delete="0" class="dlt-img del_loc_file" data-id="'+img_index+'"> <i class="bx bxs-trash"></i> </a></div></div>');
                }                 
             });        
             this.on("queuecomplete", function(file) {        
                new_this.removeAllFiles();        
             });
   
           } 
   
   });
    myDropzone1.on('sending', function(file, xhr, formData) {
      formData.append('_token', '{{ Session::token() }}');
    });
    $(document).on('click','.del_loc_img',function(){
        var ind = $(this).attr('data-id');
        $(this).closest('.single_img_div').remove();
        var image_name = all_uploaded_pictures[ind];
        all_uploaded_pictures[ind] = 0;
        localStorage.setItem('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
        if($(this).attr('not-delete') == '0'){
          $.ajax({
              url: '{{url("/")}}/delete_listing_image',
              type: 'POST',
              data: {"_token": '{{ Session::token() }}', image_name : image_name},
              dataType: 'json',
              success: function(result) {
                console.log(result);
              }            
          });
        }
    });
     $(document).on('click','.collaboration_type_class',function(){
    
            if($(this).val() == '1'){

                if($(this).prop("checked") == true){                     
                        $('.collaboration_type_class').prop('checked', true);
                }else{
                         $('.collaboration_type_class').prop('checked',false);
                }
            }
        });
     $(document).on('click','.open_to_collaborations',function(){
    
            if($(this).val() == '0'){
              $('.collaboration_type_class').rules('remove');  
              $('.collaboration_type_div').hide();
              $('.collaboration_type_class').prop('checked',false);
            }else{
                // $('.collaboration_type_div').rules('add',  { required: true });
                $('.collaboration_type_div').show();
                $('.collaboration_type_class').each(function() {
                    $(this).rules("add", 
                        {
                            required: true,
                        });
                });
            }
        });
    $(document).on('click','.del_loc_file',function(){
        var ind = $(this).attr('data-id');
        $(this).closest('.single_img_div').remove();
        var image_name = all_uploaded_files[ind];
        all_uploaded_files[ind] = 0;
        localStorage.setItem('all_uploaded_files',JSON.stringify(all_uploaded_files));
        if($(this).attr('not-delete') == '0'){
          $.ajax({
              url: '{{url("/")}}/delete_listing_image',
              type: 'POST',
              data: {"_token": '{{ Session::token() }}', image_name : image_name},
              dataType: 'json',
              success: function(result) {
                console.log(result);
              }            
          });
        }
    });
    $('#add_brand').validate({
    ignore: [],
    rules: {    
        "collaboration_type[]":"required",
        name:
        {
            required:true       
        },   
        retail_category:
        {
            required:true       
        },   
        location_city:
        {
            required: true
        },
        description:
        {
            required: true
        },
        // fblink:{
        //     required: true,
        // },
        // twitterlink:{
        //     required: true,
        // },
        // instalink:{
        //     required: true,
        // },
        street:{
            required: true,
        },
        street_no:{
            required: true,
        },
        city:{
            required: true,
        },
        zip:{
            required: true,
        },
        country:{
            required: true,
        },
        state:{
            required: true,
        },
        terms:{
            required: true,
        }
        ,
        file_upload_viewer:{
            required: true,
        }
    },  

          highlight: function(element) {
            $(element).parent().addClass('has-error');
          },
          unhighlight: function(element) {
            $(element).parent().removeClass('has-error');
          },
              errorElement: 'span',
              errorClass: 'validation-error-message help-block form-helper bold',
              errorPlacement: function(error, element) {
                if (element.is('select:hidden')) {
                    error.insertAfter(element.next('.nice-select'));
                }else if(element.attr("name") == "collaboration_type[]"){
                    error.insertAfter(".collab_type_class");
                }else{
                    error.insertAfter(element);
                } 
            },
        submitHandler: function(form) 
        { 
           var anypicture= all_uploaded_pictures.filter(function(x) { return x; }).pop();
           var anyfile = all_uploaded_files.filter(function(x) { return x; }).pop();
           // if(all_uploaded_pictures.length<1 || !anypicture){
           //  swal("Error!", 'Please upload atleast one picture', "error"); 
           // }
           // if(all_uploaded_files.length<1 || !anyfile){
           //  swal("Error!", 'Please upload atleast one file', "error"); 
           // }
          // if(!(all_uploaded_pictures.length<1 || !anypicture) && !(all_uploaded_files.length<1 || !anyfile)){
               var formData = new FormData($("#add_brand")[0]);
               formData.append('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
               formData.append('all_uploaded_files',JSON.stringify(all_uploaded_files));

                $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);            
                $.ajax({
                        url:'{{url("/")}}'+'/add_brand',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success:function(result)
                        { 
                           if($('#is_admin').val() == '1'){
                                 $('.submit_btn').html('Save').prop('disabled',false); 
                                 swal({title: "Success!", text: "Brand Updated Successfully.", type: "success"},
                                          function(){ 
                                             window.location.href='<?php echo url("admin/brand-listings"); ?>';
                                      }
                                   );
                            }else{
                              $('.submit_btn').html('Save').prop('disabled',false); 
                                 if(result.status == 1){
                                    <?php if(isset($brand_details)){ ?>
                                    swal({title: "Success!", text: "Brand Updated Successfully.", type: "success"},
                                        function(){ 
                                           location.reload();
                                        }
                                     );
                                 <?php }else{ ?>
                                    swal({title: "Success!", text: "Brand Added Successfully.", type: "success"},
                                      function(){ 
                                         window.location.href='<?php echo url("user-brands"); ?>';
                                      }
                                   ); 
                                <?php } ?>
                                
                              }else{
                                swal({title: "Error", text: "Oops! Something went wrong. Please try again later", type: "error"});
                              }
                          }
                    }
                });
          // }
           
        } 
        
    });
});

</script>




 @isset($brand_details)

 @if($brand_details->open_to_collaborations == 0)
    <script type="text/javascript">
    setTimeout( function(){ 
       $('.collaboration_type_class').rules('remove'); 
    }  , 1000 );
     
      $('.collaboration_type_div').hide();
      $('.collaboration_type_class').prop('checked',false); 
    </script>
 @endif
 <?php $count = 1;  ?>
  @foreach($listing_images as $key) 
  @if($key->name != 'dummy_listing.jpg')
            <script type="text/javascript">
              all_uploaded_pictures.push("{{$key->name}}");
            </script>
            <?php $count++;  ?>
  @endif
  @endforeach
  <?php $count = 1;  ?>
  @foreach($listing_files as $key) 
            <script type="text/javascript">
              all_uploaded_files.push("{{$key->name}}");
            </script>
            <?php $count++;  ?>
  @endforeach
@endisset
@stop