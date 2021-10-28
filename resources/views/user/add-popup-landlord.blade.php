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
                                <form id="add_popup_landlord_form">
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                     <input type="hidden" name="popuplandlord_id" value="@if(@isset($popuplandlord_details)){{$popuplandlord_details->id}}@else{{0}}@endif">
                                    <div class="billing-details">
                                    <h3 class="title font-strs">Pop-Up Landlord </h3>
                                    <div class="row">
                                        <!-- <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Account ID <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="account_id">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Title <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="title" value="@isset($popuplandlord_details){{$popuplandlord_details->name}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Address <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="address" id="autocomplete" value="@isset($popuplandlord_details){{$popuplandlord_details->location_city}}@endisset">
                                            </div>
                                        </div>
                                          <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Street and Number <span class="required">*</span></label>
												 <div class="form-row">
													<div class="col-md-6">
														 <input type="text" class="form-control" name="street" placeholder="Enter Street" id="street" value="@isset($popuplandlord_details){{$popuplandlord_details->street}}@endisset">
													</div>
													<div class="col-md-6">
														  
                                              <input type="text" class="form-control" name="street_no" id="street_no" value="@isset($popuplandlord_details){{$popuplandlord_details->street_no}}@endisset" placeholder="Street Number">
													</div>
												</div>
												
												
                                               
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>City<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="city" id="city" value="@isset($popuplandlord_details){{$popuplandlord_details->city}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Province/State<span class="required">*</span></label>
                                                <input type="text" class="form-control" name="state" id="state" value="@isset($popuplandlord_details){{$popuplandlord_details->state}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Postal code/Zip Code <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="zip" id="zip" value="@isset($popuplandlord_details){{$popuplandlord_details->zip}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Country <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="country" id="country" value="@isset($popuplandlord_details){{$popuplandlord_details->country}}@endisset">                                               
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Description <span class="required">*</span></label>
                                                <textarea name="description" id="notes" cols="30" rows="5" placeholder="" class="form-control">@isset($popuplandlord_details){{$popuplandlord_details->description}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Property Type <span class="required">*</span></label>
                                                <select class="form-control" name="property_type">
                                                    <option value="">Select One</option>
                                                    @foreach($space_type as $key)
                                                      <option value="{{$key->id}}" @isset($popuplandlord_details){{$popuplandlord_details->space_type == $key->id ? 'selected' : ''}} @endisset>{{$key->name}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Floors<!--  <span class="required">*</span> --></label>
                                                <select class="form-control" name="floors">
                                                    <option value="">Select One</option>
                                                    <option @isset($popuplandlord_details){{$popuplandlord_details->floors == '1' ? 'selected' : ''}} @endisset>1 </option>
                                                    <option @isset($popuplandlord_details){{$popuplandlord_details->floors == '2' ? 'selected' : ''}} @endisset>2</option>
                                                    <option @isset($popuplandlord_details){{$popuplandlord_details->floors == '3' ? 'selected' : ''}} @endisset>3</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Floor Number <!-- <span class="required">*</span> --></label>
                                                <input type="text" class="form-control" name="floor_no" value="@isset($popuplandlord_details){{$popuplandlord_details->floor_no}}@endisset">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Size <span class="required">*</span></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="size" value="@isset($popuplandlord_details){{$popuplandlord_details->size}}@endisset">
                                                    <select class="form-control" name="size_unit">
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->size_unit == 'sq feet' ? 'selected' : ''}} @endisset>sq feet</option>
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->size_unit == 'sq meters' ? 'selected' : ''}} @endisset>sq meters</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-lg-12 col-md-12 scroll_to_error">
                                            <label class="costm-check pric-stra">Does not want to list the price ?
                                             <input type="checkbox" id="check_price" @isset($popuplandlord_details) @if(!$popuplandlord_details->daily_rate && !$popuplandlord_details->monthly_rate && !$popuplandlord_details->weekly_rate) checked @endif @endisset>
                                              <span class="checkmark"></span>
                                            </label>
                                        </div>
                                            <div class="lease_price_div col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label>Daily Rate<!-- <span class="required">*</span> --></label>
                                                    <input type="text" id="daily_rate" class="lease_price form-control" name="daily_rate" value="@isset($popuplandlord_details){{$popuplandlord_details->daily_rate}}@endisset">
                                                </div>
                                            </div>
                                            <div class="lease_price_div col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label>Weekly Rate<!-- <span class="required">*</span> --></label>
                                                    <input type="text" id="weekly_rate" class="lease_price form-control" name="weekly_rate" value="@isset($popuplandlord_details){{$popuplandlord_details->weekly_rate}}@endisset">
                                                </div>
                                            </div>
                                            <div class="lease_price_div col-lg-4 col-md-6">
                                                <div class="form-group">
                                                    <label>Monthly Rate<!-- <span class="required">*</span> --></label>
                                                    <input type="text" id="monthly_rate" class="lease_price form-control" name="monthly_rate" value="@isset($popuplandlord_details){{$popuplandlord_details->monthly_rate}}@endisset">
                                                </div>
                                            </div>

                                       
                                        <div class="col-lg-12 col-md-12 lease_price_div">
                                             <span class="required error_color_price"><b>NOTE*: </b>Choose atleast one price from above.</span>
                                        </div>
                                        <br><br>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Included with Lease <!-- <span class="required">*</span> --></label>
                                                <textarea name="include_with_lease" cols="30" rows="5" placeholder="For example Rate includes utilities, building services and property expenses" class="form-control">@isset($popuplandlord_details){{$popuplandlord_details->include_with_lease}}@endisset</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Renters have access to <span class="required">*</span></label>
                                                <select class="form-control" name="renters_access">
                                                    <option @isset($popuplandlord_details){{$popuplandlord_details->renters_access == 'Entire' ? 'selected' : ''}} @endisset>Entire</option>
                                                    <option @isset($popuplandlord_details){{$popuplandlord_details->renters_access == 'Partial' ? 'selected' : ''}} @endisset>Partial</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>MINIMUM RENTAL PERIOD<!-- <span class="required">*</span> --></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="minimum_rental" value="@isset($popuplandlord_details){{$popuplandlord_details->min_rental}}@endisset">
                                                    <select class="form-control" name="minimum_rental_unit">
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->min_rental_unit == 'Days' ? 'selected' : ''}} @endisset>Days</option>
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->min_rental_unit == 'Weeks' ? 'selected' : ''}} @endisset>Weeks</option>
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->min_rental_unit == 'Months' ? 'selected' : ''}} @endisset>Months</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>MAX RENTAL PERIOD <!-- <span class="required">*</span> --></label>
                                                <div class="dlex-stra">
                                                    <input type="text" class="form-control" name="max_rental" value="@isset($popuplandlord_details){{$popuplandlord_details->max_rental}}@endisset">
                                                    <select class="form-control" name="max_rental_unit">
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->max_rental_unit == 'Days' ? 'selected' : ''}} @endisset>Days</option>
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->max_rental_unit == 'Weeks' ? 'selected' : ''}} @endisset>Weeks</option>
                                                        <option @isset($popuplandlord_details){{$popuplandlord_details->max_rental_unit == 'Months' ? 'selected' : ''}} @endisset>Months</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
										@if(count($bricks)>0)
                                        <!-- <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label>Associate Brick</label>
                                                <select class="form-control" name="brand">
                                                    <option value="">Select One</option>
                                                    @foreach($bricks as $key)
                                                         <option value="{{$key->id}}"@isset($popuplandlord_details){{$popuplandlord_details->brand == $key->id ? 'selected' : ''}} @endisset>{{$key->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> -->
                                        @endif
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Ideal Uses <span class="required">*</span> </label>
                                                <ul class="list-chkes row list-nw ideal_class">
                                                @foreach($ideal_uses as $key)
                                                        <li class="col-md-2 col-sm-4">
                                                            <label class="costm-check">{{$key->name}}
                                                              <input type="checkbox" value="{{$key->id}}" name="ideal_uses[]" @isset($popuplandlord_details){{in_array($key->id, $ideal_uses_arr) ? 'checked' : ''}} @endisset>
                                                              <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label>Amenities <!-- <span class="required">*</span> --> </label>
                                                <ul class="list-chkes row list-nw amenties_class">
                                                    @foreach($amenities as $key)
                                                        <li class="col-md-2 col-sm-4">
                                                            <label class="costm-check">{{$key->name}}
                                                              <input type="checkbox" value="{{$key->id}}" name="amenities[]" @isset($popuplandlord_details){{in_array($key->id, $amenities_arr) ? 'checked' : ''}} @endisset>
                                                              <span class="checkmark"></span>
                                                            </label>
                                                        </li>
                                                    @endforeach
                                                    <li class="col-md-4 col-sm-4  othrflt">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" placeholder="Add Other Option" name="amenities_other_option" value="@isset($popuplandlord_details){{$popuplandlord_details->amenities_other_option}}@endisset">
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
                                                @isset($popuplandlord_details)
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
                                                     <!-- <button type="button" class="btn btn-default" style="background: white; color: rgb(64, 202, 90);">or select file to upload</button> -->
                                                  </div>
                                                  <div class="fallback">
                                                     <input name="uplod-img1" id="uplod-img1" type="file" multiple  />
                                                  </div>
                                               </div>
                                               
                                                <div class="row preview_files">
                                                    @isset($popuplandlord_details)
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
                                                          <input type="radio" checked="checked" name="file_upload_viewer" value="0" @isset($popuplandlord_details){{$popuplandlord_details->file_upload_viewer == 0 ? 'checked' : ''}} @endisset>
                                                          <span class="checkmark"></span>
                                                        </label>                            
                                   
                                                  </li>   
                                                  <li class="col-md-2 col-sm-4 mb-0"> 
                                                      <label class="costm-radio"><span class="cla"> Private </span>
                                                        <input type="radio" name="file_upload_viewer" value="1" @isset($popuplandlord_details){{$popuplandlord_details->file_upload_viewer == 1 ? 'checked' : ''}} @endisset>
                                                        <span class="checkmark"></span>
                                                      </label>
                         
                                                  </li>               
                                              </ul>
                                            </div>
                                        </div> -->
                                        <div class="col-lg-7 col-md-7">
                                            <div class="form-group">
                                                <label>Availabilities Calendar <!-- <span class="required">*</span> --></label>
                                                <a href="#calendar-modal" class="modal-trigger hover-col"><div id='calendar' class="mt-3"></div></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 showmap" style="display: none;">
                                            <div class="form-group">
                                                <label>Map</label>
                                                <div id="map_canvas" style="width:100%;height:380px;"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7">
                                            <div class="form-group">
                                                <label>LISTING OWNER EMAIL <span class="required">*</span></label>
                                                <input type="text" class="form-control" value="@isset($popuplandlord_details){{$popuplandlord_details->email_listing_owner}}@endisset" name="email_listing_owner">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-10 col-md-10">
                                            <div class="form-group">
                                                <label class="costm-check">Publish<small> (By Publishing you accept all Privacy and terms.) </small>
                                                  <input type="checkbox" name="terms" @isset($popuplandlord_details) checked @endisset>
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <input type="hidden" name="lat" id="lat" value="@isset($popuplandlord_details){{$popuplandlord_details->lat}}@endisset">
                                            <input type="hidden" name="lng" id="lng" value="@isset($popuplandlord_details){{$popuplandlord_details->lng}}@endisset">
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
<div class="modal calendar" id="calendar-modal">
  <div class="modal-dialog">
    <div class="modal-content modl-set-clndr">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Availability</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
                 <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label> Add Booking </label>
                            <input type="text" name="price" id="price" class="form-control" value="">
                        </div>
                    </div>
                 </div>
                    
            </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>
@endsection

@section('footer_scripts')

    <!-- Amsify Plugin -->
        <script type="text/javascript" src="{{url('/')}}/js/jquery.amsify.suggestags.js"></script>
        <script type="text/javascript">
            $('input[name="color"]').amsifySuggestags({
                type : 'amsify'
            });
        </script>
        
        
        <script src="{{url('/')}}/js/moment-with-locales.min.js"></script>     
        <script src="{{url('/')}}/js/fullcalendar.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2020-03-17',
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true,
            select: function(start, end) {
                // Display the modal.
                // You could fill in the start and end fields based on the parameters
                $('#calendar-modal').modal('show');

            },
            eventClick: function(event, element) {
                // Display the modal and set the values to the event values.
                $('#calendar-modal').modal('show');
                $('#calendar-modal').find('#title').val(event.title);
                $('#calendar-modal').find('#starts-at').val(event.start);
                $('#calendar-modal').find('#ends-at').val(event.end);

            },
            editable: true,
            eventLimit: true // allow "more" link when too many events

        });

        // Bind the dates to datetimepicker.
        // You should pass the options you need
       

        // Whenever the user clicks on the "save" button om the dialog
        $('#save-event').on('click', function() {
            var title = $('#title').val();
            if (title) {
                var eventData = {
                    title: title,
                    start: $('#starts-at').val(),
                    end: $('#ends-at').val()
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');

            // Clear modal inputs
            $('#calendar-modal').find('input').val('');

            // hide modal
            $('#calendar-modal').modal('hide');
        });
    });
     $(document).ready(function(){
          $(".active-toggle-ra button.btn").click(function(){
            $(".active-toggle-ra button.btn").removeClass("active");
            $(this).closest('button').addClass('active');
            $('.daysfield').addClass('daysactive');
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
    $('#add_popup_landlord_form').validate({
    ignore: [],
    rules: {    
       // "amenities[]":"required",
        "ideal_uses[]":"required",
        title:
        {
            required:true       
        },   
        address:
        {
            required: true
        },
        property_type:
        {
            required: true
        },
        // floors:
        // {
        //     required: true
        // },
        floor_no:
        {
          //  required: true,
            digits: true,
            min:1
        },
        description:
        {
            required: true
        },
        size:
        {
            required: true
        },
        daily_rate:
        {
         //   required: true,
            digits: true,
         //   min:1
        },
        weekly_rate:
        {
          //  required: true,
            digits: true,
         //   min:1
        },
        monthly_rate:
        {
           // required: true,
            digits: true,
          //  min:1
        },
        // include_with_lease:
        // {
        //     required: true
        // },
        renters_access:
        {
            required: true
        },
        minimum_rental:
        {
            //required: true,
            digits: true,
          //  min:1
        },
        max_rental:
        {
           // required: true,
            digits: true,
           // min:1
        },
        // file_upload_viewer:
        // {
        //     required: true
        // },
        email_listing_owner:
        {
            required: true,
            email:true
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
        terms:{
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
                }else if(element.attr("name") == "amenities[]"){
                    error.insertAfter(".amenties_class");
                }else if(element.attr("name") == "ideal_uses[]"){
                    error.insertAfter(".ideal_class");
                } else {
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
           var first_val = Number($('#daily_rate').val()).toString();
           var second_val = Number($('#weekly_rate').val()).toString();
           var third_val = Number($('#monthly_rate').val()).toString();
           if(first_val>0 || second_val>0 || third_val>0){
             //  if(!(all_uploaded_pictures.length<1 || !anypicture) && !(all_uploaded_files.length<1 || !anyfile)){
                   var formData = new FormData($("#add_popup_landlord_form")[0]);
                   formData.append('all_uploaded_pictures',JSON.stringify(all_uploaded_pictures));
                   formData.append('all_uploaded_files',JSON.stringify(all_uploaded_files));

                    $('.submit_btn').html('<i class="fa fa-spinner fa-spin"></i>').prop('disabled',true);            
                    $.ajax({
                            url:'{{url("/")}}'+'/add_popuplandlord',
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            dataType: 'json',
                            success:function(result)
                            { 
                                if($('#is_admin').val() == '1'){
                                     $('.submit_btn').html('Save').prop('disabled',false); 
                                     swal({title: "Success!", text: "Pop-Up Landlord Listing Updated Successfully.", type: "success"},
                                              function(){ 
                                                 window.location.href='<?php echo url("admin/popup-store-listings"); ?>';
                                          }
                                       );
                                }else{
                                    $('.submit_btn').html('Save').prop('disabled',false); 
                                    if(result.status == 1){
                                        <?php if(isset($popuplandlord_details)){ ?>
                                         swal({title: "Success!", text: "Pop-Up Landlord Listing Updated Successfully.", type: "success"},
                                                  function(){ 
                                                     location.reload();
                                                  }
                                               ); 
                                       <?php }else{ ?>
                                            swal({title: "Success!", text: "Pop-Up Landlord Listing Added Successfully.", type: "success"},
                                                  function(){ 
                                                     window.location.href='<?php echo url("user-popup-landloard"); ?>';
                                                  }
                                               ); 
                                      <?php } ?>
                                      
                                    }else{
                                      swal({title: "Error", text: "Oops! Something went wrong. Please try again later", type: "error"});
                                    }
                                }
                            }   
                    });
             //  }
           }else{
                $('.error_color_price').css('color','red');
                setTimeout(function() {  
                        $('html, body').animate({
                               scrollTop: $(".scroll_to_error").offset().top
                            }, 500);
                    }, 300);
           }
        } 
        
    });
    $(document).on('change','#check_price',function(){
        $('.lease_price').val('0');
        if($(this).prop("checked") == true){
            $('.lease_price_div').hide();
            $( "#daily_rate" ).rules( "remove" );$( "#weekly_rate" ).rules( "remove" );$( "#monthly_rate" ).rules( "remove" );

        }else{
            $( "#daily_rate" ).rules( "add", {
               // required: true,
                digits: true,
                min:1
            });
            $( "#weekly_rate" ).rules( "add", {
              //  required: true,
                digits: true,
                min:1
            });
            $( "#monthly_rate" ).rules( "add", {
              //  required: true,
                digits: true,
                min:1
            });
            $('.lease_price_div').show();
        }
    });
     $(document).on('keyup','#daily_rate,#weekly_rate,#monthly_rate',function(){
            $('.error_color_price').css('color','black');
            
    });
    if($("#check_price").prop("checked") == true){
                    $('.lease_price_div').hide();
                    $( "#daily_rate" ).rules( "remove" );$( "#weekly_rate" ).rules( "remove" );$( "#monthly_rate" ).rules( "remove" );
    }
    </script>

@isset($popuplandlord_details)
   <script type="text/javascript">
           var lat = {{$popuplandlord_details->lat}},
            lng = {{$popuplandlord_details->lng}};
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