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
                                <form id="add_brickform">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    <input type="hidden" name="brick_id" value="@if(@isset($brick_details)){{$brick_details->id}}@else{{0}}@endif">
                                    <div class="billing-details">
                                    <h3 class="title font-strs">{{$title}}  
                    <span class="right-st"> <b> Choose Brand: <span style="color: red;" class="required">*</span></b> 
                      <select class="form-control multipleSelect1" name="brand" id="select_brand" required="" style="margin-bottom: : 50%;">
                                                <option value="">Select Brand </option>
                                                @if(!empty($brands))
                                                 @foreach($brands as $key)
                                                      <option value="{{$key->id}}" @isset($brick_details){{$brick_details->brand == $key->id ? 'selected' : ''}} @endisset>{{$key->name}}</option>
                                                   @endforeach  
                                                @endif
                      </select>
                    </span>
                  </h3>
                  <div class="row brand_details">
                      
                  </div>
                  <div class="row">
                                        <!--div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Listed By<span class="required">*</span></label>
                                                <input type="text" class="form-control" value="demouser123">
                                            </div>
                                        </div-->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>I'm Looking For <span class="required">*</span></label>
                                                <select class="form-control" name="looking_for">
                                                    <option value="">Select One</option>
                                                    <option value="1" @isset($brick_details){{$brick_details->looking_for == 1 ? 'selected' : ''}} @endisset>Share Space </option>
                                                    <option value="2" @isset($brick_details){{$brick_details->looking_for == 2 ? 'selected' : ''}}@endisset>Share Resources</option>
                                                    <option value="3" @isset($brick_details){{$brick_details->looking_for == 3 ? 'selected' : ''}}@endisset>Collaborate  </option>
                                                    <option value="4" @isset($brick_details){{$brick_details->looking_for == 4 ? 'selected' : ''}}@endisset>Any  </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Space Type <!-- <span class="required">*</span> --></label>
                                                <select class="form-control" name="space_type">
                                                    <option value="">Select One</option>
                                                    @foreach($space_type as $key)
                                                        <option value="{{$key->id}}" @isset($brick_details){{$brick_details->space_type == $key->id ? 'selected' : ''}} @endisset>{{$key->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Retail Category <span class="required">*</span></label>
                                                <select class="form-control" name="retail_category">
                                                    <option value="">Select One</option>
                                                    @foreach($retail_categories as $key)
                                                        <option value="{{$key->id}}" @isset($brick_details){{$brick_details->retail_category == $key->id ? 'selected' : ''}} @endisset>{{$key->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                       <!--  <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Associate Listing</label>
                                                 <select class="form-control multipleSelect1" name="associated_listing">
                                                   <option value="">Select Listing</option>
                                                    @if(count($all_listings)>0)
                                                      @foreach($all_listings as $key)
                                                        <option value="{{$key->id}}" @isset($brick_details) @if($brick_details->associated_listing == $key->id) selected @endif @endisset @isset($associated) @if($associated == $key->id) selected @endif @endisset>{{$key->name}}</option>
                                                      @endforeach
                                                    @endif                                                    
                                                </select>                                               
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Location <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="location" id="autocomplete" value="@isset($brick_details){{$brick_details->location_city}}@endisset">
                                            </div>
                                        </div>
                                          <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Street and Number <span class="required">*</span></label>
												
												 <div class="form-row">
													<div class="col-md-6">
														  <input type="text" class="form-control" name="street" placeholder="Enter Street" id="street" value="@isset($brick_details){{$brick_details->street}}@endisset">
													</div>
													<div class="col-md-6">
														 <input type="text" class="form-control" name="street_no" id="street_no" value="@isset($brick_details){{$brick_details->street_no}}@endisset" placeholder="Street Number">
													</div>
												</div>
												
												
                                              
                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>City<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="city" id="city" value="@isset($brick_details){{$brick_details->city}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Province/State<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="state" id="state" value="@isset($brick_details){{$brick_details->state}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Postal code/Zip Code <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="zip" id="zip" value="@isset($brick_details){{$brick_details->zip}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <div class="form-group">
                                                <label>Country <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="country" id="country" value="@isset($brick_details){{$brick_details->country}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Lease Term  <!-- <span class="required">*</span> --></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="lease_term" value="@if(isset($brick_details)){{$brick_details->lease_term}}@else 0 @endif">
                                                    <select class="form-control" name="lease_term_unit">
                                                        <option @isset($brick_details){{$brick_details->lease_term_unit == 'Months' ? 'selected' : ''}} @endisset>Months</option>
                                                        <option @isset($brick_details){{$brick_details->lease_term_unit == 'Years' ? 'selected' : ''}} @endisset>Years</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" value="@isset($brick_details){{$brick_details->name}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>No. of openings <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="no_of_openings" value="@isset($brick_details){{$brick_details->no_of_openings}}@endisset">
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-6 col-md-6">
                                            <div class="form-group price-list-widget prics">
                                                <label>Your Product Price range  <span class="required">*</span></label>
                                                <div class="collection-filter-by-price">
                                                  <input class="range_input" type="text" data-min="@if(@isset($brick_details)){{$brick_details->price_from}}@else{{50}}@endif" data-max="@if(@isset($brick_details)){{$brick_details->price_to}}@else{{500}}@endif" name="filter_by_price" data-step="10">
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Collaboration Type <span class="required">*</span> <small> (What am I looking for?  ) </small></label>
                                                <ul class="list-chkes row list-nw collab_type_class">
                                                @foreach($collaboration_types as $key)
                                                    <li class="col-md-2 col-sm-4">
                                                        <label class="costm-check">{{$key->name}}<input type="checkbox" class="collaboration_type_class" name="collaboration_type[]" value="{{$key->id}}" @isset($brick_details){{in_array($key->id, $collaboration_types_arr) ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>
                                                    </li>
                                                @endforeach
                          
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="required">*</span></label>
                                                <textarea name="description" id="notes" cols="30" rows="5" placeholder="" class="form-control">@isset($brick_details){{$brick_details->description}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="costm-radio"> <span class="cla">Make Primary (Default) Displayed in Popup Window View</span>
                                                      <input type="checkbox" name="is_primary" value="1" @isset($brick_details){{$brick_details->is_primary == 1 ? 'checked' : ''}} @endisset>
                                                      <span class="checkmark"></span>
                                                </label>   
                                            </div>
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Internal Listing – Enter Listing Number</label>
                                                         <!-- <select class="form-control multipleSelect1" name="associated_listing">
                                                           <option value="">Select Listing</option>
                                                            @if(count($all_listings)>0)
                                                              @foreach($all_listings as $key)
                                                                <option value="{{$key->id}}" @isset($brick_details) @if($brick_details->associated_listing == $key->id) selected @endif @endisset @isset($associated) @if($associated == $key->id) selected @endif @endisset>{{$key->name}}</option>
                                                              @endforeach
                                                            @endif                                                    
                                                        </select>            -->          
                                                        <input type="text" class="form-control associate_listing_class" name="associated_listing" @isset($brick_details) value="{{$brick_details->associated_listing}}" @endisset @isset($associated) value="{{$associated}}" @endisset>                          
                                                    </div>
                                            </div>
                                            <div class="col-md-6">                                                   
                                            </div>

                                            <div class="col-md-12"> 
                                            <p> Or </p>    
                                            <h6>External Listing</h6>                                              
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                  <label>Add Link<!--  <span class="required">*</span> --></label>
                                                  <input type="url" class="form-control external_link_class" name="link" value="@isset($brick_details){{$brick_details->link}}@endisset">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="form-group">
                                                  <label>Landlord/Broker email <!-- <span class="required">*</span> --></label>
                                                  <input type="email" class="form-control landlord_email_class" name="landlord_email" value="@isset($brick_details){{$brick_details->landlord_email}}@endisset">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Pictures <!-- <span class="required">*</span> --></label>
                                                <!-- <label class="flds-uploads pb-4" for="upload-logo">
                                                    <i class="bx bx-cloud-upload"></i>
                                                    <h4> Click here to upload Image </h4>
                                                    <input type="file" id="upload-logo" style="visibility:hidden; width:0px; height:0px;">
                                                </label>  -->
                                        
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
                                                @isset($brick_details)
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
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group multislsct">
                                                <label>Invite Member <span class="required">*</span></label>
                                                <!-- <select class="multipleSelect form-control" multiple id="skills_chosen" name="invite_member[]">
                                                    
                                                    @if(!empty($users))
                                                      @foreach($users as $key)
                                                        <option value="{{$key->id}}" @isset($brick_details){{in_array($key->id, $invited_members) ? 'selected' : ''}} @endisset>{{$key->name}} {{$key->last_name}}</option>
                                                      @endforeach
                                                    @endif                                                    
                                                </select> -->
                                                <input type="hidden"  id="invited_values">
                                                <aside class="widget-area" style="margin-bottom: 10px;">
                                                <section class="widget widget_tag_cloud">                        
                                                    <div class="tagcloud tags_div">
                                                     @if(count($invited_members_list)>0)       
                                                     @foreach($invited_members_list as $key)
                                                     <span class="remove_tag_div">
                                                        <a href="javascript:void(0);">{{$key->name}} {{$key->last_name}}</a>
                                                        <i class="fa fa-remove remove_tag" data-id="{{$key->id}}"></i>
                                                     </span>
                                                     @endforeach
                                                     @endif
                                                    </div>                                         
                                                </section>
                                                </aside>
                                                <input type="text" class="form-control" placeholder="Search Member" id="search_member">
                                                <div class="members-search" id="members_selection">
                                                    
                                                </div>
                                               <!--  <select class="form-control" id="members_selection">
                                                       <option value="">Select Member</option>                   
                                                </select> -->
                                                
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
                                                     <input name="uplod-img1" id="uplod-img1" type="file" multiple />
                                                  </div>
                                               </div>
                                                <div class="row preview_files">
                                                @isset($brick_details)
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
                                               <!--  <select class="form-control" name="file_upload_viewer">
                                                    <option value="">Select One</option>
                                                    <option value="0">Public  </option>
                                                    <option value="1">Private </option>
                                                </select> -->
                                                <ul class="list-chkes row list-nw">                                
                                                  <li class="col-md-2 col-sm-4 mb-0">
                                                      <label class="costm-radio"> <span class="cla"> Public </span>
                                                          <input type="radio" checked="checked" name="file_upload_viewer" value="0" @isset($brick_details){{$brick_details->file_upload_viewer == 0 ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>                            
                                   
                                                  </li>   
                                                  <li class="col-md-2 col-sm-4 mb-0"> 
                                                      <label class="costm-radio"><span class="cla"> Private </span>
                                                        <input type="radio" name="file_upload_viewer" value="1" @isset($brick_details){{$brick_details->file_upload_viewer == 1 ? 'checked' : ''}} @endisset>
                                                        <span class="checkmark"></span>
                                                      </label>
                         
                                                  </li>               
                                              </ul>
                                        </div>
                                    </div>
                   </div>
                <!--   <div class="external-ls">
                    <h4 class="exter-l"> External Listings </h4>
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Add Thumbnail  <span class="required">*</span>@isset($brick_details) <img src="{{url('/uploads/files/').'/'.$brick_details->thumbnail}}" class="showthumbnail"> @endisset</label>
                          <input type="file" class="form-control" accept="image/*" name="thumbnail" style="padding: 8px 15px;">
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                          <label>Add Link <span class="required">*</span></label>
                          <input type="url" class="form-control" name="link" value="@isset($brick_details){{$brick_details->link}}@endisset">
                        </div>
                      </div>
                    </div>
                  </div> -->
                                    <input type="hidden" name="lat" id="lat" value="@isset($brick_details){{$brick_details->lat}}@endisset">
                                    <input type="hidden" name="lng" id="lng" value="@isset($brick_details){{$brick_details->lng}}@endisset">
                  <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <button class="submit_btn btn btn-save-stt" type="submit"> Save </button>
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

<div class="modal fade" id="listing-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-review modal-lg" role="document">
    <div class="modal-content contnt-design-new">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body pt-4 pb-4">
          <center><img src="{{url('/')}}/img/loading.gif" height="100" width="100"></center>    
        </div>
    </div>
  </div>       
 </div>

@endsection
@section('footer_scripts')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/css/component-chosen.css" />
<script src="{{url('/')}}/js/chosen.jquery.min.js"></script>
<script>
 $(function(){
    $('#members_selection').hide(); 
            $('.multipleSelect1').chosen({
                  allow_single_deselect: true,
                  width: '100%',
            });
            
        });
    //$('.multipleSelect').fastselect();
    $(document).on('keyup','#search_member',function(){
       // alert();
       var keyword = $(this).val();
       var data = $('#invited_values').val();

      // if(keyword){         
            $.ajax({
              url: '{{url("/")}}/get_members_dropdown',
              type: 'POST',
              data: {"_token": '{{ Session::token() }}', keyword : keyword,data:data},
              dataType: 'json',
              success: function(result) {               
                     $('#members_selection').html(result.html); 
                     $('#members_selection').show();      
                     var keyword = $('#search_member').val();    
                     if(!keyword){  
                        $('#members_selection').hide(); 
                     }   
              }            
          });
       // }else{
       //      $('#members_selection').hide(); 
       // }
        
    });
    $(document).on('click','.list_selection',function(){
          var memval = $(this).attr('data-id');
          var values =  $('#invited_values').val();
          values = values.split(',');
          values.push(memval);
          var name = $( this ).text();
          $(this).remove();
          if(!$("#members_selection ul li").length > 0){
            $('#members_selection').html('<ul><li>No results found.</li></ul>');
          }
          $('#invited_values').val(values);    
          $('.tags_div').append('<span class="remove_tag_div"><a href="javascript:void(0);">'+name+'</a><i class="fa fa-remove remove_tag" data-id="'+memval+'"></i></span>');
        
    });
    $(document).on('click','.remove_tag',function(){
        var id_for_del = $(this).attr('data-id');
        var values =  $('#invited_values').val();
        values = values.split(',');
        values.push($(this).val());
        var y = jQuery.grep(values, function(value) {
          return value != id_for_del;
        });
        var newArray = y.filter(function(v){return v!==''});
        $('#invited_values').val(newArray); 
        $(this).closest('span').remove(); 
           var keyword = $('#search_member').val();
           var data = $('#invited_values').val();
           if(keyword){
                $.ajax({
                  url: '{{url("/")}}/get_members_dropdown',
                  type: 'POST',
                  data: {"_token": '{{ Session::token() }}', keyword : keyword,data:data},
                  dataType: 'json',
                  success: function(result) {
                    $('#members_selection').html(result.html); 
                    $('#members_selection').show();           
                  }            
              });
           }else{
                $('#members_selection').hide(); 
           }
    });


    @isset($invited_members)
    var data_to = [];
    @foreach($invited_members as $key)
        data_to.push({{$key}});
    @endforeach
    $('#invited_values').val(data_to);
    @endisset
    

   
$(function($) { 
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

  // **************************dropzone end here*******************
 $.validator.setDefaults({ ignore: ":hidden:not(select)" });
    $('#add_brickform').validate({
    ignore: [],
    rules: { 
        "invite_member[]":"required",   
        "collaboration_type[]":"required",
        looking_for:
        {
            required:true       
        }, 
        brand:
        {
            required:true
        },  
        // space_type:
        // {
        //     required: true
        // },
        retail_category:
        {
            required: true
        },
        file_upload_viewer:
        {
            required: true
        },
        // lease_term:{
        //    required: true,
        //     digits: true,
        //     min:1
        // },
        no_of_openings:{
           required: true,
            digits: true,
            min:1
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
        title:
        {
            required: true
        },
        description:
        {
            required: true
        },
        location:{
            required: true,
        },
        // link:{
        //     required: true,
        // }
        associated_listing:{
           required: true,
           digits: true,
           min:1
        }
    },  
        messages: {
            thumbnail: {
                accept: 'Please select image with .jpg, .jpeg, .png, .gif extensions!'
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
            if (element.attr("name") == "brand") {
                error.insertAfter("#select_brand_chosen");
            }else if(element.attr("name") == "collaboration_type[]"){
                error.insertAfter(".collab_type_class");
            }else{
                error.insertAfter(element);
            }

        },
            invalidHandler: function(form, validator) {

                if (!validator.numberOfInvalids())
                    return;
                if(!$('#select_brand').val()){
                    setTimeout(function() {  
                        $('html, body').animate({
                               scrollTop: $(".page-title-content").offset().top
                            }, 500);
                    }, 300);
                }else{
                    setTimeout(function() {  
                        $('html, body').animate({
                               scrollTop: $(".has-error").offset().top
                            }, 500);
                    }, 300);
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
               var formData = new FormData($("#add_brickform")[0]);
               formData.append('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
               formData.append('all_uploaded_files',JSON.stringify(all_uploaded_files));
               var invite_member =  $('#invited_values').val();
               if(!invite_member){
                     swal("Error!", 'Please invite atleast one member!', "error");
               }
               invite_members = invite_member.split(',');
               for (let i = 0; i < invite_members.length; ++i) {
                    if(invite_members[i]){                        
                     formData.append('invite_member[]',invite_members[i]);
                    }
                }


                 
                if(invite_member){   
                $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);       
                    $.ajax({
                        url:'{{url("/")}}'+'/add_brickform',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: 'json',
                        success:function(result)
                        { 
                            if($('#is_admin').val() == '1'){
                                 if(result.status == 1){
                                     $('.submit_btn').html('Save').prop('disabled',false); 
                                     swal({title: "Success!", text: "Brick Updated Successfully.", type: "success"},
                                              function(){ 
                                                 window.location.href='<?php echo url("admin/brick-listings"); ?>';
                                          }
                                       );
                                  }else if(result.status == 2){
                                      swal({title: "Error", text: result.message, type: "error"});
                                  }else{
                                    swal({title: "Error", text: "Oops! No listing found with number", type: "error"});
                                  }  
                            }else{
                                 $('.submit_btn').html('Save').prop('disabled',false); 
                                  if(result.status == 1){
                                      <?php if(isset($brick_details)){ ?>
                                      swal({title: "Success!", text: "Brick Updated Successfully.", type: "success"},
                                          function(){ 
                                             location.reload();
                                          }
                                       );
                                   <?php }else{ ?>
                                      swal({title: "Success!", text: "Brick Added Successfully.", type: "success"},
                                          function(){ 
                                             window.location.href='<?php echo url("user-bricks"); ?>';
                                          }
                                       );
                                  <?php } ?> 
                                }else{
                                  swal({title: "Error", text: result.message, type: "error"});
                                }  
                            }
                           
                        }
                });
            }
          // }
        } 
        
    });
});


</script>
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
           // $('.showmap').show();
          // alert();
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
         $(document).on('keyup','.associate_listing_class',function(){
            if($(this).val()){
                $( ".external_link_class" ).rules( "remove" );
                $( ".landlord_email_class" ).rules( "remove" );
            }else{                
                $( ".external_link_class" ).rules( "add", {
                   required: true
                });
                $( ".landlord_email_class" ).rules( "add", {
                   required: true
                });
            }
         });
         $(document).on('keyup','.external_link_class',function(){
            if($(this).val()){
                $( ".associate_listing_class" ).rules( "remove" );
                $( ".landlord_email_class" ).rules( "add", {
                   required: true
                });
            }else{
                $( ".associate_listing_class" ).rules( "add", {
                   required: true,
                   digits: true,
                   min:1
                });
            }
         });
         $(document).on('keyup','.landlord_email_class',function(){
            if($(this).val()){
               $( ".associate_listing_class" ).rules( "remove" );
                $( ".external_link_class" ).rules( "add", {
                   required: true
                });
            }else{
                $( ".associate_listing_class" ).rules( "add", {
                   required: true,
                   digits: true,
                   min:1
                });
               
            }
         });
        
        $(document).on('change','#select_brand',function(){
            var brand = $(this).val();
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/get_brand_detals_ajax',
                    data:{id:brand,_token:'{{ Session::token() }}'},
                    success:function(result)
                    { 
                    var obj = $.parseJSON(result); 
                      $('.brand_details').html(obj.brand_details);
                      $('#listing-popup').html(obj.listing_details);
                      $('.listing-details-image-slides').owlCarousel({
                        loop: true,
                        nav: true,
                        dots: false,
                        autoplayHoverPause: true,
                        autoplay: true,
                        animateOut: 'fadeOut',
                        items: 1,
                        navText: [
                            "<i class='flaticon-left'></i>",
                            "<i class='flaticon-right'></i>"
                        ],
                    });
                    }
            });

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
     
</script>
 @isset($brick_details)
 <script type="text/javascript">
    var brand = $('#select_brand').val();
            $.ajax({
                    type:'POST',
                    url:'{{url("/")}}'+'/get_brand_detals_ajax',
                    data:{id:brand,_token:'{{ Session::token() }}'},
                    success:function(result)
                    { 
                    var obj = $.parseJSON(result); 
                      $('.brand_details').html(obj.brand_details);
                      $('#listing-popup').html(obj.listing_details);
                      $('.listing-details-image-slides').owlCarousel({
                        loop: true,
                        nav: true,
                        dots: false,
                        autoplayHoverPause: true,
                        autoplay: true,
                        animateOut: 'fadeOut',
                        items: 1,
                        navText: [
                            "<i class='flaticon-left'></i>",
                            "<i class='flaticon-right'></i>"
                        ],
                    });
                    }
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