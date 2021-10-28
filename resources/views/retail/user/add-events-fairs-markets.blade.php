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
                                <form id="add_events_fairs_form">
                                 <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                 <input type="hidden" name="eventfairs_id" value="@if(@isset($eventsfairs_details)){{$eventsfairs_details->id}}@else{{0}}@endif">
                                    <div class="billing-details">
                                    <h3 class="title font-strs">Events Fairs Markets    </h3>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" value="@isset($eventsfairs_details){{$eventsfairs_details->name}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Location <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="address" id="autocomplete" value="@isset($eventsfairs_details){{$eventsfairs_details->location_city}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Street and Number <span class="required">*</span></label>
												
												<div class="form-row">
													<div class="col-md-6">
														<input type="text" class="form-control" name="street" placeholder="Enter Street" id="street" value="@isset($eventsfairs_details){{$eventsfairs_details->street}}@endisset">
													</div>
													<div class="col-md-6">
														<input type="text" class="form-control" name="street_no" id="street_no" value="@isset($eventsfairs_details){{$eventsfairs_details->street_no}}@endisset" placeholder="Street Number">
													</div>
												</div>
												
												
												
                                                
                                             
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>City<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="city" id="city" value="@isset($eventsfairs_details){{$eventsfairs_details->city}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Province/State<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="state" id="state" value="@isset($eventsfairs_details){{$eventsfairs_details->state}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Postal code/Zip Code <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="zip" id="zip" value="@isset($eventsfairs_details){{$eventsfairs_details->zip}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Country <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="country" id="country" value="@isset($eventsfairs_details){{$eventsfairs_details->country}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="required">*</span></label>
                                                <textarea name="description" id="notes" cols="30" rows="5" placeholder="" class="form-control">@isset($eventsfairs_details){{$eventsfairs_details->description}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Retail Categories  <!-- <span class="required">*</span> --> </label>
                                                <ul class="list-chkes row list-nw ideal_class">
                                                <?php $checked = 0; ?>
                                                @foreach($retail_categories as $key)
                                                    @isset($eventsfairs_details)
                                                        <?php 
                                                            if(!in_array($key->id, $retail_categories_arr)){
                                                                $checked = 1;
                                                            }
                                                        ?>
                                                    @endisset
                                                    <li class="col-md-2 col-sm-4">
                                                        <label class="costm-check">{{$key->name}}
                                                          <input type="checkbox" class="class_all_retail" name="retail_category[]" value="{{$key->id}}" @isset($eventsfairs_details){{in_array($key->id, $retail_categories_arr) ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                                                 <li class="col-md-2 col-sm-4">
                                                    <label class="costm-check">All Categories
                                                      <input type="checkbox" value="select" class="select_all_retail" @isset($eventsfairs_details){{$checked==0? 'checked' : ''}} @endisset>
                                                      <span class="checkmark"></span>
                                                    </label>
                                                 </li> 
                                               
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5">
                                            <div class="form-group">
                                                <label>Space Size  <span class="required">*</span></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="space_size" value="@isset($eventsfairs_details){{$eventsfairs_details->size}}@endisset">
                                                    <select class="form-control" name="space_size_unit">
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->size_unit == 'sq feet' ? 'selected' : ''}} @endisset>sq feet</option>
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->size_unit == 'sq meters' ? 'selected' : ''}} @endisset>sq meters</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 pr-0 lease_price_div">
                                            <div class="form-group">
                                                <label>Fee  <span class="required">*</span></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="fee" id="fee_price" value="@isset($eventsfairs_details){{$eventsfairs_details->price_from}}@endisset">
                                                    <select class="form-control" name="fee_unit">
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->price_unit == 'Onetime' ? 'selected' : ''}} @endisset>Onetime</option>
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->price_unit == 'Daily' ? 'selected' : ''}} @endisset>Daily</option>
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->price_unit == 'Weekly' ? 'selected' : ''}} @endisset>Weekly</option>
                                                        <option @isset($eventsfairs_details){{$eventsfairs_details->price_unit == 'Monthly' ? 'selected' : ''}} @endisset>Monthly</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <label class="costm-check pric-stra">Does not want to list the price ?
                                              <input type="checkbox" id="check_price" @isset($eventsfairs_details){{!$eventsfairs_details->price_from ? 'checked' : ''}} @endisset>
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Additional fees <!-- <span class="required">*</span> --></label>
                                                <textarea name="additional_fee" cols="30" rows="5" placeholder="" class="form-control">@isset($eventsfairs_details){{$eventsfairs_details->additional_fee}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Included with Lease <!-- <span class="required">*</span> --></label>
                                                <textarea name="include_with_lease" cols="30" rows="5" placeholder="For example Rate includes utilities, building services and property expenses" class="form-control">@isset($eventsfairs_details){{$eventsfairs_details->include_with_lease}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Start Date and Time <span class="required">*</span></label>
                                                <input type="text" value="@isset($eventsfairs_details){{$start_avail_date}}@endisset" class="form-control" id="datetimepicker" name="start_datetime" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>End Date and Time <span class="required">*</span></label>
                                                <input type="text" value="@isset($eventsfairs_details){{$end_avail_date}}@endisset" class="form-control" id="datetimepicker2" name="end_datetime" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Amenities <!-- <span class="required">*</span> --> </label>
                                                <ul class="list-chkes row list-nw amenties_class">
                                                     @foreach($amenities as $key)
                                                        <li class="col-md-2 col-sm-4">
                                                            <label class="costm-check">{{$key->name}}
                                                              <input type="checkbox" value="{{$key->id}}" name="amenities[]" @isset($eventsfairs_details){{in_array($key->id, $amenities_arr) ? 'checked' : ''}} @endisset>
                                                              <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                    <li class="col-md-4 col-sm-4  othrflt">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="@isset($eventsfairs_details){{$eventsfairs_details->amenities_other_option}}@endisset" placeholder="Add Other Option" name="amenities_other_option">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                       <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Pictures <!-- <span class="required">*</span> --></label>
                                                 <div action="{{url('/upload_files')}}" class="dropzone pictures_dropzone cs-upload" style="color:red;">
                                                  <div class="dz-message" data-dz-message>
                                                     <i class="fa fa-cloud-upload"></i>
                                                     <span class="cs-msg">Click to add or Drag and Drop</span>
                                                    <!--  <button type="button" class="btn btn-default" style="background: white; color: rgb(64, 202, 90);">or select file to upload</button> -->
                                                  </div>
                                                  <div class="fallback">
                                                     <input name="uplod-img" id="uplod-img" type="file" multiple />
                                                  </div>
                                               </div>

                                                 <div class="row preview_pictures">
                                                @isset($eventsfairs_details)
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
                                                    <!--  <button type="button" class="btn btn-default" style="background: white; color: rgb(64, 202, 90);">or select file to upload</button> -->
                                                  </div>
                                                  <div class="fallback">
                                                     <input name="uplod-img1" id="uplod-img1" type="file" multiple  />
                                                  </div>
                                               </div>
                                                <div class="row preview_files">
                                                    @isset($eventsfairs_details)
                                                     <?php $count = 0;  ?>
                                                      @foreach($listing_files as $key) 
                                                         <div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url('/')}}/uploads/files/{{$key->name}}"><img src="{{url('/')}}/img/pdf.jpg"></a><a href="javascript:void(0);" class="dlt-img del_loc_file" not-delete="1" data-id="{{$count}}"> <i class="bx bxs-trash"></i> </a></div></div>  <?php $count++;  ?>
                                                      @endforeach
                                                    @endisset
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="file_upload_viewer" value="0">
                                        <!-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>File Upload Viewer</label>                                    
                                                <ul class="list-chkes row list-nw">                                
                                                  <li class="col-md-2 col-sm-4 mb-0">
                                                      <label class="costm-radio"> <span class="cla"> Public </span>
                                                          <input type="radio" checked="checked" name="file_upload_viewer" value="0" @isset($eventsfairs_details){{$eventsfairs_details->file_upload_viewer == 0 ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>                            
                                   
                                                  </li>   
                                                  <li class="col-md-2 col-sm-4 mb-0"> 
                                                      <label class="costm-radio"><span class="cla"> Private </span>
                                                        <input type="radio" name="file_upload_viewer" value="1" @isset($eventsfairs_details){{$eventsfairs_details->file_upload_viewer == 1 ? 'checked' : ''}} @endisset>
                                                        <span class="checkmark"></span>
                                                      </label>
                         
                                                  </li>               
                                              </ul>
                                            </div>
                                        </div> -->
                                       <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>LISTING OWNER EMAIL<span class="required">*</span></label>
                                                <input type="email" class="form-control" name="email_listing_owner" placeholder="demo@example.com" value="@isset($eventsfairs_details){{$eventsfairs_details->email_listing_owner}}@endisset">
                                            </div>
                                        </div>
                                        @if(count($bricks)>0)
                                       <!--  <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Associate Brick </label>
                                                <select class="form-control" name="brand">
                                                    <option value="">Select One</option>
                                                    @foreach($bricks as $key)
                                                         <option value="{{$key->id}}"@isset($eventsfairs_details){{$eventsfairs_details->brand == $key->id ? 'selected' : ''}} @endisset>{{$key->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> -->
                                        @endif
                                       <div class="col-lg-12 col-md-12 showmap" style="display: none;">
                                            <div class="form-group">
                                                <label>Map</label>
                                               <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d387190.279909073!2d-74.25987368715491!3d40.69767006458873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1snew%20york%20city!5e0!3m2!1sen!2sin!4v1585542887196!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                                                <div id="map_canvas" style="width:100%;height:380px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10">
                                            <div class="form-group">
                                                <label class="costm-check">Publish<small> (By Publishing you accept all Privacy and terms.) </small>
                                                  <input type="checkbox" name="terms" @isset($eventsfairs_details) checked @endisset>
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <input type="hidden" name="lat" id="lat" value="@isset($eventsfairs_details){{$eventsfairs_details->lat}}@endisset">
                                            <input type="hidden" name="lng" id="lng" value="@isset($eventsfairs_details){{$eventsfairs_details->lng}}@endisset">
                                            <button class="btn btn-save-stt submit_btn" type="submit"> Save </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Checkout Area -->


@endsection

@section('footer_scripts')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1dsvymo1CdKQVBIEsIS4HSc0-dulFwfc&libraries=places"></script>
<script>
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
            var myLatlng = new google.maps.LatLng(lat, lng);
                var myOptions = {
                zoom: 8,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: $('#autocomplete').val()
            });
           

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

                    $(".preview_pictures").append('<div class="col-lg-2 col-md-3 single_img_div">  <div class="image-uploda"> <a target="_blank" href="{{url("/")}}/uploads/files/'+res.image_name+'"><img src="{{url("/")}}/uploads/files/'+res.image_name+'"></a><a href="javascript:void(0);" not-delete="0" class="dlt-img del_loc_img" data-id="'+img_index+'"> <i class="bx bxs-trash"></i> </a></div></div>');
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
    $('#add_events_fairs_form').validate({
    ignore: [],
    rules: {    
       // "amenities[]":"required",
       // "retail_category[]":"required",
        title:
        {
            required:true       
        },   
        address:
        {
            required: true
        },
        description:
        {
            required: true
        },
        space_size:
        {
            required: true,
            digits: true,
            min:1
        },
        fee:
        {
            required: true,
            digits: true,
            min:1
        },
        // additional_fee:
        // {
        //     required: true
        // },
        // include_with_lease:
        // {
        //     required: true
        // },
        start_datetime:
        {
            required: true
        },
        end_datetime:
        {
            required: true
        },
        email_listing_owner:
        {
            required: true,
            email:true
        },
        terms:{
            required: true,
        },
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
        // file_upload_viewer:{
        //     required:true
        // }
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
                }else if(element.attr("name") == "amenities[]"){
                    error.insertAfter(".amenties_class");
                }else if(element.attr("name") == "retail_category[]"){
                    error.insertAfter(".ideal_class");
                }  else {
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
           //if(!(all_uploaded_pictures.length<1 || !anypicture) && !(all_uploaded_files.length<1 || !anyfile)){
               var formData = new FormData($("#add_events_fairs_form")[0]);
               formData.append('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
               formData.append('all_uploaded_files',JSON.stringify(all_uploaded_files));

                $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);            
                $.ajax({
                        url:'{{url("/")}}'+'/add_events_fairs',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success:function(result)
                        { 
                            if($('#is_admin').val() == '1'){
                                 $('.submit_btn').html('Save').prop('disabled',false); 
                                 swal({title: "Success!", text: "Events Fairs Markets Updated Successfully.", type: "success"},
                                          function(){ 
                                             window.location.href='<?php echo url("admin/event-fairs-listings"); ?>';
                                      }
                                   );
                            }else{
                                $('.submit_btn').html('Save').prop('disabled',false); 
                                if(result.status == 1){
                                     <?php if(isset($eventsfairs_details)){ ?>
                                      swal({title: "Success!", text: "Events Fairs Markets Updated Successfully.", type: "success"},
                                      function(){ 
                                         location.reload();
                                      }
                                   ); 
                                   <?php }else{ ?>
                                        swal({title: "Success!", text: "Events Fairs Markets Added Successfully.", type: "success"},
                                      function(){ 
                                         window.location.href='<?php echo url("user-events-fairs"); ?>';
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
    jQuery('#datetimepicker').datetimepicker({
             minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
             onChangeDateTime:function(dp,$input){
                d = $input.val();
                $('#datetimepicker2').datetimepicker({
                    minDate:d.split(' ')[0],
                });
              }
    });

    $(document).on('change','#check_price',function(){
        $('#fee_price').val(0);
        if($(this).prop("checked") == true){
            $('#fee_price').rules( "remove" );
            $('.lease_price_div').hide();
        }else{
            $('#fee_price').rules( "add", {
                required: true,
                digits: true,
                min:1
            });
            $('.lease_price_div').show();
        }
    });
    if($("#check_price").prop("checked") == true){
            $( "#fee_price" ).rules( "remove" );
            $('.lease_price_div').hide();
    }
    $(document).on('click','.select_all_retail',function(){    
            if($(this).prop("checked") == true){                     
                    $('.class_all_retail').prop('checked', true);
            }else{
                     $('.class_all_retail').prop('checked',false);
            }
    });
    
</script>
@isset($eventsfairs_details)
   <script type="text/javascript">
            d = $('#datetimepicker').val();
            $('#datetimepicker2').datetimepicker({
                minDate:d.split(' ')[0],
            });
            
           var lat = {{$eventsfairs_details->lat}},
            lng = {{$eventsfairs_details->lng}};
             $('.showmap').show();
            var myLatlng = new google.maps.LatLng(lat, lng);
                var myOptions = {
                zoom: 8,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            var marker = new google.maps.Marker({
              position: myLatlng,
              map: map,
              title: $('#autocomplete').val()
            });
   </script>
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